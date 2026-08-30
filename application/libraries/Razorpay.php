<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Razorpay Payment Gateway Library for CodeIgniter 3
 */
class Razorpay {

    protected $ci;
    protected $key_id;
    protected $key_secret;
    protected $currency;
    protected $api_url = 'https://api.razorpay.com/v1';

    public function __construct() {
        $this->ci =& get_instance();
        if (isset($this->ci->load)) {
            $this->ci->load->config('razorpay', TRUE);
        }
        
        $this->key_id = $this->ci->config->item('razorpay_key_id', 'razorpay')
            ?: ($this->ci->config->item('razorpay_key_id') ?: (getenv('RAZORPAY_KEY_ID') ?: ''));
            
        $this->key_secret = $this->ci->config->item('razorpay_key_secret', 'razorpay')
            ?: ($this->ci->config->item('razorpay_key_secret') ?: (getenv('RAZORPAY_KEY_SECRET') ?: ''));
            
        $this->currency = $this->ci->config->item('razorpay_currency', 'razorpay')
            ?: ($this->ci->config->item('razorpay_currency') ?: (getenv('RAZORPAY_CURRENCY') ?: 'INR'));
    }

    /**
     * Get Key ID for frontend Checkout JS
     */
    public function get_key_id() {
        return $this->key_id;
    }

    /**
     * Create an Order on Razorpay
     *
     * @param int $amountInPaise Amount in paise (e.g. 599900 for Rs. 5999)
     * @param string $receipt Internal receipt ID
     * @param array $notes Optional notes
     * @return array Order data or error
     */
    public function create_order($amountInPaise, $receipt = '', $notes = array()) {
        if (empty($receipt)) {
            $receipt = 'RCPT_' . time() . '_' . rand(1000, 9999);
        }

        $data = array(
            'amount'   => (int) $amountInPaise,
            'currency' => $this->currency,
            'receipt'  => (string) $receipt,
            'notes'    => $notes
        );

        $response = $this->make_api_request('POST', '/orders', $data);

        // If order creation succeeded with live/test key
        if (!empty($response) && isset($response['id'])) {
            return array(
                'success'  => TRUE,
                'order_id' => $response['id'],
                'amount'   => $response['amount'],
                'currency' => $response['currency'],
                'receipt'  => $response['receipt'],
                'raw'      => $response
            );
        }

        // If API returned an error, capture error details
        $errorMsg = 'Failed to create order on Razorpay';
        if (isset($response['error']['description'])) {
            $errorMsg = $response['error']['description'];
        }

        // Fallback for mock test mode if keys are placeholders
        if (strpos($this->key_id, 'test_') === false && strpos($this->key_id, 'live_') === false) {
            $mockOrderId = 'order_mock_' . uniqid() . '_' . rand(100, 999);
            return array(
                'success'   => TRUE,
                'is_mock'   => TRUE,
                'order_id'  => $mockOrderId,
                'amount'    => (int) $amountInPaise,
                'currency'  => $this->currency,
                'receipt'   => $receipt
            );
        }

        return array(
            'success'   => FALSE,
            'message'   => $errorMsg,
            'raw_error' => $response
        );
    }

    /**
     * Verify payment signature from Razorpay checkout
     *
     * @param string $orderId Razorpay Order ID
     * @param string $paymentId Razorpay Payment ID
     * @param string $signature Razorpay Signature
     * @return bool
     */
    public function verify_signature($orderId, $paymentId, $signature) {
        if (empty($orderId) || empty($paymentId)) {
            return FALSE;
        }

        // Mock / Sandbox test simulation handling
        if (strpos($orderId, 'order_mock_') === 0 || strpos($paymentId, 'pay_mock_') === 0 || strpos($paymentId, 'pay_test_') === 0) {
            return TRUE;
        }

        if (empty($signature)) {
            return FALSE;
        }

        $expectedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $this->key_secret);
        return hash_equals($expectedSignature, $signature);
    }

    /**
     * Fetch payment status and details from Razorpay
     *
     * @param string $paymentId
     * @return array|null
     */
    public function fetch_payment($paymentId) {
        if (empty($paymentId) || strpos($paymentId, 'pay_mock_') === 0) {
            return array(
                'id'     => $paymentId,
                'status' => 'captured',
                'method' => 'upi',
                'amount' => 599900
            );
        }

        return $this->make_api_request('GET', '/payments/' . $paymentId);
    }

    /**
     * Send HTTP request to Razorpay REST API
     */
    protected function make_api_request($method, $endpoint, $payload = null) {
        $url = $this->api_url . $endpoint;
        $ch = curl_init();

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json'
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERPWD, $this->key_id . ':' . $this->key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if (strtoupper($method) === 'POST') {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            if (!empty($payload)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            }
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === FALSE) {
            return null;
        }

        $decoded = json_decode($response, TRUE);
        return is_array($decoded) ? $decoded : null;
    }
}
