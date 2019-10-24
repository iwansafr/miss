<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		// $this->check_login();
	}

	public function index()
	{

	}

	public function check_login()
	{
		$this->user_model->check_login();
	}

	public function login()
	{
		$this->load->view('user/login',['data'=>$this->user_model->login()]);
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}

	public function edit($id = 0)
	{
		$data = $this->user_model->save($id);

		
		$this->load->library('upload');
		// $data['photo'] = $this->upload->data('photo');
		$this->load->view('index',['data'=>$data,'role'=>$this->user_model->role_all()]);
	}
	public function list()
	{
		$data = $this->user_model->all();
		$this->load->view('index', ['data'=>$data]);
	}

	public function role()
	{
		$data = $this->user_model->role_save();
		$data['data'] = $this->user_model->role_all();
		$this->load->view('index',['data'=>$data]);
	}

	public function role_edit($id = 0)
	{
		if(!empty($id))
		{
			$data = $this->user_model->role_save($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}

	public function role_delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->user_model->role_delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->user_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}
}