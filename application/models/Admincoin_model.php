<?php

class Admincoin_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();	
    }
    
    function addCoins($released_coins,$created_date){
		$this->db->trans_start();
        $array = array('coins' => $released_coins,'created_date'=>$created_date);
		$this->db->set($array);
		$this->db->insert('coin_master');
		$last_inserted_id = $this->db->insert_id();
		$this->db->trans_complete();
        return $last_inserted_id;
    }

    function add_coin_price($new_price,$created_date,$mode){
        $this->db->trans_start();
        $array = array('coin_price' => $new_price,'created_date'=>$created_date,'mode'=>$mode);
        $this->db->set($array);
        $this->db->insert('coin_price');
        $last_inserted_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_inserted_id;
    }

    function deleteCoin($coin_id){
         $this->db->trans_start();
        $this->db->where('coin_id', $coin_id);
        $res = $this->db->delete('coin_master'); 
        $this->db->trans_complete();
        return 1;
    }
}