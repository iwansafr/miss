<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class presensi_mapel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('presensi_mapel_model');
	}

	public function proc_upload()
	{
		if (!empty($_FILES['doc']['name'])) {
			$file = $this->presensi_mapel_model->upload($_FILES['doc']);
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
		$data['data'] = $this->presensi_mapel_model->kelas();
		$jurusan = [['nama' => 'RPL'], ['nama' => 'OTKP'], ['nama' => 'TBSM'], ['nama' => 'AKL'], ['nama' => 'BDP']];
		$this->load->view('index', ['data' => $data, 'jurusan' => $jurusan]);
	}

	public function edit($id = 0)
	{
		$day = date ('D');
		$time = date('H:m');

		switch($day){
			case 'Mon':			
			$hari_ini = 1;
			break;
			case 'Tue':
			$hari_ini = 2;
			break;
			case 'Wed':
			$hari_ini = 3;
			break;
			case 'Thu':
			$hari_ini = 4;
			break;
			case 'Fri':
			$hari_ini = 5;
			break;
			default:
			$hari_ini = "Tidak di ketahui";		
			break;
		}
		if($day == 'Sat' || $day == 'Sun'){
			$data['data'] = 'Hari ini hari ' . $day . ' selamat libur.';
			$data['day'] = $day;
			$this->load->view('index', ['data' => $data]);
		}else{
			$id_u = get_user()['id'];
			$this->db->select('id');
			$exist = $this->db->get_where('guru', ['user_id' => $id_u])->row_array();
			$find_mhp = $this->db->get_where('guru_has_mapel', ['guru_id' => $exist['id'], 'hari' => $hari_ini, 'jam_mulai <' => $time, 'jam_selesai >=' => $time])->row_array();
			if(!empty($find_mhp)){
				$data = $this->presensi_mapel_model->save();
				$kelas = $this->presensi_mapel_model->kelas();
				$o_kelas = [];
				foreach ($kelas as $key => $value) {
					$o_kelas[$value['id']] = $value['nama'];
				}
				$guru = $this->presensi_mapel_model->guru();
				$o_guru = [];
				foreach ($guru as $key => $value) {
					$o_guru[$value['id']] = $value['nama'];
				}
				$mapel = $this->presensi_mapel_model->mapel();
				$o_mapel = [];
				foreach ($mapel as $key => $value) {
					$o_mapel[$value['id']] = $value['nama'];
				}
				$k = $find_mhp['kelas_id'];
				$tanggal = date('Y-m-d');
				$kode = $find_mhp['guru_id'] . '_' . $find_mhp['mapel_id'] . '_' . $tanggal . '_' . $find_mhp['jam_mulai'] . '_' . $find_mhp['jam_selesai'];
				$data['data'] = $this->db->get_where('siswa', ['kelas_id' => $k,])->result_array();
				$presensi = $this->db->get_where('presensi_has_mapel', ['kelas_id' => $k, 'kode' => $kode])->result_array();
				$ket = [
					'0' => ['id' => '0', 'title' => '-', 'color' => 'btn-info'],
					'1' => ['id' => '1', 'title' => 'Berangkat', 'color' => 'btn-primary'],
					'2' => ['id' => '2', 'title' => 'Ijin', 'color' => 'btn-warning'],
					'3' => ['id' => '3', 'title' => 'Absen', 'color' => 'btn-danger'],
				];
				$this->load->view('index', ['data' => $data, 'ket' => $ket, 'presensi' => $presensi, 'kelas' => $o_kelas, 'guru' => $o_guru, 'mapel' => $o_mapel, 'find_mhp' => $find_mhp]);
			}else{
				$data['data'] = 'presensi null';
				$this->load->view('index', ['data' => $data]);
			}
		}
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->presensi_mapel_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}

	public function qr()
	{
		$kelas = $this->presensi_mapel_model->kelas();
		$this->load->view('index',['kelas'=>$kelas]);
	}
	public function qrcode($id = 0)
	{
		if(!empty($id))
		{
			include APPPATH.'third_party/phpqrcode/qrlib.php';
			QRcode::png(base_url('presensi_mapel/edit/'.$id));
		}
	}
}
