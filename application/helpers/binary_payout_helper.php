<?php
class Payout{		
		function __construct() {
			$CI =& get_instance();
			$CI->load->database();
	        $this->conn = mysqli_connect($CI->db->hostname, $CI->db->username, $CI->db->password,$CI->db->database);
	        
	        //$this->payout_perc = array('1'=>7,'2'=>3,'3'=>1,'4'=>1,'5'=>0.5,'6'=>0.3,'7'=>0.2);
	        $this->payout_perc = array('1'=>5,'2'=>1,'3'=>1,'4'=>0.5,'5'=>0.5,'6'=>0.5,'7'=>0.5);
	        $this->expiry_months = 30;
	    }

		function referral_bonus($date,$userid,$user_coins_id)
		{
			$coin_price_data = getCoinPrice(true);
	        //$coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);
			$coin_price = 2.00;
			$select = "SELECT uc.coins from user_coins uc WHERE uc.id= '".$user_coins_id."' AND uc.status='accepted'";
			$result = mysqli_query($this->conn,$select);
			while($row = mysqli_fetch_array($result))
			{

				$tree = getTreeParentDirectUsers($userid);
				for($j = 1;$j <= 7; $j++)
				{
					$update = "UPDATE referral_income set status='Credit' WHERE userid=".$userid." AND status='level ".$j."'";
					mysqli_query($this->conn,$update);
				}
				for($i = 1;$i <= count($tree); $i++)
				{
					$coins = $row['coins']*($this->payout_perc[$i]/100);
					$status = 'level '.$i;
					if($tree[$i]['status'] == 'active')
					{
						$status = 'Credit';
					}
					$insert = "INSERT INTO referral_income(userid,from_user,coin_price,coins,description,status,created_date) VALUES('".$tree[$i]['userid']."','".$userid."','".$coin_price."','".$coins."','Referral income level ".$i."','".$status."','".$date."')";
					mysqli_query($this->conn,$insert);
				}
			}
		}

		function credit_monthly_payout($date)
		{
			global $CI;
			$months = 30;
			$CI->load->model('Admin_payout_model');

			$coin_price_data = getCoinPrice(true);
	        $coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);
	        $select = "SELECT * FROM user_coins WHERE status IN ('Bonus','accepted') AND PERIOD_DIFF(EXTRACT(YEAR_MONTH FROM \"".$date."\"),EXTRACT(YEAR_MONTH FROM acceptance_date))<=".$months;
	        $result = mysqli_query($this->conn,$select);
	        while($row = mysqli_fetch_array($result))
	        {
	        	$userid = $row['userid'];
	        	$coins = $row['coins']/$months;
	        	$amount = $coins*$coin_price;
	        	
	        	$payment_details = "Cheque";
	        	$payment_type = "Bank";
	        	$description = "Paid";
	        	$status = 'Credit';
	        	$CI->Admin_payout_model->payRemainingUserCoinsIncome($userid,0,$amount,$coin_price,$coins,$payment_details,$payment_type,$description,$status,$date,$date);
	        }
		}
	}
?>