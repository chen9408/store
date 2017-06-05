<?php
	/*
	*验证商品编号
	*
	*/
	function check_goodsID($goodsID){
		$first = substr($goodsID,0,1);
		$goods_type = array('A','B','C','D');
		return in_array($first,$goods_type);
	}
	/*
	*创建订单编号
	*param goodsID
	*return orderID
	*/
	function create_orderID($goodsID){
		$identify = substr($goodsID, 0, 1);
	    list($usec) = explode(" ", microtime());
	    $msec=substr($usec,2,3);
      	return $identify.date('ymdhis').$msec;
	}
	/*
	*生成随机数
	*param 位数
	*return number
	*/
	function createRandNumberBySize($number){
	    $number = (int)$number;
	    if($number === 0) {
	        return '';
	    }else{
	        $rankNumberString = "";
	        for ($i = 0; $i < $number + 1; $i++){
	            if ($i !== 0 && $i % 2 === 0) {
	                $rankNumberString .= mt_rand(11, 99);
	            }
	        }	 
	        if ($number % 2 === 0) {
	            return $rankNumberString;
	        } else {
	            return $rankNumberString . mt_rand(1, 9);
	        }
	 
	    }
	}
	/*
	*验证手机号和邮箱
	*提现接口
	*/			
	function isEmail($value,$match='/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/'){
        $v = trim($value);
        if(empty($v)) 
            return false;
        return preg_match($match,$v);
    }
 	function isMobile($value,$match='/^[(86)|0]?(13\d{9})|(14\d{9})|(15\d{9})|(17\d{9})|(18\d{9})$/'){
        $v = trim($value);
        if(empty($v)) 
            return false;
        return preg_match($match,$v);
    }
	/*
	*验证身份证号
	*修改用户信息接口 18位
	*/
	function isIDcard($value,$match='/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/'){
		$v = trim($value);
        if(empty($v)) 
            return false;
        return preg_match($match,$v);
	}
	/*
	*对外API接口
	*获取商品列表、详情，下单支付等
	*/	
	class Storeapi extends CI_Controller{				
		public function __construct(){
	  		parent::__construct();
	  		$this->load->model('api_model');
	  		$commentImg = $this->config->item('commentImg');
      		$this->load->library('upload',$commentImg);
	  		$this->load->helper(array('url','form','cookie','captcha'));
	  		$this->load->library(array('session','parser','curl','form_validation','sign','sms','redpack'));
			
		}
		/* testapi */
		public function testapi(){
			//$ip=$this->input->ip_address();
			//print_R($ip);
			//return ;
			//microChannelReword
			/*
			$post_data=array(
				'changedAmount'=>'100',
				'accountID'	   =>'kxl1QuHKCD'
			);
			*/
			/*
			$post_data=array(
				'accountID'	   =>'kxl1QuHKCD'	
			);
			*/
			//$post_data['orderID']='E150708101205364';
			//$send_data=array('1456','10');
			//$status=$this->SMSRemind($post_data['orderID'],'21109','');
			//$send_data = array($time,$order_info["marketPrice"],$order_info["withdrawAccount"]);
			//$return_array = $this->sms->sendTemplateSMS('13585545813',$send_data,'10469');//21109
		/*
			$post_data=array(
				'phone' =>'13585545813',
				'code'  =>'16532',
				'time'  =>'1'
			);			
		*/
		/*
			$post_data = array(
				'code' => '12343',
				'phone' =>'13785545813',
				'time'  => '12'
			);
		*/
     //		accountID content appID phoneType
/*
	 $post_data=array(
		'accountID' => 'kxl1QuHKD',
		 'content'  => '恩哼',
		 'appID'    => '1',
		 'appKey'   => '1'
	 );
*/
/*

Array
(
    [applicantName] => 许晨
    [applicantCercCode] => 371322199506207966
    [phoneNumber] => 4294967295
    [insuredDays] => 10
    [policyBeginDate] => 20150729
)

*/


//保险
			$post_data=array(
				'policyBeginDate' => '20150729',
				'insuredDays'	  => '20',
				'applicantName'	  => '许晨',
				'phoneNumber'	  => '13585545813',
				'applicantCercCode'=>'371322199506207966',
				'insuredNames'     =>'许晨',
				'insuredCercCodes'=> '371322199506207966'
				
			);
			$url = $this->config->item('test');
			//echo $url['test'];
			$body = $this->curl->simple_post($url['test'],$post_data);  
			print_r($body);

		}
		/*
		*点在路上
		*param longitude latitude
		*return city
		*/
		public function pointMatchRoad(){
			if (!$this->form_validation->run('pointMatchRoad')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post();
			$post_data['returnSign']='1';
			$info = $this->sign->get_sign_array($post_data,'keyValue');
			$url = $this->config->item('mirrtalk_api');
			$body = $this->curl->simple_post($url['point_match_road'],$info);
			if(empty($body)){
				$body = $this->sign->return_error_code("10015",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
			}
			$this->output
			->set_content_type('application/json')
			->set_output($body);
			return ;
		}
		/*获取商品类型*/
		public function getGoodsSubType(){
			$type=$this->input->post('type');
			if(empty($type)){ return;}
			$body = $this->api_model->getGoodsSubType($type);
			$json = $this->sign->return_error_code($body,'json','outside');			
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($json);
		}
		/*
		*获取商城的服务商品列表
		*param goodsType,startPage,pageCount,goodsSubType,cityCode,sortType,shopID 
		*return goodsList
		*/
		public function serGoodsList(){
			$post_data = $this->input->post(NULL, TRUE);		
			$post_data["pageCount"] = $this->input->post("pageCount",TRUE)?($post_data["pageCount"]):(10);
			$post_data["startPage"] = $this->input->post("startPage",TRUE)?(($post_data["startPage"]-1)*$post_data["pageCount"]):(0);			
			$post_data["cityCode"] = $this->input->post("cityCode",TRUE)?($post_data["cityCode"]):('0');
			$post_data["goodsSubType"] = $this->input->post("goodsSubType",TRUE)?($post_data["goodsSubType"]):('0');
			$post_data["sortType"] = $this->input->post("sortType",TRUE)?($post_data["sortType"]):('0');
			$post_data["shopID"] = $this->input->post("shopID",TRUE)?($post_data["shopID"]):('0');
			$body = $this->api_model->ser_goods_list($post_data);
			$json = $this->sign->return_error_code($body,'json','outside');			
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($json);	
		}
		/*
		*获取商城的服务商品详情
		*param goodsID
		*return goodsInfo
		*/
		public function serGoodsInfo(){
			if (!$this->form_validation->run('goods')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$goodsID = $this->input->post('goodsID', TRUE);
			if(!check_goodsID($goodsID)){
				$body = $this->sign->return_error_code("",'json','outside');
				$this->output
			    	->set_content_type('application/json')
			    	->set_output($body);
			    return ;
			}			
			$body = $this->api_model->sergoodsinfo($goodsID);
			if(empty($body)){
				$body = $this->sign->return_error_code("",'json','outside');
				$this->output
			    	->set_content_type('application/json')
			    	->set_output($body);
			    return ;
			}
			$update_click_count = $this->api_model->update_goods_clickCount($goodsID);
			$body = $this->sign->return_error_code($body,'json','outside');
			$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
		}
		/*
		*适用店铺
		*param   goodsID
		*return  shopID   shopName shopAddress  longitude  latitude
		*/
		public function applyShop(){
			if (!$this->form_validation->run('goods')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$goodsID=$this->input->post('goodsID');
			$body=$this->api_model->applyShop($goodsID);
			$json = $this->sign->return_error_code($body,'json','outside');			
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($json);		
		}
		/*
		*获取商城的虚拟商品列表
		*param goodsType,goodsSubType,type
		*return goodsList
		*/
		public function virtualGoodsList(){
			$post_data = $this->input->post(NULL,TRUE);
			$post_data["goodsType"] = $this->input->post("goodsType",TRUE)?($post_data["goodsType"]):('A');
			$post_data["goodsSubType"] = $this->input->post("goodsSubType")?($post_data["goodsSubType"]):('18');
			$body = $this->api_model->virtual_goods_list($post_data);
			$json = $this->sign->return_error_code($body,'json','outside');			
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($json);
		}
		/*
		*虚拟商品详情
		*param goodsID  
		*return goodsCount
		*/
		function virtualGoodsInfo(){
			if (!$this->form_validation->run('goods')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$goodsID = $this->input->post('goodsID', TRUE);
			if(!check_goodsID($goodsID)){
				$body = $this->sign->return_error_code("",'json','outside');
				$this->output
			    	->set_content_type('application/json')
			    	->set_output($body);
			    return ;
			}			
			$body = $this->api_model->virgoodsinfo($goodsID);
			if(empty($body)){
				$body = $this->sign->return_error_code("",'json','outside');
				$this->output
			    	->set_content_type('application/json')
			    	->set_output($body);
			    return ;
			}
			$update_click_count = $this->api_model->update_goods_clickCount($goodsID);
			$body = $this->sign->return_error_code($body,'json','outside');
			$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);

		}
		/*
		*获取用户订单列表
		*param accountID,orderType,startPage,pageCount
		*return orderList
		*/
		public function getOrderList(){
			if (!$this->form_validation->run('accountID')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data = $this->input->post(NULL,TRUE);
			$url = $this->config->item('mirrtalk_api');
			$param = array("accountID"=>$post_data["accountID"]);
			$info = $this->sign->get_sign_array($param,'keyValue');
			$body = $this->curl->simple_post($url['get_user_info'],$info); 
			try{
				$co = json_decode($body,true);
				if($co['ERRORCODE']!="0"&&!empty($co)){
					$body = $this->sign->return_error_code("10014",'json','inside');
					$this->output
					->set_content_type('application/json')
					->set_output($body);
					return ;
				}else if(empty($co)){
					$body = $this->sign->return_error_code("10014",'json','inside');
					$this->output
					->set_content_type('application/json')
					->set_output($body);
					return ;
				}
			}catch(Exception $e){
				$body = $this->sign->return_error_code("10014",'json','inside');
				$this->output
				->set_content_type('application/json')
				->set_output($body);
				return ;
			}
			$post_data["pageCount"] = $this->input->post("pageCount",TRUE)?($post_data["pageCount"]):(10);
			$post_data["startPage"] = $this->input->post("startPage",TRUE)?(($post_data["startPage"]-1)*$post_data["pageCount"]):(0);
			$post_data["orderType"] = $this->input->post("orderType",TRUE)?($post_data["orderType"]):('0');
			$body = $this->api_model->get_order_list($post_data);
			$body = $this->sign->return_error_code($body,'json','outside');
			$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);	
		}
		/*
		*获取订单详情
		*param $orderID
		*return orderInfo
		*/
		public function getOrderDetail(){
			if (!$this->form_validation->run('orderID')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$orderID = $this->input->post("orderID",TRUE);
			$body = $this->api_model->get_order_detail($orderID);
			$body = $this->sign->return_error_code($body,'json','outside');
			$this->output
				->set_content_type('application/json')
				->set_output($body);
		}
		/*
		*验证手机是否可以充值，获取话费金额
		*param phone,accountID,goodsID
		*return priceInfo
		*/
		public function checkPhoneFee(){
			if (!$this->form_validation->run('phone_fee')){         			 
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
		    $post_data = $this->input->post(NULL, TRUE);
		    $price_info = $this->api_model->get_goods_info($post_data["goodsID"]);
		    if($price_info['goodsCount']<=0){    										
				$body = $this->sign->return_error_code("10011",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			} 
		    $req_data = array(
		    	"card_worth"	=>	$price_info['marketPrice'],
		    	"phone_number"	=>	$post_data['phone']
		    );
			$body=$this->huafeiduoCheck($req_data);
			if($body['status']=="success"){
				if ($body['data']['platform']=='移动'){
					$phone_array['operator']='1';
				}elseif ($body['data']['platform']=='联通'){
					$phone_array['operator']='2';
				}elseif ($body['data']['platform']=='电信'){
					$phone_array['operator']='3';
				}
				$phone_array['value'] = $req_data['card_worth'];
				$address = explode(' ',$body['data']['area']);
				$phone_array['address']=$address[0];
				$price = $this->api_model->jiujiuprice($phone_array);
				if(empty($price)){
					$body = $this->sign->return_error_code("10020",'json','inside');
				}else{
					$phonePrice = rand($price*100,$price_info['shopPrice']);
					if ($phonePrice<=1000) {
						$phonePrice+=20;
					}elseif ($phonePrice<=2000 && $phonePrice>1000){
						$phonePrice+=30;
					}else{
						$phonePrice+=35;
					}
					unset($data);
					$data = array(
						'price'		  => $phonePrice,
						'area'		  => $address[0],
						'platform'	  =>$body['data']['platform'],
						'phone_number'=>$post_data['phone'],
						'card_worth'  =>$phone_array['value']
					);
					$body = $this->sign->return_error_code($data,'json','outside');	
				}
			}else{
				$body = $this->sign->return_error_code("10020",'json','inside');
			}
			$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
		}
		/*
		*充话费包括下单和支付
		*调用话费多接口充值 order.phone.submit
		*调用语镜支付接口
		*param accountID,goodsID,phone,mecoin,daokePassword,sign   
		*return paymentStatus	
		*/
		public function createPhoneFeeOrder(){
			if (!$this->form_validation->run('phone_fee')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
		    $post_data = $this->input->post(NULL,TRUE);
			$verifyCode =  $this->sign->get_verify_code($post_data);
			if($verifyCode != $post_data['sign']){
				$body = $this->sign->return_error_code("10019",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
	        	return ;
			}
			$order_info = $this->api_model->get_goods_info($post_data["goodsID"]);
			if(empty($order_info) || $order_info["goodsSubType"] != "18"){
				$body = $this->sign->return_error_code("10030",'json','inside');  
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}		
			if($order_info['goodsCount']<=0){
				$body = $this->sign->return_error_code("10011",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}
			$user_info = $this->getUserInfo($post_data["accountID"]);    
			if(!is_array($user_info)){
				$body = $this->sign->return_error_code($user_info,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$req_data = array(
		    	"card_worth"	=>	$order_info['marketPrice'],  
		    	"phone_number"	=>	$post_data['phone']
		    );
			$huaifeiduo_array = $this->huafeiduoCheck($req_data);		//检查是否可以下单，以及获得下单价格。
			if($huaifeiduo_array['status']=="success"){
				if ($huaifeiduo_array['data']['platform']=='移动'){
					$phone_array['operator']='1';
				}elseif ($huaifeiduo_array['data']['platform']=='联通'){
					$phone_array['operator']='2';
				}elseif ($huaifeiduo_array['data']['platform']=='电信'){
					$phone_array['operator']='3';
				}
				$phone_array['value'] = $req_data['card_worth'];
				$phone_array['address']=substr($huaifeiduo_array['data']['area'],0,6);
				$price = $this->api_model->jiujiuprice($phone_array);			
				$order_info["costPrice"]	= $price*100;                          
				$order_info["profitPrice"]	= $post_data["mecoin"]-$price*100;		
			}else{
				$body = $this->sign->return_error_code("10020",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			unset($order_info["goodsCount"]);							
			$order_info["username"]			= $user_info["nickname"];  
			$order_info["phone"]			= $user_info["mobile"];		
			$order_info["buyCount"]			= 1;
			$order_info["accountID"]		= $post_data["accountID"];
			$order_info["orderID"]			= create_orderID($post_data["goodsID"]);
			$order_info["orderAmount"]		= $post_data["mecoin"];
			$order_info["mecoin"]			= $post_data["mecoin"];
			$order_info["remark"]			= '话费充值';
			$order_info["createTime"]		= time();
			$order_info["withdrawAccount"] 	= $post_data["phone"];
			$order_info["supportWecoin"]	= 0;
			$order_info["orderStatus"]		= 1;
			$save_status = $this->api_model->save_confirm_order($order_info);
			if(!$save_status){
				$body = $this->sign->return_error_code("10000",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$this->phoneFee_order_pay($post_data,$order_info);			
		}
		/*
		*调用话费多接口 （是否可以下单，以及下单价格）order.phone.check
		*param card_worth,phone_number
		*return status
		*/
		public function huafeiduoCheck($post_data){
		 	$url = $this->config->item('huafeiduo_api');		    
			$info = $this->sign->get_huafeiduo_sign($post_data);
			$body = $this->curl->simple_get($url['check_phone_fee'].$info);  
			try{
				$co = json_decode($body,true);
				return $co;
			}catch(Exception $e){
				return array("status"=>"failure");
			}
		}
		/*
		*话费多支付接口
		*param 	array
		*return status
		*/
		public function huafeiduoPay($post_data){
			$url = $this->config->item('huafeiduo_api');
			$info = $this->sign->get_huafeiduo_sign($post_data);
			$body = $this->curl->simple_get($url['submit_phone_charge'].$info);
			try{
				$co = json_decode($body,true);
				return $co;
			}catch(Exception $e){
				return array("status"=>"failure");
			}
		}
		/*
		*99 支付接口回调地址
		*
		*/
		public function phoneFeeCallback(){
			$post_data = $this->input->post(NULL,TRUE);
			$endChar=substr($post_data["out_trade_id"],-1);
			if($endChar=='C'){
				if($post_data['status']=="success"){
					$orderStatus = 6;
					$this->SMSRemind($post_data['out_trade_id'],'11625','');
				}else{
					$orderStatus = 4;
				}
				$data = array(
					"orderID" 	 => substr($post_data['out_trade_id'],0,16),
					"updateTime" => time(),
					//"outsideID"	 => $post_data['order_id'],
					"orderStatus"=>$orderStatus
				);
				$status = $this->api_model->update_order_info($data);
			}else{
				if($post_data['status']=="success"){
					$orderStatus = 6;
					$this->SMSRemind($post_data['out_trade_id'],'11625','');	
					$data = array(
						"orderID" 	 => substr($post_data['out_trade_id'],0,16),
						"updateTime" => time(),
						//"outsideID"	 => $post_data['order_id'],
						"orderStatus"=>$orderStatus
					);
					$status = $this->api_model->update_order_info($data);
				}else{
					$orderInfo=$this->api_model->phoneFeeOrder($post_data['out_trade_id']);
					$orderID=$post_data['out_trade_id'].'C';
					$phone_array=array(
						'out_trade_id' => $orderID,
						'account'	   => $post_data['account'], 				
						'quantity'	   => 1,
						'value'		   => floor($orderInfo['marketPrice']),					
						'expired_mini' => 5,
						'notify_url'   => base_url().'index.php/storeapi/phoneFeeCallback',
					);
					$xml=$this->payPhone($phone_array);
					if(!empty($xml)){						
					     $xml=simplexml_load_string($xml);		//xml转对象
						 $xml=(array)$xml;						//对象转数组
					         if($xml['code']=='0000'){

							$order_status_array = array(
						        	"orderID"		=> $post_data['out_trade_id'],
						        	"outsideID" 	=> $xml['oid'],
							        "updateTime"	=> time()     
					        	);
						        $update = $this->api_model->update_order_info($order_status_array);
						}
					}
				}
			}
		}	
		/*
		*用户已存入保险预购金以及获得的补贴
		*param  accountID  
		*return 
		*/
		public function depositInfo(){
			if (!$this->form_validation->run('accountID')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$accountID = $this->input->post('accountID');
			$depositInfo =$this->api_model->depositInfo($accountID);
			$json = $this->sign->return_error_code($depositInfo,'json','outside');			
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($json);	
		}
		/*
		*保险预购金包含下单和支付
		*param accountID,mecoin,daokePassword,sign,goodsID
		*return status
		*/
		public function insurancePay(){
			if (!$this->form_validation->run('insurancePay')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
		    $post_data = $this->input->post(NULL,TRUE);
		    $verifyCode =  $this->sign->get_verify_code($post_data);
			if($verifyCode != $post_data['sign']){
				$body = $this->sign->return_error_code("10019",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}
			$goodsID="D100000323";
		    $order_info = $this->api_model->get_goods_info($goodsID);
		    if(empty($order_info) || $order_info["goodsSubType"] != "19"){
				$body = $this->sign->return_error_code("10030",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}
			$order_info["buyCount"] = $post_data["mecoin"]*1;
			if($order_info["buyCount"] > $order_info["goodsCount"] || $order_info["goodsCount"]<=0){
				$body = $this->sign->return_error_code("10011",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}
			$user_info = $this->getUserInfo($post_data["accountID"]);
			if(!is_array($user_info)){
				$body = $this->sign->return_error_code($user_info,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$order_info["username"]		= $user_info["nickname"];
			$order_info["supportWecoin"]= 0;
			$order_info["phone"]		= $user_info["mobile"];
			$order_info["accountID"] 	= $post_data["accountID"];
			$order_info["orderID"] 		= create_orderID($goodsID);
			$order_info["orderAmount"] 	= $post_data["mecoin"];
			$order_info["mecoin"] 		= $post_data["mecoin"];
			$order_info["orderStatus"] 	= 1;
			$order_info["withdrawAccount"]="0";
			$order_info["remark"] 		= '保险预购金';
			$order_info["createTime"] 	= time();
			unset($order_info["goodsCount"]);
			$save_status = $this->api_model->save_confirm_order($order_info);
			if(!$save_status){
				$body = $this->sign->return_error_code("10000",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$this->insurance_order_pay($post_data,$order_info);
		}
		/*
		*服务商品下订单接口
		*param accountID,goodsID,unitPrice,totalPrice,amount,sign
		*return status
		*/
		public function confirmOrder(){
			if (!$this->form_validation->run('confirm_orders')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post(NULL,TRUE);
			$verifyCode = $this->sign->get_verify_code($post_data);
			if($verifyCode != $post_data['sign']){
				$body = $this->sign->return_error_code("10019",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}
			$order_info = $this->api_model->get_goods_info($post_data["goodsID"]);
			if(empty($order_info)){
				$body = $this->sign->return_error_code("10030",'json','inside');
				$this->output
			    ->set_content_type('application/json') 
			    ->set_output($body);
				return ;
			}
			if($post_data["amount"] > $order_info["goodsCount"] || $order_info["goodsCount"]<=0){
				$body = $this->sign->return_error_code("10011",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}
			if($post_data["unitPrice"]!= $order_info["shopPrice"]){
				$body = $this->sign->return_error_code("10012",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}
			$orderAmount = $post_data["amount"]*$order_info["shopPrice"];
			if($post_data["totalPrice"] != $orderAmount){
				$body = $this->sign->return_error_code("10013",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}
			$user_info = $this->getUserInfo($post_data["accountID"]);
			if(!is_array($user_info)){
				$body = $this->sign->return_error_code($user_info,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$order_info["username"]		= $user_info["nickname"];
			$order_info["phone"]		= $user_info["mobile"];
			$order_info["buyCount"]		= $post_data["amount"];
			$order_info["accountID"]	= $post_data["accountID"];
			$order_info["orderID"]		= create_orderID($post_data["goodsID"]);
			$order_info["orderAmount"]	= $orderAmount;
			$order_info["mecoin"]		= $orderAmount;
			$order_info["remark"]		= isset($post_data["remark"])?$post_data["remark"]:'';
			$order_info["createTime"]	= time();
			$order_info["updateTime"]	= time();
			$order_info["orderStatus"]	= 1;
			unset($order_info["goodsCount"]);
			$save_status = $this->api_model->save_confirm_order($order_info);
			if(!$save_status){
				$body = $this->sign->return_error_code("10000",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			}else{
				$body = $this->sign->return_error_code($order_info,'json','outside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			}
		}		
		/*
		*取消订单接口
		*param sign accountID orderID
		*return status
		*/
		public function cancelOrder(){
			if (!$this->form_validation->run('cancel_order')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data = $this->input->post(NULL,TRUE);
			$verifyCode =  $this->sign->get_verify_code($post_data);
			if($verifyCode != $post_data['sign']){
				$body = $this->sign->return_error_code("10019",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}
			$order_info = $this->api_model->get_order_detail($post_data["orderID"]);
			if(empty($order_info)){
				$body = $this->sign->return_error_code("10101",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}
			if($order_info["orderStatus"]!="1"){
				$body = $this->sign->return_error_code("10101",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}
			$data = array(
				"orderID" 	=> $post_data['orderID'],
				"updateTime"=> time(),
				"orderStatus"=>3
			);
			$status = $this->api_model->update_order_info($data);
			if($status){
				$ERRORCODE = '0';
				$this->api_model->update_goods_count($order_info["goodsID"],'goodsCount+'.$order_info['buyCount']);
			}else{
				$ERRORCODE = '10121';
			}
			$body = $this->sign->return_error_code($ERRORCODE,'json','inside');
			$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
		}
		/*
		*商品的支付接口
		*param accountID,orderID,mecoin,wecoin,daokePassword,sign
		*return status or cardNumber,cardPassword
		*/
		public function mallPay(){
			if (!$this->form_validation->run('payment')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data = $this->input->post(NULL,TRUE);
			$verifyCode =  $this->sign->get_verify_code($post_data);
			if($verifyCode != $post_data['sign']){
				$body = $this->sign->return_error_code("10019",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}
			$order_info = $this->api_model->get_order_detail($post_data["orderID"]);
			if(empty($order_info)){
				$body = $this->sign->return_error_code("10101",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}
			if($order_info['accountID']!=$post_data["accountID"]){
				$body = $this->sign->return_error_code("10126",'json','inside');
				$this->output->set_content_type('application/json')
					 ->set_output($body);
				return ;
			}
			if($order_info["goodsSubType"] == 18){                            //话费
				$this->phoneFee_order_pay($post_data,$order_info);
			}else if($order_info["goodsSubType"] == 19){					  //保险
				$this->insurance_order_pay($post_data,$order_info);
			}else if($order_info["goodsSubType"] == 20){					  //充值
				if($order_info["remark"]=="微信钱包"){
					$this->weixin_redpack_pay($post_data,$order_info);
				}else{
					$this->withdrawMoney_order_pay($post_data,$order_info);
				}
			}else if($order_info["goodsSubType"] == 21 || $order_info["goodsSubType"] == 22){
				$this->accident_insure_pay($post_data,$order_info);
			}else{
				$sellerAccountID = $this->api_model->get_business_id($post_data["orderID"]);
				if($sellerAccountID==""){
					$body = $this->sign->return_error_code("10100",'json','inside');
					$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
					return ;
				}
				if($post_data['mecoin'] != $order_info["orderAmount"]){
					$body = $this->sign->return_error_code("10108",'json','inside');
					$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
					return ;
				}
				$payment_array = array(          
					"expenseAccountID"	=> $post_data["accountID"],
					"incomeAccountID" 	=> $sellerAccountID,
					"MEPoints" 			=> $order_info["orderAmount"],
					"WEPoints" 			=> $order_info["maxWecoin"],
					"withdrawAccount"	=> $order_info['withdrawAccount'],
					"changedType"		=> 14,
					"remark"			=> "商城-(".$order_info['goodsName'].")",
					"daokePassword"		=> $post_data["daokePassword"],
					"tradeNumber"		=> $post_data["orderID"],
					"callbackURL"		=> base_url().'index.php/storeapi/paymentCallback?goodsSubType='.$order_info["goodsSubType"]
				);
				if($payment_array["WEPoints"] != 0){
					$payment_array["MEPoints"] = 0;
					$payment_array["WEPoints"] = $order_info["orderAmount"];
				}
				$payment_status = $this->payment($payment_array);
				if(is_array($payment_status)){
					$goods_info = $this->api_model->get_goods_info($order_info["goodsID"]);
					$this->api_model->update_goods_soldCount($order_info['goodsID'],"soldCount+".$order_info["buyCount"]);  //修改商品已售
					$redeemCode_array = $this->careateRedeemCode($goods_info,$order_info);
					if(is_array($redeemCode_array)){
						$output_array['list']		= $redeemCode_array;
						$output_array["mecoin"] 	= $payment_status["mecoin"];
						$output_array["wecoin"] 	= $payment_status["wecoin"];
						$output_array["orderID"]	= $order_info['orderID'];
						$output_array["goodsID"]	= $order_info['goodsID'];
						$output_array["goodsName"]	= $order_info['goodsName'];
						$output_array["accountID"]	= $order_info['accountID'];
						$body = $this->sign->return_error_code($output_array,'json','outside');
						$this->SMSRemind($post_data["orderID"],'11622','');
					}else{
						$body = $this->sign->return_error_code($redeemCode_array,'json','inside');
					}
				}else{
					$body = $this->sign->return_error_code($payment_status,'json','inside');
				}
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
			}			
		}
		/*
		*创建普通商品兑换账号和密码  orderStatus不变
		*param goodsInfo orderInfo  
		*return redeemCode
		*/
		public function careateRedeemCode($goods_info,$order_info){
			$code_array = array();
			for ($i = 0; $i < $order_info["buyCount"]; $i++) {
            	$param_array = array(
					"orderID"			=> $order_info["orderID"],
					"goodsID" 			=> $order_info["goodsID"],
					"goodsName" 		=> $order_info["goodsName"],
					"sellerID"			=> $order_info["sellerID"],
					"accountID"			=> $order_info["accountID"],
					"cardNumber"		=> createRandNumberBySize(10),
					"cardPassword"		=> createRandNumberBySize(5),
					"codeStatus"		=> 0,
					"effectTime"		=> time(),
					"loseEffectTime"	=> strtotime($goods_info["getAging"].'day'),
					"createTime"		=> time()
				);
				array_push($code_array,$param_array);
        	}
			$create_status = $this->api_model->careate_redeemCode($code_array);
			if($create_status){
				$array = array(
					"orderStatus" 	=> 2,                 
					"orderID"		=> $order_info["orderID"]
				);
				$status = $this->api_model->update_order_info($array);
				return $code_array;
			}
			return '10109';
		}		
		/*
		*该类的公共方法，调取语镜的支付接口
		*param incomeAccountID,expenseAccountID,MEPoints,WEPoints,changedType,tradeNumber,daokePassword,callbackURL
		*return status     
		*/
		public function payment($post_data){
			$orderStatus = 0;
			$payStatus = '10111';
			$url = $this->config->item('mirrtalk_api');
			$info = $this->sign->get_sign_array($post_data,'keyValue');
			$body = $this->curl->simple_post($url['user_finance_consume'],$info);
			try{
				$co = json_decode($body,true);
				if($co['ERRORCODE']=="0"){
					$orderStatus = $post_data["changedType"] == 13 ? 6 : 2;					//changedType=13 为 保险
					$orderStatus = $post_data["changedType"] == 20 ? 7 : $orderStatus;		//原来为$post_data["changedType"] == 14 ? 7 : $orderStatus;
					$payStatus = "0";
					$receiptID = $co['RESULT'][0]['receiptID'];
					$wecoin = $co['RESULT'][0]['WEPoints'];
					$mecoin = $co['RESULT'][0]['MEPoints'];
				}else{
					if($co['ERRORCODE']=='ME18006'){
						$payStatus = '10102';
					}else if($co['ERRORCODE']=='ME18506'){
						$payStatus = '10103';
					}else if($co['ERRORCODE']=='ME18505'){
						$payStatus = '10104';
					}else if($co['ERRORCODE']=='ME18510'||$co['ERRORCODE']=='ME18509' ||$co['ERRORCODE']=='ME18506' || $co['ERRORCODE']=='ME18507' || $co['ERRORCODE']=='ME18508'){
						$payStatus = '10105';
					}else if($co['ERRORCODE']=='ME18063'){
						$payStatus = '10106';
					}else if($co['ERRORCODE']=='ME18513'){
						$payStatus = '10112';				
					}else if($co['ERRORCODE']=='ME18518'){
						$payStatus = '10122';
					}else if($co['ERRORCODE']=='ME18519'){
						$payStatus = '10123';
					}else if($co['ERRORCODE']=='ME18517'){
						$payStatus = '10124';
					}else if($co['ERRORCODE']=='ME18522'){
						$payStatus = '10125';
					}else{
						$payStatus = '10107';
					}
					if($post_data["changedType"] == 20){
						return $payStatus;
					}
					$orderStatus = 1;
					$receiptID = 0;
					$wecoin = $post_data['WEPoints'];
					$mecoin = $post_data['MEPoints'];
				}
				$data = array(
					"orderID" 	 => $post_data['tradeNumber'],
					"updateTime" => time(),
					"mecoin"	 => $mecoin,
					"wecoin"	 => $wecoin,
					"receiptID"	 => $receiptID,
					"orderStatus"=>$orderStatus
				);
				$status = $this->api_model->update_order_info($data);
				if($orderStatus!=1){
					$payStatus = $status ? $payStatus : "10110";
					if($payStatus=="0"){
						return $data;
					}
					return $payStatus;
				}else{
					return $payStatus;
				}
			}catch(Exception $e){
				return $payStatus;
			}
		}
		/*
		*语镜支付接口的回调地址
		*param tradeNumber,MEPoints,WEPoints,receiptID,orderStatus   
		*return status
		*/
		public function paymentCallback(){
			$post_data = $this->input->post(NULL,TRUE);
			$goodsSubType = $this->input->get('goodsSubType',TRUE);
			if($goodsSubType=="18"){
				return ;
			}
			$info = $this->sign->get_sign_array($post_data,'keyValue');
			if($post_data["sign"]!=$info['sign']){
				$body = $this->sign->return_error_code("10019",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}			
			if($post_data['orderStatus'] == 1){
				if($goodsSubType=="20"){					//提现
					# ;
					// $this->SMSRemind($post_data['tradeNumber'],'11624','');
				}
				$orderStatus = 2;
			}else{
				if($goodsSubType=="20"){
					$this->SMSRemind($post_data['tradeNumber'],'11684',$post_data["remark"]);
				}
				$orderStatus = 1;
			}			
			$data = array(
				"orderID" 	=> $post_data['tradeNumber'],
				"updateTime"=> $post_data['updateTime'],
				"mecoin"	=> $post_data['MEPoints'],
				"wecoin"	=> $post_data['WEPoints'],
				"receiptID"	=> $post_data['receiptID'],
				"orderStatus"=>$orderStatus
			);
			$status = $this->api_model->update_order_info($data);
			$body = $this->sign->return_error_code($status,'json','');
			$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
		}
		/*
		*退款处理的回调
		*param tradeNumber updateTime MEPoints WEPoints receiptID orderStatus
		*return  $status
		*/
		public function refundCallback(){
			$post_data = $this->input->post(NULL,TRUE);
			$goodsSubType = $this->input->get('goodsSubType',TRUE);
			$info = $this->sign->get_sign_array($post_data,'keyValue');
			if($post_data["sign"]!=$info['sign']){
				$body = $this->sign->return_error_code("10019",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}			
			if($post_data['orderStatus'] == 1){
				$orderStatus = $goodsSubType=="18"?7:5;
				$data = array(
					"orderID" 	=> $post_data['tradeNumber'],
					"updateTime"=> $post_data['updateTime'],
					"mecoin"	=> $post_data['MEPoints'],
					"wecoin"	=> $post_data['WEPoints'],
					"receiptID"	=> $post_data['receiptID'],
					"orderStatus"=>$orderStatus
				);
				if($goodsSubType=="18"){
					$status = $this->api_model->update_order_info($data);
					$body = $this->sign->return_error_code($status,'json','');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					    return;
				}
				$this->api_model->update_redeemCode_status($post_data['tradeNumber']);
				$status = $this->api_model->update_order_info($data);
				$body = $this->sign->return_error_code($status,'json','');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
			}
		}
		/*
		*验证用户有无身份证号信息
		*param accountID
		*
		*/
		public function  verifyIdNumber(){
			if (!$this->form_validation->run('accountID')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$accountID = $this->input->post('accountID');
			$user_info = $this->getUserInfo($accountID);   //$user 为数组
			if(is_array($user_info)){
				$user_info=array('idNumber'=>$user_info['idNumber'],'name'=>$user_info['name']);
				$body = $this->sign->return_error_code($user_info,'json','outside');
			}else{
				$body = $this->sign->return_error_code($user_info,'json','inside');
			}
			$this->output
				 ->set_content_type('application/json')
				 ->set_output($body);
		    return ;
		}
		/*
		*更改用户信息
		*param idNumber  accountID
		*/
		public function fixUserInfo(){
			$post_data = $this->input->post(NULL,TRUE);
			if(!empty($post_data["idNumber"])){
				if(!isIDcard($post_data['idNumber'])){									
					$body = $this->sign->return_error_code("10010",'json','inside');
					$this->output
						->set_content_type('application/json')
						->set_output($body);
					return ;
				}
			}
			$url = $this->config->item('mirrtalk_api');
			$info = $this->sign->get_sign_array($post_data,'keyValue');
			$body = $this->curl->simple_post($url['fix_user_info'],$info);
			$co = json_decode($body,true);
			if($co['ERRORCODE']!="0"){
				if($co['ERRORCODE']=="ME18915"){
					$body = $this->sign->return_error_code("10045",'json','inside');
				}else{
					$body = $this->sign->return_error_code("10044",'json','inside');
				}
			}
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($body);
		}
		/*
		*用户资金提现
		*param accountID,daokePassword,goodsID,sign,goodsID,withdrawType,withdrawAccount
		*return status 
		*/
		public function withdrawMoney(){
			$post_data = $this->input->post(NULL,TRUE);
			if (!$this->form_validation->run('withdraw_money')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			if($post_data["withdrawType"]== 0){
				$verifyCode =  $this->sign->get_verify_code($post_data);
				if($verifyCode != $post_data['sign']){
					$body = $this->sign->return_error_code("10019",'json','inside');
					$this->output
						->set_content_type('application/json')
						->set_output($body);
					return ;
				}
			}
			$order_info = $this->api_model->get_goods_info($post_data["goodsID"]);
			if(empty($order_info) || $order_info["goodsSubType"] != "20"){
				$body = $this->sign->return_error_code("10030",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
				return ;
			}
			if($order_info["goodsCount"]<=0){
				$body = $this->sign->return_error_code("10011",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}
			$user_info = $this->getUserInfo($post_data["accountID"]);
			if(!is_array($user_info)){
				$body = $this->sign->return_error_code($user_info,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$post_data["withdrawType"] = isset($post_data["withdrawType"])?$post_data["withdrawType"]:"0";
			if($post_data["withdrawType"]=="0"){			//支付宝提现
				if(!isEmail($post_data['withdrawAccount'])&&!isMobile($post_data['withdrawAccount'])){									
					$body = $this->sign->return_error_code("10010",'json','inside');
					$this->output
						->set_content_type('application/json')
						->set_output($body);
					return ;
				}
				$order_info["goodsName"]		= "提现到支付宝（".$order_info["marketPrice"]."元）";
				$order_info["goodsImg"]			= base_url()."public/img/alipay.png";
				$order_info["remark"]			= '资金提现';
				$order_info["withdrawAccount"]  = $post_data['withdrawAccount'];
			}else{   //微信提现
				$order_info["goodsName"]		= "提现到微信钱包（".$order_info["marketPrice"]."元）";
				$order_info["goodsImg"]			=  base_url()."public/img/weixin.png";
				$order_info["remark"]			= '微信钱包';
				$order_info["withdrawAccount"]  = "";
			}
			$order_info["username"]			= $user_info["nickname"];
			$order_info["supportWecoin"]	= 0;
			$order_info["phone"]			= $user_info["mobile"];
			$order_info["buyCount"]			= 1;
			$order_info["accountID"]		= $post_data["accountID"];
			$order_info["orderID"]			= create_orderID($post_data["goodsID"]);
			$order_info["orderAmount"]		= $order_info["shopPrice"];
			$order_info["mecoin"]			= $order_info["shopPrice"];
			$order_info["createTime"]		= time();
			unset($order_info["goodsCount"]);
			$save_status = $this->api_model->save_confirm_order($order_info);
			if(!$save_status){
				$body = $this->sign->return_error_code("10000",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			if($post_data["withdrawType"]=="0"){
				$this->withdrawMoney_order_pay($post_data,$order_info);
			}else{
				$this->weixin_redpack_pay($post_data,$order_info);
			}
		}
		/*
		*订单支付，支付失败后重新支付（话费、保险、提现）
		*pararm  accountID   mecoin    withdrawAccount   goodsName  orderID  goodsSubType
		*/
		public function phoneFee_order_pay($post_data,$order_info){
			$payment_array = array(
				"expenseAccountID"	=> $post_data["accountID"],
				"incomeAccountID"	=> $this->config->item('mirrtalkSeller'),
				"MEPoints"			=> $post_data["mecoin"],
				"WEPoints"			=> 0,
				"withdrawAccount"	=> $order_info['withdrawAccount'],
				"changedType"		=> 12,
				"remark"			=> $order_info["goodsName"]."充值-手机尾号(".substr($order_info['withdrawAccount'],-4).")",
				"tradeNumber"		=> $order_info["orderID"],
				"daokePassword"		=> $post_data["daokePassword"],
				"callbackURL"		=> base_url().'index.php/storeapi/paymentCallback?goodsSubType='.$order_info["goodsSubType"]
			);
			$payment_status = $this->payment($payment_array);
			if(!is_array($payment_status)){
				$body = $this->sign->return_error_code($payment_status,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$consume_array = array(
				"mecoin" 			=> $payment_status['mecoin'],
				"wecoin"			=> $payment_status['wecoin'],
				"withdrawAccount"	=> $order_info['withdrawAccount'],
				"orderID"			=> $order_info['orderID'],
				"goodsID"			=> $order_info['goodsID'],
				"goodsName"			=> $order_info['goodsName'],
				"accountID"			=> $order_info['accountID']
			);
			$body = $this->sign->return_error_code($consume_array,'json','outside');
			$this->output
		    ->set_content_type('application/json')
		    ->set_output($body);
		}
		public function insurance_order_pay($post_data,$order_info){
			$payment_array = array(
				"expenseAccountID"	=> $post_data["accountID"],
				"MEPoints"			=> $post_data["mecoin"],
				"WEPoints"			=> 0,
				"withdrawAccount"	=> $order_info['withdrawAccount'],
				"changedType"		=> 13,
				"remark"			=> "存入".$order_info["goodsName"]."-密点（".$post_data["mecoin"]."）",
				"tradeNumber"		=> $order_info["orderID"],
				"daokePassword"		=> $post_data["daokePassword"],
				"callbackURL"		=> base_url().'index.php/storeapi/paymentCallback?goodsSubType='.$order_info["goodsSubType"]
			);
			$payment_status = $this->payment($payment_array);
			if(is_array($payment_status)){
				$consume_array = array(
					"mecoin" 			=> $payment_status['mecoin'],
					"wecoin"			=> $payment_status['wecoin'],
					"orderID"			=> $order_info['orderID'],
					"goodsID"			=> $order_info['goodsID'],
					"goodsName"			=> $order_info['goodsName'],
					"accountID"			=> $order_info['accountID']
				);
				$body = $this->sign->return_error_code($consume_array,'json','outside');
			}else{
				$this->api_model->update_goods_count($order_info["goodsID"],"goodsCount+".$order_info["buyCount"]);
				$body = $this->sign->return_error_code($payment_status,'json','inside');
			}
			$this->output
		    ->set_content_type('application/json')
		    ->set_output($body);
		}
		/*
		*生成WX兑换码
		*
		*/
		public function weixinCode($accountID,$money){
			$string='';
			$string.=$accountID.$money.time();
			return sha1($string);
		}
		//微信红包支付
		public function weixin_redpack_pay($post_data,$order_info){
			$payment_array = array(
				"expenseAccountID"	=> $post_data["accountID"],
				"incomeAccountID"	=> $this->config->item('mirrtalkSeller'),
				"MEPoints"			=> $order_info["orderAmount"],
				"WEPoints"			=> 0,
				"withdrawAccount"	=> $order_info['withdrawAccount'],
				"changedType"		=> 12,
				"remark"			=> "提现到微信钱包（".$order_info["marketPrice"]."元）",
				"tradeNumber"		=> $order_info["orderID"],
				"daokePassword"		=> $post_data["daokePassword"],
				"callbackURL"		=> base_url().'index.php/storeapi/paymentCallback?goodsSubType=20'
			);
			$payment_status = $this->payment($payment_array);
			if(!is_array($payment_status)){
				$body = $this->sign->return_error_code($payment_status,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$code=$this->weixinCode($order_info['accountID'],$order_info['orderAmount']);
			$this->api_model->saveWXCode($code,$order_info);
			$weixin_account = explode('|',$order_info['withdrawAccount']);
			$consume_array = array(
				"mecoin" 			=> $payment_status['mecoin'],
				"wecoin"			=> $payment_status['wecoin'],
				"withdrawAccount"	=> $weixin_account['0'],
				"orderID"			=> $order_info['orderID'],
				"goodsID"			=> $order_info['goodsID'],
				"goodsName"			=> $order_info['goodsName'],
				"accountID"			=> $order_info['accountID'],
				"code"				=> $code
			);
			$body = $this->sign->return_error_code($consume_array,'json','outside');
			$this->output
		    ->set_content_type('application/json')
		    ->set_output($body);
		}
		//意外险
		public function accident_insure_pay($post_data,$order_info){
			$payment_array = array(
				"expenseAccountID"	=> $post_data["accountID"],
				"incomeAccountID"	=> $this->config->item('mirrtalkSeller'),
				"MEPoints"			=> $post_data["mecoin"],
				"WEPoints"			=> 0,
				"withdrawAccount"	=> $order_info['withdrawAccount'],
				"changedType"		=> 12,
				"remark"			=> "购买".$order_info["goodsName"]."-密点（".$post_data["mecoin"]."）",
				"tradeNumber"		=> $order_info["orderID"],
				"daokePassword"		=> $post_data["daokePassword"],
				"callbackURL"		=> base_url().'index.php/storeapi/paymentCallback?goodsSubType='.$order_info["goodsSubType"]
			);
			$payment_status = $this->payment($payment_array);
			if(is_array($payment_status)){
				$consume_array = array(
					"mecoin" 			=> $payment_status['mecoin'],
					"wecoin"			=> $payment_status['wecoin'],
					"orderID"			=> $order_info['orderID'],
					"goodsID"			=> $order_info['goodsID'],
					"goodsName"			=> $order_info['goodsName'],
					"accountID"			=> $order_info['accountID']
				);
				$body = $this->sign->return_error_code($consume_array,'json','outside');
			}else{
				$this->api_model->update_goods_count($order_info["goodsID"],"goodsCount+".$order_info["buyCount"]);
				$body = $this->sign->return_error_code($payment_status,'json','inside');
			}
			$this->output
		    ->set_content_type('application/json')
		    ->set_output($body);
		}
		public function withdrawMoney_order_pay($post_data,$order_info){
			$param_array = array(
				"accountID"			=> $post_data["accountID"],
				"daokePassword" 	=> $post_data["daokePassword"],
				"withdrawAccount"	=> $order_info['withdrawAccount'],				
				"callbackURL"		=> base_url().'index.php/storeapi/paymentCallback?goodsSubType='.$order_info["goodsSubType"],
				"tradeNumber"		=> $order_info["orderID"],
				"applyWithdrawAmount"=> $order_info["shopPrice"],
				"withdrawAccountType"=> 1,
				"moneyType"			=> 1
			);
			$url = $this->config->item('mirrtalk_api');
			$info = $this->sign->get_sign_array($param_array,'keyValue');
			$body = $this->curl->simple_post($url['apply_withdraw_money'],$info);
			try{
				$co = json_decode($body,true);
				if($co['ERRORCODE']=="0"){
					$orderStatus = 2;
					$payStatus = "0";
				}else{
					if($co['ERRORCODE']=='ME18006'){
						$payStatus = '10102';
					}else if($co['ERRORCODE']=='ME18506'){
						$payStatus = '10103';
					}else if($co['ERRORCODE']=='ME18505'){
						$payStatus = '10104';
					}else if($co['ERRORCODE']=='ME18037' || $co['ERRORCODE']=='ME18018'){
						$payStatus = '10105';
					}else if($co['ERRORCODE']=='ME18063'){
						$payStatus = '10106';
					}else{
						$payStatus = '10107';
					}
					$orderStatus = 1;
				}
				$data = array(
					"orderID" 	=> $order_info["orderID"],
					"updateTime"=> time(),
					"mecoin"	=> $order_info['mecoin'],
					"wecoin"	=> 0,
					"orderStatus"=>$orderStatus
				);
				$status = $this->api_model->update_order_info($data);
				if(!$status){
					$payStatus = "10110";
				}
			}catch(Exception $e){
				$payStatus = "10111";
			}
			if($payStatus == "0"){
				$consume_array = array(
					"orderID"			=> $order_info['orderID'],
					"goodsID"			=> $order_info['goodsID'],
					"goodsName"			=> $order_info['goodsName'],
					"accountID"			=> $order_info['accountID'],
					"mecoin" 			=> $order_info['mecoin'],
					"wecoin" 			=> 0,
                    "withdrawAccount"   => $order_info['withdrawAccount']
				);
				$body = $this->sign->return_error_code($consume_array,'json','outside');
			}else{
				$this->api_model->update_goods_count($order_info["goodsID"],"goodsCount+1");
				$body = $this->sign->return_error_code($payStatus,'json','inside');
			}
			$this->output
		    ->set_content_type('application/json')
		    ->set_output($body);
		}
		/*
		*短信提醒
		*/
		public function SMSRemind($orderID,$templateID,$remark){
			$order_info = $this->api_model->get_order_detail($orderID);
			if(empty($order_info))return ;
			$time = date('m月d日 H时i分',$order_info["createTime"]);
			switch ($templateID) {
				case '11625':  
					$send_data = array($time,$order_info["marketPrice"],$order_info["withdrawAccount"]);
					break;
				case '11624':
					$withdrawAccount = substr_replace($order_info["withdrawAccount"],'*****',3,5); 
					$send_data = array($time,$order_info["goodsName"],"支付宝",$withdrawAccount);
					break;
				case '11683':
					$send_data = array($time,$order_info["marketPrice"],$order_info["withdrawAccount"]);
					break;
				case '11622':
					$redeemCode_array = $order_info["redeemCode"];
					$content = '';
					foreach ($redeemCode_array as $key => $value) {
						$content .= "卡号：".$value["cardNumber"]."，密码：".$value["cardPassword"]."；";
					}
					$loseEffectTime = date('m月d日',$redeemCode_array[0]["loseEffectTime"]);
					$send_data = array($order_info["goodsName"],$content,$loseEffectTime);
					break;
				case '11684':
					$send_data = array($time,$order_info["goodsName"],$remark);
					break;
				default:
					return;
					break;
			}
			$return_array = $this->sms->sendTemplateSMS($order_info["phone"],$send_data,$templateID);
			print_r($return_array);
		}
		/*
		*获取用户的资金
		*param accountID 
		*return 
		*/
		public function getUserfinance(){
			if (!$this->form_validation->run('accountID')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post(NULL,TRUE);
			$post_data['moneyType']='3';
			$info = $this->sign->get_sign_array($post_data,'keyValue');
			$url = $this->config->item('mirrtalk_api');
			$body = $this->curl->simple_post($url['user_finance_info'],$info);
			if(empty($body)){
				$body = $this->sign->return_error_code("10031",'json','inside');
			}else{
				$co = json_decode($body,true);
				if($co['ERRORCODE']!="0"){
					if($co['ERRORCODE']=='ME18053'){
						$body = $this->sign->return_error_code("10034",'json','inside');
					}else if($co['ERRORCODE']=='ME18015'){
						$body = $this->sign->return_error_code("10015",'json','inside');
					}else{
						$body = $this->sign->return_error_code("10031",'json','inside');
					}
				}else{
					$co['RESULT']['mecoin']=$co['RESULT'][0];
					if(empty($co['RESULT'][1])){
						$co['RESULT']['wecoin']="";
					}else{
						$co['RESULT']['wecoin']=$co['RESULT'][1];
					}
					unset($co['RESULT'][0]);
					unset($co['RESULT'][1]);
					$body= json_encode($co,true);
				} 	
			}
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($body);
		}
		/*
		*获取用户的昵称和联系电话
		*param accountID
		*return userInfo
		*/
		public function getUserInfo($accountID){
			$url = $this->config->item('mirrtalk_api');
			$param = array(
				"accountID"=>$accountID,
				);
			$info = $this->sign->get_sign_array($param,'keyValue');
			$body = $this->curl->simple_post($url['get_user_info'],$info);
			//print_r($body);
			try{
				$co = json_decode($body,true);
				if($co['ERRORCODE']=="0"){
					return $co["RESULT"];
				}else{					
					return "10014";
				}
			}catch(Exception $e){
				return "10014";
			}
		}
		/*
		*商城banner图
		*param cityCode
		*return redirectType 跳转类型 1：url 2:商品id
		*/
		public function getMallBanners(){
			$cityCode	= $this->input->post("cityCode",TRUE)?($this->input->post("cityCode",TRUE)):('0');
			$accountID 	= $this->input->post("accountID",TRUE);
			/*
			if(empty($accountID)){
				return '10010';
			}
			*/
			$user_info = $this->getUserInfo($accountID);
			$fileName = md5($accountID);
			$body = '{"ERRORCODE":"0","RESULT":'.
			'[{"bannerId":1,"content":"http://store.daoke.me/index.php/inform","shareText":"","title":"通知","redirectType":"1","bannerImg":"http://store.daoke.me/public/img/without-banner.png"}]}';
			$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
		}
		/*
		*更新商品的数量
		*param goodsID goodsCount
		*return status
		*/
		public function updateGoodsCount(){
			$get_data = $this->input->get("parameter",NULL);
			$data_array = explode('|',$get_data);
			foreach ($data_array as $key => $value){
				$goods_array = explode(':',$value);
				$this->api_model->update_goods_count($goods_array[0],$goods_array[1]);
			}
			return 0;
		}		
		/*
		*验证jiujiu充值的订单状态
		*param orderID
		*return array
		*/
		public function phoneFeeOrderStatus($orderID){
			if(empty($orderID)){
				return;
			}
			$post_data = array("out_trade_id" => $orderID);
			$url = $this->config->item('jiujiu_api');
			$dev = $this->config->item('jiujiu_dev');
			$post_data['partner']=$dev['partner'];
			$post_data['method'] ='Query';
			$post_data['sign_type']='md5';
			$post_data["client_ip"] = $_SERVER["REMOTE_ADDR"];
			$post_data['_sign'] = $this->sign->get_jiu_sign($post_data);
			$body = $this->curl->simple_post($url['jiujiudou'],$post_data);
			$body=simplexml_load_string($body);
			$body=(array)$body;
			try{
				return $body;
			}catch(Exception $e){
				return array("status"=>"failure");
			}
		}
		/*
		*给充话费失败的用户退款              
		*param 
		*return status
		*/
		public function phoneFeeOrderRefund(){
			$data = $this->api_model->get_phoneFee_refund();
			if(empty($data)){
				return ;
			}
			foreach($data as $key => $value) {
				/* huafeiduo */
				if(substr($value['outsideID'],0,4)=='2015'){
					$payment_array = array();
					$order_info = $this->huafeiduoOrderStatus($value["orderID"]);
					if($order_info["status"]=="success" && $order_info["data"]["order_status"]=="failure"){
						$payment_array = array(          
							"expenseAccountID"	=> $value["accountID"],
							"incomeAccountID"	=> $this->config->item('mirrtalkSeller'),
							"MEPoints" 			=> $value["orderAmount"],
							"WEPoints" 			=> 0,
							"changedType"		=> 14,
							"remark"			=> "充值失败退款-(".$value['orderID'].")手机尾号(".substr($value['withdrawAccount'],-4).")",
							"tradeNumber"		=> $value["orderID"],
							"callbackURL"		=> base_url().'index.php/storeapi/refundCallback?goodsSubType=18'
						);					
						$this->api_model->update_goods_count($value["goodsID"],'goodsCount+1');
						$data = array(
							"orderID" 		=> $value['orderID'],
							"orderStatus"	=> 7
						);
						$status = $this->api_model->update_order_info($data);
						$this->SMSRemind($value['orderID'],'11683','');
						$this->payment($payment_array);
					}
				}else{
					//$order_info = $this->jiujiuOrderStatus($value["orderID"]);
					$payment_array = array(          
						"expenseAccountID"	=> $value["accountID"],
						"incomeAccountID"	=> $this->config->item('mirrtalkSeller'),
						"MEPoints" 			=> $value["orderAmount"],
						"WEPoints" 			=> 0,
						"withdrawAccount"	=> $value['withdrawAccount'],
						"changedType"		=> 20,
						"remark"			=> "充值失败退款-(".$value['orderID'].")手机尾号(".substr($value['withdrawAccount'],-4).")",
						"tradeNumber"		=> $value["orderID"],
						"callbackURL"		=> base_url().'index.php/storeapi/refundCallback?goodsSubType=18'
					);			
					$paymentStatus=$this->payment($payment_array);
					if(is_array($paymentStatus)){
						$this->api_model->update_goods_count($value["goodsID"],'goodsCount+1');
						$data = array(
							"orderID" 	 => $value['orderID'],
							"orderStatus"=> 7,
							"updateTime" => time()
						);
						$status = $this->api_model->update_order_info($data);
						$this->SMSRemind($value['orderID'],'11683','');
					}
				}
			}
		}
		/*
		*验证话费多充值的订单状态
		*param orderID
		*return array
		*/
		public function huafeiduoOrderStatus($orderID){
			if(empty($orderID)){
				return;
			}
			$post_data = array("sp_order_id" => $orderID);
			$url = $this->config->item('huafeiduo_api');
			$info = $this->sign->get_huafeiduo_sign($post_data);
			$body = $this->curl->simple_get($url['order_phone_status'].$info);
			try{
				$co = json_decode($body,true);
				return $co;
			}catch(Exception $e){
				return array("status"=>"failure");
			}
		}
		/*
		* jiujiu 订单状态
		*
		*/
		public function jiujiuOrderStatus($orderID){
			if(empty($orderID)){
				return;
			}
			$post_data = array("out_trade_id" => $orderID);
			$url = $this->config->item('jiujiu_api');
			$dev = $this->config->item('jiujiu_dev');
			$post_data['partner']=$dev['partner'];
			$post_data['method'] ='Query';
			$post_data['sign_type']='md5';
			$post_data["client_ip"] = $_SERVER["REMOTE_ADDR"];
			$post_data['_sign'] = $this->sign->get_jiu_sign($post_data);
			$body = $this->curl->simple_post($url['jiujiudou'],$post_data);
			$body=simplexml_load_string($body);
			$body=(array)$body;
			try{
				return $body;
			}catch(Exception $e){
				return array("status"=>"failure");
			}
		}
		/*
		*微信充值失败的用户退款
		*param null
		*return status
		*/
		public function wxRedPackOrderRefund(){
			$data = $this->api_model->get_wxRedPack_refund();
			if(empty($data)){
				return ;
			}
			/*
			$data=array(
				'0'=>array(
					'withdrawAccount' =>'oBg_-jtQ_5JGlF3hw4oWK2jhFDdE|梦梦'
				)	
			);
			*/
			foreach ($data as $arr) {
				$withdrawAccount=explode('|',$arr['withdrawAccount']);
				$payment_array = array( 
					"expenseAccountID"	=> $arr["accountID"],
					"incomeAccountID"	=> $this->config->item('mirrtalkSeller'),
					"MEPoints" 			=> $arr["orderAmount"],
					"WEPoints" 			=> 0,
					"withdrawAccount"	=> $withdrawAccount[0],
					"changedType"		=> 20,
					"remark"			=> "微信充值失败退款-(".$arr['orderID'].")",
					"tradeNumber"		=> $arr["orderID"],
					"callbackURL"		=> base_url().'index.php/storeapi/refundCallback?goodsSubType=18'
				);	
				$this->api_model->update_goods_count($arr["goodsID"],'goodsCount+1');
				$payment_status=$this->payment($payment_array);
				if(is_array($payment_status)){
					//更改订单状态
					$data = array(
						"orderID"    => $arr['orderID'],
						"orderStatus"=> 7,
						"updateTime" => time()
					);
					$status = $this->api_model->update_order_info($data);
					
					//更改微信红包兑换码状态
					
					$data = array(
						"orderID" 	=> $arr["orderID"],
						"codeStatus" 	=> 4
					);
					
					$status = $this->api_model->update_code_status($data);
				}



				
			
				
			}
		}
		/*
		*给用户退款
		*param orderID
		*return status
		*/
		public function userRefund(){
			$data = $this->api_model->get_user_refund();
			if(empty($data)){
				return ;
			}
			foreach ($data as $key => $value) {
				$order_info = $this->api_model->get_order_detail($value["orderID"]);
				$first = substr($value["orderID"],0,1);
				if($first != "A" && !empty($order_info)){
					$sellerAccountID = $this->api_model->get_business_id($order_info["orderID"]);
					if($sellerAccountID==""){
						$body = $this->sign->return_error_code("10100",'json','inside');
						$this->output
						->set_content_type('application/json')
						->set_output($body);
						return ;
					}
					$payment_array = array(          
						"expenseAccountID"	=> $order_info["accountID"],
						"incomeAccountID"	=> $sellerAccountID,
						"MEPoints" 			=> $order_info["mecoin"],
						"WEPoints" 			=> $order_info["wecoin"],
						"withdrawAccount"	=> $order_info['withdrawAccount'],
						"changedType"		=> 20,
						"remark"			=> "商品退款-(".$order_info['orderID'].")(".$order_info['goodsName'].")",
						"tradeNumber"		=> $order_info["orderID"],
						"callbackURL"		=> base_url().'index.php/storeapi/refundCallback?goodsSubType='.$order_info["goodsSubType"]
					);
					$this->api_model->update_goods_count($order_info["goodsID"],'goodsCount+1');
					return $this->payment($payment_array);
				}
			}			
		}
		/*
		*兑换微信钱包
		*code openid
		*/
		public function exchangeRedpack(){
			$WXRedpackInfo = $this->input->post(NULL,TRUE);
			$data = $this->api_model->get_withdrawWXW_info($WXRedpackInfo);
//orderID,goodsID,orderAmount,withdrawAccount,costPrice,accountID
			if(!is_array($data)){
				$body = $this->sign->return_error_code($data,'json','inside');
				$this->output
				->set_content_type('application/json')
				->set_output($body);
				return ;
			}
			$weixin_dev = $this->config->item('weixin_dev');
			$weixin_api = $this->config->item('weixin_api');
			$mch_id = $weixin_dev['mch_id'];	     				
			$wxappid = $weixin_dev['wxappid'];  	 		
			$request_url =$weixin_api['sendredpack'];               
			$weixin_account = explode('|',$data['withdrawAccount']);
			$param_array = array(
				"nonce_str"		=> md5(date('ymdhis')),
				"mch_billno"	=> $mch_id.date('Ymd').createRandNumberBySize(10),
				"mch_id"		=> $mch_id,
				"wxappid"		=> $wxappid,
				"send_name"		=> "道客快分享",
				"nick_name"		=> "上海语镜汽车",
				"re_openid"		=> $weixin_account[0],
				"total_amount"	=> $data['orderAmount'],
				"min_value"		=> $data['orderAmount'],
				"max_value"		=> $data['orderAmount'],
				"total_num"		=> 1,
				"wishing"		=> "感谢您对道客社区的贡献！",
				"client_ip"		=> $_SERVER['REMOTE_ADDR'],
				"act_name"		=> "道客社区里程奖励",
				"remark"		=> "里程奖励提现，订单号：".$data['orderID'],
				"logo_imgurl" 	=> "http://store.daoke.me/public/img/icon.png"
			);
			$param_array["sign"] = $this->sign->get_weixin_sign($param_array);die();
			$status = $this->redpack->send_redpack($request_url,$param_array);
			if($status['return_code']=='FAIL' && $status['return_msg']=='帐号余额不足，请到商户平台充值后再重试'){
				$body = $this->sign->return_error_code("10056",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
			}
			if($status["return_code"] =="SUCCESS"){
				$order_array = array(
					"orderID" 	=> $data['orderID'],
					"updateTime"=> time(),
					"outsideID"	=> $status["mch_billno"],
					"orderStatus"=> 6
				);
				$status = $this->api_model->update_order_info($order_array);
				$code_array=array(
					'orderID'  => 	$data['orderID'],
					'codeStatus'=>  2 
				);
				$this->api_model->update_code_status($code_array);
				$data='0';
				$body = $this->sign->return_error_code($data,'json','inside');
	                                $this->output
        	                        ->set_content_type('application/json')
                	                ->set_output($body);
                        	        return ;
			}else{
				$order_array = array(
					"orderID" 	=> $data['orderID'],
					"updateTime"=> time(),
					"orderStatus"=> 4
				);
				$status = $this->api_model->update_order_info($order_array);
				$code_array=array(
					'orderID'  => 	$data['orderID'],
					'codeStatus'=>  3 
				);
				$this->api_model->update_code_status($code_array);
				$data='10052';
				$body = $this->sign->return_error_code($data,'json','inside');
						$this->output
						->set_content_type('application/json')
						->set_output($body);
						return ;
			}
		}
		/*
		*获取话费多订单列表
		*param startTime,endTime,status,
		return list
		*/
		public function getHuafeiduoOrderList(){
			$status_array = ["success","recharging","failure"];
			for ($i=0; $i < count($status_array); $i++) { 
				$param_array = array(
					"start_time"	=> strtotime('-1day'),
					"end_time"		=> time(),
					"page"			=> 1,
					"status"		=> $status_array[$i]
				);
				$url = $this->config->item('huafeiduo_api');
				$info = $this->sign->get_huafeiduo_sign($param_array);
				$body = $this->curl->simple_get($url['get_order_list'].$info);
				$array = json_decode($body,true);
				if($array["status"]=="success"){
					$data_array = $array["data"];
					$list_array = $data_array["orders"];
					$total_page = ceil($data_array["count"]/$data_array["page_size"]);
					for ($i=1; $i <= $total_page; $i++) { 
						$this->insert_huafeiduo_order($status_array[$i],$i);
					}				
				}
			}		
		}
		/*
		*道客捐献
		*param accountID,daokePassword,amount,sign
		*
		*/
		public function donateDaoke(){
			if (!$this->form_validation->run('donate')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post(NULL,TRUE);
			$verifyCode =  $this->sign->get_verify_code($post_data);
			if($verifyCode != $post_data['sign']){
				$body = $this->sign->return_error_code("10019",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
	        	return ;
			}
			$userInfo = $this->getUserInfo($post_data["accountID"]);    
			if(!is_array($userInfo)){
				$body = $this->sign->return_error_code($userInfo,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$donateInfo=array(
				'donatorAccountID'	=>$post_data['accountID'],
				'donatorName'		=>$userInfo['nickname'],
				'daokePassword'		=>$post_data['daokePassword'],
				'isAnonymous'		=>'0',
				'amount'			=>$post_data['amount'],
				'donatedType'		=>'1',
				'regularDonation'	=>'0'
			);
			$url = $this->config->item('mirrtalk_api');
			$info = $this->sign->get_sign_array($donateInfo,'keyValue');
			$body = $this->curl->simple_post($url['donate_daoke'],$info);
			$co = json_decode($body,true);
			if($co['ERRORCODE']!="0"){
				if($co['ERRORCODE']=="ME18063"){
					$body = $this->sign->return_error_code("10106",'json','inside');
				}else if($co['ERRORCODE']=="ME01037"){
					$body = $this->sign->return_error_code("10105",'json','inside');
				}else{
					$body = $this->sign->return_error_code("10032",'json','inside');
				}
			}
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($body);
		}
		/*
		*用户的捐献排名   
		*param accountID  type
		*
		*/
		public function getRewardRank(){
			if (!$this->form_validation->run('rewardRank')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post(NULL,TRUE);
			$rewardRankInfo=array(
				'time'			=>date("Ymd",time()),
				'type'		    =>$post_data['type'],
				'accountID'		=>$post_data['accountID']
			);
			$url = $this->config->item('mirrtalk_api');
			$info = $this->sign->get_sign_array($rewardRankInfo,'keyValue');
			$body = $this->curl->simple_post($url['get_reward_rank'],$info);
			$co = json_decode($body,true);
			if($co['ERRORCODE']!="0"){
				$body = $this->sign->return_error_code("10033",'json','inside');
			}else{
				if(empty($co['RESULT'])){
					$body = $this->sign->return_error_code("10015",'json','inside');
				}else{
					$co['RESULT']=$co['RESULT'][0];
					$body = json_encode($co,true);
				}
			}
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($body);
		}
		/*
		*社区建设贡献榜单
		*param  rankType  accountID
		*
		*/
		public function donateRankList(){
			if (!$this->form_validation->run('donateList')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post(NULL,TRUE);//fetch_donation_info
			$rankInfo=array(
				'time'			=>date("Ymd",time()),
				'type'		    =>$post_data['rankType'],
				'startRank'		=>1,
				'endRank'		=>10,
				'pageCount'		=>10
			);
			$url = $this->config->item('mirrtalk_api');
			$info = $this->sign->get_sign_array($rankInfo,'keyValue');
			$body = $this->curl->simple_post($url['get_all_rank_info'],$info);
			$co=json_decode($body,TRUE);
			if(empty($co['RESULT'])){
				$body = $this->sign->return_error_code("10015",'json','inside');
			}
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($body);
		}
		public function insert_huafeiduo_order($status,$i){
			$param_array = array(
				"start_time"	=> strtotime('-1day'),
				"end_time"		=> time(),
				"page"			=> $i,
				"status"		=> $status
			);
			$url = $this->config->item('huafeiduo_api');
			$info = $this->sign->get_huafeiduo_sign($param_array);
			$body = $this->curl->simple_get($url['get_order_list'].$info);
			$array = json_decode($body,true);
			if($array["status"]=="success"){
				$data_array = $array["data"];
				$list_array = $data_array["orders"];
				foreach ($list_array as $key => $value) {
					$insert_data = array(
						"orderID"		=> $value["sp_order_id"],
						"huafeiduoID"	=> $value["order_id"],
						"phone"			=> $value["mobile_num"],
						"orderAmount"	=> $value["card_worth"],
						"costPrice"		=> $value["price"],
						"createTime"	=> $value["create_time"],
						"updateTime"	=> $value["last_status_change_time"],
						"orderStatus"	=> $value["status"]=="success"?"1":"0"
					);
					$status = $this->api_model->insert_huafeiduo_order($insert_data);
				}
			}
		}
		/*
		*店铺信息
		*param shopID 
		*
		*/
		public function getShopInfo(){
			if (!$this->form_validation->run('shopID')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$shopID=$this->input->post('shopID');
			$body = $this->api_model->get_shop_info($shopID);
			$body = $this->sign->return_error_code($body,'json','outside');
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($body);
		}
		/*
		*评论商品
		*param accountID orderID  commentContent   commentImg  beforecommentID   commentType(first,addto)
		*return status
		*/
		public function addComment(){
			if (!$this->form_validation->run('addcomment')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    } 
			$post_data=$this->input->post(NULL,TRUE);
			if($post_data['commentType']==4){
				if(empty($post_data['beforecommentID'])){
					$body = $this->sign->return_error_code("10010",'json','inside');
					$this->output
						->set_content_type('application/json')
						->set_output($body);
					return ;
				}
			}
			$post_data['commentImg']="";
			$post_data['beforecommentID']=$this->input->post("beforecommentID",TRUE)?($post_data['beforecommentID']):"";
			if(!$this->upload->do_upload("commentImg1")) {      
				$post_data['commentImg']='';
		    }else{
				//返回上传文件的所有相关信息的数组
		    	$file = $this->upload->data();     
				$post_data['commentImg'].=base_url().'public/upload/commentImg/'.$file['file_name'];   
		    }
		    if($this->upload->do_upload("commentImg2")) {      
		    	$file = $this->upload->data();     
				$post_data['commentImg'].=','.base_url().'public/upload/commentImg/'.$file['file_name']; 
		    }
		    if($this->upload->do_upload("commentImg3")) {      
				$file = $this->upload->data();     
				$post_data['commentImg'].=','.base_url().'public/upload/commentImg/'.$file['file_name']; 
		    }
		    $comment_array=array(
				'commentID'		  =>  createRandNumberBySize(8),
				'accountID'       =>  $post_data['accountID'],
				'commentType'     =>  $post_data['commentType'],
				'commentContent'  =>  $post_data['commentContent'],
				'commentImg'	  =>  $post_data['commentImg'],
				'parentID'		  =>  $post_data['beforecommentID'],
				'orderID'		  =>  $post_data['orderID']
		    );
		    $order_info=$this->api_model->comment_order_info($post_data['orderID']);		    
			if(!empty($order_info['shopID'])){
				$comment_array['shopID']=$order_info['shopID'];
				$comment_array['shopName']=$order_info['shopName'];
			}else{
				$comment_array['shopID']   = "";
				$comment_array['shopName'] ="";
			}
			$comment_array['phone']		 =$order_info['phone'];
			$comment_array['goodsID']	 =$order_info['goodsID'];
		    $comment_array['goodsName']	 =$order_info['goodsName'];
		    $comment_array['createTime'] =time();
		    $comment_array['updateTime'] =time();
		    $save_status=$this->api_model->savecomment($comment_array);
			if(empty($save_status)){
				$save_status='10000';
			}
			$data= array(
				'orderID' =>$post_data['orderID'] ,
				'comment' =>'1'
			);
			$this->api_model->orderCommentEdit($data);
			$body = $this->sign->return_error_code($save_status,'json','outside');
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($body);
		}
		/*
		*商家回复用户评论显示
		*param $accountID  $orderID
		*
		*/
		public function beforeComment(){
			if(!$this->form_validation->run('busWithComments')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
		    $post_data = $this->input->post(NULL,TRUE);
		    $body=$this->api_model->Accountcommentlist($post_data);
		    $json = $this->sign->return_error_code($body,'json','outside');			
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($json);
		}
		/*
		*评论表分类计算
		*param $goodsID,$shopID
		*return  
		*/
		public function comCountByType(){
			$post_data = $this->input->post(NULL, TRUE);
			if(empty($post_data)){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
			}
			$post_data['goodsID']=$this->input->post('goodsID',true)?($post_data['goodsID']):'';
			$post_data['shopID']=$this->input->post('shopID',true)?($post_data['shopID']):'';
			$body=$this->api_model->countcomType($post_data);
			$json = $this->sign->return_error_code($body,'json','outside');			
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($json);	
		}
		/*
		*评论表
		*param  commentType goodsID 	
		*
		*/
		public function commentList(){
			if (!$this->form_validation->run('goods')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }  
			$post_data = $this->input->post(NULL, TRUE);
  			$post_data["commentType"] = $this->input->post("commentType",TRUE)?($post_data["commentType"]):('0');
  			$post_data["pageCount"] = $this->input->post("pageCount",TRUE)?($post_data["pageCount"]):(10);
			$post_data["startPage"] = $this->input->post("startPage",TRUE)?(($post_data["startPage"]-1)*$post_data["pageCount"]):(0);
			$body=$this->api_model->commentList($post_data);
			$json = $this->sign->return_error_code($body,'json','outside');			
			$this->output
			     ->set_content_type('application/json')
			     ->set_output($json);	
		}
		/*
		*用户账单
		*param accountID  startPage   pageCount  
		*
		*/
		public function stateMentList(){
			if (!$this->form_validation->run('accountID')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data = $this->input->post(NULL,TRUE);
			$post_data["pageCount"] = $this->input->post("pageCount",TRUE)?($post_data["pageCount"]):(10);
			$post_data["startPage"] = $this->input->post("startPage",TRUE)?($post_data["startPage"]):(1);
			$post_data['startTime']= time();
			$url = $this->config->item('mirrtalk_api');		
			$info=$this->sign->get_sign_array($post_data,"keyValue");
			$body = $this->curl->simple_post($url['get_balance_detail'],$info);
			$body=json_decode($body,TRUE);
			$stateMentList=$this->api_model->stateMent($body['RESULT']);
			$body = $this->sign->return_error_code($stateMentList,'json','outside');			
			$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
		}
		/*
		*jiujiu手机充值 定时充值
		*
		*/
		public function phonePayTiming(){
			$data=$this->api_model->get_prepay_order();
			if(empty($data)){
				return ;
			}
			foreach($data as $key => $value){
				$order_info = $this->phoneFeeOrderStatus($value['orderID']);
				if($order_info['code']=='0012'){						//没有提交订单
					$phone_array=array(
						'out_trade_id' => $value['orderID'],
						'account'	   => $value['withdrawAccount'],			
						'quantity'	   => 1,
						'value'		   => floor($value['marketPrice']),			
						'expired_mini' => 5,
						'notify_url'   => base_url().'index.php/storeapi/phoneFeeCallback',
					);
					$xml=$this->payPhone($phone_array);
					if(!empty($xml)){
						$xml=simplexml_load_string($xml);		//xml转对象
						$xml=(array)$xml;						//对象转数组
						if($xml['code']=='0000'){
							$order_status_array = array(
								"orderID"		=> $value["orderID"],
								"outsideID" 	=> $xml['oid'],
								"updateTime"	=> time()     
							);
							$update = $this->api_model->update_order_info($order_status_array);
						}      
					}
					continue;
				}else if($order_info['status']=='success'){			//充值成功
					$order_status_array = array(
						"orderID"		=> $value["orderID"],
						"orderStatus"	=> 6
					);
					$update = $this->api_model->update_order_info($order_status_array);
				}else if($order_info['status']=='fail'){			//充值失败
					$order_status_array = array(
						"orderID"		=> $value["orderID"],
						"orderStatus"	=> 4
					);
					$update = $this->api_model->update_order_info($order_status_array);
				}
			}
		}
		public function payPhone($phone_array){
			$url = $this->config->item('jiujiu_api');
			$jiujiu_dev = $this->config->item('jiujiu_dev');
			$phone_array['partner']=$jiujiu_dev['partner'];
			$phone_array['method']='Huafei';
			$phone_array['sign_type']='md5';
			$phone_array["client_ip"] = $_SERVER["REMOTE_ADDR"];
			$phone_array['_sign'] = $this->sign->get_jiu_sign($phone_array);
			$body = $this->curl->simple_post($url['jiujiudou'],$phone_array);
			return $body;
		}
		/*
		*查询话费订单状态
		*
		*/
		public  function jiuQuery(){
			$data=$this->api_model->get_submit_order();
			if(empty($data)){
				return ;
			}
			foreach($data as $key => $value){
				$phone_array=array(
					'out_trade_id' => $value['orderID']
				);
				$xml=$this->queryStatus($phone_array);
				if(empty($xml)){
					return ;
				}
				$xml=simplexml_load_string($xml);
				$xml=(array)$xml;
				if ($xml['code']=='0012'){					
					continue ;
				}else if($xml['status']=='success'){	
					$orderStatus = 6;
				}else if($xml['status']=='doing'){
					$orderStatus = 6;
				}else{
					$orderStatus = 4;
				}
				$order_status_array =array(
					'orderID'	 =>$value["orderID"],
					'orderStatus'=>$orderStatus,
					'updateTime' =>time()
				);
				$update = $this->api_model->update_order_info($order_status_array);
			}
		}
		public function queryStatus($phone_array){
			$url = $this->config->item('jiujiu_api');
			$jiujiu_dev = $this->config->item('jiujiu_dev');
			$phone_array['partner']=$jiujiu_dev['partner'];
			$phone_array['method']='Query';
			$phone_array['sign_type']='md5';
			$phone_array["client_ip"] = $_SERVER["REMOTE_ADDR"];
			$phone_array['_sign'] = $this->sign->get_jiu_sign($phone_array);
			$body = $this->curl->simple_post($url['jiujiudou'],$phone_array);
			return $body;
		}
		/*
		*抽奖随机抽取中奖产品
		*return pinsID
		*/
		public function pins(){
		$prize_arr = array(
				'0' => array('id'=>1,'prize'=>'10000密点','v'=>1,'value'=>'10000'),
				'1' => array('id'=>2,'prize'=>'8000密点','v'=>5,'value'=>'8000'),
				'2' => array('id'=>3,'prize'=>'5000密点','v'=>5,'value'=>'5000'),
				'3' => array('id'=>4,'prize'=>'2000密点','v'=>5,'value'=>'2000'),
				'4' => array('id'=>5,'prize'=>'1000密点','v'=>5,'value'=>'1000'),
				'5' => array('id'=>6,'prize'=>'500密点','v'=>100,'value'=>'500'),
				'6' => array('id'=>7,'prize'=>'100密点','v'=>100,'value'=>'100'),
				'7' => array('id'=>8,'prize'=>'50密点','v'=>1000,'value'=>'50'),
				'8' => array('id'=>9,'prize'=>'10密点','v'=>2000,'value'=>'10'),
				'9' => array('id'=>10,'prize'=>'再来一次','v'=>1000,'value'=>'0')
			);			 
			$actor = 100;
			foreach ($prize_arr as $v){
				$arr[$v['id']] = $v['v'];
				}
				foreach ($arr as &$v){
				$v = $v*$actor;
			}
			asort($arr);
			$sum = array_sum($arr);			//总概率
			$total = 0;			 
			for($i = 0;$i<1;$i++){
				$rand = mt_rand(1,$sum);
				$result = '';				//中奖产品id			 
				foreach ($arr as $k => $x)
				{
				if($rand <= $x){
					$result = $k;
					break;
				}else{
					$rand -= $x;
				}
			}
				$res['yes'] = $prize_arr[$result-1]['prize']; //中奖项
				$total += $prize_arr[$result-1]['value'];
			}
			$data['pinsID']=$result;
			//$data['pinsID']=8;
			$this->session->set_userdata(array('pinsID'=>$result));
			$body = $this->sign->return_error_code($data,'json','outside');
			$this->output
			->set_content_type('application/json')
			->set_output($body);
		}
		/*
		*抽奖 （抽完奖，然后创建订单支付）
		*param accountID   pinsID  
		*return 中奖名称
		*/
		public function pinsOrderPayment(){
			//创建商城抽奖订单
			if(!$this->form_validation->run('accountID')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post(NULL,TRUE);
			$order_info = $this->api_model->get_goods_info('E100002650');
			if(empty($order_info)){
				$body = $this->sign->return_error_code("10030",'json','inside');
				$this->output
			    ->set_content_type('application/json') 
			    ->set_output($body);
				return ;
			}
			$orderAmount = $order_info['shopPrice'];
			$user_info = $this->getUserInfo($post_data["accountID"]);
			if(!is_array($user_info)){
				$body = $this->sign->return_error_code($user_info,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			$order_info["username"]		= $user_info["nickname"];
			$order_info["phone"]		= $user_info["mobile"];
			$order_info["buyCount"]		= '1';
			$order_info["accountID"]	= $post_data["accountID"];
			$order_info["orderID"]		= create_orderID('E100002650');
			$order_info["orderAmount"]	= $orderAmount;
			$order_info["mecoin"]		= $orderAmount;
			$order_info["remark"]		= '商城抽奖';
			$order_info["createTime"]	= time();
			$order_info["updateTime"]	= time();
			$order_info["orderStatus"]	= 1;
			unset($order_info["goodsCount"]);
			$save_status = $this->api_model->save_confirm_order($order_info);
			if(!$save_status){
				$body = $this->sign->return_error_code("10000",'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			}
			$payment_array = array(
				"expenseAccountID"	=> $post_data["accountID"],
				"incomeAccountID"	=> $this->config->item('mirrtalkSeller'),
				"MEPoints"			=> '100',
				"WEPoints"			=> 0,
				"withdrawAccount"	=> "",	
				"changedType"		=> 21,
				"remark"			=> "商城抽奖",
				"tradeNumber"		=> $order_info['orderID'],
				"daokePassword"		=> "",			
				"callbackURL"		=> base_url().'index.php/storeapi/paymentCallback?goodsSubType=23'
			);
			$payment_status = $this->payment($payment_array);
			if(!is_array($payment_status)){
				$body = $this->sign->return_error_code($payment_status,'json','inside');
				$this->output
			    ->set_content_type('application/json')
			    ->set_output($body);
			    return ;
			}
			if($post_data['pinsID']=='10'){
				$order_info["orderAmount"]	= '0';
				$order_info["mecoin"]		= '0';
				$order_info['remark']		= '商城抽奖未中奖';
				$order_info['orderStatus']  = '4';
				$order_info['orderID']      = $order_info['orderID'].'C';
				$this->api_model->save_confirm_order($order_info);
			}
			$consume_array = array(
				"mecoin" 			=> $payment_status['mecoin'],
				"wecoin"			=> $payment_status['wecoin'],
				"orderID"			=> $order_info['orderID'],
				"goodsID"			=> $order_info['goodsID'],
				"goodsName"			=> $order_info['goodsName'],
				"accountID"			=> $order_info['accountID']
			);
			$body = $this->sign->return_error_code($consume_array,'json','outside');
			$this->output
		    ->set_content_type('application/json')
		    ->set_output($body);
		}
		//抽奖奖励     accountID   changedAmount   pinsID  orderID
		public function reward(){   
			if (!$this->form_validation->run('reward')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post(NULL,TRUE);
			$data=$this->session->all_userdata();
			//print_r($data);
			if($data['pinsID']!=$post_data['pinsID']){
				$body = $this->sign->return_error_code("10061",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
			}
			$reward_array = array(
				'accountID'		=> $post_data['accountID'],
				'changedAmount' => $post_data['changedAmount'],
				'remark'		=> '商城中奖',
				'moneyType'		=> '1'	
			);
			$reward_array = $this->sign->get_sign_array($reward_array,'keyValue');
			$url = $this->config->item('mirrtalk_api');
			$body = $this->curl->simple_post($url['crashCharge'],$reward_array);
			$body = json_decode($body,TRUE);
			if($body['ERRORCODE']!='0'){
				$body = $this->sign->return_error_code("10060",'json','inside');
			}else{
				$data=array(
					'orderID'	  => $post_data['orderID'],
					'orderStatus' => '6',
					'updateTime'  => time()
				);
				$status=$this->api_model->update_order_info($data);   
				//创建中奖订单
				$orderInfo=$this->api_model->get_order_detail($post_data['orderID']);
				unset($orderInfo['redeemCode'],$orderInfo['goodsCount']);
				$orderInfo['orderAmount']=$post_data['changedAmount'];
				$orderInfo['remark']='商城中奖';
				$orderInfo['orderID']=$post_data['orderID'].'C';
				$this->api_model->save_confirm_order($orderInfo);
				$body = $this->sign->return_error_code("0",'json','inside');
			}
			$this->output
			->set_content_type('application/json')
			->set_output($body);
			return ;
		}
		//更改订单状态
		public function editOrderStatus(){
			$data=$this->input->get(NULL,TRUE);
			$data=explode('/',$data['orderID']);
			$edit['orderID']=$data[0];
			$edit['orderStatus']=$data[1];
			$rs = $this->api_model->editStatus($edit);
			$body = $this->sign->return_error_code($rs,'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		}
		public function editOutsideID(){
			$get_data=$this->input->get(NULL,TRUE);
			$data=explode('/',$get_data['data']);
			$edit['orderID']   = $data[0];
			$edit['outsideID'] = $data[1];
			$rs = $this->api_model->editOutsideID($edit);
			$body = $this->sign->return_error_code($rs,'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		}
		
		/*
		*微频道打赏
		*param   accountID    changedAmount 
		*return 
		*/
		public function microChannelReword(){
			if (!$this->form_validation->run('microChannelReword')){
				$body = $this->sign->return_error_code("10010",'json','inside');
				$this->output
				    ->set_content_type('application/json')
				    ->set_output($body);
		        return ;
		    }
			$post_data=$this->input->post(NULL,TRUE);			
			$reward_array = array(
				'accountID'		=> $post_data['accountID'],
				'changedAmount' => $post_data['changedAmount'],
				'remark'		=> '微频道打赏',
				'moneyType'		=> '1'	
			);
			$reward_array = $this->sign->get_sign_array($reward_array,'keyValue');
			$url = $this->config->item('mirrtalk_api');
			$body = $this->curl->simple_post($url['crashCharge'],$reward_array);
			$body = json_decode($body,TRUE);
			if($body['ERRORCODE']!='0'){
				$body = $this->sign->return_error_code("10070",'json','inside');
			}else{   
				//创建微频道订单
				$userInfo = $this->getUserInfo($post_data['accountID']);
				$goodsInfo = $this->api_model->get_goods_info('F100002751');
				$buyCount = $post_data['changedAmount']/10;
				$order_info=array(
					'orderID'	  => create_orderID('F100002751'),
					'goodsID'	  => 'F100002751',
					'goodsName'	  => $goodsInfo['goodsName'],
					'buyCount'	  => $buyCount,
					'mecoin'	  => $post_data['changedAmount'],
					'marketPrice' => $goodsInfo['marketPrice'],
					'shopPrice'	  => $goodsInfo['shopPrice'],
					'goodsImg'    => $goodsInfo['goodsImg'],
					'orderStatus' => '6',
					'accountID'   => $post_data['accountID'],
					'username'	  => $userInfo['nickname'],
					'phone'       => $userInfo['mobile'],
					'orderAmount' => $post_data['changedAmount'], 	
					'remark'	  => '微频道打赏',
					'startTime'   => $goodsInfo['startTime'],
					'endTime'     => $goodsInfo['endTime'],
					'createTime'  => time(),
					'updateTime'  => time()
				);
				$status = $this->api_model->save_confirm_order($order_info);
				if($status){
					$body = $this->sign->return_error_code($order_info,'json','outside');
				}else{
					$body = $this->sign->return_error_code('10000','json','inside');
				}
			}
			$this->output
				 ->set_content_type('application/json')
				 ->set_output($body);
			return ;
		}
	}
?>
