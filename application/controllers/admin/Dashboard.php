<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index() {
        redirect('admin/schedule','refresh');
    }

    public function schedule() {
        $this->load->model('mstaff');
        $query = $this->mstaff->fetchListStaff();
        $this->data['staff'] = $query->result();
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
        $this->load->model('msetting');
        $path = $this->msetting->getLastestBanner();
        $this->data['BannerLink'] = base_url().'/assets/users/files/'.$path;


        $marquee = $this->msetting->getLastestMarquee();
        $this->data['currMarquee'] = $marquee;


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

    public function notification(){
        $this->load->model('mnoti');
        $this->data['Content'] = $this->mnoti->getLastestNoti();
        $this->render('layout_admin/notification_view');
    }

    //=============================================== AJAX SECTION ==================================================

    public function ajax_schedule(){
        $this->load->model('mschedule');

        if ($this->input->post()) {
            $option = $this->input->post('option');

            $status = '';
            $msg    = '';

            if ($option == 'insertJob') {
                $date    = date('Y-m-d', strtotime($this->input->post('date')));
                $job     = $this->input->post('job');
                $staffID = $this->input->post('staffID'); 

                if ($this->mschedule->checkDateExisted($date) == 0) {
                    $date_id = $this->mschedule->insertDate($date);
                }
                else{
                    $date_id = $this->mschedule->checkDateExisted($date);
                }

                $ID = $this->mschedule->insertSchedule($date_id, $job, $staffID);
                if ($ID) {
                    $status = 'success';
                    $msg    = 'Save successfully!';
                }
                else{
                    $status = 'error';
                    $msg    = 'Cannot save this job! Try again';
                }

                echo json_encode(array('status' => $status, 'msg' => $msg));
                die();
            }

            if ($option == 'fetchTable') {
                $data = $this->mschedule->getList();
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }

            if ($option == 'deleteJob') {
                $id = $this->input->post('id');
                if ($this->mschedule->deleteJob($id)) {
                    $status = 'success';
                    $msg    = 'Delete successfully!';
                }
                else{
                    $status = 'error';
                    $msg    = 'Oops! Something went wrong!';
                }
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
            }
        }
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

    public function ajax_setting(){
        $this->load->model('msetting');

        if ($this->input->post()) {
            $option = $this->input->post('option');

            $status = '';
            $err    = '';
            $file_element_name = 'file';

            if ($option == 'uploadBanner') {
                $image_path = './assets/users/files';
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1024 * 8;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload($file_element_name)) {
                    $status = 'error';
                    $err    = $this->upload->display_errors('', '');
                }
                else{
                    $data     = $this->upload->data();
                    $fileName = $data['file_name'];
                    $file_id  = $this->msetting->insertBanner($fileName);

                    if ($file_id) {
                        $status = 'success';
                        $err    = 'File successfully uploaded';
                    }
                    else{
                        unlink($data['full_path']);
                        $status = 'error';
                        $err    = 'Something went wrong when saving the file, please try again.';
                    }
                }
                echo json_encode(array('status' => $status, 'err' => $err));
                die();
            }

            if ($option == 'marquee') {
                $marquee = $this->msetting->clean($this->input->post('marquee'));
                $id = $this->msetting->insertMarquee($marquee);
                if ($id) {
                    $status = 'success';
                    $err    = 'Save successfully!';
                    
                }
                else{
                    $status = 'error';
                    $err    = 'Cannot save this text!';
                }
                echo json_encode(array('status' => $status, 'err' => $err));
                die();
            }
        }
    }

    public function ajax_noti(){
        $this->load->model('mnoti');

        $status = '';
        $msg    = '';

        if ($this->input->post()) {
            $option = $this->input->post('option');

            if ($option == 'insertNoti') {
                $data = $this->mnoti->clean($this->input->post('data'));
                $id = $this->mnoti->insertNoti($data);
                if ($id) {
                    $status = 'success';
                    $msg    = 'Save successfully';
                }
                else{
                    $status = 'error';
                    $msg    = 'Cannot save this content';
                }
                echo json_encode(array('status' => $status, 'msg' => $msg));
                die();
            }
        }
    }
}