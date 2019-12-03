<?php defined('BASEPATH') or exit('No direct script access allowed');

class Config extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');
		$this->load->model('th_ajaran/th_ajaran_model');
	}

	public function th_ajaran()
	{
		$data = $this->config_model->save('th_ajaran');
		$current_data = [];
		if (!empty($data)) {
			$current_data = json_decode($data['data']['value'], 1);
		}
		$this->load->view('index', ['th_ajaran' => $this->th_ajaran_model->all(), 'data' => $data, 'current_data' => $current_data]);
	}
	public function list()
	{
		$this->load->view('index');
	}
}
