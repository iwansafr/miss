<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
	public function all()
	{
		return $this->db->get('siswa')->result_array();
	}
	
	public function save($id = 0)
	{
		$msg = [];
		if(!empty($this->input->post()))
		{
			$msg = ['status'=>'danger', 'msg'=>'siswa gagal disimpan'];
			$data = $this->input->post();
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('siswa', ['nisn'=>$data['nisn']])->row_array();
				$current_user = $this->db->get_where('siswa', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('siswa',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'siswa berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'nisn sudah ada';
				}
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('siswa', ['nisn'=>$data['nisn']])->row_array();
				if(empty($exist))
				{
					if($this->db->insert('siswa',$data))
					{
						$msg = ['status'=>'success', 'msg'=>'siswa berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'nisn sudah ada';
				}
			}
		}
		if(!empty($id))
		{
			$msg['data'] = $this->db->get_where('siswa',['id'=>$id])->row_array();
		}
		return $msg;
	}
	public function delete($id=0)
	{
		if(!empty($id))
		{
			if($this->db->delete('siswa', ['id'=>$id]))
			{
				return ['status'=>'success','msg'=>'data berhasil dihapus'];
			}else{
				return ['status'=>'danger','msg'=>'data gagal dihapus'];
			}
		}
	}	
}