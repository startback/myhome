<?php
namespace Zhibo\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
	
		// var_dump(M('action')->select());
	
		$this->display();
    }

}