<?php

namespace app\admin\controller;

use think\Db;
use think\Url;
use think\Request;
use app\admin\controller\Index;

class Order extends Index
{
	function _empty()
	{
		$this->redirect(Url::build('Index/index'));
	}

	function index()
	{
		$order = Db::name('order')->alias('o')->join('order_goods og','og.order_id=o.id','left')->join('goods g','g.id=og.goods_id','left')->field('o.id,goods_attr_id,order_number,o.member_id,g.name,phone,prov,city,dist,address,pay_status,post_status,g.name goods_name')->order('o.id','DESC')->paginate(10);
		$orderData = $order->all();
		$page = $order->render();
		foreach($orderData as $k => $v){
			// 收货地址
			$orderData[$k]['address'] = $v['prov'] . $v['city'] . $v['dist'] . $v['address'];
			// 会员名
			$orderData[$k]['member'] = Db::name('member')->field('name')->find($v['member_id'])['name'];
			// 商品参数
			$attr_info = explode(',',$v['goods_attr_id']);
			$attr_info = Db::name('goods_attribute')->field('attribute_value')->whereIn('id',$attr_info)->select();
			$attr_info = array_column($attr_info,'attribute_value');
			$attr_info = join(',',$attr_info);
			$orderData[$k]['attr_name'] = $attr_info;
		}
		$total = Db::name('order')->alias('o')->join('order_goods og','og.order_id=o.id','left')->join('goods g','g.id=og.goods_id','left')->count();

		$this->assign('orderData',$orderData);
		$this->assign('total',$total);
		$this->assign('page',$page);
		// 订单列表页面
		return $this->fetch();
	}

	function detail($id)
	{
		$orderData = Db::name('order')->field('id,name,member_id,phone,prov,city,dist,address,total_price,order_number')->find($id);

		$orderData['address'] = $orderData['prov'] . $orderData['city'] . $orderData['dist'] . $orderData['address'];

		$this->assign('orderData',$orderData);
		// 订单详情
		return $this->fetch();
	}

	function confirm($id)
	{
		if( Db::name('order')->update(['id'=>$id,'post_status'=>1]) )
			return json( getMsg(1,'确认发货成功') );
		else
			return json( getMsg(0,'确认发货失败') );
	}

	function receipt($id)
	{
		if( Db::name('order')->update(['id'=>$id,'post_status'=>2]) )
			return json( getMsg(1,'修改成功') );
		else
			return json( getMsg(0,'修改失败') );
	}
}