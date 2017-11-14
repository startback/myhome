<?php
namespace Ttfapi\Controller;
use Think\Controller;
class IndexController extends CommonController {
	
	//默认注册赠送的角色
	private $mo_role_id = 1;
	
    public function index(){
        echo '你真的来了';
    }
	
	
	//登录
	public function login(){
		
		$user_phone = isset($_REQUEST['user_phone'])?trim($_REQUEST['user_phone']):'';
		$user_pass = isset($_REQUEST['user_pass'])?trim($_REQUEST['user_pass']):'';
		
		if(empty($user_phone) || empty($user_pass)){				
			$res['code'] = 101;
			$res['msg'] = "手机或密码不能为空";
			$res['data'] = array();				
		}else{
			//查询  登录接口
			$user_info = M('user')->where('user_phone='.$user_phone)->find();	

			if($user_info){
				if(bin2hex($user_info['user_pass']) == strtolower(md5($user_pass))){
					$user_info_too = M('user_info')->where('user_id='.$user_info['user_id'])->find();
					$user_role_info = M('user_role')->where('user_role_id='.$user_info_too['user_role_id'])->find();;
					
					//更新登录时间
					$up_data['user_login_time'] = date('Y-m-d H:i:s',time());
					M('user')->where('user_id='.$user_info['user_id'])->save($up_data);
					
					//取出需要返回的信息
					$get_data['user_id'] = $user_info['user_id'];
					$get_data['user_name'] = $user_info['user_name'];
					$get_data['user_phone'] = $user_info['user_phone'];
					$get_data['user_sex'] = $user_info['user_sex'];
					$get_data['user_head'] = $user_info['user_head'];
					$get_data['user_birthday'] = $user_info['user_birthday'];
					$get_data['user_reg_time'] = $user_info['user_reg_time'];
					$get_data['user_login_time'] = $user_info['user_login_time'];
					$get_data['user_status'] = $user_info['user_status'];
					
					$get_data['user_ttbi'] = $user_info_too['user_ttbi'];
					$get_data['user_gold'] = $user_info_too['user_gold'];
					$get_data['user_vip'] = $user_info_too['user_vip'];
					$get_data['user_role_id'] = $user_info_too['user_role_id'];
					
					$get_data['attack'] = $user_role_info['attack'];
					$get_data['magic'] = $user_role_info['magic'];
					$get_data['hp'] = $user_role_info['hp'];
					$get_data['mp'] = $user_role_info['mp'];
					$get_data['attack_defense'] = $user_role_info['attack_defense'];
					$get_data['magic_defense'] = $user_role_info['magic_defense'];
					$get_data['dodge'] = $user_role_info['dodge'];
					$get_data['direct'] = $user_role_info['direct'];
					$get_data['crit'] = $user_role_info['crit'];
					$get_data['skill_ids'] = $user_role_info['skill_ids'];

					$res['code'] = 0;
					$res['msg'] = "登录成功";
					$res['data'] = $get_data;							
				}else{
					$res['code'] = 101;
					$res['msg'] = "用户名或密码错误";
					$res['data'] = array();	
				}					
			}else{
				$res['code'] = 101;
				$res['msg'] = "手机或密码错误";
				$res['data'] = array();						
			}
		}


		echo json_encode($res,JSON_UNESCAPED_UNICODE);		
	}
	
	
	
	//注册
	public function register(){
			
		$user_phone = isset($_REQUEST['user_phone'])?trim($_REQUEST['user_phone']):'';
		$user_pass = isset($_REQUEST['user_pass'])?trim($_REQUEST['user_pass']):'';
		
		if(empty($user_phone) || empty($user_pass)){				
			$res['code'] = 101;
			$res['msg'] = "手机或密码不能为空";
			$res['data'] = array();				
		}else{
			//手机是否已存在
			if(M('user')->where('user_phone='.$user_phone)->find()){
				$res['code'] = 102;
				$res['msg'] = "手机号已存在";
				$res['data'] = array();						
			}else{
				//生成数据，插入数据库
				$user_pass = hex2bin(strtolower(md5($user_pass)));
				$save_data['user_name'] = "ttf_".substr($user_phone,0,4)."****".substr($user_phone,7,4);
				$save_data['user_phone'] = $user_phone;
				$save_data['user_pass'] = $user_pass;
				$save_data['user_reg_time'] = date('Y-m-d H:i:s',time());
				
				$res['code'] = 103;
				$res['msg'] = "注册失败，如重复出现请联系管理员！";
				$res['data'] = array();	
				
				M()->startTrans();  //开始事务
				if($in_user_id = M('user')->add($save_data)){
					//查询默认的角色
					$need_role = M('role')->where('role_id='.$this->mo_role_id)->find();
					
					//生成默认首个角色
					$u_role_data['user_id'] = $in_user_id;
					$u_role_data['role_id'] = $this->mo_role_id;
					$u_role_data['add_time'] = date('Y-m-d H:i:s',time());
					$u_role_data['attack'] = $need_role['role_attack'];
					$u_role_data['magic'] = $need_role['role_magic'];
					$u_role_data['hp'] = $need_role['role_hp'];
					$u_role_data['mp'] = $need_role['role_mp'];
					$u_role_data['attack_defense'] = $need_role['role_attack_defense'];
					$u_role_data['magic_defense'] = $need_role['role_magic_defense'];
					$u_role_data['dodge'] = $need_role['role_dodge'];
					$u_role_data['direct'] = $need_role['role_direct'];
					$u_role_data['crit'] = $need_role['role_crit'];
					$u_role_data['skill_ids'] = $need_role['role_skill_id'];
					
					if($n_user_role_id = M('user_role')->add($u_role_data)){					
						$u_info_data['user_id'] = $in_user_id;
						$u_info_data['user_ttbi'] = 0;
						$u_info_data['user_gold'] = 0;
						$u_info_data['user_vip'] = 0;
						$u_info_data['user_role_id'] = $n_user_role_id;	
						
						if(M('user_info')->add($u_info_data)){
							$res['code'] = 0;
							$res['msg'] = "注册成功";
							$res['data'] = '';//$_user_info;
						}else{
							M()->rollback();							
						}													
					}else{
						M()->rollback();									
					}
				}
				M()->commit();   //事务结束			 	
			}
		}

		echo json_encode($res,JSON_UNESCAPED_UNICODE);		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}