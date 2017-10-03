<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class MY_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function clean($strText) {
        $str=preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $strText);
        return $str;        
	}

	public function hash($text) {
        $str=sha1(md5(sha1($text)));
        return $str;
    }
}