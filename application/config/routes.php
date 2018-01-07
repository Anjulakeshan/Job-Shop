<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['migrate'] = 'migration';

$route['received/pending'] = 'received/pending_jobs';
$route['received/waiting'] = 'received/received_jobs';
$route['received'] = 'received/index';
$route['requests'] = 'request/index';
$route['users'] = 'users';
$route['login'] = 'authorization/login';
$route['logout'] = 'authorization/logout';
$route['settings'] = 'authorization/settings';
$route['settings'] = 'authorization/settings';
$route['backup'] = 'dashboard/backup';
$route['default_controller'] = 'dashboard/index';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
