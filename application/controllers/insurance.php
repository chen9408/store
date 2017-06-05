<?php 
	class insurance extends CI_Controller{				
		public function __construct(){
			parent::__construct();
			$this->load->model('store_model');
			$this->load->helper(array('url','form','captcha'));
			$this->load->library(array('session','parser','form_validation','curl','sign'));
		}
		public function create(){
			$data['title'] =  '意外险';
			$data['accountID'] = $this->input->get("accountID",NULL);
			if(empty($data['accountID'])){
				$data['error_title'] = '请求错误';
		        $data['success_title'] = '';
		        $this->parser->parse('templates/header', $data);
		        $this->load->view('state', $data);
		        $this->load->view('templates/footer');
				return ;
			}
			$this->parser->parse('templates/header', $data);
			$this->parser->parse('insurance/create', $data);
			$this->load->view('templates/footer');
	  	}
	  	public function fillIn(){
			$data['title'] =  '确认保单';
			$param = $this->input->get("param",NULL);
			$param_array = explode('|',$param);
			if(empty($param_array) || count($param_array)!=5){
				$data['error_title'] = '请求错误';
		        $data['success_title'] = '';
		        $this->parser->parse('templates/header', $data);
		        $this->load->view('state', $data);
		        $this->load->view('templates/footer');
				return ;
			}			
			$data["insurePeriod"] = $param_array[0]*10;
			$data["adultCount"] = $param_array[1];
			$data["minorCount"] = $param_array[2];
			$data["totalMecoin"] = $param_array[3];
			$data["accountID"] = $param_array[4];
			$data["amount"] = $param_array[1]+$param_array[2];
			$this->parser->parse('templates/header', $data);
			$this->load->view('insurance/fillIn', $data);
			$this->load->view('templates/footer');	
	  	}
	  	public function policy(){
	  		$data['title'] =  '意外险出单';
			$this->parser->parse('templates/header', $data);
			$this->load->view('insurance/policy');
			$this->load->view('templates/footer');
	  	}
	  	public function request(){
	  		$act = $this->input->get('act', TRUE);
			switch ($act) {
				case 'createOrder':
					$post_data = $this->input->post(NULL,TRUE);
					if (!$this->form_validation->run('insure_order')){
						$body = $this->sign->return_error_code("10010",'json','inside');
				        $this->output
			            ->set_content_type('application/json')
			            ->set_output($body);
			            return ;
			      	}
			      	$goodsID = $post_data['insurePeriod'] == "10"?'D100000457':'D100000189';
		      		$unitPrice = $post_data['insurePeriod'] == "10"?1000:1800;
		      		$order_info = array(
		      			"accountID" => $post_data["accountID"],
		      			"goodsID"	=> $goodsID,
		      			"amount"	=> $post_data['premium'],
		      			"unitPrice" => 1,
		      			"totalPrice"=> $post_data['premium']
		      		);
		      		$order_info["sign"] =  $this->sign->get_verify_code($order_info);
		      		$url = base_url().'index.php/storeapi/confirmOrder';
					$body = $this->curl->simple_post($url,$order_info);
					try{
						$co = json_decode($body,true);
						if($co['ERRORCODE']=="0"){
							$post_data['premium'] = $post_data['premium']/100;
							$post_data['orderID'] = $co['RESULT']['orderID'];
							$post_data['createTime'] = time();
							$post_data['updateTime'] = time();
			      			$stauts = $this->store_model->create_insure_orderInfo($post_data);
						}	
						print_r($body);
					}catch(Exception $e){
						print_r($body);
					}
				break;
				case 'payment':
					$post_data = $this->input->post(NULL,TRUE);
					if (!$this->form_validation->run('insure_payment')){
						$body = $this->sign->return_error_code("10010",'json','inside');
				        $this->output
			            ->set_content_type('application/json')
			            ->set_output($body);
			            return ;
			      	}
			      	$post_data["wecoin"] =  0;
			      	$post_data["sign"] =  $this->sign->get_verify_code($post_data);
		      		$url = base_url().'index.php/storeapi/mallPay';
					$body = $this->curl->simple_post($url,$post_data);
					$co = json_decode($body,true);
					if($co['ERRORCODE']=="0"){
						$update_array = array(
							"orderID"	=> $post_data['orderID'],
							"status"	=> 1,
							"updateTime"=> time()
						);
						//修改保单状态
						$status = $this->store_model->update_insure_order($update_array);
						//开始调用保险接口
						$orderInfo = $this->store_model->getOrderInfo($post_data['orderID']);
						foreach($orderInfo as $key => $value){
							$insuredData = explode(',',$value['adultInfo']);
							$date=date("Ymd",$value['createTime']+60*60*24);
							$policy_array = array(
								'applicantName'			=> $value['insureName'],		//投保人姓名
								'applicantCercCode'     => $value['insureIDCard'],		//投保人身份证号
								'phoneNumber'			=> $value['insurePhone'],		//投保人电话
								'insuredDays'			=> $value['insurePeriod'],		//保险时常
								'policyBeginDate'		=> $date,						//起保日期
								'insuredNames'			=> $insuredData[0],				//被保人名字
								'insuredCercCodes'		=> $insuredData[1]				//被保人身份证号
							);
							$url = 'http://192.168.1.13:8021/WeMe/cpic/standardApproval';
							$status = $this->curl->simple_post($url,$policy_array);
							$status = json_decode($status,TRUE);
							if($status['ERRORCODE']==0&&$status['RESULT'][0]['returnNumber']=='S000'){
								//修改状态
								$update_array = array(
									"adultInfo"	=> $value['adultInfo'],
									"orderID"	=> $post_data['orderID'],
									"status"	=> 2,
									"updateTime"=> time(),
									"insureID"	=> $status['RESULT'][0]['policyNo']
								);
								//修改保单状态
								$status = $this->store_model->update_insure_order($update_array);
							}elseif($status['ERRORCODE']==0&&$status['RESULT'][0]['returnNumber']!='S000'){
								//保险失败
								$update_array = array(
									"adultInfo"	=> $value['adultInfo'],
									"orderID"	=> $post_data['orderID'],
									"status"	=> 3,
									"updateTime"=> time(),
								);
								//修改保单状态
								$status = $this->store_model->update_insure_order($update_array);
							}
						}
						print_r($body);
						return ;
					}
					else{
						print_r($body);
						return ;
					}		
				break;
				case 'getOrderList':
					$post_data = $this->input->post(NULL, TRUE);
      				$post_data["pageCount"] = 10;
      				$post_data["startPage"] = $this->input->post("startPage")?(($post_data["startPage"]-1)*$post_data["pageCount"]):(0);
      				$body = $this->store_model->get_insure_orderList($post_data);
      				$json = $this->sign->return_error_code($body,'json','outside');     
			      	$this->output
			          ->set_content_type('application/json')
			          ->set_output($json);  
      			break;
      			case 'outofInsurePolicy':
					$post_data = $this->input->post(NULL, TRUE);
					if(empty($post_data['orderID']) || empty($post_data['insureID'])){
						return '10010';
					}
					$post_data['status'] = 2;
					$post_data['updateTime'] = time();
      				$body = $this->store_model->update_insure_orderInfo($post_data);
      				if($body){
						$order_array = array(
							"orderStatus" => 6,
							"orderID"	=> $post_data["orderID"]	
						);
      					//$body = $this->store_model->update_order_status($order_array);
						$body='';
      				}
      				$json = $this->sign->return_error_code($body,'json','outside');     
			      	$this->output
			          ->set_content_type('application/json')
			          ->set_output($json); 
      			break;
      			default:
				break;
			}
	  	}
	}
?>