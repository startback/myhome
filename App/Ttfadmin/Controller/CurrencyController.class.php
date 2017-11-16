<?php
namespace Ttfadmin\Controller;
use Think\Controller;
class CurrencyController extends CommonController {

    //类型列表
    public function type(){
		$return_types = D('type')->type_list();
        $this->assign('return_types',$return_types);
        $this->display();
    }
	
	public function type_add(){
        if($_POST){
            $type_pid = intval($_POST['type_pid']);
            $type_pid_2 = intval($_POST['type_pid_2']);	
			if($type_pid_2 > 0){
				$data['type_pid'] = $type_pid_2;
			}else{
				$data['type_pid'] = $type_pid;
			}
            $data['type_name'] = trim($_POST['type_name']);
            $data['type_desc'] = trim($_POST['type_desc']);

            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/type/origin');
                foreach($images as $key=>$val){
                    $data['type_logo'] = com_make_thumb($val,'/Upload/Ttf/type/thumb');
                    $all_data[] = $data;
                }
            }
		
            if(D('type')->type_add($data)){
                $this->success('添加成功!',U('currency/type'));
            }else{
                $this->error('添加失败');
            }
        }else{
			$types = D('type')->type_list();
            $this->assign('types',$types);
            $this->display();
        }		
	}
	
	public function type_edit(){
		
        if($_POST){
            $type_id = isset($_POST['type_id']) ? intval($_POST['type_id']) : 0;
			if(empty($type_id)) {
				$this->error('没有此类型');
				exit;
			}

            $type_pid = intval($_POST['type_pid']);
            $type_pid_2 = intval($_POST['type_pid_2']);	
			if($type_pid_2 > 0){
				$data['type_pid'] = $type_pid_2;
			}else{
				$data['type_pid'] = $type_pid;
			}
            $data['type_name'] = trim($_POST['type_name']);
            $data['type_desc'] = trim($_POST['type_desc']);

            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/type/origin');
                foreach($images as $key=>$val){
                    $data['type_logo'] = com_make_thumb($val,'/Upload/Ttf/type/thumb');
                    $all_data[] = $data;
                }
            }
		
            if(D('type')->type_edit($data,$type_id)){
                $this->success('修改成功!',U('currency/type'));
            }else{
                $this->error('修改失败');
            }		
		
        }else {
            $type_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($type_id)) {
				$this->error('没有此类型');
				exit;
			}
			$type_info = M('type')->where('type_id='.$type_id)->find();
			
			$top_pid = 0;
			$sub_pid = 0;
			if($type_info['type_pid'] > 0){
				$top_info = M('type')->where('type_id='.$type_info['type_pid'])->find();
				if($top_info['type_pid'] > 0){
					$top_pid = $top_info['type_pid'];
					$sub_pid = $top_info['type_id'];
				}else{
					$top_pid = $top_info['type_id'];
				}
			}
			if($sub_pid > 0){
				$sub_types = D('type')->type_list($top_pid);
				$this->assign('sub_types',$sub_types);				
			}
			$this->assign('top_pid',$top_pid);
			$this->assign('sub_pid',$sub_pid);

			$types = D('type')->type_list();		
			$this->assign('types',$types);
			$this->assign('type_info',$type_info);
			$this->display();
        }				
	}

	//删除类型
	public function type_del(){
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if(D('type')->type_del($ids)){
                echo 1;
            }
        }	
	}	

	public function type_get(){
		$str = '<option value="0">上一级</option>';
		$id = isset($_REQUEST['id'])?intval($_REQUEST['id']):0;
		$return_types = D('type')->type_list($id);
		if($return_types){
			foreach($return_types as $value){
				$str .= '<option value="'.$value['type_id'].'">'.$value['type_name'].'</option>';
			}
		}
		echo $str;					
	}
	
	/******************/


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

            if(D('admin')->del_admin($ids)){
                echo 1;
            }
        }
    }



}