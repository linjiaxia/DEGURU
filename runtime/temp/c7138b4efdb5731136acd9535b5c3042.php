<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/www/web/miracle_51zuopin_com/public_html/../application/index/view/index/index.html";i:1528869386;s:62:"/www/web/miracle_51zuopin_com/application/index/view/_nav.html";i:1528904100;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
	<title>首页</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/index.css" />
	<script type="text/javascript" src="/static/js/banner.js"></script>

	</head>

	<body>
		<!--头部-->
		<div class="header">

			<div class="top">
				<div>
					<span class="shop_car"><a href="<?php echo url('@cart'); ?>">购物车</a></span>
					<span class="msg"><a href="javascript:void(0)">消息通知</a></span>
					<?php if(session("m_id")): ?>
					<span class="login"><a href="<?php echo url('@member'); ?>">欢迎您，<?php echo \think\Session::get('m_name'); ?></a></span>
					<span class="register"><a href="<?php echo url('@logout'); ?>">退出登录</a></span>
					<?php else: ?>
					<span class="login"><a href="<?php echo url('@logon'); ?>">登录</a></span>
					<span class="register"><a href="<?php echo url('@register'); ?>">注册</a></span>
					<?php endif; ?>
				</div>
			</div>
			<!--logo&搜索栏-->
			<div>
				<div class="logo"><a href="<?php echo url('@'.$constactData[0]['url']); ?>"><img src="<?php echo DS . 'upload' . DS . $constactData['0']['img']; ?>" alt="<?php echo $constactData['0']['name']; ?>" style="width: 191px;height: 43px;"></a></div>
				<form class="search" action="<?php echo url('@list'); ?>" method="post"><label>宝贝</label><input type="text" name="condition" placeholder="请输入关键字" /><button type="submit">搜索</button></form>
			</div>
			<div class="nav">
				<div class="sidebar">
					<span class="sort">商品分类</span>
					<ul>
						<?php if(is_array($catData) || $catData instanceof \think\Collection || $catData instanceof \think\Paginator): $i = 0; $__LIST__ = $catData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li><a href="<?php echo url('@list/'.$v['id']); ?>"><?php echo $v['name']; ?>   &gt;</a></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>

				<ul>
					<?php if(is_array($navData) || $navData instanceof \think\Collection || $navData instanceof \think\Paginator): $i = 0; $__LIST__ = $navData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li><a href="<?php echo url('@' . $v['url']); ?>"><?php echo $v['name']; ?></a></li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>

		<!--内容-->
		<div class="middle">
			<div class="banner">
				<div class="wrapper">
					<?php if(is_array($bannerData) || $bannerData instanceof \think\Collection || $bannerData instanceof \think\Paginator): $i = 0; $__LIST__ = $bannerData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<img <?php echo $key==0?'class="active"':''; ?> src="<?php echo DS . 'upload' . DS . $v['pic']; ?>" alt="<?php echo $v['name']; ?>" style="width: 1920px;height: 600px;"/>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="squares">
					<span class="turn"></span>
					<span></span>
					<span></span>
				</div>
			</div>
			<div class="promotion_pro">
				<ul>
					<?php if(is_array($promoteData) || $promoteData instanceof \think\Collection || $promoteData instanceof \think\Paginator): $i = 0; $__LIST__ = $promoteData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<img src="<?php echo DS . 'upload' . DS . $v['logo']; ?>" alt="<?php echo $v['name']; ?>" style="width: 300px;height: 280px;">
						<div>
							<a href="<?php echo url('@detail/'.$v['id']); ?>"><?php echo $v['name']; ?></a>
						</div>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<!--最新产品-->
			<div class="latest_pro">
				<div>
					<div class="title">
						<h3>最新产品</h3>
						<h4>latest product</h4></div>
					<div class="product">
						<a href="<?php echo $advertData['0']['url']; ?>"><img src="<?php echo DS . 'upload' . DS . $advertData['0']['pic']; ?>" alt="<?php echo $advertData['0']['name']; ?>" style="width: 318px;height: 800px;"/></a>
						<ul>
							<?php if(is_array($newData) || $newData instanceof \think\Collection || $newData instanceof \think\Paginator): $i = 0; $__LIST__ = $newData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="<?php echo url('@detail/'.$v['id']); ?>"><img src="<?php echo DS . 'upload' . DS . $v['logo']; ?>" alt="<?php echo $v['name']; ?>" style="width: 278px;height: 290px;"/></a>
								<h5><a href="<?php echo url('@detail/'.$v['id']); ?>"><?php echo $v['name']; ?></a></h5>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<!--热门产品-->
			<div class="best_sell_pro">
				<div class="title">
					<h3>热门产品</h3>
					<h4>latest product</a></div>
				<ul>
					<?php if(is_array($hotData) || $hotData instanceof \think\Collection || $hotData instanceof \think\Paginator): $i = 0; $__LIST__ = $hotData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<a href="<?php echo url('@detail/'.$v['id']); ?>"><img src="<?php echo DS . 'upload' . DS . $v['logo']; ?>" alt="<?php echo $v['name']; ?>" style="width: 290px;height: 464px;"/></a>
						<div>
							<h4><a href="<?php echo url('@detail/'.$v['id']); ?>"><?php echo $v['name']; ?></a></h4>
							<span>月销量5572</span><br />
							<span>累计评价19016</span>
							<p class="price">￥<?php echo $v['shop_price']; ?></p>
						</div>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<!--推荐产品-->
			<div class="recommend_pro">
				<div>
					<div class="title">
						<h3>推荐产品</h3>
						<h4>latest product</a></div>
					<div class="product">
						<a href="<?php echo $advertData['1']['url']; ?>"><img src="<?php echo DS . 'upload' . DS . $advertData['1']['pic']; ?>" alt="<?php echo $advertData['1']['name']; ?>" style="width: 318px;height: 800px;"/></a>
						<ul>
							<?php if(is_array($bestData) || $bestData instanceof \think\Collection || $bestData instanceof \think\Paginator): $i = 0; $__LIST__ = $bestData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="<?php echo url('@detail/'.$v['id']); ?>"><img src="<?php echo DS . 'upload' . DS . $v['logo']; ?>" alt="<?php echo $v['name']; ?>" style="width: 278px;height: 290px;"/></a>
								<h5><a href="<?php echo url('@detail/'.$v['id']); ?>"><?php echo $v['name']; ?></a></h5>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<!--爆款热门产品-->
			<div class="hot_cake_pro">
				<div class="title">
					<h3>爆款热门产品</h3>
					<h4>latest product</h4></div>
				<div class="sales_best">
					<div class="sub_title">
						<h2>销量第一</h2>
						<p>专属于你的购物指南</p>
					</div>
					<ul>
						<?php if(is_array($salesData) || $salesData instanceof \think\Collection || $salesData instanceof \think\Paginator): $i = 0; $__LIST__ = $salesData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($key == 0 or $key == 3): ?>
						<li>
							<a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><img src="<?php echo $v['logo']; ?>" alt="<?php echo $v['name']; ?>" style="width: 297px;height: 194px;" /></a>
							<div>
								<h5><a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><?php echo $v['name']; ?></a></h5>
								<span><?php echo $v['count']; ?></span>
								<p class="price">￥<?php echo $v['shop_price']; ?></p>
							</div>
						</li>
						<?php else: ?>
						<li>
							<div>
								<h5><a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><?php echo $v['name']; ?></a></h5>
							</div>
							<a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><img src="<?php echo $v['logo']; ?>" alt="<?php echo $v['name']; ?>" style="width: 298px;height: 195px;" /></a>
						</li>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="evaluate_best">
					<div class="sub_title">
						<h2>评价第一</h2>
						<p>专属于你的购物指南</p>
					</div>
					<ul>
						<?php if(is_array($commentData) || $commentData instanceof \think\Collection || $commentData instanceof \think\Paginator): $i = 0; $__LIST__ = $commentData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($key == 0 or $key == 3): ?>
						<li>
							<a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><img src="<?php echo $v['logo']; ?>" alt="<?php echo $v['name']; ?>" style="width: 297px;height: 194px;" /></a>
							<div>
								<h5><a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><?php echo $v['name']; ?></a></h5>
								<span><?php echo $v['count']; ?></span>
								<p class="price">￥<?php echo $v['shop_price']; ?></p>
							</div>
						</li>
						<?php else: ?>
						<li>
							<div>
								<h5><a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><?php echo $v['name']; ?></a></h5>
							</div>
							<a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><img src="<?php echo $v['logo']; ?>" alt="<?php echo $v['name']; ?>" style="width: 298px;height: 195px;" /></a>
						</li>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
		</div>


