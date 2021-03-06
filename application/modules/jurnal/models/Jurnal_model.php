<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal_model extends CI_Model
{
	public function all()
	{
		return $this->db->get('jurnal')->result_array();
	}
	public function save($id = 0)
	{
		$msg = [];
		$day = date ('D');
		$time = date('H:i');
		// $time = "07:30";

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
		// $hari_ini = 1;

		$username = get_user()['username'];
		$this->db->select('id');
		$exist = $this->db->get_where('guru', ['kode' => $username])->row_array();
		$find_mhp = $this->db->get_where('guru_has_mapel', ['guru_id' => $exist['id'], 'hari' => $hari_ini, 'jam_mulai <' => $time, 'jam_selesai >=' => $time,'kelas_id'=>$id])->row_array();
		if(!empty($find_mhp))
		{
			$k = $find_mhp['kelas_id'];
			$tanggal = date('Y-m-d');
			$kode = $find_mhp['guru_id'] . '_' . $find_mhp['mapel_id'] . '_' . $tanggal . '_' . $find_mhp['jam_mulai'] . '_' . $find_mhp['jam_selesai'];
			$this->db->select('id');
			$exist = $this->db->get_where('presensi_has_mapel', ['kode'=> $kode])->row_array();
			$exist1 = $this->db->get_where('jurnal', ['kode'=> $kode])->row_array();
			if (empty($exist)) {
				$msg = ['msg'=>'Silahkan isi presensi siswa terlebih dahulu','status'=>'danger'];
			}else{
				if(empty($exist1))
				{
					$jurnal_input = [
						'materi' => '',
						'guru_id' => $find_mhp['guru_id'],
						'mapel_id' => $find_mhp['mapel_id'],
						'tanggal' => $tanggal,
						'jam' => $time,
						'kode' => $kode
					];
					$this->db->insert('jurnal',$jurnal_input);
				}else{
					$msg['msgs'][] = 'Jurnal sudah di input';
				}
			}
			if(!empty($this->input->post()))
			{
				$msg = ['status'=>'danger', 'msg'=>'jurnal gagal disimpan'];
				$data = $this->input->post();
				$jurnal_input = [
					'materi' => $data['materi'],
					'guru_id' => $find_mhp['guru_id'],
					'mapel_id' => $find_mhp['mapel_id'],
					'tanggal' => $tanggal,
					'jam' => $time,
					'kode' => $kode
				];
				$this->db->select('id');
				$exist = $this->db->get_where('jurnal', ['kode'=>$kode])->row_array();
				if (!empty($exist)) {
					$id = $exist['id'];
				}
				
				if(!empty($id))
				{
					$current_user = $this->db->get_where('jurnal', ['id'=>$id])->row_array();
					if($current_user['id'] == $exist['id'])
					{
						$this->db->where('id',$id);
						if($this->db->update('jurnal',$jurnal_input))
						{
							$msg = ['status'=>'success', 'msg'=>'jurnal berhasil disimpan'];
						}
					}else{
						$msg['msgs'][] = 'Jurnal sudah di input';
					}
				}
			}
			if(!empty($id))
			{
				$msg['data'] = $this->db->get_where('jurnal',['id'=>$id])->row_array();
			}
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
	public function mapel()
	{
		$data = $this->db->get('mapel')->result_array();
		return $data;
	}
	public function kelas()
	{
		$data = $this->db->get('kelas')->result_array();
		return $data;
	}
}