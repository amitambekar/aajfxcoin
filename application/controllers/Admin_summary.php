<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_summary extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        $this->load->model('Admin_summary_model');
    }

	public function index()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		//getRemainingCoins()
		$this->load->view('template/admin/summary',$data);
	}
}