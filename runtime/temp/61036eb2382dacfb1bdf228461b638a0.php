<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpStudy\PHPTutorial\WWW\shop\public/../application/index\view\goods\index.html";i:1528473834;s:68:"D:\phpStudy\PHPTutorial\WWW\shop\application\index\view\_middle.html";i:1528522359;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
	<title>商品列表</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/shop_list.css" />

		<script type="text/javascript" src="/static/js/common.js"></script>
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
				<form class="search"><label>宝贝</label><input type="text" name="search_input" value="请输入关键字" /><button>搜索</button></form>
			</div>


		<!--内容-->
		<div class="middle">
			<div class="box">
				<h6>多功能锅</h6>
				<ul>
					<li>
						<h6>品牌</h6>
						<ul>
							<?php if(is_array($brandData) || $brandData instanceof \think\Collection || $brandData instanceof \think\Paginator): $i = 0; $__LIST__ = $brandData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li><a href="javascript:void(0)"><?php echo $v['english']!=''?$v['english'].'/' : ''; ?><?php echo $v['name']; ?></a></li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</li>
					<?php if(is_array($attrData) || $attrData instanceof \think\Collection || $attrData instanceof \think\Paginator): $i = 0; $__LIST__ = $attrData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<h6><?php echo $v['name']; ?></h6>
						<ul>
							<?php if(is_array($v['values']) || $v['values'] instanceof \think\Collection || $v['values'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['values'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<li><a href="javascript:void(0)"><?php echo $vo; ?></a></li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<ul class="conditions">
					<li><a href="javascript:void(0)">综合排榜</a></li>
					<li><a href="javascript:void(0)">销量<span>^</span></a></li>
					<li>
						<a href="javascript:void(0)">价格</a>
						<form>
							<input type="text" />
							<label></label>
							<input type="text" />
						</form>
					</li>
				</ul>
				<ol class="pro_list">
					<?php if(is_array($goodsData) || $goodsData instanceof \think\Collection || $goodsData instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<a href="<?php echo url('@detail/'.$v['id']); ?>"><img src="<?php echo DS . 'upload' . DS . $v['logo']; ?>" alt="<?php echo $v['name']; ?>"  style="width: 293px;height: 309px;"/></a>
						<h6><a href="<?php echo url('@detail/'.$v['id']); ?>"><?php echo $v['name']; ?></a></h6>
						<span class="price">¥<i><?php echo $v['shop_price']; ?></i></span>
						<span class="purchase"><a href="confirm_order.html">点击购买</a></span>
						<p>
							<span class="quantity">销售量 199</span>
							<span class="stock"><?php echo empty($v['number']) ? '暂无库存' : '库存 ' . $v['number'] . '件'; ?></span>
						</p>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ol>
				<div class="page_list">
					<?php echo $page; ?>
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
		
	<script>
		$(".box >ul >li >ul >li").click(function(){
			$(this).siblings().find("a").removeClass("active");
			$(this).find("a").addClass("active");
		});
	</script>

	</body>

</html>