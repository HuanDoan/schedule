<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Mlogin extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function login($username, $pass){
		$query = $this->db->query("SELECT * FROM zzs_user WHERE UserName ='$username' AND Password = '$pass'");
		$item = $query->row();
		if ($query->num_rows()>0 && $username == $item->UserName && $pass == $item->Password) {
			$this->session->set_userdata(array(
				'adm_username' => $item->UserName,
				'adm_name'     => $item->Name,
				'adm_id'	   => $item->ID
			));
			return true;
		}
		else{
			return false;
		}
	}

	public function isLogedIn(){
		if ($this->session->has_userdata('adm_username') && $this->session->has_userdata('adm_name')) {
			return true;
		}
		else{
			return false;
		}
	}

	public function logout(){
		$this->session->unset_userdata(array('adm_username', 'adm_name'));
	}

}