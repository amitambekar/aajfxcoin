<?php

class Admin_payout_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();	
    }

    function payRemainingReferralIncome($userid,$from_user,$coin_price,$remaining_coins,$payment_details,$payment_type,$description,$created_date,$acceptance_date)
    {
        $this->db->trans_start();
        $array = array('userid' => $userid,'from_user'=>$from_user,'coin_price'=>$coin_price,'coins' => $remaining_coins,'payment_details'=>$payment_details,'payment_type'=>$payment_type,'description'=>$description,'status'=>'Debit','created_date'=>$created_date,'acceptance_date'=>$acceptance_date);
        $this->db->set($array);
        $this->db->insert('referral_income');
        $last_inserted_id = $this->db->insert_id();
        $this->db->trans_complete();
    }
    
    function payRemainingUserCoinsIncome($userid,$from_user,$reference_id,$amount,$coin_price,$remaining_coins,$payment_details,$payment_type,$description,$status,$purchase_date,$acceptance_date)
    {
        $this->db->trans_start();
        $array = array('userid' => $userid,'from_user'=>$from_user,'reference_id'=>$reference_id,'amount'=>$amount,'coin_price'=>$coin_price,'coins' => $remaining_coins,'payment_details'=>$payment_details,'payment_type'=>$payment_type,'description'=>$description,'status'=>$status,'purchase_date'=>$purchase_date,'acceptance_date'=>$acceptance_date);
        $this->db->set($array);
        $this->db->insert('user_coins');
        $last_inserted_id = $this->db->insert_id();
        $this->db->trans_complete();
    }
}