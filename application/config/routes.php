<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'dashboard/list';
$route['login']                = 'user/login';
$route['logout']               = 'user/logout';
$route['kelas']                = 'kelas/list';
$route['mapel']                = 'mapel/list';
$route['siswa']                = 'siswa/list';
$route['guru_mapel']           = 'guru_mapel/list';
$route['guru']                 = 'guru/list';
$route['th_ajaran']            = 'th_ajaran/list';
$route['presensi']             = 'presensi/list';
$route['presensi_mapel']       = 'presensi_mapel/edit';
$route['jurnal']       = 'jurnal/edit';
$route['config']               = 'config/list';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;
