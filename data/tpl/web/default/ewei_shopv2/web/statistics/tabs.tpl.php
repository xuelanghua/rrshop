<?php defined('IN_IA') or exit('Access Denied');?><?php if(cv('statistics.sale|statistics.sale_analysis|statistics.order')) { ?>
<div class='menu-header'>销售统计</div>
<ul>
    <?php if(cv('statistics.sale')) { ?>
    	<li <?php  if($_W['action'] == 'statistics.sale') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('statistics/sale')?>">销售统计</a></li>
    <?php  } ?>
    <?php if(cv('statistics.sale_analysis')) { ?>
    	<li <?php  if($_W['action'] == 'statistics.sale_analysis') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('statistics/sale_analysis')?>">销售指标</a></li>
    <?php  } ?>
    <?php if(cv('statistics.order')) { ?>
    	<li <?php  if($_W['action'] == 'statistics.order') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('statistics/order')?>">订单统计</a></li>
    <?php  } ?>

</ul>
<?php  } ?>
<?php if(cv('statistics.goods|statistics.goods_rank|statistics.goods_trans')) { ?>
<div class='menu-header'>商品统计</div>
<ul>
     <?php if(cv('statistics.goods')) { ?>
     	<li <?php  if($_W['action'] == 'statistics.goods') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('statistics/goods')?>">销售明细</a></li>
     <?php  } ?>
    <?php if(cv('statistics.goods_rank')) { ?>
    	<li <?php  if($_W['action'] == 'statistics.goods_rank') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('statistics/goods_rank')?>">销售排行</a></li>
    <?php  } ?>
    <?php if(cv('statistics.goods_trans')) { ?>
    	<li <?php  if($_W['action'] == 'statistics.goods_trans') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('statistics/goods_trans')?>">销售转化率</a></li>
    <?php  } ?>
</ul>  
<?php  } ?>
<?php if(cv('statistics.member_cost|statistics.member_increase')) { ?>
<div class='menu-header'>会员统计</div>
<ul>
    <?php if(cv('statistics.member_cost')) { ?>
    	<li <?php  if($_W['action'] == 'statistics.member_cost.view') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('statistics/member_cost')?>"> 消费排行</a></li>
    <?php  } ?>
    <?php if(cv('statistics.member_increase')) { ?>
    	<li <?php  if($_W['action'] == 'statistics.member_increase.view') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('statistics/member_increase')?>">增长趋势</a></li>
    <?php  } ?>
</ul>
<?php  } ?>