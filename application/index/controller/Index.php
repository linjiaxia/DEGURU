<?php

namespace app\index\controller;

use think\Db;
use think\Url;
use app\index\controller\Base;


class Index extends Base
{
    function index()
    {
        // 轮播
        $bannerData = Db::name('banner')->field('name,pic')->order('id','DESC')->limit(3)->select();
        $nowTime = time();
        // 促销商品
        $promoteData = Db::name('goods')->field('id,name,logo')->where('is_delete',0)->where('is_sale',1)->where('is_promote',1)->where('promote_end_time','>',$nowTime)->order('id','DESC')->limit(4)->select();
        // 最新商品
        $newData = Db::name('goods')->field('id,name,logo')->where('is_delete',0)->where('is_sale',1)->where('is_new',1)->order('id','DESC')->limit(6)->select();
        // 热销商品
        $hotData = Db::name('goods')->field('id,name,shop_price,logo')->where('is_delete',0)->where('is_sale',1)->where('is_hot',1)->order('shop_price','DESC')->limit(4)->select();
        // 推荐商品
        $bestData = Db::name('goods')->field('id,name,shop_price,logo')->where('is_delete',0)->where('is_sale',1)->where('is_best',1)->order('shop_price','DESC')->limit(6)->select();
        // 广告栏位
        $advertData = Db::name('advert')->field('name,pic,url')->where('status',1)->order('id','DESC')->limit(2)->select();
        // 销量第一
        $salesData = Db::name('order_goods')->alias('og')->join('order o','o.id=og.order_id')->field('goods_id,sum(number) count')->where('post_status',2)->where("FROM_UNIXTIME(create_time,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m')")->orderRaw('count(id)')->order('number','DESC')->group('goods_id')->limit(4)->select();
        // 没有销量
        $len = count($salesData);
        $_i = 4 - $len;
        $_other = Db::name('goods')->field('id goods_id')->order('id')->limit($_i)->select();
        $salesData = array_merge($salesData,$_other);
        foreach($salesData as $k => $v){
            // 获取商品信息
            $goods_info = Db::name('goods')->field('name,shop_price,logo')->where('id',$v['goods_id'])->find();
            $salesData[$k]['name'] = $goods_info['name'];
            $salesData[$k]['shop_price'] = $goods_info['shop_price'];
            $salesData[$k]['logo'] = DS . 'upload' . DS . $goods_info['logo'];
            $salesData[$k]['count'] = isset($salesData[$k]['count']) ? '月销量'.$salesData[$k]['count'] : '月销量0';
        }
        // 评论第一
        $commentData = Db::name('comment')->field('goods_id')->where("FROM_UNIXTIME(create_time,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m')")->group('goods_id')->orderRaw('count(id) DESC')->limit(4)->select();
        // 没有评论
        $len = count($commentData);
        $_i = 4 - $len;
        $_other = Db::name('goods')->field('id goods_id')->order('id','DESC')->limit($_i)->select();
        $commentData = array_merge($commentData,$_other);
        foreach($commentData as $k => $v){
            // 获取商品信息
            $goods_info = Db::name('goods')->field('name,shop_price,logo')->where('id',$v['goods_id'])->find();
            $commentData[$k]['name'] = $goods_info['name'];
            $commentData[$k]['shop_price'] = $goods_info['shop_price'];
            $commentData[$k]['logo'] = DS . 'upload' . DS . $goods_info['logo'];
            // 查询月销量
            $commentData[$k]['count'] = Db::name('order')->alias('o')->join('order_goods og','og.order_id=o.id','left')->field('sum(number) count')->where('post_status',2)->where("FROM_UNIXTIME(create_time,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m')")->where('goods_id',$v['goods_id'])->find()['count'];
            $commentData[$k]['count'] = isset($commentData[$k]['count']) ? '月销量' . $commentData[$k]['count'] : '月销量0';
        }
        
        $this->assign('bannerData',$bannerData);
        $this->assign('promoteData',$promoteData);
        $this->assign('newData',$newData);
        $this->assign('hotData',$hotData);
        $this->assign('bestData',$bestData);
        $this->assign('advertData',$advertData);
        $this->assign('salesData',$salesData);
        $this->assign('commentData',$commentData);
    	// 首页
        return $this->fetch();
    }
}
