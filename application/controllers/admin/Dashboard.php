<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index() {
        redirect('admin/schedule','refresh');
    }

    public function schedule() {
        $this->render('layout_admin/dashboard_view');
    }

    public function changePass(){
    	$this->load->model('muser');
    	if ($this->input->post()) {
    		$ID = $this->session->adm_id;
    		$currPass = $this->muser->hash($this->input->post('currpass'));
    		$newPass  = $this->muser->hash($this->input->post('newpass'));
    		$reenter  = $this->muser->hash($this->input->post('reenterpass'));

    		if ($this->muser->checkCurrPass($ID, $currPass)) {
    			if ($newPass !== $reenter) {
    				$this->session->set_flashdata('err_msg', 'Mật khẩu nhập lại không chính xác!');
    			}
    			else{
    				$this->muser->changePass($ID, $newPass);
    				$this->session->set_flashdata('success_msg', 'Thay đổi mật khẩu thành công!');
    			}	
    		}
    		else{
    			$this->session->set_flashdata('err_msg', 'Mật khẩu hiện tại không chính xác!');
    		}
    	}
    	$this->render('layout_admin/changepass_view');
    }

    public function video(){
    	$this->load->model('mvideo');
    	if ($this->input->post()) {
    		$link = $this->mvideo->clean($this->input->post('codeLink'));
    		if ($this->mvideo->insertVideo($link)) {
    			$this->session->set_flashdata('success_msg', 'Lưu lại thành công!');
    			$this->data['codeLink'] = $this->mvideo->getLatestVideo();
    		}
    		else{
    			$this->session->set_flashdata('err_msg', 'Có lỗi xảy ra!');
    			$this->data['codeLink'] = $this->mvideo->getLatestVideo();
    		}
    	}
    	else{
    		$this->data['codeLink'] = $this->mvideo->getLatestVideo();
    	}
    	$this->render('layout_admin/video_view');
    }

    public function setting(){
        $this->render('layout_admin/setting_view');
    }

    public function staff(){
    	$this->load->model('mstaff');
    	if ($this->input->post()) {
    		$staffName = $this->mstaff->clean($this->input->post('StaffName'));
    		if ($this->mstaff->insertStaff($staffName)) {
    			$this->session->set_flashdata('success_msg', 'Thêm nhân viên thành công!');
    		}
    		else{
    			$this->session->set_flashdata('err_msg', 'Rất tiếc! Đã có lỗi xảy ra!');
    		}
    	}
    	$this->render('layout_admin/staff_view');
    }

    public function ajax_staff(){
    	$this->load->model('mstaff');
    	if ($this->input->post()) {
    		$option = $this->input->post('option');

    		if ($option == 'fetchList') {
    			$data = $this->mstaff->fetchListStaff();
    			$this->output->set_content_type('application/json')->set_output(json_encode($data->result()));
    		}

    		if ($option == 'edit') {
    			$ID = $this->input->post('id');
    			$newName = $this->mstaff->clean($this->input->post('newname'));
    			if ($this->mstaff->updateStaff($ID, $newName)) {
    				echo 'success';
    				die();
    			}
    			else{
    				echo 'Cannot edit this staff';
    				die();
    			}
    		}

    		if ($option == 'delete') {
    			$ID = $this->input->post('id');
    			if ($this->mstaff->deleteStaff($ID)) {
    				echo 'success';
    				die();
    			}
    			else{
    				echo 'Cannot delete this staff';
    				die();
    			}
    		}

    	}
    }
}