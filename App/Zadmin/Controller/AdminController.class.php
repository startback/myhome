<?php
namespace Zadmin\Controller;
use Think\Controller;
class AdminController extends CommonController {

    //角色列表
    public function role_list(){
        $levels = M('role')->select();
        $this->assign('levels',$levels);
        $this->display();
    }


    //添加角色
    public function role_add(){
        if($_POST){
            $data['role_name'] = trim($_POST['role_name']);
            $data['role_desc'] = trim($_POST['role_desc']);
            $data['role_power'] = '';
            $levels = $_POST['levels'];
            if($levels){
                foreach($levels as $val){
                    if($data['role_power']){
                        $data['role_power'] .= ','.$val;
                    }else{
                        $data['role_power'] = $val;
                    }
                }
            }

            if(M('role')->add($data)){
                $this->success('添加成功!',U('admin/role_list'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->assign('role_level',C('ADMIN_LEVEL'));
            $this->display();
        }
    }


    //修改角色权限
    public function role_edit(){
        if($_POST){
            $role_id = $_POST['role_id'];
            $data['role_name'] = trim($_POST['role_name']);
            $data['role_desc'] = trim($_POST['role_desc']);
            $data['role_power'] = '';
            $levels = $_POST['levels'];
            if($levels){
                foreach($levels as $val){
                    if($data['role_power']){
                        $data['role_power'] .= ','.$val;
                    }else{
                        $data['role_power'] = $val;
                    }
                }
            }
            if(M('role')->where('role_id='.$role_id)->save($data)){
                $this->success('修改成功!',U('admin/role_list'));
            }else{
                $this->error('修改失败');
            }
        }else {
            $role_id = $_GET['id'] ? $_GET['id'] : '';
            if (empty($role_id)) {
                $this->error('没有此角色');
                exit;
            }

            $this->assign('role_level',C('ADMIN_LEVEL'));
            $role_info = M('role')->where('role_id='.$role_id)->find();

            $level_arr = array();
            $arr = explode(',',$role_info['role_power']);
            foreach($arr as $val){
                $level_arr[$val] = 1;
            }

            $this->assign('level_arr',$level_arr);
            $this->assign('role_info',$role_info);
            $this->display();
        }
    }


    //删除角色
    public function role_del(){
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if(M('role')->where('role_id in ('.$ids.')')->delete()){
                echo 1;
            }
        }
    }


    //管理员列表
    public function admin_list(){
        $page = isset($_GET['p'])?$_GET['p']:1;
        $limit = D('admin')->get_limit($page);
        $page_info = D('admin')->get_admin_page($page);
        $admin_list = D('admin')->get_admin_list($limit);

        $sex_state = array(
            '0' => '未知',
            '1' => '男',
            '2' => '女'
        );

        $roles_arr = M('role')->field('role_id,role_name')->select();
        $roles = array();
        $roles[0] = '超级管理员';
        if($roles_arr){
            foreach($roles_arr as $val){
                $roles[$val['role_id']] = $val['role_name'];
            }
        }

        $this->assign('roles',$roles);
        $this->assign('sex_state',$sex_state);
        $this->assign('admin',$admin_list);
        $this->assign('page',$page_info);
        $this->display();
    }


    //添加管理员
    public function admin_add(){
        if($_POST){
            $data['admin_account'] = trim($_POST['admin_account']);
            $data['admin_pass'] = hex2bin(md5(trim($_POST['admin_pass'])));
            $data['admin_role_id'] = $_POST['admin_role_id'];
            $data['admin_register_time'] = date('Y-m-d H:i:s');

            if(M('admin')->add($data)){
                $this->success('添加成功!',U('admin/admin_list'));
            }else{
                $this->error('添加失败');
            }
        }else{

            $role = M('role')->select();
            $this->assign('role',$role);
            $this->display();
        }
    }


    //修改管理员信息
    public function admin_edit(){
        if($_POST){
            $admin_id = $_POST['admin_id'];

            $data['admin_name'] = trim($_POST['admin_name']);
            $data['admin_sex'] = $_POST['admin_sex'];
            $data['admin_role_id'] = $_POST['admin_role_id'];
            $data['admin_phone'] = $_POST['admin_phone'];
            $data['admin_email'] = trim($_POST['admin_email']);
            $data['admin_birthday'] = $_POST['admin_birthday'];
            $data['admin_tag'] = trim($_POST['admin_tag']);

            if(M('admin')->where('admin_id='.$admin_id)->save($data)){
                $this->success('修改成功!',U('admin/admin_list'));
            }else{
                $this->error('修改失败');
            }
        }else {
            $admin_id = $_GET['id'] ? $_GET['id'] : '';
            if (empty($admin_id)) {
                $this->error('没有此管理员');
                exit;
            }

            $admin_info = M('admin')->where('admin_id='.$admin_id)->find();
            $roles_arr = M('role')->field('role_id,role_name')->select();
            $roles = array();
            $roles[0] = '超级管理员';
            if($roles_arr){
                foreach($roles_arr as $val){
                    $roles[$val['role_id']] = $val['role_name'];
                }
            }

            $sex_state = array(
                '0' => '未知',
                '1' => '男',
                '2' => '女'
            );

            $this->assign('sex_state',$sex_state);
            $this->assign('roles',$roles);
            $this->assign('admin_info',$admin_info);
            $this->display();
        }
    }


    //删除管理员
    public function admin_del(){
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if($ids == 1){
                echo 2;
                exit;
            }

            $check_ids = explode(',',$ids);
            if(in_array(1,$check_ids)){
                echo 2;
                exit;
            }

            if(M('admin')->where('admin_id in ('.$ids.')')->delete()){
                echo 1;
            }
        }
    }



}