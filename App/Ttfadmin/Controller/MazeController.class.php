<?php
namespace Ttfadmin\Controller;
use Think\Controller;
class MazeController extends CommonController {
	
	/********************************************************************************/
	//迷宫
	public function maze(){		
		
        $maze_name = isset($_GET['maze_name'])?trim($_GET['maze_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
		
		$where = '1=1';
		if($maze_name) $where .= " and maze_name like '%".$maze_name."%'";				
		if($start_time) $where .= " and maze_time >= '".$start_time."'";		
		if($end_time) $where .= " and maze_time < '".$end_time."'";	

        $search_state['maze_name'] = $maze_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;						
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('maze')->get_limit($page);
        $page_info = D('maze')->maze_page($search_state,$where);
        $maze_list = D('maze')->maze_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('maze_list',$maze_list);
        $this->assign('page',$page_info);
		
        $this->display();	
		
	}
	
	
	//添加迷宫
	public function maze_add(){
		
		if($_POST){
			$data['maze_name'] = isset($_POST['maze_name'])?trim($_POST['maze_name']):'';
			$data['maze_desc'] = isset($_POST['maze_desc'])?trim($_POST['maze_desc']):'';
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/maze/origin');
                foreach($images as $key=>$val){
                    $data['maze_logo'] = com_make_thumb($val,'/Upload/Ttf/maze/thumb');
                }
            }			
			$data['maze_time'] = date('Y-m-d H:i:s',time());
			
		 	if(D('maze')->maze_add($data)){
				$this->success('添加成功',U('maze/maze'));
			}else{
				$this->error('添加失败');
			}
			
		}else{			
			$this->display();
		}
		
	}	
	
	//修改迷宫资料
	public function maze_edit(){
		
        if($_POST){
            $maze_id = isset($_POST['maze_id']) ? intval($_POST['maze_id']) : 0;
			if(empty($maze_id)) {
				$this->error('没有此迷宫');
				exit;
			}

			$data['maze_name'] = isset($_POST['maze_name'])?trim($_POST['maze_name']):'';
			$data['maze_desc'] = isset($_POST['maze_desc'])?trim($_POST['maze_desc']):'';
            if($_FILES){
                $images = com_save_file($_FILES,'/Upload/Ttf/maze/origin');
                foreach($images as $key=>$val){
                    $data['maze_logo'] = com_make_thumb($val,'/Upload/Ttf/maze/thumb');
                }
            }	
		
            if(D('maze')->maze_edit($data,$maze_id)){
                $this->success('修改成功!',U('maze/maze'));
            }else{
                $this->error('修改失败');
            }		
		
        }else {
            $maze_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($maze_id)) {
				$this->error('没有此迷宫');
				exit;
			}
			$maze = M('maze')->where('maze_id='.$maze_id)->find();
			$maze_info = M('maze_monster_goods')->where('maze_id='.$maze_id)->order('floor')->select();
			$this->assign('maze',$maze);
			$this->assign('maze_info',$maze_info);
					
			$this->display();
        }			
		
	}	
	
