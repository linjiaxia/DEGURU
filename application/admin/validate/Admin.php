<?php

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'username'	   =>	'require|regex:/^[a-zA-Z][a-zA-Z0-9]{7,17}$/|unique:admin',
        'name'         =>   'require|chsAlpha|unique:admin',
        'password'     =>   'require|alphaDash|min:6|max:16|confirm:repassword',
        'gender'       =>   'require|in:0,1',
        'phone'        =>   'require|regex:/^1[34578]\d{9}$/',
        'email'        =>   'require|email',
        'role_id'      =>   'require',
        'is_use'       =>   'require|in:0,1',
    ];

    // 验证提示信息
    protected $message = [
        'username.require'      =>  '请填写账号',
        'username.regex'        =>  '帐号必须使用字母或者字母和数字组成，账号不能以数字开头，8～18位',
        'username.unique'       =>  '帐号已存在',
        'name.require'          =>  '请填写昵称',
        'name.chsAlpha'         =>  '昵称只能使用汉字和字母',
        'name.unique'           =>  '昵称已存在',
        'password.require'      =>  '请输入密码',
        'password.alphaDash'    =>  '密码只能使用字母、数字、下划线及破折号',
        'password.min'          =>  '密码至少填写6位',
        'password.max'          =>  '密码至多填写16位',
        'password.confirm'      =>  '确认密码输入不一致',
        'gender.require'        =>  '请选择性别',
        'gender.in'             =>  '性别选择错误',
        'phone.require'         =>  '请填写手机号码',
        'phone.regex'           =>  '手机格式不正确',
        'email.require'         =>  '请填写邮箱',
        'email.email'           =>  '邮箱格式不正确',
        'role_id.require'       =>  '请分配对应角色',
        'is_use.require'        =>  '请选择启用或禁用',
        'is_use.in'             =>  '是否启用选择不正确',
    ];

    // 验证场景 scene = ['edit'=>'name1,name2,...']
    protected $scene = [
        'insert'    =>  'username,name,password,gender,phone,email,role_id',
        'edit'      =>  'name,role_id',
        'update'    =>  'name,password,role_id',
    ];
}