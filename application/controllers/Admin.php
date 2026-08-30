<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        
        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('X-Frame-Options: SAMEORIGIN');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
    }

    /**
     * Verify if current user is logged in as Super Admin
     */
    protected function check_admin_auth() {
        $isAdmin = $this->session->userdata('admin_logged_in');
        $role = $this->session->userdata('role');

        if (!$isAdmin || $role !== 'admin') {
            $this->session->set_flashdata('error', 'कृपया सुपर ॲडमिन म्हणून लॉगिन करा.');
            redirect('admin/login');
        }
    }

    /**
     * Super Admin Dashboard Overview (/admin)
     */
    public function index() {
        $this->check_admin_auth();

        $data['title'] = 'Super Admin Dashboard';
        $data['active_menu'] = 'dashboard';
        
        // Fetch summary metrics
        $data['stats'] = $this->User_model->get_admin_stats();
        $data['current_price'] = $this->User_model->get_setting('plan_price', '5999');

        // Recent 8 registered users
        $data['recent_users'] = $this->User_model->get_admin_users('', '', '', 8, 0);

        // Recent 8 payments
        $data['recent_payments'] = $this->User_model->get_all_payments_admin(8, 0);

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }

    /**
     * Dashboard alias
     */
    public function dashboard() {
        $this->index();
    }

    /**
     * Super Admin Login
     */
    public function login() {
        if ($this->session->userdata('admin_logged_in') && $this->session->userdata('role') === 'admin') {
            redirect('admin');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|trim');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() === TRUE) {
                $email = $this->input->post('email', TRUE);
                $password = $this->input->post('password');

                $user = $this->User_model->get_user_by_email($email);

                if ($user && password_verify($password, $user['password'])) {
                    if (isset($user['role']) && $user['role'] === 'admin') {
                        $this->session->sess_regenerate();
                        $sessionData = array(
                            'user_id'         => $user['id'],
                            'name'            => $user['name'],
                            'email'           => $user['email'],
                            'role'            => 'admin',
                            'admin_logged_in' => TRUE,
                            'logged_in'       => TRUE
                        );
                        $this->session->set_userdata($sessionData);
                        $this->session->set_flashdata('success', 'सुपर ॲडमिन पोर्टलवर आपले स्वागत आहे!');
                        redirect('admin');
                    } else {
                        $this->session->set_flashdata('error', 'प्रवेश नाकारला: हे खाते ॲडमिन अधिकार असलेले नाही.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'अवैध ईमेल किंवा पासवर्ड.');
                }
            } else {
                $this->session->set_flashdata('error', validation_errors(' ', ' '));
            }
        }

        $data['title'] = 'Super Admin Login';
        $this->load->view('admin/login', $data);
    }

    /**
     * Super Admin Logout
     */
    public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        $this->session->unset_userdata('role');
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    /**
     * User Management Page (/admin/users)
     */
    public function users() {
        $this->check_admin_auth();

        $data['title'] = 'वापरकर्ते व्यवस्थापन (User Management)';
        $data['active_menu'] = 'users';

        // Filters
        $search     = $this->input->get('search', TRUE) ?: '';
        $status     = $this->input->get('status', TRUE) ?: '';
        $visibility = $this->input->get('visibility', TRUE);

        $data['search']     = $search;
        $data['status']     = $status;
        $data['visibility'] = $visibility;

        // Fetch users
        $data['users'] = $this->User_model->get_admin_users($search, $status, $visibility, 100, 0);
        $data['total_count'] = $this->User_model->count_admin_users($search, $status, $visibility);

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/templates/footer');
    }

    /**
     * View Detailed User Profile (/admin/user/:id)
     */
    public function user_detail($user_id = null) {
        $this->check_admin_auth();

        if (empty($user_id)) {
            redirect('admin/users');
        }

        $user = $this->User_model->get_user_by_id($user_id);
        if (!$user) {
            $this->session->set_flashdata('error', 'वापरकर्ता सापडला नाही.');
            redirect('admin/users');
        }

        $data['user'] = $user;
        $data['members'] = $this->User_model->get_members($user_id);
        $data['payments'] = $this->User_model->get_user_payments($user_id);
        $data['title'] = 'वापरकर्ता तपशील: ' . $user['name'];
        $data['active_menu'] = 'users';

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/user_detail', $data);
        $this->load->view('admin/templates/footer');
    }

    /**
     * AJAX: Toggle Public Search Visibility
     */
    public function toggle_visibility() {
        $this->output->set_content_type('application/json');

        if (!$this->session->userdata('admin_logged_in')) {
            echo json_encode(array('status' => 'error', 'message' => 'Unauthorized access.'));
            return;
        }

        $userId = $this->input->post('user_id', TRUE);
        $isVisible = (int) $this->input->post('is_visible', TRUE);

        if (empty($userId)) {
            echo json_encode(array('status' => 'error', 'message' => 'User ID is required.'));
            return;
        }

        if ($this->User_model->toggle_user_visibility($userId, $isVisible)) {
            $statusText = $isVisible ? 'सक्रिय (Visible in Search)' : 'लपवलेले (Hidden from Search)';
            echo json_encode(array(
                'status'     => 'success',
                'is_visible' => $isVisible,
                'message'    => "वापरकर्त्याची दृश्यमानता यशस्वीरीत्या बदलली: {$statusText}."
            ));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update visibility.'));
        }
    }

    /**
     * AJAX: Manually Toggle or Update Payment Status
     */
    public function toggle_payment() {
        $this->output->set_content_type('application/json');

        if (!$this->session->userdata('admin_logged_in')) {
            echo json_encode(array('status' => 'error', 'message' => 'Unauthorized access.'));
            return;
        }

        $userId = $this->input->post('user_id', TRUE);
        $status = $this->input->post('payment_status', TRUE) ?: 'paid';

        if (empty($userId)) {
            echo json_encode(array('status' => 'error', 'message' => 'User ID is required.'));
            return;
        }

        $planAmount = (float)$this->User_model->get_setting('plan_price', 5999.00);
        if ($this->User_model->update_payment_status($userId, $status, $planAmount)) {
            $statusLabel = ($status === 'paid') ? "Paid (₹" . number_format($planAmount, 0) . " Active)" : 'Unpaid';
            echo json_encode(array(
                'status'         => 'success',
                'payment_status' => $status,
                'message'        => "पेमेंट स्थिती अपडेट झाली: {$statusLabel}."
            ));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update payment status.'));
        }
    }

    /**
     * Payments Transaction Log (/admin/payments)
     */
    public function payments() {
        $this->check_admin_auth();

        $data['title'] = 'पेमेंट व्यवहार (Payment Transactions)';
        $data['active_menu'] = 'payments';
        $data['payments'] = $this->User_model->get_all_payments_admin(100, 0);

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/payments', $data);
        $this->load->view('admin/templates/footer');
    }

    /**
     * Pricing & Portal Settings (/admin/settings)
     */
    public function settings() {
        $this->check_admin_auth();

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('plan_price', 'Plan Price', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('original_price', 'Original Price', 'numeric');
            $this->form_validation->set_rules('plan_title', 'Plan Title', 'required|trim');
            $this->form_validation->set_rules('plan_subtitle', 'Plan Subtitle', 'trim');

            if ($this->form_validation->run() === TRUE) {
                $planPrice     = $this->input->post('plan_price', TRUE);
                $originalPrice = $this->input->post('original_price', TRUE);
                $planTitle     = $this->input->post('plan_title', TRUE);
                $planSubtitle  = $this->input->post('plan_subtitle', TRUE);

                $this->User_model->set_setting('plan_price', $planPrice);
                $this->User_model->set_setting('original_price', $originalPrice);
                $this->User_model->set_setting('plan_title', $planTitle);
                $this->User_model->set_setting('plan_subtitle', $planSubtitle);

                $this->session->set_flashdata('success', "किंमत व योजना सेटिंग्ज यशस्वीरीत्या अपडेट झाल्या! नवीन किंमत: ₹" . number_format($planPrice, 0));
                redirect('admin/settings');
            } else {
                $this->session->set_flashdata('error', validation_errors(' ', ' '));
            }
        }

        $data['title']          = 'किंमत व योजना सेटिंग्ज (Set Plan Price)';
        $data['active_menu']    = 'settings';
        $data['plan_price']     = $this->User_model->get_setting('plan_price', '5999');
        $data['original_price'] = $this->User_model->get_setting('original_price', '12999');
        $data['plan_title']     = $this->User_model->get_setting('plan_title', 'आजीवन प्रीमियम सदस्यत्व');
        $data['plan_subtitle']  = $this->User_model->get_setting('plan_subtitle', 'एकदाच भरा आणि आयुष्यभर वापरा');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/templates/footer');
    }
}
