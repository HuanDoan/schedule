<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
    protected $data = array();
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
    }    
}


class Admin_Controller extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    protected function render($the_view = NULL, $template = 'master') {
        if($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        elseif(is_null($template)) {
            $this->load->view($the_view,$this->data);
        }
        else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('layout_admin/' . $template, $this->data);
        }
    }

    protected function view($the_view = NULL, $template = 'master') {
        if($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        elseif(is_null($template)) {
            $this->load->view($the_view,$this->data);
        }
        else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('layout_admin/' . $template, $this->data);
        }
    }
}


class Public_Controller extends MY_Controller {
    function __construct() {
        parent::__construct();            
    }

    protected function render($the_view = NULL, $template = 'master') {
        if($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        elseif(is_null($template)) {
            $this->load->view($the_view,$this->data);
        }
        else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('layout_web/' . $template, $this->data);
        }
    }

    protected function view($the_view = NULL, $template = 'master') {
        if($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        elseif(is_null($template)) {
            $this->load->view($the_view,$this->data);
        }
        else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('layout_web/' . $template, $this->data);
        }
    }
}