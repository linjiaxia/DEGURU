<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\phpStudy\PHPTutorial\WWW\shop\public/../application/index\view\pay\pay_success.html";i:1526361372;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>支付成功</title>
		<link rel="stylesheet" href="css/common.css" />
		<link rel="stylesheet" href="css/pay.css" />
	</head>

	<body>
		<!--头部-->
		<div class="header">

			<div class="top">
				<div>
					<span class="shop_car"><a href="shop_cart.html">购物车</a></span>
					<span class="msg"><a href="javascript:void(0)">消息通知</a></span>
					<span class="login"><a href="login.html">登录</a></span>
					<span class="register"><a href="reg.html">注册</a></span>
				</div>
			</div>
			<!--logo&搜索栏-->
			<div>
				<div class="logo"><a href="index.html"><img src="img/logo.jpg" alt="logo"></a></div>
				<form class="search"><label>宝贝</label><input type="text" name="search_input" value="请输入关键字" /><button>搜索</button></form>
			</div>

			<div class="nav">
				<div class="sidebar">
					<span class="sort">商品分类</span>
					<ul>
						<li><a href="shop_list.html">早餐神器 极速享受   &gt;</a></li>
						<li><a href="shop_list.html">懒人厨房 百变料理   &gt;</a></li>
						<li><a href="shop_list.html">养生至尚 极致生活   &gt;</a></li>
						<li><a href="shop_list.html">早餐神器 极速享受   &gt;</a></li>
					</ul>
				</div>

				<ul>
					<li><a href="index.html">首页</a></li>
					<li><a href="shop_list.html">电饭锅</a></li>
					<li><a href="shop_list.html">电压力锅</a></li>
					<li><a href="shop_list.html">电炖锅</a></li>
					<li><a href="javascript:void(0)">联系我们</a></li>
					<li><a href="javascript:void(0)">企业采购</a></li>
					<li><a href="javascript:void(0)">在线商城</a></li>
				</ul>
			</div>
		</div>
		<!--内容-->
		<div class="middle">
			<div class="success">
				<div>
					<h1>支付成功</h1>
					<span class="address">收货地址：江西省南昌市八一广场财富广场A2003</span>
					<span class="checkorder"><a href="order_details.html">查看订单</a></span>
				</div>
			</div>
			<div class="box">
				<p>你需要支付金额<span class="total_price">209.9</span></p>
				<div class="choice">
					<h3>请选择支付方式</h3>
					<span></span>
					<p>网上银行</p>
					<ul class="cardpay">
						<li><img src="img/chinaBank.jpg" /></li>
						<li><img src="img/agriculturalBank.jpg" /></li>
						<li><img src="img/constructionlBank.jpg" /></li>
						<li><img src="img/comminicationslBank.jpg" /></li>
					</ul>
					<p>其他支付方式</p>
					<ul class="linepay">
						<li><img src="img/WeChat.jpg" /></li>
						<li><img src="img/Alipay.jpg" /></li>
					</ul>
					<h3>请输入支付密码</h3>
					<span></span>
					<form class="pay">
						<input type="text" /><input type="text" /><input type="text" /><input type="text" /><input type="text" /><input type="text" /><br />
						<input type="submit" id="sub" name="sub" value="确认" onclick="return  false" />
					</form>
				</div>
			</div>
		</div>
		<!--尾部-->
		<div class="footer">
			<ul>
				<li><img src="img/contact_icon.png" alt=""><span>QQ公众号</span></li>
				<li><img src="img/contact_icon.png" alt=""><span>QQ公众号</span></li>
				<li><img src="img/position_icon.png" alt=""><span>520余家售后网点</span></li>
				<li><img src="img/position_icon.png" alt=""><span>520余家售后网点</span></li>
			</ul>
			<hr>
			<div>
				<dl>
					<dt>帮助中心</dt>
					<dd>账号管理</dd>
					<dd>购物指南</dd>
					<dd>订单操作</dd>
				</dl>
				<dl>
					<dt>帮助中心</dt>
					<dd>账号管理</dd>
					<dd>购物指南</dd>
					<dd>订单操作</dd>
				</dl>
				<dl>
					<dt>帮助中心</dt>
					<dd>账号管理</dd>
					<dd>购物指南</dd>
					<dd>订单操作</dd>
				</dl>
				<dl>
					<dt>帮助中心</dt>
					<dd>账号管理</dd>
					<dd>购物指南</dd>
					<dd>订单操作</dd>
				</dl>

				<span>400-400-4000</span>
				<p>在 线 客 服</p>
			</div>

			<p>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号 </p>
			<p>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</p>
		</div>
	</body>

</html>