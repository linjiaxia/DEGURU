<?php

namespace app\admin\validate;

use think\Validate;

class Role extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'name'	    =>	'require|max:10|chs',
    	'describe'  =>  'require|max:15|chs',
        'pri_id'    =>  'require',
    ];

    // 验证提示信息
    protected $message = [
    	'name.require'	    =>	'请填写角色名称',
    	'name.chs'		    =>	'角色名称必须填写中文',
        'name.max'          =>  '角色名称不能超过10个字',
    	'describe.require'  =>  '请填写描述内容',
        'describe.chs'      =>  '角色描述必须填写中文',
        'describe.max'      =>  '角色描述不能超过15个字',
        'pri_id.require'    =>  '请分配权限',
    ];
}