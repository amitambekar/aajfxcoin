<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_coin extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        $this->load->model('Admincoin_model');
   		$this->menu_active = 'coins';
    }

	public function index()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/admin/coin',$data);
	}

	public function coin_price()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$this->load->view('template/admin/coin_price',$data);
	}

	public function add_coins()
	{
		$status = 'error';
		$message = array("Bad Request");
		$status_code = 501;
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$released_coins = $this->input->post('released_coins');
			$created_date = config_item('current_date');

			$this->form_validation->set_rules('released_coins', 'Released Coins', 'required|numeric|greater_than[0]');
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();
	        
	        if(count($error_array) == 0 )
	        {
	        	$last_inserted_id = $this->Admincoin_model->addCoins($released_coins,$created_date);	
			    $status = 'success';
			    $message = 'Added successfully';
			    $status_code = 200;
	        }else
	        {
	        	$status = 'error';
	        	$message = $error_array;
	        	$status_code = 501;
	        }
		}
		$response = array('status'=>$status,'message'=>$message);
		echo responseObject($response,$status_code);
	}

	function delete_coin(){
		$status = 'error';
		$message = array("Bad Request");
		$status_code = 501;
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$coin_id = $this->input->post('coin_id');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('coin_id', 'Coin ID', 'required');
			
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();
	        if(count($error_array) == 0 )
	        {
	        	$this->Admincoin_model->deleteCoin($coin_id);
				$status = 'success';
			    $message = 'Deleted successfully';	
	        }else
	        {
	        	$status = 'error';
	        	$message = $error_array;
	        }
		}
		$response = array('status'=>$status,'message'=>$message);
		echo responseObject($response);	
    }

    public function add_coin_price()
	{
		$status = 'error';
		$message = array("Bad Request");
		$status_code = 501;
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$new_price = $this->input->post('new_price');
			$created_date = config_item('current_date');
			$mode = 'admin';
			$this->form_validation->set_rules('new_price', 'New Price', 'required|numeric|greater_than[0]');
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();
	        
	        if(count($error_array) == 0 )
	        {
	        	$last_inserted_id = $this->Admincoin_model->add_coin_price($new_price,$created_date,$mode);	
			    $status = 'success';
			    $message = 'Added successfully';
			    $status_code = 200;
	        }else
	        {
	        	$status = 'error';
	        	$message = $error_array;
	        	$status_code = 501;
	        }
		}
		$response = array('status'=>$status,'message'=>$message);
		echo responseObject($response,$status_code);
	}
}
