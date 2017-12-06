<?php 
namespace Ttfadmin\Model;
use Think\Model;

class MazeMonsterGoodsModel extends Model {


	//添加迷宫怪物物品
	public function maze_monster_goods_add($data){
		$in_id = M('maze_monster_goods')->add($data);
        if($in_id){
			D('admin_log')->admin_log('添加迷宫配置 迷宫ID:'.$data['maze_id'].'，ID为:'.$in_id);
            return true;
        }else{
            return false;
        }
	}
	

    //删除迷宫怪物物品配置
    public function maze_monster_goods_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
		
		if(M('maze_monster_goods')->where('id in ('.$ids.')')->delete()){ //删除迷宫配置
			D('admin_log')->admin_log('删除迷宫配置');
			return true;
		}else{
			D('admin_log')->admin_log('删除迷宫配置失败');
			return false;
		}	
		
    }		

	 
	//修改迷宫怪物物品配置
	public function maze_monster_goods_edit($data,$id){

		if(M('maze_monster_goods')->where('id='.$id)->save($data)){
			D('admin_log')->admin_log('修改迷宫配置，迷宫ID为'.$data['maze_id'].' 配置ID为：'.$id);
			return true;
		}else{
			D('admin_log')->admin_log('修改迷宫配置，迷宫ID为'.$data['maze_id']);
			return false;
		}
		
	}
		
}