<?php 
namespace Ttfadmin\Model;
use Think\Model;

class MonsterModel extends Model {
    var $per_page = 12;

    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }

    //获取怪物列表
    public function monster_list($limit,$where){
        return M('monster')->field(C('DB_PREFIX').'monster.*,'.C('DB_PREFIX').'type.type_name')->join('left join '.C('DB_PREFIX').'type ON '.C('DB_PREFIX').'monster.monster_type = '.C('DB_PREFIX').'type.type_id')->where($where)->limit($limit)->order('monster_id desc')->select();		
		
    }

    //获得页数
    public function monster_page($page,$where){		
        $total_num = M('monster')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=currency&a=monster&monster_name='.$page['monster_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'].'&search_id='.$page['search_id'].'&search_id_2='.$page['search_id_2'].'&search_id_3='.$page['search_id_3'];
        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
			
	
    //删除怪物
    public function monster_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
		
		if(M('monster')->where('monster_id in ('.$ids.')')->delete()){
			D('admin_log')->admin_log('删除怪物，ID为'.$ids);
            return true;  
        }else{
			return false;
		}
    }	

	//添加怪物
	public function monster_add($data){
		$in_id = M('monster')->add($data);
        if($in_id){
			D('admin_log')->admin_log('增加怪物 名称:'.$data['monster_name'].'，ID为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}		
	
	//修改怪物
	public function monster_edit($data,$monster_id){
		if(M('monster')->where('monster_id='.$monster_id)->save($data)){
			D('admin_log')->admin_log('修改怪物 怪物名:'.$data['monster_name'].'，ID为:'.$monster_id);			
			return true;
		}else{
			return false;
		}
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
}