<?php

namespace app\index\validate;

use think\Validate;

class Address extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'name'      =>  'require|chs',
        'phone'     =>  'require|regex:/^1[34578]\d{9}$/',
        'prov'      =>  'require',
        'city'      =>  'require',
        'email'     =>  'require|email',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'       =>  '请填写联系人',
        'name.chs'           =>  '请输入正确的联系人姓名',
        'phone.require'      =>  '请填写联系电话',
        'phone.regex'        =>  '联系电话格式有误',
        'prov.require'       =>  '请选择所在省份',
        'city.require'       =>  '请选择所在城市',
        'email.require'      =>  '请填写邮箱地址',
        'email.email'        =>  '邮箱地址格式不正确',
    ];
}