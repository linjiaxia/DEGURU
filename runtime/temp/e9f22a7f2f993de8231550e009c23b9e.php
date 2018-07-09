<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/goods/recyclelist.html";i:1528869370;s:62:"/www/web/miracle_51zuopin_com/application/admin/view/base.html";i:1528869354;}*/ ?>
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


<title>商品列表</title>
<link rel="stylesheet" href="/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body>
<div>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		
		<div class="text-c"> 日期范围：
			<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
			<input type="text" name="" id="" placeholder=" 商品名称" style="width:250px" class="input-text">
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜商品</button>
		</div>
		
		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span> <span class="r">共有数据：<strong><?php echo $total; ?></strong> 条</span> </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover">
				<thead>
					<tr class="text-c">
						<th width="40"><input name="" type="checkbox" value=""></th>
						<th width="40">ID</th>
						<th width="60">缩略图</th>
						<th width="100">商品名称</th>
						<th>市场价</th>
						<th>本店价</th>
						<th>上架</th>
						<th>推荐</th>
						<th>热销</th>
						<th>新品</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<tr class="text-c va-m">
						<td><input name="id" type="checkbox" value="<?php echo $v['id']; ?>"></td>
						<td><?php echo $v['id']; ?></td>
						<td><img width="60" class="product-thumb" src="<?php echo DS . 'upload' . DS . $v['sm_logo']; ?>"></td>
						<td><?php echo $v['name']; ?></td>
						<td><?php echo $v['supermarket_price']; ?></td>
						<td><?php echo $v['shop_price']; ?></td>
						<td class="td-status"><span class="label <?php echo $v['is_sale']==1?'label-success' : 'label-error'; ?> radius"><?php echo $v['is_sale']==1?'上架' : '否'; ?></span></td>
						<td class="td-status"><span class="label <?php echo $v['is_best']==1?'label-primary' : 'label-error'; ?> radius"><?php echo $v['is_best']==1?'推荐' : '否'; ?></span></td>
						<td class="td-status"><span class="label <?php echo $v['is_hot']==1?'label-danger' : 'label-error'; ?> radius"><?php echo $v['is_hot']==1?'热销' : '否'; ?></span></td>
						<td class="td-status"><span class="label <?php echo $v['is_new']==1?'label-warning' : 'label-error'; ?> radius"><?php echo $v['is_new']==1?'新品' : '否'; ?></span></td>
						<td class="td-manage"><a style="text-decoration:none" class="ml-5" onclick="restore('<?php echo $v['id']; ?>')" href="javascript:;" title="商品还原"><i class="Hui-iconfont">&#xe6dc;</i></a> <a style="text-decoration:none" class="ml-5" onclick="del('<?php echo $v['id']; ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript">
/*还原*/
function restore(id){
	$.ajax({
		type : 'post',
		url : '<?php echo url('restore'); ?>',
		data : {'id':id},
		dataType : 'json',
		success : function(info){
			if(info.code==1){
				layer.msg(info.msg,{icon:1,time:1000});
				window.location.reload();
			}else{
				layer.msg(info.msg,{icon:2,time:1000});
			}
		}
	});
}
/*删除*/
function del(id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type : 'post',
			url : '<?php echo url('delete'); ?>',
			data : {'id':id},
			dataType : 'json',
			success : function(info){
				if(info.code==1){
					layer.msg(info.msg,{icon:1,time:1000});
					window.location.reload();
				}else{
					layer.msg(info.msg,{icon:2,time:1000});
				}
			}
		});
	});
}
/*批量删除*/
function datadel(){
	var ids = [];
	$('input[name^=id]:checked').each(function(){
		ids.push($(this).val());
	});

	$.ajax({
		url : '<?php echo url('deletion'); ?>',
		data : {'ids':ids},
		type : 'post',
		dataType : 'json',
		success : function(info){
			if(info.code == 1){
					layer.msg(info.msg,{icon:1,time:1500},function(){
						window.location.reload();
					}
				)}else{
					layer.msg(info.msg,{icon:2,time:1000})
				}
		}
	})
}
</script>


</body>
</html>