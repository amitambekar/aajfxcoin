<?php
$CI =& get_instance();
function dump($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function curl_request($url,$method,$useragent,$post_data=array())
{
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here

	$data = array();
	$data[CURLOPT_RETURNTRANSFER] = 1;
	$data[CURLOPT_URL] = $url;
	$data[CURLOPT_USERAGENT] = $useragent;
	if($method == "POST")
	{
		$data[CURLOPT_POST] = 1;	
	}
	$data[CURLOPT_POSTFIELDS] = $post_data;

	curl_setopt_array($curl, $data);
	// Send the request & save response to $resp
	$result = curl_exec($curl);
	if(!$result){
		die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
	}
	// Close request to clear up some resources
	curl_close($curl);
	return $result;	
}

function send_email($data = array()) {
	global $CI;
	$CI->load->library('email');

	$to = $data['to'];
	$subject = $data['subject'];
	$html = $data['html'];
	if(isset($data['from']) && $data['from'] != '')
	{
		$from = $data['from']['email'];
		$name = $data['from']['name'];			
	}else{
		$from = "info@aajfxcoin.com";
		$name = "AajFx COIN";						
	}


	$config['protocol'] = 'sendmail';
	$config['mailpath'] = '/usr/sbin/sendmail';
	$config['charset'] = 'iso-8859-1';
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';

	$CI->email->initialize($config);

	$CI->email->from($from, $name);
	$CI->email->to($to);

	$CI->email->subject($subject);
	$CI->email->message($html);
	//echo $html;
	//$CI->email->send();
	//print_r($CI->email->print_debugger());
}

function send_sms($mobileNumber,$message)
{
	global $CI;
    $message = urlencode($message);
    //Prepare you post parameters
    $authKey = "170760Awq16uWKNK0j599947b0";
    $senderId = "ONLINE";
    $route = "transactional";
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route
    );
    $url="https://control.msg91.com/api/sendhttp.php";    
    $result = 'Mobile Number not valid';
    if(strlen($mobileNumber) > 5)
    {
    	//$result = curl_request($url,"POST","MSG 91",$postData);
    }
   	return $result;
}

#send_sms("917741823310","hello");
function responseObject($response = array(),$status_code=200)
{
	http_response_code($status_code);
	header('Content-type: application/json');
	return json_encode($response);
}

function imagePath($path,$image_type,$width = 70,$height=70,$timthumb=true)
{
	if($image_type == 'profile')
	{
		$path = 'uploads/profile/'.$path;
	}else if($image_type == 'packages')
	{
		$path = 'uploads/packages/'.$path;
	}
	$h = '';
	$w = '';
	if($height > 0)
	{
		$h = "&h=".$height;
	}
	if($width > 0)
	{
		$w = "&w=".$width;
	}
	if($timthumb ==true)
	{
		return base_url('timthumb.php?src='.base_url($path).$w.$h);	
	}else
	{
		return base_url().$path;	
	}
	//return base_url('uploads/'.$path);
}

function imagePathMyNetwork($package_list,$width = 70,$height=70)
{
	if(in_array(1, $package_list))
	{
		$color = 'male-icon.png';
	}
	if(in_array(2, $package_list))
	{
		$color = 'male-icon-1.png';
	}
	if(in_array(3, $package_list))
	{
		$color = 'male-icon2.png';
	}

	if(in_array(4, $package_list))
	{
		$color = 'male-icon2.png';
	}

	if(in_array(6, $package_list))
	{
		$color = 'male-icon2.png';
	}

	if(count($package_list) == 0)
	{
		$color = 'male-icon-3.png';
	}

	if(in_array("default", $package_list))
	{
		$color = 'male-icon-5.png';
	}

	
	return base_url('timthumb.php?src='.base_url('assets/frontend/images/'.$color).'&w='.$width.'&h='.$height);
	//return base_url('uploads/'.$path);
}

function checkUsernameExists($username)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->checkUsernameExists($username);
	return $result;	
}

function checkEmailIDExists($tablename,$email)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->checkExists($tablename,$email);
	return $result;	
}

function checkMobileNumberExists($tablename,$mobile)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->checkExists($tablename,$mobile);
	return $result;	
}

function checkAlignmentSetOfUser($username)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->checkAlignmentSetOfUser($username);
	return $result;	
}

function getUserInfo($userid=0,$username='',$limit=null,$offset=null)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getUserInfo($userid,$username,$limit,$offset);
	return $result;	
}

function getNotifications($notification_id = 0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getNotifications($notification_id);
	return $result;	
}

function getNews($news_id = 0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getNews($news_id);
	return $result;	
}

