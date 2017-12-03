<?php
class Admin_summary_model extends CI_Model
{
    function __construct() {
        parent::__construct();	
    }
    
    function coins_summary(){
        $this->db->trans_start();
        $this->db->select('sum(coins) as total_coins');
        $this->db->from('coin_master');
        $query = $this->db->get();
        $total_coins = 0;
        foreach($query->result() as $row)
        {
            $total_coins = $total_coins+$row->total_coins;
        }
        
        $this->db->select('sum(coins) as user_total_coins');
        $this->db->from('user_coins');
        $query1 = $this->db->get();
        $user_total_coins = 0;
        foreach($query1->result() as $row)
        {
            $user_total_coins = $user_total_coins+$row->user_total_coins;
        }

        echo $total_coins;
        echo $user_total_coins;
		$this->db->trans_complete();
    }
}