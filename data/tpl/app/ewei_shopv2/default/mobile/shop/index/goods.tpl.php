<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($indexrecommands)) { ?>
	<div class="fui-line" style="background: #f4f4f4;">
		<div class="text text-danger"><i class="icon icon-likefill"></i> 为您推荐</div>
	</div>
	<div class="fui-goods-group <?php  if(empty($goodsstyle)) { ?> block<?php  } ?> border">
		<?php  if(is_array($indexrecommands)) { foreach($indexrecommands as $item) { ?>
			<div class="fui-goods-item" data-goodsid="<?php  echo $item['id'];?>" data-type="<?php  echo $item['type'];?>">
				<a href="<?php  echo mobileUrl('goods/detail', array('id'=>$item['id']))?><?php  if(!empty($frommyshop)) { ?>&frommyshop=1<?php  } ?>" data-nocache='true'>
					<div class="image" data-lazy-background="<?php  echo tomedia($item['thumb'])?>">
						<?php  if($item['total']<=0) { ?><div class="salez" style="background-image: url('<?php  echo tomedia($_W['shopset']['shop']['saleout'])?>'); "></div><?php  } ?>
					</div>
				</a>
				<div class="detail">
					<a href="<?php  echo mobileUrl('goods/detail', array('id'=>$item['id']))?>">
						<div class="name">
							<?php  if($item['ispresell']==1) { ?><i class="fui-tag fui-tag-danger">预售</i><?php  } ?>
							<?php  echo $item['title'];?>
						</div>
					</a>
					<div class="price">
						<span class="text">￥<?php  echo $item['minprice'];?>
						</span>
						<span class="buy">
							<i class="icon icon-cart"></i>
						</span>
					</div>
				</div>
			</div>
		<?php  } } ?>
	</div>
<?php  } ?>