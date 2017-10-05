<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Mstaff extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function insertStaff($staffName){
		$data = [
			'StaffName' => $staffName
		];

		if ($this->db->insert('zzs_staff', $data)) {
			return true;
		}
		else{
			return false;
		}
	}

	public function fetchListStaff(){
		return $query = $this->db->query("SELECT * FROM zzs_staff WHERE Status = 1");
	}

	public function updateStaff($ID, $Name){
		$data = [
			'StaffName' => $Name
		];
		$this->db->where('ID', $ID);
		if ($this->db->update('zzs_staff', $data)) {
			return true;
		}
		else{
			return false;
		}
	}

	public function deleteStaff($ID){
		$this->db->where('ID', $ID);
		if ($this->db->delete('zzs_staff')) {
			return true;
		}
		else{
			return false;
		}
	}
}