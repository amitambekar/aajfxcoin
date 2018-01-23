<?php

class Common_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();	
    }

    function checkUsernameExists($username)
    {
    	$this->db->trans_start();
    	$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$username);
		$query = $this->db->get();
		$count = $query->num_rows();
		$this->db->trans_complete();
		if($count > 0)
		{
			return true;
		}else
		{
			return false;
		}
    }

    function checkExists($tablename,$where_clause = array())
    {
    	$this->db->trans_start();
    	$this->db->select('*');
		$this->db->from($tablename);
		foreach ($where_clause as $key => $value) {
			$this->db->where($key,$value);
		}
		
		$query = $this->db->get();
		$count = $query->num_rows();
		$this->db->trans_complete();
		if($count > 0)
		{
			return true;
		}else
		{
			return false;
		}
    }

    function checkAlignmentSetOfUser($username)
	{
		$this->db->trans_start();
		$this->db->select('user_settings.user_alignment,users.userid');
		$this->db->where('users.username',$username);
		$this->db->join('users', 'users.userid = user_settings.userid','left');
		$query = $this->db->get('user_settings');
		
		$data = array();
		if($query->num_rows()==1){
		    foreach($query->result() as $row)
			{
				$data = array(
							'userid'=>$row->userid,
							'user_alignment'=>$row->user_alignment,
							);
			}
		}    
		$this->db->trans_complete();
		return $data;
	}

	function getUserInfo($userid=0,$username = '',$limit = null,$offset = null)
    {
    	$this->db->trans_start();
    	$this->db->select('*');
    	if($userid > 0)
    	{
    		$this->db->where('users.userid',$userid);
    	}
    	if($username != '')
    	{
    		$this->db->where('users.username',$username);
    	}
		$this->db->join('users', 'users.userid = userdetails.userid','left');
		$this->db->join('user_settings', 'user_settings.userid = users.userid','left');
		
		if($limit != '' && $offset != ''){
	       $this->db->limit($limit, $offset);
	    }
		$query = $this->db->get('userdetails');
		
		$data = array();
		$result = array();
		foreach($query->result() as $row)
		{
			$coin_list = array();
			/*if($userid > 0 || $username != '')
			{
				$this->db->select('*');
		    	$this->db->where('user_coins.userid',$row->userid);
		    	$query1 = $this->db->get('user_coins');
		    	foreach($query1->result() as $row1)
		    	{
		    		$coin_list[] = (array)$row1;
		    	}				
			}*/
			$data = array(
							'userid'=>$row->userid,
							'username'=>$row->username,
							'sponsorid'=>$row->sponsorid,
							'placementid'=>$row->placementid,
							'placement'=>$row->placement,
							'leftmember'=>$row->leftmember,
							'rightmember'=>$row->rightmember,
							'firstname'=>$row->firstname,
							'middlename'=>$row->middlename,
							'lastname'=>$row->lastname,
							'email'=>$row->email,
							'profile_image'=>$row->profile_image,
							'address'=>$row->address,
							'city'=>$row->city,
							'state'=>$row->state,
							'country'=>$row->country,
							'pincode'=>$row->pincode,
							'dateofbirth'=>$row->dateofbirth,
							'mobile'=>$row->mobile,
							'gender'=>$row->gender,
							'pancard'=>$row->pancard,
							'pancard_image'=>$row->pancard_image,
							'aadhaar_card'=>$row->aadhaar_card,
							'aadhaar_card_image'=>$row->aadhaar_card_image,
							'bank_account_holder_name'=>$row->bank_account_holder_name,
							'bank_name'=>$row->bank_name,
							'branch'=>$row->branch,
							'account_number'=>$row->account_number,
							'ifsc_code'=>$row->ifsc_code,
							'user_alignment'=>$row->user_alignment,
							'role_id'=>$row->role_id,
							'status'=>$row->status,
							'created_date'=>$row->created_date,
							'coin_list'=>$coin_list
							);
			if($userid == 0 and $username == '')
			{
				$result[] = $data; 
			}else
			{
				$result = $data;
			}
		}
    	$this->db->trans_complete();
		return $result;
    }

    function getNotifications($notification_id = 0)
    {
    	$this->db->trans_start();
    	$this->db->select('*');
		if($notification_id > 0)
		{
			$this->db->where('notification_id',$notification_id);
		}
		$query = $this->db->get('notifications');
		
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = array(
							'notification_id'=>$row->notification_id,
							'notification'=>$row->notification,
							'notification_status'=>$row->notification_status,
							'notification_created_time'=>$row->notification_created_time,
							);

		if($notification_id > 0)
		{
			$main_data = $data;
		}else
		{
			array_push($main_data,$data);
		}
		}
    	$this->db->trans_complete();
		return $main_data;
    }

    function getNews($news_id = 0)
    {
    	$this->db->trans_start();
    	$this->db->select('*');
		if($news_id > 0)
		{
			$this->db->where('news_id',$news_id);
		}
		$query = $this->db->get('news_master');
		
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = array(
							'news_id'=>$row->news_id,
							'news_heading'=>$row->news_heading,
							'news_desc'=>htmlspecialchars_decode($row->news_desc),
							'created_date'=>$row->created_date,
							);

		if($news_id > 0)
		{
			$main_data = $data;
		}else
		{
			array_push($main_data,$data);
		}
		}
    	$this->db->trans_complete();
		return $main_data;
    }
    
    function getDirectUsers($userids=array(''))
    {
    	$this->db->trans_start();
    	
    	$this->db->select('users.userid,users.sponsorid,users.firstname,users.middlename,users.lastname,users.username,u.username as sponsorname,u.userid as sponsor_id,users.created_date,users.status');
    	$this->db->where_in('users.sponsorid',$userids);
    	$this->db->join("(select username,userid from users where userid IN (".implode(",",$userids).") ) as u", 'users.sponsorid = u.userid','left');
		$query = $this->db->get('users');
		
		$data = array();
		foreach($query->result() as $row)
		{
			$data[] = (array)$row;		
		}
    	$this->db->trans_complete();
		return $data;
    }

    function getParentDirectUsers($userids=array(''))
    {
    	$this->db->trans_start();
    	$this->db->select('*');
    	$this->db->where_in('users.userid',$userids);
		$query = $this->db->get('users');
		
		$data = array();
		foreach($query->result() as $row)
		{
			$data[] = (array)$row;		
		}
    	$this->db->trans_complete();
		return $data;
    }

    function getCoins($coin_id = 0)
    {
    	$this->db->trans_start();
    	$this->db->select('*');
		if($coin_id > 0)
		{
			$this->db->where('coin_id',$coin_id);
		}
		$query = $this->db->get('coin_master');
		
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = (array)$row;

		if($coin_id > 0)
		{
			$main_data = $data;
		}else
		{
			array_push($main_data,$data);
		}
		}
    	$this->db->trans_complete();
		return $main_data;
    }

    function getCoinPrice($lastest = false)
    {
    	$this->db->trans_start();
    	$this->db->select('*');
		if($lastest == true)
		{
			$this->db->limit(1);
		}
		$this->db->order_by('coin_price_id', 'desc');
		$query = $this->db->get('coin_price');
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = (array)$row;
			if($lastest == true)
			{
				$main_data = $data;
			}else
			{
				array_push($main_data,$data);
			}
		}
    	$this->db->trans_complete();
		return $main_data;
    }


    function getUserCoin($userid = 0,$agg_qry='',$filters=array())
    {
    	$this->db->trans_start();
    	if($agg_qry == '')
    	{
    		$this->db->select('user_coins.*,users.*,u1.transfer_username,user_coins.id as user_coins_id,user_coins.status as user_coins_status');	
    	}else
    	{
    		$this->db->select($agg_qry);	
    	}
    	
		if($userid > 0)
		{
			$this->db->where('user_coins.userid',$userid);
		}

		foreach($filters as $key=>$value)
		{
			$this->db->where($key,$value);
		}
		$this->db->join('users', 'users.userid = user_coins.userid','left');
		//'LEFT JOIN (SELECT u.username as transfer_username,u.userid FROM users u ) as u1 ON `user_coins`.`from` = u1.`userid`'

		$this->db->join('(SELECT u.username as transfer_username,u.userid FROM users u ) as u1', 'u1.userid = user_coins.from_user','left');
		$query = $this->db->get('user_coins');
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = (array)$row;
			if($agg_qry != '')
			{
				$main_data = $data;
			}else
			{
				array_push($main_data,$data);
			}
		}
    	$this->db->trans_complete();
		return $main_data;
    }

    function getUserCoinAmount($userid = 0,$agg_func='')
    {
    	$coin_price_data = getCoinPrice(true);
    	$coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);

    	$this->db->trans_start();
    	if($agg_func == '')
    	{
    		$this->db->select('*');	
    	}else
    	{
    		$this->db->select($agg_func.'(user_coins.coins)*'.$coin_price.' as total_amount');	
    	}
    	
		if($userid > 0)
		{
			$this->db->where('userid',$userid);
		}
		$query = $this->db->get('user_coins');
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = (array)$row;
			if($agg_func != '')
			{
				$main_data = $data;
			}else
			{
				array_push($main_data,$data);
			}
		}
    	$this->db->trans_complete();
		return $main_data;
    }

    function getTotalCoins()
    {
    	$this->db->trans_start();
    	$this->db->select('sum(coin_master.coins) as total_coins');
    	$query = $this->db->get('coin_master');
		$total_coins = 0;
		foreach($query->result() as $row)
		{
			$total_coins = $row->total_coins;
		}
    	$this->db->trans_complete();
		return $total_coins;
    }

    function getUserCoins()
    {
    	$this->db->trans_start();
    	//credit
    	$this->db->select('sum(user_coins.coins) as total_credit');
    	$status = array('Bonus','accepted','requested','Credit');
    	$this->db->where_in('status',$status);
    	$query = $this->db->get('user_coins');
		$total_credit =0;
		foreach($query->result() as $row)
		{
			$total_credit = $row->total_credit;
		}
		//debit
		$this->db->select('sum(user_coins.coins) as total_debit');
    	$status = array('Debit','Debit Request');
    	$this->db->where_in('status',$status);
    	$query = $this->db->get('user_coins');
		$total_debit =0;
		foreach($query->result() as $row)
		{
			$total_debit = $row->total_debit;
		}
		//amitjain debit
		$this->db->select('sum(user_coins.coins) as total_debit_from_amitjain');
    	$status = array('Debit','Debit Request');
    	$this->db->where_in('status',$status);
    	$this->db->where_in('userid',1);
    	$query1 = $this->db->get('user_coins');
		$total_debit_from_amitjain =0;
		foreach($query1->result() as $row)
		{
			$total_debit_from_amitjain = $row->total_debit_from_amitjain;
		}
    	$this->db->trans_complete();
		$result = array();
		$result['total_credit'] = $total_credit;
		$result['total_debit'] = $total_debit;
		$result['total_debit_from_amitjain'] = $total_debit_from_amitjain;
		$result['coins_used'] = $total_credit - ($total_debit-$total_debit_from_amitjain);
		return $result;
    }

    function getReferralCoins()
    {
    	$this->db->trans_start();
    	//credit
    	$this->db->select('sum(referral_income.coins) as total_credit');
    	$status = array('Credit');
    	$this->db->where_in('status',$status);
    	$query = $this->db->get('referral_income');
		$total_credit =0;
		foreach($query->result() as $row)
		{
			$total_credit = $row->total_credit;
		}
		//debit
		$this->db->select('sum(referral_income.coins) as total_debit');
    	$status = array('Debit','Debit Request');
    	$this->db->where_in('status',$status);
    	$query = $this->db->get('referral_income');
		$total_debit =0;
		foreach($query->result() as $row)
		{
			$total_debit = $row->total_debit;
		}
		//amitjain debit
		$this->db->select('sum(referral_income.coins) as total_debit_from_amitjain');
    	$status = array('Debit','Debit Request');
    	$this->db->where_in('status',$status);
    	$this->db->where_in('userid',1);
    	$query1 = $this->db->get('referral_income');
		$total_debit_from_amitjain =0;
		foreach($query1->result() as $row)
		{
			$total_debit_from_amitjain = $row->total_debit_from_amitjain;
		}
    	$this->db->trans_complete();
		$result = array();
		$result['total_credit'] = $total_credit;
		$result['total_debit'] = $total_debit;
		$result['total_debit_from_amitjain'] = $total_debit_from_amitjain;
		$result['coins_used'] = $total_credit - ($total_debit-$total_debit_from_amitjain);
		return $result;
    }

    function getReferralIncome($userid = 0,$filters = array())
    {
    	$this->db->trans_start();
    	$this->db->select('referral_income.*,users.*,u1.transfer_username,referral_income.status as payment_status,referral_income.created_date as referral_created_date');	
    	
		if($userid > 0)
		{
			$this->db->where('referral_income.userid',$userid);
		}

		foreach($filters as $key=>$value)
		{
			$this->db->where($key,$value);
		}
		$this->db->join('users', 'users.userid = referral_income.userid','left');
		$this->db->join('(SELECT u.username as transfer_username,u.userid FROM users u ) as u1', 'u1.userid = referral_income.from_user','left');
		$query = $this->db->get('referral_income');
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = (array)$row;
			array_push($main_data,$data);	
		}
    	$this->db->trans_complete();
		return $main_data;
    }

    function getReferralIncomeDetails($userid=0)
    {
    	$this->db->trans_start();
    	$where_string = '';
    	if($userid > 0)
    	{
    		$where_string = " AND u.userid=".$userid;
    	}

    	$sql_query = "SELECT u.userid,u.username,COALESCE(total_payout.total_coins,0) as Total_Coins,COALESCE(total_paid.paid_coins,0) as Paid_Coins,COALESCE((COALESCE(total_payout.total_coins,0)-COALESCE(total_paid.paid_coins,0)),0) as Remaining_Coins FROM users u LEFT JOIN (SELECT a1.userid,sum(COALESCE(a1.coins,0))*1.0 as total_coins  FROM referral_income a1 WHERE a1.status='Credit' group by a1.userid) as total_payout ON u.userid=total_payout.userid LEFT JOIN (SELECT a2.userid,sum(COALESCE(a2.coins,0))*1.0 as paid_coins FROM referral_income a2 WHERE a2.status IN ('Debit','Debit Request') group by a2.userid) as total_paid ON u.userid=total_paid.userid WHERE Total_Coins > 0 ".$where_string." ORDER BY Total_Coins DESC";

    	$query = $this->db->query($sql_query);
		
		$data = array();
		foreach($query->result() as $row)
		{
			if($userid > 0)
			{
				$data = (array)$row;	
			}else
			{
				$data[] = (array)$row;
			}		
		}
    	$this->db->trans_complete();
		return $data;
    }

    function getROIIncome($userid = 0)
    {
    	$this->db->trans_start();
    	$this->db->select('*,return_of_interest.status as payment_status');	
    	
		if($userid > 0)
		{
			$this->db->where('return_of_interest.userid',$userid);
		}
		$this->db->join('users', 'users.userid = return_of_interest.userid','left');
		$query = $this->db->get('return_of_interest');
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = (array)$row;
			array_push($main_data,$data);	
		}
    	$this->db->trans_complete();
		return $main_data;
    }

    function getROIIncomeDetails($userid=0)
    {
    	$this->db->trans_start();
    	$where_string = '';
    	if($userid > 0)
    	{
    		$where_string = " AND u.userid=".$userid;
    	}

    	$sql_query = "SELECT u.userid,u.username,COALESCE(total_payout.total_coins,0) as Total_Coins,COALESCE(total_paid.paid_coins,0) as Paid_Coins,(COALESCE(total_payout.total_coins,0)-COALESCE(total_paid.paid_coins,0)) as Remaining_Coins FROM users u LEFT JOIN (SELECT a1.userid,sum(COALESCE(a1.coins,0))*1.0 as total_coins  FROM return_of_interest a1 WHERE a1.status='Credit' group by a1.userid) as total_payout ON u.userid=total_payout.userid LEFT JOIN (SELECT a2.userid,sum(COALESCE(a2.coins,0))*1.0 as paid_coins FROM return_of_interest a2 WHERE a2.status IN ('Debit','Debit Request') group by a2.userid) as total_paid ON u.userid=total_paid.userid WHERE Total_Coins > 0 ".$where_string." ORDER BY Total_Coins DESC";

    	$query = $this->db->query($sql_query);
		
		$data = array();
		foreach($query->result() as $row)
		{
			if($userid > 0)
			{
				$data = (array)$row;	
			}else
			{
				$data[] = (array)$row;
			}		
		}
    	$this->db->trans_complete();
		return $data;
    }

    function getBonusIncome($userid = 0)
    {
    	$this->db->trans_start();
    	$this->db->select('*,bonus.status as payment_status');	
    	
		if($userid > 0)
		{
			$this->db->where('bonus.userid',$userid);
		}
		$this->db->join('users', 'users.userid = bonus.userid','left');
		$query = $this->db->get('bonus');
		$main_data = array();
		$data = array();
		foreach($query->result() as $row)
		{
			$data = (array)$row;
			array_push($main_data,$data);	
		}
    	$this->db->trans_complete();
		return $main_data;
    }

    function getBonusIncomeDetails($userid=0)
    {
    	$this->db->trans_start();
    	$where_string = '';
    	if($userid > 0)
    	{
    		$where_string = " AND u.userid=".$userid;
    	}

    	$sql_query = "SELECT u.userid,u.username,COALESCE(total_payout.total_coins,0) as Total_Coins,COALESCE(total_paid.paid_coins,0) as Paid_Coins,(COALESCE(total_payout.total_coins,0)-COALESCE(total_paid.paid_coins,0)) as Remaining_Coins FROM users u LEFT JOIN (SELECT a1.userid,sum(COALESCE(a1.coins,0))*1.0 as total_coins  FROM bonus a1 WHERE a1.status='Credit' group by a1.userid) as total_payout ON u.userid=total_payout.userid LEFT JOIN (SELECT a2.userid,sum(COALESCE(a2.coins,0))*1.0 as paid_coins FROM bonus a2 WHERE a2.status='Debit' group by a2.userid) as total_paid ON u.userid=total_paid.userid WHERE Total_Coins > 0 ".$where_string." ORDER BY Total_Coins DESC";

    	$query = $this->db->query($sql_query);
		
		$data = array();
		foreach($query->result() as $row)
		{
			if($userid > 0)
			{
				$data = (array)$row;	
			}else
			{
				$data[] = (array)$row;
			}		
		}
    	$this->db->trans_complete();
		return $data;
    }

    function getUserCoinsDetails($userid=0)
    {
    	$this->db->trans_start();
    	$where_string = '';
    	if($userid > 0)
    	{
    		$where_string = " WHERE u.userid=".$userid;
    	}

    	$sql_query = "SELECT u.userid,u.username,COALESCE(Purchased_Coins,0) as Purchased_Coins,COALESCE(Remaining_Coins,0)-COALESCE(Debited_Coins,0) as Remaining_Coins,COALESCE(Debited_Coins,0) as Debited_Coins,COALESCE(Purchased_Amount,0) as Purchased_Amount,COALESCE(Remaining_Amount,0)-COALESCE(Debited_Amount,0) as Remaining_Amount,COALESCE(Debited_Amount,0) as Debited_Amount from users u LEFT JOIN (SELECT uc1.userid,COALESCE(sum(uc1.coins),0) as Purchased_Coins,COALESCE(sum(uc1.amount),0) as Purchased_Amount from user_coins uc1 where uc1.status IN ('Bonus','accepted','requested') group by uc1.userid) as purchased ON purchased.userid=u.userid LEFT JOIN (SELECT uc2.userid,COALESCE(sum(uc2.coins),0) as Remaining_Coins,COALESCE(sum(uc2.amount),0) as Remaining_Amount from user_coins uc2 where uc2.status IN ('Credit') group by uc2.userid) as remaining ON u.userid=remaining.userid LEFT JOIN (SELECT uc3.userid,COALESCE(sum(uc3.coins),0) as Debited_Coins,COALESCE(sum(uc3.amount),0) as Debited_Amount from user_coins uc3 where uc3.status IN ('Debit','Debit Request') group by uc3.userid) as debit ON u.userid=debit.userid ".$where_string." ORDER BY Purchased_Coins DESC";
    	$query = $this->db->query($sql_query);
		
		$data = array();
		foreach($query->result() as $row)
		{
			if($userid > 0)
			{
				$data = (array)$row;	
			}else
			{
				$data[] = (array)$row;
			}		
		}
    	$this->db->trans_complete();
		return $data;
    }
}