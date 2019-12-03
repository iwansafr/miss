<?php defined('BASEPATH') or exit('No direct script access allowed');

class presensi_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('config/config_model');
		$this->load->model('th_ajaran/th_ajaran_model');
	}

	public function all()
	{
		return $this->db->get('presensi')->result_array();
	}
	public function upload($file = '', $mode = '')
	{
		if (!empty($file['tmp_name'])) {
			$dir = FCPATH . 'assets/images/modules/presensi/';
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
		$k = $this->input->get('k');
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
		$tanggal = date('Y-m-d');
		$q_rows = $this->db->get_where('siswa', ['kelas_id' => $k,])->num_rows();
		$presensi_rows = $this->db->get_where('presensi', ['kelas_id' => $k, 'tanggal' => $tanggal])->num_rows();
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'presensi gagal disimpan, silahkan mengulang kembali'];
			$id_s = $this->input->post('siswa_id');
			$this->db->select('id');
			$id = $this->db->get_where('presensi', ['siswa_id' => $id_s, 'tanggal' => $tanggal])->row_array();
			$id = $id['id'];
			$data = $this->input->post();
			$presensi_input = [
				'siswa_id' => $data['siswa_id'],
				'kelas_id' => $data['kelas_id'],
				'th_ajaran_id' => $c_th['id'],
				'keterangan' => $data['keterangan'],
				'tanggal' => $tanggal
			];
			if ($q_rows != $presensi_rows) {
				$this->db->delete('presensi', ['kelas_id' => $k, 'tanggal' => date('Y-m-d')]);
				foreach ($q as $key => $value) {
					$presensi_input = [
						'siswa_id' => $value['id'],
						'kelas_id' => $value['kelas_id'],
						'th_ajaran_id' => $c_th['id'],
						'keterangan' => '0',
						'tanggal' => $tanggal
					];
					$this->db->insert('presensi', $presensi_input);
				}
			} else {
				if (!empty($id)) {
					$this->db->select('id');
					$exist = $this->db->get_where('presensi', ['siswa_id' => $id_s, 'tanggal' => $tanggal])->row_array();
					$current_user = $this->db->get_where('presensi', ['id' => $id])->row_array();
					if ($current_user['id'] == $exist['id'] || empty($exist)) {
						$this->db->where('id', $id);
						if ($this->db->update('presensi', $presensi_input)) {
							$msg = ['status' => 'success', 'msg' => 'presensi berhasil disimpan'];
						}
					} else {
						$msg['msgs'][] = 'Gagal edit presensi u';
					}
				} else {
					$this->db->select('id');
					$exist =  $this->db->get_where('presensi', ['siswa_id' => $id_s, 'tanggal' => $tanggal])->row_array();
					if (empty($exist)) {
						if ($this->db->insert('presensi', $presensi_input)) {
							$msg = ['status' => 'success', 'msg' => 'presensi berhasil disimpan'];
						}
					} else {
						$msg['msgs'][] = 'Gagal tambah presensi siswa t';
					}
				}
			}
		} elseif (empty($this->input->post())) {
			if ($q_rows != $presensi_rows) {
				$this->db->delete('presensi', ['kelas_id' => $k, 'tanggal' => date('Y-m-d')]);
				foreach ($q as $key => $value) {
					$presensi_input = [
						'siswa_id' => $value['id'],
						'kelas_id' => $value['kelas_id'],
						'th_ajaran_id' => $c_th['id'],
						'keterangan' => '0',
						'tanggal' => $tanggal
					];
					$this->db->insert('presensi', $presensi_input);
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('presensi', ['id' => $id])->row_array();
		}
		return $msg;
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('presensi', ['id' => $id])) {
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
}
