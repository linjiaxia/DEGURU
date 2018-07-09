<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"/www/web/miracle_51zuopin_com/public_html/../application/index/view/member/index.html";i:1528889422;s:65:"/www/web/miracle_51zuopin_com/application/index/view/_middle.html";i:1528904101;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
	<title>会员中心</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
		<link rel="stylesheet" href="/static/css/user.css" />

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
				<form class="search" action="
				<?php if(isset($cat_id)): ?>
					<?php echo url('@list/'.$cat_id); else: ?>
					<?php echo url('@list'); endif; ?>
				" method="post"><label>宝贝</label><input type="text" name="condition" placeholder="请输入关键字" /><button type="submit">搜索</button></form>
			</div>


		<!--内容-->
		<div class="middle">
			<div class="box">
				<div class="user_list">
					<h2>会员中心</h2>
					<dl>
						<dt><a href="<?php echo url('@cart'); ?>">我的购物车</a></dt>
					</dl>
					<dl>
						<dt><a href="javascript:void(0)">购物管理</a></dt>
						<dd><a href="<?php echo url('@order'); ?>">我的订单</a></dd>
						<dd><a href="<?php echo url('@address/0'); ?>">收货地址</a></dd>
					</dl>
					<dl>
						<dt><a href="javascript:void(0)">账户设置</a></dt>
						<dd><a href="<?php echo url('@member'); ?>">账户信息</a></dd>
						<dd><a href="javascript:void(0)">密码修改</a></dd>
						<dd><a href="<?php echo url('@logout'); ?>">安全退出</a></dd>
					</dl>
					<dl>
						<dt><a href="javascript:void(0)">交易管理</a></dt>
						<dd><a href="javascript:void(0)">充币记录</a></dd>
					</dl>
				</div>
				<div class="user_info">
					<span class="user_icon">
						<img src="<?php echo DS . 'upload' . DS . $memberData['face']; ?>"  alt="<?php echo $memberData['name']; ?>" style="width: 171px;height: 171px;" />
						<a href="javascript:void(0)">修改个人资料</a>
					</span>
					<ol>
						<li><span class="nickname"><?php echo $memberData['name']; ?></span></li>
						<li>
							<p class="balance">我的余额<span><?php echo $memberData['money']; ?></span></p>
						</li>
					</ol>
					<ul>
						<li>
							<span>
								<a href="javascript:void(0)"><img src="/static/img/user_finish_icon.png" /></a>
							</span>
							<a href="javascript:void(0)">已完成  <?php echo $doneData; ?></a>
						</li>
						<li>
							<span>
								<a href="javascript:void(0)"><img src="/static/img/user_unpay_icon.png" /></a>
							</span>
							<a href="javascript:void(0)">待付款  <?php echo $waitData; ?></a>
						</li>
						<li>
							<span>
								<a href="javascript:void(0)"><img src="/static/img/user_transfer_icon.png" /></a>
							</span>
							<a href="javascript:void(0)">待收货  <?php echo $awaitData; ?></a>
						</li>
						<li>
							<span>
								<a href="javascript:void(0)"><img src="/static/img/user_comment_icon.png" /></a>
							</span>
							<a href="javascript:void(0)">待评价  <?php echo $beforeCommentData; ?></a>
						</li>
					</ul>
				</div>
				<form class="user" name="reg_testdate">
					<label for="username">头像</label><input type="button" id="upload_face" value="上传头像" onclick="uploadFace()" />
					<input type="file" name="face" style="display: none;" />
					<br />
					<label for="logname"></label><input type="hidden" /><br />
					<label for="nickname">昵称</label><input id="nickname" type="text" name="name" 
					<?php if($memberData['status'] == 1): ?>
					value="<?php echo $memberData['name']; ?>"
					<?php elseif($memberData['status'] == 0): ?>
					placeholder="<?php echo $memberData['name']; ?>" 
					<?php endif; ?>
					/><br />
					<label>性别</label>
					<input type="radio" name="gender" value="1" id="male" <?php echo $memberData['gender']==1?'checked="checked"':''; ?> /><label for="male">男</label>
					<input type="radio" name="gender" value="2" id="female" <?php echo $memberData['gender']==2?'checked="checked"':''; ?> /><label for="female">女</label>
					<input type="radio" name="gender" value="0" id="secret" <?php echo $memberData['gender']==0?'checked="checked"':''; ?> /><label for="secret">保密</label><br />
					<label>生日</label>
					<select id="year" name="YYYY" onchange="YYYYDD(this.value)">
					</select>
					<select id="month" name="MM" onchange="MMDD(this.value)">
					</select>
					<select id="day" name="DD">
					</select><br />
					<label>邮箱</label>
					<?php if($memberData['status'] == 0): ?>
					<a href="javascript:void(0)" onclick="checkMail()">立即验证</a>
					<?php else: ?>
					<a href="javascript:void(0)">已激活</a>
					<?php endif; ?>
					<br />
					<label for="realname">真实姓名</label><input type="text" id="realname" name="real_name" value="<?php echo $memberData['real_name']; ?>" /><br />
					<label for="hobby">兴趣爱好</label><input type="text" id="hobby" name="hobby" value="<?php echo $memberData['hobby']; ?>" /><br />
					<input type="button" value="提交" id="submit" onclick="setMsg()" />
				</form>
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
			birthday = "<?php echo date('Ymd',$memberData['birthday']); ?>";
			if(birthday != 0){
				year = birthday.substr(0,4);
				month = birthday.substr(4,2);
				if(month.substr(0,1) == 0) month = month.substr(1,1);
				day = birthday.substr(6,2);
				if(day.substr(0,1) == 0) day = day.substr(1,1);
			}
		})

		function YYYYMMDDstart()   
		{   
	       MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];   

	       //先给年下拉框赋内容   
	        var y  = new Date().getFullYear();   
	        for (var i = (y-30); i < (y+30); i++)
	        	//以今年为准，前30年，后30年   
            	document.reg_testdate.YYYY.options.add(new Option(" "+ i +" 年", i));

	        //赋月份的下拉框   
	        for (var i = 1; i < 13; i++)   
	               document.reg_testdate.MM.options.add(new Option(" " + i + " 月", i));   

	        document.reg_testdate.YYYY.value = y;   
	        document.reg_testdate.MM.value = new Date().getMonth() + 1;   
	        var n = MonHead[new Date().getMonth()];   
	        if (new Date().getMonth() ==1 && IsPinYear(YYYYvalue)) n++;   
	        	writeDay(n); //赋日期下拉框Author:meizz   
	        document.reg_testdate.DD.value = new Date().getDate(); 
	        $("#year option[value="+year+"]").attr("selected",true);
	        $("#month option[value="+month+"]").attr("selected",true);
	        $("#day option[value="+day+"]").attr("selected",true);
		}   
		if(document.attachEvent)   
		    window.attachEvent("onload", YYYYMMDDstart);   
		else   
		    window.addEventListener('load', YYYYMMDDstart, false); 

		function YYYYDD(str) //年发生变化时日期发生变化(主要是判断闰平年)   
		{   
		        var MMvalue = document.reg_testdate.MM.options[document.reg_testdate.MM.selectedIndex].value;   
		        if (MMvalue == ""){ var e = document.reg_testdate.DD; optionsClear(e); return;}   
		        var n = MonHead[MMvalue - 1];   
		        if (MMvalue == 2 && IsPinYear(str)) n++;   
		            writeDay(n)   
		}   

		function MMDD(str)   //月发生变化时日期联动   
		{   
		    var YYYYvalue = document.reg_testdate.YYYY.options[document.reg_testdate.YYYY.selectedIndex].value;   
		    if (YYYYvalue == ""){ var e = document.reg_testdate.DD; optionsClear(e); return;}   
		    var n = MonHead[str - 1];   
		    if (str == 2 && IsPinYear(YYYYvalue)) n++;   
		    writeDay(n)   
		}   

		function writeDay(n)   //据条件写日期的下拉框   
		{   
		        var e = document.reg_testdate.DD; optionsClear(e);   
		        for (var i=1; i<(n+1); i++)   
		            e.options.add(new Option(" "+ i + " 日", i));   
		}   
		function IsPinYear(year)//判断是否闰平年   
		{     
			return(0 == year%4 && (year%100 !=0 || year%400 == 0));
		}   
		function optionsClear(e)   
		{   
		    e.options.length = 1;   
		}

		function uploadFace(){
			$("input[name='face']").click();
		}

		function checkMail(){
			$.ajax({
				url : "<?php echo url('@set_email'); ?>",
				dataType : 'json',
				type : 'post',
				success : function(info){
					if(info.code==1){
						layer.msg(info.msg,{icon:1,time:1000});
					}else{
						layer.msg(info.msg,{icon:2,time:1000});
					}
				}
			});
		}

		function setMsg(){
			var data = new FormData($("[name='reg_testdate']")[0]);

			$.ajax({
				url : "<?php echo url('@member'); ?>",
				data : data,
				dataType : 'json',
				type : 'post',
				processData: false,  // 告诉jQuery不要去处理发送的数据
				contentType: false,   // 告诉jQuery不要去设置Content-Type请求头
				success : function(info){
					if(info.code==1){
						layer.msg(info.msg,{icon:1,time:1000},function(){
							window.location.reload();
						})
					}else{
						layer.msg(info.msg,{icon:2,time:1000});
					}
				}
			});
		}
	</script>

	</body>

</html>