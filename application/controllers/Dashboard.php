<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('session_data')){
			$this->session->set_userdata('error_msg', INVALID_AUTH);
			header("Location: login");
		}else{
			$this->session->unset_userdata('error_msg');
		}


	}
	public function index()
	{
		$this->load->view('admin/index');
	}
}