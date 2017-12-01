<?php 
namespace Ttfadmin\Model;
use Think\Model;

class LevelExperienceModel extends Model {


	//添加等级经验
	public function level_exp_add($data){
		
        if(M('level_experience')->add($data)){
			D('admin_log')->admin_log('增加等级经验 级别:'.$data['level']);
            return true;
        }else{
            return false;
        }		
		
	}	
	
	//修改等级经验
	public function level_exp_edit($data,$level){
		if(M('level_experience')->where('level='.$level)->save($data)){
			D('admin_log')->admin_log('修改等级经验 级别:'.$data['level']);			
			return true;
		}else{
			return false;
		}
	}
	
    //删除等级经验
    public function level_exp_del($ids){
		
		if(M('level_experience')->where('level in ('.$ids.')')->delete()){
			D('admin_log')->admin_log('删除等级经验，级别为:'.$ids);
            return true;  
        }else{
			return false;
		}
    }	

		
}