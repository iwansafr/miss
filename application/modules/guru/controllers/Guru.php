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

	public function upload()
	{
		$this->load->view('index');
	}

		public function proc_upload()
	{
		if (!empty($_FILES['doc']['name'])) {
			$file = $this->guru_model->upload($_FILES['doc']);
			// $file['desa_id'] = $_POST['desa_id'];
			$data = ['status' => 'success', 'data' => $file];
			output_json($data);
		} else {
			$data = ['status' => 'error'];
			output_json($data);
		}
	}

	public function insert()
	{
		if (!empty($_POST['file'])) {
			$file = $_POST['file'];
			$file = FCPATH . 'assets/images/modules/guru/' . $file;
			$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
			$reader->setReadDataOnly(TRUE);

			$spreadsheet = $reader->load($file);
			$worksheet = $spreadsheet->getActiveSheet();
			$data = array();
			$title = array();
			$i = 0;
			foreach ($worksheet->getRowIterator() as $row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(FALSE);
				$j = 0;
				foreach ($cellIterator as $cell) {
					if ($i == 0) {
						$title[] = $cell->getValue();
					} else {
						$data[$i][$title[$j]] = $cell->getValue();
					}
					// $data[$i][] = $cell->getValue();
					$j++;
					// $data[$i]['desa_id'] = $desa_id;
				}
				if ($i > 0) {
					$user_input = [
						'username' => $data[$i]['KODE'],
						'password' => '1',
						'email'    => '-',
						'active'   => 0,
						'role'     => [4],
						'nama'     => $data[$i]['NAMA'],
						'gender'   => $data[$i]['GENDER']
					];
					$user_status = $this->user_model->save(0, $user_input);
					$data[$i]['USER_ID'] = $user_status['user_id'];
				}
				$i++;
			}
			if (!empty($data)) {
				if ($this->db->insert_batch('guru', $data)) {
					echo output_json(['status' => 1, 'data' => $data]);
				} else {
					echo output_json(['status' => 0]);
				}
			}
			// echo output_json(array('status' => 1, 'data' => $data));
		}
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
