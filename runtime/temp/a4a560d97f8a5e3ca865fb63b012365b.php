<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:88:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/attribute/index.html";i:1528869364;s:62:"/www/web/miracle_51zuopin_com/application/admin/view/base.html";i:1528869354;}*/ ?>
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


<title>属性列表</title>
<link rel="stylesheet" href="/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body>
<div>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 类型管理 <span class="c-gray en">&gt;</span> 属性管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<div class="text-c">
			所属类型:
			<form class="select-box inline" action="<?php echo url('index'); ?>" method="post">
				<select class="select" id="type" name="type_id">
					<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $v['id']; ?>"
					<?php echo $v['id']==$type_id?'selected="selected"':''; ?>
					><?php echo $v['name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<input style="display: none;" type="submit">
			</form>
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="add('添加属性','<?php echo url('create'); ?>','','350')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加属性</a></span> <span class="r">共有数据：<strong><?php echo $total; ?></strong> 条</span> </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="40"><input name="" type="checkbox" value=""></th>
						<th width="40">ID</th>
						<th width="80">属性名称</th>
						<th width="80">属性可选</th>
						<th width="80">所属类型</th>
						<th width="100">属性的可选值</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<tr class="text-c va-m">
						<td><input name="id" type="checkbox" value="<?php echo $v['id']; ?>"></td>
						<td><?php echo $v['id']; ?></td>
						<td class="text-c"><?php echo $v['name']; ?></td>
						<td class="text-c"><?php echo $v['choice']; ?></td>
						<td class="text-c"><?php echo $v['type_id']; ?></td>
						<td class="text-c"><?php echo $v['values']; ?></td>
						<td class="td-manage"><a style="text-decoration:none" class="ml-5" onclick="edit('属性编辑','<?php echo url('edit',['id'=>$v['id']]); ?>','','350')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onclick="del(this,'<?php echo $v['id']; ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
<script type="text/javascript" src="/admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*添加*/
function add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*编辑*/
function edit(title,url,w,h){
	layer_show(title,url,w,h);
}
/*删除*/
function del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type : 'post',
			url : '<?php echo url('delete'); ?>',
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
$("#type").change(function(){
	$("form").submit();
})
</script>


</body>
</html>