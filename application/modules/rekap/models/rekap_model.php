<?php defined('BASEPATH') or exit('No direct script access allowed');

class rekap_model extends CI_Model{

	public function jadwal(){
		$date = '2020-02-12';
		$day = '1';
		$guru_mapel_tmp = $this->db->query('SELECT guru_has_mapel.*,kelas.nama,mapel.nama AS mapel FROM guru_has_mapel INNER JOIN kelas ON(kelas.id=guru_has_mapel.kelas_id) INNER JOIN mapel ON(mapel.id = guru_has_mapel.mapel_id) WHERE hari = ? ORDER BY jam_mulai ASC ', $day)->result_array();
		$guru_mapel = [];
		foreach ($guru_mapel_tmp as $key => $value) {
			$guru_mapel[$value['hari']][$value['kelas_id']][] = $value;
		}
		return $guru_mapel;
	}
}