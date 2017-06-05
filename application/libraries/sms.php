<?php
	class Sms extends CI_Model{
		public function __construct(){
			include_once("sdk/CCPRestSDK.php");			
		}
		/**
		  * 发送模板短信
		  * @param to 手机号码集合,用英文逗号分开
		  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
		  * @param $tempId 模板Id
		*/       
		public function sendTemplateSMS($to,$datas,$tempId){
			$dev_info		= $this->config->item('yuntongxun_dev');
			//主帐号
			$accountSid		= $dev_info["accountSid"];
			//主帐号Token
			$accountToken	= $dev_info["accountToken"];
			//应用Id
			$appId 			= $dev_info["appId"];
			//请求地址，格式如下，不需要写https://
			$serverIP		= $dev_info["serverIP"];
			//请求端口 
			$serverPort		= $dev_info["serverPort"];
			//REST版本号
			$softVersion	= $dev_info["softVersion"];			
		    // 初始化REST SDK
	    	//global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
		    $rest = new REST($serverIP,$serverPort,$softVersion);
		    $rest->setAccount($accountSid,$accountToken);
		    $rest->setAppId($appId);
		    // 发送模板短信
			//print_R($to);print_r($datas);print_R($tempId);
		    $result = $rest->sendTemplateSMS($to,$datas,$tempId);
			print_r($result);
		    if($result == NULL ) {
		        return "result error!";
		        break;
		    }
		    if($result->statusCode!=0) {
				//echo "好伤心";
		        return $result->statusCode;		   
		        //TODO 添加错误处理逻辑
		    }else{
		        // 获取返回信息
		        $smsmessage = $result->TemplateSMS;
		        $success_array = array("sid" => $smsmessage->smsMessageSid);
		        return $success_array;
		        //TODO 添加成功处理逻辑
		    }
		}
	}
?>
