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


}