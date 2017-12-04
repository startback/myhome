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
			
			
		 	if(D('user')->user_register($data,$data_info)){
				$this->success('添加成功');
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
		
		
            if(D('user')->user_edit($data,$data_info,$user_id)){
                $this->success('修改成功!');
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
			$maze_info = M('maze_monster_goods')->where('maze_id='.$maze)->select();
			$this->assign('maze',$maze);
			$this->assign('maze_info',$maze_info);
					
			$this->display();
        }			
		
	}	
	
	public function maze_del(){
		
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