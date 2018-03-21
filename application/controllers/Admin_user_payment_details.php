<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user_payment_details extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        $this->load->model('Admin_user_payment_details_model');
    }

	public function index()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/admin/payout',$data);
	}

	public function view($payment_method,$view_userid = 0)
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$data['view_userid'] = $view_userid;
		$data['payment_method'] = $payment_method;
		$this->load->view('template/admin/user_payment_details_view',$data);
	}

	public function user_coins_income()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/admin/user_coins_income',$data);
	}

	public function referral_income()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/admin/referral_income',$data);
	}

    function get_payment_details(){
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$userid = $this->input->post('userid');
			$payment_method = $this->input->post('payment_method');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('userid', 'User ID', 'required');
			$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
			
			
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();

	        if(count($error_array) == 0 )
	        {
	        	if($payment_method == 'roi')
		        {
		        	$result = roi_details($userid);
		        }else if($payment_method == 'referral_income')
		        {
		        	$result = referral_income_details($userid);
		        }else if($payment_method == 'loyality_income')
		        {
		        	$result = loyality_income_details($userid);
		        }
	        	if(count($result) > 0)
	        	{
		        	$status = 'success';
				    $message = $result;	
				    $status_code = 200;		
	        	}else
	        	{
		        	$status = 'error';
				    $message = 'User ID not found';	
				    $status_code = 501;	
	        	}
		        
	        }else
	        {
	        	$status = 'error';
	        	$message = $error_array;
	        	$status_code = 501;
	        }
			
	        $response = array('status'=>$status,'message'=>$message);
			echo responseObject($response,$status_code);	
		}
    }

    function release_payment(){
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$userid = $this->input->post('userid');
			$release_amount = $this->input->post('release_amount');
			$payment_desc = $this->input->post('payment_desc');
			$payment_method = $this->input->post('payment_method');

						

			$this->load->library('form_validation');
			$this->form_validation->set_rules('userid', 'User ID', 'required');
			$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
			$this->form_validation->set_rules('release_amount', 'Release Amount', 'required|numeric|greater_than[0]');
			
			
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();
	        
	        $tablename = '';
	        if($payment_method == 'roi')
	        {
	        	$payment_data = roi_details($userid);
	        	$tablename = 'return_of_interest';	
	        }else if($payment_method == 'referral_income')
	        {
	        	$payment_data = referral_income_details($userid);
	        	$tablename = 'referral_income';
	        }else if($payment_method == 'loyality_income')
	        {
	        	$payment_data = loyality_income_details($userid);
	        	$tablename = 'loyality_income';	
	        }
	        
	        
	        if($release_amount > $payment_data['Remaining_Amount'])
	        {
	        	$error_array['release_amount'] = 'Release Amount is greater than Remaining Amount.';	
	        }
	        if(count($error_array) == 0 )
	        {
	        	$result = $this->Admin_user_payment_details_model->release_payment($userid,$release_amount,$payment_desc,$tablename);
	        	$status = 'success';
				$message = 'Successfully Released Payment';
				$status_code = 200;
	        }else
	        {
	        	$status = 'error';
	        	$message = $error_array;
	        	$status_code = 501;
	        }
			
	        $response = array('status'=>$status,'message'=>$message);
			echo responseObject($response,$status_code);	
		}
    }

    function user_coins_income_excel()
    {
    	$date = '';
    	if(isset($_GET['date']) && $_GET['date']!='')
    	{
    		$date = $_GET['date'];
    	}
    	$data  = getUserCoinsDetails(0,$date);
    	function purchased_coins_filter($var)
		{
			return($var['Purchased_Coins'] > 0);
		}
    	$data = array_filter($data,"purchased_coins_filter");
    	$temp = array();
    	foreach($data as $row)
    	{
    		$tmp = array();
    		foreach($row as $k=>$v)
    		{
    			if(!in_array($k,array('Purchased_Coins','Purchased_Amount','Remaining_Coins','Remaining_Amount')))
    			{
    				$tmp[$k] = $v;
    			}
	    	}
	    	array_push($temp,$tmp);
    	}
    	export_to_excel($temp,'Monthly Coin Payout Report '.$date.'.xlsx');
    }

    function referral_income_excel()
    {
    	$date = '';
    	if(isset($_GET['date']) && $_GET['date']!='')
    	{
    		$date = $_GET['date'];
    	}
    	$data  = getReferralIncomeDetails(0,$date);
    	function filter($var)
		{
			return($var['Total_Coins'] > 0);
		}
    	$data = array_filter($data,"filter");
    	$temp = array();
    	foreach($data as $row)
    	{
    		$tmp = array();
    		foreach($row as $k=>$v)
    		{
    			if(!in_array($k,array('Remaining_Coins','Paid_Coins')))
    			{
    				$tmp[$k] = $v;
    			}
	    	}
	    	array_push($temp,$tmp);
    	}
    	export_to_excel($temp,'Referral Payout Report '.$date.'.xlsx');
    }
}
