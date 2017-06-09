<?php
namespace Api\Controller;
use Think\Controller;
class EmptyController extends CommonController {
	
	// 没有此模块 跳转404
    public function index(){
		echo 'home run 404 empty';
    }
	
	
	// 没有些方法 跳转404
	public function _empty(){	
		echo 'home no this way run empty';
	}
	
}