<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
	public function all()
	{
		return $this->db->get('kelas')->result_array();
	}

	public function save($id = 0)
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'kelas gagal disimpan'];
			$data = $this->input->post();
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('kelas', ['nama'=>$data['nama']])->row_array();
				$current_user = $this->db->get_where('kelas', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('kelas',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'kelas berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'nama sudah ada';
				}
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('kelas', ['nama'=>$data['nama']])->row_array();
				if(empty($exist))
				{
					if($this->db->insert('kelas',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'kelas berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'nama sudah ada';
				}
			}
		}
		if(!empty($id))
		{
			$msg['data'] = $this->db->get_where('kelas',['id'=>$id])->row_array();
		}
		return $msg;
	}
	public function delete($id=0)
	{
		if(!empty($id))
		{
			if($this->db->delete('kelas', ['id'=>$id]))
			{
				return ['status'=>'success','msg'=>'data berhasil dihapus'];
			}else{
				return ['status'=>'danger','msg'=>'data gagal dihapus'];
			}
		}
	}	
}