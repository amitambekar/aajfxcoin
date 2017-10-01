<?php

class Adminusercoins_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();	
    }
    
    function deleteUserCoinsRequest($user_coins_id){
		$this->db->trans_start();
        $this->db->where('id', $user_coins_id);
        $res = $this->db->delete('user_coins'); 
        $this->db->trans_complete();
        return true;
    }

    function userCoinsRequestAction($user_coins_id,$status,$userid)
    {
        $this->db->trans_start();
        $array = array('status' => $status,'acceptance_date'=> config_item('current_date'));
        $this->db->where('id', $user_coins_id);
        $res = $this->db->update('user_coins', $array);
        
        $array = array('status' => 'active');
        $this->db->where('userid', $userid);
        $res = $this->db->update('users', $array);
        $this->db->trans_complete();
        return $res;
    }
}