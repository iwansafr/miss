<?php defined('BASEPATH') or exit('No direct script access allowed');

class presensi_mapel_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('config/config_model');
		$this->load->model('th_ajaran/th_ajaran_model');
	}

	public function all()
	{
		return $this->db->get('presensi_has_mapel')->result_array();
	}
	public function upload($file = '', $mode = '')
	{
		if (!empty($file['tmp_name'])) {
			$dir = FCPATH . 'assets/images/modules/presensi_has_mapel/';
			if (!is_dir($dir)) {
				mkdir($dir, 0777);
			}
			if (copy($file['tmp_name'], $dir . $_SESSION[str_replace('/', '_', base_url() . '_logged_in')]['username'] . $mode . '.xlsx')) {
				return $_SESSION[str_replace('/', '_', base_url() . '_logged_in')]['username'] . '.xlsx';
			}
		}
	}
	public function save($id = 0)
	{
		$msg = [];
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
		$id_u = get_user()['id'];
		$this->db->select('id');
		$exist = $this->db->get_where('guru', ['user_id' => $id_u])->row_array();
		$find_mhp = $this->db->get_where('guru_has_mapel', ['guru_id' => $exist['id'], 'hari' => $hari_ini, 'jam_mulai <' => $time, 'jam_selesai >=' => $time])->row_array();
		$k = $find_mhp['kelas_id'];
		$tanggal = date('Y-m-d');
		$kode = $find_mhp['guru_id'] . '_' . $find_mhp['mapel_id'] . '_' . $tanggal . '_' . $find_mhp['jam_mulai'] . '_' . $find_mhp['jam_selesai'];
		$q = $this->db->get_where('siswa', ['kelas_id' => $k,])->result_array();
		$th_ajaran = $this->th_ajaran_model->all();
		$c_data = $this->config_model->get_config('th_ajaran');
		$current_data = [];
		$c_th = "";
		if (!empty($c_data)) {
			$current_data = json_decode($c_data['value'], 1);
		}
		foreach ($th_ajaran as $key => $value) {
			if ($value['id'] == $current_data['th_ajaran']) {
				$c_th = $value;
			}
		}
		$q_rows = $this->db->get_where('siswa', ['kelas_id' => $k,])->num_rows();
		$presensi_mapel_rows = $this->db->get_where('presensi_has_mapel', ['kode' => $kode, 'kelas_id' => $k])->num_rows();
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'presensi gagal disimpan, silahkan mengulang kembali'];
			$id_s = $this->input->post('siswa_id');
			$this->db->select('id');
			$id = $this->db->get_where('presensi_has_mapel', ['siswa_id' => $id_s, 'kode' => $kode])->row_array();
			$id = $id['id'];
			$data = $this->input->post();
			$presensi_mapel_input = [
				'siswa_id' => $data['siswa_id'],
				'kelas_id' => $k,
				'th_ajaran_id' => $c_th['id'],
				'keterangan' => $data['keterangan'],
				'tanggal' => $tanggal,
				'guru_id' => $find_mhp['guru_id'],
				'mapel_id' => $find_mhp['mapel_id'],
				'kode' => $kode,
			];
			if ($q_rows != $presensi_mapel_rows) {
				$this->db->delete('presensi_has_mapel', ['kelas_id' => $k, 'kode' => $kode]);
				foreach ($q as $key => $value) {
					$presensi_mapel_input = [
						'siswa_id' => $value['id'],
						'kelas_id' => $value['kelas_id'],
						'th_ajaran_id' => $c_th['id'],
						'keterangan' => '1',
						'tanggal' => $tanggal,
						'guru_id' => $find_mhp['guru_id'],
						'mapel_id' => $find_mhp['mapel_id'],
						'kode' => $kode
					];
					$this->db->insert('presensi_has_mapel', $presensi_mapel_input);
				}
			} else {
				if (!empty($id)) {
					$this->db->select('id');
					$exist = $this->db->get_where('presensi_has_mapel', ['siswa_id' => $id_s, 'kode' => $kode, 'kelas_id' => $k])->row_array();
					$current_user = $this->db->get_where('presensi_has_mapel', ['id' => $id])->row_array();
					if ($current_user['id'] == $exist['id'] || empty($exist)) {
						$this->db->where('id', $id);
						if ($this->db->update('presensi_has_mapel', $presensi_mapel_input)) {
							$msg = ['status' => 'success', 'msg' => 'presensi berhasil disimpan'];
						}
					} else {
						$msg['msgs'][] = 'Gagal edit presensi';
					}
				} else {
					$this->db->select('id');
					$exist =  $this->db->get_where('presensi_has_mapel', ['siswa_id' => $id_s, 'kode' => $kode, 'kelas_id' => $k])->row_array();
					if (empty($exist)) {
						if ($this->db->insert('presensi_has_mapel', $presensi_mapel_input)) {
							$msg = ['status' => 'success', 'msg' => 'presensi berhasil disimpan'];
						}
					} else {
						$msg['msgs'][] = 'Gagal tambah presensi siswa t';
					}
				}
			}
		} elseif (empty($this->input->post())) {
			if ($q_rows != $presensi_mapel_rows) {
				$this->db->delete('presensi_has_mapel', ['kelas_id' => $k, 'kode' => $kode]);
				foreach ($q as $key => $value) {
					$presensi_mapel_input = [
						'siswa_id' => $value['id'],
						'kelas_id' => $value['kelas_id'],
						'th_ajaran_id' => $c_th['id'],
						'keterangan' => '0',
						'tanggal' => $tanggal,
						'guru_id' => $find_mhp['guru_id'],
						'mapel_id' => $find_mhp['mapel_id'],
						'kode' => $kode
					];
					$this->db->insert('presensi_has_mapel', $presensi_mapel_input);
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('presensi_has_mapel', ['id' => $id])->row_array();
		}
		return $msg;
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('presensi_has_mapel', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}
	public function kelas()
	{
		$data = $this->db->get('kelas')->result_array();
		return $data;
	}
	public function guru()
	{
		$data = $this->db->get('guru')->result_array();
		return $data;
	}
	public function mapel()
	{
		$data = $this->db->get('mapel')->result_array();
		return $data;
	}
}
