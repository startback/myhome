<?php
namespace Myadmin\Controller;
use Think\Controller;
class ArticleController extends CommonController {


    //文章分类列表
    public function atype(){
        $page = isset($_GET['p'])?$_GET['p']:1;
        $limit = D('article')->get_limit($page);
        $page_info = D('article')->get_page($page);
        $type_list = D('article')->get_type_list($limit);
        $type_state = array(
            '0'  => '否',
            '1'  => '是'
        );
        $this->assign('type_state',$type_state);
        $this->assign('page',$page_info);
        $this->assign('type_list',$type_list);
        $this->display();
    }


    //添加文章分类
    public function add_type(){
        if($_POST){
            $data['type_name'] = trim($_POST['type_name']);
            $data['type_desc'] = trim($_POST['type_desc']);
            $data['is_show'] = $_POST['is_show'];
            if(D('article')->add_type($data)){
                $this->success('添加成功!',U('article/atype'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }


    //修改文章分类
    public function edit_type(){
        if($_POST){

            $type_id = $_POST['type_id'];
            $data['type_name'] = trim($_POST['type_name']);
            $data['type_desc'] = trim($_POST['type_desc']);
            $data['is_show'] = $_POST['is_show'];
            if(D('article')->edit_type($type_id,$data)){
                $this->success('修改成功!',U('article/atype'));
            }else{
                $this->error('修改失败');
            }
        }else {
            $type_id = $_GET['id'] ? $_GET['id'] : '';
            if (empty($type_id)) {
                $this->error('没有此分类');
                exit;
            }

            $type_info = M('article_type')->where('type_id='.$type_id)->find();

            $this->assign('type_info',$type_info);
            $this->display();
        }
    }


    //删除文章分类
    public function del_type(){
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if(M('article_type')->where('type_id in ('.$ids.')')->delete()){
                echo 1;
            }
        }
    }



    //文章列表
    public function article_list(){
        $is_show = isset($_GET['is_show'])?$_GET['is_show']:'-1';
        $is_top = isset($_GET['is_top'])?$_GET['is_top']:'-1';
        $is_hot = isset($_GET['is_hot'])?$_GET['is_hot']:'-1';
        $is_recommend = isset($_GET['is_recommend'])?$_GET['is_recommend']:'-1';
        $type_id = isset($_GET['type_id'])?$_GET['type_id']:'-1';
        $keywords = isset($_GET['keywords'])?$_GET['keywords']:'';

        $where = '1=1';
        if($is_show != '-1') $where .= ' and is_show='.$is_show;
        if($is_top != '-1') $where .= ' and is_top='.$is_top;
        if($is_hot != '-1') $where .= ' and is_hot='.$is_hot;
        if($is_recommend != '-1') $where .= ' and is_recommend='.$is_recommend;
        if($type_id != '-1') $where .= ' and type_id='.$type_id;
        if($keywords) $where .= " and article_title like '%".$keywords."%'";

        $search_state['is_show'] = $is_show;
        $search_state['is_top'] = $is_top;
        $search_state['is_hot'] = $is_hot;
        $search_state['is_recommend'] = $is_recommend;
        $search_state['type_id'] = $type_id;
        $search_state['keywords'] = $keywords;

        $page = isset($_GET['p'])?$_GET['p']:1;
        $search_state['page'] = $page;
        $limit = D('article')->get_limit($page);
        $page_info = D('article')->get_page_list($search_state,$where);
        $article_list = D('article')->get_article_list($limit,$where);

        $types_arr = array();
        $types = M('article_type')->where('is_show=1')->select();
        if($types){
            foreach($types as $val){
                $types_arr[$val['type_id']]['type_id'] = $val['type_id'];
                $types_arr[$val['type_id']]['type_name'] = $val['type_name'];
            }
        }

        $state = array(
            '0'  =>  '否',
            '1'  =>  '是'
        );

        $this->assign('state',$state);
        $this->assign('types',$types_arr);
        $this->assign('page_info',$page_info);
        $this->assign('article_list',$article_list);
        $this->assign('search_state',$search_state);

        $this->display();
    }


    //发布文章
    public function article_add(){
        if($_POST){
            $data['article_title'] = $_POST['article_title'];
            $data['type_id'] = $_POST['type_id'];
            $data['article_desc'] = $_POST['article_desc'];
            $data['article_content'] = $_POST['article_content'];
            $data['article_tag'] = $_POST['article_tag'];
            $data['is_top'] = $_POST['is_top'];
            $data['is_hot'] = $_POST['is_hot'];
            $data['is_show'] = $_POST['is_show'];
            $data['is_recommend'] = $_POST['is_recommend'];
            $data['top_order'] = $_POST['top_order'];
            $data['article_time'] = date('Y-m-d H:i:s',time());
            $data['author_id'] = $_SESSION['admin']['info']['admin_id'];

            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/article');
                $data['article_img'] = $images[0];
            }


            if(M('article')->add($data)){
                $this->success('发表成功',__ROOT__.'/index.php?m=myadmin&c=article&a=article_list');
            }else{
                $this->error('发表失败');
            }
        }else{
            $types = M('article_type')->where('is_show=1')->select();
            $this->assign('types',$types);
            $this->display();
        }
    }



    //编辑文章
    public function article_edit(){
        if($_POST){
            $article_id = $_POST['article_id'];

            $data['article_title'] = $_POST['article_title'];
            $data['type_id'] = $_POST['type_id'];
            $data['article_desc'] = $_POST['article_desc'];
            $data['article_content'] = $_POST['article_content'];
            $data['article_tag'] = $_POST['article_tag'];
            $data['is_top'] = $_POST['is_top'];
            $data['is_hot'] = $_POST['is_hot'];
            $data['is_show'] = $_POST['is_show'];
            $data['is_recommend'] = $_POST['is_recommend'];
            $data['top_order'] = $_POST['top_order'];
            if($_FILES && $_FILES['image']['name'][0]){
                $images = com_save_file($_FILES,'/Upload/article');
                $data['article_img'] = $images[0];
            }

            if(M('article')->where('article_id='.$article_id)->save($data)){
                $this->success('编辑成功',__ROOT__.'/index.php?m=myadmin&c=article&a=article_list');
            }else{
                $this->error('编辑失败');
            }


        }else{
            $article_id = $_GET['id'] ? $_GET['id'] : '';
            if (empty($article_id)) {
                $this->error('没有此文章');
                exit;
            }

            $article = M('article')->where('article_id='.$article_id)->find();

            $types_arr = array();
            $types = M('article_type')->where('is_show=1')->select();
            if($types){
                foreach($types as $val){
                    $types_arr[$val['type_id']]['type_id'] = $val['type_id'];
                    $types_arr[$val['type_id']]['type_name'] = $val['type_name'];
                }
            }

            $this->assign('types',$types_arr);
            $this->assign('article',$article);
            $this->display();
        }
    }


    //删除文章
    public function article_del(){
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if(M('article')->where('article_id in ('.$ids.')')->delete()){
                echo 1;
            }
        }
    }












}