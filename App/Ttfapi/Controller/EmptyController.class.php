<?php
namespace Ttfapi\Controller;
use Think\Controller;
class EmptyController extends CommonController {
	
	// 没有此模块 跳转404
    public function index(){
        $res['code'] = 1;
		$res['msg'] = "你好，";
		$res['data'] = array();
		
		echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }
	
	
	// 没有些方法 跳转404
	public function _empty(){	
        $res['code'] = 2;
		$res['msg'] = "请不要骚扰！";
		$res['data'] = array();
		
		echo json_encode($res,JSON_UNESCAPED_UNICODE);
	}
	
}