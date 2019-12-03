<?php defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
	public function all()
	{
		return $this->db->get('guru')->result_array();
	}

	public function save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'guru gagal disimpan'];
			$data = $this->input->post();
			$guru_input = [
				'nama'     => $data['nama'],
				'kode'     => $data['kode'],
				'gender'   => $data['gender'],
				'alamat'   => $data['alamat'],
				'hp' => $data['hp'],
				'photo'    => empty($data['photo']) ? '-' : $data['photo'],
			];
			$user_input = [
				'username' => $data['kode'],
				'password' => encrypt('123456'),
				'email'    => '-',
				'active'   => 0,
				'role'     => [3],
				'nama'     => $data['nama'],
				'gender'   => $data['gender']
			];
			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('guru', ['nama' => $guru_input['nama']])->row_array();
				$current_user = $this->db->get_where('guru', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('guru', $guru_input)) {
						$this->db->update('user', ['username' => $data['kode']], ['id' => $current_user['user_id']]);
						$msg = ['status' => 'success', 'msg' => 'guru berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'nama sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('guru', ['nama' => $guru_input['nama']])->row_array();
				$exist_kode = $this->db->get_where('guru', ['kode' => $guru_input['kode']])->row_array();
				if (empty($exist) && empty($exist_kode)) {
					$user_status = $this->user_model->save(0, $user_input);
					$guru_input['user_id'] = $user_status['user_id'];
					if ($this->db->insert('guru', $guru_input)) {
						$msg = ['status' => 'success', 'msg' => 'guru berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'nama/kode sudah ada';
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('guru', ['id' => $id])->row_array();
		}
		return $msg;
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('guru', ['id' => $id])) {
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
}
