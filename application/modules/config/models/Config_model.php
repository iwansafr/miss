<?php defined('BASEPATH') or exit('No direct script access allowed');

class Config_model extends CI_Model
{
	public function save($config_name = '')
	{
		if ($this->input->post('th_ajaran')) {
			$data = $this->input->post();
			$data = json_encode($data);
			$exist = $this->get_config($config_name);
			if (!empty($exist)) {
				$this->db->update('config', ['value' => $data], ['name' => $config_name]);
			} else {
				$this->db->insert('config', ['name' => $config_name, 'value' => $data]);
			}
			return ['status' => 'success', 'msg' => 'config berhasil disimpan', 'data' => $this->get_config($config_name)];
		} else {
			return ['data' => $this->get_config($config_name)];
		}
	}
	public function get_config($name = '')
	{
		$data = [];
		if (!empty($name)) {
			$data = $this->db->query('SELECT * FROM config WHERE name = ? ', $name)->row_array();
		}
		return $data;
	}
}
