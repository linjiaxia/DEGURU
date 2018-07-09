<?php

namespace app\index\validate;

use think\Validate;

class Member extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'name'      =>  'require|chsDash',
        'gender'    =>  'require|in:0,1,2',
        'YYYY'      =>  'require|number',
        'MM'        =>  'require|number',
        'DD'        =>  'require|number',
        'real_name' =>  'require|chs',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'       =>  '请填写昵称',
        'name.chsDash'       =>  '昵称只能使用汉字、字母、数字和下划线及破折号',
        'gender.require'     =>  '请选择性别',
        'gender.in'          =>  '性别选择错误',
        'YYYY.require'       =>  '请选择出生年份',
        'YYYY.number'        =>  '出生年份选择错误',
        'MM.require'         =>  '请选择出生月份',
        'MM.number'          =>  '出生月份选择错误',
        'DD.require'         =>  '请选择出生日期',
        'DD.number'          =>  '出生日期选择错误',
        'real_name.require'  =>  '请填写真实姓名',
        'real_name.chs'      =>  '姓名必须为中文',
    ];
}