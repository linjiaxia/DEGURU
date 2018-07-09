<?php

namespace app\admin\validate;

use think\Validate;

class Banner extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'name'      =>  'require|chs|max:10',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'      =>  '请输入banner名称',
        'name.chs'          =>  'banner名称只能用中文',
        'name.max'          =>  'banner名称至多填写10个字',
    ];
}