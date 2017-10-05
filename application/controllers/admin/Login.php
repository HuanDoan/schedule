<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Login extends MY_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mlogin');
	}

	public function index(){
		if ($this->mlogin->isLogedIn()) {
            redirect('admin','refresh');
        }
		$this->load->view('layout_admin/login_view');
	}

	public function submit(){
		if ($this->input->post()) {
			$username = $this->input->post('username');
			$password = $this->mlogin->hash($this->input->post('password'));
			if ($this->mlogin->login($username, $password)) {
				redirect('admin','refresh');
			}
			else{
				$this->session->set_flashdata('err_msg', 'Sai tài khoản hoặc mật khẩu!');
				redirect('admin/login','refresh');
			}
		}
	}

	public function signout(){
		if ($this->session->has_userdata('adm_username')) {
			$this->mlogin->logout();
			redirect('admin/login','refresh');
		}
		else{
			redirect('admin/login','refresh');
		}
	}
}