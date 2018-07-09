<?php

namespace app\admin\validate;

use think\Validate;

class Nav extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'name'	    =>	'require|chs|max:10',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'      =>  '请输入导航名称',
        'name.chs'          =>  '导航名称只能用中文',
    	'name.max'	        =>	'导航名称至多填写10个字',
    ];
}