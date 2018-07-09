<?php

namespace app\admin\validate;

use think\Validate;

class Menu extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'name'	    =>	'require',
    	'pid'	    =>	'require|number',
        'is_show'   =>  'require|in:0,1',
    ];

    // 验证提示信息
    protected $message = [
    	'name.require'	    =>	'请填写栏目名称',
    	'pid.require'	    =>	'请选择上级栏目',
    	'pid.number'        =>	'上级栏目选择错误',
        'is_show.require'   =>  '请选择是否显示',
        'is_show.in'        =>  '是否显示选择错误',
    ];

    // 验证场景 scene = ['edit'=>'name1,name2,...']
    protected $scene = [
        'insert'   =>  'name,pid',
        'update'  =>  'name,pid,is_show',
    ];
}