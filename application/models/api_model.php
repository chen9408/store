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

	class Api_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		//API to out
		public function getGoodsSubType($type){
			$fields='catID,name';
			$query=$this->db->where('type',$type)->select($fields)->get('category');
			return $data=$query->result_array();
		}
		public function ser_goods_list($post_data){
			$fields = 'goodsID,goodsName,marketPrice,shopPrice,goodsCount,soldCount,busingScope,goodsImg,goodsThumb,supportWecoin,subtitle,goodsSubType,shopID';
			$where_array= array(
				'goodsStatus !=' => 1  ,
				'startTime <' 	 => time(),
				'endTime >'      => time()
				);
			if($post_data["cityCode"]!="0"){
				$this->db->where('busingScope', $post_data["cityCode"]);
			}
			if($post_data["goodsSubType"]!="0"){
				$this->db->where('goodsSubType', $post_data["goodsSubType"]);
			}
			if($post_data['shopID']!="0"){
				$this->db->like('shopID', $post_data['shopID']); 
			}			
			if($post_data['sortType']!=0){
				if($post_data['sortType']=="1"){
					$this->db->order_by('shopPrice','asc');
				}
				if($post_data['sortType']=="2"){
					$this->db->order_by('shopPrice','desc');
				}
				if($post_data['sortType']=="3"){
					$this->db->order_by('soldCount','asc');
				}
				if($post_data['sortType']=="4"){
					$this->db->order_by('soldCount','desc');
				}
			}			
			$this->db->where($where_array);
			$this->db->limit($post_data["pageCount"], $post_data["startPage"])->select($fields);
			$query = $this->db->get('serviceGoodsInfo');
			$data = $query->result_array();
			if(empty($data)){return '';}
			$count=count($data);
			for ($i=0; $i < $count; $i++) { 
				$shopID_array=explode(',', $data[$i]['shopID']);
				$shopID_count=count($shopID_array);
				for($j=0;$j< $shopID_count;$j++){
					$shop=$this->db->where('status',0)->where('shopID',$shopID_array[$j])->select('shopID,shopName,latitude,longitude')->get('shopInfo');
					$data[$i]['shop']=$shop->row_array();
					if($data[$i]['shop']){
						break ;
					}
				}
				if(!$data[$i]['shop']){
					unset($data[$i]);
				}else{
					$post_data=array(
						'goodsID' => $data[$i]['goodsID'],
						'shopID'  => '0'
					);
					$data[$i]['comment']=$this->countcomType($post_data);
					$data[$i]['commentSum']= $data[$i]['comment']['sum'];
					unset($data[$i]['comment']);
				}
			}
			return $data;
		}
		public function sergoodsinfo($post_data){			
			$fields = 'goodsID,goodsName,subtitle,goodsCount,marketPrice,shopPrice,goodsThumb,goodsImg,maxWecoin,supportWecoin,brief,details,shopID,userRank,goodsSubType,soldCount';	
			$this->db->where('goodsID', $post_data)->select($fields);
			$query = $this->db->get('serviceGoodsInfo');
			$goodsInfo = $query->row_array();
			if(empty($goodsInfo)){return '';}
			$goods_data=array(
						'goodsID' => $post_data,
						'shopID'  => '0'
					);

			$goodsInfo['comment']=$this->countcomType($goods_data);
			$goodsInfo['commentSum']= $goodsInfo['comment']['sum'];
			unset($goodsInfo['comment']);
			$shopID_array=explode(',', $goodsInfo['shopID']);
			$shopID_count=count($shopID_array);
			$shopID = substr($goodsInfo["shopID"], 8);

			$this->db->like('shopID', $shopID);
			$query = $this->db->distinct('orderID')->select('orderID')->get('comment');
			$shopInfo['commentSum'] =$query->num_rows();

			$goodsInfo['shopcount']=count($shopID_array);
			unset($goodsInfo["shopID"]);
			$shop=$this->db->where('status',0)->where('shopID',$shopID_array[0])->select('shopID,shopName,latitude,longitude,telephone,address')->get('shopInfo');
			$goodsInfo['shop']=$shop->row_array();
			$goodsInfo['shop']['shopsImg']=base_url().'public/upload/shopsImg/shop.jpg';//base_url().'public/upload/shopsImg/shop.jpg
			$this->db->like('shopID', $shopID_array[0]);
			$query = $this->db->distinct('orderID')->select('orderID')->get('comment');
			$goodsInfo['shop']['commentSum'] =$query->num_rows();
			return $goodsInfo;
		}
		public function applyShop($goodsID){
			$query=$this->db->select('shopID')->where('goodsID',$goodsID)->get('serviceGoodsInfo');
			$data=$query->row_array();
			$shopID_array = explode(',',$data["shopID"]);
			unset($data["shopID"]);
			$this->db->where('status',0)->where_in('shopID',$shopID_array)->select('shopID,shopName,address,manager,telephone,latitude,longitude');
			$query = $this->db->get('shopInfo');
			return  $shopInfo= $query->result_array();
		}
		public function virtual_goods_list($post_data){
			$table=returnTable($post_data['goodsType']);
			$fields = 'goodsID,goodsName,marketPrice,shopPrice,goodsCount,sellerID,startTime,endTime,goodsSubType';
			$query=$this->db->where('goodsSubType',$post_data['goodsSubType'])->select($fields)->get($table);
			$goodsList=$query->result_array();
			if(empty($goodsList)){return '';}
			return $goodsList;
		}
		public function virgoodsinfo($goodsID){
			$table = returnTable($goodsID);
			$fields ='goodsID,goodsName,goodsCount,goodsSubType,shopPrice';
			$data=$this->db->where('goodsID',$goodsID)->select($fields)->get($table)->row_array();
			return $data;
		}
		public function update_goods_clickCount($post_data){
			$this->db->set('clickCount', 'clickCount+1', FALSE)->where('goodsID', $post_data);
			$table = returnTable($post_data);
			$query = $this->db->update($table);
			return $query;
		}
		public function get_goods_info($goodsID){
			$table = returnTable($goodsID);
			$fields = 'goodsID,goodsName,marketPrice,goodsSubType,shopPrice,maxWecoin,goodsCount,goodsImg,supportWecoin,brief,sellerID,shopID,userRank,startTime,endTime,getAging,goodsSubType';
			if($table == 'virtualGoodsInfo' || $table == 'insuranceGoodsInfo'){
				$fields = 'goodsID,goodsName,goodsSubType,goodsCount,goodsImg,marketPrice,shopPrice,sellerID,startTime,endTime,goodsSubType';
			}
			$this->db->where('goodsID',$goodsID)->select($fields);
			$query = $this->db->get($table);
			$data = $query->row_array();
			if(empty($data)){return '';}
			return $data;
		}
		public function save_confirm_order($order_info){
			$this->db->trans_start();
			$this->db->set('goodsCount', 'goodsCount-'.$order_info["buyCount"], FALSE)->where('goodsID', $order_info["goodsID"]);
			$table = returnTable($order_info["goodsID"]);
			$query = $this->db->update($table);
			$this->db->insert('orderInfo', $order_info);
			$this->db->trans_complete();
			return $this->db->trans_status();
		} 
		public function get_order_list($post_data){
			$field = 'orderID,goodsID,goodsName,buyCount,goodsSubType,marketPrice,shopPrice,goodsImg,sellerID,orderStatus,accountID,createTime,moneyPaid,mecoin,wecoin,orderAmount,comment,goodsSubType';
			$goodsSubType = array('18', '19', '20');
			$this->db->where_in('goodsSubType', $goodsSubType);
			if($post_data["orderType"] != 0){
				$this->db->where('orderStatus', $post_data["orderType"])->where('accountID',$post_data["accountID"]);
			}else{
				$where_array=array(
					'accountID'		=>$post_data["accountID"],
					'orderStatus !='=>3
				);
				$this->db->where($where_array);
			}
			if($post_data['orderType']==6){
				$this->db->where('comment',0);
			}
			$this->db->limit($post_data["pageCount"], $post_data["startPage"])->select($field)->order_by("createTime", "desc");
			$query = $this->db->get('orderInfo');
			$data = $query->result_array();
			//print_r($data);
			/*
			for($i=0;$i<count($data);$i++){
				echo $str=substr($data[$i]['orderID'],0,1);
				if($str=='B'){
					unset($data[$i]);
				}
			}
			*/
			if(empty($data)){
				return "";
			}
			return $data;
		}
		public function get_order_detail($orderID){
			$field='orderID,goodsID,goodsName,goodsUrl,buyCount,marketPrice,shopPrice,goodsSubType,goodsImg,brief,shopID,sellerID,startTime,endTime,supportWecoin,orderStatus,'.
			'accountID,username,phone,userRank,withdrawAccount,orderAmount,moneyPaid,mecoin,wecoin,maxWecoin,costPrice,meTicket,updateTime,createTime,remark,comment';
			$this->db->where('orderID',$orderID)->select($field);
			$query = $this->db->get('orderInfo');
			$data = $query->row_array();
			if(empty($data)){ return  '';}
			$table = returnTable($orderID);

			$data['goodsCount']=$this->db->where('goodsID',$data['goodsID'])->select('goodsCount')->get($table)->row_array()['goodsCount'];
			//echo $this->db->last_query();
			/*
			if($data["shopID"]){
				$shopID=substr($data['shopID'],0,9);
					$this->db->where('status',0)->where('shopID',$shopID)->select('shopID,shopName,sellerID,startTime,endTime,manager,telephone,address,latitude,longitude');
				$query = $this->db->get('shopInfo');
				$data["shopInfo"] = $query->row_array();	
				unset($data['shopID']);
			}
			*/
			
			if($data['orderStatus']!='1'&&$data['orderStatus']!='3'){
				$this->db->where('orderID',$orderID)->select('cardNumber,cardPassword,effectTime,loseEffectTime,codeStatus,createTime');
				$query = $this->db->get('redeemCode');
				$data["redeemCode"] = $query->result_array();
			}else{
				$data["redeemCode"] = "";
			}
			return $data;
		}
		public function get_business_id($orderID){
			$this->db->where('orderID',$orderID)->select('sellerID');
			$query = $this->db->get('orderInfo');
			$data = $query->row_array();
			if(!empty($data)){
				$this->db->where('sellerID',$data["sellerID"])->select('accountID');
				$query = $this->db->get('sellerInfo');
				$data = $query->row_array();
				if(empty($data)){return '';}
				return $data['accountID'];
			}
			return '';
		}
		public function update_order_info($post_data){
			$this->db->where('orderID',$post_data['orderID']);
			return $this->db->update('orderInfo', $post_data); 
		}
		public function update_code_status($code_array){
			$this->db->where('orderID',$code_array['orderID']);
			return $this->db->update('redeemCode',$code_array);
		}
		public function update_wxRedPack_info($post_data){
			$this->db->where('outsideID',$post_data['outsideID']);
			return $this->db->update('refundStatus', $post_data); 
		}
		public function careate_redeemCode($post_data){
			return $this->db->insert_batch('redeemCode', $post_data); 
		}
		public function update_redeemCode_status($orderID){
			$this->db->where('orderID',$orderID);
			return $this->db->update('redeemCode', array("codeStatus" => 3)); 
		}
		public function update_goods_count($goodsID,$type){
			$this->db->set('goodsCount', $type, FALSE)->where('goodsID', $goodsID);
			$table = returnTable($goodsID);
			$query = $this->db->update($table);
			return $query;
		}
		public function update_goods_soldCount($goodsID,$type){
			$this->db->set('soldCount', $type, FALSE)->where('goodsID', $goodsID);
			$table = returnTable($goodsID);
			$query = $this->db->update($table);
			return $query;
		}
		public function get_prepay_order(){
			$where_array = array(
				"createTime <="	=> time(),
				//"createTime >="	=> strtotime('-1day'),
				"orderStatus"	=> 2,
				"remark"		=> "话费充值",
				"outsideID ="	=> 0
			);
			$this->db->where($where_array)->select('orderID,marketPrice,withdrawAccount,orderAmount,costPrice,accountID');//
			$query = $this->db->order_by('createTime','asc')->limit(50)->get('orderInfo');
			$data = $query->result_array();
			return $data;
		}
		public function get_submit_order(){
			$where_array = array(
				"createTime <="	=> time(),
				//"createTime >="	=> strtotime('-1day'),
				"orderStatus"	=> 2,
				"remark"		=> "话费充值",
				"outsideID !="	=> 0
			);
			$this->db->where($where_array)->select('orderID,marketPrice,withdrawAccount,orderAmount,costPrice,accountID');
			$query = $this->db->get('orderInfo');
			$data = $query->result_array();
			return $data;
		}
		public function phoneFeeOrder($orderID){
			$filds='orderID,marketPrice,withdrawAccount,orderAmount,accountID';
			$orderInfo=$this->db->where('orderID',$orderID)->select($filds)->get('orderInfo')->row_array();
			return $orderInfo;
		} 
		public function get_phoneFee_refund(){
			$where_array = array(
				"createTime <="	=> time(),
				//"createTime >="	=> strtotime('-1day'),
				"orderStatus"	=> 4,
				"remark"	=> "话费充值",
				"outsideID !="	=> 0
			);
			$this->db->where($where_array)->select('goodsID,orderID,marketPrice,orderAmount,withdrawAccount,costPrice,accountID,outsideID');
			$query = $this->db->get('orderInfo');
			$data = $query->result_array();
			//echo $this->db->last_query();
			return $data;
		}
		/*获取微信充值失败的用户信息*/
		public function get_wxRedPack_refund(){
			$where_array=array(
				"createTime <="	=> time(),
				//"createTime >="	=> strtotime('-1day'),
				'orderStatus' => 4,
				'remark'	  =>'微信钱包'
				);
			$this->db->where($where_array)->select('orderID,goodsID,accountID,orderAmount,withdrawAccount');
			$query=$this->db->get('orderInfo');
			$info=$query->result_array();
			return $info;
			/*$where_array = array(
				"payType"	=> "1",
				"refundStatus"	=>"0"
			);
			$this->db->where($where_array)->select('outsideID');
			$query = $this->db->get('wxredpack');
			$data = $query->result_array();
			if(empty($data)){
				return $data;
			}
			$count=count($data);
			for($i=0;$i<$count;$i++){
				$outIDs[$i]=$data[$i]['outsideID'];
			}
			$fields='outsideID,orderAmount,accountID,orderID,goodsID';
			$this->db->where_in('outsideID', $outIDs)->select($fields);
			$query=$this->db->get('orderInfo');
			$info=$query->result_array();
			return $info;*/
		}
		public function get_withdrawWXW_info($data){
			$codeInfo=$this->db->where('cardNumber',$data['code'])->select('orderID,codeStatus')->get('redeemCode')->row_array();
			if(empty($codeInfo)){
				return '10050';
			}else if($codeInfo['codeStatus']!=0){
				if($codeInfo['codeStatus']==2){
					return  '10053';			//已使用
				}else if($codeInfo['codeStatus']==3){
					return '10054';				//
				}else if($codeInfo['codeStatus']==4){
					return '10055';				//兑换码失效
				}
			}else{
				$where_array=array(
					'orderID' => $codeInfo['orderID']	
				);
				$status = $this->db->where('orderID',$codeInfo['orderID'])->update('orderInfo',array('withdrawAccount'=>$data['withdrawAccount']));
				if($status){
					$filds='orderID,goodsID,orderAmount,withdrawAccount,costPrice,accountID';
					$info=$this->db->where($where_array)->select($filds)->get('orderInfo')->row_array();
					return $info;
				}else{
					return '10000';
				}
			}
		}
		public function get_withdrawWXW_list(){
			$where_array = array(
				"orderStatus"	=> 2,
				"remark"		=> "微信钱包",
				"outsideID"		=> 0
			);
			$this->db->where($where_array)->select('orderID,goodsID,orderAmount,withdrawAccount,costPrice,accountID');
			$query = $this->db->get('orderInfo');
			$data = $query->result_array();
			return $data;
		}
		public function insert_huafeiduo_order($post_data){
			return $this->db->insert('huafeiduoOrderInfo', $post_data); 
		}
		public function get_user_refund(){
			$where_array = array(
				"codeStatus"	=> 0,
				"loseEffectTime <="=> time()
			);
			$this->db->where($where_array);
			$this->db->distinct("orderID")->select("orderID");
			$query = $this->db->get('redeemCode');
			$data = $query->result_array();
			if(empty($data)){ return ""; }
			$count=count($data);
			for($i=0;$i<$count;$i++){
				$status=$this->db->where('orderID',$data[$i]['orderID'])->select('orderStatus')->get('orderinfo')->row_array();
				if($status['orderStatus']==2){
					$orderIDs[$i]['orderID']=$data[$i]['orderID'];
				}
			}
			return $orderIDs;
		}
		/*
		*获取购买保险失败的用户信息
		*
		*/
		public function get_insurance_refund(){
			$filds='accidentinsureinfo.insureID,accidentinsureinfo.orderID,accidentinsureinfo.accountID,accidentinsureinfo.adultInfo,accidentinsureinfo.adultCount,orderInfo.orderAmount,orderInfo.goodsSubType';
			$where_array = array(
				'accidentinsureinfo.createTime <'	=> time(),
				'accidentinsureinfo.status'			=> '3',
				'accidentinsureinfo.insureID'		=> '0'
			);
			$this->db->where($where_array);
			$query=$this->db->select($filds)->join('orderInfo', 'orderInfo.orderID = accidentinsureinfo.orderID')->get('accidentinsureinfo',5);
			$data=$query->result_array();
			//echo $this->db->last_query();
			$count=count($data);
			if(empty($count)){
				return ;
			}
			for($i=0;$i<$count;$i++){
				$insuranceList[$i]=array(
					'insureID'	=> $data[$i]['insureID'],
					'orderID'	=> $data[$i]['orderID'],
					'MEPoints'	=> $data[$i]['orderAmount']/$data[$i]['adultCount'],
					'accountID' => $data[$i]['accountID'],
					'goodsSubType'=> $data[$i]['goodsSubType'],
					'adultInfo' => $data[$i]['adultInfo']
				);
			}
			return $insuranceList;
		}
		public function update_insure_status($data){
			$where_array=array(
				'orderID'   => $data['orderID'],
				'adultInfo' => $data['adultInfo']
			);
			$this->db->where($where_array);
			$status=$this->db->update('accidentinsureinfo',$data);
			return $status;
		}
		/*
		*店铺信息
		*param $shopID
		*
		*/
		public function get_shop_info($shopID){
			$this->db->like('shopID', $shopID);
			$query = $this->db->distinct('orderID')->select('orderID')->get('comment');
			$shopInfo['comment'] =$query->num_rows();
			$this->db->where('shopID',$shopID)->select();
			$query = $this->db->get('shopInfo');
			$shopInfo['info']=$query->row_array();
			$shopInfo['info']['shopsImg']=base_url()."public/upload/shopsImg/shop.jpg";
			if(!$shopInfo){
				return "";
			}
			return $shopInfo;

		}
		/*
		*获取用户所评价的订单信息
		*param $orderID
		*2015/5/25
		*/
		public function comment_order_info($orderID){
			$files='shopID,goodsID,goodsName,phone';
			$query=$this->db->where('orderID',$orderID)->select($files)->get('orderinfo');
			$data = $query->row_array();
			if($data['shopID']){
				$shopID=substr($data['shopID'],0,9);
				$shopName=$this->db->where('shopID',$shopID)->select('shopName')->get('shopInfo')->row_array();
				$data['shopName']=$shopName['shopName'];
			}
			return $data;
		}
		public function savecomment($comment_array){
			$this->db->trans_start();
			$this->db->insert('comment', $comment_array);		
			$this->db->trans_complete();
			return $this->db->trans_status();
		}
		public function orderCommentEdit($data){
			$this->db->trans_start();
			$this->db->where('orderID', $data['orderID']);
			unset($data['orderID']);
			$this->db->update('orderinfo',$data);
			$this->db->trans_complete();
			return $this->db->trans_status();
		}
		public function countcomType($post_data){
			if($post_data['shopID']){
				$this->db->where('shopID',$post_data['shopID']);
			}
			if($post_data['goodsID']){
				$this->db->where('goodsID',$post_data['goodsID']);
			}
			$where_array=array(
				'commentType <='=> '3'
			);
			$query = $this->db->where($where_array)->distinct('orderID')->select('orderID')->get('comment');
			$data['sum'] =$query->num_rows();
			if($post_data['shopID']){
				$this->db->where('shopID',$post_data['shopID']);
			}
			if($post_data['goodsID']){
				$this->db->where('goodsID',$post_data['goodsID']);
			}
			$query = $this->db->distinct('orderID')->select('orderID')->where('commentType','1')->get('comment');
			$data['disappointed'] = $query->num_rows();
			if($post_data['shopID']){
				$this->db->where('shopID',$post_data['shopID']);
			}
			if($post_data['goodsID']){
				$this->db->where('goodsID',$post_data['goodsID']);
			}
			$query = $this->db->distinct('orderID')->select('orderID')->where('commentType','2')->get('comment');
			$data['general'] = $query->num_rows();
			if($post_data['shopID']){
				$this->db->where('shopID',$post_data['shopID']);
			}
			if($post_data['goodsID']){
				$this->db->where('goodsID',$post_data['goodsID']);
			}
			$query = $this->db->distinct('orderID')->select('orderID')->where('commentType','3')->get('comment');
			$data['good'] = $query->num_rows();
			return $data;
		}
		public function commentList($post_data){
			$fields="commentID,commentContent,commentImg,goodsName,goodsID,parentID,accountID,phone,shopID,shopName,createTime,commentType";
			$where_array=array(
				'goodsID'	  =>$post_data['goodsID'],
				'parentID'    =>0,
				'commentType <=' =>3
				);
			if($post_data['commentType']){
				$this->db->where('commentType', $post_data['commentType']);
			}			
			$query=$this->db->where($where_array)->limit($post_data["pageCount"], $post_data["startPage"])->select($fields)->order_by('createTime','desc')->get('comment');
			$commentData=$query->result_array();
			$commentCount=count($commentData);			
			for ($i=0; $i <$commentCount ; $i++) { 
				if(empty($commentData[$i]['commentImg'])){
					unset($commentData[$i]['commentImg']);
				}else{
					$img_array=explode(',',$commentData[$i]['commentImg']);
					$commentData[$i]['commentImg']=$img_array;
				}
				$commentData[$i][0]=$commentData[$i];
				unset($commentData[$i]['commentID'],$commentData[$i]['commentContent'],$commentData[$i]['commentImg'],$commentData[$i]['goodsName'],$commentData[$i]['goodsID'],$commentData[$i]['parentID'],$commentData[$i]['accountID'],$commentData[$i]['phone'],$commentData[$i]['shopID'],$commentData[$i]['shopName'],$commentData[$i]['createTime'],$commentData[$i]['commentType']);
				$query=$this->db->where('parentID',$commentData[$i][0]['commentID'])->select($fields)->get('comment');
				$commentData[$i][1]=$query->row_array();
				for ($j=1; $j<10; $j++) { 
					if(empty($commentData[$i][$j])){
						unset($commentData[$i][$j]);
						break ;
					}
					$query=$this->db->where('parentID',$commentData[$i][$j]['commentID'])->select($fields)->get('comment');
					$commentData[$i][$j+1]=$query->row_array();
					unset($commentData[$i][$j]['commentImg']);
				}
				$commentData[$i][0]['userHead']=  base_url().'public/img/girl.jpg';
			}
			if( empty($commentData) ){
				return "";
			}
			return $commentData;
		}
		public function Accountcommentlist($post_data){
			$fields="commentID,commentContent,commentImg,goodsName,goodsID,parentID,accountID,phone,shopID,shopName,createTime,commentType";
			$where_array=array(
				'accountID'	=> $post_data['accountID'],
				'orderID'	=> $post_data['orderID'],
				'parentID'	=> '0'
			);
			$query=$this->db->where($where_array)->select($fields)->get('comment');
			$commentData=$query->row_array();
			$commentData[0]=$commentData;
			if(empty($commentData[0])){
				return "";
			}
			$commentData[0]['userHead']=base_url().'public/img/girl.jpg';
			if(!empty($commentData[0]['commentImg'])){
				$image_array=explode(',',$commentData[0]['commentImg']);
				$commentData[0]['commentImg']=$image_array;
			}else{
				unset($commentData[0]['commentImg']);
			}
			unset($commentData['commentID'],$commentData['commentContent'],$commentData['commentImg'],$commentData['goodsName'],$commentData['goodsID'],$commentData['parentID'],$commentData['accountID'],$commentData['phone'],$commentData['shopID'],$commentData['shopName'],$commentData['createTime'],$commentData['commentType']);
			$query=$this->db->where('parentID',$commentData[0]['commentID'])->select($fields)->order_by("createTime", "desc")->get('comment');
			$commentData[1]=$query->row_array();
			for ($j=1; $j<10; $j++) { 
				if(empty($commentData[$j])){
					unset($commentData[$j]);
					break ;
				}
				
				$query=$this->db->where('parentID',$commentData[$j]['commentID'])->select($fields)->get('comment');
				$commentData[$j+1]=$query->row_array();
			}
			return $commentData;
		}
		public function depositInfo($accountID){
			$where_array=array(
				'accountID' =>$accountID,
				'remark'	=>'保险预购金',
				'orderStatus'=>6
			);
			$arr=$this->db->where($where_array)->select('orderAmount')->get('orderInfo')->result_array();
			$arrCount=count($arr);
			if($arrCount==0){
				return;
			}
			$depositInfo['subsidy']=0;
			$depositInfo['deposit']=0;
			for($i=0;$i<$arrCount;$i++){
				$depositInfo['deposit']+=$arr[$i]['orderAmount'];
				if($arr[$i]['orderAmount']>=1000){
					$depositInfo['subsidy']+=($arr[$i]['orderAmount']/1000);
				}
			}
			$depositInfo['deposit'] = $depositInfo['deposit']/100;
			$depositInfo['ableBack']=$depositInfo['deposit']+$depositInfo['subsidy'];
			return $depositInfo;
		}
		public function jiujiuprice($phone_array){
			$price=$this->db->where($phone_array)->select()->get('jiujiuPhoneFee')->row_array();
			if(empty($price)){
				return ;
			}
			return $price['price'];
		}
		public function stateMent($body){
			$count=count($body);
			for($i=0;$i<$count;$i++){
				$receiptID=$body[$i]['receiptID'];
				$remark=$body[$i]['remark'];
				if(!empty($receiptID)){
					$img=$this->db->where('receiptID',$receiptID)->select('goodsImg,orderStatus')->get('orderInfo')->row_array();
					if(!empty($img)){
						$body[$i]['img'] = $img['goodsImg'];
					}else{
						$body[$i]['img'] =  base_url().'public/img/1.png';
					}
				}else{
					if(substr($remark,0,12)=='捐赠社区'){
						$body[$i]['img'] =base_url().'public/img/donate.png';
					}else if(substr($remark,-12)=='里程奖金'){
						$body[$i]['img'] =base_url().'public/img/bonus.png';
					}else if(substr($remark,-12)=='押金返还'){
						$body[$i]['img'] =base_url().'public/img/deposit.png';
					}else if (substr($remark,0,12)=='提现失败'){
						$body[$i]['img'] =base_url().'public/img/alipay.png';
					}else if (substr($remark,0,12)=='余额提现'){
						$body[$i]['img'] =base_url().'public/img/alipay.png';
					}else if (substr($remark,0,12)=='商城中奖'){
						$body[$i]['img'] =base_url().'public/img/reward.png';
					}
				}
			}
			return $body;
		}
		public function saveWXCode($code,$order_info){
			$code_array=array(
				'orderID'   => $order_info['orderID'],
				'goodsID'   => $order_info['goodsID'],	
				'accountID' => $order_info['accountID'],
				'cardNumber'=> $code,
				'goodsName' => $order_info['goodsName'],
				'codeStatus'=> 0,
				'createTime'=>time(),
				'effectTime'=>time(),
				'loseEffectTime'=>time()+2592000
			);
			$this->db->insert('redeemCode',$code_array);
		}
		public function editStatus($get_data){
			$this->db->set('orderStatus',$get_data['orderStatus']);
			$this->db->where('orderID',$get_data['orderID']);
			return $query = $this->db->update('orderInfo');
		}

		public function editOutsideID($get_data){
			$this->db->set('outsideID',$get_data['outsideID']);
			$this->db->where('orderID',$get_data['orderID']);
			return $query = $this->db->update('orderInfo');
		}
	}
