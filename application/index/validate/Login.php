<?php

namespace app\index\validate;

use think\Validate;

class Login extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'captcha'      =>   'require|captcha',
        'username'     =>   'require|regex:/^[a-zA-Z][a-zA-Z0-9]{5,17}$/|unique:member',
        'password'     =>   'require|alphaDash|min:6|max:16|confirm:repassword',
        'phone'        =>   'require|regex:/^1[34578]\d{9}$/|unique:member',
        'email'        =>   'require|email',
    ];

    // 验证提示信息
    protected $message = [
        'captcha.require'       =>  '请输入验证码',
        'captcha.captcha'       =>  '验证码不正确',
        'username.require'      =>  '请填写账号',
        'username.regex'        =>  '帐号必须使用字母或者字母和数字组成，账号不能以数字开头，6～18位',
        'username.unique'       =>  '帐号已存在',
        'password.require'      =>  '请输入密码',
        'password.alphaDash'    =>  '密码只能使用字母、数字、下划线及破折号',
        'password.min'          =>  '密码至少填写6位',
        'password.max'          =>  '密码至多填写16位',
        'password.confirm'      =>  '确认密码输入不一致',
        'phone.require'         =>  '请填写手机号码',
        'phone.regex'           =>  '手机格式不正确',
        'phone.unique'          =>  '手机号码已存在',
        'email.require'         =>  '请填写邮箱',
        'email.email'           =>  '邮箱格式不正确',
    ];

    // 验证场景 scene = ['edit'=>'name1,name2,...']
    protected $scene = [
        'register'    =>  'username,password,phone,email',
        'login'       =>  'captcha',
        'getCode'     =>  'phone',
    ];
}