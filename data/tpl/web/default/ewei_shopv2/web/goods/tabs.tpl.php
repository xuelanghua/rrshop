<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
	.goods-list a {
		position: relative; 
	}
	.goods-list span  {
	float:right;margin-right:20px;
	 
	}
</style>

<?php  $totals = m('goods')->getTotals()?>
<?php if(cv('goods')) { ?>
<div class='menu-header'>商品管理</div>
<ul class='goods-list'>
    <li <?php  if($_GPC['goodsfrom'] == 'sale') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('goods',array('goodsfrom'=>'sale'))?>">出售中<span><?php  echo $totals['sale'];?></span></a></li>
     <li <?php  if($_GPC['goodsfrom'] == 'out') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('goods',array('goodsfrom'=>'out'))?>">已售罄<span  class='text-danger'><?php  echo $totals['out'];?></span></a></li>
    <li <?php  if($_GPC['goodsfrom'] == 'stock') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('goods',array('goodsfrom'=>'stock'))?>">仓库中<span><?php  echo $totals['stock'];?></span></a></li>
    <li <?php  if($_GPC['goodsfrom'] == 'cycle') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('goods',array('goodsfrom'=>'cycle'))?>">回收站<span  class='text-default'><?php  echo $totals['cycle'];?></span></a></li>
     <?php if(cv('goods.category')) { ?><li <?php  if($_W['action'] == 'goods.category') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('goods/category')?>">商品分类</a></li><?php  } ?>
    <?php if(cv('goods.group')) { ?><li <?php  if($_GPC['r'] == 'goods.group' || $_GPC['r'] == 'goods.group.edit') { ?>class="active" <?php  } ?>><a href="<?php  echo webUrl('goods/group')?>">商品组</a></li><?php  } ?>
    <li <?php  if($_W['action'] == 'goods.label') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('goods/label')?>">标签管理</a></li>
</ul>
<?php  } ?>


<?php  if(com('virtual')) { ?>
<?php if(cv('goods.virtual.temp|goods.virtual.category|goods.virtual.data')) { ?>
<div class='menu-header'>虚拟卡密</div>
<ul>
    <?php if(cv('goods.virtual.temp')) { ?><li <?php  if($_W['action'] == 'goods.virtual.temp' ||$_W['action'] == 'goods.virtual.data') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('goods/virtual/temp')?>">虚拟卡密</a></li><?php  } ?>
    <?php if(cv('goods.virtual.category')) { ?><li <?php  if($_W['action'] == 'goods.virtual.category') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('goods/virtual/category')?>">卡密分类</a></li>	<?php  } ?>
</ul>
<?php  } ?>
<?php  } ?>

  