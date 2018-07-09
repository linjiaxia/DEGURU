<?php

namespace app\index\controller;

use think\Db;
use think\Url;
use think\Session;
use think\Request;
use app\index\controller\Base;

class Pay extends Base
{
	function __construct()
    {
        // 调用父类构造函数
        parent::__construct();
        // 获取会员ID
        $member_id = Session::get('m_id');
        // 验证登录
        if(!$member_id)
            $this->redirect(Url::build('@logon'));
    }

	function setPay(Request $request)
	{
		// 获取当前会员
		$member_id = Session::get('m_id');
		// 会员积分
		$member_credit = Db::name('member')->field('credit')->find($member_id)['credit'];
		// 会员等级
		$member_level = Db::name('member_level')->where('top_number','>',$member_credit)->where('bottom_number','<=',$member_credit)->column('id')[0];
		// 先添加订单表
		Db::name('order')->insert(['member_id'=>$member_id,'create_time'=>time()]);
		$order_id = Db::name('order')->getLastInsID();
		// 拼凑数据
		$cart_id = $request->post('id/a');
		// 获取所有的商品信息
		$data = $request->post();
		unset($data['id']);
		// 勾选的购物车商品信息
		foreach($cart_id as $k => $v){
			$key = $v + 0;
			$info = array_column($data,$key);
			$info = array_combine( array_keys($data) , $info );
			$goods_attr_id = explode(',',$info['goods_attr_id']);
			$info['member_id'] = $member_id;
			$info['order_id'] = $order_id;
			$add_price = Db::name('goods_attribute')->field('sum(attribute_price) as price')->whereIn('id',$goods_attr_id)->find()['price'];
			$goods_info = Db::name('goods')->field('shop_price,is_promote,promote_price,promote_end_time')->find($info['goods_id']);
			$nowTime = time();
			if( $goods_info['is_promote'] == 1 && $goods_info['promote_end_time'] > $nowTime )
				$info['price'] = $goods_info['promote_price'];
			else
				$info['price'] = Db::name('member_price')->field('level_price')->where('goods_id',$info['goods_id'])->where('level_id',$member_level)->find()['level_price'];
			$info['price'] = $info['price'] + $add_price;
			Db::name('order_goods')->insert($info);
		}
		Db::name('cart')->delete($cart_id);
		$this->redirect( Url::build('@pay/'.$order_id) );
	}

	function index(Request $request)
	{
		$member_id = Session::get('m_id');
		$order_id = $request->route('order_id');
		$member_info = Db::name('order')->field('member_id,pay_status')->find($order_id);
		if($member_info['member_id'] != $member_id || $member_info['pay_status'] != 0)
			$this->redirect( Url::build('@/') );
		// 收货信息
		$addrData = Db::name('address')->field('id,name,phone,prov,city,dist,address')->where('member_id',$member_id)->select();
		foreach($addrData as $k => $v){
			$addrData[$k]['address'] = $v['prov'] . $v['city'] . $v['dist'] . $v['address'];
		}
		// 总价
		$total_price = 0;
		// 订单信息
		$goodsData = Db::name('order_goods')->where('order_id',$order_id)->select();
		foreach($goodsData as $k => $v){
			$goods_info =  Db::name('goods')->field('is_freight,freight_price,name,logo')->find($v['goods_id']);
			$goodsData[$k]['goods_name'] = $goods_info['name'];
			$goodsData[$k]['logo'] = DS . 'upload' . DS . $goods_info['logo'];
			$goodsData[$k]['freight_price'] = $goods_info['is_freight'] == 1 ? 0 : $goods_info['freight_price'];
			// 商品属性
			$goods_attr_id = explode(',',$goodsData[$k]['goods_attr_id']);
			$attr = Db::name('goods_attribute')->field('attribute_value')->whereIn('id',$goods_attr_id)->select();
			$attr = array_column($attr,'attribute_value');
			$goodsData[$k]['attr']  = join(' ',$attr);
			$total_price += $goodsData[$k]['number'] * $goodsData[$k]['price'] + $goodsData[$k]['freight_price'];
		}
		
		$this->assign('addrData',$addrData);
		$this->assign('goodsData',$goodsData);
		$this->assign('total_price',$total_price);
		$this->assign('order_id',$order_id);
		// 提交订单页面
		return $this->fetch();
	}

	function payMoney(Request $request)
	{
		$order_id = $request->post('order_id/d');
		$addr_id = $request->post('addr_id/d');
		if( !$addr_id )
			return json( getMsg(0,'请选择收货地址') );
		// 查询库存
		$number_info = Db::name('order_goods')->field('goods_id,goods_attr_id,number')->where('order_id',$order_id)->select();
		foreach($number_info as $v){
			$number = Db::name('goods_number')->field('number')->where('goods_id',$v['goods_id'])->where('attribute_id',$v['goods_attr_id'])->find()['number'];
			if( $v['number'] > $number )
				return json( getMsg(0,'购买数量超过库存量') );
		}
		// 查询收货信息
		$addr_info = Db::name('address')->field('name,prov,city,dist,address,phone')->find($addr_id);
		$data['name'] = $addr_info['name'];
		$data['prov'] = $addr_info['prov'];
		$data['city'] = $addr_info['city'];
		$data['dist'] = $addr_info['dist'];
		$data['address'] = $addr_info['address'];
		$data['phone'] = $addr_info['phone'];
		// 订单号
		$rand = md5( GetRandStr(5) );
		$data['order_number'] = $rand;
		$data['create_time'] = time();
		$data['pay_status'] = 1;
		// 计算总价
		$data['total_price'] = Db::name('order_goods')->field('sum(price) as total')->where('order_id',$order_id)->find()['total'];
		if( Db::name('order')->where('id',$order_id)->update($data) ){
			return json( getMsg(1,'提交订单成功',Url::build('@payfor/'.$order_id.'/0')) );
		}else
			return json( getMsg(0,'提交订单失败') );
	}

