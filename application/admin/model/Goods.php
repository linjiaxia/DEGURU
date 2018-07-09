<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class Goods extends Model
{
    // 数据表字段信息 留空则自动获取
    protected $field = true;
    // 新增自动完成列表
    protected $insert = ['create_time'];
    // 更新自动完成列表
    protected $update = ['update_time'];

    function getGoodsDescAttr($v)
    {
        return htmlspecialchars_decode($v);
    }

    function setCreateTimeAttr()
    {
    	return time();
    }

    function setUpdateTimeAttr()
    {
    	return time();
    }

    /**
     * 初始化处理
     * @access protected
     * @return void
     */
    protected static function init()
    {
        Goods::beforeInsert(function(&$data){
            if(isset($data['id']))
                unset($data['id']);
            // 如果有促销，处理促销时间
            if( $data['is_promote'] == 1 ){
                $data['promote_start_time'] = strtotime($data['promote_start_time']);
                $data['promote_end_time'] = strtotime($data['promote_end_time']);
            }
            // 是否包邮
            if( $data['is_freight'] == 1 )
                unset($data['freight_price']);
        });

        Goods::afterInsert(function($data){
            $goods_id = $data->id;

            // 添加扩展分类
            $ext_cat_id = input('post.ext_cat_id/a');
            $ext_cat_id = array_unique($ext_cat_id);
            foreach($ext_cat_id as $v){
                if( empty($v) )
                    continue;
                Db::name('goods_cat')->insert(['goods_id'=>$goods_id,'cat_id'=>$v]);
            }

            // 处理会员价格
            $shop_price = input('post.shop_price/s');
            $member_price = input('post.member_price/a');
            foreach($member_price as $k => $v){
                foreach($v as $ko => $vo){
                    if(!empty($vo)){
                        $price = $vo;
                    }else{
                        $rate = Db::name('member_level')->field('rate')->find($k)['rate'];
                        if($rate == 100){
                            $price = $shop_price;
                        }else{
                            $rate = '0.' . $rate;
                            $price = $rate * $shop_price;
                        }
                    }
                    Db::name('member_price')->insert(['goods_id'=>$goods_id,'level_id'=>$k,'level_price'=>$price]);
                }
            }

            // 添加属性价格
            if( !empty($attr = input('post.attr/a')) ){
                $attr_price = input('post.attr_price/a');
                foreach($attr as $k => $v){
                    $attr[$k] = array_filter($attr[$k]);
                    $attr[$k] = array_unique($attr[$k]);
                }
                foreach($attr as $k => $v){
                    foreach($v as $ko => $vo){
                        $price = isset($attr_price[$k][$ko]) ? $attr_price[$k][$ko] : '';
                        $info = ['goods_id'=>$goods_id,'attribute_id'=>$k,'attribute_value'=>$vo,'attribute_price'=>$price];
                        Db::name('goods_attribute')->insert($info);
                    }
                }
            }
        });

        Goods::beforeUpdate(function(&$data){
            // 如果有促销，处理促销时间
            if( $data['is_promote'] == 1 ){
                $data['promote_start_time'] = strtotime($data['promote_start_time']);
                $data['promote_end_time'] = strtotime($data['promote_end_time']);
            }
            // 是否包邮
            if( $data['is_freight'] == 1 )
                unset($data['freight_price']);
            // 判断是否修改了类型
            if( input('post.old_type_id/d') != $data['type_id'] )
                Db::name('goods_attribute')->where('goods_id',$data->id)->delete();
        });

        Goods::afterUpdate(function($data){
            $goods_id = $data->id;

            // 先清除原本的扩展分类
            Db::name('goods_cat')->where('goods_id',$goods_id)->delete();
            // 添加扩展分类
            $ext_cat_id = input('post.ext_cat_id/a');
            $ext_cat_id = array_unique($ext_cat_id);
            foreach($ext_cat_id as $v){
                if( empty($v) )
                    continue;
                Db::name('goods_cat')->insert(['goods_id'=>$goods_id,'cat_id'=>$v]);
            }

            // 清除原本的会员价格
            Db::name('member_price')->where('goods_id',$goods_id)->delete();
            // 重新添加会员价格
            $shop_price = input('post.shop_price/s');
            $member_price = input('post.member_price/a');
            foreach($member_price as $k => $v){
                foreach($v as $ko => $vo){
                    if(!empty($vo)){
                        $price = $vo;
                    }else{
                        $rate = Db::name('member_level')->field('rate')->find($k)['rate'];
                        if($rate == 100){
                            $price = $shop_price;
                        }else{
                            $rate = '0.' . $rate;
                            $price = $rate * $shop_price;
                        }
                    }
                    Db::name('member_price')->insert(['goods_id'=>$goods_id,'level_id'=>$k,'level_price'=>$price]);
                }
            }

            // 处理商品属性
            // 添加新增的商品属性价格
            if( !empty($new_attr = input('post.new_attr/a')) ){
                $new_attr_price = input('post.new_attr_price/a');
                foreach($new_attr as $k => $v){
                    $new_attr[$k] = array_filter($new_attr[$k]);
                    $new_attr[$k] = array_unique($new_attr[$k]);
                }
                foreach($new_attr as $k => $v){
                    foreach($v as $ko => $vo){
                        // 比对和原来的属性是否重复
                        $result = Db::name('goods_attribute')->where('attribute_value',$vo)->where('goods_id',$goods_id)->find();
                        if( $result )
                            continue;
                        $price = isset($new_attr_price[$k][$ko]) ? $new_attr_price[$k][$ko] : '';
                        $info = ['goods_id'=>$goods_id,'attribute_id'=>$k,'attribute_value'=>$vo,'attribute_price'=>$price];
                        Db::name('goods_attribute')->insert($info);
                    }
                }
            }
            // 再更新原有的属性价格
            if( !empty($attr = input('post.attr/a')) ){
                $attr_price = input('post.attr_price/a');
                // 循环更新一遍所有的旧属性
                foreach($attr as $k => $v){
                    foreach($v as $ko => $vo){
                        // 判断是否有空
                        if( empty($vo) )
                            Db::name('goods_attribute')->delete($ko);
                        // 要修改的字段
                        $oldField['attribute_value'] = $vo;
                        $oldField['id'] = $ko;
                        if( isset($attr_price[$k]) )
                            $oldField['attribute_price'] = $attr_price[$k][$ko];
                        Db::name('goods_attribute')->update($oldField);
                    }
                }
            }
        });

        Goods::afterDelete(function($data){
            $ids = empty(input('post.ids/a')) ? $data->id : input('post.ids/a');
            if(is_array($ids)){
                // 删除扩展分类
                Db::name('goods_cat')->whereIn('goods_id',$ids)->delete();
                // 删除对应属性
                Db::name('goods_attribute')->whereIn('goods_id',$ids)->delete();
                // 删除其库存
                Db::name('goods_number')->whereIn('goods_id',$ids)->delete();
                // 删除商品相册
                Db::name('goods_picture')->whereIn('goods_id',$ids)->delete();
                // 删除对应会员价格
                Db::name('member_price')->whereIn('goods_id',$ids)->delete();
            }else{
                // 删除扩展分类
                Db::name('goods_cat')->where('goods_id',$ids)->delete();
                // 删除对应属性
                Db::name('goods_attribute')->where('goods_id',$ids)->delete();
                // 删除其库存
                Db::name('goods_number')->where('goods_id',$ids)->delete();
                // 删除商品相册
                Db::name('goods_picture')->where('goods_id',$ids)->delete();
                // 删除对应会员价格
                Db::name('member_price')->where('goods_id',$ids)->delete();
            }
        });
    }
}