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

    function wallet_transfer_coins($transfer_userid,$userid,$coins,$coin_price,$payment_details,$created_date){
        $this->db->trans_start();
        $array = array('userid' => $userid,'from_user'=>$transfer_userid,'coin_price'=>$coin_price,'coins'=>$coins,'description'=>'Wallet Transfer Debit','created_date'=> $created_date);
        $this->db->set($array);
        $this->db->insert('referral_income');
        $wallet_debit_id = $this->db->insert_id();
        $this->db->trans_complete();

        $this->db->trans_start();
        $array = array('userid' => $transfer_userid,'from_user'=>$userid,'coin_price'=>$coin_price,'coins'=>$coins,'payment_details'=>$payment_details,'description'=>'Wallet Transfer Credit','created_date'=> $created_date);
        $this->db->set($array);
        $this->db->insert('referral_income');
        $wallet_credit_id = $this->db->insert_id();
        $this->db->trans_complete();
        return array("wallet_debit_id"=>$wallet_debit_id,"wallet_credit_id"=>$wallet_credit_id);
    }

    function wallet_transfer_check_otp($wallet_debit_id,$wallet_credit_id,$transfer_otp,$acceptance_date){
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->where('referral_income_id',$wallet_credit_id);
        $this->db->where('payment_details',$transfer_otp);
        $query = $this->db->get('referral_income');
        $main_data = array();
        $response = false;
        foreach($query->result() as $row)
        {

            $array = array('payment_details' => '','description'=>'Wallet Transfer','status'=>'Credit','acceptance_date'=>$acceptance_date);
            $this->db->where('referral_income_id', $wallet_credit_id);
            $res = $this->db->update('referral_income', $array);

            $array = array('payment_details' => '','description'=>'Wallet Transfer','status'=>'Debit','acceptance_date'=>$acceptance_date);
            $this->db->where('referral_income_id', $wallet_debit_id);
            $res = $this->db->update('referral_income', $array);
            
            $response = true;
        }
        $this->db->trans_complete();
        

        return array("response"=>$response);
        
    }
}