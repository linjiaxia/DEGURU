<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"/www/web/miracle_51zuopin_com/public_html/../application/index/view/member/order.html";i:1528869387;s:62:"/www/web/miracle_51zuopin_com/application/index/view/_nav.html";i:1528904100;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
	<title>订单</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/order.css" />

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
			<div class="box">
				<h3>我的订单信息</h3>
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th>商品信息</th>
							<th>数量</th>
							<th>单价</th>
							<th>实付款</th>
							<th>交易状态</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($orderData) || $orderData instanceof \think\Collection || $orderData instanceof \think\Paginator): $i = 0; $__LIST__ = $orderData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<tr onclick="jump('<?php echo $v['id']; ?>','<?php echo $v['status_n']; ?>')" style="cursor: pointer;">
							<td>
								<div>
									<a href="<?php echo url('@detail/'.$v['goods_id']); ?>">
										<img src="<?php echo $v['logo']; ?>" style="width: 142px;height: 125px;" />
									</a>
									<h6>
										<a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><?php echo $v['name']; ?></a>
									</h6>
									<span class="color_sort"><?php echo $v['attr']; ?></span>
								</div>
							</td>
							<td><?php echo $v['number']; ?></td>
							<td><?php echo $v['price']; ?></td>
							<td><span class="total_price"><?php echo $v['price'] * $v['number']; ?></span>（运费：<?php echo $v['freight']; ?>元）</td>
							<td><span class="receiving"><a href="javascript:void(0)"><?php echo $v['status']; ?></a></span></td>
						</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
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
		function jump(id,status){
			if( status == 0 )
				top.location.href = "<?php echo url('@pay/"+id+"'); ?>";
			else if( status == 1 )
				top.location.href = "<?php echo url('@payfor/"+id+"/0'); ?>";
			else
				top.location.href = "<?php echo url('@order_detail/"+id+"'); ?>";
		}
	</script>

	</body>

</html>