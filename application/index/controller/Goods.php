<?php

namespace app\index\controller;

use think\Db;
use think\Session;
use think\Request;
use app\index\controller\Base;
use app\index\model\Goods as model;

class Goods extends Base
{
	function index()
	{
		$request = Request::instance();
		$cat_id = $request->route('cat_id');

		// 搜索
		if( $request->isPost() ){
			$condition = $request->post('condition/s');
			$condition = '%' . $condition . '%';
			// 商品
			$data = model::field('id,name,logo,shop_price')->where('is_delete',0)->where('name|shop_price|promote_price','like',$condition)->group('id')->paginate(12,false,[
				'type'=>'DEGURU',
				'var_page'=>'page',
			]);
		}else{
			// 商品
			$data = Db::name('goods')->alias('g')->join('goods_cat gc','gc.goods_id=g.id','left')->field('g.id,g.name,g.logo,g.shop_price')->where('is_delete',0)->where('g.cat_id|gc.cat_id',$cat_id)->group('id')->paginate(12,false,[
				'type'=>'DEGURU',
				'var_page'=>'page',
			]);
		}

		$page = $data->render();
		$goodsData = $data->all();
		$nowTime = time();
		foreach($goodsData as $k => $v){
			$goodsData[$k]['number'] = Db::name('goods_number')->field('sum(number) as kucun')->where('goods_id',$v['id'])->find()['kucun'];
		}

		// 根据分类ID查询出所有品牌和类型
		$goods_info = Db::name('goods')->field('brand_id,type_id')->select();
		// 商品品牌
		$brand_id = array_column($goods_info,'brand_id');
		$brandData = Db::name('brand')->field('id,name,english,logo,url')->whereIn('id',$brand_id)->select();
		// 商品属性
		$type_id = array_column($goods_info,'type_id');
		$attrData = Db::name('attribute')->field('id,name,choice,values')->whereIn('type_id',$type_id)->where('values','<>','')->select();
		foreach($attrData as $k => $v){
			$attrData[$k]['values'] = explode('，',$v['values']);
		}

		$this->assign('cat_id',$cat_id);
		$this->assign('goodsData',$goodsData);
		$this->assign('brandData',$brandData);
		$this->assign('attrData',$attrData);
		$this->assign('page',$page);
		// 商品列表页
		return $this->fetch();
	}

	function detail(Request $request)
	{
		$goods_id = $request->route('goods_id');
		// 商品
		$goodsData = Db::name('goods')->field('id,name,feature,type_id,logo,shop_price,is_promote,promote_end_time,promote_price,goods_desc,is_sale')->where('is_delete',0)->where('id',$goods_id)->find();
		// 判断价格
		$nowTime = time();
		if( $goodsData['is_promote'] == 1 && $goodsData['promote_end_time'] < $nowTime )
			$goodsData['promote_price'] = '优惠：限时特价' . $goodsData['promote_price'] . '；加入购物车可见';
		else
			$goodsData['promote_price'] = '暂无优惠';
		// 商品描述处理
		$goodsData['goods_desc'] = htmlspecialchars_decode($goodsData['goods_desc']);
		// 商品属性
		$attrInfo = Db::name('goods_attribute')->field('id,attribute_id,attribute_value,attribute_price')->where('goods_id',$goods_id)->order('attribute_price','ASC')->select();
		$attr = Db::name('attribute')->field('id,name,choice')->where('type_id',$goodsData['type_id'])->select();
		$_i = 0;
		$len = count($attr);
		foreach($attrInfo as $v){
			for($_i=0;$_i<$len;$_i++){
				if( $v['attribute_id'] == $attr[$_i]['id'] ){
					$_key = $attr[$_i]['name'];
					$attrData[$_key][] = $v['attribute_value'];
					if( $attr[$_i]['choice'] == 1 ){
						$attrPriceData[$_key][$v['id']] = $v['attribute_value'];
					}
				}
			}
		}
		foreach($attrData as $k => $v){
			$attrData[$k] = implode($v,' ');
		}
		// 查看哪些属性还有库存
		$attrIdData = Db::name('goods_number')->field('attribute_id')->where('goods_id',$goods_id)->where('number','>',0)->select();
		$attrIdData = array_column($attrIdData,'attribute_id');
		$attrIdData = join(',',$attrIdData);
		// 商品相册
		$photoData = Db::name('goods_picture')->where('goods_id',$goods_id)->column('picture');
		// 其它商品
		$member_id = Session::get('m_id');
		$otherId = Db::name('impression')->order('count','DESC')->where('member_id',$member_id)->column('goods_id');
		$len = count($otherId);
		$_i = 4 - $len;
		$otherData = Db::name('goods')->field('id,name,logo,shop_price')->where('is_delete',0)->where('is_sale',1)->where('id','<>',$goods_id)->limit($_i)->orderRaw('rand()')->select();
		$_other = Db::name('goods')->field('id,name,logo,shop_price')->where('is_delete',0)->where('is_sale',1)->where('id','<>',$goods_id)->whereIn('id',$otherId)->select();
		$otherData = array_merge($otherData,$_other);
		// 其它商品库存
		foreach($otherData as $k => $v){
			$otherData[$k]['number'] = Db::name('goods_number')->field('sum(number) as kucun')->where('goods_id',$v['id'])->find()['kucun'];
		}
		// 商品评论
		$comment = Db::name('comment')->where('goods_id',$goods_id)->order('id','DESC')->paginate(3);
		$page = $comment->render();
		$commentData = $comment->all();
		foreach($commentData as $k => $v){
			$commentData[$k]['face'] = Db::name('member')->field('face')->find($v['member_id'])['face'];
			$commentData[$k]['name'] = Db::name('member')->field('name')->find($v['member_id'])['name'];
		}
		// 计算月销量
		$salesNumber = Db::name('order')->alias('o')->join('order_goods og','og.order_id=o.id','left')->where("FROM_UNIXTIME(create_time,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m')")->field('sum(number) count')->group('goods_id')->where('goods_id',$goods_id)->where('pay_status',2)->find();
		// 评价
		$commentNumber = Db::name('comment')->field('count(id) count')->where('goods_id',$goods_id)->find();
		// 待评价
		$waitCommentData = Db::name('order')->alias('o')->join('order_goods og','og.order_id=o.id','left')->field('count(id) count')->where('post_status',2)->where('comment_status',0)->find();
		
		$this->assign('goodsData',$goodsData);
		$this->assign('attrPriceData',$attrPriceData);
		$this->assign('attrData',$attrData);
		$this->assign('attrIdData',$attrIdData);
		$this->assign('photoData',$photoData);
		$this->assign('otherData',$otherData);
		$this->assign('commentData',$commentData);
		$this->assign('salesNumber',$salesNumber);
		$this->assign('commentNumber',$commentNumber);
		$this->assign('waitCommentData',$waitCommentData);
		$this->assign('page',$page);
		// 商品详情页
		return $this->fetch();
	}

