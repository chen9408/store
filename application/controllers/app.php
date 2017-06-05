<?php 
	class App extends CI_Controller{				
		public function __construct(){
			parent::__construct();
			$this->load->model('store_model');
			$this->load->helper(array('url','form','captcha'));
			$this->load->library(array('session','parser','form_validation','curl','sign'));
			$sellerID = $this->session->userdata('sellerID');
		}
		public function demo(){
			$this->load->view('app/demo');
	  	}
		public function index(){
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/index',$get);
		}
	  	public function location(){
			$this->load->view('app/location');
	  	}
		public function sergoodslist(){ 
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/sergoodslist',$get);
	  	}
		public function goodsInfo(){
			$get['goodsID']=$this->input->get('goodsID');
			$this->load->view('app/goodsInfo',$get);
	  	}
		public function storeInfo(){
			$get['shopID']=$this->input->get('shopID');
			$this->load->view('app/storeInfo',$get);
	  	}
	  	public function payment(){
			$get=$this->input->get(NULL,TRUE);
			$get["orderID"] = $this->input->get("orderID",TRUE)?($get["orderID"]):('0');
			$get["goodsID"] = $this->input->get("goodsID")?($get["goodsID"]):('0');
			$this->load->view('app/payment',$get);
	  	}
		public function getOrderList(){
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/getOrderList',$get);
	  	}
	  	public function getOrderDetail(){
			$get['orderID']=$this->input->get('orderID');
			$this->load->view('app/getOrderDetail',$get);
	  	}
	  	public function applyShop(){
			$get['goodsID']=$this->input->get('goodsID');
			$this->load->view('app/applyShop',$get);
	  	}
	  	public function goodsComment(){
			$get['goodsID']=$this->input->get('goodsID');
			$this->load->view('app/goodsComment',$get);
	  	}
	  	
	  	public function addcomment(){
			$get['orderID']=$this->input->get('orderID');
			$this->load->view('app/addcomment',$get);
	  	}
		public function submitPayment(){
			$get['orderID']=$this->input->get('orderID');
			$this->load->view('app/submitPayment',$get);
		}
		public function withdraw(){
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/withdraw',$get);
		}
		/* 手机充值 */
		public function phoneFee(){
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/phoneFee',$get);
		}
		/* 捐献 */
		public function donation(){
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/donation',$get);
		}
		/* 保险 */
		public function insurance(){
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/insurance',$get);
		}
		public function confirmWithdraw(){
			$get['goodsID']=$this->input->get('goodsID');
			$this->load->view('app/confirmWithdraw',$get);
		}
		/* 账单 */
		public function bill(){
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/bill',$get);
		}
		/* 余额 */
		public function balance(){
			$get['accountID']=$this->input->get('accountID');
			$this->load->view('app/balance',$get);
		}
		public function weixinWithdraw(){
			$get['goodsID']=$this->input->get('goodsID');
			$this->load->view('app/weixinWithdraw',$get);
		}
		/* 大转盘抽奖 */
		public function lottery(){
			$get['accountID'] =$this->input->get('accountID');
			$this->load->view('app/lottery',$get);
		}
	}
?>