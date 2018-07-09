<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"/www/web/miracle_51zuopin_com/public_html/../application/index/view/goods/detail.html";i:1529391448;s:65:"/www/web/miracle_51zuopin_com/application/index/view/_middle.html";i:1528904101;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
	<title>商品详情</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/pro_details.css" />

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
			<div class="img_info">
				<div class="big">
					<img src="<?php echo DS . 'upload' . DS . $goodsData['logo']; ?>" alt="<?php echo $goodsData['name']; ?>"  style="width: 596px;height: 452px;"/>
					<div class="box1"></div>
				</div>
				
				<div class="thumb">
					<div>
						<ul>
						<li class="turn"><img src="<?php echo DS . 'upload' . DS . $goodsData['logo']; ?>" alt="<?php echo $goodsData['name']; ?>"  style="width: 154px;height: 147px;"/></li>
						<?php if(is_array($photoData) || $photoData instanceof \think\Collection || $photoData instanceof \think\Paginator): $i = 0; $__LIST__ = $photoData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li><img src="<?php echo DS . 'upload' . DS . $v; ?>" alt="<?php echo $goodsData['name']; ?>"  style="width: 154px;height: 147px;"/></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
					<span class="left"><img src="/static/img/arrow_left.png" alt="" /></span>
					<span class="right"><img src="/static/img/arrow_right.png" alt="" /></span>
				</div>
			</div>
			<div class="pro_info">
				<div class="original"></div>
				<h5><?php echo $goodsData['name']; ?><?php echo $goodsData['is_sale']==1?'' : '(已下架)'; ?></h5>
				<span>收藏</span>
				<div>
					<p>¥<span><?php echo $goodsData['shop_price']; ?></span></p>
					<span>特色：<?php echo $goodsData['feature']; ?></span>
					<span><?php echo $goodsData['promote_price']; ?></span>
					<span></span>
					<ul>
						<li>月销量 <?php echo $salesNumber['count']; ?></li>
						<li>评价 <?php echo $commentNumber['count']; ?></li>
						<li>待评价 <?php echo $waitCommentData['count']; ?></li>
					</ul>
				</div>
				<?php if(is_array($attrPriceData) || $attrPriceData instanceof \think\Collection || $attrPriceData instanceof \think\Paginator): $i = 0; $__LIST__ = $attrPriceData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				<dl class="choose">
						<dt><?php echo $key; ?></dt>
						<?php if(is_array($v) || $v instanceof \think\Collection || $v instanceof \think\Paginator): $i = 0; $__LIST__ = $v;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<dd <?php echo $goodsData['is_sale']==1?'onclick="change_price(this)"':''; ?>
							value="<?php echo $key; ?>"
							<?php echo $i==1?'class="active"':''; ?>
							style="<?php echo strpos(','.$attrIdData.',',','.$key.',') !== false ? 'color: black;' : 'color: gray;'; ?>"
							><?php echo $vo; ?></dd>
						<?php endforeach; endif; else: echo "" ;endif; ?>
				</dl>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<dl class="quantity">
					<dt>数量</dt>
					<dd>
						<input type="text" name="number" class="quantity_num" value="1">
						<div class="add"><span></span></div>
						<div class="reduce"><span></span></div>
					</dd>
					<dd>库存<span></span>件</dd>
				</dl>
				<a href="javascript:void(0)" class="purchase" onclick="pay('<?php echo $goodsData['id']; ?>')">立即购买</a>
				<a href="javascript:void(0)" class="add_to_cart" onclick="setProduct('<?php echo $goodsData['id']; ?>')">加入购物车</a>
			</div>
			<div class="parameters">
				<h4>产品参数</h4>
				<ul>
					<?php if(is_array($attrData) || $attrData instanceof \think\Collection || $attrData instanceof \think\Paginator): $i = 0; $__LIST__ = $attrData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li><?php echo $key; ?>：<?php echo $v; ?> </li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<div class="tabs">
				<span class="pro_detail on">产品详情</span>
				<span class="comment">商品评价</span>
			</div>
			<ul class="details">
				<?php echo $goodsData['goods_desc']; ?>
			</ul>
			<div class="evalution">
				<ul class="score">
					<li>
						<img src="/static/img/evalution_quantity.png" />
						<span>质量好</span>
					</li>
					<li>
						<img src="/static/img/evalution_practicability.png" />
						<span>很实用</span>
					</li>
					<li>
						<img src="/static/img/evalution_transfer.png" />
						<span>物流快</span>
					</li>
					<li>
						<img src="/static/img/evalution_server.png" />
						<span>服务一流</span>
					</li>
					<li>
						<img src="/static/img/evalution_performance.png" />
						<span>性价比高</span>
					</li>
					<li>
						<img src="/static/img/evalution_easy.png" />
						<span>简单易用</span>
					</li>
					<li>
						<img src="/static/img/evalution_appearance.png" />
						<span>外观不错</span>
					</li>
				</ul>
				<ul class="evalute">
					<?php if(is_array($commentData) || $commentData instanceof \think\Collection || $commentData instanceof \think\Paginator): $i = 0; $__LIST__ = $commentData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<div class="account">
							<span class="avatar"><img src="<?php echo DS . 'upload' . DS . $v['face']; ?>" alt="<?php echo $v['name']; ?>"  style="width: 61px;height: 58px;"/></span>
							<span class="account_name"><?php echo $v['name']; ?></span>
						</div>
						<div>
							<p><?php echo $v['content']; ?></p>
							<span class="time"><?php echo date($v['create_time'],'Y-m-d H:i:s'); ?></span>
							<a href="javascript:void(0)" class="addition">追加评论</a>
							<img src="/static/img/evalute_img01.jpg" />
							<img src="/static/img/evalute_img02.jpg" />
							<img src="/static/img/evalute_img03.jpg" />
						</div>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="page_list">
					<?php echo $page; ?>
				</div>
			</div>
			<div class="others">
				<h4>其他商品</h4>
				<ol>
					<?php if(is_array($otherData) || $otherData instanceof \think\Collection || $otherData instanceof \think\Paginator): $i = 0; $__LIST__ = $otherData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<a href="<?php echo url('@detail/' . $v['id']); ?>"><img src="<?php echo DS . 'upload' . DS . $v['logo']; ?>" alt="<?php echo $v['name']; ?>"  style="width: 293px;height: 309px;"/></a>
						<h6><a href="<?php echo url('@detail/' . $v['id']); ?>"><?php echo $v['name']; ?></a></h6>
						<span class="price">¥<i><?php echo $v['shop_price']; ?></i></span>
						<p>
							<span class="quantity">销售量 199</span>
							<span class="stock"><?php echo $v['number']==''?'暂无库存' : '库存 ' . $v['number'] . '件'; ?></span>
						</p>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ol>
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
		
