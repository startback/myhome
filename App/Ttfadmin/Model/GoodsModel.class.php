<?php 
namespace Ttfadmin\Model;
use Think\Model;

class GoodsModel extends Model {
    var $per_page = 12;

    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }

    //获取物品列表
    public function goods_list($limit,$where){
        return M('goods')->field(C('DB_PREFIX').'goods.*,'.C('DB_PREFIX').'type.type_name')->join('left join '.C('DB_PREFIX').'type ON '.C('DB_PREFIX').'goods.goods_type = '.C('DB_PREFIX').'type.type_id')->where($where)->limit($limit)->order('goods_id desc')->select();		
		
    }

    //获得页数
    public function goods_page($page,$where){		
        $total_num = M('goods')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=currency&a=goods&goods_name='.$page['goods_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'].'&search_id='.$page['search_id'].'&search_id_2='.$page['search_id_2'].'&search_id_3='.$page['search_id_3'];
        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
	
    //获得页数 选择页面
    public function select_goods_page($page,$where){		
        $total_num = M('goods')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=select&a=select_goods&goods_name='.$page['goods_name'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'].'&search_id='.$page['search_id'].'&search_id_2='.$page['search_id_2'].'&search_id_3='.$page['search_id_3'];
		$purl = $base_purl.'&id_name='.$page['id_name']."&p=";

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }	
			
	
    //删除物品
    public function goods_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
		
		if(M('goods')->where('goods_id in ('.$ids.')')->delete()){
			D('admin_log')->admin_log('删除物品，ID为'.$ids);
            return true;  
        }else{
			return false;
		}
    }	

	//添加物品
	public function goods_add($data){
		$in_id = M('goods')->add($data);
        if($in_id){
			D('admin_log')->admin_log('增加物品 名称:'.$data['goods_name'].'，ID为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}		
	
	//修改物品
	public function goods_edit($data,$goods_id){
		if(M('goods')->where('goods_id='.$goods_id)->save($data)){
			D('admin_log')->admin_log('修改物品 物品名:'.$data['goods_name'].'，ID为:'.$goods_id);			
			return true;
		}else{
			return false;
		}
	}	
	
	
	//获得物品名字
	public function get_name($id){
		$goods_name = M('goods')->field('goods_name')->where('goods_id='.$id)->find();
		return $goods_name['goods_name'];
	}		
	
	
	
	
	
	
	
	
	
	
	
	
		
}