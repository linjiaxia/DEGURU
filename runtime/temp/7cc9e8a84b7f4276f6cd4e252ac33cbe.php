<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"/www/web/miracle_51zuopin_com/public_html/../application/index/view/goods/_index.html";i:1528869384;}*/ ?>
<?php if(is_array($goodsData) || $goodsData instanceof \think\Collection || $goodsData instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
	<li>
		<a href="<?php echo url('@detail/'.$v['id']); ?>"><img src="<?php echo DS . 'upload' . DS . $v['logo']; ?>" alt="<?php echo $v['name']; ?>"  style="width: 293px;height: 309px;"/></a>
		<h6><a href="<?php echo url('@detail/'.$v['id']); ?>"><?php echo $v['name']; ?></a></h6>
		<span class="price">¥<i><?php echo $v['shop_price']; ?></i></span>
		<p>
			<span class="quantity">销售量 199</span>
			<span class="stock"><?php echo empty($v['number']) ? '暂无库存' : '库存 ' . $v['number'] . '件'; ?></span>
		</p>
	</li>
<?php endforeach; endif; else: echo "" ;endif; ?>