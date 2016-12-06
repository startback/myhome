<?php
namespace Myadmin\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function __construct(){
        parent::__construct();

        $path_info = $this->get_pathinfo();
        $this->no_login($path_info);                   //登录判断

        //个人权限
        if(!in_array($path_info,C('NO_LEVEL'))) {
            if ($_SESSION['admin']['info']['admin_account'] != 'admin') {
                $user_levels = $this->get_person_level($_SESSION['admin']['info']['admin_role_id']);
                $this->check_person_level($path_info, $user_levels);
            }
        }
    }


    /*
     * 返回path_info
     */
    public function get_pathinfo(){
        $paths = split('/',$_SERVER['PATH_INFO']);
        $first_paths = $paths[0]?$paths[0]:'index';
        $second_paths = $paths[1]?$paths[1]:'index';
        $path_info = strtolower($first_paths).'/'.strtolower($second_paths);

        return $path_info;
    }


    /*
     * 没有登录跳转
     */
    public function no_login($path_info){
        if(!in_array($path_info,C('NO_LOGIN'))){
            if(empty($_SESSION['admin']['info'])) {
                $this->redirect('myadmin/index/login');
                exit;
            }
        }
    }

    /*
     * 查找个人权限
     */
    public function get_person_level($role_id){
        $roles = M('role')->where('role_id='.$role_id)->find();
        return explode(',',$roles['role_power']);
    }



    /*
     * 权限判断
     */
    public function check_person_level($path_info,$user_levels){
        if (!in_array($path_info, $user_levels)) {
            $this->error('没有权限');
            exit;
        }
    }


    /*
     * 没有此方法 跳转404
     */
    public function _empty(){
        echo 'admin no this way run 404';
    }

}

