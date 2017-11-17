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
		
}