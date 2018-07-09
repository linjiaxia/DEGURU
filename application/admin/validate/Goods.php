<?php

namespace app\admin\validate;

use think\Validate;

class Goods extends Validate
{
	// 当前验证的规则
    protected $rule = [
        'name'       		=>  'require',
        'feature'           =>  'require',
        'cat_id'     		=>  'require|number',
        'brand_id'	 		=>	'require|number',
        'supermarket_price'	=>	'require|gt:0',
        'shop_price'		=>	'require|gt:0',
        'is_promote'		=>	'require|number',
        'is_hot'			=>	'require|number',
        'is_new'			=>	'require|number',
        'is_best'			=>	'require|number',
        'is_sale'			=>	'require|number',
        'goods_desc'		=>	'require',
        'type_id'			=>	'require|number',
    ];

    // 验证提示信息
    protected $message = [
        'name.require'              =>  '请填写商品名称',
        'feature.require'       	=>  '请填写商品特色',
        'cat_id.require'            =>  '请选择主分类',
        'cat_id.number'      		=>  '主分类选择错误',
        'brand_id.require'          =>  '请选择品牌',
        'brand_id.number'    		=>  '品牌选择错误',
        'supermarket_price.require'	=>	'请填写市场价格',
        'supermarket_price.gt'		=>	'市场价格不能低于0元',
        'shop_price.require'		=>	'请填写本店价格',
        'shop_price.gt'				=>	'本店价格不能低于0元',
        'is_promote.require'   		=>  '请选择是否促销',
        'is_promote.number'    		=>  '是否促销选择错误',
        'is_hot.require'   			=>  '请选择是否热销',
        'is_hot.number'    			=>  '是否热销选择错误',
        'is_new.require'   			=>  '请选择是否新品',
        'is_new.number'    			=>  '是否新品选择错误',
        'is_best.require'   		=>  '请选择是否推荐',
        'is_best.number'    		=>  '是否推荐选择错误',
        'is_sale.require'   		=>  '请选择是否上架',
        'is_sale.number'    		=>  '是否上架选择错误',
        'goods_desc.require'		=>	'请填写商品描述',
        'type_id.require'           =>  '请选择商品类型',
        'type_id.number'    		=>  '商品类型选择错误',
    ];	
}