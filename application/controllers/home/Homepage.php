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
		$this->load->model('msetting');
		$this->load->model('mnoti');
		$this->load->model('mschedule');

		$path = $this->msetting->getLastestBanner();
        $this->data['BannerLink'] = base_url().'/assets/users/files/'.$path;
        $this->data['Marquee'] = $this->msetting->getLastestMarquee();
        $this->data['NotiContent'] = $this->mnoti->getLastestNoti();

		$this->data['Page_title'] = 'Homepage';

		$this->data['VideoLink'] = $this->mvideo->getLatestVideo();

		$this->render('layout_web/homepage_view');
	}
}