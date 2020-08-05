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
$route['default_controller'] 	= 'login';
$route['login'] 				= 'login';
$route['logout'] 				= 'login/logout';
$route['forgot-password'] 		= 'Login/forgot';
$route['dashboard'] 			= 'admin/Dashboard';

// banners
$route['banners'] 				= 'admin/Banners';
$route['banners/edit/(.+)'] 	= 'admin/Banners/form';
$route['banners/add'] 			= 'admin/Banners/form';
$route['banners/save'] 			= 'admin/Banners/save';
$route['banners/delete'] 		= 'admin/Banners/delete';
// categories
$route['categories'] 			= 'admin/Category';
$route['categories/edit/(.+)'] 	= 'admin/Category/form';
$route['categories/add'] 		= 'admin/Category/form';
$route['categories/save'] 		= 'admin/Category/save';
$route['categories/delete'] 	= 'admin/Category/delete';
// categories
$route['products'] 				= 'admin/Products';
$route['products/edit/(.+)'] 	= 'admin/Products/form';
$route['products/add'] 			= 'admin/Products/form';
$route['products/save'] 		= 'admin/Products/save';
$route['products/delete'] 		= 'admin/Products/delete';

// farmers
$route['farmers'] 				= 'admin/Farmers';
$route['farmers/edit/(.+)'] 	= 'admin/Farmers/form';
$route['farmers/add'] 			= 'admin/Farmers/form';
$route['farmers/save'] 			= 'admin/Farmers/save';
$route['farmers/delete'] 		= 'admin/Farmers/delete';

// customer
$route['customers'] 		    = 'admin/Customers';
$route['customers/edit/(.+)'] 	= 'admin/Customers/form';
$route['customers/add'] 		= 'admin/Customers/form';
$route['customers/save'] 		= 'admin/Customers/save';
$route['customers/delete'] 		= 'admin/Customers/delete';
$route['customers/check-email'] = 'admin/Customers/checkEmail';

// address
$route['customers/address-list/(.+)'] 	= 'admin/Address';
$route['customers/address/edit/(.+)'] 	= 'admin/Address/form';
$route['customers/address/add/(.+)'] 	= 'admin/Address/form';
$route['customers/address/save'] 		= 'admin/Address/save';
$route['customers/address/delete'] 		= 'admin/Address/delete';

// postcode
$route['postcodes'] 			= 'admin/Postcodes';
$route['postcodes/edit/(.+)'] 	= 'admin/Postcodes/form';
$route['postcodes/add'] 		= 'admin/Postcodes/form';
$route['postcodes/save'] 		= 'admin/Postcodes/save';
$route['postcodes/delete'] 		= 'admin/Postcodes/delete';
$route['postcodes/check-exist'] = 'admin/Postcodes/checkExist';



$route['404_override'] = 'Notfound';
$route['translate_uri_dashes'] = FALSE;
