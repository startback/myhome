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
	
/* 	
    //删除迷宫
    public function maze_del($ids){
		if(empty($ids)){
			return false;
			exit;
		}
		
		$res = true;
		//开始事务
		M()->startTrans(); 
		if(M('maze')->where('maze_id in ('.$ids.')')->delete()){ //删除迷宫
			if(M('maze_monster_goods')->where('maze_id in ('.$ids.')')->find()){  //删除迷宫配置
				if(M('maze_monster_goods')->where('maze_id in ('.$ids.')')->delete()){
							
				}else{
					M()->rollback();
					$res = false;
				} 
			}
		}else{
			$res = false;
		}			
		M()->commit(); 
		//事务结束		

		if($res){
			D('admin_log')->admin_log('删除迷宫，ID为'.$ids);
		}else{
			D('admin_log')->admin_log('删除迷宫失败，ID为'.$ids);
		}		
		
        return $res;  		
    }		
	
	//修改迷宫
	public function maze_edit($data,$maze_id){

		if(M('maze')->where('maze_id='.$maze_id)->save($data)){
			D('admin_log')->admin_log('修改迷宫，ID为'.$maze_id);
			return true;
		}else{
			D('admin_log')->admin_log('修改迷宫失败 ID为:'.$maze_id);
			return false;
		}
		
	} */
		
}