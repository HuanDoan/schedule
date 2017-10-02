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
		$this->data['Page_title'] = 'Homepage';

		$this->render('layout_web/homepage_view');
	}
}