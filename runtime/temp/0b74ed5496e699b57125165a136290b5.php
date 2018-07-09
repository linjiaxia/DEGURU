<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/goods/index.html";i:1528947883;s:62:"/www/web/miracle_51zuopin_com/application/admin/view/base.html";i:1528869354;}*/ ?>
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
<body class="pos-r">
<div class="pos-a" style="width:200px;left:0;top:0; bottom:0; height:100%; border-right:1px solid #e5e5e5; background-color:#f5f5f5; overflow:auto;">
	<ul id="treeDemo" class="ztree"></ul>
</div>
<div style="margin-left:200px;">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		
		<div class="text-c"> 日期范围：
			<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
			<input type="text" name="" id="" placeholder=" 商品名称" style="width:250px" class="input-text">
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜商品</button>
		</div>
		
		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="recycles()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量移除</a> <a class="btn btn-primary radius" onclick="add('添加商品','<?php echo url('create'); ?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加商品</a></span> <span class="r">共有数据：<strong><?php echo $total; ?></strong> 条</span> </div>
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
							<td class="td-manage"><a style="text-decoration:none" onclick="numlist('商品库存','<?php echo url('kucun',['id'=>$v['id']]); ?>')" href="javascript:;" title="库存"><i class="Hui-iconfont">&#xe637;</i></a> <a style="text-decoration:none" class="ml-5" onclick="edit('编辑商品','<?php echo url('edit',['id'=>$v['id']]); ?>')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onclick="recycle('<?php echo $v['id']; ?>')" href="javascript:;" title="商品回收"><i class="Hui-iconfont">&#xe6de;</i></a></td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div id="page"><?php echo $list->render(); ?></div>
		</div>
	</div>
</div>


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
var zNodes;
	$.ajax({
		url : "<?php echo url('showcat'); ?>",
		type : 'get',
		dataType : 'json',
		async : false,
		success : function(info){
			zNodes = info;
		}
	});

var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pid",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			if(treeNode.pid != ''){
				$.ajax({
					url : "<?php echo url('catList'); ?>",
					data : {'id':treeNode.id},
					dataType : 'json',
					type : 'post',
					success : function(info){
						if(info.code==1){
							$("tbody").html(info.list);
							$("strong").html(info.total);
							$("#page").html(info.pageinfo);
						}
					}
				})
			}
		}
	}
};
		
$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	var zTree = $.fn.zTree.getZTreeObj("tree");
});
/*添加*/
function add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*编辑*/
function edit(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*移除*/
function recycle(id){
	layer.confirm('确认要回收吗？',function(index){
		$.ajax({
			type : 'post',
			url : "<?php echo url('recycle'); ?>",
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
/*批量移除*/
function recycles(){
	var ids = [];
	$('input[name^=id]:checked').each(function(){
		ids.push($(this).val());
	});

	$.ajax({
		url : "<?php echo url('recycles'); ?>",
		data : {'ids':ids},
		type : 'post',
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
	})
}
/*库存*/
function numlist(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
</script>


</body>
</html>