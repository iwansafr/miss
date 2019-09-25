<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->user_model->check_login();

$this->load->view('sb-admin/index');