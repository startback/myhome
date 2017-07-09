<?php 
namespace Zadmin\Model;
use Think\Model;

class AdminModel extends Model {
    var $per_page = 10;

	//登录
	public function login($name,$pass){
        $info = M('admin')->where("admin_account='".$name."'")->find();

        if($info){
            if(strtolower(md5($pass)) == strtolower(bin2hex($info['admin_pass']))){
                $_SESSION['zadmin']['info'] = $info;
                return true;
            }
        }
        return false;
	}
	


	/*
	 * 注册
	 */
	public function register(){

        $pass = hex2bin(md5(123456));

        $data = array(
            'admin_account'   =>   'admin',
            'admin_pass'      =>   $pass,
            'admin_role_id'   =>   0,
            'admin_name'      =>   '超级管理员',
            'admin_phone'     =>   '15811867789',
            'admin_email'     =>   '84656855@qq.com',
            'admin_sex'       =>   1,
            'admin_birthdat'  =>   '1984-10-10',
            'admin_register_time'  =>   date('Y-m-d H:i:s'),
            'admin_tag'       =>   '走走停停，一路顺景'
        );
//        M('admin')->add($data);
    }



    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }


    //获取管理员列表
    public function get_admin_list($limit){
        return M('admin')->limit($limit)->order('admin_id desc')->select();
    }

    //获得页数
    public function get_admin_page($page){
        $total_num = M('admin')->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page;
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $purl = __ROOT__.'/index.php?m=zadmin&c=admin&a=admin_list&p=';

        $page_info = '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }

	

	
}