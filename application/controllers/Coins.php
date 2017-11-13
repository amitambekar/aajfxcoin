<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coins extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/coins',$data);
	}

	public function add_packages()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/add_packages',$data);
	}

	public function get_coin_price()
	{		
		$result = getCoinPrice(true);
        if(count($result) > 0 )
        {
        	$status = 'success';
		    $message = $result;
		    $status_code = 200;
        }else
        {
        	$status = 'error';
        	$message = array("Coin price not found");
        	$status_code = 501;
        }	
		$response = array('status'=>$status,'message'=>$message);
		echo responseObject($response,$status_code);
	}

	public function buy_coins()
	{
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$session_data = $this->session->userdata;
			$userid = $session_data['logged_in']['userid'];
		
			$amount = $this->input->post('amount');
			$payment_details = $this->input->post('payment_details');
			$payment_type = $this->input->post('payment_type');
			
			$coin_price_data = getCoinPrice(true);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('payment_details', 'Payment Details', 'required');
			$this->form_validation->set_rules('payment_type', 'Payment Type', 'required');
			$coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);
			$this->form_validation->run();
			$error_array = $this->form_validation->error_array();

			if($coin_price < 0)
			{
				$error_array['coin_price'] = 'Coin Price not set yet.';	
			}
			$remaining_coins = getRemainingCoins();
			$coins = $amount / $coin_price;
			
			if($remaining_coins < $coins)
			{
				$error_array['coins'] = 'Remaining Coins are zero.';	
			}
			
			if(count($error_array) == 0 )
	        {
	        	$this->load->model('Coins_model');
				$created_date = config_item('current_date');
				$this->Coins_model->buy_coins($userid,$amount,$coin_price,$payment_details,$payment_type,$created_date);
	        	$status = 'success';
			    $message = 'added successfully';
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

	public function sell_coins()
	{
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$session_data = $this->session->userdata;
			$userid = $session_data['logged_in']['userid'];
		
			$coins = $this->input->post('coins');
			$payment_details = $this->input->post('payment_details');
			$payment_type = $this->input->post('payment_type');
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('coins', 'Coins', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('payment_details', 'Payment Details', 'required');
			$this->form_validation->set_rules('payment_type', 'Payment Type', 'required');

			$this->form_validation->run();
			$error_array = $this->form_validation->error_array();

			$released_credit_coins = getUserCoin($userid,'sum(user_coins.coins) as number_of_coins',array('user_coins.status'=>'Credit'));
			$released_debit_coins = getUserCoin($userid,'sum(user_coins.coins) as number_of_coins',array('user_coins.status'=>'Debit'));
			$released_debit_request_coins = getUserCoin($userid,'sum(user_coins.coins) as number_of_coins',array('user_coins.status'=>'Debit Request'));
			
			$released_credit_coins = $released_credit_coins['number_of_coins'];
			$released_debit_coins = $released_debit_coins['number_of_coins'];
			$released_debit_request_coins = $released_debit_request_coins['number_of_coins'];

			$released_coins = $released_credit_coins - $released_debit_coins - $released_debit_request_coins;
			if($released_coins < $coins)
			{
				$error_array['coins'] = 'Not enough released coins to sell.';	
			}

			if(count($error_array) == 0 )
	        {
	        	$this->load->model('Coins_model');
				$created_date = config_item('current_date');
				$coin_price_data = getCoinPrice(true);
				$coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);	
				$amount = $coins * $coin_price;
				$this->Coins_model->sell_coins($userid,$coins,$amount,$coin_price,$payment_details,$payment_type,$created_date);
	        	$status = 'success';
			    $message = 'added successfully';
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

	public function coin_details()
	{
		$status = '';
		$message = '';
		$session_data = $this->session->userdata;
		$userid = $session_data['logged_in']['userid'];
	
		$coin_details = getCoinsDetails($userid);
		if(count($coin_details) > 0 )
        {
			$status = 'success';
		    $message = array("coin_details"=>$coin_details);
		    $status_code = 200;
        }else
		{
			$status = 'error';
		    $message = array("Data not found");
		    $status_code = 501;
		}
		$response = array('status'=>$status,'message'=>$message);
		echo responseObject($response,$status_code);
	}

	public function wallet_transfer_request()
	{
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$session_data = $this->session->userdata;
			$userid = $session_data['logged_in']['userid'];
			
		
			$coins = $this->input->post('coins');
			$transfer_username = $this->input->post('transfer_username');
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('coins', 'Coins', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('transfer_username', 'Username', 'required');

			$this->form_validation->run();
			$error_array = $this->form_validation->error_array();

			$user_data = getUserInfo(0,$transfer_username);
			if(count($user_data) == 0)
			{
				$error_array['transfer_username'] = 'Username not matching with any users.';	
			}else
			{
				$transfer_userid = $user_data['userid'];
			}

			$coin_details = getCoinsDetails($userid);
			$number_of_released_coins = $coin_details["number_of_released_coins"];

			$coin_price = $coin_details['coin_price'];	
			if($number_of_released_coins < $coins)
			{
				$error_array['coins'] = 'Not enough released coins to transfer.';	
			}

			if(count($error_array) == 0 )
	        {
	        	$this->load->model('Coins_model');
				$created_date = config_item('current_date');
				$amount = $coins * $coin_price;
				$transfer_otp =  rand(100000,999999);
				$wallet_trxn_data = $this->Coins_model->wallet_transfer_coins($transfer_userid,$userid,$coins,$amount,$coin_price,$transfer_otp,$created_date);
	        	$status = 'success';
			    $message = array("wallet_debit_id"=>$wallet_trxn_data['wallet_debit_id'],"wallet_credit_id"=>$wallet_trxn_data['wallet_credit_id']);
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

	public function wallet_transfer_otp()
	{
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$session_data = $this->session->userdata;
			$userid = $session_data['logged_in']['userid'];
		
			$wallet_debit_id = $this->input->post('wallet_debit_id');
			$wallet_credit_id = $this->input->post('wallet_credit_id');
			$transfer_otp = $this->input->post('transfer_otp');
			
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('wallet_debit_id', 'Wallet Debit Id', 'required');
			$this->form_validation->set_rules('wallet_credit_id', 'Wallet Credit Id', 'required');
			$this->form_validation->set_rules('transfer_otp', 'Transfer OTP', 'required');

			$this->form_validation->run();
			$error_array = $this->form_validation->error_array();

			$this->load->model('Coins_model');
			$acceptance_date = config_item('current_date');
			$transfer_data = $this->Coins_model->wallet_transfer_check_otp($wallet_debit_id,$wallet_credit_id,$transfer_otp,$acceptance_date);

			if(!isset($transfer_data['response']) || $transfer_data['response'] ==false)
			{
				$error_array['transfer_otp'] = "Please enter valid OTP";
			}

			if(count($error_array) == 0 )
	        {
	        	
	        	$status = 'success';
			    $message = "successfully transfered";
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