	function changePrice(Request $request)
	{
		$goods_attr_id = $request->post('ids/a');
		sort($goods_attr_id);
		// 计算多出的价格
		$add_price = Db::name('goods_attribute')->field('sum(attribute_price) as price,goods_id')->whereIn('id',$goods_attr_id)->find();
		// 查询原本价格
		$base_price = Db::name('goods')->where('id',$add_price['goods_id'])->column('shop_price');
		// 计算出价格
		$add_price = $base_price[0] + $add_price['price'];
		// 查看是否还有库存
		$goods_attr_id = implode(',',$goods_attr_id);
		$number = Db::name('goods_number')->field('number')->where('attribute_id',$goods_attr_id)->find()['number'];
		$number = empty($number) ? 0 : $number;
		return json( getMsg(1,$add_price,$number) );
	}

	function search(Request $request)
	{
		$brand_id = $request->post('brand_id/d');
		$attribute = $request->post('attr_id/a');
		$attr_len = count($attribute);
		// 定义一个空数组存放
		$goods_id = [];
		// 判断
		if( !empty($brand_id) && empty($attribute) )
			// 根据ID查询出商品
			$data = Db::name('goods')->field('id,name,logo,shop_price')->where('is_delete',0)->where('brand_id',$brand_id)->paginate(12,false,[
				'type'=>'DEGURU',
				'var_page'=>'page',
				'query'=>$request->param(),
			]);
		elseif( !empty($attribute) && empty($brand_id) ){
			$goods_info = Db::name('goods_attribute')->field('goods_id,count(attribute_value) count')->whereIn('attribute_value',$attribute)->group('goods_id')->select();
			foreach($goods_info as $v){
				if( $v['count'] == $attr_len )
					$goods_id[] = $v['goods_id'];
			}
			$data = Db::name('goods')->field('id,name,logo,shop_price')->where('is_delete',0)->whereIn('id',$goods_id)->paginate(12,false,[
				'type'=>'DEGURU',
				'var_page'=>'page',
				'query'=>$request->param(),
			]);
		}else{
			$goods = Db::name('goods')->field('id')->where('is_delete',0)->where('brand_id',$brand_id)->select();
			$goods = array_column($goods,'id');
			$goods_info = Db::name('goods_attribute')->field('goods_id,count(attribute_value) count')->whereIn('attribute_value',$attribute)->group('goods_id')->select();
			foreach($goods_info as $v){
				if( $v['count'] == $attr_len && in_array($v['goods_id'],$goods) )
					$goods_id[] = $v['goods_id'];
			}
			$data = Db::name('goods')->field('id,name,logo,shop_price')->where('is_delete',0)->whereIn('id',$goods_id)->paginate(12,false,[
				'type'=>'DEGURU',
				'var_page'=>'page',
				'query'=>$request->param(),
			]);
		}

		$page = $data->render();
		$goodsData = $data->all();
		$nowTime = time();
		foreach($goodsData as $k => $v){
			$goodsData[$k]['number'] = Db::name('goods_number')->field('sum(number) as kucun')->where('goods_id',$v['id'])->find()['kucun'];
		}
		$this->assign('goodsData',$goodsData);
		$msg = $this->fetch('_index');
		return json( ['code'=>1,'msg'=>$msg,'page'=>$page] );
	}
}