<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('layout_admin/include/head'); ?>
<?php $this->load->view('layout_admin/include/top-navbar'); ?> 
<?php $this->load->view('layout_admin/include/sidebar'); ?>
<?php echo $the_view_content;?>
<?php $this->load->view('layout_admin/include/end');?>