<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model
{
	public function check_login()
	{
		pr($this->session->userdata());
	}
	public function save($id = 0)
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'user gagal disimpan'];
			$data = $this->input->post();
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('user', ['username'=>$data['username']])->row_array();
				$current_user = $this->db->get_where('user', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('user',[
						'password'=>encrypt($data['password']),
						'username'=>$data['username'],
						'email'=>@$data['email'],
					]))
					{
						$msg = ['status'=>'success', 'msg'=>'user berhasil disimpan'];
						$this->db->where('user_id',$id);
						if(!$this->db->update('user_profile', ['user_id'=>$id, 'nama'=>$data['nama']]))
						{
							$msg['msgs'][] = 'nama gagal disimpan';
						}
						$this->db->select('*');
						$this->db->where(['user_id'=>$id]);
						$current_role = $this->db->get('user_has_role')->result_array();

						if(!empty($data['role']))
						{
							$q_delete = [];
							foreach ($current_role as $key => $value) 
							{
								if(!in_array($value['user_role_id'], $data['role']))
								{
									$q_delete[] = $value['id'];
								}else{
									$role_key = array_search($value['user_role_id'], $data['role']);
									unset($data['role'][$role_key]);
								}
							}
							$q = [];
							foreach ($data['role'] as $key => $value) 
							{
								$q[] = ['user_id'=>$id,'user_role_id'=>$value];
							}
							if(!empty($q))
							{
								if(!$this->db->insert_batch('user_has_role', $q))
								{
									$msg['msgs'][] = 'role gagal disimpan';
								}
							}
							foreach ($q_delete as $key => $value) 
							{
								$this->db->delete('user_has_role',['id'=>$value]);
							}
						}else{
							$this->db->delete('user_has_role',['user_id'=>$id]);
						}
					}
				}else{
					$msg['msgs'][] = 'username sudah ada';
				}
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('user', ['username'=>$data['username']])->row_array();
				if(empty($exist))
				{
					if($this->db->insert('user',[
						'password'=>encrypt($data['password']),
						'username'=>$data['username'],
						'email'=>@$data['email'],
					]))
					{
						$msg = ['status'=>'success', 'msg'=>'user berhasil disimpan'];
						$last_id = $this->db->insert_id();
						if(!$this->db->insert('user_profile', ['user_id'=>$last_id, 'nama'=>$data['nama']]))
						{
							$msg['msgs'][] = 'nama gagal disimpan';
						}
						$q = [];
						foreach ($data['role'] as $key => $value) 
						{
							$q[] = ['user_id'=>$last_id,'user_role_id'=>$value];
						}
						if(!$this->db->insert_batch('user_has_role', $q))
						{
							$msg['msgs'][] = 'role gagal disimpan';
						}
					}
				}else{
					$msg['msgs'][] = 'username sudah ada';
				}
			}
		}
		if(!empty($id))
		{
			$this->db->select('user.*,user_profile.nama');
			$this->db->from('user');
			$this->db->join('user_profile', 'user.id = user_profile.user_id');
			$this->db->where(['user.id'=>$id]);
			$msg['user'] = $this->db->get()->row_array();

			$this->db->select('user_role_id');
			$tmp_user_role = $this->db->get_where('user_has_role',['user_id'=>$id])->result_array();
			foreach ($tmp_user_role as $key => $value) 
			{
				$msg['user_role'][] = $value['user_role_id'];
			}

		}
		return $msg;
	}

	public function role_save($id = 0)
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'user gagal disimpan'];
			$data = $this->input->post();
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('user_role', ['title'=>$data['title']])->row_array();
				$current_user = $this->db->get_where('user_role', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('user_role',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'user role berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'title sudah ada';
				}
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('user_role', ['title'=>$data['title']])->row_array();
				if(empty($exist))
				{
					if($this->db->insert('user_role',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'user role berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'title sudah ada';
				}
			}
		}
		if(!empty($id))
		{
			$msg['data'] = $this->db->get_where('user_role',['id'=>$id])->row_array();
		}
		return $msg;
	}

	public function all()
	{
		$this->db->select('user.*,user_profile.nama');
		$this->db->from('user');
		$this->db->join('user_profile', 'user.id = user_profile.user_id');
		// $this->db->where(['user.id'=>$id]);

		return $this->db->get()->result_array();
	}

	public function role_all()
	{
		return $this->db->get('user_role')->result_array();
	}

	public function role_delete($id)
	{
		if(!empty($id))
		{
			if($this->db->delete('user_role', ['id'=>$id]))
			{
				return ['status'=>'success','msg'=>'data berhasil dihapus'];
			}else{
				return ['status'=>'danger','msg'=>'data gagal dihapus'];
			}
		}
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			if($this->db->delete('user', ['id'=>$id]))
			{
				return ['status'=>'success','msg'=>'data berhasil dihapus'];
			}else{
				return ['status'=>'danger','msg'=>'data gagal dihapus'];
			}
		}
	}
}