<script type="text/javascript" src="/static/js/shopCar.js" ></script>
<script type="text/javascript" src="/static/js/pro_details.js" ></script>
<script>
	$(function(){
		var ids = [];
		$(".choose dd.active").each(function(){
			ids.push($(this).attr("value"));
		});
		var data = {
			'ids' : ids,
		}
		$.ajax({
			url : "<?php echo url('@getPrice'); ?>",
			type : 'post',
			dataType : 'json',
			data : data,
			success : function(info){
				if(info.code == 1){
					var price = $(".pro_info p span").html(info.msg);
					$(".quantity").children("dd:last-child").find("span").html(info.url);
					if( info.url == 0 ){
						$(".pro_info").find($(".purchase")).css("background-color","gray");
						$(".pro_info").find($(".purchase")).removeAttr('onclick');
						$(".add_to_cart").css("border-color","gray");
						$(".add_to_cart").removeAttr("onclick");
					}
				}
			}
		})
	})

	$(".left").find("img").mouseover(function(){$(this).attr("src","/static/img/arrow_left_red.png");});$(".left").find("img").mouseout(function(){$(this).attr("src","/static/img/arrow_left.png");});$(".right").find("img").mouseover(function(){$(this).attr("src","/static/img/arrow_right_red.png");});$(".right").find("img").mouseout(function(){$(this).attr("src","/static/img/arrow_right.png");});

	function change_price(obj){
		if( $(obj).hasClass("active") == false ){
			$(obj).siblings("dd").removeAttr("class");
			$(obj).addClass("active");
			var ids = [];
			$(".choose dd.active").each(function(){
				ids.push($(this).attr("value"));
			});
			var data = {
				'ids' : ids,
			}
			$.ajax({
				url : "<?php echo url('@getPrice'); ?>",
				type : 'post',
				dataType : 'json',
				data : data,
				async : false,
				success : function(info){
					if(info.code == 1){
						var price = $(".pro_info p span").html(info.msg);
						$(".quantity").children("dd:last-child").find("span").html(info.url);
						if( info.url == 0 ){
							$(".pro_info").find($(".purchase")).css("background-color","gray");
							$(".pro_info").find($(".purchase")).removeAttr('onclick');
							$(".add_to_cart").css("border-color","gray");
							$(".add_to_cart").removeAttr("onclick");
						}else{
							$(".pro_info").find($(".purchase")).css("background-color","");
							$(".pro_info").find($(".purchase")).attr("onclick","pay('<?php echo $goodsData['id']; ?>')");
							$(".add_to_cart").css("border-color","");
							$(".add_to_cart").attr("onclick","setProduct('<?php echo $goodsData['id']; ?>')");
						}
					}
				}
			})
		}
	}

	function pay(id){
		var url = "<?php echo url('@immediately'); ?>";
		var ids = [];
		$(".choose dd.active").each(function(){
			ids.push($(this).attr("value"));
		});
		var number = $("input[name='number']").val();
		var kucun = $(".quantity").children("dd:last-child").find("span").text();
		if( number > kucun ){
			layer.msg('购买量超出库存',{icon:2,time:1000})
			return false;
		}
		var data = {
			'goods_attr_id' : ids,
			'number' : number,
			'goods_id' : id,
		}
		$.StandardPost(url,data);
	}

	$.extend({
	    StandardPost:function(url,args){
	        var form = $("<form method='post' style='display: none;'></form>"),
	            input;
	        form.attr({"action":url});
	        $.each(args,function(key,value){
	            input = $("<input type='hidden'>");
	            input.attr({"name":key});
	            input.val(value);
	            form.append(input);
	        });
	        form.appendTo(document.body);
	        form.submit();
	    }
	});

	function setProduct(id){
		var ids = [];
		$(".choose dd.active").each(function(){
			ids.push($(this).attr("value"));
		});
		var data = {
			'ids' : ids,
			'number' : $("input[name='number']").val(),
			'goods_id' : id,
		}
		
		$.ajax({
			url : "<?php echo url('@set_cart'); ?>",
			type : 'post',
			data : data,
			dataType : 'json',
			success : function(info){
				if( info.code == 1 )
					layer.msg(info.msg,{icon:1,time:1000});
				else
					layer.msg(info.msg,{icon:2,time:1000});
			}
		})
	}
</script>

	</body>

</html>