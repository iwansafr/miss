<?php defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('rekap_model');
	}

	public function index(){
		$this->load->view('index');
	}
	public function kehadiran_guru(){
		$data['data'] = $this->rekap_model->jadwal();
		$this->load->view('index',$data);
	}
}