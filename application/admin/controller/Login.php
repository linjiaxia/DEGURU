<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Url;
use think\Session;
use app\admin\validate\Login as validate;

class Login extends Controller
{

	function _empty()
	{
		$this->redirect(Url::build('Login/index'));
	}

	function index()
	{
		return $this->fetch();
	}

	function login(Request $request)
	{
		if($request->isAjax()){
			$data = $request->post();
			$validate = new validate;
			if(!$validate->check($data))
                return json( getMsg(0,$validate->getError()) );
            
        	$userinfo = Db::name('admin')->field('id,name,password,is_use')->where('username',$data['username'])->find();
        	if(!$userinfo)
        		return json( getMsg(0,'用户不存在') );
        	else{
        		$data['password'] = md5($data['password'] . crypt('shabi','shi'));
        		if($userinfo['password'] != $data['password'])
        			return json( getMsg(0,'密码错误') );
        		else{
        			if($userinfo['is_use'] != 1 && $userinfo['id'] != 1)
        				return json( getMsg(0,'该账户已被禁用') ); 
        			else{
        				Session::set('id',$userinfo['id']);
            			Session::set('name',$userinfo['name']);
            			return json( getMsg(1,'登录成功',url('Index/index')) );
        			}
        		}
        	}
		}
	}
}