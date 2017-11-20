<?php 
namespace Ttfadmin\Model;
use Think\Model;

class RoleSkillModel extends Model {
    var $per_page = 12;

    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }

    //获取物品列表
    public function role_skill_list($limit,$where){
        return M('role_skill')->where($where)->limit($limit)->order('role_skill_id desc')->select();
    }

    //获得页数
    public function role_skill_page($page,$where){		
        $total_num = M('role_skill')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=currency&a=role_skill&role_skill_name='.$page['role_skill_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'];
        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
			
	
    //删除天赋技能
    public function role_skill_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
		
		if(M('role_skill')->where('role_skill_id in ('.$ids.')')->delete()){
			D('admin_log')->admin_log('删除天赋技能，ID为'.$ids);
            return true;  
        }else{
			return false;
		}
    }	

	//添加天赋技能
	public function role_skill_add($data){
		$in_id = M('role_skill')->add($data);
        if($in_id){
			D('admin_log')->admin_log('增加天赋技能 名称:'.$data['role_skill_name'].'，ID为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}		
	
	//修改天赋技能
	public function role_skill_edit($data,$role_skill_id){
		if(M('role_skill')->where('role_skill_id='.$role_skill_id)->save($data)){
			D('admin_log')->admin_log('修改天赋技能 名称:'.$data['role_skill_name'].'，ID为:'.$role_skill_id);			
			return true;
		}else{
			return false;
		}
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
}