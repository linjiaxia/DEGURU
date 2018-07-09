<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\phpStudy\WWW\shop\public/../application/index\view\login\index.html";i:1528450274;s:56:"D:\phpStudy\WWW\shop\application\index\view\_footer.html";i:1528332847;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		
	<title>登录</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		<script type="text/javascript" src="/static/js/common.js"></script>
		
	<link rel="stylesheet" href="/static/css/login.css" />

	</head>

	<body>
		<div class="middle">
			<div class="logo"><a href="<?php echo url('@'.$constactData[0]['url']); ?>"><img src="<?php echo DS . 'upload' . DS . $constactData['0']['img']; ?>" alt="<?php echo $constactData['0']['name']; ?>" style="width: 191px;height: 43px;"></a></div>
		

			<form id="login" onsubmit="return false">
				<label for="name">账号</label><input type="text" name="username" id="name" />
				<br />
				<label for="pwd">密码</label><input type="password" name="password" id="pwd" />
				<span class="square"></span>
				<span class="forget_pwd"><a href="javascript:void(0)">忘记密码</a></span>
				<br />
				<label>验证码</label><input type="text" name="captcha" id="code" />
				<span class="vertification_code"><img id="captcha" src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>?x='+Math.random();"></span>
				<span class="change_img"><a id="kanbuq" href="javascript:void(0)">看不清，换一张</a></span>
				<br />
				<input type="button" id="sub" name="sub" value="登录">
				<span class="registic"><a href="<?php echo url('@register'); ?>">免费注册</a></span>
			</form>
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
		$("#kanbuq").click(function(){
			$("#captcha").attr("src","<?php echo captcha_src(); ?>");
		})

		$("#sub").click(function(){
			var data = $("form").serialize();

		    $.ajax({
		      url : "<?php echo url('@logon'); ?>",
		      data : data,
		      dataType : 'json',
		      type : 'post',
		      success : function(info){
		        if(info.code==1){
		          layer.msg(info.msg,{icon:1,time:1000},function(){
		            location.href=info.url;
		          })
		        }else{
		          layer.msg(info.msg,{icon:2,time:1000})
		          $("#captcha").attr("src","<?php echo captcha_src(); ?>");
		        }
		      }
		    })
		});
	</script>

	</body>

</html>