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
				if($ids_2) $where .= " and ".C('DB_PREFIX')."goods.goods_type in (".$ids_2.")";
		
			}else{
				if($search_id > 0){
					$ids_ = trim(D('type')->get_type_ids(D('type')->type_list($search_id)),',');
					if($ids_) $where .= " and ".C('DB_PREFIX')."goods.goods_type in (".$ids_.")";
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
			
			
			// $top_pid = 0;
			// $sub_pid = 0;
			// if($type_info['type_pid'] > 0){
				// $top_info = M('type')->where('type_id='.$type_info['type_pid'])->find();
				// if($top_info['type_pid'] > 0){
					// $top_pid = $top_info['type_pid'];
					// $sub_pid = $top_info['type_id'];
				// }else{
					// $top_pid = $top_info['type_id'];
				// }
			// }
			// if($sub_pid > 0){
				// $sub_types = D('type')->type_list($top_pid);
				// $this->assign('sub_types',$sub_types);				
			// }
			// $this->assign('top_pid',$top_pid);
			// $this->assign('sub_pid',$sub_pid);

			$types = D('type')->type_list();		
			$this->assign('types',$types);
			$this->assign('goods_info',$goods_info);
			$this->display();
        }			
		
	}	
	
	public function goods_del(){
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if(D('goods')->goods_del($ids)){
                echo 1;
            }
        }			
	}	
	
	
	/********************************************************************************/
	//技能
	public function skill(){
		
		
	}
	
	public function skill_add(){
		
		
	}	
	
	public function skill_edit(){
		
		
	}	
	
	public function skill_del(){
		
		
	}	
		
	
	/********************************************************************************/
	//怪兽
	public function monster(){
		
		
	}
	
	public function monster_add(){
		
		
	}	
	
	public function monster_edit(){
		
		
	}	
	
	public function monster_del(){
		
		
	}		
	



}