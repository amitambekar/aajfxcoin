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

			$released_coins = getReleasedUserCoins($userid,'sum',array('user_coins.status'=>'Credit'));
			if($released_coins < $coins)
			{
				//$error_array['coins'] = 'Not enough released coins to sell.';	
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
}