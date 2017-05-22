<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
        $page['page'] = isset($_GET['p'])?$_GET['p']:1;
        $page['type'] = isset($_GET['type'])?$_GET['type']:'0';
        $page['limit'] = D('article')->get_limit($page['page']);
        $where  = 'is_recommend=1';
        $article_list = D('article')->get_article_list($page['limit'],$where);
        $page_info = D('article')->get_page_list($page,$where,'index.php?');

        $this->assign('article_list',$article_list);
        $this->assign('page_info',$page_info);

        $types = D('article')->get_article_type();
        $this->assign('types',$types);
        $this->display();
    }

    public function time(){
        $this->display();
    }
}