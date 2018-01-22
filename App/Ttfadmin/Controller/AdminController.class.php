<?php
namespace Ttfadmin\Controller;
use Think\Controller;
class AdminController extends CommonController {

    //角色列表
    public function role_list(){
        $levels = M('admin_role')->select();
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

            if(D('admin')->add_role($data)){
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
            if(D('admin')->edit_role($role_id,$data)){
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
            $role_info = M('admin_role')->where('role_id='.$role_id)->find();

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
		$data['status'] = 0;
		$data['info'] = '删除失败';			
        if($ids){
            if(M('role')->where('role_id in ('.$ids.')')->delete()){
                $data['status'] = 1;
                $data['info'] = '删除成功';
            }
        }
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
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

        $roles_arr = M('admin_role')->field('role_id,role_name')->select();
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

            if(D('admin')->add_admin($data)){
                $this->success('添加成功!',U('admin/admin_list'));
            }else{
                $this->error('添加失败');
            }
        }else{

            $role = M('admin_role')->select();
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

            if(D('admin')->edit_admin($admin_id,$data)){
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
            $roles_arr = M('admin_role')->field('role_id,role_name')->select();
            $roles = array();
     	
			if($admin_info['admin_account'] == 'admin'){
				$roles[0] = '超级管理员';
			}else{
				if($roles_arr){
					foreach($roles_arr as $val){
						$roles[$val['role_id']] = $val['role_name'];
					}
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
		$data['status'] = 0;
		$data['info'] = '删除失败';			
        if($ids){
            if($ids == 1){
				$data['status'] = 2;
				$data['info'] = '无权删除admin管理员';
            }else{
				$check_ids = explode(',',$ids);
				if(in_array(1,$check_ids)){
					$data['status'] = 2;
					$data['info'] = '无权删除admin管理员';
				}else{
					if(M('admin')->where('admin_id in ('.$ids.')')->delete()){
						$data['status'] = 1;
						$data['info'] = '删除成功';
					}
				}
			}
        }
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }


    //管理员日志列表
    public function admin_log_list(){

        $admin_id = isset($_GET['admin_id'])?intval($_GET['admin_id']):'-1';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
        $ip_address = isset($_GET['ip_address'])?trim($_GET['ip_address']):'-1';

        $where = '1=1';
        if($admin_id != '-1') $where .= ' and '.C('DB_PREFIX').'admin_log.admin_id='.$admin_id;
        if($start_time) $where .= " and ".C('DB_PREFIX')."admin_log.log_time>='".$start_time."'";
        if($end_time) $where .= " and ".C('DB_PREFIX')."admin_log.log_time<'".$end_time."'";
        if($ip_address != '-1') $where .= " and ".C('DB_PREFIX')."admin_log.ip_address='".$ip_address."'";
 
        $search_state['admin_id'] = $admin_id;
        $search_state['start_time'] = $start_time;
        $search_state['end_time'] = $end_time;
        $search_state['ip_address'] = $ip_address;
		
        $page = isset($_GET['p'])?$_GET['p']:1;
        $search_state['page'] = $page;
        $limit = D('admin_log')->get_limit($page);
        $page_info = D('admin_log')->get_admin_log_page($search_state,$where);
        $admin_log_list = D('admin_log')->get_admin_log_list($limit,$where);

        $this->assign('state',$state);
        $this->assign('page_info',$page_info);
        $this->assign('admin_log_list',$admin_log_list);
        $this->assign('search_state',$search_state);

		$admins = M('admin')->field('admin_id,admin_account')->order('admin_id desc')->select();
		if($admins){
			foreach($admins as $key=>$value){
				$admins[$key]['select'] = '';
				if($value['admin_id'] == $search_state['admin_id']){
					$admins[$key]['select'] = 'selected';
				}
			}
		}
		$this->assign('admins',$admins);
		$ip_adds = M('admin_log')->field('ip_address')->group('ip_address')->select();
		if($ip_adds){
			foreach($ip_adds as $key=>$value){
				$ip_adds[$key]['select'] = '';
				if($value['ip_address'] == $search_state['ip_address']){
					$ip_adds[$key]['select'] = 'selected';
				}
			}
		}		
		$this->assign('ip_adds',$ip_adds);		
		
        $this->display();
    }
	


}