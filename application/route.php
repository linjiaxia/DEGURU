<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 调用系统类
use think\Route;
// 改写路由
Route::rule('/','@index/Index/index');
// 登录
Route::rule('logon','@index/Login/index');
Route::rule('logout','@index/Login/logout');
Route::rule('register','@index/Login/register');
Route::rule('getCode','@index/Login/getPhoneCode','post');
// 商品
Route::rule('list/[:cat_id]','@index/Goods/index');
Route::rule('search','@index/Goods/search');
Route::rule('detail/:goods_id','@index/Goods/detail');
Route::rule('getPrice','@index/Goods/changePrice');
// 会员
Route::rule('member','@index/Member/index');
Route::rule('address/:status/[:order_id]','@index/Member/address');
Route::rule('edit_address/[:addr_id]','@index/Member/editAddress');
Route::rule('delete_address/:addr_id','@index/Member/deleteAddress','get');
Route::rule('set_email','@index/Member/setMail');
Route::rule('check_email/:member_id/:email_code','@index/Member/checkMail','get');
Route::rule('order','@index/Member/order');
Route::rule('order_detail/:order_id','@index/Member/orderDetail');
// 购物车
Route::rule('cart','@index/Cart/index');
Route::rule('set_cart','@index/Cart/setCart');
Route::rule('set_price','@index/Cart/updatePrice');
Route::rule('del_cart/:id','@index/Cart/delCart');
Route::rule('dels_cart','@index/Cart/delsCart');
// 支付
Route::rule('pay/:order_id','@index/Pay/index');
Route::rule('set_pay','@index/Pay/setPay');
Route::rule('pay_money','@index/Pay/payMoney');
Route::rule('payfor/:order_id/:status','@index/Pay/payfor');
Route::rule('realpay','@index/Pay/realpay','post');
Route::rule('alipay','@index/Pay/alipay','post');
Route::rule('pay_success/[:out_trade_no]','@index/Pay/paySuccess');
Route::rule('pay_error/:order_id','@index/Pay/payError');
Route::rule('immediately','@index/Pay/immediately');