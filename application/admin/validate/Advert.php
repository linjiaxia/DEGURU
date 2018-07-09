<?php

namespace app\admin\validate;

use think\Validate;

class Advert extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'name'      =>  'require|chs',
        'url'       =>  'require',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'      =>  '请填写公司名称',
        'name.chs'          =>  '公司名称只能用中文',
        'url.require'       =>  '请填写广告链接地址',
    ];
}