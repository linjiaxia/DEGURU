<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/goods/_attr.html";i:1528869370;}*/ ?>
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