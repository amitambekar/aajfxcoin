<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_payout extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        $this->load->model('Admin_payout_model');
    }

	public function index()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/admin/payout',$data);
	}

	public function user_coins_payout()
	{
		if($this->input->post())
		{
			payUserCoinsIncome(0,"Cheque","Bank","Paid");
			$status = 'success';
	        $message = 'Payout successfully done.';
	        $status_code = 200;
			$response = array('status'=>$status,'message'=>$message);
			echo responseObject($response,$status_code);
		}
	}

	public function referral_income_payout()
	{
		if($this->input->post())
		{
			payRemainingReferralIncome(0,"Cheque","Bank","Paid");
			$status = 'success';
	        $message = 'Payout successfully done.';
	        $status_code = 200;
			$response = array('status'=>$status,'message'=>$message);
			echo responseObject($response,$status_code);
		}
	}

	function test()
	{
		//dump(getCoinsDetails(0));
		//dump(getUserCoinsDetails(0));
		//payUserCoinsIncome(0,"Cheque","Bank","Paid");
	}
}