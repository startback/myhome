<?php
/*****************    公用函数    *****************/


/*
 * 获取真实IP
 *
 * retufn string
 */
function com_get_ip(){ 
	if (getenv('HTTP_CLIENT_IP')){ 
		$ip = getenv('HTTP_CLIENT_IP'); 
		
	}elseif (getenv('HTTP_X_FORWARDED_FOR')){ 
		$ip = getenv('HTTP_X_FORWARDED_FOR'); 
		
	}elseif (getenv('HTTP_X_FORWARDED')){ 
		$ip = getenv('HTTP_X_FORWARDED'); 
		
	}elseif (getenv('HTTP_FORWARDED_FOR')){ 
		$ip = getenv('HTTP_FORWARDED_FOR'); 

	}elseif (getenv('HTTP_FORWARDED')){ 
		$ip = getenv('HTTP_FORWARDED'); 
		
	}else{ 
		$ip = $_SERVER['REMOTE_ADDR']; 
		
	} 
	
	return $ip; 
} 

/*
 * 使用curl获取api信息
 * string  $url  登录页地址
 * array   $data  传输数据
 * int     $method  0:get 1:post
 *
 * return  string
 */
function com_curl_get_api($url,$data=array(),$method=0){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
	if($method == 1){
		curl_setopt($ch, CURLOPT_POST, 1);
	}
	if(!empty($data)){
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	$result=curl_exec($curl);
	curl_close($curl);		
	
	return $result;
}





















