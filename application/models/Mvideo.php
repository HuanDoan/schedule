<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Mvideo extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function insertVideo($code){
		$data = [
			'Link' => $code,
			'CreatedDate' => date("Y-m-d H:i:s")
		];

		if ($this->db->insert('zzs_video', $data)) {
			return true;
		}
		else{
			return false;
		}
	}

	public function getLatestVideo(){
		$query = $this->db->query("SELECT * FROM zzs_video ORDER BY ID DESC LIMIT 1");
		$item  = $query->row();
		return $item->Link;
	}
}