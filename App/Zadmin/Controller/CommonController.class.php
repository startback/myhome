<?php
namespace Zadmin\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function __construct(){
        parent::__construct();

        $path_info = $this->get_pathinfo();
        $this->no_login($path_info);                   //登录判断

        //个人权限
        if(!in_array($path_info,C('NO_LEVEL'))) {
            if ($_SESSION['zadmin']['info']['admin_account'] != 'admin') {
                $user_levels = $this->get_person_level($_SESSION['zadmin']['info']['admin_role_id']);
                $this->check_person_level($path_info, $user_levels);
            }
        }
    }


    /*
     * 返回path_info
     */
    public function get_pathinfo(){
        $paths = split('&',$_SERVER['QUERY_STRING']);
		if($paths[1]){
			$first = str_replace('c=','',$paths[1]);
			$first_paths = $first?$first:'index';
		}else{
			$first_paths = 'index';
		}
		
		if($paths[2]){
			$second = str_replace('a=','',$paths[2]);
			$second_paths = $second?$second:'index';
		}else{
			$second_paths = 'index';
		}		
		
        $path_info = strtolower($first_paths).'/'.strtolower($second_paths);
        return $path_info;
    }


    /*
     * 没有登录跳转
     */
    public function no_login($path_info){
        if(!in_array($path_info,C('NO_LOGIN'))){
            if(empty($_SESSION['zadmin']['info'])) {
				header('Location: index.php?m=zadmin&c=index&a=login');
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
        echo 'zadmin no this way run 404';
    }

}

