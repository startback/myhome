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
	

	/********************************************************************************/
	//用户角色
	public function user_role(){		
		
        $user_name = isset($_GET['user_name'])?trim($_GET['user_name']):'';
        $user_role_name = isset($_GET['user_role_name'])?trim($_GET['user_role_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';

		$where = '1=1';
		if($user_name) $where .= " and ".C('DB_PREFIX')."user.user_name like '%".$user_name."%'";		
		if($user_role_name) $where .= " and ".C('DB_PREFIX')."role.role_name like '%".$user_role_name."%'";		
		if($start_time) $where .= " and ".C('DB_PREFIX')."user_role.add_time >= '".$start_time."'";		
		if($end_time) $where .= " and ".C('DB_PREFIX')."user_role.add_time < '".$end_time."'";	

        $search_state['user_name'] = $user_name;
        $search_state['user_role_name'] = $user_role_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;						
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('user_role')->get_limit($page);
        $page_info = D('user_role')->user_role_page($search_state,$where);
        $user_role_list = D('user_role')->user_role_list($limit,$where);
				
        $this->assign('search_state',$search_state);
        $this->assign('user_role_list',$user_role_list);
        $this->assign('page',$page_info);
		
        $this->display();	
		
	}
	
	
	//添加用户角色
	public function user_role_add(){
		
		if($_POST){
			$data['role_id'] = isset($_POST['role_id'])?intval($_POST['role_id']):0;
			$data['user_id'] = isset($_POST['user_id'])?intval($_POST['user_id']):0;
			$data['experience'] = isset($_POST['experience'])?intval($_POST['experience']):0;
			$data['level'] = isset($_POST['level'])?intval($_POST['level']):0;
			$data['attack'] = isset($_POST['attack'])?intval($_POST['attack']):0;
			$data['magic'] = isset($_POST['magic'])?intval($_POST['magic']):0;
			$data['hp'] = isset($_POST['hp'])?intval($_POST['hp']):0;
			$data['mp'] = isset($_POST['mp'])?intval($_POST['mp']):0;
			$data['attack_defense'] = isset($_POST['attack_defense'])?intval($_POST['attack_defense']):0;
			$data['magic_defense'] = isset($_POST['magic_defense'])?intval($_POST['magic_defense']):0;
			$data['dodge'] = isset($_POST['dodge'])?intval($_POST['dodge']):0;
			$data['direct'] = isset($_POST['direct'])?intval($_POST['direct']):0;
			$data['crit'] = isset($_POST['crit'])?intval($_POST['crit']):0;			
			$data['role_skill_id'] = isset($_POST['role_skill_id'])?intval($_POST['role_skill_id']):0;			
			$data['role_skill_level'] = isset($_POST['role_skill_level'])?intval($_POST['role_skill_level']):0;			
			$skill_id_data[1]['skill'] = isset($_POST['skill_id_1'])?intval($_POST['skill_id_1']):0;
			$skill_id_data[2]['skill'] = isset($_POST['skill_id_2'])?intval($_POST['skill_id_2']):0;
			$skill_id_data[3]['skill'] = isset($_POST['skill_id_3'])?intval($_POST['skill_id_3']):0;
			$skill_id_data[4]['skill'] = isset($_POST['skill_id_4'])?intval($_POST['skill_id_4']):0;
			$skill_id_data[1]['level'] = isset($_POST['skill_id_1_level'])?intval($_POST['skill_id_1_level']):0;
			$skill_id_data[2]['level'] = isset($_POST['skill_id_2_level'])?intval($_POST['skill_id_2_level']):0;
			$skill_id_data[3]['level'] = isset($_POST['skill_id_3_level'])?intval($_POST['skill_id_3_level']):0;
			$skill_id_data[4]['level'] = isset($_POST['skill_id_4_level'])?intval($_POST['skill_id_4_level']):0;
			$data['skill_ids'] = json_encode($skill_id_data);		
			$data['add_time'] = date('Y-m-d H:i:s',time());
			
			if($data['role_id'] == 0 || $data['user_id'] == 0){
				$this->error('请选择角色或用户');
				exit;
			}
			
            if(D('user_role')->user_role_add($data)){
                $this->success('添加成功!',U('Usermanage/user_role'));
            }else{
                $this->error('添加失败');
            }
			
		}else{			
			$role_skill_levels = C('ROLE_SKILL_LEVEL');
			$common_skill_levels = C('COMMON_SKILL_LEVEL');
			$this->assign('role_skill_levels',$role_skill_levels);
			$this->assign('common_skill_levels',$common_skill_levels);			
			$this->display();
		}
	}	
	
	//修改用户角色资料
	public function user_role_edit(){
		
        if($_POST){
            $user_role_id = isset($_POST['user_role_id']) ? intval($_POST['user_role_id']) : 0;

			$data['role_id'] = isset($_POST['role_id'])?intval($_POST['role_id']):0;
			$data['user_id'] = isset($_POST['user_id'])?intval($_POST['user_id']):0;
			$data['experience'] = isset($_POST['experience'])?intval($_POST['experience']):0;
			$data['level'] = isset($_POST['level'])?intval($_POST['level']):0;			
			$data['attack'] = isset($_POST['attack'])?intval($_POST['attack']):0;
			$data['magic'] = isset($_POST['magic'])?intval($_POST['magic']):0;
			$data['hp'] = isset($_POST['hp'])?intval($_POST['hp']):0;
			$data['mp'] = isset($_POST['mp'])?intval($_POST['mp']):0;
			$data['attack_defense'] = isset($_POST['attack_defense'])?intval($_POST['attack_defense']):0;
			$data['magic_defense'] = isset($_POST['magic_defense'])?intval($_POST['magic_defense']):0;
			$data['dodge'] = isset($_POST['dodge'])?intval($_POST['dodge']):0;
			$data['direct'] = isset($_POST['direct'])?intval($_POST['direct']):0;
			$data['crit'] = isset($_POST['crit'])?intval($_POST['crit']):0;		
			$data['role_skill_id'] = isset($_POST['role_skill_id'])?intval($_POST['role_skill_id']):0;			
			$data['role_skill_level'] = isset($_POST['role_skill_level'])?intval($_POST['role_skill_level']):0;				
			$skill_id_data[1]['skill'] = isset($_POST['skill_id_1'])?intval($_POST['skill_id_1']):0;
			$skill_id_data[2]['skill'] = isset($_POST['skill_id_2'])?intval($_POST['skill_id_2']):0;
			$skill_id_data[3]['skill'] = isset($_POST['skill_id_3'])?intval($_POST['skill_id_3']):0;
			$skill_id_data[4]['skill'] = isset($_POST['skill_id_4'])?intval($_POST['skill_id_4']):0;
			$skill_id_data[1]['level'] = isset($_POST['skill_id_1_level'])?intval($_POST['skill_id_1_level']):0;
			$skill_id_data[2]['level'] = isset($_POST['skill_id_2_level'])?intval($_POST['skill_id_2_level']):0;
			$skill_id_data[3]['level'] = isset($_POST['skill_id_3_level'])?intval($_POST['skill_id_3_level']):0;
			$skill_id_data[4]['level'] = isset($_POST['skill_id_4_level'])?intval($_POST['skill_id_4_level']):0;			
			$data['skill_ids'] = json_encode($skill_id_data);
			
			if($data['role_id'] == 0 || $data['user_id'] == 0){
				$this->error('请选择角色或用户');
				exit;
			}
			
            if(D('user_role')->user_role_edit($data,$user_role_id)){
                $this->success('修改成功!',U('Usermanage/user_role'));
            }else{
                $this->error('修改失败');
            }			
		
        }else {
            $user_role_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($user_role_id)) {
				$this->error('没有此用户角色');
				exit;
			}
			$user_role = M('user_role')->field(C('DB_PREFIX').'user_role.*,'.C('DB_PREFIX').'user.user_name,'.C('DB_PREFIX').'role.role_name,'.C('DB_PREFIX').'role_skill.role_skill_name')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'user_role.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'role ON '.C('DB_PREFIX').'user_role.role_id = '.C('DB_PREFIX').'role.role_id')->join('left join '.C('DB_PREFIX').'role_skill ON '.C('DB_PREFIX').'user_role.role_skill_id = '.C('DB_PREFIX').'role_skill.role_skill_id')->where('user_role_id='.$user_role_id)->find();
			$user_role['skill_ids_arr'] = json_decode($user_role['skill_ids'],true);
			foreach($user_role['skill_ids_arr'] as $key=>$value){
				if($value['skill'] > 0){
					$user_role['skill_ids_arr'][$key]['skill_name'] = D('common_skill')->get_name($value['skill']);
				}else{
					$user_role['skill_ids_arr'][$key]['skill_name'] = '无';
				}
			}			
			$role_skill_levels = C('ROLE_SKILL_LEVEL');
			$common_skill_levels = C('COMMON_SKILL_LEVEL');
			$this->assign('role_skill_levels',$role_skill_levels);
			$this->assign('common_skill_levels',$common_skill_levels);			
			$this->assign('user_role',$user_role);
			$this->display();
        }			
		
	}	
	
	public function user_role_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';	
        if($ids){
            if(D('user_role')->user_role_del($ids)){
                $this->success('删除成功');
            }else{
				$this->error('删除失败');
			}
        }			
		
	}		
	

	/********************************************************************************/
	//用户物品
	public function user_goods(){		
		
        $user_name = isset($_GET['user_name'])?trim($_GET['user_name']):'';
        $user_goods_name = isset($_GET['user_goods_name'])?trim($_GET['user_goods_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';

		$where = '1=1';
		if($user_name) $where .= " and ".C('DB_PREFIX')."user.user_name like '%".$user_name."%'";		
		if($user_goods_name) $where .= " and ".C('DB_PREFIX')."goods.goods_name like '%".$user_goods_name."%'";		
		if($start_time) $where .= " and ".C('DB_PREFIX')."user_goods.add_time >= '".$start_time."'";		
		if($end_time) $where .= " and ".C('DB_PREFIX')."user_goods.add_time < '".$end_time."'";	

        $search_state['user_name'] = $user_name;
        $search_state['user_goods_name'] = $user_goods_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;						
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('user_goods')->get_limit($page);
        $page_info = D('user_goods')->user_goods_page($search_state,$where);
        $user_goods_list = D('user_goods')->user_goods_list($limit,$where);
			
        $this->assign('search_state',$search_state);
        $this->assign('user_goods_list',$user_goods_list);
        $this->assign('page',$page_info);

        $this->display();	
		
	}
	
	
	//添加用户物品
	public function user_goods_add(){
		
		if($_POST){
			$data['goods_id'] = isset($_POST['goods_id'])?intval($_POST['goods_id']):0;
			$data['user_id'] = isset($_POST['user_id'])?intval($_POST['user_id']):0;
			$data['attack'] = isset($_POST['attack'])?intval($_POST['attack']):0;
			$data['magic'] = isset($_POST['magic'])?intval($_POST['magic']):0;
			$data['hp'] = isset($_POST['hp'])?intval($_POST['hp']):0;
			$data['mp'] = isset($_POST['mp'])?intval($_POST['mp']):0;
			$data['attack_defense'] = isset($_POST['attack_defense'])?intval($_POST['attack_defense']):0;
			$data['magic_defense'] = isset($_POST['magic_defense'])?intval($_POST['magic_defense']):0;
			$data['dodge'] = isset($_POST['dodge'])?intval($_POST['dodge']):0;
			$data['direct'] = isset($_POST['direct'])?intval($_POST['direct']):0;
			$data['crit'] = isset($_POST['crit'])?intval($_POST['crit']):0;			
			$data['add_experience'] = isset($_POST['add_experience'])?intval($_POST['add_experience']):0;			
			$data['skill_id'] = isset($_POST['skill_id'])?intval($_POST['skill_id']):0;			
			$data['add_time'] = date('Y-m-d H:i:s',time());
			
			if($data['goods_id'] == 0 || $data['user_id'] == 0){
				$this->error('请选择物品和用户');
				exit;
			}
			
            if(D('user_goods')->user_goods_add($data)){
                $this->success('添加成功!',U('Usermanage/user_goods'));
            }else{
                $this->error('添加失败');
            }
			
		}else{			
			$this->display();
		}
	}	
	
	//修改用户物品资料
	public function user_goods_edit(){
		
        if($_POST){
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

			$data['goods_id'] = isset($_POST['goods_id'])?intval($_POST['goods_id']):0;
			$data['user_id'] = isset($_POST['user_id'])?intval($_POST['user_id']):0;
			$data['attack'] = isset($_POST['attack'])?intval($_POST['attack']):0;
			$data['magic'] = isset($_POST['magic'])?intval($_POST['magic']):0;
			$data['hp'] = isset($_POST['hp'])?intval($_POST['hp']):0;
			$data['mp'] = isset($_POST['mp'])?intval($_POST['mp']):0;
			$data['attack_defense'] = isset($_POST['attack_defense'])?intval($_POST['attack_defense']):0;
			$data['magic_defense'] = isset($_POST['magic_defense'])?intval($_POST['magic_defense']):0;
			$data['dodge'] = isset($_POST['dodge'])?intval($_POST['dodge']):0;
			$data['direct'] = isset($_POST['direct'])?intval($_POST['direct']):0;
			$data['crit'] = isset($_POST['crit'])?intval($_POST['crit']):0;		
			$data['add_experience'] = isset($_POST['add_experience'])?intval($_POST['add_experience']):0;			
			$data['skill_id'] = isset($_POST['skill_id'])?intval($_POST['skill_id']):0;	
			
			if($data['goods_id'] == 0 || $data['user_id'] == 0){
				$this->error('请选择物品和用户');
				exit;
			}
			
            if(D('user_goods')->user_goods_edit($data,$id)){
                $this->success('修改成功!',U('Usermanage/user_goods'));
            }else{
                $this->error('修改失败');
            }			
		
        }else {
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($id)) {
				$this->error('没有此用户物品');
				exit;
			}
			$user_goods = M('user_goods')->field(C('DB_PREFIX').'user_goods.*,'.C('DB_PREFIX').'user.user_name,'.C('DB_PREFIX').'goods.goods_name')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'user_goods.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'goods ON '.C('DB_PREFIX').'user_goods.goods_id = '.C('DB_PREFIX').'goods.goods_id')->where('id='.$id)->find();	
			if($user_goods['skill_id'] > 0){
				$skill_info = M('common_skill')->where('common_skill_id='.$user_goods['skill_id'])->find();
				$user_goods['skill_name'] = $skill_info['common_skill_name'];
			}else{
				$user_goods['skill_name'] = "无";
			}
			
			$this->assign('user_goods',$user_goods);
			$this->display();
        }			
		
	}	
	
	public function user_goods_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';	
        if($ids){
            if(D('user_goods')->user_goods_del($ids)){
                $this->success('删除成功');
            }else{
				$this->error('删除失败');
			}
        }			
		
	}			
	
	
	/********************************************************************************/
	//用户怪物
	public function user_monster(){		
		
        $user_name = isset($_GET['user_name'])?trim($_GET['user_name']):'';
        $user_monster_name = isset($_GET['user_monster_name'])?trim($_GET['user_monster_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';

		$where = '1=1';
		if($user_name) $where .= " and ".C('DB_PREFIX')."user.user_name like '%".$user_name."%'";		
		if($user_monster_name) $where .= " and ".C('DB_PREFIX')."monster.monster_name like '%".$user_monster_name."%'";		
		if($start_time) $where .= " and ".C('DB_PREFIX')."user_monster.add_time >= '".$start_time."'";		
		if($end_time) $where .= " and ".C('DB_PREFIX')."user_monster.add_time < '".$end_time."'";	

        $search_state['user_name'] = $user_name;
        $search_state['user_monster_name'] = $user_monster_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;						
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('user_monster')->get_limit($page);
        $page_info = D('user_monster')->user_monster_page($search_state,$where);
        $user_monster_list = D('user_monster')->user_monster_list($limit,$where);
			
        $this->assign('search_state',$search_state);
        $this->assign('user_monster_list',$user_monster_list);
        $this->assign('page',$page_info);

        $this->display();	
		
	}
	
	
	//添加用户怪物
	public function user_monster_add(){
		
		if($_POST){
			$data['monster_id'] = isset($_POST['monster_id'])?intval($_POST['monster_id']):0;
			$data['user_id'] = isset($_POST['user_id'])?intval($_POST['user_id']):0;
			$data['monster_level'] = isset($_POST['monster_level'])?intval($_POST['monster_level']):0;
			$data['monster_experience'] = isset($_POST['monster_experience'])?intval($_POST['monster_experience']):0;
			$data['attack'] = isset($_POST['attack'])?intval($_POST['attack']):0;
			$data['magic'] = isset($_POST['magic'])?intval($_POST['magic']):0;
			$data['hp'] = isset($_POST['hp'])?intval($_POST['hp']):0;
			$data['mp'] = isset($_POST['mp'])?intval($_POST['mp']):0;
			$data['attack_defense'] = isset($_POST['attack_defense'])?intval($_POST['attack_defense']):0;
			$data['magic_defense'] = isset($_POST['magic_defense'])?intval($_POST['magic_defense']):0;
			$data['dodge'] = isset($_POST['dodge'])?intval($_POST['dodge']):0;
			$data['direct'] = isset($_POST['direct'])?intval($_POST['direct']):0;
			$data['crit'] = isset($_POST['crit'])?intval($_POST['crit']):0;		
			$data['skill_ids'] = isset($_POST['skill_id'])?intval($_POST['skill_id']):0;		
			$data['add_time'] = date('Y-m-d H:i:s',time());
			
			if($data['monster_id'] == 0 || $data['user_id'] == 0){
				$this->error('请选择怪物和用户');
				exit;
			}
			
            if(D('user_monster')->user_monster_add($data)){
                $this->success('添加成功!',U('Usermanage/user_monster'));
            }else{
                $this->error('添加失败');
            }
			
		}else{			
			$this->display();
		}
	}	
	
	//修改用户怪物资料
	public function user_monster_edit(){
		
        if($_POST){
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

			$data['monster_id'] = isset($_POST['monster_id'])?intval($_POST['monster_id']):0;
			$data['user_id'] = isset($_POST['user_id'])?intval($_POST['user_id']):0;
			$data['monster_level'] = isset($_POST['monster_level'])?intval($_POST['monster_level']):0;
			$data['monster_experience'] = isset($_POST['monster_experience'])?intval($_POST['monster_experience']):0;			
			$data['attack'] = isset($_POST['attack'])?intval($_POST['attack']):0;
			$data['magic'] = isset($_POST['magic'])?intval($_POST['magic']):0;
			$data['hp'] = isset($_POST['hp'])?intval($_POST['hp']):0;
			$data['mp'] = isset($_POST['mp'])?intval($_POST['mp']):0;
			$data['attack_defense'] = isset($_POST['attack_defense'])?intval($_POST['attack_defense']):0;
			$data['magic_defense'] = isset($_POST['magic_defense'])?intval($_POST['magic_defense']):0;
			$data['dodge'] = isset($_POST['dodge'])?intval($_POST['dodge']):0;
			$data['direct'] = isset($_POST['direct'])?intval($_POST['direct']):0;
			$data['crit'] = isset($_POST['crit'])?intval($_POST['crit']):0;		
			$data['skill_ids'] = isset($_POST['skill_id'])?intval($_POST['skill_id']):0;
			
			if($data['monster_id'] == 0 || $data['user_id'] == 0){
				$this->error('请选择怪物和用户');
				exit;
			}
			
            if(D('user_monster')->user_monster_edit($data,$id)){
                $this->success('修改成功!',U('Usermanage/user_monster'));
            }else{
                $this->error('修改失败');
            }			
		
        }else {
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($id)) {
				$this->error('没有此用户怪物');
				exit;
			}
			$user_monster = M('user_monster')->field(C('DB_PREFIX').'user_monster.*,'.C('DB_PREFIX').'user.user_name,'.C('DB_PREFIX').'monster.monster_name')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'user_monster.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'monster ON '.C('DB_PREFIX').'user_monster.monster_id = '.C('DB_PREFIX').'monster.monster_id')->where('id='.$id)->find();	
			
			$this->assign('user_monster',$user_monster);
			$this->display();
        }			
		
	}	
	
	public function user_monster_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';	
        if($ids){
            if(D('user_monster')->user_monster_del($ids)){
                $this->success('删除成功');
            }else{
				$this->error('删除失败');
			}
        }			
		
	}		
	

}