<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['home'] = 'home';
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['dashboard'] = 'auth/dashboard';
$route['logout'] = 'auth/logout';
$route['member/add'] = 'auth/member_form/add';
$route['member/self'] = 'auth/member_form/self';
$route['member/edit/(:num)'] = 'auth/member_form/edit/$1';
$route['search'] = 'home/search';

// Razorpay Payment & Pricing routes
$route['pricing'] = 'payment/pricing';
$route['payment'] = 'payment/pricing';
$route['payment/create_order'] = 'payment/create_order';
$route['payment/verify'] = 'payment/verify';
$route['payment/success'] = 'payment/success';
$route['payment/success/(:num)'] = 'payment/success/$1';
$route['payment/invoice/(:num)'] = 'payment/invoice/$1';

// Super Admin Routes
$route['admin'] = 'admin/index';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';
$route['admin/users'] = 'admin/users';
$route['admin/user/(:num)'] = 'admin/user_detail/$1';
$route['admin/payments'] = 'admin/payments';
$route['admin/settings'] = 'admin/settings';
$route['admin/toggle_visibility'] = 'admin/toggle_visibility';
$route['admin/toggle_payment'] = 'admin/toggle_payment';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


