<?php 
namespace Ttfadmin\Model;
use Think\Model;

class UserMonsterModel extends Model {

    var $per_page;

	public function __construct(){
		$this->per_page = C('PAGE_USER_MONSTER');
	}	
	
    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }

    //获取用户怪物列表
    public function user_monster_list($limit,$where){
        return $user_monster_info = M('user_monster')->field(C('DB_PREFIX').'user_monster.*,'.C('DB_PREFIX').'user.user_name,'.C('DB_PREFIX').'monster.monster_name,'.C('DB_PREFIX').'monster.monster_logo')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'user_monster.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'monster ON '.C('DB_PREFIX').'user_monster.monster_id = '.C('DB_PREFIX').'monster.monster_id')->where($where)->limit($limit)->order('id desc')->select();	
    }

    //获得页数
    public function user_monster_page($page,$where){		
        $total_num = M('user_monster')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'user_monster.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'monster ON '.C('DB_PREFIX').'user_monster.monster_id = '.C('DB_PREFIX').'monster.monster_id')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=usermanage&a=user_monster&user_name='.$page['user_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'].'&user_monster_name='.$page['user_monster_name'];
        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
		
	//添加用户怪物
	public function user_monster_add($data){
		$in_id = M('user_monster')->add($data);
        if($in_id){
			D('admin_log')->admin_log('添加用户怪物 ID为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}			
		
	
    //删除用户怪物
    public function user_monster_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
		if(M('user_monster')->where('id in ('.$ids.')')->delete()){ //删除用户怪物
			D('admin_log')->admin_log('删除用户怪物，ID为'.$ids);
			return true;
		}else{
			D('admin_log')->admin_log('删除用户怪物失败，ID为'.$ids);
			return false;
		}
		 		
    }		
	
	//修改用户怪物
	public function user_monster_edit($data,$id){
		if(M('user_monster')->where('id='.$id)->save($data)){
			D('admin_log')->admin_log('修改用户怪物 ID为:'.$id);
			return true;
		}else{
			D('admin_log')->admin_log('修改用户怪物失败，ID为'.$id);
			return false;
		}	
	}	
	

	
		
}