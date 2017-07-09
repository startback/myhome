<?php
namespace Zadmin\Controller;
use Think\Controller;
class EmptyController extends CommonController {
	
	// 没有此模块 跳转404
    public function index(){
		echo 'zadmin run 404 empty';
    }
	
	
	// 没有些方法 跳转404
	public function _empty(){	
		echo 'zadmin no this way run empty';
	}
	
}