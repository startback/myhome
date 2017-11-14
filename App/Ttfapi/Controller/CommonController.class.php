<?php
namespace Ttfapi\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function __construct(){
        parent::__construct();
		

		$_REQUEST['user_phone'] = '15811867789';
		$_REQUEST['user_pass'] = '123456';	
		$_POST['user_phone'] = '15811867789';
		$_POST['user_pass'] = '123456';	
		
		$c_name = strtolower(CONTROLLER_NAME);
		$a_name = strtolower(ACTION_NAME);
		$c_act_name = $c_name."-".$a_name;
		//不需要POST的控制品-方法集
		$without_posts = array('index-index');
		if(!in_array($c_act_name,$without_posts)){
			if(!$_POST){
				$res['code'] = 10;
				$res['msg'] = "请求方法错误";
				$res['data'] = array();		
				echo json_encode($res,JSON_UNESCAPED_UNICODE);
				exit;
			}			
		}
		

		
		

    }

	
    // 没有些方法 跳转404
    public function _empty(){
        $res['code'] = 3;
		$res['msg'] = "你好，请不要骚扰！";
		$res['data'] = array();
		
		echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }

}

