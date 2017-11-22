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
	
	
	//  待做
	
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
		
        $ids = isset($_POST['ids'])?$_POST['ids']:'';
        if($ids){
            if(D('goods')->goods_del($ids)){
                echo 1;
            }
        }			
		
	}	
	


}