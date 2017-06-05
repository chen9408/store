<?php
	function returnTable($post_data){
		$first = substr($post_data,0,1);
		switch ($first) {
	        case 'A':
	         return 'virtualGoodsInfo';
	          break;
	        case 'B':
	          return 'serviceGoodsInfo';
	          break;
	        case 'C':
	          return 'realGoodsInfo';
	          break;
	        case 'D':
	          return 'insuranceGoodsInfo';
	          break;
	        default:
	          return 'virtualGoodsInfo';
	          break;
      	}
	}
	class Store_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		/*
		*下单数
		*Param  sellerID
		*return $count
		*/
		public function placeOrder($sellerID){
			$this->db->where('sellerID', $sellerID);
			return $this->db->count_all_results('orderInfo');
		}
		/*
		*交易额
		*
		*/
		public function sumAmount($sid){
			$this->db->select('orderAmount');
			$this->db->where('sellerID',$sid);
			$this->db->where_in('orderStatus',array('2','6'))->select_sum('orderAmount');;
			$query=$this->db->get('orderInfo');
			$data_array=$query->result_array();
			return $data_array[0]["orderAmount"];
		}
		public function add_goods($table, $post_data){
			return $this->db->insert($table, $post_data);
		}
		public function get_goods_list($post_data){
			$table = returnTable($post_data["goodsType"]);
			$fields = 'goodsID,goodsName,marketPrice,shopPrice,goodsCount,goodsImg,goodsThumb,supportWecoin,sellerID,subtitle,goodsStatus';
			if($post_data["sellerID"]=="admin"){
				$this->db->where('goodsStatus', $post_data["goodsStatus"]);
			}else{
				$this->db->where('goodsStatus', $post_data["goodsStatus"])->where('sellerID', $post_data["sellerID"]);
			}
			$data_array["count"] =  $this->db->count_all_results($table);
			if($post_data["sellerID"]=="admin"){
				$this->db->where('goodsStatus', $post_data["goodsStatus"]);
			}else{
				$this->db->where('goodsStatus', $post_data["goodsStatus"])->where('sellerID', $post_data["sellerID"]);
			}
			$this->db->limit($post_data["pageCount"], $post_data["startPage"])->select($fields);
			$query = $this->db->get($table);
			$data_array["list"] = $query->result_array();
			return $data_array;
		}
		public function get_goods_sellerID($table,$sellerID){
			$this->db->where('sellerID', $sellerID); 
			$query = $this->db->get($table."GoodsInfo");
			return $query->result_array();
		}
		
		public function update_goods_status($post_data){
			$data = array("goodsStatus"=>$post_data["goodsStatus"]);
			$this->db->where('goodsID', $post_data["goodsID"]);
			$table = returnTable($post_data["goodsID"]);
			return $this->db->update($table, $data);
		}
		public function get_goods_goodsID($post_data){
			$this->db->where('goodsID', $post_data);
			$table = returnTable($post_data);
			$query = $this->db->get($table);
			$goodsInfo = $query->result_array();
			$shopID_array = explode(',',$goodsInfo[0]["shopID"]);
			$this->db->where('status',0)->where_in('shopID',$shopID_array)->select('shopID,shopName,sellerID,startTime,endTime,manager,telephone,address,latitude,longitude');
			$query = $this->db->get('shopInfo');
			$goodsInfo[0]["shopInfo"] = $query->result_array();
			return $goodsInfo[0];
		}
		public function get_goods_maxID($table){
			$this->db->select('goodsID')->order_by("id", "desc"); 
			$query = $this->db->get($table);
			$maxID = $query->result_array();
			if(!empty($maxID)){
				return $maxID[0]['goodsID'];
			}else{
				return 0;
			}
		}
		public function update_goods($post_data){
			$this->db->where('goodsID', $post_data["goodsID"]);
			$table = returnTable($post_data["goodsID"]);
			return $this->db->update($table, $post_data); 
		}
	
		public function check_login($post_data){
			$this->db->where('accountID',$post_data["accountID"])->select('accountID,status,sellerID,email,checkStatus');
			$row = $this->db->get('sellerInfo');
			$data = $row->result_array();
			if(!empty($data)){
				if($data[0]["status"] == 1){
					if($data[0]["sellerID"] == 0){
						return $data[0]["accountID"];
					}				
					return $data;
				}else{
					return '10007';
				}
			}else{
				return '10006';
			}
		}

		public function check_seller_email($email){
			$this->db->where(array('email'=>$email,'status'=>1))->select('email');
			$email = $this->db->get("sellerInfo");
			$status = $email->result_array();
			if(!empty($status)){
				return 1;
			}else{
				return 0;
			}
		}
		public function save_seller_baseInfo($post_data){
			$this->db->where(array('accountID'=>$post_data["accountID"]))->select('id');
			$email = $this->db->get("sellerInfo");
			$status = $email->result_array();
			if(empty($status)){
				return $this->db->insert('sellerInfo', $post_data); 
			}else{
				$this->db->where(array('email'=>$post_data["email"]));
				return $this->db->update('sellerInfo', $post_data); 
			}
		}
		public function seller_active_token($token){
			$now = time();
			$this->db->where('token',$token)->select('accountID,email,status,token,tokenExptime,checkStatus');
			$row = $this->db->get('sellerInfo');
			$data = $row->result_array();
			if(!empty($data)){
				if($now > $data[0]["tokenExptime"]){
					return '10004';
				}else if($data[0]["status"]==1 && $data[0]["checkStatus"]==0){
					return '10016';
				}else{
					$set = array('status'=>1);
					$this->db->where('accountID',$data[0]['accountID']);
					if($this->db->update('sellerInfo',$set)){
						return $data[0]["accountID"];
					}else{
						return '10000';
					}
				}
			}else{
				return '10005';
			}
		}
		public function save_seller_info($post_data){
			$accountID = $post_data["accountID"];
			unset($post_data["accountID"]);
			$this->db->where('accountID',$accountID)->select('status');
			$row = $this->db->get('sellerInfo');
			$data = $row->result_array();
			if(!empty($data)){
				if($data[0]["status"]){
					$post_data["updateTime"] = time();
					$this->db->where("accountID",$accountID);
					return $this->db->update('sellerInfo', $post_data);
				}else{
					return '10006';
				}
			}else{
				return '10005';
			}
		}
		public function update_seller_info($post_data){
			$sellerID = $post_data["s_id"];
			$post_data["checkStatus"] = 1;
			unset($post_data["s_id"]);
			unset($post_data["token"]);
			$this->db->where('sellerID',$sellerID);		
			return $this->db->update('sellerInfo', $post_data);
		}
		public function get_seller_maxID(){
			$this->db->select_max('sellerID');
			$query = $this->db->get('sellerInfo');
			$sellerID = $query->result_array();
			if(!empty($sellerID)){
				return $sellerID[0]['sellerID'];
			}else{
				return 0;
			}
		}
		public function get_sellerInfo($sellerID,$status){
			if(!empty($sellerID)){
				$this->db->where('sellerID', $sellerID);
			}else{
				if($status=="3"){
					$this->db->where('sellerID',0);
				}else{
					$this->db->where('checkStatus',$status)->where('sellerID !=',0);
				}
			}
			$query = $this->db->get('sellerInfo');
			return $query->result_array();
		}
		public function update_seller_status($post_data){
			$this->db->where('sellerID', $post_data['sellerID']);
			$data = array(
				"checkStatus" => $post_data['checkStatus'],
				"updateTime" => time(),
				"busingScope" => $post_data['busingScope']
			);
			if($this->db->update('sellerInfo', $data)){
				$this->db->where('sellerID', $post_data['sellerID'])->select('name,companyName,accountID,sellerName');
				$query = $this->db->get('sellerInfo');
				$companyName = $query->result_array();
				return $companyName[0];
			}
			return '10017';
		}
		public function save_businessID($accountID,$businessID){
			return $this->db->update('sellerInfo', $businessID, array('accountID' => $accountID));
		}
		public function get_businessID($sellerID){
			$this->db->where('sellerID', $sellerID)->select('businessID');
			$query = $this->db->get('sellerInfo');
			$businessID = $query->result_array();
			return $businessID[0];
		}
		public function save_shop_info($post_data){
			return $this->db->insert('shopInfo', $post_data);
		}
		public function get_max_shopID($sellerID){
			$this->db->where('sellerID', $sellerID)->order_by("id", "desc")->select('shopID');
			$query = $this->db->get('shopInfo');
			$maxID = $query->result_array();
			if(!empty($maxID)){
				return $maxID[0]['shopID'];
			}else{
				return 0;
			}
		}
		public function get_shop_list($sellerID,$status){
			if(!empty($status)){
				$this->db->where('status', $status);
			}
			$this->db->where('sellerID', $sellerID);
			$query = $this->db->get('shopInfo');
			return $query->result_array();
		}
		public function get_shop_info($shopID){
			$this->db->where('shopID', $shopID);
			$query = $this->db->get('shopInfo');
			return $query->result_array();
		}
		public function update_shop_info($post_data){
			$this->db->where('shopID', $post_data["shopID"]);
			unset($post_data["shopID"]);		
			return $this->db->update('shopInfo', $post_data); 
		}
		public function check_shop_username($username){
			$this->db->where('username', $username)->select('username');
			$query = $this->db->get('shopInfo');
			$data = $query->result_array();
			return $data;
		}
		public function check_shop_login($post_data){
			$this->db->where('username', $post_data["username"])->select('password,shopID');
			$query = $this->db->get('shopInfo');
			$data = $query->result_array();
			if(!empty($data)){
				if($data[0]["password"]==md5($post_data["password"])){
					return $data[0];
				}else{
					return '10024';
				}
			}else{
				return '10023';
			}
		}
		public function check_redeemCode($post_data){
			$this->db->where('cardNumber', $post_data["cardNumber"])->select('orderID,cardNumber,cardPassword,goodsName,codeStatus,loseEffectTime');
			$query = $this->db->get('redeemCode');
			$data = $query->result_array();
			if(!empty($data)){
				if($data[0]["codeStatus"] == "2"){
					return '10028';
				}
				if($data[0]["codeStatus"] == "3"){
					return '10029';
				}
				if($data[0]["loseEffectTime"] < time() || $data[0]["codeStatus"] == "4"){
					return '10027';
				}
				if($data[0]["cardPassword"] == $post_data["cardPassword"]){
					$codeStatus = array("codeStatus" => 2);
					$body = $this->db->update('redeemCode', $codeStatus, "cardNumber = ".$post_data["cardNumber"]);
					if($body){
						return $data[0];
					}else{
						return '10000';
					}
				}else{
					return '10026';
				}
			}else{
				return '10025';
			}
		}
		public function get_order_list($post_data){
			if($post_data["orderStatus"]!="0"){
				$this->db->where('orderStatus',$post_data["orderStatus"]);
			}
			$this->db->where('sellerID',$post_data["sellerID"]);
			$data_array["count"] =  $this->db->count_all_results('orderInfo');
			$fields = 'username,goodsName,buyCount,orderStatus,shopPrice,updateTime,createTime';
			if($post_data["orderStatus"]!="0"){
				$this->db->where('orderStatus',$post_data["orderStatus"]);
			}
			$this->db->where('sellerID',$post_data["sellerID"]);
			$this->db->limit($post_data["pageCount"], $post_data["startPage"])->order_by("id", "desc")->select($fields);
			$query = $this->db->get('orderInfo');
			$data_array["list"] = $query->result_array();			
			return $data_array;
		}
		public function create_insure_orderInfo($post_data){
			$adultInfo=explode('/',$post_data['adultInfo']);
			//print_r($post_data);
			$match='/([,]+)/';
			$rs = preg_match($match,$adultInfo['0']);
			if($rs){
				//echo "多个被保人";
				$adultName=explode(',',$adultInfo['0']);
				$adultCard=explode(',',$adultInfo['1']);
				$count=count($adultName);
				for($i=0;$i<$count;$i++){  
					$accident_array = array(
						'accountID'		=> $post_data['accountID'],
						'insurePeriod'	=> $post_data['insurePeriod'],
						'amount'		=> $post_data['amount'],
						'adultCount'	=> $post_data['adultCount'],
						'minorCount'    => $post_data['minorCount'],
						'premium'		=> $post_data['premium'],
						'insureName'  => $post_data['insureName'],
						'insureIDCard'  => $post_data['insureIDCard'],
						'insurePhone'   => $post_data['insurePhone'],
						'adultInfo'		=> $adultName[$i].",".$adultCard[$i],
						'orderID'		=> $post_data['orderID'],
						'createTime'	=> time(),
						'updateTime'    => time()
					);
					$status=$this->db->insert('accidentInsureInfo', $accident_array);
				}	
				return  $status;
			}else{
				$accident_array = array(
					'accountID'		=> $post_data['accountID'],
					'insurePeriod'	=> $post_data['insurePeriod'],
					'amount'		=> $post_data['amount'],
					'adultCount'	=> $post_data['adultCount'],
					'minorCount'    => $post_data['minorCount'],
					'premium'		=> $post_data['premium'],
					'insureName'	=> $post_data['insureName'],
					'insureIDCard'  => $post_data['insureIDCard'],
					'insurePhone'   => $post_data['insurePhone'],
					'adultInfo'		=> $adultInfo[0].",".$adultInfo[1],
					'orderID'		=> $post_data['orderID'],
					'createTime'	=> time(),
					'updateTime'    => time()
				);
				$status=$this->db->insert('accidentInsureInfo', $accident_array);
				return $status;
			}
		}
		public function update_insure_order($data){
			if(!empty($data['adultInfo'])){
				$this->db->where('adultInfo',$data['adultInfo']);
			}
			$this->db->where('orderID',$data['orderID']);
			$status=$this->db->update('accidentInsureInfo',$data);
			//echo $this->db->last_query();
			return $status;
		}
		public function getOrderInfo($orderID){
			$this->db->where('orderID',$orderID);
			$query=$this->db->select()->get('accidentInsureInfo');
			$orderInfo=$query->result_array();
			return $orderInfo;
		}
		
	}