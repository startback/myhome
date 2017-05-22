<?php
namespace Home\Controller;
use Think\Controller;
class AlbumController extends CommonController {

    //相册列表
    public function album_list(){
        $type_id = isset($_GET['type_id'])?$_GET['type_id']:'';

		$album = array();
		if($type_id){
			$where = ' type_id ='.$type_id;
			$album['list'] = D('album')->get_album_list($where);
			$album['type'] = D('album')->get_album_type($type_id);
			$album['count'] = count($album['list']);
		}
	
		if(empty($album['count'])){
			echo "<script>alert('没有图片');history.go(-1);</script>";
			exit;
		}
	
		$this->assign('album',$album);
        $this->display();
    }


	//相册类型列表
	public function album_type_list(){
        $page['page'] = isset($_GET['p'])?$_GET['p']:1;

        $page['limit'] = D('album')->get_limit($page['page']);
        $where = '1=1';

        $album_type_list = D('album')->get_article_type($page['limit'],$where);
        $page_info = D('album')->get_page_list($page,$where);

        $this->assign('album_type_list',$album_type_list);
        $this->assign('page_info',$page_info);

		
		$this->display();
	}

	

}