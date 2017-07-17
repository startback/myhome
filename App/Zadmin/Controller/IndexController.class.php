<?php
namespace Zadmin\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
        $this->display();
    }

    //网站设置页
    public function info(){
        $this->display();
    }

	
	//统计页面
	public function statistics(){
		
		$days['today'] = date('Y-m-d');
		$days['today_1'] = date('Y-m-d', strtotime("$today -1 day"));
		$days['today_2'] = date('Y-m-d', strtotime("$today -2 day"));
		$days['today_3'] = date('Y-m-d', strtotime("$today -3 day"));
		$days['today_4'] = date('Y-m-d', strtotime("$today -4 day"));
		$days['today_5'] = date('Y-m-d', strtotime("$today -5 day"));
		$days['today_6'] = date('Y-m-d', strtotime("$today -6 day"));
		$days['today_7'] = date('Y-m-d', strtotime("$today -7 day"));
		$days['today_8'] = date('Y-m-d', strtotime("$today -8 day"));
		
		$nums['today'] = $this->get_day_pvip_num($days['today'],$days['today']);
		$nums['today_1'] = $this->get_day_pvip_num($days['today_1'],$days['today_1']);
		$nums['today_2'] = $this->get_day_pvip_num($days['today_2'],$days['today_2']);
		$nums['today_3'] = $this->get_day_pvip_num($days['today_3'],$days['today_3']);
		$nums['today_4'] = $this->get_day_pvip_num($days['today_4'],$days['today_4']);
		$nums['today_5'] = $this->get_day_pvip_num($days['today_5'],$days['today_5']);
		$nums['today_6'] = $this->get_day_pvip_num($days['today_6'],$days['today_6']);
		$nums['today_7'] = $this->get_day_pvip_num($days['today_7'],$days['today_7']);
		$nums['today_8'] = $this->get_day_pvip_num($days['today_8'],$days['today_8']);

		$max_num = 0;
		foreach($nums as $value){
			if($value['pv_num'] > $max_num) $max_num = $value['pv_num'];
		}
		$max_num = intval($max_num * 1.1);
		
		$this->assign('max_num',$max_num);
		$this->assign('days',$days);
		$this->assign('nums',$nums);
		
		$this->display();
	}
	
	
	
    //修改密码
    public function pass(){
        if($_POST){
            $pass = $_POST['m_pass'];
            $new_pass = $_POST['new_pass'];
            if(strtolower(md5($pass)) == strtolower(bin2hex($_SESSION['zadmin']['info']['admin_pass']))){
                $data['admin_pass'] = hex2bin(md5($new_pass));
                if(D('admin')->mod_admin_pass($_SESSION['zadmin']['info']['admin_id'],$data)){
                    $_SESSION['zadmin']['info']['admin_pass'] = $data['admin_pass'];
                    $this->success('修改成功');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error('密码错误');
            }
        }else{
            $this->display();
        }
    }

    //登录
    public function login(){

        if($_POST){

            $code = $_POST['code'];
            $admin_account = $_POST['admin_account'];
            $admin_pass = $_POST['admin_pass'];

            if(!$code || !$this->check_code($code)){
                $this->error('验证码错误');
                exit;
            }


            if(D('admin')->login($admin_account,$admin_pass,com_get_ip())){
				header('Location: index.php?m=zadmin&c=index&a=index');
            }else{
                $this->error('帐号或密码错误');
            }

        }else{
            $this->display();
        }
    }


    //登出
    public function logout(){
        unset($_SESSION['zadmin']['info']);
		header('Location: index.php?m=zadmin&c=index&a=login');
    }


    //获取验证码
    public function get_code(){
        $config =    array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
        );
        $Verify =     new \Think\Verify($config);
        $Verify->codeSet = '0123456789';
        $Verify->entry();
    }

    //检测验证码
    public function check_code($code,$id=''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

	
	/*
	*获取某些天的PV/IP数量
	* date $s_day
	* date $e_day
	* return arr
	*/
	public function get_day_pvip_num($s_day,$e_day){
		$arr = array();
	
		$start_time = $s_day." 00:00:00";
		$end_time = $e_day." 24:00:00";
	
		$sql = "select count(id) num from ".C('DB_PREFIX')."statistics where add_time>='".$start_time."' and add_time<'".$end_time."' group by ip_address";
		$res = M('statistics')->query($sql);			
		
		if($res){
			$arr['ip_num'] = count($res);
			foreach($res as $value){
				$arr['pv_num'] += $value['num'];
			}
		}else{
			$arr['pv_num'] = 0;
			$arr['ip_num'] = 0;
		}
		
		return $arr;
	}
	
	

}