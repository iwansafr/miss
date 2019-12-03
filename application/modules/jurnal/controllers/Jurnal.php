<?php defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Jurnal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jurnal_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function list()
	{
		$data = $this->jurnal_model->save();
		$data['data'] = $this->jurnal_model->all();
		$this->load->view('index', ['data' => $data]);
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
			$hari_ini = null;		
			break;
		}
		$data = $this->jurnal_model->save($id);
		$id_u = get_user()['id'];
		$exist = $this->db->get_where('guru', ['user_id' => $id_u])->row_array();
		$find_mhp = $this->db->get_where('guru_has_mapel', ['guru_id' => $exist['id'], 'hari' => $hari_ini, 'jam_mulai <' => $time, 'jam_selesai >=' => $time])->row_array();
		$tanggal = date('Y-m-d');
		$kode = $find_mhp['guru_id'] . '_' . $find_mhp['mapel_id'] . '_' . $tanggal . '_' . $find_mhp['jam_mulai'] . '_' . $find_mhp['jam_selesai'];
		$check_jurnal = $this->db->get_where('jurnal', ['kode' => $kode])->row_array();

		$mapel = $this->jurnal_model->mapel();
		$o_mapel = [];
		foreach ($mapel as $key => $value) {
			$o_mapel[$value['id']] = $value['nama'];
		}

		$kelas = $this->jurnal_model->kelas();
		$o_kelas = [];
		foreach ($kelas as $key => $value) {
			$o_kelas[$value['id']] = $value['nama'];
		}

		$this->load->view('index', ['data' => $data, 'guru' => $exist, 'guru_has_mapel' => $find_mhp, 'check_jurnal' => $check_jurnal, 'mapel' => $o_mapel, 'kelas' => $o_kelas]);
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->jurnal_model->delete($id);
			$this->load->view('index', ['data' => $data]);
		}
	}
}
