<?php 
namespace Home\Model;
use Think\Model;

class AlbumModel extends Model {

    var $per_page = 10;


    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }


    //获取相册列表
    public function get_album_list($where){
        return M('album')->where($where)->order('album_id desc')->select();
    }

	//获取相册名字
	public function get_album_type($type_id){
		return M('album_type')->where('type_id='.$type_id)->find();
	}	
	
	
    //获得页数
    public function get_page_list($page,$where,$method='index.php?m=home&c=album&a=album_type_list'){
        $total_num = M('album')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/'.$method.'&type=album&p=';

        $page_info  = '<li><a href="'.$base_purl.'1">首页</a></li>';
        $page_info .= '<li><a href="'.$base_purl.$pre_page.'">上一页</a></li>';
        $page_info .= '<li><a class="Index_on">'.$cur_page.'</a></li>';
        $page_info .= '<li><a href="'.$base_purl.$next_page.'">下一页</a></li>';
        $page_info .= '<li><a href="'.$base_purl.$total_page.'">尾页</a></li>';
        $page_info .= '<li><a href="javascript:void(0)">共'.$total_page.'页'.$total_num.'条</a></li>';

        return $page_info;
    }


    //获得相册分类
    public function get_article_type(){
        $types = M('album_type')->select();
        $arr = array();
        foreach($types as $val){
            $arr[$val['type_id']] = $val;
        }
        return $arr;
    }

}