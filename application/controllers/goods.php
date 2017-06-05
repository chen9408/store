<?php
  function create_goodsID($identify,$goodsID){
    list($usec) = explode(" ", microtime());
    $msec=substr($usec,2,3);
    if(empty($goodsID)){
      return $identify.'100000'.$msec;
    }else{
      $num = substr($goodsID, 1, -3)+1;
      return $identify.$num.$msec;
    }
  }
  function attributes(){
    return array('class' => 'uk-form uk-form-horizontal',"enctype" => "multipart/form-data");
  }
  function returnStatus($num,$checkStatus){
    if($checkStatus==$num){
      return 'selected';
    }
  }
  function unescape($str) {
    $ret = '';
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
      if ($str[$i] == '%' && $str[$i + 1] == 'u'){
        $val = hexdec(substr($str, $i + 2, 4));
        if($val < 0x7f){
          $ret.= chr($val);
        }else if($val < 0x800){
          $ret.= chr(0xc0 | ($val >> 6)).chr(0x80 | ($val & 0x3f));
        }else{
          $ret.= chr(0xe0 | ($val >> 12)).chr(0x80 | (($val >> 6) & 0x3f)).chr(0x80 | ($val & 0x3f));
        }
        $i += 5;
      }else{
        if($str[$i] == '%') {
          $ret.= urldecode(substr($str, $i, 3));
          $i += 2;
        }else{
          $ret.= $str[$i];
        }
      } 
    }
    return $ret;
  }
	class Goods extends CI_Controller{				
		public function __construct(){
  		parent::__construct();
  		$this->load->model('store_model');
  		$this->load->helper(array('url','form','captcha'));
      $goodsImg = $this->config->item('goodsImg');
      $this->load->library('upload',$goodsImg);
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
			$data = $this->input->get(NULL, TRUE);
      $sellerID = $this->session->userdata('sellerID');
      if(empty($sellerID))return ;
			switch ($data['act']) {
				case 'add':          
          $data= array('title'=>'新增','check_goods_img'=>'','check_goods_thumb'=>'','attributes'=>attributes());
					$this->parser->parse('templates/header', $data);
	  			$this->load->view('goods/add',$data);
	  			$this->load->view('templates/footer');
					break;
				case 'list':
					$data['title'] =  '列表';
          if($sellerID!="admin"){
            $view = 'goods/list';            
          }else{
            $view = 'admin/goodsList';
          }
          $this->parser->parse('templates/header', $data);
          $this->load->view($view);
          $this->load->view('templates/footer');			
					break;
        case 'details':
          if($sellerID!="admin"){
            $goods_details = $this->store_model->get_goods_goodsID($data["goodsID"]);
            $goods_details["startTime"] = date("Y-m-d", $goods_details["startTime"]);
            $goods_details["endTime"] = date("Y-m-d", $goods_details["endTime"]);
            $data= array('title'=>'修改商品','check_goods_img'=>'','check_goods_thumb'=>'','attributes'=>attributes());
            $data["goods_details"] = $goods_details;
            $this->parser->parse('templates/header', $data);
            $this->load->view('goods/update', $data);
            $this->load->view('templates/footer');
            return ;
          }
          $data['title'] =  '审核商品';
          $goods_details = $this->store_model->get_goods_goodsID($data["goodsID"]);
          $goods_details["startTime"] = date("Y-m-d H:i:s", $goods_details["startTime"]);
          $goods_details["endTime"] = date("Y-m-d H:i:s", $goods_details["endTime"]);
          $goods_details["supportWecoin"] = $goods_details["supportWecoin"]=="0"?'不支持':'支持';
          $goods_details["goodsStatus"] = '<select name="" id="goodsStatus" data='.$data["goodsID"].'>'.
          '<option value="1" '.returnStatus("1",$goods_details["goodsStatus"]).'>未审核</option>'.
          '<option value="0" '.returnStatus("0",$goods_details["goodsStatus"]).'>通过</option>'.
          '<option value="2" '.returnStatus("2",$goods_details["goodsStatus"]).'>不通过</option></select>';
          $data = $goods_details;
          $this->parser->parse('templates/header', $data);
          $this->parser->parse('admin/checkGoods', $data);
          $this->load->view('templates/footer');
          break;
				default:
					# code...
					break;
			}
	  }
    public function add(){
      $sellerID = $this->session->userdata('sellerID');
      if(empty($sellerID)){
        $data=array('title'=>'登录','error'=>'','attributes'=>attributes());
        $this->parser->parse('templates/header', $data);
        $this->parser->parse('login', $data);
        $this->load->view('templates/footer');
        return ;
      }
      $post_data = $this->input->post(NULL, TRUE);
      if(!$this->upload->do_upload("goodsImg")) {
        $check_goods_img = $this->upload->display_errors('<em>', '</em>');
        $data= array('title'=>'修改','check_goods_thumb'=>'&nbsp;','check_goods_img'=>$check_goods_img,'attributes'=>attributes());
        $data["goods_details"] = $post_data;
        $this->parser->parse('templates/header', $data);
        $this->load->view('goods/add', $data);
        $this->load->view('templates/footer');
        return ;
      }else{
        $file = $this->upload->data();
        $post_data['goodsImg']=base_url().'public/upload/goodsImg/'.$file['file_name'];
      }
      if(!empty($_FILES['goodsThumb']['name'])){
        if(!$this->upload->do_upload("goodsThumb")) {
          $check_goods_thumb = $this->upload->display_errors('<em>', '</em>');
          $data= array('title'=>'修改','check_goods_thumb'=>$check_goods_thumb,'check_goods_img'=>'&nbsp;','attributes'=>attributes());
          $data["goods_details"] = $post_data;
          $this->parser->parse('templates/header', $data);
          $this->load->view('goods/add', $data);
          $this->load->view('templates/footer');
          return ;
        }else{
          $file = $this->upload->data();
          $post_data['goodsThumb']=base_url().'public/upload/goodsImg/'.$file['file_name'];
        }
      }else{
        $post_data['goodsThumb']='';
      }
      if (!$this->form_validation->run('add_goods')){
        $data= array('title'=>'新增','check_goods_img'=>'','check_goods_thumb'=>'','attributes'=>attributes());
        $data["goods_details"] = $post_data;
        $this->parser->parse('templates/header', $data);
        $this->load->view('goods/add', $data);
        $this->load->view('templates/footer');
        return ;
      }   
      switch ($post_data['goodsType']) {
        case 'A':
          $table = 'virtualGoodsInfo';
          $identify = 'A';
          break;
        case 'B':
          $table = 'serviceGoodsInfo';          
          $identify = 'B';
          break;  
        case 'C':
          $table = 'realGoodsInfo';         
          $identify = 'C';
          break;
        case 'D':
          $table = 'insuranceGoodsInfo';
          $identify = 'D';
          break;
      }
      unset($post_data['goodsType']);
      unset($post_data['editorValue']);
      $seller_info = $this->store_model->get_sellerInfo($sellerID,'');
      $post_data['details'] = unescape($_POST['details']);
      $post_data['startTime'] = strtotime($post_data['startTime']);
      $post_data['endTime'] = strtotime($post_data['endTime']);
      $post_data['createTime'] = time();
      $post_data['goodsStatus'] = 1;
      $post_data['sellerID'] = $seller_info[0]['sellerID'];
      $post_data['busingScope'] = $seller_info[0]['busingScope'];
      $post_data['maxWecoin'] = isset($post_data['supportWecoin']) == 1 ? $post_data['shopPrice']:0;
      $max_goods_id = $this->store_model->get_goods_maxID($table);
      $post_data['goodsID'] = create_goodsID($identify,$max_goods_id);
      $body = $this->store_model->add_goods($table,$post_data);
      if($body){
        $data= array('title'=>'新增','success_title'=>'恭喜您，成功添加新商品!','error_title'=>'');
        $this->parser->parse('templates/header', $data);
        $this->load->view('state', $data);
        $this->load->view('templates/footer');
      }else{
        $data= array('title'=>'新增','error_title'=>'抱歉，出了点儿问题!','success_title'=>'');
        $this->parser->parse('templates/header', $data);
        $this->load->view('state', $data);
        $this->load->view('templates/footer');
      }
    }
    public function update(){      
      $sellerID = $this->session->userdata('sellerID');
      if(empty($sellerID)){
        $data=array('title'=>'登录','error'=>'','attributes'=>attributes());
        $this->parser->parse('templates/header', $data);
        $this->parser->parse('login', $data);
        $this->load->view('templates/footer');
        return ;
      }
      $post_data = $this->input->post(NULL, TRUE);

      if(!empty($_FILES['goodsThumb']['name'])){
        if(!$this->upload->do_upload("goodsThumb")) {
          $check_goods_thumb = $this->upload->display_errors('<em>', '</em>');
          $data= array('title'=>'修改','check_goods_thumb'=>$check_goods_thumb,'check_goods_img'=>'&nbsp;','attributes'=>attributes());
          $data["goods_details"] = $post_data;
          $this->parser->parse('templates/header', $data);
          $this->load->view('goods/update', $data);
          $this->load->view('templates/footer');
          return ;
        }else{
          $file = $this->upload->data();
          $post_data['goodsThumb']=base_url().'public/upload/goodsImg/'.$file['file_name'];
        }
      }else{
        unset($post_data['goodsThumb']);
      }
      if(!empty($_FILES['goodsImg']['name'])){
        if(!$this->upload->do_upload("goodsImg")) {
          $check_goods_img = $this->upload->display_errors('<em>', '</em>');
          $data= array('title'=>'修改','check_goods_thumb'=>'&nbsp;','check_goods_img'=>$check_goods_img,'attributes'=>attributes());
          $data["goods_details"] = $post_data;
          $this->parser->parse('templates/header', $data);
          $this->load->view('goods/update', $data);
          $this->load->view('templates/footer');
          return ;
        }else{
          $file = $this->upload->data();
          $post_data['goodsImg']=base_url().'public/upload/goodsImg/'.$file['file_name'];
        }
      }else{
        unset($post_data['goodsImg']);
      }
      
      if(!$this->form_validation->run('add_goods')){
        $data= array('title'=>'修改','check_goods_thumb'=>'&nbsp;','check_goods_img'=>'&nbsp;','attributes'=>attributes());
        $data["goods_details"] = $post_data;
        $this->parser->parse('templates/header', $data);
        $this->load->view('goods/update', $data);
        $this->load->view('templates/footer');
        return ;
      }
      unset($post_data['editorValue']);
      $post_data['details'] = unescape($_POST['details']);
      $post_data['startTime'] = strtotime($post_data['startTime']);      
      $post_data['endTime'] = strtotime($post_data['endTime']);
      $post_data['maxWecoin'] = $post_data['supportWecoin'] == 1 ? $post_data['shopPrice']:0;
      $post_data['goodsStatus'] = 1;
      $body = $this->store_model->update_goods($post_data);
      if($body){
        $data= array('title'=>'修改','success_title'=>'恭喜您，修改成功!','error_title'=>'');
        $this->parser->parse('templates/header', $data);
        $this->load->view('state', $data);
        $this->load->view('templates/footer');
      }else{
        $data= array('title'=>'修改','error_title'=>'抱歉，出了点儿问题!','success_title'=>'');
        $this->parser->parse('templates/header', $data);
        $this->load->view('state', $data);
        $this->load->view('templates/footer');
      }
    }
   public function getGoodsList(){
      $sellerID = $this->session->userdata('sellerID');
      if(empty($sellerID)){
        $body = $this->sign->return_error_code("10010",'json','inside');
        $this->output
            ->set_content_type('application/json')
            ->set_output($body);
        return ;
      }
      $post_data = $this->input->post(NULL, TRUE);
      $post_data["pageCount"] = 10;
      $post_data["startPage"] = $this->input->post("startPage")?(($post_data["startPage"]-1)*$post_data["pageCount"]):(0);
      $post_data["goodsType"] = $this->input->post("goodsType")?($post_data["goodsType"]):('B');
      $post_data["sellerID"] = $sellerID;
      $body = $this->store_model->get_goods_list($post_data);     
      $json = $this->sign->return_error_code($body,'json','outside');     
      $this->output
          ->set_content_type('application/json')
          ->set_output($json);  
    }    
	}