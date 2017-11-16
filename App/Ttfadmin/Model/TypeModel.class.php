<?php 
namespace Ttfadmin\Model;
use Think\Model;

class TypeModel extends Model {
    var $per_page = 10;

	//搜索某级别的类型及其子类型 默认顶级 
	public function type_list($num=0){
        $types = M('type')->select();
		$return_types = array();   //pid为0的组
		$new_types = array();      //pid不为0的组
	
		if($types){
			foreach($types as $value){
				if($value['type_pid'] != 0) $new_types[$value['type_pid']][] = $value;
				if($value['type_pid'] == $num) $return_types[] = $value;
			}
		}	
		return $this->get_type_arr($return_types,$new_types);
	}
	
	//获取类型
	public function get_type_arr($res_arr,$all_arr){
		if($res_arr && $all_arr){
			foreach($res_arr as $key=>$value){
				if($all_arr[$value['type_id']]){
					$res_arr[$key]['type_child'] = $this->get_type_arr($all_arr[$value['type_id']],$all_arr);
				}else{
					$res_arr[$key]['type_child'] = '';
				}
			}
		}
		return $res_arr;
	}	
	
	//添加类型
	public function type_add($data){
		$in_id = M('type')->add($data);
        if($in_id){
			D('admin_log')->admin_log('增加类型 类名:'.$data['type_name'].'，ID为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}	
	
	//修改类型
	public function type_edit($data,$type_id){
		if(M('type')->where('type_id='.$type_id)->save($data)){
			D('admin_log')->admin_log('修改类型 类名:'.$data['type_name'].'，ID为:'.$type_id);			
			return true;
		}else{
			return false;
		}
	}
	
    //删除类型
    public function type_del($ids){
		//要删除其对应的子类集
		if(empty($ids)){
			return false;
			exit;
		}
		
		$id_arr = explode(',',$ids);
		$id_str = '';
		foreach($id_arr as $value){
			$arr = $this->type_list($value);
			$get_ids = trim($this->get_type_ids($arr),',');
			if($get_ids){
				if($id_str){
					$id_str .= ','.$get_ids;
				}else{
					$id_str = $get_ids;
				}
			}
		}	
		if($id_str){
			$ids .= ','.$id_str;
			$res_str = '删除类型及其子类型，编号为:'.$ids;
		}else{
			$res_str = '删除类型，编号为:'.$ids;
		}	
		
		if(M('type')->where('type_id in ('.$ids.')')->delete()){
			D('admin_log')->admin_log($res_str);
            return true;  
        }else{
			return false;
		}
    }	

	public function get_type_ids($arr){
		$str = '';
		if($arr){
			foreach($arr as $value){
				$str .= $value['type_id'].',';
				if($value['type_child']){
					$str .= $this->get_type_ids($value['type_child']);
				}
			}
		}
		return $str;
	}
	
/*********************/	

	//添加管理员
	public function add_admin($data){
		$in_id = M('admin')->add($data);
        if($in_id){
			D('admin_log')->admin_log('增加管理员，编号为:'.$in_id);
            return true;
        }else{
            return false;
        }		
	}	
	
    //编辑管理员
    public function edit_admin($admin_id,$data){
        if(M('admin')->where('admin_id='.$admin_id)->save($data)){
			D('admin_log')->admin_log('修改管理员，编号为:'.$admin_id);
            return true;
        }else{
            return false;
        }
    }		
	
    //删除管理员
    public function del_admin($ids){
		if(M('admin')->where('admin_id in ('.$ids.')')->delete()){
			D('admin_log')->admin_log('删除管理员，编号为:'.$ids);
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


    //获取管理员列表
    public function get_admin_list($limit){
        return M('admin')->limit($limit)->order('admin_id desc')->select();
    }

    //获得页数
    public function get_admin_page($page){
        $total_num = M('admin')->count();
        $total_page = ceil($total_num/$this->per_page);
        $cur_page = $page;
        $pre_page = $cur_page - 1;
        if($pre_page < 1) $pre_page = 1;
        $next_page = $cur_page + 1;
        if($next_page > $total_page) $next_page = $total_page;

        $purl = __ROOT__.'/index.php?m=ttfadmin&c=admin&a=admin_list&p=';

        $page_info = '<a href="'.$purl.'1">首页</a>';
        $page_info .= '<a href="'.$purl.$pre_page.'">上一页</a>';
        $page_info .= '<span class="current">'.$cur_page.'</span>';
        $page_info .= '<a href="'.$purl.$next_page.'">下一页</a>';
        $page_info .= '<a href="'.$purl.$total_page.'">尾页</a>';

        return $page_info;
    }
	
}