<?php

namespace app\admin\validate;

use think\Validate;

class Login extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'captcha'	    =>	'require|captcha',
        'username'      =>  'require',
        'password'      =>  'require',
    ];

    // 验证提示信息
    protected $message = [
        'captcha.require'       =>  '请输入验证码',
    	'captcha.captcha'	    =>	'验证码不正确',
        'username.require'      =>  '请输入账号',
        'password.require'      =>  '请输入密码',
    ];
}