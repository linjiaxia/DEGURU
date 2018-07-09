<?php

namespace app\index\controller;

use think\Db;
use think\Cookie;
use think\Session;
use think\Request;
use app\index\controller\Base;

class Cart extends Base
{
	function index()
	{
		$member_id = Session::get('m_id');
		// 判断是否登录
		if(!$member_id) 
			$member_id = Cookie::get('m_id');
		else{
			// 会员积分
			$member_credit = Db::name('member')->field('credit')->find($member_id)['credit'];
			// 会员等级
			$member_level = Db::name('member_level')->where('top_number','>',$member_credit)->where('bottom_number','<=',$member_credit)->column('id')[0];
		}
		if($member_id){
			$cartData = Db::name('cart')->field('id,goods_id,goods_attr_id,goods_number')->where('member_id',$member_id)->select();
			// 获取信息
			foreach($cartData as $k => $v){
				// 获取商品信息
				$goods_info = Db::name('goods')->field('name,sm_logo,shop_price,is_promote,promote_price,promote_end_time')->where('is_delete',0)->find($v['goods_id']);
				$cartData[$k]['id'] = $v['id'];
				$cartData[$k]['name'] = $goods_info['name'];
				$cartData[$k]['sm_logo'] = DS . 'upload' . DS . $goods_info['sm_logo'];
				// 判断是否有促销
				$nowTime = time();
				if( $goods_info['is_promote'] == 1 && $goods_info['promote_end_time'] > $nowTime )
					$cartData[$k]['price'] = $goods_info['promote_price'];
				else{
					// 判断是否登录
					if( isset($member_level) ){
						$cartData[$k]['price'] = Db::name('member_price')->field('level_price')->where('goods_id',$v['goods_id'])->where('level_id',$member_level)->find()['level_price'];
					}else
						$cartData[$k]['price'] = $goods_info['shop_price'];
				}
				// 获取对应属性
				$attr_info = Db::name('goods_attribute')->field('id,attribute_value,attribute_price')->whereIn('id',$v['goods_attr_id'])->select();
				$cartData[$k]['attr_value'] = '';
				$cartData[$k]['attr'] = '';
				$cartData[$k]['attr_price'] = 0;
				foreach($attr_info as $v){
					$cartData[$k]['attr_value'] .= ','.$v['id'];
					$cartData[$k]['attr'] .= $v['attribute_value'] . ' ';
					$cartData[$k]['attr_price'] += $v['attribute_price'];
				}
				$cartData[$k]['attr_value'] = ltrim($cartData[$k]['attr_value'],',');
				$cartData[$k]['attr'] = rtrim($cartData[$k]['attr']);
				$cartData[$k]['price'] = $cartData[$k]['attr_price'] + $cartData[$k]['price'];
				$cartData[$k]['total_price'] = $cartData[$k]['price'] * $cartData[$k]['goods_number'];
			}
		}else
			$cartData = [];
		
		$this->assign('cartData',$cartData);
		// 购物车列表页面
		return $this->fetch();
	}

	function setCart(Request $request)
	{
		$member_id = Session::get('m_id');
		// 判断是否登录
		if($member_id)
			$cart_info['member_id'] = $member_id;
		else{
			// 生成临时会员信息
			$temp_id = empty( Cookie::get('m_id') ) ? md5( GetRandStr(5) ) : Cookie::get('m_id');
			if( empty( Cookie::get('m_id') ) ) Cookie::set('m_id',$temp_id);
			$cart_info['member_id'] = $temp_id;
		}
		// 获取商品信息
		$data = $request->post();
		// 查看库存
		sort($data['ids']);
		$data['ids'] = implode(',',$data['ids']);
		$goods_number = Db::name('goods_number')->field('number')->where('attribute_id',$data['ids'])->find()['number'];
		if( $goods_number <= 0 )
			return json( getMsg(0,'该商品暂无库存') );
		if( $data['number'] > $goods_number )
			return json( getMsg(0,'购买量超出库存') );

		// 构造数组
		$cart_info['goods_id'] = $data['goods_id'];
		$cart_info['goods_attr_id'] = $data['ids'];
		$cart_info['goods_number'] = $data['number'];

		// 查看是否有一样的订单
		$cart = Db::name('cart')->field('id,goods_number')->where('member_id',$cart_info['member_id'])->where('goods_id',$cart_info['goods_id'])->where('goods_attr_id',$cart_info['goods_attr_id'])->find();
		if( $cart ){
			$cart['goods_number'] = $cart['goods_number'] + $cart_info['goods_number'];
			if( Db::name('cart')->update($cart) )
				return json( getMsg(1,'已成功加入购物车') );
			else
				return json( getMsg(0,'加入购物车失败') );
		}else{
			if( Db::name('cart')->insert($cart_info) )
				return json( getMsg(1,'已成功加入购物车') );
			else
				return json( getMsg(0,'加入购物车失败') );
		}
	}

	function updatePrice(Request $request, $id)
	{
		$data['id'] = $id;
		$data['goods_number'] = $request->post('number/d');
		if( Db::name('cart')->update($data) !== false )
			return json( getMsg(1,'') );
	}

	function delCart($id)
	{
		if( Db::name('cart')->delete($id) )
			return json( getMsg(1,'') );
		else
			return json( getMsg(0,'') );
	}

	function delsCart(Request $request)
	{
		$ids = $request->post()['ids'];
        if( Db::name('cart')->delete($ids) )
            return json( getMsg(1,'') );
	}
}