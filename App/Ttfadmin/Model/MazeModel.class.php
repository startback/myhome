<?php 
namespace Ttfadmin\Model;
use Think\Model;

class MazeModel extends Model {

    var $per_page;

	public function __construct(){
		$this->per_page = C('PAGE_MAZE');
	}	
	
    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }

    //获取迷宫列表
    public function maze_list($limit,$where){
        return M('maze')->where($where)->limit($limit)->order('maze_id desc')->select();	
    }

    //获得页数
    public function maze_page($page,$where){		
        $total_num = M('maze')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=maze&a=maze&maze_name='.$page['maze_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'];
        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }	
	
    //删除迷宫
    public function maze_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
/* 		
		$res = true;

		if(M('maze')->where('maze_id in ('.$ids.')')->delete()){ 
		
		}
		
		if($res){
			D('admin_log')->admin_log('删除迷宫，ID为'.$ids);
		}else{
			D('admin_log')->admin_log('删除迷宫失败，ID为'.$ids);
		}
	 */
        return $res;  		
    }		
	
	//修改迷宫
	public function maze_edit($data,$data_info,$maze_id){
/* 		$res = true;

		$res_one = M('user')->where('user_id='.$user_id)->save($data);
		$res_two = M('user_info')->where('user_id='.$user_id)->save($data_info);
		if(empty($res_one) && empty($res_two)){
			$res = false;
			D('admin_log')->admin_log('修改用户失败，ID为'.$user_id);
		}else{
			D('admin_log')->admin_log('修改用户 ID为:'.$user_id);
		}
	
        return $res;  */	
		
	}
		
}