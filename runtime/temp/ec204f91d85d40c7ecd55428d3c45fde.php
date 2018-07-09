<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/order/index.html";i:1529391045;s:62:"/www/web/miracle_51zuopin_com/application/admin/view/base.html";i:1528869354;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->


<title>订单列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入订单名称，id" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜订单</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> </span> <span class="r">共有数据：<strong><?php echo $total; ?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="120">订单号</th>
				<th width="50">会员名称</th>
				<th width="80">商品名称</th>
				<th width="80">商品属性</th>
				<th width="80">联系电话</th>
				<th width="80">收货地址</th>
				<th width="50">支付状态</th>
				<th width="50">发货状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($orderData) || $orderData instanceof \think\Collection || $orderData instanceof \think\Paginator): $i = 0; $__LIST__ = $orderData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $v['id']; ?>" name="id"></td>
				<td><?php echo $v['order_number']; ?></td>
				<td><?php echo $v['member']; ?></td>
				<td><?php echo $v['goods_name']; ?></td>
				<td><?php echo $v['attr_name']; ?></td>
				<td><?php echo $v['phone']; ?></td>
				<td><?php echo $v['address']; ?></td>
				<td class="td-status"><span class="label 
				<?php switch($v['pay_status']): case "0": ?>label-error<?php break; case "1": ?>label-danger<?php break; case "2": ?>label-primary<?php break; endswitch; ?>
				radius">
				<?php switch($v['pay_status']): case "0": ?>待支付<?php break; case "1": ?>未支付<?php break; case "2": ?>已支付<?php break; endswitch; ?>
				</span></td>
				<td class="td-status"><span class="label 
				<?php switch($v['post_status']): case "0": ?>label-danger<?php break; case "1": ?>label-warning<?php break; case "2": ?>label-success<?php break; endswitch; ?>
				radius">
				<?php switch($v['post_status']): case "0": ?>未发货<?php break; case "1": ?>已发货<?php break; case "2": ?>已收货<?php break; endswitch; ?>
				</span></td>
				<td class="td-manage"><a style="text-decoration:none" onclick="show('订单查看','<?php echo url('detail',['id'=>$v['id']]); ?>','','350')" href="javascript:;" title="订单查看"><i class="Hui-iconfont">&#xe637;</i></a>
				<?php switch($v['post_status']): case "0": if($v['pay_status'] == 2): ?>
					<a style="text-decoration:none" class="ml-5" onclick="confirm('<?php echo $v['id']; ?>')" href="javascript:;" title="确认发货"><i class="Hui-iconfont">&#xe634;</i></a>
					<?php endif; break; case "1": ?>
					<a style="text-decoration:none" class="ml-5" onclick="receipt('<?php echo $v['id']; ?>')" href="javascript:;" title="确认发货"><i class="Hui-iconfont">&#xe6ab;</i></a>
				<?php break; endswitch; ?>
				</td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<?php echo $page; ?>
	</div>
</div>


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*详情*/
function show(title,url,w,h){
	layer_show(title,url,w,h);
}
/*确认发货*/
function confirm(id){
	layer.confirm('确认已发货吗？',function(index){
		$.ajax({
			type : 'post',
			url : "<?php echo url('confirm'); ?>",
			data : {'id':id},
			dataType : 'json',
			success : function(info){
				if(info.code==1){
					layer.msg(info.msg,{icon:1,time:1000},function(){
						window.location.reload();
					});
				}else{
					layer.msg(info.msg,{icon:2,time:1000});
				}
			}
		});
	});
}
/*确认收货*/
function receipt(id){
	layer.confirm('确认对方已收货吗？',function(index){
		$.ajax({
			type : 'post',
			url : "<?php echo url('receipt'); ?>",
			data : {'id':id},
			dataType : 'json',
			success : function(info){
				if(info.code==1){
					layer.msg(info.msg,{icon:1,time:1000},function(){
						window.location.reload();
					});
				}else{
					layer.msg(info.msg,{icon:2,time:1000});
				}
			}
		});
	});
}
</script> 


</body>
</html>