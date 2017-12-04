<?php 
namespace Ttfadmin\Model;
use Think\Model;

class AdminModel extends Model {
    var $per_page;
	
	public function __construct(){
		$this->per_page = C('PAGE_ADMIN');
	}	

	//登录
	public function login($name,$pass,$ip_add=''){
        $info = M('admin')->where("admin_account='".$name."'")->find();

        if($info){
            if(strtolower(md5($pass)) == strtolower(bin2hex($info['admin_pass']))){
				$info['ip_address'] = $ip_add;
                $_SESSION['ttfadmin']['info'] = $info;
				$data['ip_address'] = $ip_add;
				$data['admin_login_time'] = date('Y-m-d H:i:s',time());
				M('admin')->where('admin_id='.$info['admin_id'])->save($data);
				D('admin_log')->admin_log($info['admin_account'].' 登录系统');
                return true;
            }
        }
        return false;
	}
	
	//修改密码
	public function mod_admin_pass($admin_id,$data){
		if(M('admin')->where('admin_id='.$admin_id)->save($data)){
			D('admin_log')->admin_log('修改密码，ID为'.$admin_id);
			return true;
		}else{
			return false;
		}
	}
	

	//添加角色
	public function add_role($data){
		$in_id = M('admin_role')->add($data);
        if($in_id){
			D('admin_log')->admin_log('增加权限角色，编号为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}

    //修改角色权限
    public function edit_role($role_id,$data){
        if(M('admin_role')->where('role_id='.$role_id)->save($data)){
			D('admin_log')->admin_log('修改权限角色，编号为:'.$role_id);
            return true;
        }else{
            return false;
        }
    }	
	
    //删除角色
    public function del_role($ids){
		if(M('admin_role')->where('role_id in ('.$ids.')')->delete()){
			D('admin_log')->admin_log('删除权限角色，编号为:'.$ids);
            return true;   
        }else{
			return false;
		}
    }		
	

	//添加管理员
	public function add_admin($data){
		$in_id = M('admin')->add($data);
        if($in_id){
			D('admin_log')->admin_log('增加管理员，编号为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}	
	
    //编辑管理员
    public function edit_admin($admin_id,$data){
        if(M('admin')->where('admin_id='.$admin_id)->save($data)){
			D('admin_log')->admin_log('修改管理员，编号为:'.$admin_id);
            return true;
        }else{
            return false;
        }
    }		
	
    //删除管理员
    public function del_admin($ids){
		if(M('admin')->where('admin_id in ('.$ids.')')->delete()){
			D('admin_log')->admin_log('删除管理员，编号为:'.$ids);
            return true;   
        }else{
			return false;
		}
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

        $purl = __ROOT__.'/index.php?m=ttfadmin&c=admin&a=admin_list&p=';

		$page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
	
}