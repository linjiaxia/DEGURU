<?php

namespace app\admin\validate;

use think\Validate;

class Level extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'name'          =>  'require',
        'bottom_number' =>  'lt:top_number',
        'top_number'    =>  'require',
        'rate'          =>  'require|elt:100|egt:90',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'          =>  '请填写会员级别名称',
        'bottom_number.lt'      =>  '积分下限不能高于上限',
        'top_number.require'    =>  '请填写会员所需积分上限',
        'rate.require'          =>  '请填写折扣率',
        'rate.elt'              =>  '折扣率填写有误',
        'rate.egt'              =>  '折扣率不能低于9折',
    ];
}