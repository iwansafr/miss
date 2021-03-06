<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class presensi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('presensi_model');
	}

	public function proc_upload()
	{
		if (!empty($_FILES['doc']['name'])) {
			$file = $this->presensi_model->upload($_FILES['doc']);
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
			$file = FCPATH . 'assets/images/modules/presensi/' . $file;
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
				$i++;
			}
			if (!empty($data)) {
				if ($this->db->insert_batch('presensi', $data)) {
					echo output_json(['status' => 1]);
				} else {
					echo output_json(['status' => 0]);
				}
			}
			// echo output_json(array('status'=>1,'data'=>$data));
		}
	}

	public function upload()
	{
		$this->load->view('index');
	}

	public function download_template()
	{
		$data = $this->db->list_fields('presensi');
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
		header('Content-Disposition: attachment;filename="presensi.xlsx"');
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

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		if (!is_petugas() || !is_siswa()) {
			$data['data'] = $this->presensi_model->kelas();
			$jurusan = [['nama' => 'RPL'], ['nama' => 'OTKP'], ['nama' => 'TBSM'], ['nama' => 'AKL'], ['nama' => 'BDP']];
			$this->load->view('index', ['data' => $data, 'jurusan' => $jurusan]);
		}else{
			$link = str_replace('/', '_', base_url());
			$id_u = $_SESSION[$link.'_logged_in']['id'];
			$this->db->select('kelas_id');
			$find_siswa = $this->db->get_where('siswa', ['user_id' => $id_u])->row_array();
			redirect('http://localhost/miss/presensi/edit?k=' . $find_siswa['kelas_id']);
		}
	}

	public function edit($id = 0)
	{
		$day = date ('D');
		$data = [];				
		$ket = [];				
		$presensi = [];				
		$o_kelas = [];				
		$k = $this->input->get('k');
		if($day == 'Sat' || $day == 'Sun'){
			$data['data'] = 'Hari ini hari ' . $day . ' selamat libur.';
			$this->load->view('index', ['data' => $data]);
		}else{
			$is_ketua_kelas = is_ketua_kelas();
			if($is_ketua_kelas)
			{
				$base_url = str_replace('/','_',base_url());
				$is_in_class = $this->db->get_where('siswa',['nisn'=>$this->session->userdata($base_url.'_logged_in')['username']])->row_array();
				if(@$is_in_class['kelas_id'] == $k)
				{
					$data = $this->presensi_model->save();
					$kelas = $this->presensi_model->kelas();
					$o_kelas = [];
					foreach ($kelas as $key => $value) {
						$o_kelas[$value['id']] = $value['nama'];
					}
					$data['data'] = $this->db->get_where('siswa', ['kelas_id' => $k,])->result_array();
					$presensi = $this->db->get_where('presensi', ['kelas_id' => $k, 'tanggal' => date('Y-m-d')])->result_array();
					$ket = [
						'0' => ['id' => '0', 'title' => '-', 'color' => 'btn-info'],
						'1' => ['id' => '1', 'title' => 'Berangkat', 'color' => 'btn-primary'],
						'2' => ['id' => '2', 'title' => 'Ijin', 'color' => 'btn-warning'],
						'3' => ['id' => '3', 'title' => 'Absen', 'color' => 'btn-danger'],
					];
				}
			}
			$this->load->view('index', ['data' => $data, 'ket' => $ket, 'presensi' => $presensi, 'kelas' => $o_kelas,'is_ketua_kelas'=>$is_ketua_kelas]);
		}
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->presensi_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}

	public function qr()
	{
		$kelas = $this->presensi_model->kelas();
		$this->load->view('index',['kelas'=>$kelas]);
	}
	public function qrcode($id = 0)
	{
		if(!empty($id))
		{
			include APPPATH.'third_party/phpqrcode/qrlib.php';
			QRcode::png(base_url('presensi/edit/'.$id));
		}
	}
}
