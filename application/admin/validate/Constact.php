<?php

namespace app\admin\validate;

use think\Validate;

class Constact extends Validate
{
	// 当前验证的规则
    protected $rule = [
    	'name'		=>	'require',
    	'url'		=>	'require',
    	'content'	=>	'require',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'		=>	'请填写名称',
        'url.require'		=>	'请填写路由',
        'content.require'	=>	'请填写内容',
    ];

    // 验证场景 scene = ['edit'=>'name1,name2,...']
    protected $scene = [
        'header'    =>  'name,url',
        'middle'	=>	'name,url,content',
        'footer'    =>  'content',
    ];
}