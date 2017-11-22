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
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';
        if($ids){
            if(D('type')->type_del($ids)){
                $this->success('删除成功!');
            }else{
				$this->error('删除失败');
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
	
	/********************************************************************************/
	//物品
	public function goods(){		
		
        $goods_name = isset($_GET['goods_name'])?trim($_GET['goods_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
        $search_id = isset($_GET['search_id'])?intval($_GET['search_id']):0;
        $search_id_2 = isset($_GET['search_id_2'])?intval($_GET['search_id_2']):0;
        $search_id_3 = isset($_GET['search_id_3'])?intval($_GET['search_id_3']):0;
		
		$where = '1=1';
		if($goods_name) $where .= " and ".C('DB_PREFIX')."goods.goods_name like '%".$goods_name."%'";		
		if($start_time) $where .= " and ".C('DB_PREFIX')."goods.goods_time >= '".$start_time."'";		
		if($end_time) $where .= " and ".C('DB_PREFIX')."goods.goods_time < '".$end_time."'";		
		if($search_id_3 > 0){
			$where .= " and ".C('DB_PREFIX')."goods.goods_type = ".$search_id_3;
		}else{
			if($search_id_2 > 0){
				$ids_2 = trim(D('type')->get_type_ids(D('type')->type_list($search_id_2)),',');
				if(empty($ids_2)) $ids_2 = -1;
				$ids_2 .= ",".$search_id_2;
				$where .= " and ".C('DB_PREFIX')."goods.goods_type in (".$ids_2.")";
		
			}else{
				if($search_id > 0){
					$ids_ = trim(D('type')->get_type_ids(D('type')->type_list($search_id)),',');
					if(empty($ids_)) $ids_ = -1;
					$ids_ .= ",".$search_id;  					
					$where .= " and ".C('DB_PREFIX')."goods.goods_type in (".$ids_.")";
				}
			}
		}

        $search_state['goods_name'] = $goods_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;		
        $search_state['search_id'] = $search_id;		
        $search_state['search_id_2'] = $search_id_2;		
        $search_state['search_id_3'] = $search_id_3;		
		
		$s_types['one'] = D('type')->type_list();
		if($search_id > 0) $s_types['two'] = D('type')->type_list($search_id);
		if($search_id_2 > 0) $s_types['three'] = D('type')->type_list($search_id_2);
        $this->assign('s_types',$s_types);		
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('goods')->get_limit($page);
        $page_info = D('goods')->goods_page($search_state,$where);
        $goods_list = D('goods')->goods_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('goods_list',$goods_list);
        $this->assign('page',$page_info);
        $this->display();	
		
	}
	
	public function goods_add(){
		
        if($_POST){
			$data['goods_name'] = isset($_POST['goods_name'])?trim($_POST['goods_name']):'';
			$goods_type = isset($_POST['goods_type'])?intval($_POST['goods_type']):0;
			$goods_type_2 = isset($_POST['goods_type_2'])?intval($_POST['goods_type_2']):0;
			$goods_type_3 = isset($_POST['goods_type_3'])?intval($_POST['goods_type_3']):0;
			if($goods_type_3 > 0){
				$goods_type = $goods_type_3;
			}else{
				if($goods_type_2 > 0){
					$goods_type = $goods_type_2;	
				}			
			}
			$data['goods_type'] = $goods_type;
			
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/goods/origin');
                foreach($images as $key=>$val){
                    $data['goods_logo'] = com_make_thumb($val,'/Upload/Ttf/goods/thumb');
                    $all_data[] = $data;
                }
            }
			$data['goods_desc'] = isset($_POST['goods_desc'])?trim($_POST['goods_desc']):'';
			$data['goods_attack'] = isset($_POST['goods_attack'])?intval($_POST['goods_attack']):0;
			$data['goods_magic'] = isset($_POST['goods_magic'])?intval($_POST['goods_magic']):0;
			$data['goods_hp'] = isset($_POST['goods_hp'])?intval($_POST['goods_hp']):0;
			$data['goods_mp'] = isset($_POST['goods_mp'])?intval($_POST['goods_mp']):0;
			$data['goods_attack_defense'] = isset($_POST['goods_attack_defense'])?intval($_POST['goods_attack_defense']):0;
			$data['goods_magic_defense'] = isset($_POST['goods_magic_defense'])?intval($_POST['goods_magic_defense']):0;
			$data['goods_dodge'] = isset($_POST['goods_dodge'])?intval($_POST['goods_dodge']):0;
			$data['goods_direct'] = isset($_POST['goods_direct'])?intval($_POST['goods_direct']):0;
			$data['goods_crit'] = isset($_POST['goods_crit'])?intval($_POST['goods_crit']):0;
			
			$data['goods_time'] = date('Y-m-d H:i:s',time());
			
            if(D('goods')->goods_add($data)){
                $this->success('添加成功!',U('currency/goods'));
            }else{
                $this->error('添加失败');
            }
        }else{
			$types = D('type')->type_list();
            $this->assign('types',$types);
            $this->display();
        }		
		
	}	
	
	public function goods_edit(){
		
        if($_POST){
            $goods_id = isset($_POST['goods_id']) ? intval($_POST['goods_id']) : 0;
			if(empty($goods_id)) {
				$this->error('没有此物品');
				exit;
			}

			$data['goods_name'] = isset($_POST['goods_name'])?trim($_POST['goods_name']):'';
			$goods_type = isset($_POST['goods_type'])?intval($_POST['goods_type']):0;
			$goods_type_2 = isset($_POST['goods_type_2'])?intval($_POST['goods_type_2']):0;
			$goods_type_3 = isset($_POST['goods_type_3'])?intval($_POST['goods_type_3']):0;
			if($goods_type_3 > 0){
				$goods_type = $goods_type_3;
			}else{
				if($goods_type_2 > 0){
					$goods_type = $goods_type_2;	
				}			
			}
			$data['goods_type'] = $goods_type;
			
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/goods/origin');
                foreach($images as $key=>$val){
                    $data['goods_logo'] = com_make_thumb($val,'/Upload/Ttf/goods/thumb');
                    $all_data[] = $data;
                }
            }
			$data['goods_desc'] = isset($_POST['goods_desc'])?trim($_POST['goods_desc']):'';
			$data['goods_attack'] = isset($_POST['goods_attack'])?intval($_POST['goods_attack']):0;
			$data['goods_magic'] = isset($_POST['goods_magic'])?intval($_POST['goods_magic']):0;
			$data['goods_hp'] = isset($_POST['goods_hp'])?intval($_POST['goods_hp']):0;
			$data['goods_mp'] = isset($_POST['goods_mp'])?intval($_POST['goods_mp']):0;
			$data['goods_attack_defense'] = isset($_POST['goods_attack_defense'])?intval($_POST['goods_attack_defense']):0;
			$data['goods_magic_defense'] = isset($_POST['goods_magic_defense'])?intval($_POST['goods_magic_defense']):0;
			$data['goods_dodge'] = isset($_POST['goods_dodge'])?intval($_POST['goods_dodge']):0;
			$data['goods_direct'] = isset($_POST['goods_direct'])?intval($_POST['goods_direct']):0;
			$data['goods_crit'] = isset($_POST['goods_crit'])?intval($_POST['goods_crit']):0;
		
            if(D('goods')->goods_edit($data,$goods_id)){
                $this->success('修改成功!',U('currency/goods'));
            }else{
                $this->error('修改失败');
            }		
		
        }else {
            $goods_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($goods_id)) {
				$this->error('没有此物品');
				exit;
			}
			$goods_info = M('goods')->where('goods_id='.$goods_id)->find();
			
			$type_info = M('type')->where('type_id='.$goods_info['goods_type'])->find();
			
			$type_ids['one'] = 0;
			$type_ids['two'] = 0;
			$type_ids['three'] = 0;
			if($type_info){
				if($type_info['type_pid'] > 0){
					$two_info = M('type')->where('type_id='.$type_info['type_pid'])->find();
					if($two_info['type_pid'] > 0){
						$type_ids['one'] = $two_info['type_pid'];
						$type_ids['two'] = $two_info['type_id'];
						$type_ids['three'] = $type_info['type_id'];
					}else{
						$type_ids['one'] = $two_info['type_id'];
						$type_ids['two'] = $type_info['type_id'];
					}
				}else{
					$type_ids['one'] = $type_info['type_id'];
				}
				if($type_ids['two'] > 0){
					$types_two = D('type')->type_list($type_ids['one']);
					$this->assign('types_two',$types_two);				
				}
				if($type_ids['three'] > 0){
					$types_three = D('type')->type_list($type_ids['two']);
					$this->assign('types_three',$types_three);				
				}				
			}
			$this->assign('type_ids',$type_ids);
			
			$types = D('type')->type_list();		
			$this->assign('types',$types);
			$this->assign('goods_info',$goods_info);
			$this->display();
        }			
		
	}	
	
	public function goods_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';
        if($ids){
            if(D('goods')->goods_del($ids)){
                $this->success('删除成功!');
            }else{
				$this->error('删除失败');
			}
        }			
		
	}	
	
	
	/********************************************************************************/
	//天赋技能
	public function role_skill(){		
		
        $role_skill_name = isset($_GET['role_skill_name'])?trim($_GET['role_skill_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
		
		$where = '1=1';
		if($role_skill_name) $where .= " and role_skill_name like '%".$role_skill_name."%'";		
		if($start_time) $where .= " and role_skill_time >= '".$start_time."'";		
		if($end_time) $where .= " and role_skill_time < '".$end_time."'";		

        $search_state['role_skill_name'] = $role_skill_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;				
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('role_skill')->get_limit($page);
        $page_info = D('role_skill')->role_skill_page($search_state,$where);
        $role_skill_list = D('role_skill')->role_skill_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('role_skill_list',$role_skill_list);
        $this->assign('page',$page_info);
        $this->display();	
		
	}
	
	public function role_skill_add(){
		
        if($_POST){
			$data['role_skill_name'] = isset($_POST['role_skill_name'])?trim($_POST['role_skill_name']):'';
			
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/role_skill/origin');
                foreach($images as $key=>$val){
                    $data['role_skill_logo'] = com_make_thumb($val,'/Upload/Ttf/role_skill/thumb');
                    $all_data[] = $data;
                }
            }
			$data['role_skill_desc'] = isset($_POST['role_skill_desc'])?trim($_POST['role_skill_desc']):'';
			$data['role_skill_attack'] = isset($_POST['role_skill_attack'])?intval($_POST['role_skill_attack']):0;
			$data['role_skill_magic'] = isset($_POST['role_skill_magic'])?intval($_POST['role_skill_magic']):0;
			$data['role_skill_hp'] = isset($_POST['role_skill_hp'])?intval($_POST['role_skill_hp']):0;
			$data['role_skill_mp'] = isset($_POST['role_skill_mp'])?intval($_POST['role_skill_mp']):0;
			$data['role_skill_attack_defense'] = isset($_POST['role_skill_attack_defense'])?intval($_POST['role_skill_attack_defense']):0;
			$data['role_skill_magic_defense'] = isset($_POST['role_skill_magic_defense'])?intval($_POST['role_skill_magic_defense']):0;
			$data['role_skill_dodge'] = isset($_POST['role_skill_dodge'])?intval($_POST['role_skill_dodge']):0;
			$data['role_skill_direct'] = isset($_POST['role_skill_direct'])?intval($_POST['role_skill_direct']):0;
			$data['role_skill_crit'] = isset($_POST['role_skill_crit'])?intval($_POST['role_skill_crit']):0;
			$data['role_skill_hp_regain'] = isset($_POST['role_skill_hp_regain'])?intval($_POST['role_skill_hp_regain']):0;
			$data['role_skill_mp_regain'] = isset($_POST['role_skill_mp_regain'])?intval($_POST['role_skill_mp_regain']):0;
			
			$data['role_skill_time'] = date('Y-m-d H:i:s',time());
			
            if(D('role_skill')->role_skill_add($data)){
                $this->success('添加成功!',U('currency/role_skill'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }			
		
	}	
	
	public function role_skill_edit(){
		
        if($_POST){
            $role_skill_id = isset($_POST['role_skill_id']) ? intval($_POST['role_skill_id']) : 0;
			if(empty($role_skill_id)) {
				$this->error('没有此技能');
				exit;
			}

			$data['role_skill_name'] = isset($_POST['role_skill_name'])?trim($_POST['role_skill_name']):'';
			
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/role_skill/origin');
                foreach($images as $key=>$val){
                    $data['role_skill_logo'] = com_make_thumb($val,'/Upload/Ttf/role_skill/thumb');
                    $all_data[] = $data;
                }
            }
			$data['role_skill_desc'] = isset($_POST['role_skill_desc'])?trim($_POST['role_skill_desc']):'';
			$data['role_skill_attack'] = isset($_POST['role_skill_attack'])?intval($_POST['role_skill_attack']):0;
			$data['role_skill_magic'] = isset($_POST['role_skill_magic'])?intval($_POST['role_skill_magic']):0;
			$data['role_skill_hp'] = isset($_POST['role_skill_hp'])?intval($_POST['role_skill_hp']):0;
			$data['role_skill_mp'] = isset($_POST['role_skill_mp'])?intval($_POST['role_skill_mp']):0;
			$data['role_skill_attack_defense'] = isset($_POST['role_skill_attack_defense'])?intval($_POST['role_skill_attack_defense']):0;
			$data['role_skill_magic_defense'] = isset($_POST['role_skill_magic_defense'])?intval($_POST['role_skill_magic_defense']):0;
			$data['role_skill_dodge'] = isset($_POST['role_skill_dodge'])?intval($_POST['role_skill_dodge']):0;
			$data['role_skill_direct'] = isset($_POST['role_skill_direct'])?intval($_POST['role_skill_direct']):0;
			$data['role_skill_crit'] = isset($_POST['role_skill_crit'])?intval($_POST['role_skill_crit']):0;
			$data['role_skill_hp_regain'] = isset($_POST['role_skill_hp_regain'])?intval($_POST['role_skill_hp_regain']):0;
			$data['role_skill_mp_regain'] = isset($_POST['role_skill_mp_regain'])?intval($_POST['role_skill_mp_regain']):0;
		
            if(D('role_skill')->role_skill_edit($data,$role_skill_id)){
                $this->success('修改成功!',U('currency/role_skill'));
            }else{
                $this->error('修改失败');
            }		
		
        }else {
            $role_skill_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($role_skill_id)) {
				$this->error('没有此技能');
				exit;
			}
			$role_skill_info = M('role_skill')->where('role_skill_id='.$role_skill_id)->find();

			$this->assign('role_skill_info',$role_skill_info);
			$this->display();
        }			
		
	}	
	
	public function role_skill_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';
        if($ids){
            if(D('role_skill')->role_skill_del($ids)){
                $this->success('删除成功!');
            }else{
				$this->error('删除失败');
			}
        }		
		
	}
		

	/********************************************************************************/
	//通用技能
	public function common_skill(){		
		
        $common_skill_name = isset($_GET['common_skill_name'])?trim($_GET['common_skill_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
		
		$where = '1=1';
		if($common_skill_name) $where .= " and common_skill_name like '%".$common_skill_name."%'";		
		if($start_time) $where .= " and common_skill_time >= '".$start_time."'";		
		if($end_time) $where .= " and common_skill_time < '".$end_time."'";		

        $search_state['common_skill_name'] = $common_skill_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;				
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('common_skill')->get_limit($page);
        $page_info = D('common_skill')->common_skill_page($search_state,$where);
        $common_skill_list = D('common_skill')->common_skill_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('common_skill_list',$common_skill_list);
        $this->assign('page',$page_info);
        $this->display();	
		
	}
	
	public function common_skill_add(){
		
        if($_POST){
			$data['common_skill_name'] = isset($_POST['common_skill_name'])?trim($_POST['common_skill_name']):'';
			
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/common_skill/origin');
                foreach($images as $key=>$val){
                    $data['common_skill_logo'] = com_make_thumb($val,'/Upload/Ttf/common_skill/thumb');
                    $all_data[] = $data;
                }
            }
			$data['common_skill_desc'] = isset($_POST['common_skill_desc'])?trim($_POST['common_skill_desc']):'';
			$data['common_skill_attack'] = isset($_POST['common_skill_attack'])?intval($_POST['common_skill_attack']):0;
			$data['common_skill_magic'] = isset($_POST['common_skill_magic'])?intval($_POST['common_skill_magic']):0;
			$data['common_skill_hp'] = isset($_POST['common_skill_hp'])?intval($_POST['common_skill_hp']):0;
			$data['common_skill_mp'] = isset($_POST['common_skill_mp'])?intval($_POST['common_skill_mp']):0;
			$data['common_skill_attack_defense'] = isset($_POST['common_skill_attack_defense'])?intval($_POST['common_skill_attack_defense']):0;
			$data['common_skill_magic_defense'] = isset($_POST['common_skill_magic_defense'])?intval($_POST['common_skill_magic_defense']):0;
			$data['common_skill_dodge'] = isset($_POST['common_skill_dodge'])?intval($_POST['common_skill_dodge']):0;
			$data['common_skill_direct'] = isset($_POST['common_skill_direct'])?intval($_POST['common_skill_direct']):0;
			$data['common_skill_crit'] = isset($_POST['common_skill_crit'])?intval($_POST['common_skill_crit']):0;
			$data['common_skill_hp_regain'] = isset($_POST['common_skill_hp_regain'])?intval($_POST['common_skill_hp_regain']):0;
			$data['common_skill_mp_regain'] = isset($_POST['common_skill_mp_regain'])?intval($_POST['common_skill_mp_regain']):0;
			
			$data['common_skill_time'] = date('Y-m-d H:i:s',time());
			
            if(D('common_skill')->common_skill_add($data)){
                $this->success('添加成功!',U('currency/common_skill'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }			
		
	}	
	
	public function common_skill_edit(){
		
        if($_POST){
            $common_skill_id = isset($_POST['common_skill_id']) ? intval($_POST['common_skill_id']) : 0;
			if(empty($common_skill_id)) {
				$this->error('没有此技能');
				exit;
			}

			$data['common_skill_name'] = isset($_POST['common_skill_name'])?trim($_POST['common_skill_name']):'';
			
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/common_skill/origin');
                foreach($images as $key=>$val){
                    $data['common_skill_logo'] = com_make_thumb($val,'/Upload/Ttf/common_skill/thumb');
                    $all_data[] = $data;
                }
            }
			$data['common_skill_desc'] = isset($_POST['common_skill_desc'])?trim($_POST['common_skill_desc']):'';
			$data['common_skill_attack'] = isset($_POST['common_skill_attack'])?intval($_POST['common_skill_attack']):0;
			$data['common_skill_magic'] = isset($_POST['common_skill_magic'])?intval($_POST['common_skill_magic']):0;
			$data['common_skill_hp'] = isset($_POST['common_skill_hp'])?intval($_POST['common_skill_hp']):0;
			$data['common_skill_mp'] = isset($_POST['common_skill_mp'])?intval($_POST['common_skill_mp']):0;
			$data['common_skill_attack_defense'] = isset($_POST['common_skill_attack_defense'])?intval($_POST['common_skill_attack_defense']):0;
			$data['common_skill_magic_defense'] = isset($_POST['common_skill_magic_defense'])?intval($_POST['common_skill_magic_defense']):0;
			$data['common_skill_dodge'] = isset($_POST['common_skill_dodge'])?intval($_POST['common_skill_dodge']):0;
			$data['common_skill_direct'] = isset($_POST['common_skill_direct'])?intval($_POST['common_skill_direct']):0;
			$data['common_skill_crit'] = isset($_POST['common_skill_crit'])?intval($_POST['common_skill_crit']):0;
			$data['common_skill_hp_regain'] = isset($_POST['common_skill_hp_regain'])?intval($_POST['common_skill_hp_regain']):0;
			$data['common_skill_mp_regain'] = isset($_POST['common_skill_mp_regain'])?intval($_POST['common_skill_mp_regain']):0;
		
            if(D('common_skill')->common_skill_edit($data,$common_skill_id)){
                $this->success('修改成功!',U('currency/common_skill'));
            }else{
                $this->error('修改失败');
            }		
		
        }else {
            $common_skill_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($common_skill_id)) {
				$this->error('没有此技能');
				exit;
			}
			$common_skill_info = M('common_skill')->where('common_skill_id='.$common_skill_id)->find();

			$this->assign('common_skill_info',$common_skill_info);
			$this->display();
        }			
		
	}	
	
	public function common_skill_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';
        if($ids){
            if(D('common_skill')->common_skill_del($ids)){
                $this->success('删除成功!');
            }else{
				$this->error('删除失败');
			}
        }			
		
	}		
		
	
	/********************************************************************************/
	//怪物
	public function monster(){		
		
        $monster_name = isset($_GET['monster_name'])?trim($_GET['monster_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
        $search_id = isset($_GET['search_id'])?intval($_GET['search_id']):0;
        $search_id_2 = isset($_GET['search_id_2'])?intval($_GET['search_id_2']):0;
        $search_id_3 = isset($_GET['search_id_3'])?intval($_GET['search_id_3']):0;
		
		$where = '1=1';
		if($monster_name) $where .= " and ".C('DB_PREFIX')."monster.monster_name like '%".$monster_name."%'";		
		if($start_time) $where .= " and ".C('DB_PREFIX')."monster.monster_time >= '".$start_time."'";		
		if($end_time) $where .= " and ".C('DB_PREFIX')."monster.monster_time < '".$end_time."'";		
		if($search_id_3 > 0){
			$where .= " and ".C('DB_PREFIX')."monster.monster_type = ".$search_id_3;
		}else{
			if($search_id_2 > 0){
				$ids_2 = trim(D('type')->get_type_ids(D('type')->type_list($search_id_2)),',');
				if(empty($ids_2)) $ids_2 = -1;
				$ids_2 .= ",".$search_id_2;
				$where .= " and ".C('DB_PREFIX')."monster.monster_type in (".$ids_2.")";
		
			}else{
				if($search_id > 0){
					$ids_ = trim(D('type')->get_type_ids(D('type')->type_list($search_id)),',');
					if(empty($ids_)) $ids_ = -1;
					$ids_ .= ",".$search_id;  					
					$where .= " and ".C('DB_PREFIX')."monster.monster_type in (".$ids_.")";
				}
			}
		}

        $search_state['monster_name'] = $monster_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;		
        $search_state['search_id'] = $search_id;		
        $search_state['search_id_2'] = $search_id_2;		
        $search_state['search_id_3'] = $search_id_3;		
		
		$s_types['one'] = D('type')->type_list();
		if($search_id > 0) $s_types['two'] = D('type')->type_list($search_id);
		if($search_id_2 > 0) $s_types['three'] = D('type')->type_list($search_id_2);
        $this->assign('s_types',$s_types);		
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('monster')->get_limit($page);
        $page_info = D('monster')->monster_page($search_state,$where);
        $monster_list = D('monster')->monster_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('monster_list',$monster_list);
        $this->assign('page',$page_info);
        $this->display();	
		
	}
	
	public function monster_add(){
		
        if($_POST){
			$data['monster_name'] = isset($_POST['monster_name'])?trim($_POST['monster_name']):'';
			$monster_type = isset($_POST['monster_type'])?intval($_POST['monster_type']):0;
			$monster_type_2 = isset($_POST['monster_type_2'])?intval($_POST['monster_type_2']):0;
			$monster_type_3 = isset($_POST['monster_type_3'])?intval($_POST['monster_type_3']):0;
			if($monster_type_3 > 0){
				$monster_type = $monster_type_3;
			}else{
				if($monster_type_2 > 0){
					$monster_type = $monster_type_2;	
				}			
			}
			$data['monster_type'] = $monster_type;
			
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/monster/origin');
                foreach($images as $key=>$val){
                    $data['monster_logo'] = com_make_thumb($val,'/Upload/Ttf/monster/thumb');
                    $all_data[] = $data;
                }
            }
			
			$com_skill_data[1]['skill'] = isset($_POST['monster_common_skill_id_1'])?intval($_POST['monster_common_skill_id_1']):0;
			$com_skill_data[2]['skill'] = isset($_POST['monster_common_skill_id_2'])?intval($_POST['monster_common_skill_id_2']):0;
			$com_skill_data[3]['skill'] = isset($_POST['monster_common_skill_id_3'])?intval($_POST['monster_common_skill_id_3']):0;
			$com_skill_data[4]['skill'] = isset($_POST['monster_common_skill_id_4'])?intval($_POST['monster_common_skill_id_4']):0;
			$data['monster_common_skill_ids'] = json_encode($com_skill_data);
			$data['monster_role_skill_id'] = isset($_POST['monster_role_skill_id'])?intval($_POST['monster_role_skill_id']):0;			
			$goods_data[1]['goods'] =  isset($_POST['monster_goods_1'])?intval($_POST['monster_goods_1']):0;
			$goods_data[2]['goods'] =  isset($_POST['monster_goods_2'])?intval($_POST['monster_goods_2']):0;
			$goods_data[3]['goods'] =  isset($_POST['monster_goods_3'])?intval($_POST['monster_goods_3']):0;
			$goods_data[4]['goods'] =  isset($_POST['monster_goods_4'])?intval($_POST['monster_goods_4']):0;
			$goods_data[5]['goods'] =  isset($_POST['monster_goods_5'])?intval($_POST['monster_goods_5']):0;
			$goods_data[1]['rate'] =  isset($_POST['monster_goods_1_rate'])?trim($_POST['monster_goods_1_rate']):'';
			$goods_data[2]['rate'] =  isset($_POST['monster_goods_2_rate'])?trim($_POST['monster_goods_2_rate']):'';
			$goods_data[3]['rate'] =  isset($_POST['monster_goods_3_rate'])?trim($_POST['monster_goods_3_rate']):'';
			$goods_data[4]['rate'] =  isset($_POST['monster_goods_4_rate'])?trim($_POST['monster_goods_4_rate']):'';
			$goods_data[5]['rate'] =  isset($_POST['monster_goods_5_rate'])?trim($_POST['monster_goods_5_rate']):'';
			if($goods_data[1]['goods'] == 0) $goods_data[1]['rate'] = '';
			if($goods_data[2]['goods'] == 0) $goods_data[2]['rate'] = '';
			if($goods_data[3]['goods'] == 0) $goods_data[3]['rate'] = '';
			if($goods_data[4]['goods'] == 0) $goods_data[4]['rate'] = '';
			if($goods_data[5]['goods'] == 0) $goods_data[5]['rate'] = '';			
			$data['monster_goods'] = json_encode($goods_data);			
			
			$data['monster_desc'] = isset($_POST['monster_desc'])?trim($_POST['monster_desc']):'';
			$data['monster_attack'] = isset($_POST['monster_attack'])?intval($_POST['monster_attack']):0;
			$data['monster_magic'] = isset($_POST['monster_magic'])?intval($_POST['monster_magic']):0;
			$data['monster_hp'] = isset($_POST['monster_hp'])?intval($_POST['monster_hp']):0;
			$data['monster_mp'] = isset($_POST['monster_mp'])?intval($_POST['monster_mp']):0;
			$data['monster_attack_defense'] = isset($_POST['monster_attack_defense'])?intval($_POST['monster_attack_defense']):0;
			$data['monster_magic_defense'] = isset($_POST['monster_magic_defense'])?intval($_POST['monster_magic_defense']):0;
			$data['monster_dodge'] = isset($_POST['monster_dodge'])?intval($_POST['monster_dodge']):0;
			$data['monster_direct'] = isset($_POST['monster_direct'])?intval($_POST['monster_direct']):0;
			$data['monster_crit'] = isset($_POST['monster_crit'])?intval($_POST['monster_crit']):0;
			$data['monster_time'] = date('Y-m-d H:i:s',time());
			
            if(D('monster')->monster_add($data)){
                $this->success('添加成功!',U('currency/monster'));
            }else{
                $this->error('添加失败');
            }
        }else{
			$types = D('type')->type_list();
            $this->assign('types',$types);
            $this->display();
        }			
		
	}	
	
	public function monster_edit(){
		
        if($_POST){
            $monster_id = isset($_POST['monster_id']) ? intval($_POST['monster_id']) : 0;
			if(empty($monster_id)) {
				$this->error('没有此怪物');
				exit;
			}

			$data['monster_name'] = isset($_POST['monster_name'])?trim($_POST['monster_name']):'';
			$monster_type = isset($_POST['monster_type'])?intval($_POST['monster_type']):0;
			$monster_type_2 = isset($_POST['monster_type_2'])?intval($_POST['monster_type_2']):0;
			$monster_type_3 = isset($_POST['monster_type_3'])?intval($_POST['monster_type_3']):0;
			if($monster_type_3 > 0){
				$monster_type = $monster_type_3;
			}else{
				if($monster_type_2 > 0){
					$monster_type = $monster_type_2;	
				}			
			}
			$data['monster_type'] = $monster_type;
			
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/monster/origin');
                foreach($images as $key=>$val){
                    $data['monster_logo'] = com_make_thumb($val,'/Upload/Ttf/monster/thumb');
                    $all_data[] = $data;
                }
            }
			
			$com_skill_data[1]['skill'] = isset($_POST['monster_common_skill_id_1'])?intval($_POST['monster_common_skill_id_1']):0;
			$com_skill_data[2]['skill'] = isset($_POST['monster_common_skill_id_2'])?intval($_POST['monster_common_skill_id_2']):0;
			$com_skill_data[3]['skill'] = isset($_POST['monster_common_skill_id_3'])?intval($_POST['monster_common_skill_id_3']):0;
			$com_skill_data[4]['skill'] = isset($_POST['monster_common_skill_id_4'])?intval($_POST['monster_common_skill_id_4']):0;
			$data['monster_common_skill_ids'] = json_encode($com_skill_data);
			$data['monster_role_skill_id'] = isset($_POST['monster_role_skill_id'])?intval($_POST['monster_role_skill_id']):0;			
			$goods_data[1]['goods'] =  isset($_POST['monster_goods_1'])?intval($_POST['monster_goods_1']):0;
			$goods_data[2]['goods'] =  isset($_POST['monster_goods_2'])?intval($_POST['monster_goods_2']):0;
			$goods_data[3]['goods'] =  isset($_POST['monster_goods_3'])?intval($_POST['monster_goods_3']):0;
			$goods_data[4]['goods'] =  isset($_POST['monster_goods_4'])?intval($_POST['monster_goods_4']):0;
			$goods_data[5]['goods'] =  isset($_POST['monster_goods_5'])?intval($_POST['monster_goods_5']):0;
			$goods_data[1]['rate'] =  isset($_POST['monster_goods_1_rate'])?trim($_POST['monster_goods_1_rate']):'';
			$goods_data[2]['rate'] =  isset($_POST['monster_goods_2_rate'])?trim($_POST['monster_goods_2_rate']):'';
			$goods_data[3]['rate'] =  isset($_POST['monster_goods_3_rate'])?trim($_POST['monster_goods_3_rate']):'';
			$goods_data[4]['rate'] =  isset($_POST['monster_goods_4_rate'])?trim($_POST['monster_goods_4_rate']):'';
			$goods_data[5]['rate'] =  isset($_POST['monster_goods_5_rate'])?trim($_POST['monster_goods_5_rate']):'';
			if($goods_data[1]['goods'] == 0) $goods_data[1]['rate'] = '';
			if($goods_data[2]['goods'] == 0) $goods_data[2]['rate'] = '';
			if($goods_data[3]['goods'] == 0) $goods_data[3]['rate'] = '';
			if($goods_data[4]['goods'] == 0) $goods_data[4]['rate'] = '';
			if($goods_data[5]['goods'] == 0) $goods_data[5]['rate'] = '';
			$data['monster_goods'] = json_encode($goods_data);			
			
			$data['monster_desc'] = isset($_POST['monster_desc'])?trim($_POST['monster_desc']):'';
			$data['monster_attack'] = isset($_POST['monster_attack'])?intval($_POST['monster_attack']):0;
			$data['monster_magic'] = isset($_POST['monster_magic'])?intval($_POST['monster_magic']):0;
			$data['monster_hp'] = isset($_POST['monster_hp'])?intval($_POST['monster_hp']):0;
			$data['monster_mp'] = isset($_POST['monster_mp'])?intval($_POST['monster_mp']):0;
			$data['monster_attack_defense'] = isset($_POST['monster_attack_defense'])?intval($_POST['monster_attack_defense']):0;
			$data['monster_magic_defense'] = isset($_POST['monster_magic_defense'])?intval($_POST['monster_magic_defense']):0;
			$data['monster_dodge'] = isset($_POST['monster_dodge'])?intval($_POST['monster_dodge']):0;
			$data['monster_direct'] = isset($_POST['monster_direct'])?intval($_POST['monster_direct']):0;
			$data['monster_crit'] = isset($_POST['monster_crit'])?intval($_POST['monster_crit']):0;		
		
            if(D('monster')->monster_edit($data,$monster_id)){
                $this->success('修改成功!',U('currency/monster'));
            }else{
                $this->error('修改失败');
            }		
		
        }else {
            $monster_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($monster_id)) {
				$this->error('没有此怪物');
				exit;
			}
			$monster_info = M('monster')->where('monster_id='.$monster_id)->find();
			$type_info = M('type')->where('type_id='.$monster_info['monster_type'])->find();
			
			if($monster_info['monster_role_skill_id'] > 0){
				$monster_info['monster_role_skill_name'] = D('role_skill')->get_name($monster_info['monster_role_skill_id']);
			}else{
				$monster_info['monster_role_skill_name'] = '无';
			}
			$monster_info['monster_common_skill_ids_arr'] = json_decode($monster_info['monster_common_skill_ids'],true);		
			$monster_info['monster_goods_arr'] = json_decode($monster_info['monster_goods'],true);		
			foreach($monster_info['monster_common_skill_ids_arr'] as $key=>$value){
				if($value['skill'] > 0){
					$monster_info['monster_common_skill_ids_arr'][$key]['skill_name'] = D('common_skill')->get_name($value['skill']);
				}else{
					$monster_info['monster_common_skill_ids_arr'][$key]['skill_name'] = '无';
				}
			}
			foreach($monster_info['monster_goods_arr'] as $key=>$value){
				if($value['goods'] > 0){
					$monster_info['monster_goods_arr'][$key]['goods_name'] = D('goods')->get_name($value['goods']);
				}else{
					$monster_info['monster_goods_arr'][$key]['goods_name'] = '无';
				}				
				
			}
					
			$type_ids['one'] = 0;
			$type_ids['two'] = 0;
			$type_ids['three'] = 0;
			if($type_info){
				if($type_info['type_pid'] > 0){
					$two_info = M('type')->where('type_id='.$type_info['type_pid'])->find();
					if($two_info['type_pid'] > 0){
						$type_ids['one'] = $two_info['type_pid'];
						$type_ids['two'] = $two_info['type_id'];
						$type_ids['three'] = $type_info['type_id'];
					}else{
						$type_ids['one'] = $two_info['type_id'];
						$type_ids['two'] = $type_info['type_id'];
					}
				}else{
					$type_ids['one'] = $type_info['type_id'];
				}
				if($type_ids['two'] > 0){
					$types_two = D('type')->type_list($type_ids['one']);
					$this->assign('types_two',$types_two);				
				}
				if($type_ids['three'] > 0){
					$types_three = D('type')->type_list($type_ids['two']);
					$this->assign('types_three',$types_three);				
				}				
			}
			$this->assign('type_ids',$type_ids);
			
			$types = D('type')->type_list();		
			$this->assign('types',$types);
			$this->assign('monster_info',$monster_info);
			$this->display();
        }			
		
	}	
	
	public function monster_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';
        if(D('monster')->monster_del($ids)){
			$this->success('删除成功!');
		}else{
			$this->error('删除失败');
		}
	}	
	

}