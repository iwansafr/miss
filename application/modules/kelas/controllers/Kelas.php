<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kelas_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		$data = $this->kelas_model->save();
		$data['data'] = $this->kelas_model->all();
		$this->load->view('index',['data'=>$data]);
	}

	public function edit($id = 0)
	{
		if(!empty($id))
		{
			$data = $this->kelas_model->save($id);
			$this->load->view('index', ['data'=>$data]);
		}

	}
	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->kelas_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}	
}