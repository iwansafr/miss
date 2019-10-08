<?php defined('BASEPATH') OR exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class th_ajaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('th_ajaran_model');
	}

	public function upload()
	{
		$this->load->view('index');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		$data = $this->th_ajaran_model->save();
		$data['data'] = $this->th_ajaran_model->all();
		$this->load->view('index',['data'=>$data]);
	}

	public function edit($id = 0)
	{
		if(!empty($id))
		{
			$data = $this->th_ajaran_model->save($id);
			$this->load->view('index', ['data'=>$data]);
		}

	}
	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->th_ajaran_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}	
}