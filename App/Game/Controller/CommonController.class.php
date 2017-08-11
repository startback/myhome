<?php
namespace Game\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function __construct(){
        parent::__construct();

 
    }



    // 没有些方法 跳转404
    public function _empty(){
        echo 'game no this way run common';
    }

}

