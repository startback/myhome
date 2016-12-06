<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends CommonController {

    //文章列表
    public function article_list(){
        $page['page'] = isset($_GET['p'])?$_GET['p']:1;
        $page['type'] = isset($_GET['type'])?$_GET['type']:'';

        $page['limit'] = D('article')->get_limit($page['page']);
        $where = '1=1';
        if($page['type']){
            $where .= ' and type_id='.$page['type'];
        }

        $article_list = D('article')->get_article_list($page['limit'],$where);
        $page_info = D('article')->get_page_list($page,$where);


        $this->assign('article_list',$article_list);
        $this->assign('page_info',$page_info);
        $types = D('article')->get_article_type();
        $this->assign('types',$types);

        if($page['type']){
            $cur_type['type_id'] = $page['type'];
            $cur_type['type_name'] = $types[$page['type']]['type_name'];
            $cur_type['type_desc'] = $types[$page['type']]['type_desc'];
        }
        $this->assign('cur_type',$cur_type);
        $this->display();
    }



    //文章详情
    public function article_detail(){
        $article_id = isset($_GET['article_id'])?$_GET['article_id']:'';
        if(empty($article_id)){
            $this->error('没有此文章');
            exit;
        }

        //更新查阅次数
        M('article')->where('article_id='.$article_id)->setInc('read_num');

        $article_detail = M('article')->field(C('DB_PREFIX').'article.*,'.C('DB_PREFIX').'admin.admin_account')->join(C('DB_PREFIX').'admin ON '.C('DB_PREFIX').'article.author_id = '.C('DB_PREFIX').'admin.admin_id')->where('article_id='.$article_id)->find();

        $this->assign('article_detail',$article_detail);
        $this->display();
    }

}