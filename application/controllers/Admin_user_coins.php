<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user_coins extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        $this->load->model('Adminusercoins_model');
    }

	public function index()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/admin/user_coins',$data);
	}

	public function view_user_coins_list()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;

		$this->load->view('template/admin/view_user_coins_list',$data);
	}

	function deleteUserCoinsRequest(){
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$user_coins_id = $this->input->post('user_coins_id');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_coins_id', 'User Coins ID', 'required');
			
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();

	        if(count($error_array) == 0 )
	        {
		        $this->Adminusercoins_model->deleteUserCoinsRequest($user_coins_id);	
				$status = 'success';
			    $message = 'Request Deleted successfully';	
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

    function userCoinsRequestAction(){
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$user_coins_id = $this->input->post('user_coins_id');
			$status = $this->input->post('status');
			$userid = $this->input->post('userid');
			$accepted_date = config_item('current_date');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_coins_id', 'User Coin ID', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();

	        $coins = 0;
			$user_coin_data=getUserCoin(0,'',array('user_coins.id'=>$user_coins_id));
			foreach ($user_coin_data as $row) {
				$coins = $row['coins'];
			}
	        $remaining_coins = getRemainingCoins();
			if($remaining_coins < $coins)
			{
				$error_array['coins'] = 'Remaining Coins are zero.';	
			}
	        if(count($error_array) == 0 )
	        {
		        $this->Adminusercoins_model->userCoinsRequestAction($user_coins_id,$status,$userid,$accepted_date);
		        $obj = new Payout();
		        $obj->referral_bonus($accepted_date,$userid,$user_coins_id);

				$status = 'success';
			    $message = 'Request Accepted successfully';	
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
}
