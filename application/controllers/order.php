<?php 
	class Order extends CI_Controller{				
		public function __construct(){
			parent::__construct();
			$this->load->model('store_model');
			$this->load->helper(array('url','form','captcha'));
			$this->load->library(array('session','parser','form_validation','curl','sign'));
			$sellerID = $this->session->userdata('sellerID');
			if(!$sellerID){
				$data['error_title'] = '登录超时，请重新登录';
				$data['success_title'] = '';
				$this->parser->parse('templates/header', $data);
				$this->load->view('state', $data);
				$this->load->view('templates/footer');
				return ;
			}
		}
		public function index(){
			$query = $this->input->get(NULL, TRUE);
			switch ($query['act']) {
				case 'list':
					$data['title'] =  '订单列表';
					$this->parser->parse('templates/header', $data);
					$this->load->view('order/orderList');
					$this->load->view('templates/footer');	
				break;
				default:
				break;
			}
	  	}	  	
	}
?>