function getDirectUsers($userids=array())
{
    global $CI;
    $CI->load->model('Common_model');
    $result = $CI->Common_model->getDirectUsers($userids);
    return $result; 
}

function getParentDirectUsers($userids=array())
{
   	global $CI;
   	$CI->load->model('Common_model');
   	$result = $CI->Common_model->getParentDirectUsers($userids);
   	return $result; 
}

function getTreeParentDirectUsers($userid=0)
{
	global $CI;
	$id= $userid;
	$tree = array();
	for($i = 1;$i <= 7 ;$i++)
	{
		if($id > 0)
		{
			$result = getParentDirectUsers($id);
			$id = 0;
			foreach ($result as $row) {
				if($row['sponsorid'] > 0)
				{
					$data = getUserInfo($row['sponsorid']);
					$tree[$i] = array('userid'=>$row['sponsorid'],'status'=>$data['status']);	
					$id=$row['sponsorid'];
				}
			}
		}
	}	
	return $tree;
}

function getCoins($coin_id = 0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getCoins($coin_id);
	return $result;	
}

function getCoinPrice($lastest = false)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getCoinPrice($lastest);
	return $result;	
}

function getUserCoin($userid = 0,$agg_func = '',$filters=array())
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getUserCoin($userid,$agg_func,$filters);
	return $result;	
}

function getUserCoinAmount($userid = 0,$agg_func = '')
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getUserCoinAmount($userid,$agg_func);
	return $result;	
}

function getRemainingCoins()
{
	global $CI;
	$CI->load->model('Common_model');
	$total_coins = $CI->Common_model->getTotalCoins();
	$total_used_coins = $CI->Common_model->getUsedCoins();
	$result = $total_coins-$total_used_coins;
	return $result;	
}

function getCoinsDetails($userid)
{
	global $CI;
	$coin_price_data = getCoinPrice(true);
    $coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);
    
    $number_of_coins = 0;
    $number_of_released_coins = 0;
    $number_of_debited_coins = 0;
    
    $total_amount = 0;
    $total_released_amount = 0;
    $total_withdraw_amount = 0;
    $get_user_coin_data = getUserCoin($userid);
    foreach ($get_user_coin_data as $row) {
        if($row['user_coins_status'] == 'accepted')
        {
            $number_of_coins = $number_of_coins + $row['coins'];
        }

        if($row['user_coins_status'] == 'Bonus')
        {
            $number_of_coins = $number_of_coins + $row['coins'];
        }

        if($row['user_coins_status'] == 'Credit')
        {
            $number_of_released_coins = $number_of_released_coins + $row['coins'];
        }

        if($row['user_coins_status'] == 'Debit' || $row['user_coins_status'] == 'Debit Request')
        {
            $number_of_debited_coins = $number_of_debited_coins + $row['coins'];
            $total_withdraw_amount = $total_withdraw_amount + $row['coins']*$row['coin_price'];
        }
    }

    $number_of_coins = $number_of_coins - $number_of_released_coins;
    $total_amount = $number_of_coins*$coin_price;

    $number_of_released_coins = $number_of_released_coins - $number_of_debited_coins;
    $total_released_amount = $number_of_released_coins*$coin_price;
    $result = array();
    $result["coin_price"]=$coin_price;
    $result["number_of_coins"]=$number_of_coins;
    $result["total_amount"]=$total_amount;
    $result["number_of_released_coins"]=$number_of_released_coins;
    $result["total_released_amount"]=$total_released_amount;
    $result["number_of_debited_coins"]=$number_of_debited_coins;
    $result["total_withdraw_amount"]=$total_withdraw_amount;
    $result["get_user_coin_data"]=$get_user_coin_data;
    return $result;
}

function getReleasedUserCoins($userid = 0,$agg_func='',$filters=array())
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getUserCoin($userid,$agg_func,$filters);
	return $result;	
}

function getReferralIncome($userid=0,$filters=array())
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getReferralIncome($userid,$filters);
	return $result;
}

function getReferralIncomeDetails($userid=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getReferralIncomeDetails($userid);
	return $result;
}

function getROIIncome($userid=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getROIIncome($userid);
	return $result;
}

function getROIIncomeDetails($userid=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getROIIncomeDetails($userid);
	return $result;
}

function getBonusIncome($userid=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getBonusIncome($userid);
	return $result;
}

function getBonusIncomeDetails($userid=0)
{
	global $CI;
	$CI->load->model('Common_model');
	$result = $CI->Common_model->getBonusIncomeDetails($userid);
	return $result;
}
//$CI->output->enable_profiler(TRUE);
?>