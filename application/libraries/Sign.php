<?php
	function rsa_publickey_encrypt($pubk,$data) {
	    $pubk = openssl_get_publickey($pubk);
	    openssl_public_encrypt($data, $en, $pubk, OPENSSL_PKCS1_PADDING);
	    return $en;
	}
	function rsa_privatekey_decrypt($prik, $data) {
	    $prik = openssl_get_privatekey($prik);
	    openssl_private_decrypt($data, $de, $prik, OPENSSL_PKCS1_PADDING);
	    return $de;
	}
	class sign extends CI_Model{
		public function __construct(){
			
		}
		public function return_error_code($body,$type,$status){
			$info = array();
			switch ($status) {
				case 'inside':
					$info = array("ERRORCODE"=>$body);
					break;
				case 'outside':
					if($body){
						$info = array(
							"ERRORCODE" => "0",
							"RESULT" => $body
						);
					}else{
						$info = array(
							"ERRORCODE" => "10015",
							"RESULT" => $body
						);
					}
					break;
				default:
					if($body){
						$info = array("ERRORCODE"=>"0");
					}else{
						$info = array("ERRORCODE"=>"1");
					}
					break;
			}			
			if($type=="json"){
				return json_encode($info);
			}else{
				return $info;
			}
		}
		public function get_sign_array($array,$type){
			unset($array['sign']);
			$info = array_merge($array,$this->config->item('shop_dev'));
			foreach ($info as $key=>$value){
				$arr[$key] = $key;
			}		
			sort($arr);
			$str = ""; 
    		foreach ($arr as $k => $v){
				$str = $str.$arr[$k].$info[$v];
    		}
			$info['sign'] = strtoupper(sha1($str));
			unset($info['secret']);
			if($type=="json"){
				return json_encode($info);
			}else{
				return $info;
			}
		}
		public function getReward_sign_array($array,$type){
			unset($array['sign']);
			$info = array_merge($array,$this->config->item('reward_dev'));
			foreach ($info as $key=>$value){
				$arr[$key] = $key;
			}		
			sort($arr);
			$str = ""; 
    		foreach ($arr as $k => $v){
				$str = $str.$arr[$k].$info[$v];
    		}
			$info['sign'] = strtoupper(sha1($str));
			unset($info['secret']);
			if($type=="json"){
				return json_encode($info);
			}else{
				return $info;
			}
		}
		public function get_img_sign($array,$type){
			$info=array_merge($array,$this->config->item('shop_dev'));
			unset($info['secret']);
			foreach ($info as $key=>$value){
				$arr[$key] = $key;
			}		
			sort($arr);
			$str = ""; 
    		foreach ($arr as $k => $v){
				$str = $str.$arr[$k].$info[$v];
    		}
			$info['sign'] = strtoupper(sha1($str));
			if($type=="json"){
				return json_encode($info);
			}else{
				return $info;
			}
		}
		public function get_huafeiduo_sign($array){
			unset($array['accountID']);
			$huafeiduo_dev = $this->config->item('huafeiduo_dev');
			$api_key = array('api_key'=>$huafeiduo_dev['api_key']);
			$array = array_merge($array,$api_key);
			ksort($array);
			$str = ""; 
    		foreach ($array as $key  => $value){
				$str .= "{$key}{$value}";
    		}       
    		$array['sign'] = md5($str.$huafeiduo_dev['secret_key']);
    		$fields_string = "";
		    foreach($array as $key=>$value) {
		        $fields_string .= $key.'='.$value.'&';
		    }
    		return  rtrim('&'.$fields_string,'&');
		}
		public function get_verify_code($array){
			unset($array['sign']);
			foreach ($array as $key=>$value){
				$arr[$key] = $key;
			}		
			sort($arr);
			$str = ""; 
    		foreach ($arr as $k => $v){
				$str = $str.$arr[$k].$array[$v];
			}
    		return strtoupper(md5($str));
		}
		public function check_huafeiduo_sign($array){
			$sign = $array['sign'];
			unset($array['sign']);
			$huafeiduo_dev = $this->config->item('huafeiduo_dev');
			$secret_key = array('secret_key'=>$huafeiduo_dev['secret_key']);
			$array = array_merge($array,$api_key);
			$str = ""; 
    		foreach ($array as $key  => $value){
				$str .= "{$key}{$value}";
    		}       
    		if($sign == md5($str)){
    			return true;	
    		}
    		return false;
		}
		public function get_weixin_sign($array){
			$weixin_dev = $this->config->item('weixin_dev');
			ksort($array);
			$str = ""; 
			foreach($array as $key=>$value) {
				$str .= $key.'='.$value.'&';
			}
			$str = $str.'key='.$weixin_dev["wxkey"];
			return strtoupper(md5($str));
		}
		public function get_jiu_sign($array){
			$jiujiu_dev = $this->config->item('jiujiu_dev');
			$key=$jiujiu_dev['key'];
			ksort($array);
			$arg  = "";
			while (list ($name, $val) = each ($array)) {
				if(strpos($name, "_") === 0)
					continue;			
				if(is_array($val))
					$val =join(',',$val);
				if(empty($val))
					continue;
				$arg.=$name."=". $val ."&";
			}
			$arg = substr($arg,0,count($arg)-2);
			return md5($arg.$key);
		}
	}