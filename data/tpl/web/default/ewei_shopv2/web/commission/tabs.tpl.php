<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'><?php  echo $this->plugintitle?></div>
<ul>
    <?php if(cv('commission.agent')) { ?><li <?php  if($_W['routes']=='commission.agent') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/agent')?>">分销商管理</a></li><?php  } ?>
    <?php if(cv('commission.increase')) { ?><li  <?php  if($_W['routes']=='commission.increase') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/increase')?>">分销商增长趋势统计</a></li><?php  } ?>
    <?php if(cv('commission.level')) { ?><li <?php  if($_W['routes']=='commission.level') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/level')?>">分销商等级</a></li><?php  } ?>
    <?php if(cv('commission.agent')) { ?><li <?php  if($_W['routes']=='commission.statistics.order') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/statistics/order')?>">分销订单</a></li><?php  } ?>
    <?php if(cv('commission.agent')) { ?><li <?php  if($_W['routes']=='commission.statistics.agent') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/statistics/agent')?>">分销商统计</a></li><?php  } ?>
    <?php if(cv('commission.agent')) { ?><li <?php  if($_W['routes']=='commission.statistics.user') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/statistics/user')?>">分销关系</a></li><?php  } ?>

    

</ul>
<style type='text/css'>
	.commission-list a {
		position: relative;
	}
	.commission-list span  {
	 
	float:right;margin-right:20px;
	}
</style>

<?php  $totals = p('commission')->getTotals()?>
<div class='menu-header'>提现申请</div>
<ul class='commission-list'>
    <?php if(cv('commission.apply.view1')) { ?><li <?php  if($_W['routes']=='commission.apply' && $_GPC['status']==1) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/apply',array('status'=>1))?>">待审核的<span  class='text-danger'><?php  echo $totals['total1'];?></span></a></li><?php  } ?>
    <?php if(cv('commission.apply.view2')) { ?><li <?php  if($_W['routes']=='commission.apply' && $_GPC['status']==2) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/apply',array('status'=>2))?>">待打款的<span><?php  echo $totals['total2'];?></span></a></li><?php  } ?>
    <?php if(cv('commission.apply.view3')) { ?><li <?php  if($_W['routes']=='commission.apply' && $_GPC['status']==3) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/apply',array('status'=>3))?>">已打款的<span  class='text-success'><?php  echo $totals['total3'];?></span></a></li><?php  } ?>
    <?php if(cv('commission.apply.view_1')) { ?><li <?php  if($_W['routes']=='commission.apply' && $_GPC['status']==-1) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/apply',array('status'=>-1))?>">无效的<span class='text-default'><?php  echo $totals['total_1'];?></span></a></li><?php  } ?>
    
</ul>
<div class="menu-header">设置</div>

<ul>
   <?php if(cv('commission.notice')) { ?><li  <?php  if($_W['routes']=='commission.rank') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/rank')?>">排行榜设置</a></li><?php  } ?>
   <?php if(cv('commission.notice')) { ?><li  <?php  if($_W['routes']=='commission.notice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/notice')?>">通知设置</a></li><?php  } ?>
    <?php if(cv('commission.cover')) { ?><li <?php  if($_W['routes']=='commission.cover') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/cover')?>">入口设置</a></li><?php  } ?>
   <?php if(cv('commission.set')) { ?><li <?php  if($_W['routes']=='commission.set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('commission/set')?>">基础设置</a></li><?php  } ?>
	
</ul>