	function payfor(Request $request)
	{
		$order_id = $request->route('order_id');
		$moneyData = Db::name('order')->field('total_price')->find($order_id)['total_price'];
		$status = $request->route('status/d');

		$this->assign('moneyData',$moneyData);
		$this->assign('order_id',$order_id);
		$this->assign('status',$status);
		// 支付页面
		return $this->fetch();
	}

	function realpay(Request $request)
	{
		// 判断
		$method = $request->post('method/d');
		if( $method != 2 )
			return json( getMsg(0,'请选择支付方式') );
		$order_id = $request->post('order_id/d');
		// 验证支付密码
		$payword = $request->post('password/a');
		$payword = md5( join('',$payword) );
		// 获取会员支付密码
		$member_id = Session::get('m_id');
		$member_payword = Db::name('payword')->field('payword')->where('member_id',$member_id)->find()['payword'];
		if( $payword != $member_payword )
			return json( getMsg(0,'支付密码不正确') );
		// 获取订单总价
		$total_price = Db::name('order')->field('total_price')->find($order_id)['total_price'];
		// 获取余额
		$money = Db::name('member')->field('money')->find($member_id)['money'];
		if( $money - $total_price < 0 )
			return json( getMsg(0,'余额不足') );
		else
			$surplus = $money - $total_price;
		$order_number = Db::name('order')->field('order_number')->find($order_id)['order_number'];
		if( Db::name('member')->update(['money'=>$surplus,'id'=>$member_id]) )
			return json( getMsg(1,'支付成功',Url::build('@pay_success/'.$order_number)) );
		else
			return json( getMsg(2,'支付失败',Url::build('@pay_error/'.$order_id)) );
	}

	function alipay(Request $request)
	{
		// 支付宝支付
		$order_id = $request->post('order_id/d');
		// 查询订单信息
		$order_info = Db::name('order')->field('total_price,order_number')->find($order_id);
		$params['subject'] = '订单支付';
		$params['out_trade_no'] = $order_info['order_number'];
		$params['total_amount'] = $order_info['total_price'];
		\alipay\Pagepay::pay($params);
	}

	function paySuccess(Request $request)
	{
		$order_number = $_REQUEST['out_trade_no'];
		$order_id = Db::name('order')->field('id')->where('order_number',$order_number)->find()['id'];
		if( Db::name('order')->where('order_number',$order_number)->update(['pay_status'=>2]) !== false ){
			$goods_info = Db::name('order_goods')->field('goods_id,goods_attr_id,number')->where('order_id',$order_id)->select();
			foreach($goods_info as $v){
				$goods_id = $v['goods_id'];
				$goods_attr_id = $v['goods_attr_id'];
				$number = $v['number'];
				// 减少库存
				Db::name('goods_number')->where('goods_id',$goods_id)->where('attribute_id',$goods_attr_id)->setDec('number',$number);
				// 增加积分
				$credit = Db::name('goods')->field('credit')->find($goods_id)['credit'];
				// 当前会员
				$member_id = Session::get('m_id');
				Db::name('member')->where('id',$member_id)->setInc('credit',$credit);
			}
			$this->redirect( Url::build('@payfor/'.$order_id.'/1') );
		}else
			$this->redirect( Url::build('@payfor/'.$order_id.'/2') );
	}

	function payError(Request $request)
	{
		$order_id = $request->route('order_id/d');

		// 支付失败页面
		$this->redirect( Url::build('@payfor/'.$order_id.'/2') );
	}

	function immediately(Request $request)
	{
		// 获取当前会员
		$member_id = Session::get('m_id');
		// 会员积分
		$member_credit = Db::name('member')->field('credit')->find($member_id)['credit'];
		// 会员等级
		$member_level = Db::name('member_level')->where('top_number','>',$member_credit)->where('bottom_number','<=',$member_credit)->column('id')[0];
		// 先添加订单表
		Db::name('order')->insert(['member_id'=>$member_id,'create_time'=>time()]);
		$order_id = Db::name('order')->getLastInsID();
		// 获取所有的商品信息
		$info = $request->post();
		$info['order_id'] = $order_id;
		$info['member_id'] = $member_id;
		$goods_attr_id = explode(',',$info['goods_attr_id']);
		// 属性价格
		$add_price = Db::name('goods_attribute')->field('sum(attribute_price) as price')->whereIn('id',$goods_attr_id)->find()['price'];
		$goods_info = Db::name('goods')->field('shop_price,is_promote,promote_price,promote_end_time')->find($info['goods_id']);
		$nowTime = time();
		if( $goods_info['is_promote'] == 1 && $goods_info['promote_end_time'] > $nowTime )
			$info['price'] = $goods_info['promote_price'];
		else
			$info['price'] = Db::name('member_price')->field('level_price')->where('goods_id',$info['goods_id'])->where('level_id',$member_level)->find()['level_price'];
		$info['price'] = $info['price'] + $add_price;
		Db::name('order_goods')->insert($info);
		$this->redirect( Url::build('@pay/'.$order_id) );
	}
}