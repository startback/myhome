<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function __construct(){
        parent::__construct();

        $this->com_nav_list();
        $this->right_article_list();
    }


    //导航
    public function com_nav_list(){
        $article_type = isset($_GET['type'])?$_GET['type']:'index';
        $article_nav = M('article_type')->where('is_show=1')->select();
        $this->assign('article_nav',$article_nav);
        $this->assign('article_type',$article_type);
    }


    //右侧文章
    public function right_article_list(){
        $right_list['read'] = M('article')->order('read_num desc,article_id desc')->limit(6)->select();
        $right_list['new'] = M('article')->order('article_id desc')->limit(6)->select();
        $right_list['top'] = M('article')->where('is_top=1')->order('top_order desc,article_id desc')->limit(6)->select();
        $this->assign('right_list',$right_list);
    }



    // 没有些方法 跳转404
    public function _empty(){
        echo 'home no this way run common';
    }

}

