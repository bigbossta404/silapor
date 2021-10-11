<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['pengguna_co'] = 'pengguna';
$route['login'] = 'auth/index';
$route['pengguna/index'] = 'pengguna_con/index';
$route['pengguna/index/(:any)'] = 'pengguna_con/index/(:any)';
// $route['pengguna/viewLaporan/(:any)'] = 'pengguna_con/viewLaporan/(:any)';
