<?php 
namespace Ttfadmin\Model;
use Think\Model;

class UserGoodsModel extends Model {

    var $per_page;
	
	public function __construct(){
		$this->per_page = C('PAGE_USER_GOODS');
	}	

    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }

    //获取用户物品列表
    public function user_goods_list($limit,$where){
        return $user_goods_info = M('user_goods')->field(C('DB_PREFIX').'user_goods.*,'.C('DB_PREFIX').'user.user_name,'.C('DB_PREFIX').'goods.goods_name,'.C('DB_PREFIX').'goods.goods_logo')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'user_goods.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'goods ON '.C('DB_PREFIX').'user_goods.goods_id = '.C('DB_PREFIX').'goods.goods_id')->where($where)->limit($limit)->order('id desc')->select();	
    }

    //获得页数
    public function user_goods_page($page,$where){		
        $total_num = M('user_goods')->join('left join '.C('DB_PREFIX').'user ON '.C('DB_PREFIX').'user_goods.user_id = '.C('DB_PREFIX').'user.user_id')->join('left join '.C('DB_PREFIX').'goods ON '.C('DB_PREFIX').'user_goods.goods_id = '.C('DB_PREFIX').'goods.goods_id')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=usermanage&a=user_goods&user_name='.$page['user_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'].'&user_goods_name='.$page['user_goods_name'];
        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
		
	//添加用户物品
	public function user_goods_add($data){
		$in_id = M('user_goods')->add($data);
        if($in_id){
			D('admin_log')->admin_log('添加用户物品 ID为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}			
		
	
    //删除用户物品
    public function user_goods_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
		if(M('user_goods')->where('id in ('.$ids.')')->delete()){ //删除用户物品
			D('admin_log')->admin_log('删除用户物品，ID为'.$ids);
			return true;
		}else{
			D('admin_log')->admin_log('删除用户物品失败，ID为'.$ids);
			return false;
		}
		 		
    }		
	
	//修改用户物品
	public function user_goods_edit($data,$id){
		if(M('user_goods')->where('id='.$id)->save($data)){
			D('admin_log')->admin_log('修改用户物品 ID为:'.$id);
			return true;
		}else{
			D('admin_log')->admin_log('修改用户物品失败，ID为'.$id);
			return false;
		}	
	}	
	

	
		
}