<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard/list';
$route['login'] = 'user/login';
$route['kelas'] = 'kelas/list';
$route['siswa'] = 'siswa/list';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
