<?php defined('BASEPATH') OR exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('siswa_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		$this->load->view('index');
	}

	public function edit($id = 0)
	{
		$data = $this->siswa_model->save($id);
		$this->load->view('index', ['data'=>$data,'gender'=>['0'=>['id'=>'0','title'=>'Perempuan'],'1'=>['id'=>'1','title'=>'Laki-laki']]]);
	}
}