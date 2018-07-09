<?php

namespace app\index\controller;

use think\Url;
use think\Request;
use think\Session;
use think\Cookie;
use think\Db;
use app\index\model\Phone;
use app\index\controller\Base;
use app\index\validate\Login as validate;
use app\index\model\Member as model;

class Login extends Base
{
	function index()
	{
		$request = Request::instance();
		if( $request->isAjax() ){
			$data = $request->post();
			// 验证信息
            $validate = new validate;
            if(!$validate->scene('login')->check($data))
                return json( getMsg(0,$validate->getError()) );
            // 查询数据
            if( $data['username'] == '' )
            	return json( getMsg(0,'请输入账号') );
            $userinfo = Db::name('member')->field('id,name,password,status')->where('username',$data['username'])->find();
        	if( !$userinfo || $userinfo['status'] == 2 )
        		return json( getMsg(0,'用户不存在') );
        	else{
        		$data['password'] = md5($data['password'] . crypt('shabi','shi'));
        		if($userinfo['password'] != $data['password'])
        			return json( getMsg(0,'密码错误') );
        		else{
    				Session::set('m_id',$userinfo['id']);
        			Session::set('m_name',$userinfo['name']);
        			if( $temp_id = Cookie::get('m_id') ){
        				$ids = Db::name('cart')->where('member_id',$temp_id)->column('id');
        				Db::name('cart')->whereIn('id',$ids)->update(['member_id'=>$userinfo['id']]);
        			}
        			return json( getMsg(1,'登录成功',Url::build('@member')) );
        		}
        	}
		}else{
			// 登录页面
			return $this->fetch();
		}
	}

	function register(Request $request)
	{
		if( $request->isAjax() ){
			$data = $request->post();
			if( md5( strtolower( $data['code'] ) ) != Session::get('randstr') )
				return json( getMsg(0,'手机验证码不正确') );
			// 验证信息
            $validate = new validate;
            if(!$validate->scene('register')->check($data))
                return json( getMsg(0,$validate->getError()) );
            $data['name'] = md5( GetRandStr(5) );
            $model = new model;
            if($model->save($data))
                return json( getMsg(1,'注册成功',Url::build('@logon')) );
            else
                return json( getMsg(0,'注册失败') );
		}else{
			// 注册页面
			return $this->fetch();
		}
	}

	function getPhoneCode(Request $request)
	{
		$data = $request->post();
		$randstr = GetRandStr(4);
		$validate = new validate;
		if(!$validate->scene('getCode')->check($data))
        	return json( ['respCode'=>01010,'respDesc'=>$validate->getError()] );
        $phone = $data['phone'];
		$phone = new Phone($phone,$randstr);
		if($phone){
			$randstr = md5( strtolower( $randstr ) );
			Session::set('randstr',$randstr);
			return json( $phone->result );
		}else
			return json( $phone->result );
	}

	function logout()
	{
		Session::set('m_id',null);
		$this->redirect( Url::build('@/') );
	}
}