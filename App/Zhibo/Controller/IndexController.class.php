<?php
namespace Zhibo\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
		$now_time = date('Y-m-d H:i:s',time());
				
		$where = C('DB_PREFIX').'action.is_show=1 and '.C('DB_PREFIX').'action.is_del=0 ';
        $act_l = M('action')->field(C('DB_PREFIX').'action.*,'.C('DB_PREFIX').'action_type.type_name,'.C('DB_PREFIX').'action_type.type_desc')->join(C('DB_PREFIX').'action_type ON '.C('DB_PREFIX').'action.type_id = '.C('DB_PREFIX').'action_type.type_id')->where($where)->order('act_id desc')->select();
	
		$week_days = array(
			0  =>  '星期日',
			1  =>  '星期一',
			2  =>  '星期二',
			3  =>  '星期三',
			4  =>  '星期四',
			5  =>  '星期五',
			6  =>  '星期六'
		);
		
		if($act_l){
			foreach($act_l as $key=>$value){
				$dates = explode(' ',$value['act_time']);
				$act_l[$key]['date'] = $dates[0];
				$act_l[$key]['time'] = substr($dates[1] , 0 , 5);	
				$act_l[$key]['week'] = $week_days[date("w",strtotime($dates[0]))];	
				$act_l[$key]['is_start'] = 0;	
				if($now_time >= $value['act_time']) $act_l[$key]['is_start'] = 1;
			}
		}
		
		$act_list = array();
		if($act_l){
			foreach($act_l as $value){
				$act_list[$value['date']]['data'][] = $value;
				$act_list[$value['date']]['week_day'] = $value['week'];
				$act_list[$value['date']]['month_date'] = date('m月d日',strtotime($value['act_time']));
			}	
			ksort($act_list);
		}
	
		//记录统计信息
		$data['ip_address'] = com_get_ip();
		$data['add_time'] = date('Y-m-d H:i:s',time());
		M('statistics')->add($data);
	
		$this->assign('now_time',$now_time);
		$this->assign('act_list',$act_list);
		$this->display();
    }

}