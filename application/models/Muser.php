<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Muser extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function checkCurrPass($ID, $currPass){
		$query = $this->db->query("SELECT * FROM zzs_user WHERE ID = '$ID' AND Password = '$currPass'");
		$item  = $query->row();
		if ($query->num_rows() > 0 && $item->ID == $ID && $item->Password == $currPass) {
			return true;
		}
		else{
			return false;
		}
	}

	public function changePass($ID, $newPass){
		$data = array(
			'Password' => $newPass
		);
		$this->db->where('ID', $ID);
		$this->db->update('zzs_user', $data);
	}
}