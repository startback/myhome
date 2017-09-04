<?php
/*****************    公用函数    *****************/


/*
 * 获取真实IP
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
 * 获取对应地址cookie及验证码
 * string  $login_url  登录页地址
 * string  $verify_code_url  验证码地址
 */
function com_curl_get_cookie($login_url,$verify_code_url,$timeout=5){
	$com_path = str_replace('\\App\\Game\\Common','',str_replace('/App/Game/Common','',__DIR__));	
	$cookie_file = $com_path."/Upload/tmp.cookie";	
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $login_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($curl,CURLOPT_COOKIEJAR,$cookie_file); //获取COOKIE并存储
	curl_exec($curl);
	curl_close($curl);
	 
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $verify_code_url);
	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$img = curl_exec($curl);
	curl_close($curl);
	 
	$fp = fopen($com_path.'/Upload/code.jpg',"w");
	fwrite($fp,$img);
	fclose($fp);		
}





/*
 * 获取对应地址内容
 * string  $url   页面地址
 * array   $data  传递内数据
 */
function com_curl_get_content($url,$data=array()){
	$com_path = str_replace('\\App\\Game\\Common','',str_replace('/App/Game/Common','',__DIR__));	
	$cookie_file = $com_path."/Upload/tmp.cookie";	
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
	$result=curl_exec($curl);
	curl_close($curl);		
	
	return $result;
}






















