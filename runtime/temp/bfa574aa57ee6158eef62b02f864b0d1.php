<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/goods/kucun.html";i:1528869370;s:62:"/www/web/miracle_51zuopin_com/application/admin/view/base.html";i:1528869354;}*/ ?>
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
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover">
				<thead>
					<tr class="text-c">
						<?php if(is_array($attr) || $attr instanceof \think\Collection || $attr instanceof \think\Paginator): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<th><?php echo $v['0']['name']; ?></th>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						<th width="100">库存量</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<form>
				<tbody>
				<?php if($goods_number): if(is_array($goods_number) || $goods_number instanceof \think\Collection || $goods_number instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_number;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($key == 0): $opt = '&#xe600;';$color = 'btn-primary';$pd = 'true'; else: $opt = '&#xe6a1;';$color = 'btn-danger';$pd = ''; endif; ?>
						<tr class="text-c va-m">
							<?php if(is_array($attr) || $attr instanceof \think\Collection || $attr instanceof \think\Paginator): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<td>
								<select name="attribute_id[]" class="select">
									<option value="">请选择</option>
									<?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
									<option value="<?php echo $vv['id']; ?>"
									<?php if(strpos(','.$v['attribute_id'].',',','.$vv['id'].',') !== FALSE): ?>
									selected="selected"
									<?php endif; ?>
									><?php echo $vv['attribute_value']; ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</td>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							<td><input type="text" class="input-text" value="<?php echo $v['number']; ?>" name="number[]"></td>
							<td><a href="javascript:void(0);" onclick="change(this)" class="btn <?php echo $color; ?> radius"><i class="Hui-iconfont <?php echo $pd; ?>"><?php echo $opt; ?></i></a></td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; else: ?>
					<tr class="text-c va-m">
						<?php if(is_array($attr) || $attr instanceof \think\Collection || $attr instanceof \think\Paginator): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<td>
							<select name="attribute_id[]" class="select">
								<option value="">请选择</option>
								<?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
								<option value="<?php echo $vv['id']; ?>"><?php echo $vv['attribute_value']; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</td>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						<td><input type="text" class="input-text" name="number[]"></td>
						<td><a href="javascript:void(0);" onclick="change(this)" class="btn btn-primary radius"><i class="Hui-iconfont true">&#xe600;</i></a></td>
					</tr>
				<?php endif; ?>
					<tr id="btn" class="text-c">
						<td colspan="<?php echo $len+2; ?>">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button onclick="insert()" class="btn btn-primary radius" type="button"> 提交</button>
						</td>
					</tr>
				</tbody>
				</form>
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
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
	function change(obj){
		var tr = $(obj).parent().parent();
		if(tr.find("i").hasClass("true")){
			var newTr = tr.clone();
			// 把克隆出来的div里面的i标签变成-号
			newTr.find("i").first().removeClass("true");
			newTr.find("a").first().removeClass("btn-primary");
			newTr.find("a").first().addClass("btn-danger");
			newTr.find("i").first().html("&#xe6a1;");
			newTr.find("input").val('');
			$("#btn").before(newTr);
		}else
			tr.remove();
	}

	function insert(){
		var attr = [];
		$("select[name='attribute_id[]'] option:selected").each(function(){
			attr.push($(this).val());
		});
		var num = [];
		$("input[name='number[]']").each(function(){
			num.push($(this).val());
		})
		var data = {
			'id' : $("input[name='id']").val(),
			'attribute_id' : attr,
			'number' : num,
		};

		$.ajax({
			url : "<?php echo url('kucun'); ?>",
			data : data,
			dataType : 'json',
			type : 'post',
			success : function(info){
				if(info.code==1){
					layer.msg(info.msg,{icon:1,time:1000},function(){
						parent.location.reload();
					})
				}
			}
		})
	}
</script>


</body>
</html>