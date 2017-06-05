<?php
	class redpack extends CI_Model{
		public function __construct(){
			include_once('sdk/wxRedpackSDK.php');
		}
		public function send_redpack($url,$param_array){
			$xml_data = '<xml>
				<sign>'.$param_array["sign"].'</sign>
				<mch_billno>'.$param_array["mch_billno"].'</mch_billno>
				<mch_id>'.$param_array["mch_id"].'</mch_id>
				<wxappid>'.$param_array["wxappid"].'</wxappid>
				<nick_name>'.$param_array["nick_name"].'</nick_name>
				<send_name>'.$param_array["send_name"].'</send_name>
				<re_openid>'.$param_array["re_openid"].'</re_openid>
				<total_amount>'.$param_array["total_amount"].'</total_amount>
				<min_value>'.$param_array["min_value"].'</min_value>
				<max_value>'.$param_array["max_value"].'</max_value>
				<total_num>'.$param_array["total_num"].'</total_num>
				<wishing>'.$param_array["wishing"].'</wishing>
				<client_ip>'.$param_array["client_ip"].'</client_ip>
				<act_name>'.$param_array["act_name"].'</act_name>
				<remark>'.$param_array["remark"].'</remark>
				<logo_imgurl>'.$param_array["logo_imgurl"].'</logo_imgurl>       
				<nonce_str>'.$param_array["nonce_str"].'</nonce_str>
			</xml>';	
			$xmlstring = curl_post_ssl($url,$xml_data);	
			$res = @simplexml_load_string($xmlstring,NULL,LIBXML_NOCDATA);				//xml转数组
			return json_decode(json_encode($res),true);									//转json
		}
	}
