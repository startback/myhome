<?php
namespace Ttfadmin\Controller;
use Think\Controller;
class EmptyController extends CommonController {
	
	// 没有此模块 跳转404
    public function index(){
		echo 'ttfamdin run 404';
    }
	
	
	// 没有些方法 跳转404
	public function _empty(){	
		echo 'ttfadmin no this way run 404';		
	}
	
}