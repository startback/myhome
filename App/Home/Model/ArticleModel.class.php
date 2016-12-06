<?php 
namespace Home\Model;
use Think\Model;

class ArticleModel extends Model {

    var $per_page = 10;


    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }


    //获取文章列表
    public function get_article_list($limit,$where){
        return M('article')->field(C('DB_PREFIX').'article.*,'.C('DB_PREFIX').'admin.admin_account')->join(C('DB_PREFIX').'admin ON '.C('DB_PREFIX').'article.author_id = '.C('DB_PREFIX').'admin.admin_id')->where($where)->limit($limit)->order('top_order desc,is_top desc,article_id desc')->select();
    }


    //获得页数
    public function get_page_list($page,$where,$method='article/article_list'){
        $total_num = M('article')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/'.$method.'/type/'.$page['type'].'/p/';

        $page_info  = '<li><a href="'.$base_purl.'1">首页</a></li>';
        $page_info .= '<li><a href="'.$base_purl.$pre_page.'">上一页</a></li>';
        $page_info .= '<li><a class="Index_on">'.$cur_page.'</a></li>';
        $page_info .= '<li><a href="'.$base_purl.$next_page.'">下一页</a></li>';
        $page_info .= '<li><a href="'.$base_purl.$total_page.'">尾页</a></li>';
        $page_info .= '<li><a href="javascript:void(0)">共'.$total_page.'页'.$total_num.'条</a></li>';

        return $page_info;
    }


    //获得文章分类
    public function get_article_type(){
        $types = M('article_type')->select();
        $arr = array();
        foreach($types as $val){
            $arr[$val['type_id']] = $val;
        }
        return $arr;
    }

}