	public function maze_del(){
		
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';	
        if($ids){
            if(D('maze')->maze_del($ids)){
                $this->success('删除成功');
            }else{
				$this->error('删除失败');
			}
        }			
		
	}	

	
	/********************************************************************************/
	//迷宫怪物物品配置
	public function maze_monster_goods(){
		
		$maze_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		if(empty($maze_id)) {
			$this->error('没有此迷宫');
			exit;
		}
		$maze = M('maze')->where('maze_id='.$maze_id)->find();
		$maze_info = M('maze_monster_goods')->where('maze_id='.$maze_id)->order('floor')->select();
		
		$goods = M('goods')->field('goods_id,goods_name')->select();
		$goods_arr = array();
		foreach($goods as $value){
			$goods_arr[$value['goods_id']] = $value;
		}
		$monsters = M('monster')->field('monster_id,monster_name')->select();
		$monsters_arr = array();
		foreach($monsters as $value){
			$monsters_arr[$value['monster_id']] = $value;
		}		

		if($maze_info){
			foreach($maze_info as $key=>$value){
				if($value['monster_ids']){
					$m_ids = json_decode($value['monster_ids'],true);
					foreach($m_ids as $val){
						if($val > 0){
							if($maze_info[$key]['monsters']){
								$maze_info[$key]['monsters'] .= '|'.$monsters_arr[$val]['monster_name'];
							}else{
								$maze_info[$key]['monsters'] = $monsters_arr[$val]['monster_name'];
							}
						}
					}
				}
				if($value['goods_ids']){
					$g_ids = json_decode($value['goods_ids'],true);
					foreach($g_ids as $val){
						if($val > 0){
							if($maze_info[$key]['goods']){
								$maze_info[$key]['goods'] .= '|'.$goods_arr[$val]['goods_name'];
							}else{
								$maze_info[$key]['goods'] = $goods_arr[$val]['goods_name'];
							}
						}
					}
				}				
			}
		}
		
		$this->assign('maze',$maze);
		$this->assign('maze_info',$maze_info);		
		$this->display();
		
	}
	
	
	//迷宫怪物物品配置添加
	public function maze_monster_goods_add(){
		
		if($_POST){
			$data['maze_id'] = isset($_POST['maze_id'])?intval($_POST['maze_id']):0;
			$data['floor'] = isset($_POST['floor'])?intval($_POST['floor']):0;
			
			if($data['maze_id'] == 0 || $data['floor'] == 0){
				$this->error('没有此迷宫或楼层');
				exit;
			}
			
			if(M('maze_monster_goods')->where('maze_id='.$data['maze_id'].' and floor='.$data['floor'])->find()){
				$this->error('该楼层已存在');
				exit;
			}
			
			$monster_ids[1] = isset($_POST['monster_id_1'])?intval($_POST['monster_id_1']):0; 
			$monster_ids[2] = isset($_POST['monster_id_2'])?intval($_POST['monster_id_2']):0; 
			$monster_ids[3] = isset($_POST['monster_id_3'])?intval($_POST['monster_id_3']):0; 
			$monster_ids[4] = isset($_POST['monster_id_4'])?intval($_POST['monster_id_4']):0; 
			$monster_ids[5] = isset($_POST['monster_id_5'])?intval($_POST['monster_id_5']):0;
			$data['monster_ids'] = json_encode($monster_ids); 
			
			$goods_ids[1] = isset($_POST['goods_id_1'])?intval($_POST['goods_id_1']):0;
			$goods_ids[2] = isset($_POST['goods_id_2'])?intval($_POST['goods_id_2']):0;
			$goods_ids[3] = isset($_POST['goods_id_3'])?intval($_POST['goods_id_3']):0;
			$goods_ids[4] = isset($_POST['goods_id_4'])?intval($_POST['goods_id_4']):0;
			$goods_ids[5] = isset($_POST['goods_id_5'])?intval($_POST['goods_id_5']):0;
			$goods_ids[6] = isset($_POST['goods_id_6'])?intval($_POST['goods_id_6']):0;
			$goods_ids[7] = isset($_POST['goods_id_7'])?intval($_POST['goods_id_7']):0;
			$goods_ids[8] = isset($_POST['goods_id_8'])?intval($_POST['goods_id_8']):0;
			$goods_ids[9] = isset($_POST['goods_id_9'])?intval($_POST['goods_id_9']):0;
			$data['goods_ids'] = json_encode($goods_ids); 			
			
		 	if(D('maze_monster_goods')->maze_monster_goods_add($data)){
				$this->success('添加成功',U('maze/maze_monster_goods?id='.$data['maze_id']));
			}else{
				$this->error('添加失败');
			}
			
		}else{			
			$maze_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($maze_id)) {
				$this->error('没有此迷宫');
				exit;
			}	
			
			$this->assign('maze_id',$maze_id);
			$this->display();
		}
		
	}	
	
	//迷宫怪物物品配置修改
	public function maze_monster_goods_edit(){	
	
		if($_POST){
			$id = isset($_POST['id'])?intval($_POST['id']):0;
			if($id == 0){
				$this->error('没有此配置');
				exit;
			}			
			
			$data['maze_id'] = isset($_POST['maze_id'])?intval($_POST['maze_id']):0;
			$data['floor'] = isset($_POST['floor'])?intval($_POST['floor']):0;
						
			$monster_ids[1] = isset($_POST['monster_id_1'])?intval($_POST['monster_id_1']):0; 
			$monster_ids[2] = isset($_POST['monster_id_2'])?intval($_POST['monster_id_2']):0; 
			$monster_ids[3] = isset($_POST['monster_id_3'])?intval($_POST['monster_id_3']):0; 
			$monster_ids[4] = isset($_POST['monster_id_4'])?intval($_POST['monster_id_4']):0; 
			$monster_ids[5] = isset($_POST['monster_id_5'])?intval($_POST['monster_id_5']):0;
			$data['monster_ids'] = json_encode($monster_ids); 
			
			$goods_ids[1] = isset($_POST['goods_id_1'])?intval($_POST['goods_id_1']):0;
			$goods_ids[2] = isset($_POST['goods_id_2'])?intval($_POST['goods_id_2']):0;
			$goods_ids[3] = isset($_POST['goods_id_3'])?intval($_POST['goods_id_3']):0;
			$goods_ids[4] = isset($_POST['goods_id_4'])?intval($_POST['goods_id_4']):0;
			$goods_ids[5] = isset($_POST['goods_id_5'])?intval($_POST['goods_id_5']):0;
			$goods_ids[6] = isset($_POST['goods_id_6'])?intval($_POST['goods_id_6']):0;
			$goods_ids[7] = isset($_POST['goods_id_7'])?intval($_POST['goods_id_7']):0;
			$goods_ids[8] = isset($_POST['goods_id_8'])?intval($_POST['goods_id_8']):0;
			$goods_ids[9] = isset($_POST['goods_id_9'])?intval($_POST['goods_id_9']):0;
			$data['goods_ids'] = json_encode($goods_ids); 			
			
		 	if(D('maze_monster_goods')->maze_monster_goods_edit($data,$id)){
				$this->success('修改成功',U('maze/maze_monster_goods?id='.$data['maze_id']));
			}else{
				$this->error('修改失败');
			}
			
		}else{			
			$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			if(empty($id)) {
				$this->error('没有此配置');
				exit;
			}	
			
			$maze = M('maze_monster_goods')->where('id='.$id)->find();
			if($maze['monster_ids']){
				$m_ids_arr = array();
				$monster_ids_arr = json_decode($maze['monster_ids'],true);
				$m_ids = '';
				foreach($monster_ids_arr as $key=>$value){
					$m_ids_arr[$key]['m_id'] = $value;
					$m_ids_arr[$key]['m_name'] = '无';
					if($value > 0){
						if($m_ids){
							$m_ids .= ','.$value;
						}else{
							$m_ids = $value;
						}
					}
				}
				if($m_ids){
					$m_name_arr = array();
					$m_ids_name = M('monster')->field('monster_name,monster_id')->where('monster_id in ('.$m_ids.')')->select();
					foreach($m_ids_name as $val){
						$m_name_arr[$val['monster_id']] = $val;
					}
					foreach($m_ids_arr as $k=>$v){
						if($v['m_id'] > 0) $m_ids_arr[$k]['m_name'] = $m_name_arr[$v['m_id']]['monster_name'];
					}
				}
				$maze['monster_ids_arr'] = $m_ids_arr;
			}
			
			if($maze['goods_ids']){
				$g_ids_arr = array();
				$goods_ids_arr = json_decode($maze['goods_ids'],true);
				$g_ids = '';
				foreach($goods_ids_arr as $key=>$value){
					$g_ids_arr[$key]['g_id'] = $value;
					$g_ids_arr[$key]['g_name'] = '无';
					if($value > 0){
						if($g_ids){
							$g_ids .= ','.$value;
						}else{
							$g_ids = $value;
						}
					}
				}
				if($g_ids){
					$g_name_arr = array();
					$g_ids_name = M('goods')->field('goods_name,goods_id')->where('goods_id in ('.$g_ids.')')->select();
					foreach($g_ids_name as $val){
						$g_name_arr[$val['goods_id']] = $val;
					}
					foreach($g_ids_arr as $k=>$v){
						if($v['g_id'] > 0) $g_ids_arr[$k]['g_name'] = $g_name_arr[$v['g_id']]['goods_name'];
					}
				}
				$maze['goods_ids_arr'] = $g_ids_arr;
			}			
	
			$this->assign('maze',$maze);
			$this->display();
		}
		
	}
	
	
	//迷宫怪物物品配置删除
	public function maze_monster_goods_del(){	
	
        $ids = isset($_REQUEST['ids'])?$_REQUEST['ids']:'';	
        if($ids){
            if(D('maze_monster_goods')->maze_monster_goods_del($ids)){
                $this->success('删除成功');
            }else{
				$this->error('删除失败');
			}
        }			
	
	}	
	
	
	/********************************************************************************/
	//迷宫记录
	public function maze_record(){		
		
        $user_name = isset($_GET['user_name'])?trim($_GET['user_name']):'';
        $maze_name = isset($_GET['maze_name'])?trim($_GET['maze_name']):'';
        $start_time = isset($_GET['start_time'])?trim($_GET['start_time']):'';
        $end_time = isset($_GET['end_time'])?trim($_GET['end_time']):'';
		
		$where = '1=1';
		if($user_name) $where .= " and ".C('DB_PREFIX')."user.user_name like '%".$user_name."%'";		
		if($maze_name) $where .= " and ".C('DB_PREFIX')."maze.maze_name like '%".$maze_name."%'";		
		if($start_time) $where .= " and ".C('DB_PREFIX')."maze_record.begin_time >= '".$start_time."'";		
		if($end_time) $where .= " and ".C('DB_PREFIX')."maze_record.begin_time < '".$end_time."'";	
		
        $search_state['user_name'] = $user_name;
        $search_state['maze_name'] = $maze_name;
        $search_state['start_time'] = $start_time;		
        $search_state['end_time'] = $end_time;						
		
        $page = isset($_GET['p'])?$_GET['p']:1;
		$search_state['page'] = $page;
        $limit = D('maze_record')->get_limit($page);
        $page_info = D('maze_record')->maze_record_page($search_state,$where);
        $record_list = D('maze_record')->maze_record_list($limit,$where);
		
        $this->assign('search_state',$search_state);
        $this->assign('record_list',$record_list);
        $this->assign('page',$page_info);
		
		$user_complete_status = C('USER_COMPLETE_STATUS');
		$this->assign('user_complete_status',$user_complete_status);
		
        $this->display();	
		
	}	
	
	//迷宫记录详情
	public function maze_record_info(){	
	
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		if(empty($id)) {
			$this->error('没有此记录');
			exit;
		}	
		$info = D('maze_record')->info($id);
		$this->assign('info',$info);
		$user_complete_status = C('USER_COMPLETE_STATUS');
		$this->assign('user_complete_status',$user_complete_status);		
		
		$this->display();
		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}