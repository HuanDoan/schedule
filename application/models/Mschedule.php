<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Mschedule extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function checkDateExisted($date){
		$query = $this->db->query("SELECT * FROM zzs_date WHERE `Date` = '$date' AND Status = 1");
		$row  = $query->num_rows();
		if ($row == 0 || $row == null ) {
			return 0;
		}
		else{
			$item = $query->row();
			return $item->ID;
		}
	}

	function insertDate($date){
		$data = [
			'Date'  	=> $date,
			'Status' 	=> 1
		];

		$this->db->insert('zzs_date', $data);
		return $this->db->insert_id();
	}

	function insertSchedule($date_id, $job, $staffID){
		$data = [
			"DateID" 	=> $date_id,
			"StaffID" 	=> $staffID,
			"Content" 	=> $job,
			"Status" 	=> 0
		];

		$this->db->insert('zzs_schedule', $data);
		return $this->db->insert_id();
	}

	function getList(){
		$query = $this->db->query("	SELECT S.*, D.Date, ST.StaffName FROM `zzs_schedule` S
									INNER JOIN zzs_date D ON S.DateID = D.ID
									INNER JOIN zzs_staff ST ON S.StaffID = ST.ID 
									ORDER BY D.Date");
		return $query->result();
	}

	function deleteJob($ID){
		$this->db->where('ID', $ID);
		if ($this->db->delete('zzs_schedule')) {
			return true;
		}
		else{
			return false;
		}
	}
}