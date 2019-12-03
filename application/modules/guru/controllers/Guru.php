<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Guru extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('guru_model');
		// $this->load->model('kelas/kelas_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->guru_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}

	public function list()
	{
		$data = $this->guru_model->all();
		$this->load->view('index', ['data' => $data, 'gender' => ['perempuan', 'laki-laki']]);
	}

	public function edit($id = 0)
	{
		$data = $this->guru_model->save($id);
		$this->load->view('index', ['data' => $data, 'gender' => ['0' => ['id' => '0', 'title' => 'Perempuan'], '1' => ['id' => '1', 'title' => 'Laki-laki']]]);
	}
}
