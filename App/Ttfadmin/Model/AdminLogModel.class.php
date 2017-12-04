<?php 
namespace Ttfadmin\Model;
use Think\Model;

class AdminLogModel extends Model {

    var $per_page;

	public function __construct(){
		$this->per_page = C('PAGE_ADMIN_LOG');
	}
	
    //获取limit
    public function get_limit($page){
        $start_num = ($page - 1) * $this->per_page;
        return $start_num.','.$this->per_page;
    }


    //获取日志列表
    public function get_admin_log_list($limit,$where){
        return M('admin_log')->field(C('DB_PREFIX').'admin_log.*,'.C('DB_PREFIX').'admin.admin_account')->join('left join '.C('DB_PREFIX').'admin ON '.C('DB_PREFIX').'admin_log.admin_id = '.C('DB_PREFIX').'admin.admin_id')->where($where)->limit($limit)->order('log_id desc')->select();
    }


    //获得页数
    public function get_admin_log_page($page,$where){
        $total_num = M('admin_log')->where($where)->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page['page'];
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $base_purl = __ROOT__.'/index.php?m=ttfadmin&c=admin&a=admin_log_list&admin_id='.$page['admin_id'].'&start_time='.$page['start_time'].'&end_time='.$page['end_time'].'&ip_address='.$page['ip_address'];

        $purl = $base_purl.'&p=';

        $page_info .= '<span class="current">共'.$total_num.'记录--'.$total_page.'页</span>';		
        $page_info .= '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
	

	//插入记录
	public function admin_log($info,$admin_id='',$ip_address=''){
		if(empty($admin_id)) $admin_id = $_SESSION['ttfadmin']['info']['admin_id'];
		$data['admin_id'] = $admin_id;
		$data['log_info'] = $info;
		if(empty($ip_address)) $ip_address = $_SESSION['ttfadmin']['info']['ip_address'];
		$data['ip_address'] = $ip_address;
		$data['log_time'] = date('Y-m-d H:i:s',time());
		M('admin_log')->add($data);
	}

	
}














