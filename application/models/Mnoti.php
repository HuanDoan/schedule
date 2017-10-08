<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Mnoti extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function insertNoti($content){
		$data = [
			'Content' => $content,
			'Status'  => 0
		];

		$this->db->insert('zzs_notification', $data);
		return $this->db->insert_id();
	}

	function getLastestNoti(){
		$query = $this->db->query("SELECT * FROM zzs_notification ORDER BY ID DESC LIMIT 1");
		$item  = $query->row();
		return $item->Content;
	}
}