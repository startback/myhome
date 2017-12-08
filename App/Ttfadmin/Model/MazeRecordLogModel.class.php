<?php 
namespace Ttfadmin\Model;
use Think\Model;

class MazeRecordLogModel extends Model {

    var $per_page;

	public function __construct(){
		$this->per_page = C('PAGE_MAZE_RECORD_LOG');
	}	
	
    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }

    //获取迷宫列表
    public function maze_record_log_list($limit,$where){
        return M('maze_record_log')->field(C('DB_PREFIX').'maze_record_log.*,'.C('DB_PREFIX').'user.user_name,'.C('DB_PREFIX').'maze.maze_name')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'maze_record_log.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'maze ON '.C('DB_PREFIX').'maze_record_log.maze_id = '.C('DB_PREFIX').'maze.maze_id')->where($where)->limit($limit)->order('log_id desc')->select();		
    }

    //获得页数
    public function maze_record_log_page($page,$where){		
        $total_num = M('maze_record_log')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'maze_record_log.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'maze ON '.C('DB_PREFIX').'maze_record_log.maze_id = '.C('DB_PREFIX').'maze.maze_id')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=maze&a=maze_record_log&user_name='.$page['user_name'].'&maze_name='.$page['maze_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'];
        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }	
	
	
	//详情
	public function info($id){
		$info = array();
		if(empty($id)) {
			return $info;
			exit;
		}
		
		$info = M('maze_record_log')->field(C('DB_PREFIX').'maze_record_log.*,'.C('DB_PREFIX').'user.user_name,'.C('DB_PREFIX').'maze.maze_name')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'maze_record_log.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'maze ON '.C('DB_PREFIX').'maze_record_log.maze_id = '.C('DB_PREFIX').'maze.maze_id')->where('log_id='.$id)->find();
		
		if($info){
			$info['monsters_name'] = '';
			$info['kill_monsters_name'] = '';
			$info['goods_name'] = '';
			$info['get_goods_name'] = '';
			$info['roles_get_exp'] = '';
			
			if($info['maze_monster_ids']){
				$m_name_arr = array();
				$m_names = M('monster')->field('monster_name,monster_id')->where('monster_id in ('.$info['maze_monster_ids'].')')->select();
				foreach($m_names as $val){
					$m_name_arr[$val['monster_id']] = $val;
				}
				$m_ids_arr = explode(',',$info['maze_monster_ids']);		
				foreach($m_ids_arr as $val){
					if($info['monsters_name']){
						$info['monsters_name'] .= "|".$m_name_arr[$val]['monster_name'];
					}else{
						$info['monsters_name'] = $m_name_arr[$val]['monster_name'];
					}					
				}
		
				if($info['kill_monster_ids']){
					$km_ids_arr = explode(',',$info['kill_monster_ids']);
					foreach($km_ids_arr as $val){
						if($info['kill_monsters_name']){
							$info['kill_monsters_name'] .= "|".$m_name_arr[$val]['monster_name'];
						}else{
							$info['kill_monsters_name'] = $m_name_arr[$val]['monster_name'];
						}					
					}					
				}
			}
			
			if($info['maze_goods_ids']){
				$g_name_arr = array();
				$g_names = M('goods')->field('goods_name,goods_id')->where('goods_id in ('.$info['maze_goods_ids'].')')->select();
				foreach($g_names as $val){
					$g_name_arr[$val['goods_id']] = $val;
				}
				$g_ids_arr = explode(',',$info['maze_goods_ids']);
				foreach($g_ids_arr as $val){
					if($info['goods_name']){
						$info['goods_name'] .= "|".$g_name_arr[$val]['goods_name'];
					}else{
						$info['goods_name'] = $g_name_arr[$val]['goods_name'];
					}					
				}
				
				if($info['get_goods_ids']){
					$get_ids_arr = explode(',',$info['get_goods_ids']);
					foreach($get_ids_arr as $val){
						if($info['get_goods_name']){
							$info['get_goods_name'] .= "|".$g_name_arr[$val]['goods_name'];
						}else{
							$info['get_goods_name'] = $g_name_arr[$val]['goods_name'];
						}					
					}					
					
				}
			}			
			
			$info['user_role_id_name'] = D('user_role')->get_role_name($info['user_role_id']);		
			$info['user_other_role_name'] = '';
			if($info['user_other_role_ids']){
				$o_ids = explode(',',$info['user_other_role_ids']);
				foreach($o_ids as $val){
					if($val > 0){
						if($info['user_other_role_name']){
							$info['user_other_role_name'] .= "|".D('user_role')->get_role_name($val);
						}else{
							$info['user_other_role_name'] = D('user_role')->get_role_name($val);
						}
					}					
				}	
			}

			$info['roles_get_experience_arr'] = array();
			if($info['roles_get_experience']){
				$info['roles_get_experience_arr'] = json_decode($info['roles_get_experience'],true);
				foreach($info['roles_get_experience_arr'] as $key=>$val){
					if($info['roles_get_exp']){
						$info['roles_get_exp'] .= " - ".D('user_role')->get_role_name($key).":".$val;
					}else{
						$info['roles_get_exp'] = D('user_role')->get_role_name($key).":".$val;
					}
				}
			}
		}

		return $info;
	}
	
	
	
	
	
	
	
	
	
	
	
}