<?php
namespace Ttfadmin\Controller;
use Think\Controller;
class UsermanageController extends CommonController {
	
	/********************************************************************************/
	//用户
	public function user(){		
		
        $user_name = isset($_GET['user_name'])?trim($_GET['user_name']):'';
        $user_phone = isset($_GET['user_phone'])?trim($_GET['user_phone']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
        $user_vip = isset($_GET['user_vip'])?intval($_GET['user_vip']):-1;

		
		$where = '1=1';
		if($user_name) $where .= " and ".C('DB_PREFIX')."user.user_name like '%".$user_name."%'";		
		if($user_phone) $where .= " and ".C('DB_PREFIX')."user.user_phone like '%".$user_phone."%'";		
		if($start_time) $where .= " and ".C('DB_PREFIX')."user.user_reg_time >= '".$start_time."'";		
		if($end_time) $where .= " and ".C('DB_PREFIX')."user.user_reg_time < '".$end_time."'";	
		if($user_vip != -1) $where .= " and ".C('DB_PREFIX')."user_info.user_vip=".$user_vip;

        $search_state['user_name'] = $user_name;
        $search_state['user_phone'] = $user_phone;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;			
        $search_state['user_vip'] = $user_vip;				
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('user')->get_limit($page);
        $page_info = D('user')->user_page($search_state,$where);
        $user_list = D('user')->user_list($limit,$where);
		
		$user_vip_level = C('USER_VIP_LEVEL');
		$this->assign('user_vip_level',$user_vip_level);
		
        $this->assign('search_state',$search_state);
        $this->assign('user_list',$user_list);
        $this->assign('page',$page_info);
		
        $this->display();	
		
	}
	
	
	//添加用户
	public function user_add(){
		
		if($_POST){
			$data['user_phone'] = isset($_POST['user_phone'])?trim($_POST['user_phone']):'';
			$data['user_pass'] = isset($_POST['user_pass'])?trim($_POST['user_pass']):'';
			$data['user_name'] = isset($_POST['user_name'])?trim($_POST['user_name']):'';
			$data['user_sex'] = isset($_POST['user_sex'])?intval($_POST['user_sex']):0;
			$data['user_birthday'] = !empty($_POST['user_birthday'])?trim($_POST['user_birthday']):'1970-01-01';
			$data['user_status'] = isset($_POST['user_status'])?intval($_POST['user_status']):0;
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/user/origin');
                foreach($images as $key=>$val){
                    $data['user_head'] = com_make_thumb($val,'/Upload/Ttf/user/thumb');
                }
            }			
		
			$data_info['user_ttbi'] = isset($_POST['user_ttbi'])?intval($_POST['user_ttbi']):0;
			$data_info['user_gold'] = isset($_POST['user_gold'])?intval($_POST['user_gold']):0;
			$data_info['user_vip'] = isset($_POST['user_vip'])?intval($_POST['user_vip']):0;
			
			if(empty($data['user_phone']) || empty($data['user_pass'])){
				$this->error('手机和密码不能为空');
				exit;
			}
			if($data['user_name']){
				if(M('user')->where("user_name='".$data['user_name']."'")->find()){
					$this->error('昵称已存在，请重新填写');
					exit;
				}
			}			
			//手机是否已存在
			if(M('user')->where("user_phone='".$data['user_phone']."'")->find()){
				$this->error('手机号码已存在');
				exit;
			}
			//生成数据，插入数据库
			$data['user_pass'] = hex2bin(strtolower(md5($data['user_pass'])));
			if(empty($data['user_name'])) $data['user_name'] = "ttf_".substr($data['user_phone'],0,4)."****".substr($data['user_phone'],7,4);
			$data['user_reg_time'] = date('Y-m-d H:i:s',time());
			
		 	if(D('user')->user_register($data,$data_info)){
				$this->success('注册成功');
			}else{
				$this->error('注册失败');
			}
			
		}else{
			$user_vip_level = C('USER_VIP_LEVEL');
			$user_sex = C('USER_SEX');
			$user_status = C('USER_STATUS');
			$this->assign('user_sex',$user_sex);			
			$this->assign('user_status',$user_status);			
			$this->assign('user_vip_level',$user_vip_level);			
			$this->display();
		}
	}	
	
	//修改用户资料
	public function user_edit(){
		
        if($_POST){
            $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
			if(empty($user_id)) {
				$this->error('没有此用户');
				exit;
			}

			$data['user_name'] = isset($_POST['user_name'])?trim($_POST['user_name']):'';
			$data['user_sex'] = isset($_POST['user_sex'])?intval($_POST['user_sex']):0;
			$data['user_birthday'] = !empty($_POST['user_birthday'])?trim($_POST['user_birthday']):'1970-01-01';
			$data['user_status'] = isset($_POST['user_status'])?intval($_POST['user_status']):0;
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/user/origin');
                foreach($images as $key=>$val){
                    $data['user_head'] = com_make_thumb($val,'/Upload/Ttf/user/thumb');
                }
            }			
			$data_info['user_vip'] = isset($_POST['user_vip'])?intval($_POST['user_vip']):0;
			
			if($data['user_name']){
				if(M('user')->where("user_name='".$data['user_name']."' and user_id !=".$user_id)->find()){
					$this->error('昵称已存在，请重新填写');
					exit;
				}
			}			
		
            if(D('user')->user_edit($data,$data_info,$user_id)){
                $this->success('修改成功!');
            }else{
                $this->error('修改失败');
            }		
		
        }else {
            $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($user_id)) {
				$this->error('没有此用户');
				exit;
			}
			$user = M('user')->where('user_id='.$user_id)->find();
			$user_info = M('user_info')->where('user_id='.$user_id)->find();
			$this->assign('user',$user);
			$this->assign('user_info',$user_info);
			
			$user_vip_level = C('USER_VIP_LEVEL');
			$user_sex = C('USER_SEX');
			$user_status = C('USER_STATUS');
			$this->assign('user_sex',$user_sex);			
			$this->assign('user_status',$user_status);			
			$this->assign('user_vip_level',$user_vip_level);			
			$this->display();
        }			
		
	}	
	
	public function user_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';	
        if($ids){
            if(D('user')->user_del($ids)){
                $this->success('删除成功');
            }else{
				$this->error('删除失败');
			}
        }			
		
	}	
	


}