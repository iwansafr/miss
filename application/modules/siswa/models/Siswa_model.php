<?php defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
	public function all($id = 0)
	{
		$id = $this->input->get('k');
		$id_k = $this->input->get('id_k');
		if ($this->input->get('k')) {
			return $this->db->get_where('siswa', ['kelas_id' => $id])->result_array();
		} elseif ($this->input->get('id_k')) {
			return $this->db->get_where('siswa', ['kelas_id' => $id_k])->result_array();
		} else {
			return $this->db->get('siswa')->result_array();
		}
	}

	public function upload($file = '', $mode = '')
	{
		if (!empty($file['tmp_name'])) {
			$dir = FCPATH . 'assets/images/modules/siswa/';
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
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'siswa gagal disimpan'];
			$data = $this->input->post();
			$siswa_input = [
				'nama'     => $data['nama'],
				'kelas_id'      => $data['kelas'],
				'th_ajaran_id'      => $data['th_ajaran'],
				'angkatan'      => $data['th_ajaran'],
				'nis'      => $data['nis'],
				'nisn'     => $data['nisn'],
				'gender'   => $data['gender'],
				'agama'   => $data['agama'],
				'photo'    => empty($data['photo']) ? '-' : $data['photo'],
				'tmpt_lhr' => $data['tmpt_lhr'],
				'tgl_lhr'  => $data['tgl_lhr'],
				'alamat'   => $data['alamat']
			];
			$user_input = [
				'username' => $data['nisn'],
				'password' => '123456',
				'email'    => '-',
				'active'   => 0,
				'role'     => [4],
				'nama'     => $data['nama'],
				'gender'   => $data['gender']
			];
			$angkatan_input = [
				'th_ajaran_id' => $data['th_ajaran']
			];
			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('siswa', ['nisn' => $siswa_input['nisn']])->row_array();
				$current_user = $this->db->get_where('siswa', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('siswa', $siswa_input)) {
						$fp = $this->db->get_where('presensi', ['siswa_id' => $current_user['id']])->row_array();
						if (!empty($fp)) {
							$this->db->update('presensi', ['kelas_id' => $data['kelas']], ['siswa_id' => $current_user['id']]);
						}
						if ($current_user['nisn'] != $data['nisn']) {
							$this->db->update('user', ['username' => $data['nisn']], ['id' => $current_user['user_id']]);
							$msg = ['status' => 'success', 'msg' => 'siswa berhasil disimpan'];
						} else {
							$msg = ['status' => 'success', 'msg' => 'siswa berhasil disimpan'];
						}
					}
				} else {
					$msg['msgs'][] = 'nisn sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('siswa', ['nisn' => $siswa_input['nisn']])->row_array();
				if (empty($exist)) {
					$user_status = $this->user_model->save(0, $user_input);
					$siswa_input['user_id'] = $user_status['user_id'];
					if ($this->db->insert('siswa', $siswa_input)) {
						$msg = ['status' => 'success', 'msg' => 'siswa berhasil disimpan'];
					}
					// $last_id = $this->db->insert_id();
					// if (!empty($last_id)) {
					// 	$angkatan_input['siswa_id'] = $last_id;
					// 	$this->load->model('user/user_model');
					// 	if ($this->db->insert('siswa_has_angkatan', $angkatan_input)) {
					// 		$msg = ['status' => 'success', 'msg' => 'siswa berhasil disimpan'];
					// 	} else {
					// 		$msg = ['status' => 'danger', 'msg' => 'akun siswa gagal disimpan'];
					// 	}
					// // if(!empty($user_status['user_id']))
					// // {
					// // 	$this->db->update('siswa',['user_id'=>$user_status['user_id']],['id'=>$last_id]);
					// // }
					// }
				} else {
					$msg['msgs'][] = 'nisn sudah ada';
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('siswa', ['id' => $id])->row_array();
		}
		return $msg;
	}
	public function delete($nisn = 0)
	{
		if (!empty($nisn)) {
			if ($this->db->delete('user', ['username' => $nisn])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}
	public function th_ajaran()
	{
		return $this->db->get('th_ajaran')->result_array();
	}
	public function kelas()
	{
		$data = $this->db->get('kelas')->result_array();
		return $data;
	}
}
