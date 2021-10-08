<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'pengguna_con';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['pengguna_co'] = 'pengguna';
$route['index'] = 'pengguna_con/index';
$route['index/(:any)'] = 'pengguna_con/index/(:any)';
