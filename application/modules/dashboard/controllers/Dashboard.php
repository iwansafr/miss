<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->user_model->check_login();
		$this->load->view('index');
	}
	public function list()
	{
		$this->user_model->check_login();
		$this->load->view('index');	
	}
}