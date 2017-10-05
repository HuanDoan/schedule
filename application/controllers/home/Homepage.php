<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Homepage extends Public_Controller
{
	function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		$this->load->model('mvideo');
		$this->data['Page_title'] = 'Homepage';

		$this->data['VideoLink'] = $this->mvideo->getLatestVideo();

		$this->render('layout_web/homepage_view');
	}
}