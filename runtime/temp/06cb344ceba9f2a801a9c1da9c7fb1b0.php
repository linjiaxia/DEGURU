<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"/www/web/miracle_51zuopin_com/public_html/../application/index/view/member/address.html";i:1528869387;s:62:"/www/web/miracle_51zuopin_com/application/index/view/_nav.html";i:1528904100;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
		<title>收货地址</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/address.css" />
	<script type="text/javascript" src="/static/js/jquery.cityselect.js"></script>

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

				<form class="new_address" onsubmit="return false">

					<h4>新建地址</h4>

					<label for="name">姓名</label><input type="text" name="name" id="name" />

					<br />

					<label for="phone">电话</label><input type="text" name="phone" id="phone" maxlength="11" />

					<br />

					<label>所在区域</label>
					
					<select id="province" class="prov" name="prov">

						<option>--省--</option>

					</select>

					<select id="city" class="city" name="city">

						<option>--市--</option>

					</select>

					<select id="county" class="dist" name="dist">

						<option>--区--</option>

					</select><br />

					<label for="detail_address">详细地址</label><input type="text" name="address" id="detail_address" />

					<div id="detailtip">

						*详细地址不能为空

					</div><br />

					<label for="email">邮箱</label><input type="text" name="email" id="email" />

					<div id="emailtip">

						*邮箱格式不正确

					</div><br />

					

					<input type="button" id="sub" value="保存地址" onclick="insert()"/>

				</form>

				<div class="user_info">

					<span class="avatar">

						<img src="<?php echo DS . 'upload' . DS . $memberData['face']; ?>"  alt="<?php echo $memberData['name']; ?>" style="width: 124px;height: 124px;" />

					</span>

					<span class="nickname">昵称<span><?php echo $memberData['name']; ?></span></span><br />

					<span class="menber">会员<span><?php echo $levelData; ?><img src="/static/img/address_badge.png" /></span></span><br  />

					<span class="safe_account">账户安全<span class="bar"><span></span></span><span class="safe_level">中</span></span><br />

					<span class="honor">我的勋章</span>

				</div>

				<h4>已有的地址，请选择</h4>

				<ul class="exist_address">

					<li>

						<span class="addressee">收件人</span>

						<p>详细地址</p>

						<span class="tel">电话</span>

						<span class="mail">邮箱</span>

						<span class="code">邮编</span>

						<span class="operate">操作</span>

					</li>
					<?php if(is_array($addressData) || $addressData instanceof \think\Collection || $addressData instanceof \think\Paginator): $i = 0; $__LIST__ = $addressData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li><span class="addressee"><?php echo $v['name']; ?></span><p><?php echo $v['address']; ?></p><span class="tel"><?php echo $v['phone']; ?></span><span class="mail"><?php echo $v['email']; ?></span><span class="code">000000</span>

						<span class="operate">

							<span><a href="javascript:void(0)" onclick="edit(this,'<?php echo $v['id']; ?>')">编辑</a></span>

							<span><a href="javascript:void(0)" onclick="del(this,'<?php echo $v['id']; ?>')">删除</a></span>

						</span>

					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>

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
		$(function(){
			$("#city_1").citySelect(); 
			$(".new_address").citySelect({prov:"北京",nodata:"none"});
		})

		function insert(){
			var data = $("form").serialize();

			$.ajax({
				url : "<?php echo url('@address/'.$status.'/'.$order_id); ?>",
				data : data,
				dataType : 'json',
				type : 'post',
				success : function(info){
					if(info.code==1){
						layer.msg(info.msg,{icon:1,time:1000},function(){
							top.location.href = info.url;
						})
					}else{
						layer.msg(info.msg,{icon:2,time:1000})
					}
				}
			})
		}

		function edit(obj,id){
			window.location.href = "<?php echo url('@edit_address/"+id+"'); ?>";
		}

		function del(obj,id){
			$.ajax({
				url : "<?php echo url('@delete_address/"+id+"'); ?>",
				dataType : 'json',
				type : 'get',
				success : function(info){
					if(info.code==1){
						layer.msg(info.msg,{icon:1,time:1000},function(){
							window.location.reload();
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