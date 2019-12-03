<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_model
{
	public function check_login()
	{
		if (empty($this->session->userdata(str_replace('/', '_', base_url() . '_logged_in')))) {
			$curent_url = base_url($_SERVER['PATH_INFO']);
			$curent_url = urlencode($curent_url);
			redirect(base_url('login?redirect_to=' . $curent_url));
		} else {
			if (!empty($_COOKIE[base_url() . '_username'])) {
				$data['username'] = @$_COOKIE[base_url() . '_username'];
				$data['password'] = @$_COOKIE[base_url() . '_password'];
				$data['remember_me'] = @$_COOKIE[base_url() . '_remember_me'];
				$this->set_cookie($data);
				$user = $this->CI->db->query('SELECT * FROM user WHERE username = ? LIMIT 1', @$data['username'])->row_array();
				if (!empty($user)) {
					if (decrypt($data['password'], $user['password'])) {
						$url = @$_GET['redirect_to'];
						if (!empty($url)) {
							$url = urldecode($url);
						} else {
							$url = 'admin/index';
						}
						$role = $this->CI->db->query('SELECT level,title FROM user_role WHERE id = ? LIMIT 1', @$user['user_role_id'])->row_array();
						if (!empty($role)) {
							$user['role'] = @$role['title'];
							$user['level'] = @$role['level'];
						} else {
							$user['role'] = 'user';
						}
						$this->CI->session->set_userdata(base_url() . '_logged_in', $user);
						$this->save_ip($user['id']);
					}
				}
			}
		}
	}

	public function login()
	{
		$data = $this->input->post();
		$msg = [];
		if (!empty($data)) {
			$user = $this->db->query('SELECT * FROM user WHERE username = ?', $data['username'])->row_array();
			if (!empty($user)) {
				if (!decrypt($data['password'], $user['password'])) {
					$msg = ['status' => 'danger', 'msg' => 'password tidak sesuai'];
				} else {
					$url = @$_GET['redirect_to'];
					if (!empty($url)) {
						$url = urldecode($url);
					} else {
						$url = '';
					}
					$tmp_role = $this->role_all();
					$role = [];
					if (!empty($tmp_role)) {
						foreach ($tmp_role as $key => $value) {
							$role[$value['id']] = $value['title'];
						}
					}

					$user_role = $this->db->get_where('user_has_role', ['user_id' => $user['id']])->result_array();
					foreach ($user_role as $key => $value) {
						$user['role'][] = ['id' => $value['user_role_id'], 'title' => $role[$value['user_role_id']]];
					}
					$this->session->set_userdata(str_replace('/', '_', base_url() . '_logged_in'), $user);
					redirect($url);
				}
			} else {
				$msg = ['status' => 'danger', 'msg' => 'username tidak diketahui'];
			}
		}
		return $msg;
	}

	public function save($id = 0, $data = array())
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'user gagal disimpan'];
			if (empty($data)) {
				$data = $this->input->post();
			}

			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('user', ['username' => $data['username']])->row_array();
				$current_user = $this->db->get_where('user', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					if (empty($data['password'])) {
						$pass = $current_user['password'];
					} elseif (!empty($data['password'])) {
						$pass = encrypt($data['password']);
					}
					$this->db->where('id', $id);
					if ($this->db->update('user', [
						'password' => $pass,
						'username' => $data['username'],
						'email' => @$data['email'],
					])) {
						$msg = ['status' => 'success', 'msg' => 'user berhasil disimpan'];
						$this->db->select('*');
						$this->db->where(['user_id' => $id]);
						$current_role = $this->db->get('user_has_role')->result_array();

						if (!empty($data['role'])) {
							$q_delete = [];
							foreach ($current_role as $key => $value) {
								if (!in_array($value['user_role_id'], $data['role'])) {
									$q_delete[] = $value['id'];
								} else {
									$role_key = array_search($value['user_role_id'], $data['role']);
									unset($data['role'][$role_key]);
								}
							}
							$q = [];
							foreach ($data['role'] as $key => $value) {
								$q[] = ['user_id' => $id, 'user_role_id' => $value];
							}
							if (!empty($q)) {
								if (!$this->db->insert_batch('user_has_role', $q)) {
									$msg['msgs'][] = 'role gagal disimpan';
								}
							}
							foreach ($q_delete as $key => $value) {
								$this->db->delete('user_has_role', ['id' => $value]);
							}
						} else {
							$this->db->delete('user_has_role', ['user_id' => $id]);
						}
					}
				} else {
					$msg['msgs'][] = 'username sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('user', ['username' => $data['username']])->row_array();
				if (empty($exist)) {
					if ($this->db->insert('user', [
						'password' => encrypt($data['password']),
						'username' => $data['username'],
						'email' => @$data['email'],
					])) {
						$msg = ['status' => 'success', 'msg' => 'user berhasil disimpan'];
						$last_id = $this->db->insert_id();
						$msg['user_id'] = $last_id;
						$q = [];
						foreach ($data['role'] as $key => $value) {
							$q[] = ['user_id' => $last_id, 'user_role_id' => $value];
						}
						if (!$this->db->insert_batch('user_has_role', $q)) {
							$msg['msgs'][] = 'role gagal disimpan';
						}
					}
				} else {
					$msg['msgs'][] = 'username sudah ada';
				}
			}
		}
		if (!empty($id)) {
			$this->db->where(['user.id' => $id]);
			$msg['user'] = $this->db->get('user')->row_array();

			$this->db->select('user_role_id');
			$tmp_user_role = $this->db->get_where('user_has_role', ['user_id' => $id])->result_array();
			foreach ($tmp_user_role as $key => $value) {
				$msg['user_role'][] = $value['user_role_id'];
			}
		}
		return $msg;
	}

	public function role_save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'user gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('user_role', ['title' => $data['title']])->row_array();
				$current_user = $this->db->get_where('user_role', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					$this->db->where('id', $id);
					if ($this->db->update('user_role', $data)) {
						$msg = ['status' => 'success', 'msg' => 'user role berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'title sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('user_role', ['title' => $data['title']])->row_array();
				if (empty($exist)) {
					if ($this->db->insert('user_role', $data)) {
						$msg = ['status' => 'success', 'msg' => 'user role berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'title sudah ada';
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('user_role', ['id' => $id])->row_array();
		}
		return $msg;
	}

	public function all()
	{
		return $this->db->get('user')->result_array();
	}

	public function role_all()
	{
		return $this->db->get('user_role')->result_array();
	}

	public function role_delete($id)
	{
		if (!empty($id)) {
			if ($this->db->delete('user_role', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('user', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			} else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}
}
