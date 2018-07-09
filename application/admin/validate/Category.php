<?php

namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'name'	    =>	'require',
    	'pid'	    =>	'require|number',
    ];

    // 验证提示信息
    protected $message = [
    	'name.require'	    =>	'请填写分类名称',
    	'pid.require'	    =>	'请选择上级分类',
    	'pid.number'	    =>	'上级分类选择错误',
    ];
}