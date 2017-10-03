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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['blogs/enterPassword_validation'] = 'blogs/enterPassword_validation';
$route['blogs/enterPassword'] = 'blogs/enterPassword';
$route['blogs/validate_comment'] = 'blogs/validate_comment';
$route['blogs/own_blogs'] = 'blogs/own_blogs';
$route['blogs/update_user'] = 'blogs/update_user';
$route['blogs/send_recovery'] = 'blogs/send_recovery';
$route['blogs/recover_password'] = 'blogs/recover_password';
$route['blogs/usersettings'] = 'blogs/usersettings';
$route['blogs/insert_comment'] = 'blogs/insert_comment';
$route['blogs/deleteBlog'] = 'blogs/deleteBlog';
$route['blogs/edit_blog'] = 'blogs/edit_blog';
$route['blogs/editBlog'] = 'blogs/editBlog';
$route['blogs/loadBlog'] = 'blogs/loadBlog';
$route['blogs/results'] = 'blogs/results';
$route['blogs/logout'] = 'blogs/logout';
$route['blogs/enter'] = 'blogs/enter';
$route['blogs/update_validation'] = 'blogs/update_validation';
$route['blogs/create_validation'] = 'blogs/create_validation';
$route['blogs/login_validation'] = 'blogs/login_validation';
$route['blogs/signup_validation'] = 'blogs/signup_validation';
$route['blogs/signup'] = 'blogs/signup';
$route['blogs/login'] = 'blogs/login';
$route['blogs/editBlog'] = 'blogs/editBlog';
$route['blogs/create'] = 'blogs/create';
$route['default_controller'] = 'blogs';
$route['404_override'] = 'blogs/notfound';
$route['translate_uri_dashes'] = FALSE;
