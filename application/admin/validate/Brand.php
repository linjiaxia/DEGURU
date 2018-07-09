<?php

namespace app\admin\validate;

use think\Validate;

class Brand extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'name'       =>  'require',
        'url'        =>  'require|url',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'       =>  '请填写品牌名称',
        'url.require'        =>  '请填写url地址',
        'url.url'        	 =>  '填写的url地址无效',
    ];
}