<?php
namespace Ttfgame\Controller;
use Think\Controller;
class IndexController extends CommonController {
	
	//游戏首页
    public function index(){
       $this->display();
    }
	
	//塔内
	public function ttf_inside(){
		$this->display();
	}
	
	//登录页面
	public function login(){
		$this->display();
	}
	
	//登录操作
	public function act_login(){
		
		if($_POST){
			$user_phone = isset($_POST['user_phone'])?trim($_POST['user_phone']):'';
			$user_pass = isset($_POST['user_pass'])?trim($_POST['user_pass']):'';
			
			if(empty($user_phone) || empty($user_pass)){
				$msg_action = "请写用户名或密码";
			}else{
				//查询  登录接口
				
				//成功则跳转首页
				if(true){
					$_SESSION['user'] = '';
					header('Location: index.php?m=ttfgame&c=index&a=index');
					exit;
				}else{
					$msg_action = "用户名或密码错误";
				}
			}
		}else{
			$msg_action = "请求方法错误";
		}
		$url="index.php?m=ttfgame&c=index&a=msg_action&msg_action=";
		$url .= $msg_action;
		header('Location: '.$url);
	}
	
	//注册页面
	public function register(){
		$this->display();
	}
	//注册操作
	public function act_register(){

	}	
	
	//错误信息提示
	public function msg_action(){
		$msg_action = isset($_GET['msg_action'])?trim($_GET['msg_action']):'646464';
		
		$this->assign('msg_action',$msg_action);
		$this->display();
	}
	
}