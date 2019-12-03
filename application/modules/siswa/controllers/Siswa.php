<?php defined('BASEPATH') or exit('No direct script access allowed');

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
		$this->load->model('user/user_model');
		$this->load->model('kelas/kelas_model');
	}

	public function proc_upload()
	{
		if (!empty($_FILES['doc']['name'])) {
			$file = $this->siswa_model->upload($_FILES['doc']);
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
			$file = FCPATH . 'assets/images/modules/siswa/' . $file;
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
						'username' => $data[$i]['NISN'],
						'password' => '123456',
						'email'    => '-',
						'active'   => 0,
						'role'     => [4],
						'nama'     => $data[$i]['NAMA'],
						'gender'   => $data[$i]['GENDER']
					];
					$user_status = $this->user_model->save(0, $user_input);
					$data[$i]['user_id'] = $user_status['user_id'];
				}
				$i++;
			}
			if (!empty($data)) {
				if ($this->db->insert_batch('siswa', $data)) {
					echo output_json(['status' => 1, 'data' => $data]);
				} else {
					echo output_json(['status' => 0]);
				}
			}
			// echo output_json(array('status' => 1, 'data' => $data));
		}
	}

	public function upload()
	{
		$this->load->view('index');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function download_template()
	{
		$data = $this->db->list_fields('siswa');
		unset($data[0]);
		$alp = alphabet();
		$tot = count($data);
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('esoftgreat - software development')
			->setLastModifiedBy('esoftgreat - software development')
			->setTitle('Office 2007 XLSX Test Document')
			->setSubject('Office 2007 XLSX Test Document')
			->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
			->setKeywords('office 2007 openxml php')
			->setCategory('Test result file');

		// Add some data
		$i = 0;
		$str = '$spreadsheet->setActiveSheetIndex(0)';
		foreach ($data as $key => $value) {
			$j = $i + 1;
			$str .= '->setCellValue("' . $alp[$i] . '1","' . strtoupper($value) . '")';
			$i++;
		}
		$str .= ';';
		eval($str);
		// var_dump($str);
		// die;
		$spreadsheet->getActiveSheet()->setTitle('template ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="siswa.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	public function opsi()
	{
		$data['data'] = [['nama' => 'RPL'], ['nama' => 'OTKP'], ['nama' => 'TBSM'], ['nama' => 'AKL'], ['nama' => 'BDP']];
		$kelas = $this->siswa_model->kelas();
		$this->load->view('index', ['data' => $data, 'kelas' => $kelas]);
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->siswa_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}

	public function list()
	{

		$kelas = $this->siswa_model->kelas();
		$o_kelas = [];
		foreach ($kelas as $key => $value) {
			$o_kelas[$value['id']] = $value['nama'];
		}

		$agama = ['', 'Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu'];

		$data = $this->siswa_model->all();
		$this->load->view('index', ['data' => $data, 'gender' => ['perempuan', 'laki-laki'], 'kelas_o' => $o_kelas, 'kelas' => $kelas, 'agama' => $agama]);
	}

	public function edit($id = 0)
	{
		$data = $this->siswa_model->save($id);
		$agama = [
			'1' => ['id' => '1', 'title' => 'Islam'],
			'2' => ['id' => '2', 'title' => 'Kristen'],
			'3' => ['id' => '3', 'title' => 'Hindu'],
			'4' => ['id' => '4', 'title' => 'Budha'],
			'5' => ['id' => '5', 'title' => 'Konghucu'],
		];
		$this->load->view('index', ['data' => $data, 'kelas' => $this->kelas_model->all(), 'gender' => ['0' => ['id' => '0', 'title' => 'Perempuan'], '1' => ['id' => '1', 'title' => 'Laki-laki']], 'th_ajaran' => $this->siswa_model->th_ajaran(), 'agama' => $agama]);
	}
}
