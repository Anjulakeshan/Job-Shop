<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['migrate'] = 'migration';

$route['users'] = 'users';
$route['login'] = 'authorization/login';
$route['logout'] = 'authorization/logout';
$route['settings'] = 'authorization/settings';
$route['settings'] = 'authorization/settings';
$route['backup'] = 'dashboard/backup';
$route['default_controller'] = 'dashboard/index';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
