<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Msetting extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function insertBanner($file_name){
		$data = [
			'Path' => $file_name,
		];

		$this->db->insert('zzs_banner', $data);
		return $this->db->insert_id();
	}

	public function getLastestBanner(){
		$query = $this->db->query("SELECT * FROM zzs_banner ORDER BY ID DESC LIMIT 1");
		$item  = $query->row();
		return $item->Path;
	}

	public function getLastestMarquee(){
		$query = $this->db->query("SELECT * FROM zzs_bottom_text ORDER BY ID DESC LIMIT 1");
		$item  = $query->row();
		return $item->Content;
	}

	public function insertMarquee($marquee){
		$data = [
			'Content' => $marquee,
			'Status'  => 0
		];

		$this->db->insert('zzs_bottom_text', $data);
		return $this->db->insert_id();
	}
}