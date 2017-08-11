<?php
namespace Game\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
	
		echo com_get_ip();
		echo '<br>';
	
        $this->display();
    }


	
	
}