<?php
namespace Zadmin\Controller;
use Think\Controller;
class ActionController extends CommonController {


    //直播分类列表
    public function atype(){
        $page = isset($_GET['p'])?$_GET['p']:1;
        $limit = D('action')->get_limit($page);
        $page_info = D('action')->get_page($page);
        $type_list = D('action')->get_type_list($limit);
        $type_state = array(
            '0'  => '否',
            '1'  => '是'
        );
        $this->assign('type_state',$type_state);
        $this->assign('page',$page_info);
        $this->assign('type_list',$type_list);
        $this->display();
    }


    //添加直播分类
    public function add_type(){
        if($_POST){
            $data['type_name'] = trim($_POST['type_name']);
            $data['type_desc'] = trim($_POST['type_desc']);
            $data['is_show'] = $_POST['is_show'];
            if(D('action')->add_type($data)){
                $this->success('添加成功!',U('action/atype'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }


    //修改直播分类
    public function edit_type(){
        if($_POST){

            $type_id = $_POST['type_id'];
            $data['type_name'] = trim($_POST['type_name']);
            $data['type_desc'] = trim($_POST['type_desc']);
            $data['is_show'] = $_POST['is_show'];
            if(D('action')->edit_type($type_id,$data)){
                $this->success('修改成功!',U('action/atype'));
            }else{
                $this->error('修改失败');
            }
        }else {
            $type_id = $_GET['id'] ? $_GET['id'] : '';
            if (empty($type_id)) {
                $this->error('没有此分类');
                exit;
            }

            $type_info = M('action_type')->where('type_id='.$type_id)->find();

            $this->assign('type_info',$type_info);
            $this->display();
        }
    }


    //删除直播分类
    public function del_type(){
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if(M('action_type')->where('type_id in ('.$ids.')')->delete()){
                echo 1;
            }
        }
    }



    //直播列表
    public function action_list(){
        $is_show = isset($_GET['is_show'])?$_GET['is_show']:'-1';
        $is_good = isset($_GET['is_good'])?$_GET['is_good']:'-1';
        $is_hot = isset($_GET['is_hot'])?$_GET['is_hot']:'-1';
        $is_over = isset($_GET['is_over'])?$_GET['is_over']:'-1';
        $type_id = isset($_GET['type_id'])?$_GET['type_id']:'-1';
        $keywords = isset($_GET['keywords'])?$_GET['keywords']:'';

        $where = '1=1';
        if($is_show != '-1') $where .= ' and is_show='.$is_show;
        if($is_good != '-1') $where .= ' and is_good='.$is_good;
        if($is_hot != '-1') $where .= ' and is_hot='.$is_hot;
        if($is_over != '-1') $where .= ' and is_over='.$is_over;
        if($type_id != '-1') $where .= ' and type_id='.$type_id;
        if($keywords) $where .= " and act_name like '%".$keywords."%'";

        $search_state['is_show'] = $is_show;
        $search_state['is_good'] = $is_good;
        $search_state['is_hot'] = $is_hot;
        $search_state['is_over'] = $is_over;
        $search_state['type_id'] = $type_id;
        $search_state['keywords'] = $keywords;

        $page = isset($_GET['p'])?$_GET['p']:1;
        $search_state['page'] = $page;
        $limit = D('action')->get_limit($page);
        $page_info = D('action')->get_page_list($search_state,$where);
        $action_list = D('action')->get_action_list($limit,$where);

        $types_arr = array();
        $types = M('action_type')->where('is_show=1')->select();
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
        $this->assign('action_list',$action_list);
        $this->assign('search_state',$search_state);

        $this->display();
    }


    //发布直播
    public function action_add(){
        if($_POST){
            $data['act_name'] = $_POST['act_name'];
            $data['type_id'] = $_POST['type_id'];
            $data['act_desc'] = $_POST['act_desc'];
            $data['act_platform'] = $_POST['act_platform'];
            $data['act_time'] = $_POST['act_time'];
            $data['is_good'] = $_POST['is_good'];
            $data['is_hot'] = $_POST['is_hot'];
            $data['is_show'] = $_POST['is_show'];
            $data['is_over'] = $_POST['is_over'];
            $data['act_player_url'] = $_POST['act_player_url'];
            $data['add_time'] = date('Y-m-d H:i:s',time());
            $data['admin_id'] = $_SESSION['zadmin']['info']['admin_id'];

            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/zhibo');
                $data['act_head_url'] = $images[0];
            }


            if(M('action')->add($data)){
                $this->success('发表成功',__ROOT__.'/index.php?m=zadmin&c=action&a=action_list');
            }else{
                $this->error('发表失败');
            }
        }else{
            $types = M('action_type')->where('is_show=1')->select();
            $this->assign('types',$types);
            $this->display();
        }
    }



    //编辑直播
    public function action_edit(){
        if($_POST){
            $act_id = $_POST['act_id'];

            $data['act_name'] = $_POST['act_name'];
            $data['type_id'] = $_POST['type_id'];
            $data['act_desc'] = $_POST['act_desc'];
            $data['act_platform'] = $_POST['act_platform'];
            $data['act_time'] = $_POST['act_time'];
            $data['is_good'] = $_POST['is_good'];
            $data['is_hot'] = $_POST['is_hot'];
            $data['is_show'] = $_POST['is_show'];
            $data['is_over'] = $_POST['is_over'];
            $data['act_player_url'] = $_POST['act_player_url'];
            if($_FILES && $_FILES['image']['name'][0]){
                $images = com_save_file($_FILES,'/Upload/zhibo');
                $data['act_head_url'] = $images[0];
            }

            if(M('action')->where('act_id='.$act_id)->save($data)){
                $this->success('编辑成功',__ROOT__.'/index.php?m=zadmin&c=action&a=action_list');
            }else{
                $this->error('编辑失败');
            }


        }else{
            $action_id = $_GET['id'] ? $_GET['id'] : '';
            if (empty($action_id)) {
                $this->error('没有此直播');
                exit;
            }

            $action = M('action')->where('act_id='.$action_id)->find();

            $types_arr = array();
            $types = M('action_type')->where('is_show=1')->select();
            if($types){
                foreach($types as $val){
                    $types_arr[$val['type_id']]['type_id'] = $val['type_id'];
                    $types_arr[$val['type_id']]['type_name'] = $val['type_name'];
                }
            }

            $this->assign('types',$types_arr);
            $this->assign('action',$action);
            $this->display();
        }
    }


    //删除直播
    public function action_del(){
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if(M('action')->where('act_id in ('.$ids.')')->delete()){
                echo 1;
            }
        }
    }












}