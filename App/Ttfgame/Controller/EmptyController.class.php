<?php
namespace Ttfgame\Controller;
use Think\Controller;
class EmptyController extends CommonController {
	
	// 没有此模块 跳转404
    public function index(){
		echo 'ttfgame run 404 empty';
    }
	
	
	// 没有些方法 跳转404
	public function _empty(){	
		echo 'ttfgame no this way run empty';
	}
	
}