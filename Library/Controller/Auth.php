<?php

namespace Controller;

use \Helper\McHelper;
use \Model\User;

class Auth
{
    public function index()
    {
        throw new \Core\Error('This page is not available', 500);
    }
    
    public function check()
    {
        $data['error'] = 0;
        $data['checkLogin'] = 0;
        echo json_encode($data);
        exit;
    }
    
    public function login()
    {
        $data = array("message"=>"登陆成功", "status"=>1, "error"=>0);
        echo json_encode($data);
        exit;
        // -----> 
        $userData = json_decode(McHelper::unpackc(@$_REQUEST['data']));
        $userName = $userData->user;
        $passWord = $userData->pass; //md5
        $loginIp = $userData->ip;
        $loginTime = time()."000";
        
        $user = new User();
        $user->GetUserByUserName($userName);
        if($user->verifyPassword($passWord)) {
            $data['message'] = "登陆成功";
            $data['status'] = 1;
            $data['error']  = 0;
        } else {
            $data['message'] = "账户或密码错误";
            $data['status'] = 0;
            $data['error']  = 0;
        }
        echo json_encode($data);
        exit;
    }
    
    public function register()
    {
        $data = array("message"=>"注册失败", "status"=>1, "error"=>0);
        echo json_encode($data);
        exit;
    }
}
