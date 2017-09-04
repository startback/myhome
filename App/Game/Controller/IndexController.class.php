<?php
namespace Game\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
		
		//豆玩28
		$login_url = "http://www.hsqkzj.com/login.php";
		$verify_code_url = "http://www.hsqkzj.com/vcode.php?t=".rand(1000,9999);
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
				
				echo $this->get_web_content();
				exit;
				
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
		// file_put_contents('d://game_content.txt',$result);
		
	}
	
	
	public function get_data_num(){
		$content = file_get_contents('d://game_content.txt');
		
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
		$res['next_hope_num'] = '';
		
		//本期数
		$res['this_qishu'] = $next_qishu - 1;
		$res['this_qi_result'] = $res['ress'][0];
		
		//本期预测结果
		$res['this_hope_num'] = '';  //查找本期预测
		$res['this_hope_result'] = '';   //本期预测结果 对或错
		
		
		var_dump($res);
	}
	
	
	
	
}























