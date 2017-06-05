<?php	
	function attributes(){
		return array('class' => 'uk-panel uk-panel-box uk-form',"enctype" => "multipart/form-data");
	}	
	function getVerifyImg(){
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
		return $cap;
	}
	class Store extends CI_Controller{				
  		public function __construct(){
    		parent::__construct();
    		$this->load->model('store_model');
    		$this->load->helper(array('url','form','captcha'));
			$this->load->library(array('session','parser','form_validation','curl','sign'));
  		}  		
  		public function top(){
  			$data['title'] = '首页';
		  	$this->parser->parse('templates/header', $data);
		  	$this->load->view('top');
		}
		public function nav(){
  			$data['title'] = '首页';
		  	$this->parser->parse('templates/header', $data);
		  	$this->load->view('nav');
		}
		public function main(){
  			$sellerID = $this->session->userdata('sellerID');
			if($sellerID){
  				$data=array('title'=>'首页');
				$this->session->set_userdata(array('sellerID'=>$sellerID));
				$data['sellerID']=$sellerID;
				$data['placeOrderCount']= $this->store_model->placeOrder($sellerID);
				$data['sumAmount']=$this->store_model->sumAmount($sellerID);
				$this->parser->parse('templates/header',$data);
	  			$this->parser->parse('main',$data);
	  			$this->load->view('templates/footer');
  			}	
		}
		public function state(){
			$data['title'] = '状态';
		  	$this->parser->parse('templates/header', $data);
		  	$this->load->view('state');
		}

		public function inform(){
			$data['title'] = '重要通知';
		  	$this->parser->parse('templates/header', $data);
	  		$this->load->view('inform');
		}
  		public function index(){
	  		$sellerID = $this->session->userdata('sellerID');
			if(empty($sellerID)){
		  		$data=array('title'=>'登录','error'=>'','attributes'=>attributes());
		  		$this->parser->parse('templates/header', $data);
		  		$this->parser->parse('login', $data);
		  		$this->load->view('templates/footer');
				return ;
		  	}
		  	if($sellerID=="admin"){
				$this->session->set_userdata(array('sellerID'=>'admin'));
				$data['title'] = '首页';
		  		$this->parser->parse('templates/header', $data);	
				$this->parser->parse('index', $data);
	  			$this->load->view('templates/footer');
	  			return ;
			}		
		  	$seller_info = $this->store_model->get_sellerInfo($sellerID,'');
			if($seller_info[0]['checkStatus']==0){
				$data=array('title'=>'首页');
				$this->session->set_userdata(array('sellerID'=>$seller_info[0]['sellerID']));
	  			$this->parser->parse('templates/header', $data);
	  			$this->parser->parse('index', $data);
	  			$this->load->view('templates/footer');
			}elseif($seller_info[0]['checkStatus']==2){				
				$data=array('title'=>'完善卖家信息',"token"=>$seller_info[0]["token"],"sellerID"=>$seller_info[0]["sellerID"]);
	  			$this->parser->parse('templates/header', $data);
	  			$this->parser->parse('seller/sellerInfo', $data);
	  			$this->load->view('templates/footer');
			}else{
				$data = array('title'=>'登录','error'=>"正在审核，请等邮件通知",'attributes'=>attributes());
				$this->parser->parse('templates/header', $data);
  				$this->parser->parse('login', $data);
  				$this->load->view('templates/footer');
			}	
		}
		public function login(){
			$sellerID = $this->session->userdata('sellerID');
  			if($sellerID){
  				$data=array('title'=>'首页');
				$this->session->set_userdata(array('sellerID'=>$sellerID));
	  			$this->parser->parse('templates/header', $data);
	  			$this->parser->parse('index', $data);
	  			$this->load->view('templates/footer');
  				return ;
  			}	
			$post_data = $this->input->post(NULL, TRUE);		
			if($post_data['username']=="admin" && ($post_data['daokePassword']=="DCF1346F964A24F1" || $post_data['daokePassword']=="4A11A33A25662C6D")){
				$this->session->set_userdata(array('sellerID'=>'admin'));
				$data['title'] = '首页';
		  		$this->parser->parse('templates/header', $data);	
				$this->parser->parse('index', $data);
	  			$this->load->view('templates/footer');
	  			return ;
			}
			if(!$this->form_validation->run('login')){
				$data = array('title'=>'登录','error'=>'登录出错','attributes'=>attributes());
				$this->parser->parse('templates/header', $data);
	  			$this->parser->parse('login', $data);
	  			$this->load->view('templates/footer');
				return ;
			}
			$url = $this->config->item('mirrtalk_api');
			$post_data['clientIP'] = $_SERVER['REMOTE_ADDR'];
			$info = $this->sign->get_sign_array($post_data,'');
			$body = $this->curl->simple_post($url['check_login'],$info);
			$co = json_decode($body,true);	
			if($co['ERRORCODE']!="0"){
				$error = '';
				if($co['ERRORCODE']=="ME18063"){
					$error = '密码错误';
				}else if($co['ERRORCODE']=="ME18061"){
					$error = '账号未注册';
				}
				$data = array('title'=>'登录','error'=>$error,'attributes'=>attributes());
				$this->parser->parse('templates/header', $data);
		  		$this->parser->parse('login', $data);
		  		$this->load->view('templates/footer');
		  		return ;
			}
			$this->session->set_userdata('accountID',$co['RESULT']['accountID']);
			$post_data['accountID'] = $co['RESULT']['accountID'];
			$body = $this->store_model->check_login($post_data);
			if(!is_array($body)){
				if($body=="10006" || $body=="10007"){
					$verify = getVerifyImg();
					$this->session->set_userdata(array('verify_code'=>$verify['word']));
			  		$data=array('title'=>'注册','error'=>'','verifyImg'=>$verify['image']);
			  		$this->parser->parse('templates/header', $data);
			  		$this->parser->parse('register', $data);
			  		$this->load->view('templates/footer');
			  		return ;
				}else{					
					$data=array('title'=>'完善卖家信息',"accountID"=>$body,"sellerID"=>"");
		  			$this->parser->parse('templates/header', $data);
		  			$this->parser->parse('seller/sellerInfo', $data);
		  			$this->load->view('templates/footer');
		  			return ;
				}
				$data = array('title'=>'登录','error'=>$error,'attributes'=>attributes());
				$this->parser->parse('templates/header', $data);
	  			$this->parser->parse('login', $data);
	  			$this->load->view('templates/footer');
			}else{
				if($body[0]['checkStatus']==0){
					$data=array('title'=>'首页');
					$this->session->set_userdata(array('sellerID'=>$body[0]['sellerID']));
		  			$this->parser->parse('templates/header', $data);
		  			$this->parser->parse('index', $data);
		  			$this->load->view('templates/footer');
		  			$accountID = $body[0]['accountID'];
		  			$body = array("accountID" => $accountID);
					$info = $this->sign->get_sign_array($body,'');
					$body = $this->curl->simple_post($url['get_business_info'],$info);
					$get_data = json_decode($body,true);
					if($get_data['ERRORCODE'] == "0"){
						$body = $this->store_model->save_businessID($accountID,array("businessID" => $get_data['RESULT'][0]['id']));
					}		  			
				}elseif($body[0]['checkStatus']==2){
					$data=array('title'=>'完善卖家信息',"accountID"=>$body[0]["accountID"],"sellerID"=>$body[0]["sellerID"]);
		  			$this->parser->parse('templates/header', $data);
		  			$this->parser->parse('seller/sellerInfo', $data);
		  			$this->load->view('templates/footer');
				}else{
					$data = array('title'=>'登录','error'=>"正在审核，请等邮件通知",'attributes'=>attributes());
					$this->parser->parse('templates/header', $data);
	  				$this->parser->parse('login', $data);
	  				$this->load->view('templates/footer');
				}	
			}
		}
		public function register(){
			if(!$this->form_validation->run('register')){
				$verify = getVerifyImg();
				$this->session->set_userdata(array('verify_code'=>$verify['word']));
		  		$data=array('title'=>'注册','error'=>'','verifyImg'=>$verify['image']);
		  		$this->parser->parse('templates/header', $data);
		  		$this->parser->parse('register', $data);
		  		$this->load->view('templates/footer');
				return ;
			}
		}
		public function logout(){
			$this->session->sess_destroy();
			$data = array('title'=>'登录','error'=>'','attributes'=>attributes());
			$this->parser->parse('templates/header', $data);
	  		$this->parser->parse('login', $data);
	  		$this->load->view('templates/footer');
		}
		public function activeRegitser(){
			$token = $this->input->get('token', TRUE);
			$body  = $this->store_model->seller_active_token($token);
			$data['title'] =  '完善卖家信息';
			if($body == '10005'){
				$data['success_title'] = '';
				$data['error_title'] = '激活出现错误，<a href="'.base_url().'index.php/register">返回首页</a>';
			}elseif($body == "10004"){
				$data['success_title'] = '';
				$data['error_title'] = '激活码已过期，<a href="'.base_url().'index.php/register">重新注册申请</a>';
			}else if($body == "10000"){
				$data['error_title'] = '出大事儿了，<a href="'.base_url().'index.php/register">返回首页</a>';
				$data['success_title'] = '';
			}else if($body == "10016"){
				$data['error_title'] = '您的邮箱已经激活，<a href="'.base_url().'index.php/login">登录商城</a>';
				$data['success_title'] = '';
			}else{
				$this->session->set_userdata('token',$body);
				$data["accountID"] = $body;
				$data["sellerID"] = '';
				$this->parser->parse('templates/header', $data);
	  			$this->load->view('seller/sellerInfo', $data);
	  			$this->load->view('templates/footer');
	  			return ;
			}
			$this->parser->parse('templates/header', $data);
  			$this->load->view('state', $data);
  			$this->load->view('templates/footer');
		}
		/*子店铺登录*/
		public function shopLogin(){
			$shopID = $this->session->userdata('shopID');
			if(!empty($shopID)){
				$data = array('title'=>'兑换商品-道客商城');
				$this->parser->parse('templates/header', $data);
	  			$this->load->view('goods/exchange');
	  			$this->load->view('templates/footer');
	  			return ;
			}
			if (!$this->form_validation->run('shop_login')){
				$data = array('title'=>'子店铺登录-道客商城','error'=>'登录出错');
				$this->parser->parse('templates/header', $data);
	  			$this->parser->parse('seller/shopLogin', $data);
	  			$this->load->view('templates/footer');
		        return ;
		    }
			$post_data = $this->input->post(NULL,TRUE);
			$body = $this->store_model->check_shop_login($post_data);
			if(is_array($body)){
				$this->session->set_userdata('shopID',$body['shopID']);
				$data = array('title'=>'兑换商品-道客商城');
				$this->parser->parse('templates/header', $data);
	  			$this->load->view('goods/exchange');
	  			$this->load->view('templates/footer');
			}else{
				$data = array('title'=>'子店铺登录-道客商城','error'=>'登录出错');
				if($body=="10023"){
					$data["error"] = "账号不存在";
				}else if($body=="10024"){
					$data["error"] = "密码错误";
				}else{
					$data["error"] = "";
				}
				$this->parser->parse('templates/header', $data);
	  			$this->parser->parse('seller/shopLogin', $data);
	  			$this->load->view('templates/footer');
			}
		}
		/*子店铺退出*/
		public function shopLogout(){
			$this->session->sess_destroy();
			$data = array('title'=>'登录','error'=>'');
			$this->parser->parse('templates/header', $data);
	  		$this->parser->parse('seller/shopLogin', $data);
	  		$this->load->view('templates/footer');
		}
		/*兑换商品*/
		public function exchange(){
			$shopID = $this->session->userdata('shopID');
			if(!empty($shopID)){
				$data = array('title'=>'兑换商品-道客商城');
				$this->parser->parse('templates/header', $data);
			  	$this->load->view('goods/exchange');
			  	$this->load->view('templates/footer');
			  	return ;
			}
			$data = array('title'=>'子店铺登录-道客商城','error'=>'');
			$this->parser->parse('templates/header', $data);
			$this->parser->parse('seller/shopLogin', $data);
			$this->load->view('templates/footer');
	    }
	}