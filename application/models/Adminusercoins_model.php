<?php

class Adminusercoins_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();	
    }
    
    function deleteReferralCoinsRequest($referral_income_id){
		$this->db->trans_start();
        $this->db->where('referral_income_id', $referral_income_id);
        $res = $this->db->delete('referral_income'); 
        $this->db->trans_complete();
        return true;
    }

    function deleteUserCoinsRequest($user_coins_id){
        $this->db->trans_start();
        $this->db->where('id', $user_coins_id);
        $res = $this->db->delete('user_coins'); 
        $this->db->trans_complete();
        return true;
    }

    function userCoinsRequestAction($user_coins_id,$status,$userid,$acceptance_date)
    {
        $this->db->trans_start();
        $array = array('status' => $status,'acceptance_date'=> $acceptance_date);
        $this->db->where('id', $user_coins_id);
        $res = $this->db->update('user_coins', $array);
        
        $array = array('status' => 'active');
        $this->db->where('userid', $userid);
        $res = $this->db->update('users', $array);
        $this->db->trans_complete();
        return $res;
    }

    function sell_request_for_roi_purchased_coins($user_coins_id,$amount,$coins,$coin_price,$description,$accepted_date)
    {
        $this->db->trans_start();
        $array = array('amount'=>$amount,'coins'=>$coins,'coin_price'=>$coin_price,'description'=>$description,'status' => 'Debit','acceptance_date'=> $accepted_date);
        $this->db->where('id', $user_coins_id);
        $res = $this->db->update('user_coins', $array);
        $this->db->trans_complete();
        return $res;
    }

    function sell_request_referral_coins($referral_income_id,$coins,$coin_price,$description,$accepted_date)
    {
        $this->db->trans_start();
        $array = array('coins'=>$coins,'coin_price'=>$coin_price,'description'=>$description,'status' => 'Debit','acceptance_date'=> $accepted_date);
        $this->db->where('referral_income_id', $referral_income_id);
        $res = $this->db->update('referral_income', $array);
        $this->db->trans_complete();
        return $res;
    }
}