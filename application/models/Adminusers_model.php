<?php

class Adminusers_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();  
    }
    
    function give_bonus($userid,$coins,$coin_price,$description,$created_date){
        $amount = $coins*$coin_price;
        $this->db->trans_start();
        $array = array('userid' => $userid,'amount'=>$amount,'coins'=>$coins,'coin_price'=>$coin_price,'description'=>$description,'status'=>'Bonus Credit','purchase_date'=>$created_date,'acceptance_date'=>$created_date);
        $this->db->set($array);
        $this->db->insert('user_coins');
        $last_inserted_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_inserted_id;
    }

    function delete_user($userid){
        $this->db->trans_start();
        $this->db->where('userid', $userid);
        $this->db->delete('users');
        $this->db->where('userid', $userid);
        $this->db->delete('userdetails');
        $this->db->where('userid', $userid);
        $this->db->delete('user_settings');
        $this->db->where('userid', $userid);
        $this->db->delete('user_coins');
        //$this->db->where('userid', $userid);
        //$this->db->delete('payout');
        $this->db->trans_complete();
        return 1;
    }
}
