<?php
namespace Game\Controller;
use Think\Controller;
class IndexController extends CommonController {
	//本内容目前只针对11

    public function index(){
		
		$content = $this->get_web_content();
		$res_num = $this->get_data_num($content);
		$personals = $this->get_personal_msg();
		$act_log = $this->get_betting_log();

		$this->assign('res_num',$res_num);
		$this->assign('personals',$personals);
		$this->assign('act_log',$act_log);
        $this->display();
    }
	
	//获取登录信息
    public function login(){
		
		$login_url = "http://www.hsqkzj.com/login.php";
		$verify_code_url = "http://www.hsqkzj.com/vcode.php?t=".rand(1000000000,9999999999);
		com_curl_get_cookie($login_url,$verify_code_url);
		
        $this->display();
    }
	
	//登录
	public function real_login(){
		if($_POST){
			$real_login_url = "http://www.hsqkzj.com/slogin.php?act=login";
			$post_data['username'] = "84656855@qq.com";
			$post_data['pass'] = "geg841120";
			$post_data['iskeep'] = 0;
			$post_data['vcode'] = $_POST['code'];
			$result = com_curl_get_content($real_login_url,$post_data);

			if(strpos($result,'ok') !== false){
				$data['error'] = 0;
				$data['msg'] = '登录成功';
				header('Location: index.php?m=game&c=index&a=index');
			}else{
				$data['error'] = 1;
				$data['msg'] = '登录失败';
			}
			
		}else{
			$data['error'] = 2;
			$data['msg'] = '请求方式错误';
		}
		
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
	
	//获取内容
	public function get_web_content(){
		$num = rand(1000000000,9999999999);
		$content_url = "http://www.hsqkzj.com/sgame.php?act=2&c=1&t=0.".$num;		
		$result = com_curl_get_content($content_url);
	
		return $result;
	}
	
	//获取历史记录11 中奖信息
	public function get_data_num($content){
		
		$regex_qishu = '/<td>\d{7,9}<\/td>/i';
		$matches_qishu = array();
		preg_match_all($regex_qishu, $content, $matches_qishu);
		
		$regex_time = '/<td>\d{2}-\d{2} \d{2}:\d{2}:\d{2}<\/td>/i';
		$matches_time = array();
		preg_match_all($regex_time, $content, $matches_time);

		$regex_res = "/class='mh m\d{1,2}'><\/i><\/td>/i";
		$matches_res = array();
		preg_match_all($regex_res, $content, $matches_res);	
		
		//期数集合
		if($matches_qishu[0]){
			foreach($matches_qishu[0] as $key=>$value){
				if($key > 3){
					$qishus[] = str_replace('</td>','',str_replace('<td>','',$value));
				}
			}
		}
		$res['qishus'] = $qishus;
		
		//时间集合
		if($matches_time[0]){
			foreach($matches_time[0] as $key=>$value){
				if($key > 3){
					$times[] = str_replace('</td>','',str_replace('<td>','',$value));
				}
			}
		}
		$res['times'] = $times;
	
	    //结果集合
		if($matches_res){
			foreach($matches_res as $key=>$value){
				$matches_res[$key] = str_replace("class='mh m","",str_replace("'></i></td>","",$value));
			}
		}
		$res['ress'] = $matches_res[0];	

		foreach($res['ress'] as $value){
			$res_ress .= $value." - ";
		}
		$res['ress_all'] = $res_ress;	
		
		//下一期
		$regex_next_qishu = "/var curNo = '\d{7,9}'/i";
		$matches_next_qishu = array();
		preg_match_all($regex_next_qishu, $content, $matches_next_qishu);			
		$next_qishu = str_replace("'","",str_replace("var curNo = '","",$matches_next_qishu[0][0]));
		$res['next_qishu'] = $next_qishu;

		//离下期开奖时间
		$regex_next_time = "/var kjSec = '\d{1,2}'/i";
		$matches_next_time = array();
		preg_match_all($regex_next_time, $content, $matches_next_time);			
		$next_time = str_replace("'","",str_replace("var kjSec = '","",$matches_next_time[0][0])) + 10 + rand(0,10);		//10秒随机下注时间 
		$res['next_time'] = $next_time;
		
		//下期预测
		$res['next_hope_num'] = $this->get_next_hope_num($res['ress']);  //调用方法生成
		
		//本期数
		$res['this_qishu'] = $res['qishus'][0];
		$res['this_qi_result'] = $res['ress'][0];
		$res['this_qi_time'] = $res['times'][0];
	
		//本期预测结果
		if(isset($_SESSION['next_hope_num'])){
			$res['this_hope_num'] = $_SESSION['next_hope_num'];  //查找本期预测 或 再次预测
			$res_this_hope_num = explode(',',$res['this_hope_num']);
			if(in_array($res['this_qi_result'],$res_this_hope_num)){
				$res['this_hope_result'] = '对';		
			}else{
				$res['this_hope_result'] = '错';
			}	
			
			//插入到数据库里
			if(!M('action_log')->where('number='.$res['this_qishu'])->find()){
				$save_data['number'] = $res['this_qishu'];
				$save_data['date_time'] = date('Y',time())."-".$res['this_qi_time'];
				$save_data['res_num'] = $res['this_qi_result'];
				$save_data['add_time'] = date('Y-m-d H:i:s',time());
				$save_data['hope_num'] = $res['this_hope_num'];
				$save_data['hope_res'] = $res['this_hope_result'];
				$save_data['tag'] = '急速11';			
				M('action_log')->add($save_data);				
			}
		}
		$_SESSION['next_hope_num'] = $res['next_hope_num'];
		
		return $res;
	}
	
	
	//下注 买进11
	public function set_data_num($data_nmu=array()){
		$buy_url = "http://www.hsqkzj.com/sgameservice.php?t=".rand(1000000000,9999999999);
		
		$num_str = '';
		if($data_nmu){
			foreach($data_nmu as $value){
				$num_str .= $value.",";
			}
		}
		
		$data['act'] = "savepress";  
		$data['gtype'] = 2;             //下注类型  急速11
		$data['no'] = 1148267;          //下注期数
		$data['press'] = $num_str;      //下注号及金额 
		$data['total'] = 180;                                    //下注总额
		$result = com_curl_get_content($buy_url,$data);
		
		return $result;
	} 
	
	
	//获取个人信息
	public function get_personal_msg(){
		$url = "http://www.hsqkzj.com/";
		$result = com_curl_get_content($url);
		$regex = "/<i id=\"iPoints\" class=\"coin\">\d{1,11}<\/i>/i";
		$matches = array();
		preg_match_all($regex, $result, $matches);			
		$res['ipoints'] = str_replace("</i>","",str_replace("<i id=\"iPoints\" class=\"coin\">","",$matches[0][0]));
		
		return $res;
	}
	
	
	//获取历史记录11
	public function get_betting_log(){
		return M('action_log')->order('number desc')->limit(10)->select();
	}	
	
	
	//11预测
	public function get_next_hope_num($data){
		$res = '';
		if($data){
			$res_data = array_unique($data);
			asort($res_data);
			foreach($res_data as $value){
				$res .= $value.",";
			}
		}
		return $res;
	}
	
	
	
}























