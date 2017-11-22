<?php 
namespace Ttfadmin\Model;
use Think\Model;

class UserModel extends Model {
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
		
		//删除对应的数据  待做
		//用户物品  用户角色  用户怪物 用户记录等
		
		if(M('user')->where('user_id in ('.$ids.')')->delete()){
			D('admin_log')->admin_log('删除用户，ID为'.$ids);
            return true;  
        }else{
			return false;
		}
    }	

	//添加用户
	public function user_add($data){
		
		//对应表 user_info的操作
		
		$in_id = M('user')->add($data);
        if($in_id){
			D('admin_log')->admin_log('添加用户 名称:'.$data['user_name'].'，ID为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}		
	
	//修改用户
	public function user_edit($data,$user_id){
		
		//不同的地方 不同的语句
		
		if(M('user')->where('user_id='.$user_id)->save($data)){
			D('admin_log')->admin_log('修改用户 用户名:'.$data['user_name'].'，ID为:'.$user_id);			
			return true;
		}else{
			return false;
		}
	}	
	
	
	
	
	
	
	
	
	
	
	
		
}