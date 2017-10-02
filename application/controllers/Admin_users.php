<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_users extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
       	$this->load->model('Adminusers_model');
   		$this->menu_active = 'Admin_news';
    }

	public function index()
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		
		$this->load->view('template/admin/users',$data);
	}

	public function view($userid = 0)
	{
		$session_data = $this->session->userdata;
		$data = array();
		$data['session_data'] = $session_data;
		$data['userid']=$userid;
		
		$this->load->view('template/admin/view_user',$data);
	}

	public function give_bonus()
	{
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$this->load->library('form_validation');
			$coins = $this->input->post('coins');
			$description = $this->input->post('desc');
			$userid = $this->input->post('userid');
			$date = config_item('current_date');
			$this->form_validation->set_rules('coins', 'Coins', 'required');
			$this->form_validation->set_rules('desc', 'Description', 'required');
			$this->form_validation->set_rules('userid', 'User ID', 'required');
			
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();
	        
	        if(count($error_array) == 0 )
	        {
	        	$coin_price_data = getCoinPrice(true);
	        	$coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);
	        	$this->Adminusers_model->give_bonus($userid,$coins,$coin_price,$description,$date);	
			    $status = 'success';
			    $message = 'Added successfully';
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

	function delete_user(){
		if($this->input->post())
		{
			$status = '';
			$message = '';
			$userid = $this->input->post('userid');

			$this->load->library('form_validation');
			$this->form_validation->set_rules('userid', 'User ID', 'required');
			
			$this->form_validation->run();
	        $error_array = $this->form_validation->error_array();

	        if(count($error_array) == 0 )
	        {
	        	$this->Adminusers_model->delete_user($userid);
		        $status = 'success';
			    $message = 'Deleted successfully';	
	        }else
	        {
	        	$status = 'error';
	        	$message = $error_array;
	        }
			
	        $response = array('status'=>$status,'message'=>$message);
			echo responseObject($response);	
		}
    }
}
