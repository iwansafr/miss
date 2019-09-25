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