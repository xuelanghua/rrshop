<?php defined('IN_IA') or exit('Access Denied');?><?php if(cv('finance.log.recharge|finance.log.withdraw|finance.downloadbill')) { ?>
<div class='menu-header'>财务</div>
<ul>
    <?php if(cv('finance.log.recharge')) { ?><li <?php  if($_W['routes']=='finance.log.recharge') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('finance/log/recharge')?>">充值记录</a></li><?php  } ?>
    <?php if(cv('finance.log.withdraw')) { ?><li <?php  if($_W['routes']=='finance.log.withdraw') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('finance/log/withdraw')?>">提现申请</a></li><?php  } ?>
    <?php if(cv('finance.downloadbill')) { ?><li <?php  if($_W['routes'] == 'finance.downloadbill' ) { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('finance/downloadbill')?>">下载对账单</a></li><?php  } ?>
</ul>
<?php  } ?>


<?php if(cv('finance.credit.credit1|finance.credit.credit2')) { ?>
<div class='menu-header'>明细</div>
<ul>
    <?php if(cv('finance.credit.credit1')) { ?><li <?php  if($_W['routes']=='finance.credit.credit1') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('finance/credit/credit1')?>">积分明细</a></li><?php  } ?>
    <?php if(cv('finance.credit.credit2')) { ?><li <?php  if($_W['routes']=='finance.credit.credit2') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('finance/credit/credit2')?>">余额明细</a></li><?php  } ?>
</ul>
<?php  } ?>