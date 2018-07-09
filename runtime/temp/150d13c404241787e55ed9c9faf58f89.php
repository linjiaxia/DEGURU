<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/www/web/miracle_51zuopin_com/public_html/../application/index/view/pay/payfor.html";i:1528869389;s:62:"/www/web/miracle_51zuopin_com/application/index/view/_nav.html";i:1528904100;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
	<title>支付页面</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/pay.css" />

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
			<?php switch($status): case "1": ?>
					<div class="success">
						<div>
							<h1>支付成功</h1>
							<span class="checkorder"><a href="<?php echo url('@order_detail/'.$order_id); ?>">查看订单</a></span>
						</div>
					</div>
				<?php break; case "2": ?>
					<div class="fail">
						<div>
							<h1>支付失败</h1>
							<span class="repay"><a href="<?php echo url('@payfor/'.$order_id.'/0'); ?>">返回支付</a></span>
							<span class="checkorder"><a href="<?php echo url('@order_detail/'.$order_id); ?>">查看订单</a></span>
						</div>
					</div>
				<?php break; default: endswitch; ?>
			<div class="box">
				<p>你需要支付金额<span class="total_price"><?php echo $moneyData; ?></span></p>
				<div class="choice">
					<h3>请选择支付方式</h3>
					<span></span><br />
					<form id="alipay" action="<?php echo url('@alipay'); ?>" method="post">
						<ul class="linepay">
							<input type="hidden" name='order_id' value="<?php echo $order_id; ?>">
							<li value="1"><img src="/static/img/Alipay.jpg" onclick="alipay()" /></li>
							<li value="2" style="text-align: center;line-height: 49px;cursor: pointer;"><span>余额</span></li>
						</ul>
					</form><br />
					<h3>请输入支付密码</h3>
					<span></span>
					<form class="pay">
						<input type="password" name="password[]" maxlength="1" /><input type="password" name="password[]" maxlength="1" /><input type="password" name="password[]" maxlength="1" /><input type="password" name="password[]" maxlength="1" /><input type="password" name="password[]" maxlength="1" /><input type="password" name="password[]" maxlength="1" /><br />
						<input type="button" id="sub" value="确认" onclick="realpay()" />
					</form>
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
		
	<script src="/static/js/pay.js"></script>
	<script>
		$(".linepay").find("li").click(function(){
			if( $(this).hasClass("active") == false ){
				$(this).addClass("active");
				$(this).siblings().removeClass("active");
			}	
		})

		function alipay(){
			$("#alipay").submit();
		}

		function realpay(){
			var pwd = [];
			$("input[name='password[]']").each(function(){
				pwd.push($(this).val())
			})
			var data = {
				'order_id' : "<?php echo $order_id; ?>",
				'password' : pwd,
				'method' : $(".linepay").find("li.active").val(),
			}

			$.ajax({
				url : "<?php echo url('@realpay'); ?>",
				data : data,
				dataType : 'json',
				type : 'post',
				success : function(info){
					if( info.code == 1 ){
						layer.msg(info.msg,{icon:1,time:1000},function(){
							top.location.href = info.url;
						});
					}else if( info.code == 2 ){
						layer.msg(info.msg,{icon:2,time:1000},function(){
							top.location.href = info.url;
						});
					}else{
						layer.msg(info.msg,{icon:2,time:1000});
					}
				}
			})
		}
	</script>

	</body>

</html>