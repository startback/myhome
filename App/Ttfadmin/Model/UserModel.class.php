<?php 
namespace Ttfadmin\Model;
use Think\Model;

class UserModel extends Model {

	var $mo_role_id = 1;  //注册默认角色
    var $per_page = 12;

    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }

    //获取用户列表
    public function user_list($limit,$where){
        $user_info = M('user')->field(C('DB_PREFIX').'user.*,'.C('DB_PREFIX').'user_info.user_ttbi,'.C('DB_PREFIX').'user_info.user_gold,'.C('DB_PREFIX').'user_info.user_vip,'.C('DB_PREFIX').'user_info.user_role_id')->join('left join '.C('DB_PREFIX').'user_info ON '.C('DB_PREFIX').'user.user_id = '.C('DB_PREFIX').'user_info.user_id')->where($where)->limit($limit)->order('user_id desc')->select();	

		if($user_info){
			$user_vip_level = C('USER_VIP_LEVEL');
			$user_sex = C('USER_SEX');
			$user_status = C('USER_STATUS');
			
			foreach($user_info as $key=>$value){
				$user_info[$key]['user_vip_name'] = $user_vip_level[$value['user_vip']];
				$user_info[$key]['user_sex_name'] = $user_sex[$value['user_sex']];
				$user_info[$key]['user_status_name'] = $user_status[$value['user_status']];	
			}
		}
		
		return $user_info;
    }

    //获得页数
    public function user_page($page,$where){		
        $total_num = M('user')->join('left join '.C('DB_PREFIX').'user_info ON '.C('DB_PREFIX').'user.user_id = '.C('DB_PREFIX').'user_info.user_id')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=usermanage&a=user&user_name='.$page['user_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'].'&user_phone='.$page['user_phone'].'&user_vip='.$page['user_vip'];
        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
		
	
    //删除用户
    public function user_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
		
		$res = true;
		//开始事务
		M()->startTrans(); 
		if(M('user')->where('user_id in ('.$ids.')')->delete()){ //删除用户
		
			if(M('user_info')->where('user_id in ('.$ids.')')->find() && $res){ //删除用户详情
				if(!M('user_info')->where('user_id in ('.$ids.')')->delete()){
					M()->rollback();
					$res = false;
				} 
			}	
			if(M('user_role')->where('user_id in ('.$ids.')')->select()  && $res){ //删除用户角色
				if(!M('user_role')->where('user_id in ('.$ids.')')->delete()){
					M()->rollback();
					$res = false;
				}
			}
			if(M('user_goods')->where('user_id in ('.$ids.')')->select()  && $res){ //删除用户物品
				if(!M('user_goods')->where('user_id in ('.$ids.')')->delete()){
					M()->rollback();
					$res = false;
				}
			}
			if(M('user_monster')->where('user_id in ('.$ids.')')->select()  && $res){ //删除用户怪物
				if(!M('user_monster')->where('user_id in ('.$ids.')')->delete()){
					M()->rollback();
					$res = false;
				}
			}			
			if(M('role_maze_record')->where('user_id in ('.$ids.')')->select()  && $res){ //删除用户登塔记录
				if(!M('role_maze_record')->where('user_id in ('.$ids.')')->delete()){
					M()->rollback();
					$res = false;
				}
			}								
        }else{
			$res = false;
		}		
		M()->commit(); 
		
		if($res){
			D('admin_log')->admin_log('删除用户，ID为'.$ids);
		}else{
			D('admin_log')->admin_log('删除用户失败，ID为'.$ids);
		}
	
        return $res;  		
    }		
	
	//修改用户
	public function user_edit($data,$data_info,$user_id){
		
		$res = true;

		$res_one = M('user')->where('user_id='.$user_id)->save($data);
		$res_two = M('user_info')->where('user_id='.$user_id)->save($data_info);
		if(empty($res_one) && empty($res_two)){
			$res = false;
			D('admin_log')->admin_log('修改用户失败，ID为'.$user_id);
		}else{
			D('admin_log')->admin_log('修改用户 ID为:'.$user_id);
		}
	
        return $res; 	
		
	}	
	
	
	//注册或添加用户
	public function user_register($data,$data_info){
		
		$res = false;
		
		//开始事务
		M()->startTrans();  
		if($in_user_id = M('user')->add($data)){
			//查询默认的角色
			$need_role = M('role')->where('role_id='.$this->mo_role_id)->find();
			
			//生成默认首个角色
			$role_data['user_id'] = $in_user_id;
			$role_data['role_id'] = $need_role['role_id'];
			$role_data['add_time'] = date('Y-m-d H:i:s',time());
			$role_data['attack'] = $need_role['role_attack'];
			$role_data['magic'] = $need_role['role_magic'];
			$role_data['hp'] = $need_role['role_hp'];
			$role_data['mp'] = $need_role['role_mp'];
			$role_data['attack_defense'] = $need_role['role_attack_defense'];
			$role_data['magic_defense'] = $need_role['role_magic_defense'];
			$role_data['dodge'] = $need_role['role_dodge'];
			$role_data['direct'] = $need_role['role_direct'];
			$role_data['crit'] = $need_role['role_crit'];
			$role_data['skill_ids'] = $need_role['role_skill_id'];
			
			if($n_user_role_id = M('user_role')->add($role_data)){					
				$data_info['user_id'] = $in_user_id;
				$data_info['user_role_id'] = $n_user_role_id;	
				
				if(M('user_info')->add($data_info)){
					$res = true;
				}else{
					M()->rollback();							
				}													
			}else{
				M()->rollback();									
			}
		}
		M()->commit();   
		//事务结束	
		
		if($res){
			D('admin_log')->admin_log('注册用户 ID为:'.$in_user_id);
		}else{
			D('admin_log')->admin_log('注册用户失败');
		}		

		return $res;
	}
	
	
	
	
	
	
	
	
		
}