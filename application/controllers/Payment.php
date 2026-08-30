<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('Razorpay');
        $this->load->config('razorpay', TRUE);
        
        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('X-Frame-Options: SAMEORIGIN');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
    }

    /**
     * Display the ₹5,999 One-Time Pricing / Payment Page
     */
    public function pricing() {
        // Load plan configuration with dynamic settings
        $dbPrice = $this->User_model->get_setting('plan_price');
        $planPrice = ($dbPrice !== null && $dbPrice !== '') ? (float)$dbPrice : (float)$this->config->item('razorpay_amount', 'razorpay');
        $originalPrice = (float)$this->User_model->get_setting('original_price', 12999);
        $planTitle = $this->User_model->get_setting('plan_title', 'प्रीमियम सदस्यत्व');
        $planSubtitle = $this->User_model->get_setting('plan_subtitle', 'एकदाच भरा आणि आयुष्यभर वापरा');

        $data['title']         = "सदस्यत्व योजना - ₹" . number_format($planPrice, 0) . " आजीवन प्रवेश";
        $data['plan_name']     = $planTitle;
        $data['plan_title_mr'] = $planTitle;
        $data['plan_subtitle'] = $planSubtitle;
        $data['plan_amount']   = $planPrice;
        $data['original_price']= $originalPrice;
        $data['amount_paise']  = (int)($planPrice * 100);
        $data['currency']      = $this->config->item('razorpay_currency', 'razorpay');
        $data['company_name']  = $this->config->item('razorpay_company_name', 'razorpay');
        $data['company_desc']  = $this->config->item('razorpay_company_desc', 'razorpay');
        $data['theme_color']   = $this->config->item('razorpay_theme_color', 'razorpay');
        $data['features']      = $this->config->item('pricing_features', 'razorpay');
        $data['key_id']        = $this->razorpay->get_key_id();

        // Check if user is logged in
        $userId = $this->session->userdata('user_id');
        $data['user'] = null;
        $data['is_paid'] = false;
        $data['just_registered'] = $this->session->flashdata('just_registered') ? true : false;

        if ($userId) {
            $user = $this->User_model->get_user_by_id($userId);
            $data['user'] = $user;
            if ($user && $user['payment_status'] === 'paid') {
                $data['is_paid'] = true;
            }
        }

        $this->load->view('public/header', $data);
        $this->load->view('payment/pricing', $data);
        $this->load->view('public/footer');
    }

    /**
     * Create Razorpay Order via AJAX
     */
    public function create_order() {
        // Ensure JSON response
        $this->output->set_content_type('application/json');

        if (!$this->session->userdata('logged_in')) {
            echo json_encode(array(
                'status'  => 'error',
                'message' => 'Please log in or register before completing payment.'
            ));
            return;
        }

        $userId = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($userId);

        if (!$user) {
            echo json_encode(array('status' => 'error', 'message' => 'User not found.'));
            return;
        }

        $dbPrice     = $this->User_model->get_setting('plan_price');
        $planAmount  = ($dbPrice !== null && $dbPrice !== '') ? (float)$dbPrice : (float)$this->config->item('razorpay_amount', 'razorpay');
        $amountPaise = (int)($planAmount * 100);
        $currency    = $this->config->item('razorpay_currency', 'razorpay');
        $receiptId   = 'RCPT_' . $userId . '_' . time();

        $notes = array(
            'user_id'    => $userId,
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
            'user_phone' => $user['phone'],
            'plan'       => 'Lifetime Premium - Rs. ' . $planAmount
        );

        $orderResult = $this->razorpay->create_order($amountPaise, $receiptId, $notes);

        if (!empty($orderResult['success'])) {
            // Save order to database
            $paymentData = array(
                'user_id'          => $userId,
                'order_id'         => $orderResult['order_id'],
                'amount'           => $planAmount,
                'currency'         => $currency,
                'status'           => 'created',
                'payment_response' => json_encode($orderResult)
            );

            $this->User_model->create_payment_record($paymentData);

            echo json_encode(array(
                'status'       => 'success',
                'order_id'     => $orderResult['order_id'],
                'amount'       => $amountPaise,
                'currency'     => $currency,
                'key_id'       => $this->razorpay->get_key_id(),
                'user_name'    => $user['name'],
                'user_email'   => $user['email'],
                'user_phone'   => $user['phone'],
                'company_name' => $this->config->item('razorpay_company_name', 'razorpay'),
                'description'  => 'Lifetime Membership - ₹' . number_format($planAmount, 0),
                'theme_color'  => $this->config->item('razorpay_theme_color', 'razorpay'),
                'is_mock'      => !empty($orderResult['is_mock'])
            ));
        } else {
            echo json_encode(array(
                'status'  => 'error',
                'message' => !empty($orderResult['message']) ? $orderResult['message'] : 'Unable to initiate Razorpay order. Please try again or contact support.'
            ));
        }
    }

    /**
     * Verify payment signature and update membership status
     */
    public function verify() {
        $this->output->set_content_type('application/json');

        if (!$this->session->userdata('logged_in')) {
            echo json_encode(array('status' => 'error', 'message' => 'Session expired. Please log in.'));
            return;
        }

        $userId    = $this->session->userdata('user_id');
        $orderId   = $this->input->post('razorpay_order_id', TRUE);
        $paymentId = $this->input->post('razorpay_payment_id', TRUE);
        $signature = $this->input->post('razorpay_signature', TRUE);

        if (empty($orderId) || empty($paymentId)) {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid payment response data.'));
            return;
        }

        // Verify HMAC-SHA256 signature
        $isValid = $this->razorpay->verify_signature($orderId, $paymentId, $signature);

        if ($isValid) {
            $dbPrice    = $this->User_model->get_setting('plan_price');
            $planAmount = ($dbPrice !== null && $dbPrice !== '') ? (float)$dbPrice : (float)$this->config->item('razorpay_amount', 'razorpay');

            // Update payment record in database
            $updateData = array(
                'payment_id'       => $paymentId,
                'signature'        => $signature,
                'status'           => 'paid',
                'payment_method'   => $this->input->post('payment_method', TRUE) ?: 'online',
                'payment_response' => json_encode($this->input->post())
            );
            $this->User_model->update_payment_by_order_id($orderId, $updateData);

            // Update user status to 'paid'
            $this->User_model->update_payment_status($userId, 'paid', $planAmount);

            // Update session data
            $this->session->set_userdata('payment_status', 'paid');

            // Fetch payment record ID for receipt redirection
            $paymentRecord = $this->User_model->get_payment_by_order_id($orderId);
            $recordId = $paymentRecord ? $paymentRecord['id'] : 1;

            $this->session->set_flashdata('success', "अभिनंदन! आपले ₹" . number_format($planAmount, 0) . " चे पेमेंट यशस्वी झाले आहे. आपले आजीवन सदस्यत्व सक्रिय झाले आहे!");

            echo json_encode(array(
                'status'       => 'success',
                'message'      => 'Payment verified successfully!',
                'redirect_url' => base_url('payment/success/' . $recordId)
            ));
        } else {
            // Update order as failed
            $this->User_model->update_payment_by_order_id($orderId, array(
                'status'           => 'failed',
                'payment_response' => json_encode($this->input->post())
            ));

            echo json_encode(array(
                'status'  => 'error',
                'message' => 'Payment signature verification failed. Please contact support if amount was deducted.'
            ));
        }
    }

    /**
     * Payment Success / Receipt Page
     */
    public function success($payment_id = null) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $userId = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($userId);
        
        $payment = null;
        if (!empty($payment_id)) {
            $payment = $this->User_model->get_payment_by_id($payment_id, $userId);
        }

        if (!$payment) {
            $userPayments = $this->User_model->get_user_payments($userId);
            $payment = !empty($userPayments) ? $userPayments[0] : null;
        }

        $data['payment'] = $payment;
        $data['title']   = 'पेमेंट यशस्वी - पावती (Payment Success Receipt)';

        $this->load->view('public/header', $data);
        $this->load->view('payment/success', $data);
        $this->load->view('public/footer');
    }

    /**
     * Printable Tax / Membership Invoice
     */
    public function invoice($payment_id = null) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $userId = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($userId);
        $data['payment'] = $this->User_model->get_payment_by_id($payment_id, $userId);

        if (!$data['payment']) {
            $this->session->set_flashdata('error', 'पावती सापडली नाही.');
            redirect('dashboard');
        }

        $data['title'] = 'सदस्यत्व पावती - Invoice #' . str_pad($data['payment']['id'], 6, '0', STR_PAD_LEFT);
        $this->load->view('payment/invoice', $data);
    }
}
