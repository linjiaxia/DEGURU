<?php

namespace app\admin\validate;

use think\Validate;

class Privilege extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'name'	    =>	'require',
    	'pid'	    =>	'require|number',
    ];

    // 验证提示信息
    protected $message = [
    	'name.require'	    =>	'请填写栏目名称',
    	'pid.require'	    =>	'请选择上级栏目',
    	'pid.number'        =>	'上级栏目选择错误',
    ];
}