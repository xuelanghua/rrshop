<?php defined('IN_IA') or exit('Access Denied');?><?php  if($type=='good') { ?>
	<?php  if(empty($list)) { ?>
		<div class="tip">抱歉！未查询到<?php  if(!empty($kw)) { ?>与“<?php  echo $kw;?>”<?php  } ?>相关的商品，请更换关键字后重试。</div>
	<?php  } else { ?>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<div class="line good">
				<div class="image"><img src="<?php  echo tomedia($item['thumb'])?>"/></div>
				<nav title="选择" class="btn btn-default btn-sm" data-href="<?php  if($platform=='wxapp') { ?>/pages/goods/detail/index?id=<?php  echo $item['id'];?><?php  } else { ?><?php  echo mobileUrl('goods/detail', array('id'=>$item['id']), $full)?><?php  } ?>">选择</nav>
				<div class="text">
					<p class="name"><?php  echo $item['title'];?></p>
					<p class="price">最低价: <?php  echo $item['minprice'];?> 原价: <?php  echo $item['productprice'];?>元 现价: <?php  echo $item['marketprice'];?>元</p>
				</div>
			</div>
		<?php  } } ?>
	<?php  } ?>
<?php  } else if($type=='article') { ?>
	<?php  if(empty($list)) { ?>
		<div class="tip">抱歉！未查询到<?php  if(!empty($kw)) { ?>与“<?php  echo $kw;?>”<?php  } ?>相关的文章，请更换关键字后重试。</div>
	<?php  } else { ?>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<div class="line">
				<div class="icon icon-1"></div>
				<nav data-href="<?php  echo mobileUrl('article', array('aid'=>$item['id']), $full)?>" class="btn btn-default btn-sm" title="选择">选择</nav>
				<div class="text"><?php  echo $item['article_title'];?></div>
			</div>
		<?php  } } ?>
	<?php  } ?>
<?php  } else if($type=='coupon') { ?>
	<?php  if(empty($list)) { ?>
		<div class="tip">抱歉！未查询到<?php  if(!empty($kw)) { ?>与“<?php  echo $kw;?>”<?php  } ?>相关的优惠券，请更换关键字后重试。</div>
	<?php  } else { ?>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<div class="line">
				<div class="icon icon-1"></div>
				<nav data-href="<?php  echo mobileUrl('sale/coupon/detail', array('id'=>$item['id']), $full)?>" class="btn btn-default btn-sm" title="选择">选择</nav>
				<div class="text"><?php  echo $item['couponname'];?></div>
			</div>
		<?php  } } ?>
	<?php  } ?>

<?php  } else if($type=='groups') { ?>
	<?php  if(empty($list)) { ?>
		<div class="tip">抱歉！未查询到<?php  if(!empty($kw)) { ?>与“<?php  echo $kw;?>”<?php  } ?>相关的商品，请更换关键字后重试。</div>
	<?php  } else { ?>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
		<div class="line">
			<div class="icon icon-1"></div>
			<nav data-href="<?php  echo mobileUrl('groups/goods', array('id'=>$item['id']), $full)?>" class="btn btn-default btn-sm" title="选择">选择</nav>
			<div class="text"><?php  echo $item['title'];?></div>
		</div>
		<?php  } } ?>
	<?php  } ?>

<?php  } else if($type=='sns') { ?>
	<?php  if(empty($list)) { ?>
		<div class="tip">抱歉！未查询到<?php  if(!empty($kw)) { ?>与“<?php  echo $kw;?>”<?php  } ?>相关的板块或帖子，请更换关键字后重试。</div>
	<?php  } else { ?>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
		<div class="line">
			<div class="icon icon-1"></div>
			<nav data-href="<?php  echo $item['url'];?>" class="btn btn-default btn-sm" title="选择">选择</nav>
			<div class="text"><span class="label label-sm <?php  if(empty($item['type'])) { ?>label-success<?php  } else { ?>label-default<?php  } ?>"><?php  if(empty($item['type'])) { ?>板块<?php  } else { ?>帖子<?php  } ?></span> <?php  echo $item['title'];?></div>
		</div>
		<?php  } } ?>
	<?php  } ?>

<?php  } else if($type=='creditshop') { ?>
	<?php  if(empty($list)) { ?>
	<div class="tip">抱歉！未查询到<?php  if(!empty($kw)) { ?>与“<?php  echo $kw;?>”<?php  } ?>相关的商品，请更换关键字后重试。</div>
	<?php  } else { ?>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
		<div class="line good">
			<div class="image"><img src="<?php  echo tomedia($item['thumb'])?>"/></div>
			<nav title="选择" class="btn btn-default btn-sm" data-href="<?php  echo mobileUrl('creditshop/detail', array('id'=>$item['id']), $full)?>">选择</nav>
			<div class="text">
				<p class="name"><?php  echo $item['title'];?></p>
				<p class="price">最低价: <?php  echo $item['minprice'];?> 原价: <?php  echo $item['price'];?>元 现价: <?php  echo $item['credit'];?>积分+<?php  echo $item['money'];?>元</p>
			</div>
		</div>
		<?php  } } ?>
	<?php  } ?>
<?php  } else { ?>
	<div class="tip">抱歉！未查询到相关内容。</div>
<?php  } ?>
