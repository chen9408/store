<?php
	class Seller extends CI_Controller{				
		public function __construct(){
			parent::__construct();
			$this->load->model('store_model');
			$this->load->helper(array('url','form','captcha'));
		  	$this->load->library(array('session','parser','form_validation','curl','sign'));
		  	$sellerID = $this->session->userdata('sellerID');		  		
  			if(!$sellerID){
  				$data['error_title'] = '登录超时，重新登录';
  				$data['success_title'] = '';
  				$this->parser->parse('templates/header', $data);
  				$this->load->view('state', $data);
  				$this->load->view('templates/footer');
  				return ;
  			}
		}
		public function index(){
			$act = $this->input->get(NULL, TRUE);
			switch ($act['act']) {
				case 'list':
					$data['title'] =  '用户列表';
					$this->parser->parse('templates/header', $data);
		  			$this->load->view('admin/checkSeller', $data);
		  			$this->load->view('templates/footer');
					break;
				default:
					# code...
					break;
			}
		}
		public function shop(){	
			$act = $this->input->get(NULL, TRUE);
			switch ($act['act']) {
				case 'list':
					$data['title'] =  '店铺列表';
					$sellerID = $this->session->userdata('sellerID');	
					$shop_list = $this->store_model->get_shop_list($sellerID,'');
					$data['shop_list'] = $shop_list;
					$this->parser->parse('templates/header', $data);
		  			$this->load->view('seller/shopList', $data);
		  			$this->load->view('templates/footer');
					break;
				case 'add':
					$data['title'] =  '新增店铺';
					$this->parser->parse('templates/header', $data);
		  			$this->load->view('seller/shopAdd', $data);
		  			$this->load->view('templates/footer');	
				default:
					# code...
					break;
			}
		}
	}