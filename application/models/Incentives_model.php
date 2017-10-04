<?php

class Incentives_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();	
    }
    
    function sell_referral_coins($userid,$coins,$amount,$coin_price,$payment_details,$payment_type,$created_date){
        $this->db->trans_start();
        $array = array('userid' => $userid,'from_user'=>$userid,'coin_price'=>$coin_price,'coins'=>$coins,'payment_details'=>$payment_details,'payment_type'=>$payment_type,'created_date'=> $created_date,'status'=>'Debit Request');
        $this->db->set($array);
        $this->db->insert('referral_income');
        $last_inserted_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_inserted_id;
    }
}