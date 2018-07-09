<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"/www/web/miracle_51zuopin_com/public_html/../application/admin/view/goods/_index.html";i:1528869370;}*/ ?>
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