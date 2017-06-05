<?php
	function check_goodsID($goodsID){
		$first = substr($goodsID,0,1);
		$goods_type = array('A','B','C','D');
		return in_array($first, $goods_type);
	}
	function create_sellerID($sellerID){
	    if(empty($sellerID)){
	      return "100000";
	    }else{
	      return $sellerID+1;
	    }
	}
	function create_shopID($sellerID,$shopID){
		if(empty($shopID)){
	      return $sellerID."001";
	    }else{
	      return $shopID+1;
	    }
	}
	class Request extends CI_Controller{				
		public function __construct(){
	  		parent::__construct();
	  		$this->load->model('store_model');
	  		$scanPreview = $this->config->item('scanPreview');
      		$this->load->library('upload',$scanPreview);
	  		$this->load->helper(array('url','form','cookie','captcha'));
	  		$this->load->library(array('session','parser','curl','sign','email','sms'));
		}
		public function api(){
			$url = $this->config->item('mirrtalk_api');
			$act = $this->input->get('act', TRUE);
			switch ($act) {
				case 'getDistrictInfo':
          			$post_data = $this->input->post(NULL, TRUE);
					$info = $this->sign->get_sign_array($post_data,'json');
		          	$body = $this->curl->simple_post($url['district_info'],$info);
          			$this->output->set_output($body);
					break;
				case 'updateSellerStatus':
					$post_data = $this->input->post(NULL, TRUE);
					$body = $this->store_model->update_seller_status($post_data);
					$body = $this->sign->return_error_code($body,'json','');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'updateGoodsStatus':
					$post_data = $this->input->post(NULL, TRUE);
					$body = $this->store_model->update_goods_status($post_data);
					$body = $this->sign->return_error_code($body,'json','');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;				
				case 'getVerifyImg':
					$vals = array(
						'word'=>rand(1000,10000),
					    'img_path' => './captcha/',
					    'img_url' => base_url().'captcha/',
					    'font_path' => base_url().'public/fonts/chinese.ttf',
					    'img_width' => 130,
					    'img_height' => 40,
					    'expiration' => 5
			    	);
					$cap = create_captcha($vals);
					$this->session->set_userdata(array('verify_code'=>$cap['word']));
					$verify_array = array(
						'jpg'	=>	$vals['img_url'].$cap['time'].'.jpg',
						'word'	=>	$cap['word']
					);
					$body = $this->sign->return_error_code($verify_array,'json','outside');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'getVerifyCode':
					$phone = $this->input->post('phone',TRUE);
					$templateID = '10469';
					$verify_code = rand(1000,10000);
					$data = array($verify_code,10);
					$return_array = $this->sms->sendTemplateSMS($phone,$data,$templateID);
					if(is_array($return_array)){
						$this->session->set_userdata(array('mobile_code'=>$phone.$verify_code));
						$body = $this->sign->return_error_code($return_array,'json','outside');
					}else{
						$body = $this->sign->return_error_code($return_array,'json','inside');
					}
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'checkVerifyCode':
					$session_mobile_code = $this->session->userdata('mobile_code');
					$code = $this->input->post('code',TRUE);
					$telephone =  $this->input->post('telephone',TRUE);
					$mobile_code = trim($telephone).trim($code);
		  			if($mobile_code==$session_mobile_code){
		  				$body = $this->sign->return_error_code('0','json','inside');
		  			}else{
		  				$body = $this->sign->return_error_code('0','json','inside');
		  			}
		  			$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'checkBusinessID':
					$sellerID = $this->session->userdata('sellerID');
					$businessID = $this->store_model->get_businessID($sellerID);
					$body = $this->sign->return_error_code($businessID,'json','outside');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'checkRedeemCode':
					$post_data = $this->input->post(NULL, TRUE);
					if(strlen($post_data["cardNumber"])!=10 || strlen($post_data["cardPassword"])!=5){
						$body = $this->sign->return_error_code("10010",'json','inside');
						$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
			        	return ;
					}
					$body = $this->store_model->check_redeemCode($post_data);
					if(is_array($body)){
						$body = $this->sign->return_error_code($body,'json','outside');
					}else{
						$body = $this->sign->return_error_code($body,'json','inside');
					}
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;	
				default:
					# code...
					break;
			}
		}		
		public function register(){
			$act = $this->input->get('act', TRUE);
			switch ($act) {
				case 'saveBaseInfo':
					$post_data = $this->input->post(NULL, TRUE);
					$se_verify_code = $this->session->userdata('verify_code');
					if($post_data['verify_code']!=$se_verify_code){
					    $body = $this->sign->return_error_code("10001",'json','inside');
						$this->output
						    ->set_content_type('application/json')
						    ->set_output($body);
					    return ;
					}
					$post_data['accountID'] = $this->session->userdata('accountID');
					if(!$post_data['accountID']){						
					    $body = $this->sign->return_error_code("9999",'json','inside');
                	                    $this->output
                                                    ->set_content_type('application/json')
                                                    ->set_output($body);
                                            return ;
					}
					unset($post_data['verify_code']);
					$post_data["createTime"] = time();
					$post_data["token"] = sha1($post_data["email"].$post_data["accountID"].time());
					$post_data["tokenExptime"] = time()+60*60*24;
					if($this->store_model->check_seller_email($post_data["email"])){
						$body = $this->sign->return_error_code("10002",'json','inside');
						$this->output
						    ->set_content_type('application/json')
						    ->set_output($body);
					    return ;
					}
					$url = $this->config->item('mirrtalk_api');    
					$param = array("accountID"=>$post_data["accountID"]);
					$info = $this->sign->get_sign_array($param,'keyValue');       //返回有accountID，appkey 的一个数组
					$imei_phone= $this->curl->simple_post($url['imei_phone'],$info);
					$phone=json_decode($imei_phone,true);
					$post_data['telephone']=$phone['RESULT']['phone'];
					$body = $this->store_model->save_seller_baseInfo($post_data);
					if(!$body){
						$body = $this->sign->return_error_code("10000",'json','inside');
						$this->output
						    ->set_content_type('application/json')
						    ->set_output($body);
					    return ;
					}else{
						$url = base_url().'index.php/activeregitser?token='.$post_data["token"];
						$message = '<div><p>你好!</p><p>感谢你注册道客商城卖家平台。<br>'.
						'你的登录邮箱为：<a href="mailto:'.$post_data['email'].'">'.$post_data['email'].'</a>。请点击以下链接激活帐号：</p>'.
						'<p style="word-wrap:break-word;word-break:break-all;"><a href="'.$url.'" target="_blank">'.$url.'</a></p>'.
						'<p>如果以上链接无法点击，请将上面的地址复制到你的浏览器(如IE)的地址栏进行激活。 （该链接在24小时内有效，24小时后需要重新注册）</p>'.		
						'</div>';
						$this->email->from($this->config->item("from_email"), $this->config->item("from_name"));
						$this->email->to($post_data["email"]);
						$this->email->subject($this->config->item("email_subject"));
						$this->email->message($message);
						if(!$this->email->send()){
							$body = $this->sign->return_error_code("10003",'json','inside');
							$this->output
							    ->set_content_type('application/json')
							    ->set_output($body);
						    return ;
						}
						$body = $this->sign->return_error_code("0",'json','inside');
						$this->output
						    ->set_content_type('application/json')
						    ->set_output($body);
					}
					break;
		  		case 'saveSellerInfo':
		  			$post_data = $this->input->post(NULL,TRUE);
		  			$session_token = $this->session->userdata('accountID');
		  			if($post_data["accountID"]!=$session_token){
		  				$data['error_title'] = '登录超时，<a href="'.base_url().'index.php/login">重新登录</a>';
		  				$data['success_title'] = '';
		  				$this->parser->parse('templates/header', $data);
		  				$this->load->view('state', $data);
		  				$this->load->view('templates/footer');
		  				return ;
		  			}
		  			if($this->upload->do_upload("licenseScanPreview")) {
						$file = $this->upload->data();
			          	$post_data['licenseScanPreview']=base_url().'public/upload/userImg/'.$file['file_name'];
			        }else{
			          	$post_data['licenseScanPreview']='';
			        }
			       	if($this->upload->do_upload("orgScanPreview")) {
						$file = $this->upload->data();
			          	$post_data['orgScanPreview']=base_url().'public/upload/userImg/'.$file['file_name'];
			        }else{
			        	$post_data['orgScanPreview']='';
			        }			        
			        unset($post_data["s_id"]);
			        $sellerID = $this->store_model->get_seller_maxID();
      				$post_data['sellerID'] = create_sellerID($sellerID);
			        $body = $this->store_model->save_seller_info($post_data);
			      	if($body){
				        $data= array('title'=>'新增','success_title'=>'资料已提交，我们将在三个工作日内审核，结果以邮件形式发送到你的邮箱!<a href="'.base_url().'index.php/login">登录</a>','error_title'=>'');
				        $this->parser->parse('templates/header', $data);
				        $this->load->view('state', $data);
				        $this->load->view('templates/footer');
			     	}else{
				        $data= array('title'=>'新增','error_title'=>'抱歉，出了点儿问题!<a href="'.base_url().'index.php/register">重新填写资料</a>','success_title'=>'');
				        $this->parser->parse('templates/header', $data);
				        $this->load->view('state', $data);
				        $this->load->view('templates/footer');
				    }
		  			break;
		  		case 'updateSellerInfo':
		  			$post_data = $this->input->post(NULL,TRUE);
		  			$post_data['updateTime'] = time();
		  			if(!empty($_FILES['licenseScanPreview']['name'])){
						if($this->upload->do_upload("licenseScanPreview")) {
							$file = $this->upload->data();
			          		$post_data['licenseScanPreview']=base_url().'public/upload/userImg/'.$file['file_name'];
			        	}else{
			          		$post_data['licenseScanPreview']='';
			        	}
		  			}else{
		  				unset($post_data["licenseScanPreview"]);
		  			}
		  			if(!empty($_FILES['orgScanPreview']['name'])){
		  				if($this->upload->do_upload("orgScanPreview")) {
							$file = $this->upload->data();
				          	$post_data['orgScanPreview']=base_url().'public/upload/userImg/'.$file['file_name'];
				        }else{
				        	$post_data['orgScanPreview']='';
			        	}
		  			}else{
		  				unset($post_data["orgScanPreview"]);
		  			}
		  			$body = $this->store_model->update_seller_info($post_data);
		  			if($body){
				        $data= array('title'=>'新增','success_title'=>'资料已提交，我们将在三个工作日内审核，结果以邮件形式发送到你的邮箱!<a href="'.base_url().'index.php/login">登录</a>','error_title'=>'');
				        $this->parser->parse('templates/header', $data);
				        $this->load->view('state', $data);
				        $this->load->view('templates/footer');
			     	}else{
				        $data= array('title'=>'新增','error_title'=>'抱歉，出了点儿问题!<a href="'.base_url().'index.php/register">重新填写资料</a>','success_title'=>'');
				        $this->parser->parse('templates/header', $data);
				        $this->load->view('state', $data);
				        $this->load->view('templates/footer');
				    }
		  			break;
				default:
					# code...
					break;
			}
		}
		public function seller(){
			$act = $this->input->get('act', TRUE);
			switch ($act) {
				case 'getSellerInfo':				
					$sellerID = $this->input->post('s_id',TRUE);
					$status = $this->input->post('status',TRUE);
					$body = $this->store_model->get_sellerInfo($sellerID,$status);
					$body = $this->sign->return_error_code($body,'json','outside');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'auditSeller':
					$post_data = $this->input->post(NULL,TRUE);
					$data = $this->store_model->update_seller_status($post_data);
					$response = '';
					$auditStatus = '';
					if(is_array($data)){
						if($post_data["checkStatus"]=="0"){
							$url = $this->config->item('mirrtalk_api');
							$body = array("accountID" => $data['accountID']);
							$info = $this->sign->get_sign_array($body,'');
							$body = $this->curl->simple_post($url['get_business_info'],$info);
							$get_data = json_decode($body,true);
							if($get_data['ERRORCODE'] == "0"){
								$add_busisness = array("businessID" => $get_data['RESULT'][0]['id']);
								$body = $this->store_model->save_businessID($data["accountID"],$add_busisness);
							}
							$auditStatus = '审核通过';
						}else{
							$auditStatus = '审核未通过';
						}
						$message = '<div><p>'.$data['name'].'你好!</p><p>感谢你注册道客商城卖家平台。<br>'.
						'<p>您注册的商户【'.$data['sellerName'].'】，'.$auditStatus.'</p>'.
						'<h4>'.$post_data["content"].'</h4>'.
						'<p><a href="'.base_url().'index.php/login">点击登录</a></p>'.
						'</div>';
						$this->email->from($this->config->item("from_email"), $this->config->item("from_name"));
						$this->email->to($post_data["email"]);
						$this->email->subject($this->config->item("email_subject"));
						$this->email->message($message);
						if(!$this->email->send()){
							$response = $this->sign->return_error_code("10003",'json','inside');
						}else{
							$response = $this->sign->return_error_code("0",'json','inside');
						}
						$this->output
						    ->set_content_type('application/json')
						    ->set_output($response);
					}else{
						$body = $this->sign->return_error_code("10000",'json','inside');
						$this->output
						    ->set_content_type('application/json')
						    ->set_output($body);
					}
					break;			
				default:
					break;
			}
		}
		public function shop(){
			$act = $this->input->get('act', TRUE);
			$sellerID = $this->session->userdata('sellerID');
  			if(!$sellerID){
  				$data['error_title'] = '登录超时，请重新登录';
  				$data['success_title'] = '';
  				$this->parser->parse('templates/header', $data);
  				$this->load->view('state', $data);
  				$this->load->view('templates/footer');
  				return ;
  			}		
			switch ($act) {
				case 'saveShopInfo':					 		
					$post_data = $this->input->post(NULL,TRUE);
					$shopID = $this->store_model->get_max_shopID($sellerID);
					$post_data["shopID"] = create_shopID($sellerID,$shopID);
					$post_data["sellerID"] = $sellerID;
					$post_data["startTime"] = strtotime($post_data["startTime"]);
					$post_data["endTime"] = strtotime($post_data["endTime"]);
					$post_data["createTime"] = time();
					$post_data["password"] = md5($post_data["password"]);
					unset($post_data['agpassword']);
					$check_username = $this->store_model->check_shop_username($post_data["username"]);
					if(!empty($check_username)){
						$data= array('title'=>'新增','error_title'=>'抱歉，出了点儿问题!','success_title'=>'');
				        $this->parser->parse('templates/header', $data);
				        $this->load->view('state', $data);
				        $this->load->view('templates/footer');
					    return ;
					}
					$body = $this->store_model->save_shop_info($post_data);
					if($body){
				        $data= array('title'=>'新增','success_title'=>'店铺添加成功','error_title'=>'');
				        $this->parser->parse('templates/header', $data);
				        $this->load->view('state', $data);
				        $this->load->view('templates/footer');
			     	}else{
				        $data= array('title'=>'新增','error_title'=>'抱歉，出了点儿问题!','success_title'=>'');
				        $this->parser->parse('templates/header', $data);
				        $this->load->view('state', $data);
				        $this->load->view('templates/footer');
				    }
					break;
				case 'getShopInfo':
					$shopID = $this->input->post('shopID',TRUE);
					$body = $this->store_model->get_shop_info($shopID);
					if($body){
						$body[0]['startTime'] = date('H:i',$body[0]['startTime']);
						$body[0]['endTime'] = date('H:i',$body[0]['endTime']);
					}
					$body = $this->sign->return_error_code($body,'json','outside');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'updateShopInfo':
					$post_data = $this->input->post(NULL,TRUE);
					$post_data["startTime"] = strtotime($post_data["startTime"]);
					$post_data["endTime"] = strtotime($post_data["endTime"]);
					$post_data["updateTime"] = time();
					$body = $this->store_model->update_shop_info($post_data);
					$body = $this->sign->return_error_code($body,'json','');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'getShopList':
					$status = $this->input->post('status',TRUE);
					$shop_list = $this->store_model->get_shop_list($sellerID,$status);
					$body = $this->sign->return_error_code($shop_list,'json','outside');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;
				case 'checkUsername':
					$username = $this->input->post('username',TRUE);
					$body = $this->store_model->check_shop_username($username);
					$body = $this->sign->return_error_code($body,'json','outside');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
					break;				
				default:
					# code...
					break;
			}
		}
		public function order(){
			$query = $this->input->get(NULL, TRUE);
			switch ($query['act']) {
				case 'seller_order_list':
					$sellerID = $this->session->userdata('sellerID');
					$post_data = $this->input->post(NULL,TRUE);
					$post_data["sellerID"] = $sellerID;
					$post_data["pageCount"] = 10;
					$post_data["startPage"] = ($post_data["startPage"]-1)*$post_data["pageCount"];
					$order_array = $this->store_model->get_order_list($post_data);
					$body = $this->sign->return_error_code($order_array,'json','outside');
					$this->output
					    ->set_content_type('application/json')
					    ->set_output($body);
				break;
				default:
				break;
			}
		}
	}
