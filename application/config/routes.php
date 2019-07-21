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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'frontend/home';
$route['404_override'] = 'error/error404';
$route['translate_uri_dashes'] = FALSE;
//crud
$route['backend/mpampam-crud'] = "mpampam_crud";
//login
$route['adm-panel'] = "login";
$route['adm-logout'] = "login/logout";

$route['backend'] = "backend/home";
//menus
$route['backend/menus'] = "backend/backend/menus";
$route['backend/menus/tambah'] = "backend/backend/menus/tambah";
$route['backend/menus/tambah/aksi'] = "backend/backend/menus/tambah/aksi";
$route['backend/menus/edit/(:num)'] = "backend/backend/menus/edit/$1";
$route['backend/menus/edit/(:num)/aksi'] = "backend/backend/menus/edit/$1/aksi";
$route['backend/menus/hapus/(:num)'] = "backend/backend/menus/hapus/$1";
$route['backend/menus/save'] = "backend/backend/menus/save";
$route['backend/menus/icon'] = "backend/backend/menus/icon";

//Groups
$route['backend/groups'] = "backend/backend/groups";
$route['backend/groups/json'] = "backend/backend/groups/json";
$route['backend/groups/detail/(:num)'] = "backend/backend/groups/detail/$1";
$route['backend/groups/tambah'] = "backend/backend/groups/tambah";
$route['backend/groups/tambah/aksi'] = "backend/backend/groups/tambah/aksi";
$route['backend/groups/edit/(:num)'] = "backend/backend/groups/edit/$1";
$route['backend/groups/edit/(:num)/aksi'] = "backend/backend/groups/edit/$1/aksi";
$route['backend/groups/hapus/(:num)'] = "backend/backend/groups/hapus/$1";

//file manager
$route['backend/file_manager/(:any)'] = "backend/backend/file_manager/index/$1";
$route['backend/file_manager/json/(:any)'] = "backend/backend/file_manager/json/$1";
$route['backend/file_manager/do_upload/(:any)'] = "backend/backend/file_manager/do_upload/$1";
$route['backend/file_manager/remove_img/(:any)/(:any)'] = "backend/backend/file_manager/remove_img/$1/$2";

//users
$route['backend/users'] = "backend/backend/users";
$route['backend/users/json'] = "backend/backend/users/json";
$route['backend/users/detail/(:num)'] = "backend/backend/users/detail/$1";
$route['backend/users/tambah'] = "backend/backend/users/tambah";
$route['backend/users/tambah/aksi'] = "backend/backend/users/tambah/aksi";
$route['backend/users/edit/(:num)'] = "backend/backend/users/edit/$1";
$route['backend/users/edit/(:num)/aksi'] = "backend/backend/users/edit/$1/aksi";
$route['backend/users/hapus/(:num)'] = "backend/backend/users/hapus/$1";
$route['backend/users/resetpwd/(:num)'] = "backend/backend/users/resetpwd/$1";
$route['backend/users/resetpwd/(:num)/aksi'] = "backend/backend/users/resetpwd/$1/aksi";

//pengaturan
$route['backend/pengaturan'] = "backend/backend/pengaturan";
$route['backend/pengaturan/umum'] = "backend/backend/pengaturan/umum";
$route['backend/pengaturan/umum_form'] = "backend/backend/pengaturan/umum_form";
$route['backend/pengaturan/umum_form/aksi'] = "backend/backend/pengaturan/umum_form/aksi";
$route['backend/pengaturan/logo'] = "backend/backend/pengaturan/logo";
$route['backend/pengaturan/logo_action/(:any)'] = "backend/backend/pengaturan/logo_action/$1";
$route['backend/pengaturan/meta_seo'] = "backend/backend/pengaturan/meta_seo";
$route['backend/pengaturan/meta_action'] = "backend/backend/pengaturan/meta_action";
$route['backend/pengaturan/widget'] = "backend/backend/pengaturan/widget";
$route['backend/pengaturan/widget_action'] = "backend/backend/pengaturan/widget_action";


//reset_pwd
$route['backend/resetpwd'] = "backend/backend/resetpwd";
$route['backend/resetpwd/action'] = "backend/backend/resetpwd/action";


//FRONTEND
$route['home'] = "frontend/home";
//news
$route['news'] = "frontend/news";
$route['news/page/(:num)'] = "frontend/news/json_pagination/$1";
$route['news/detail/(:num)/(:any)'] = "frontend/news/detail/$1/$2";
//contact
$route['contact'] = "frontend/contact";
