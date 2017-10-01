<?php

class Coins_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();	
    }
    
    function buy_coins($userid,$amount,$coin_price,$payment_details,$payment_type,$created_date){
		
        $coins = $amount / $coin_price;
        $this->db->trans_start();
        $array = array('userid' => $userid,'amount'=>$amount,'coin_price'=>$coin_price,'coins'=>$coins,'payment_details'=>$payment_details,'payment_type'=>$payment_type,'purchase_date'=> $created_date,'status'=>'requested');
		$this->db->set($array);
		$this->db->insert('user_coins');
		$last_inserted_id = $this->db->insert_id();
		$this->db->trans_complete();
        return $last_inserted_id;
    }
}