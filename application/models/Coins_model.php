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

    function sell_coins($userid,$coins,$amount,$coin_price,$payment_details,$payment_type,$created_date){
        $this->db->trans_start();
        $array = array('userid' => $userid,'amount'=>$amount,'coin_price'=>$coin_price,'coins'=>$coins,'payment_details'=>$payment_details,'payment_type'=>$payment_type,'purchase_date'=> $created_date,'status'=>'Debit Request');
        $this->db->set($array);
        $this->db->insert('user_coins');
        $last_inserted_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_inserted_id;
    }

    function wallet_transfer_coins($transfer_userid,$userid,$coins,$amount,$coin_price,$payment_details,$created_date){
        $this->db->trans_start();
        $array = array('userid' => $userid,'from'=>$transfer_userid,'amount'=>$amount,'coin_price'=>$coin_price,'coins'=>$coins,'payment_type'=>'Wallet Transfer Debit','purchase_date'=> $created_date);
        $this->db->set($array);
        $this->db->insert('user_coins');
        $wallet_debit_id = $this->db->insert_id();
        $this->db->trans_complete();

        $this->db->trans_start();
        $array = array('userid' => $transfer_userid,'from'=>$userid,'amount'=>$amount,'coin_price'=>$coin_price,'coins'=>$coins,'payment_details'=>$payment_details,'payment_type'=>'Wallet Transfer Credit','purchase_date'=> $created_date);
        $this->db->set($array);
        $this->db->insert('user_coins');
        $wallet_credit_id = $this->db->insert_id();
        $this->db->trans_complete();
        return array("wallet_debit_id"=>$wallet_debit_id,"wallet_credit_id"=>$wallet_credit_id);
    }

    function wallet_transfer_check_otp($wallet_debit_id,$wallet_credit_id,$transfer_otp,$acceptance_date){
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->where('id',$wallet_credit_id);
        $this->db->where('payment_details',$transfer_otp);
        $query = $this->db->get('user_coins');
        $main_data = array();
        $response = false;
        foreach($query->result() as $row)
        {

            $array = array('payment_details' => '','payment_type'=>'Wallet Transfer','status'=>'Credit','acceptance_date'=>$acceptance_date);
            $this->db->where('id', $wallet_credit_id);
            $res = $this->db->update('user_coins', $array);

            $array = array('payment_details' => '','payment_type'=>'Wallet Transfer','status'=>'Debit','acceptance_date'=>$acceptance_date);
            $this->db->where('id', $wallet_debit_id);
            $res = $this->db->update('user_coins', $array);
            
            $response = true;
        }
        $this->db->trans_complete();
        

        return array("response"=>$response);
        
    }
}