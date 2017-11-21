<?php
namespace Ttfadmin\Controller;
use Think\Controller;
class SelectController extends CommonController {

	//选择天赋技能
    public function select_role_skill(){
		
        $role_skill_name = isset($_GET['role_skill_name'])?trim($_GET['role_skill_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
        $id_name = isset($_GET['id_name'])?trim($_GET['id_name']):'';
		
		$where = '1=1';
		if($role_skill_name) $where .= " and role_skill_name like '%".$role_skill_name."%'";		
		if($start_time) $where .= " and role_skill_time >= '".$start_time."'";		
		if($end_time) $where .= " and role_skill_time < '".$end_time."'";		

        $search_state['role_skill_name'] = $role_skill_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;				
        $search_state['id_name'] = $id_name;				
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('role_skill')->get_limit($page);
        $page_info = D('role_skill')->select_role_skill_page($search_state,$where);
        $role_skill_list = D('role_skill')->role_skill_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('role_skill_list',$role_skill_list);
        $this->assign('page',$page_info);
        $this->display();
    }
	
	//选择通用技能
    public function select_common_skill(){
        $common_skill_name = isset($_GET['common_skill_name'])?trim($_GET['common_skill_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
        $id_name = isset($_GET['id_name'])?trim($_GET['id_name']):'';
		
		$where = '1=1';
		if($common_skill_name) $where .= " and common_skill_name like '%".$common_skill_name."%'";		
		if($start_time) $where .= " and common_skill_time >= '".$start_time."'";		
		if($end_time) $where .= " and common_skill_time < '".$end_time."'";		

        $search_state['common_skill_name'] = $common_skill_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;				
        $search_state['id_name'] = $id_name;				
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('common_skill')->get_limit($page);
        $page_info = D('common_skill')->select_common_skill_page($search_state,$where);
        $common_skill_list = D('common_skill')->common_skill_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('common_skill_list',$common_skill_list);
        $this->assign('page',$page_info);
        $this->display();
    }
	
	//选择物品
    public function select_goods(){
        $goods_name = isset($_GET['goods_name'])?trim($_GET['goods_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
        $search_id = isset($_GET['search_id'])?intval($_GET['search_id']):0;
        $search_id_2 = isset($_GET['search_id_2'])?intval($_GET['search_id_2']):0;
        $search_id_3 = isset($_GET['search_id_3'])?intval($_GET['search_id_3']):0;
		$id_name = isset($_GET['id_name'])?trim($_GET['id_name']):'';
		
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
        $search_state['id_name'] = $id_name;		
		
		$s_types['one'] = D('type')->type_list();
		if($search_id > 0) $s_types['two'] = D('type')->type_list($search_id);
		if($search_id_2 > 0) $s_types['three'] = D('type')->type_list($search_id_2);
        $this->assign('s_types',$s_types);		
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('goods')->get_limit($page);
        $page_info = D('goods')->select_goods_page($search_state,$where);
        $goods_list = D('goods')->goods_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('goods_list',$goods_list);
        $this->assign('page',$page_info);
        $this->display();		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}