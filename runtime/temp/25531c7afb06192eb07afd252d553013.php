<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/member/recyclelist.html";i:1528869375;s:62:"/www/web/miracle_51zuopin_com/application/admin/view/base.html";i:1528869354;}*/ ?>
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


<title>会员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 会员管理 <span class="c-gray en">&gt;</span> 会员管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称，id" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜会员</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> </span> <span class="r">共有数据：<strong><?php echo $total; ?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">会员名称</th>
				<th width="100">手机</th>
				<th width="100">邮箱</th>
				<th width="100">注册时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($memberData) || $memberData instanceof \think\Collection || $memberData instanceof \think\Paginator): $i = 0; $__LIST__ = $memberData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $v['id']; ?>" name="id"></td>
				<td><?php echo $v['id']; ?></td>
				<td><?php echo $v['name']; ?></td>
				<td><?php echo $v['phone']; ?></td>
				<td><?php echo $v['email']; ?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['create_time']); ?></td>
				<td class="td-manage"><a style="text-decoration:none" class="ml-5" onclick="restore('<?php echo $v['id']; ?>')" href="javascript:;" title="会员还原"><i class="Hui-iconfont">&#xe6dc;</i></a> </td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
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
/*还原*/
function restore(id){
	$.ajax({
		type : 'post',
		url : "<?php echo url('restore'); ?>",
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
</script> 


</body>
</html>