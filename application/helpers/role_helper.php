<?php defined('BASEPATH') OR exit('No direct script access allowed');

function is_guru()
{
	return check_role('guru');
}

function is_admin()
{
	return check_role('admin');
}

function is_petugas()
{
	return check_role('petugas');
}

function is_siswa()
{
	return check_role('siswa');
}

function get_user()
{
	$link = str_replace('/', '_', base_url());
	$user = $_SESSION[$link.'_logged_in'];
	return $user;
}

function is_root()
{
	return check_role('root');
}

function check_role($role = '')
{
	$output = false;
	if(!empty($role))
	{
		$link = str_replace('/', '_', base_url());
		$user = $_SESSION[$link.'_logged_in']['role'];
		$output = false;
		foreach ($user as $key => $value) 
		{
			if($value['title']==$role){
				$output = true;
			}
		}
	}
	return $output;
}