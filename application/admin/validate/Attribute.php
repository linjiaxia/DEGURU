<?php

namespace app\admin\validate;

use think\Validate;

class Attribute extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'type_id'       =>  'require|number',
        'name'          =>  'require',
    	'choice'	    =>	'require|in:0,1',
    ];

    // 验证提示信息
    protected $message = [
        'type_id.require'       =>  '请选择所属类型',
        'type_id.number'        =>  '所属类型选择错误',
        'name.require'          =>  '请填写属性名称',
        'choice.require'        =>  '请选择属性类型',
    	'choice.in'	            =>	'属性类型选择错误',
    ];
}