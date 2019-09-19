<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model
{
	public function check_login()
	{
		pr($this->session->userdata());
	}
}