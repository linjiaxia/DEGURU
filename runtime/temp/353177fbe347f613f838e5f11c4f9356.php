<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/role/edit.html";i:1528869381;s:62:"/www/web/miracle_51zuopin_com/application/admin/view/base.html";i:1528869354;}*/ ?>
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


<title>新建网站角色 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $role['name']; ?>" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $role['describe']; ?>"
				 name="describe">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色权限：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="<?php echo $v['id']; ?>" name="pri_id[]" id="user-Character-0" <?php echo in_array($v['id'],$privilege)?'checked="checked"':''; ?>>
							<?php echo $v['name']; ?></label>
					</dt>
					<dd>
						<?php if(is_array($v['next']) || $v['next'] instanceof \think\Collection || $v['next'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['next'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="<?php echo $v1['id']; ?>" name="pri_id[]" id="user-Character-0-0" <?php echo in_array($v1['id'],$privilege)?'checked="checked"':''; ?>>
									<?php echo $v1['name']; ?></label>
							</dt>
							<dd>
								<?php if(is_array($v1['next']) || $v1['next'] instanceof \think\Collection || $v1['next'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v1['next'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
								<label class="">
									<input type="checkbox" value="<?php echo $v2['id']; ?>" name="pri_id[]" id="user-Character-0-0-0" <?php echo in_array($v2['id'],$privilege)?'checked="checked"':''; ?>>
									<?php echo $v2['name']; ?></label>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</dd>
						</dl>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</dd>
				</dl>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="button" onclick="update('<?php echo $role['id']; ?>')" class="btn btn-success radius"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
});
function update(id){
	var ids = [];
	$('input[name^=pri_id]:checked').each(function(){
		ids.push($(this).val());
	});
	var data = {
		'id' : id,
		'name' : $('[name="name"]').val(),
		'describe' : $('[name="describe"]').val(),
		'pri_id' : ids,
	}

	$.ajax({
		url : '<?php echo url('update'); ?>',
		data : data,
		dataType : 'json',
		type : 'post',
		success : function(info){
			if(info.code==1){
				layer.msg(info.msg,{icon:1,time:1000},function(){
					parent.location.reload();
				})
			}else{
				layer.msg(info.msg,{icon:2,time:1000})
			}
		}
	})
}
	$("input").keyup(function(e){
	    if(e.keyCode == 13){
	      update();
	    }
	})
</script>
<!--/请在上方写此页面业务相关的脚本-->


</body>
</html>