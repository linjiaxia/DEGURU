<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\phpStudy\WWW\shop\public/../application/index\view\cart\index.html";i:1528684525;s:53:"D:\phpStudy\WWW\shop\application\index\view\_nav.html";i:1528523127;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		
	<title>购物车</title>

		<link rel="stylesheet" href="/static/css/common.css" />
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
		
	<link rel="stylesheet" href="/static/css/shop_cart.css" />

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
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<td colspan="6">
								<span><a href="javascript:void(0)">全场商品</a></span>
								<span><a href="javascript:void(0)">降价商品</a></span>
								<span><a href="javascript:void(0)">库存紧张商品</a></span>
								<span>已选商品 <i class="price">0.00</i></span>
								<span class="pay"><a href="javascript:void(0)" onclick="pay()">结算</a></span>
							</td>
						</tr>
						<tr>
							<th><label><input type="checkbox" class="checkAll" />全部</label></th>
							<th>商品信息</th>
							<th>数量</th>
							<th>单价</th>
							<th>金额</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<form action="<?php echo url('@set_pay'); ?>" method="post">
						<?php if(is_array($cartData) || $cartData instanceof \think\Collection || $cartData instanceof \think\Paginator): $i = 0; $__LIST__ = $cartData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<tr>
							<td><input type="checkbox" class="cbox" name="id[]" onchange="checkChange()" value="<?php echo $v['id']; ?>"></td>
							<td><a href="<?php echo url('@detail/' . $v['goods_id']); ?>"><img src="<?php echo $v['sm_logo']; ?>" alt="<?php echo $v['name']; ?>"  style="width: 191px;height: 92px;"></a><h4><a href="pro_details.html"><?php echo $v['name']; ?></a></h4>
								<span class="color_sort">
								<input type="hidden" name="goods_attr_id[<?php echo $v['id']; ?>]" value="<?php echo $v['attr_value']; ?>">
								<?php echo $v['attr']; ?></span></td>
							<td>
								<span class="reduce" onclick="bottom_price(this,'<?php echo $v['id']; ?>')">-</span>
								<input type="text" name="number[<?php echo $v['id']; ?>]" value="<?php echo $v['goods_number']; ?>" class="num" onchange="change(this,'<?php echo $v['id']; ?>')">
								<span class="add" onclick="top_price(this,'<?php echo $v['id']; ?>')">+</span>
							</td>
							<td><span class="unit"><?php echo $v['price']; ?></span></td>
							<td><span class="total_price"><?php echo $v['total_price']; ?></span></td>
							<td style="display: none;"><input name="goods_id[<?php echo $v['id']; ?>]" value="<?php echo $v['goods_id']; ?>" /></td>
							<td><span></span><br><span class="del"><a href="javascript:void(0)" onclick="cart_del('<?php echo $v['id']; ?>')">删除</a></span></td>
						</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</form>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6">
								<span><label><input type="checkbox" class="checkAll" />全部</label></span>
								<span><a href="javascript:void(0)" onclick="cart_dels()">删除</a></span>
								<span><a href="javascript:void(0)">移入收藏夹</a></span>
								<span><a href="javascript:void(0)">分享</a></span>
								<span>已选商品 <i id="choose_num">0</i>件</span>
								<span>合计 <i id="sum">0.00</i></span>
							</td>
						</tr>
					</tfoot>
				</table>
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
		function change(obj,id){
			var unit = $(obj).parent().siblings().find(".unit").text();
			unit = parseFloat(unit);
			var number = $(obj).val();
			var price = number * unit;

			$.ajax({
				url : "<?php echo url('@set_price'); ?>",
				data : {'id':id,'number':number},
				dataType : 'json',
				type : 'post',
				async : false,
				success : function(info){
					if( info.code == 1 ){
						$(obj).parent().siblings().find(".total_price").html(price);
						checkChange();
					}
				}
			})
		}

		function bottom_price(obj,id){
			var number = $(obj).siblings(".num").val();
			if( number == 1 ) number = 1;
			else number--;
			$(obj).siblings(".num").val(number);
			change( $(obj).siblings(".num"),id );
		}

		function top_price(obj,id){
			var number = $(obj).siblings(".num").val();
			number++;
			$(obj).siblings(".num").val(number);
			change( $(obj).siblings(".num"),id );
		}

		function checkChange(){
			var cbox = $("tbody").find(".cbox:checked");
			var len = cbox.length;
			var total = 0;
			var price = cbox.parent().siblings().find(".total_price").each(function(){
				total += parseFloat( $(this).text() );
			});
			total = total == 0 ? '0.00' : total.toFixed(2);
			$("#choose_num").html(len);
			$("i.price").html(total);
			$("#sum").html(total);
			var count = $("tbody").find(".cbox").length;
			if( len == count )
				$(".checkAll").attr("checked","checked");
			else
				$(".checkAll").removeAttr("checked");
		}

		$(".checkAll").click(function(){
			if( typeof($(this).attr("checked")) != "undefined" ){
				$(".checkAll").attr("checked","checked");
				$("input[name='id[]']").attr("checked","checked");
				checkChange();
			}else{
				$(".checkAll").removeAttr("checked");
				$("input[name='id[]']").removeAttr("checked");
				checkChange();
			}
		})

		function cart_del(id){
			layer.confirm('确认要删除吗？',function(index){
				$.ajax({
					url : "<?php echo url('@del_cart/"+id+"'); ?>",
					dataType : 'json',
					type : 'post',
					success : function(info){
						if( info.code == 1 ){
							window.location.reload();
						}
					}
				})
			});
		}

		function cart_dels(){
			var ids = [];
			$('input[name^=id[]]:checked').each(function(){
				ids.push( $(this).val() );
			});

			$.ajax({
				url : "<?php echo url('@dels_cart'); ?>",
				data : {'ids':ids},
				type : 'post',
				dataType : 'json',
				success : function(info){
					if( info.code==1 ){
						window.location.reload();
					}
				}
			})
		}

		function pay(){
			var len = $("tbody").find(".cbox:checked").length;
			if( len <= 0 )
				layer.msg('请选择要购买的商品',{icon:2,time:1000})
			else
				$("form").submit();
		}
	</script>

	</body>

</html>