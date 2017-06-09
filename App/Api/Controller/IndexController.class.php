<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){

	
		var_dump(M('user_name')->select());
	
		// echo 'api index';
    }

}