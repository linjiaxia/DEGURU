<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"/www/web/miracle_51zuopin_com/public_html/../application/index/view/login/register.html";i:1528869386;s:65:"/www/web/miracle_51zuopin_com/application/index/view/_footer.html";i:1528904102;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		
	<title>注册</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/reg.css" />

	</head>

	<body>
		<div class="middle">
			<div class="logo"><a href="<?php echo url('@'.$constactData[0]['url']); ?>"><img src="<?php echo DS . 'upload' . DS . $constactData['0']['img']; ?>" alt="<?php echo $constactData['0']['name']; ?>" style="width: 191px;height: 43px;"></a></div>
		

			<form id="reg" onsubmit="return false">
				<label>账号</label><input type="text" name="username" id="name" />
				<br />
				<label>密码</label><input type="password" name="password" id="pwd" />
				<br />
				<label>确认密码</label><input type="password" name="repassword" id="comfirm_pwd" />
				<br />
				<label>Email</label><input type="text" name="email" id="email" />
				<br />
				<label>手机号</label><input type="text" name="phone" id="phone" />
				<br />
				<label>手机验证码</label><input type="text" name="code" id="code" />
				<span class="vertification_code"></span>
				<span class="change_img"><a href="javascript:void(0)" id="getting" onclick="obtain()">免费获取验证码</a></span>
				<br />
				<input type="checkbox" name="agree" id="agree" /><label for="agree">同意注册协议</label>
				<div id="checktip">*请勾选协议</div>
				<br />
				<!--<input type="submit" id="sub" name="sub" value="注册" onclick="alert('greg');"/>-->
				<input type="submit" id="sub" name="sub" value="注册" onclick="register()" disabled  style="background-color: brown;" />
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
		
	<script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
	<script>
		var resend = null;
		$("#agree").click(function(){
			if( $("#agree").is(":checked") == true ){
				$("#sub").removeAttr("disabled");
				$("#sub").css("background-color","");
			}else{
				$("#sub").attr("disabled","disabled");
				$("#sub").css("background-color","brown");
			}
		})

		function obtain(){
	    	if($.trim($('#phone').val()).length == 0){
				layer.msg('请输入手机号码',{icon:2,time:1000})
				return false;
			}
			if( !(/^1[34578]\d{9}$/).test($.trim($('#phone').val())) ){
				layer.msg('手机号码格式不正确',{icon:2,time:1000})
				return false;
			}
			var data = {
	    		'phone' : $('#phone').val(),
	    	}
	    	var count = $.cookie("captcha");
	    	if(count > 0) return false;
	    	
	    	$.ajax({
				url : "<?php echo url('@getCode'); ?>",
				data : data,
				dataType : 'json',
				type : 'post',
				async : false,
				success : function(info){
					if( info.respCode == 00000 ){
						layer.msg('已发送',{icon:1,time:1000},function(){
							setForbid();
						})
					}else if(info.respCode == 01010){
						layer.msg(info.respDesc,{icon:2,time:1000})
					}else{
						layer.msg(info.respDesc,{icon:2,time:1000},function(){
							setForbid();
						})
					}
				}
			});
		}

		function register(){
			var data = $("form").serialize();

			$.ajax({
				url : "<?php echo url('@register'); ?>",
				data : data,
				dataType : 'json',
				type : 'post',
				success : function(info){
					if(info.code==1){
						layer.msg(info.msg,{icon:1,time:1000},function(){
							window.location.href = info.url;
						})
					}else{
						layer.msg(info.msg,{icon:2,time:1500})
					}
				}
			})
		}

	    /*仿刷新：检测是否存在cookie*/  
	    if($.cookie("captcha")){  
	        var count = $.cookie("captcha");
	        var btn = $('#getting');  
	        btn.html(count+'秒后可重新获取').attr('disabled',true).css('cursor','not-allowed');  
	        var resend = setInterval(function(){  
	            count--;  
	            if (count > 0){  
	                btn.html(count+'秒后可重新获取').attr('disabled',true).css('cursor','not-allowed');  
	                $.cookie("captcha", count, {path: '/', expires: (1/86400)*count});  
	            }else {  
	                clearInterval(resend);  
	                btn.html("获取验证码").removeClass('disabled').removeAttr('disabled style');  
	            }  
	        }, 1000);  
	    }  

	    /*点击改变按钮状态，已经简略掉ajax发送短信验证的代码*/  
	    function setForbid(){  
	        var btn = $("#getting");  
	        var count = 60;
	        resend = setInterval(function(){  
	            count--;  
	            if(count > 0){  
	                btn.html(count+"秒后可重新获取");  
	                $.cookie("captcha", count, {path: '/', expires: (1/86400)*count});  
	            }else{
	            	clearInterval(resend);  
					btn.html("获取验证码").removeAttr('disabled style');
	            }  
	        }, 1000);
	        btn.attr('disabled',true).css('cursor','not-allowed');  
	    }
	</script>

	</body>

</html>