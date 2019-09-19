<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->check_login();
	}

	public function index()
	{

	}

	public function check_login()
	{
		$this->user_model->check_login();
	}
}