<!--尾部-->
		<div class="footer">
			<ul>
				<?php if(is_array($constactData) || $constactData instanceof \think\Collection || $constactData instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($constactData) ? array_slice($constactData,1,4, true) : $constactData->slice(1,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				<li><img src="<?php echo DS . 'upload' . DS . $v['img']; ?>" alt=""><span><?php echo $v['name']; ?></span></li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<hr>
			<div>
				<dl>
					<dt><?php echo $constactData['5']['name']; ?></dt>
					<dd><?php echo $constactData['6']['name']; ?></dd>
					<dd><?php echo $constactData['7']['name']; ?></dd>
					<dd><?php echo $constactData['8']['name']; ?></dd>
				</dl>
				<dl>
					<dt><?php echo $constactData['9']['name']; ?></dt>
					<dd><?php echo $constactData['10']['name']; ?></dd>
					<dd><?php echo $constactData['11']['name']; ?></dd>
					<dd><?php echo $constactData['12']['name']; ?></dd>
				</dl>
				<dl>
					<dt><?php echo $constactData['13']['name']; ?></dt>
					<dd><?php echo $constactData['14']['name']; ?></dd>
					<dd><?php echo $constactData['15']['name']; ?></dd>
					<dd><?php echo $constactData['16']['name']; ?></dd>
				</dl>
				<dl>
					<dt><?php echo $constactData['17']['name']; ?></dt>
					<dd><?php echo $constactData['18']['name']; ?></dd>
					<dd><?php echo $constactData['19']['name']; ?></dd>
					<dd><?php echo $constactData['20']['name']; ?></dd>
				</dl>
				
				<span><?php echo $constactData['21']['content']; ?></span>
				<p><?php echo $constactData['21']['name']; ?></p>
			</div>

			<p><?php echo $constactData['22']['content']; ?></p>
			<p><?php echo $constactData['23']['content']; ?></p>
		</div>
		<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
		
	<script type="text/javascript" src="/static/js/bannerLeft.js"></script>

	</body>

</html>