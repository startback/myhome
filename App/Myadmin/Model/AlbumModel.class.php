<?php 
namespace Myadmin\Model;
use Think\Model;

class AlbumModel extends Model {

    var $per_page = 10;

    //增加相册类型
	public function add_type($data){
        if(M('album_type')->add($data)){
            return true;
        }else{
            return false;
        }
    }

    //修改相册类型
    public function edit_type($type_id,$data){
        if(M('album_type')->where('type_id='.$type_id)->save($data)){
            return true;
        }else{
            return false;
        }
    }

    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }


    //获取分类列表
    public function get_type_list($limit){
        return M('album_type')->limit($limit)->order('type_id desc')->select();
    }


    //获得页数
    public function get_page($page){
        $total_num = M('album_type')->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page;
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $purl = __ROOT__.'/Myadmin/album/atype/p/';

        $page_info = '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }


    //获取相册列表
    public function get_album_list($limit,$where){
        return M('album')->field(C('DB_PREFIX').'album.*,'.C('DB_PREFIX').'admin.admin_account')->join(C('DB_PREFIX').'admin ON '.C('DB_PREFIX').'album.author_id = '.C('DB_PREFIX').'admin.admin_id')->where($where)->limit($limit)->order('album_id desc')->select();
    }



    //获得页数
    public function get_page_list($page,$where){
        $total_num = M('album')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/Myadmin/album/album_list/is_show/'.$page['is_show'].'/is_hot/'.$page['is_hot'].'/is_top/'.$page['is_top'].'/is_recommend/'.$page['is_recommend'].'/type_id/'.$page['type_id'];

        if($page['keywords']){
            $purl = $base_purl.'/keywords/'.$page['keywords'].'/p/';
        }else{
            $purl = $base_purl.'/p/';
        }

        $page_info = '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
	

	

	
}