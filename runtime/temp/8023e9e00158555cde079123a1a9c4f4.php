<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/goods/edit.html";i:1528948772;s:62:"/www/web/miracle_51zuopin_com/application/admin/view/base.html";i:1528869354;}*/ ?>
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


<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
	<form class="form form-horizontal">
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>基本设置</span>
				<span>logo图片</span>
				<span>商品描述</span>
				<span>会员价格</span>
				<span>商品属性</span>
				<span>商品相册</span>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo $result['name']; ?>" name="name">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品特色：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo $result['feature']; ?>" name="feature">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品分类：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="cat_id" class="select">
							<option value="">请选择商品分类</option>
							<?php if(is_array($cat) || $cat instanceof \think\Collection || $cat instanceof \think\Paginator): $i = 0; $__LIST__ = $cat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $v['id']; ?>"
							<?php echo $v['id']==$result['cat_id']?'selected="selected"':''; ?>
							><?php echo str_repeat('&nbsp;&nbsp;',$v['level']); ?><?php echo $v['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span> </div>
				</div>
				<div class="row cl ext_cat">
					<label class="form-label col-xs-4 col-sm-2">
					<a href="javascript:void(0);" onclick="changeCat(this)" class="btn btn-primary radius"><i class="Hui-iconfont true">&#xe600;</i></a>
					扩展分类：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="ext_cat_id[]" class="select">
							<option value="">请选择商品分类</option>
							<?php if(is_array($cat) || $cat instanceof \think\Collection || $cat instanceof \think\Paginator): $i = 0; $__LIST__ = $cat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $v['id']; ?>"
							<?php echo $v['id']==$ext_cat[0]['cat_id']?'selected="selected"':''; ?>
							><?php echo str_repeat('&nbsp;&nbsp;',$v['level']); ?><?php echo $v['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span> </div>
				</div>
				<?php if(is_array($ext_cat) || $ext_cat instanceof \think\Collection || $ext_cat instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($ext_cat) ? array_slice($ext_cat,1,null, true) : $ext_cat->slice(1,null, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<div class="row cl ext_cat">
					<label class="form-label col-xs-4 col-sm-2">
					<a href="javascript:void(0);" onclick="changeCat(this)" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6a1;</i></a>
					扩展分类：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="ext_cat_id[]" class="select">
							<option value="">请选择商品分类</option>
							<?php if(is_array($cat) || $cat instanceof \think\Collection || $cat instanceof \think\Paginator): $i = 0; $__LIST__ = $cat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $v['id']; ?>"
							<?php echo $v['id']==$vo['cat_id']?'selected="selected"':''; ?>
							><?php echo str_repeat('&nbsp;&nbsp;',$v['level']); ?><?php echo $v['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span> </div>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品品牌：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="brand_id" class="select">
							<option value="">请选择商品品牌</option>
							<?php if(is_array($brand) || $brand instanceof \think\Collection || $brand instanceof \think\Paginator): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $v['id']; ?>"
							<?php echo $v['id']==$result['brand_id']?'selected="selected"':''; ?>
							><?php echo $v['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>市场价：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="supermarket_price" placeholder="0.00" class="input-text" value="<?php echo $result['supermarket_price']; ?>" style="width:90%">
						元</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>本店价：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="shop_price" placeholder="0.00" class="input-text" value="<?php echo $result['shop_price']; ?>" style="width:90%">
						元</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">赠送积分：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="credit" placeholder="不填，默认和商品价格相同" value="<?php echo $result['credit']==0?'' : $result['credit']; ?>" class="input-text">
						</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">兑换所需要的积分：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="credit_price" placeholder="不填，默认不能使用积分兑换" value="<?php echo $result['credit_price']==0?'' : $result['credit_price']; ?>" class="input-text">
						</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否包邮：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="is_freight" type="radio" value="1"
							<?php echo $result['is_freight']==1?'checked="checked"':''; ?>
							>
							<label>是</label>
						</div>
						<div class="radio-box">
							<input name="is_freight" type="radio" value="0"
							<?php echo $result['is_freight']==0?'checked="checked"':''; ?>
							>
							<label>否</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">邮费：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="freight_price" placeholder="0.00" value="<?php echo $result['is_freight']==0 && $result['freight_price'] != 0?$result['freight_price']:''; ?>" class="input-text freight" disabled style="width:90%">
						元</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否促销：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="is_promote" type="radio" value="0"
							<?php echo $result['is_promote']==0?'checked="checked"':''; ?>
							>
							<label>否</label>
						</div>
						<div class="radio-box">
							<input name="is_promote" type="radio" value="1"
							<?php echo $result['is_promote']==1?'checked="checked"':''; ?>
							>
							<label>是</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">促销价：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="promote_price" placeholder="0.00" value="<?php echo $result['is_promote']==1?$result['promote_price']:''; ?>" class="input-text promote" disabled style="width:90%">
						元</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">促销开始时间：</label>
					<div class="formControls col-xs-8 col-sm-9">
						
						<input type="text" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })"  id="datemin" name="promote_start_time" class="input-text Wdate promote" value="<?php echo $result['is_promote']==1?date('Y-m-d H:i:s',$result['promote_start_time']):''; ?>" style="width:180px;" disabled>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">促销结束时间：</label>
					<div class="formControls col-xs-8 col-sm-9">
						
						<input type="text" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'datemin\')}' })"  id="datemax" name="promote_end_time" class="input-text Wdate promote" value="<?php echo $result['is_promote']==1?date('Y-m-d H:i:s',$result['promote_end_time']):''; ?>" style="width:180px;" disabled>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否热销：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="is_hot" type="radio" value="0"
							<?php echo $result['is_hot']==0?'checked="checked"':''; ?>
							>
							<label>否</label>
						</div>
						<div class="radio-box">
							<input name="is_hot" type="radio" value="1"
							<?php echo $result['is_hot']==1?'checked="checked"':''; ?>
							>
							<label>是</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否新品：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="is_new" type="radio" value="0"
							<?php echo $result['is_new']==0?'checked="checked"':''; ?>
							>
							<label>否</label>
						</div>
						<div class="radio-box">
							<input name="is_new" type="radio" value="1"
							<?php echo $result['is_new']==1?'checked="checked"':''; ?>
							>
							<label>是</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否推荐：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="is_best" type="radio" value="0"
							<?php echo $result['is_best']==0?'checked="checked"':''; ?>
							>
							<label>否</label>
						</div>
						<div class="radio-box">
							<input name="is_best" type="radio" value="1"
							<?php echo $result['is_best']==1?'checked="checked"':''; ?>
							>
							<label>是</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否上架：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="is_sale" type="radio" value="1"
							<?php echo $result['is_sale']==1?'checked="checked"':''; ?>
							>
							<label>上架</label>
						</div>
						<div class="radio-box">
							<input name="is_sale" type="radio" value="0"
							<?php echo $result['is_sale']==0?'checked="checked"':''; ?>
							>
							<label>下架</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序字段：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo $result['sort']; ?>" name="sort">
					</div>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button onclick="nextSpan()" class="btn btn-primary radius" type="button"> 下一步</button>
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>添加水印：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="is_water" type="radio" value="0" checked>
							<label>文字水印</label>
						</div>
						<div class="radio-box">
							<input name="is_water" type="radio" value="1">
							<label>图片水印</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">水印位置(默认下居中)：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="location" class="select">
							<option value="">请选择水印位置</option>
							<option value="1">左上角</option>
							<option value="2">上居中</option>
							<option value="3">右上角</option>
							<option value="4">左居中</option>
							<option value="5">居中</option>
							<option value="6">右居中</option>
							<option value="7">左下角</option>
							<option value="8">下居中</option>
							<option value="9">右下角</option>
						</select>
						</span> </div>
				</div>
				<div class="row cl" id="water" style="display: none;">
					<label class="form-label col-xs-4 col-sm-2">水印图片：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="waterImg" class="select">
							<?php if(is_array($water_img) || $water_img instanceof \think\Collection || $water_img instanceof \think\Paginator): $i = 0; $__LIST__ = $water_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"></label>
					<div class="formControls col-xs-8 col-sm-9">
						<img width="100" class="product-thumb" src="<?php echo DS . 'upload' . DS . $result['sm_logo']; ?>" alt="">
					</div>
				</div>	
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>logo：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="btn-upload form-group">
						<input class="input-text upload-url" type="text" name="uploadfile" id="uploadfile" readonly nullmsg="请添加附件！" style="width:200px">
						<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 上传图片</a>
						<input type="file" multiple name="logo" class="input-file">
						</span> 
					</div>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button onclick="nextSpan()" class="btn btn-primary radius" type="button"> 下一步</button>
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品描述：</label>
					<div class="formControls col-xs-8 col-sm-9"> 
						<script id="editor" name="goods_desc" type="text/plain" style="width:100%;height:400px;"><?php echo $result['goods_desc']; ?></script> 
					</div>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button onclick="nextSpan()" class="btn btn-primary radius" type="button"> 下一步</button>
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="f-18 c-error">会员价格（如果没有填会员价格就按折扣率计算价格，如果填了就按填的价格算，不再打折）
				</div>
				<?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $k=>$v): ?>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><?php echo $v['name']; ?>(<?php echo $v['rate']; ?>)：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" name="member_price[<?php echo $v['id']; ?>][]" placeholder="0.00" value="<?php echo $v['id']==$member_price[$k]['level_id']?$member_price[$k]['level_price'] : ''; ?>" class="input-text" style="width:90%">
						元</div>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button onclick="nextSpan()" class="btn btn-primary radius" type="button"> 下一步</button>
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品类型：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="type_id" id="type" class="select">
							<option value="">请选择商品类型</option>
							<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $v['id']; ?>"
							<?php echo $v['id']==$result['type_id']?'selected="selected"':''; ?>
							><?php echo $v['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span> </div>
				</div>
				<?php $attr = []; ?>
				<div id="attr">
					<?php if(is_array($attr) || $attr instanceof \think\Collection || $attr instanceof \think\Paginator): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['values'] == ""): ?>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-2"><?php echo $v['name']; ?>：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" name="attr[<?php echo $v['id']; ?>][]">
						</div>
					</div>
					<?php else: ?>
					<div class="row cl attr<?php echo $v['id']; ?>">
						<label class="form-label col-xs-4 col-sm-2">
							<?php if($v['choice'] == 1): ?>
							<a href="javascript:void(0);" onclick="change(this,'<?php echo $v['id']; ?>')" class="btn btn-primary radius"><i class="Hui-iconfont true">&#xe600;</i></a>
							<?php endif; ?>
							<?php echo $v['name']; ?>：
						</label>
						<div class="formControls col-xs-8 col-sm-9"> 
							<span class="select-box" style="width:25%">
							<select name="attr[<?php echo $v['id']; ?>][]" class="select">
								<option value="">请选择</option>
								<?php if(is_array($v['values']) || $v['values'] instanceof \think\Collection || $v['values'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['values'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							</span> 
							<?php if($v['choice'] == 1): ?>
								<input type="text" name="attr_price[<?php echo $v['id']; ?>][]" placeholder="此属性比商品价多出的价格，不填或填0，默认与原价相同" value="" class="input-text" style="width:50%">元
							<?php endif; ?>
						</div>
					</div>
					<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button onclick="nextSpan()" class="btn btn-primary radius" type="button"> 下一步</button>
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>添加水印：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="water_method" type="radio" value="0" checked>
							<label>文字水印</label>
						</div>
						<div class="radio-box">
							<input name="water_method" type="radio" value="1">
							<label>图片水印</label>
						</div>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">水印位置(默认下居中)：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="water_location" class="select">
							<option value="">请选择水印位置</option>
							<option value="1">左上角</option>
							<option value="2">上居中</option>
							<option value="3">右上角</option>
							<option value="4">左居中</option>
							<option value="5">居中</option>
							<option value="6">右居中</option>
							<option value="7">左下角</option>
							<option value="8">下居中</option>
							<option value="9">右下角</option>
						</select>
						</span> </div>
				</div>
				<div class="row cl" id="water_img" style="display: none;">
					<label class="form-label col-xs-4 col-sm-2">水印图片：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="water_img" class="select">
							<?php if(is_array($water_img) || $water_img instanceof \think\Collection || $water_img instanceof \think\Paginator): $i = 0; $__LIST__ = $water_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span> </div>
				</div>
				<div class="row cl pic">
					<label class="form-label col-xs-4 col-sm-2">
					<a href="javascript:void(0);" onclick="changePic(this,'<?php echo $result['id']; ?>')" class="btn btn-primary radius"><i class="Hui-iconfont true">&#xe600;</i></a>
					<span class="c-red">*</span>图片相册：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="btn-upload form-group">
						<input class="input-text upload-url" type="text" name="uploadfile" id="uploadfile" readonly nullmsg="请添加附件！" style="width:200px">
						<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 上传图片</a>
						<input type="file" multiple name="picture[]" class="input-file">
						</span> 
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"></label>
					<div class="formControls col-xs-8 col-sm-9">
						<ul>
							<?php if(is_array($goods_pic) || $goods_pic instanceof \think\Collection || $goods_pic instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li style="float: left;margin-left: 10px;">
								<div class="row cl">
									<div class="formControls col-xs-8 col-sm-9">
										<a href="javascript:;" goods_id="<?php echo $result['id']; ?>" pic_id="<?php echo $v['id']; ?>" class="btn btn-danger radius delimage"><i class="Hui-iconfont">&#xe6e2;</i> 删除</a>
									</div>
								</div>
								<div class="row cl">
									<div class="formControls col-xs-8 col-sm-9">
										<img width="100" class="product-thumb" src="<?php echo $pic_before; ?><?php echo $v['sm_picture']; ?>" alt="">
									</div>
								</div>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<input type="hidden" name="id" value="<?php echo $result['id']; ?>">
						<input type="hidden" name="old_type_id" value="<?php echo $result['type_id']; ?>" />
						<button onclick="update()" class="btn btn-primary radius" type="button"> 提交</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
	if( $("input:radio[name='is_promote']:checked").val() == 1 ){
		$(".promote").removeAttr("disabled");
	}
	if( $("input:radio[name='is_freight']:checked").val() == 0 ){
		$(".freight").removeAttr("disabled");
	}

	var id = $("#type").val();
	var goods_id = $("input[name='id']").val();
	var data = {
		'id' : id,
		'goods_id' : goods_id,
	};
	$.ajax({
		url : '<?php echo url('editAttr'); ?>',
		type : 'post',
		dataType : 'json',
		data : data,
		success : function(info){
			if(info.code == 1){
				$("#attr").html(info.msg);
			}
		}
	});

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	$("#tab-system").Huitab({
		index:0
	});

	var ue = UE.getEditor('editor');
});

$("input:radio[name='is_promote']").on('ifChecked', function(event){
    if($(this).val() == 1){
    	$(".promote").removeAttr("disabled");
    }else{
    	$(".promote").attr("disabled","disabled");
    }
});

$("input:radio[name='is_freight']").on('ifChecked', function(event){
    if($(this).val() == 1){
    	$(".freight").attr("disabled","disabled");
    }else{
    	$(".freight").removeAttr("disabled");
    }
});

$("input:radio[name='is_water']").on('ifChecked', function(event){
    if($(this).val() == 1){
    	$("#water").css('display','');
    }else{
    	$("#water").css('display','none');
    }
});

$("input:radio[name='water_method']").on('ifChecked', function(event){
    if($(this).val() == 1){
    	$("#water_img").css('display','');
    }else{
    	$("#water_img").css('display','none');
    }
});

function nextSpan(){
	var num = $(".tabBar").find("span.current").index();

	$("#tab-system").Huitab({
		index : num + 1
	});
}

$("#type").change(function(){
	var id = $(this).val();

	$.ajax({
		url : '<?php echo url('showAttr'); ?>',
		type : 'post',
		dataType : 'json',
		data : {'id':id},
		success : function(info){
			if(info.code == 1){
				$("#attr").html(info.msg);
			}
		}
	});
})

function changeCat(obj){
	// 选中a标签所在的div标签
	var div = $(obj).parent().parent();
	// 先获取i标签中的class名
	if($(obj).find("i").hasClass("true"))
	{
		// 把div克隆一份
		var newDiv = div.clone();
		// 把克隆出来的div里面的i标签变成-号
		newDiv.find("i").first().removeClass("true");
		newDiv.find("a").first().removeClass("btn-primary");
		newDiv.find("a").first().addClass("btn-danger");
		newDiv.find("i").first().html("&#xe6a1;");
		// 放在后面
		$(".ext_cat").last().after(newDiv);
	}
	else
		div.remove();
}

function changePic(obj,id){
	$.ajax({
		url : '<?php echo url('checknum'); ?>',
		type : 'post',
		dataType : 'json',
		data : {'id':id},
		async : false,
		success : function(info){
			len = info.len;
		}
	});
	// 选中a标签所在的div标签
	var div = $(obj).parent().parent();
	// 先获取i标签中的class名
	if($(obj).find("i").hasClass("true"))
	{
		len = len + $(".pic").length;
		if( len > 4 ){
			layer.msg('最多只能添加五张图片',{icon:2,time:1000});
			return;
		}
		// 把div克隆一份
		var newDiv = div.clone();
		// 把克隆出来的div里面的i标签变成-号
		newDiv.find("i").first().removeClass("true");
		newDiv.find("a").first().removeClass("btn-primary");
		newDiv.find("a").first().addClass("btn-danger");
		newDiv.find("i").first().html("&#xe6a1;");
		newDiv.find("input").val('');
		// 放在后面
		$(".pic").last().after(newDiv);
	}
	else
		div.remove();
}

/*增加减少*/
function change(obj,id,aid){
	// 选中a标签所在的div标签
	var div = $(obj).parent().parent();
	// 先获取i标签中的class名
	if($(obj).find("i").hasClass("true"))
	{
		// 把div克隆一份
		var newDiv = div.clone();
		// 修改name名称
		newDiv.find("select").attr("name","new_attr["+id+"][]");
		newDiv.find("input").attr("name","new_attr_price["+id+"][]");
		newDiv.find("a").attr("onclick","change(this,"+id+",0)");
		// 把克隆出来的div里面的i标签变成-号
		newDiv.find("i").first().removeClass("true");
		newDiv.find("a").first().removeClass("btn-primary");
		newDiv.find("a").first().addClass("btn-danger");
		newDiv.find("i").first().html("&#xe6a1;");
		newDiv.find("input").val('');
		// 放在后面
		$(".attr"+id).last().after(newDiv);
	}
	else{
		layer.confirm('确认要删除吗？',function(index){
			$.ajax({
				url : '<?php echo url('delAttr'); ?>',
				type : 'post',
				dataType : 'json',
				data : {'id':aid},
				async : false,
				success : function(info){
					if(info.code==1){
						layer.msg(info.msg,{icon:1,time:1000},function(){
							div.remove();
						})
					}else{
						layer.msg(info.msg,{icon:2,time:1000})
					}
				}
			})
		});
	}
}

$(".delimage").click(function(){
	var id = $(this).attr('goods_id');
	var pic_id = $(this).attr('pic_id');
	var data = {
		'id' : id,
		'pic_id' : pic_id,
	}
	var obj = $(this);
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			url : '<?php echo url('delImg'); ?>',
			type : 'post',
			dataType : 'json',
			data : data,
			async : false,
			success : function(info){
				if(info.code==1){
					layer.msg(info.msg,{icon:1,time:1000},function(){
						$(obj).parent().parent().parent().remove();
					})
				}else{
					layer.msg(info.msg,{icon:2,time:1000})
				}
			}
		})
	});
});

function update(){
	var data = new FormData($('form')[0]);

	$.ajax({
		url : '<?php echo url('update'); ?>',
		data : data,
		dataType : 'json',
		type : 'post',
		processData: false,  // 告诉jQuery不要去处理发送的数据
		contentType: false,   // 告诉jQuery不要去设置Content-Type请求头
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
</script>


</body>
</html>