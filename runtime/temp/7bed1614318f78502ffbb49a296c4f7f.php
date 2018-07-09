<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\phpStudy\PHPTutorial\WWW\shop\public/../application/index\view\pay\index.html";i:1528701259;s:65:"D:\phpStudy\PHPTutorial\WWW\shop\application\index\view\_nav.html";i:1528523127;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
	<title>确认订单</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/confirm_order.css" />

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
				<ul class="address">
					<?php if(is_array($addrData) || $addrData instanceof \think\Collection || $addrData instanceof \think\Paginator): $i = 0; $__LIST__ = $addrData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<p><?php echo $v['address']; ?></p>
						<span class="name"><?php echo $v['name']; ?></span>
						<span class="phone"><?php echo $v['phone']; ?></span><br />
						<span class="del"><a href="javascript:void(0)" onclick="del('<?php echo $v['id']; ?>')">删除</a></span>
						<span class="edit" value="<?php echo $v['id']; ?>"><a href="javascript:void(0)" onclick="edit(this)">编辑</a></span>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					<li onclick="addr_add()">
						<span class="del"><a href="javascript:void(0)">新建地址</a></span>
					</li>
				</ul>
				<h5>确认订单信息</h5>
				<div class="title">
					<span class="pro_info">商品信息</span>
					<span class="count">数量</span>
					<span class="unit">单价</span>
					<span class="total">小计</span>
				</div>
				<ol class="order_info">
					<?php if(is_array($goodsData) || $goodsData instanceof \think\Collection || $goodsData instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<span class="pro_img"><a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><img src="<?php echo $v['logo']; ?>" style="width: 191px;height: 125px;" /></a></span>
						<h5><a href="<?php echo url('@detail/'.$v['goods_id']); ?>"><?php echo $v['goods_name']; ?></a></h5>
						<span class="color_sort"><?php echo $v['attr']; ?></span>
						<span class="count"><?php echo $v['number']; ?></span>
						<span class="unit"><?php echo $v['price']; ?></span>
						<span class="total"><?php echo $v['number'] * $v['price']; ?></span>
						<div>
							<span class="trans_method">运输方式：普通运输</span>
							<span class="unit"><?php echo $v['freight_price']; ?></span>
							<span class="total"><?php echo $v['freight_price']; ?></span>
						</div>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>	
				</ol>
				<div class="summation">
					<span class="sum">合计 <span class="sum_price"><?php echo $total_price; ?></span></span>
						<form onsubmit="return false">
							<input type="button" id="sub" onclick="order_submit()" value="提交订单" />
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
		
	<script type="text/javascript" src="/static/js/comfirm_order.js"></script>
	<script>
		function addr_add(){
			window.location.href = "<?php echo url('@address'); ?>";
		}

		function order_submit(){
			var addr_id;
			$(".edit").each(function(){
				if( $(this).css("display") == "block" ){
					addr_id = $(this).attr("value");
				}
			});
			var data = {
				'addr_id' : addr_id,
				'order_id' : "<?php echo $order_id; ?>",
			}
			
			$.ajax({
				url : "<?php echo url('@pay_money'); ?>",
				data : data,
				type : 'post',
				dataType : 'json',
				success : function(info){
					if( info.code == 1 ){
						layer.msg(info.msg,{icon:1,time:1000},function(){
							top.location.href = info.url;
						})
					}else{
						layer.msg(info.msg,{icon:2,time:1000})
					}
				}
			})
		}
	</script>

	</body>

</html>