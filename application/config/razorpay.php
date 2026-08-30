<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Load .env File Helper
|--------------------------------------------------------------------------
*/
if (!function_exists('load_env')) {
    function load_env($envPath = null) {
        if (!$envPath) {
            $envPath = (defined('FCPATH') ? FCPATH : __DIR__ . '/../../') . '.env';
            if (!file_exists($envPath)) {
                $envPath = dirname(APPPATH) . DIRECTORY_SEPARATOR . '.env';
            }
        }
        if (!file_exists($envPath)) {
            return;
        }
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key   = trim($key);
                $value = trim($value, " \t\n\r\0\x0B\"'");
                $_SERVER[$key] = $value;
                $_ENV[$key]    = $value;
                putenv("{$key}={$value}");
            }
        }
    }
}

// Load environment variables from .env
load_env();

$getEnvVal = function($key, $default = '') {
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
        return $_ENV[$key];
    }
    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
        return $_SERVER[$key];
    }
    $v = getenv($key);
    return ($v !== false && $v !== '') ? $v : $default;
};

/*
|--------------------------------------------------------------------------
| Razorpay Payment Gateway Configuration
|--------------------------------------------------------------------------
*/
$config['razorpay_key_id']     = $getEnvVal('RAZORPAY_KEY_ID', 'rzp_test_TVCMJpyEBuL5rd');
$config['razorpay_key_secret'] = $getEnvVal('RAZORPAY_KEY_SECRET', 'nfjZXaX7V6YFCkUvZq94wmUd');

$planAmount = (float) $getEnvVal('RAZORPAY_AMOUNT', 5999.00);
$currency   = $getEnvVal('RAZORPAY_CURRENCY', 'INR');

$config['razorpay_currency']       = $currency;
$config['razorpay_amount']         = $planAmount;
$config['razorpay_amount_paise']   = (int) ($planAmount * 100);

$config['razorpay_plan_name']      = 'Lifetime Premium Membership';
$config['razorpay_plan_title_mr']  = 'आजीवन सदस्यत्व';
$config['razorpay_company_name']   = 'मराठी विवाह संस्था';
$config['razorpay_company_desc']   = 'One-Time Payment - ₹' . number_format($planAmount, 0);
$config['razorpay_theme_color']    = '#f97316';

$config['pricing_features'] = array(
    '100% सत्यापित प्रोफाईल्स प्रवेश',
    'अमर्यादित संपर्क क्रमांक व WhatsApp',
    'कुटुंबातील सदस्यांची संपूर्ण नोंदणी',
    'आजीवन वैधता - कोणतेही मासिक/वार्षिक शुल्क नाही'
);
