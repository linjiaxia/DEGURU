<?php

namespace app\admin\validate;

use think\Validate;

class Type extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'name'	    =>	'require',
    ];

    // 验证提示信息
    protected $message = [
    	'name.require'	    =>	'请填写类型名称',
    ];
}