<?php defined('IN_IA') or exit('Access Denied');?><?php  if(com("sale")) { ?>
<?php if(cv('sale.deduct|sale.enough|sale.enoughfree|sale.recharge')) { ?>
<div class='menu-header'>基本</div>
<ul>

   <?php if(cv('sale.enough')) { ?><li <?php  if($_W['routes']=='sale.enough') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/enough')?>">满额立减</a></li><?php  } ?>
   <?php if(cv('sale.enoughfree')) { ?><li <?php  if($_W['routes']=='sale.enoughfree') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/enoughfree')?>">满额包邮</a></li><?php  } ?>
    <?php  if(function_exists('redis') && !is_error(redis())) { ?>
        <?php if(cv('sale.deduct')) { ?><li <?php  if($_W['routes']=='sale.deduct' || $_W['action']=='sale') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/deduct')?>">抵扣设置</a></li><?php  } ?>
    <?php  } ?>
   <?php if(cv('sale.recharge')) { ?><li <?php  if($_W['routes']=='sale.recharge') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/recharge')?>">充值优惠</a></li><?php  } ?>
    <?php if(cv('sale.credit1')) { ?><li <?php  if($_W['routes']=='sale.credit1') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/credit1')?>">积分优惠</a></li><?php  } ?>
    <?php if(cv('sale.package')) { ?><li <?php  if($_W['routes']=='sale.package') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/package')?>">套餐管理</a></li><?php  } ?>
    <?php if(cv('sale.gift')) { ?><li <?php  if($_W['routes']=='sale.gift') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/gift')?>">赠品管理</a></li><?php  } ?>
    <?php if(cv('sale.fullback')) { ?><li <?php  if($_W['routes']=='sale.fullback') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/fullback')?>">全返管理</a></li><?php  } ?>
    <li <?php  if($_W['routes']=='sale.peerpay') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/peerpay')?>">找人代付</a></li>
 </ul>
<?php  } ?>
<?php  } ?>

<?php  if(com("coupon")) { ?>
<?php if(cv('sale.coupon.view|sale.coupon.category|sale.coupon.log|sale.coupon.set')) { ?>
  <div class='menu-header'>优惠券</div>
  <ul>
   <?php if(cv('sale.coupon.view')) { ?><li <?php  if($_W['routes']=='sale.coupon') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/coupon')?>">优惠券管理</a></li><?php  } ?>

    <?php if(cv('sale.coupon.send')) { ?>
    <li <?php  if($_W['routes']=='sale.coupon.send') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/coupon/sendcoupon')?>">手动发送</a></li>
    <?php  } ?>
    <?php if(cv('sale.coupon')) { ?><li><a href="<?php  echo webUrl('sale/coupon/sendtask')?>">购物送券</a></li><?php  } ?>
    <?php if(cv('sale.coupon.log')) { ?><li <?php  if($_W['routes']=='sale.coupon.log') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/coupon/log')?>">发放记录</a></li><?php  } ?>
   <?php if(cv('sale.coupon.category')) { ?><li <?php  if($_W['routes']=='sale.coupon.category') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/coupon/category')?>">分类</a></li><?php  } ?>
   <?php if(cv('sale.coupon.set')) { ?><li <?php  if($_W['routes']=='sale.coupon.set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/coupon/set')?>">设置</a></li><?php  } ?>
</ul>
<?php  } ?>
<?php  } ?>


<?php  if(com("wxcard")) { ?>
    <?php if(cv('sale.wxcard.view|sale.wxcard.log|sale.wxcard.set')) { ?>
    <div class='menu-header'>微信卡券</div>
    <ul>
        <?php if(cv('sale.wxcard.view')) { ?><li <?php  if($_W['routes']=='sale.wxcard') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/wxcard')?>">微信卡券管理</a></li><?php  } ?>
        <?php if(cv('sale.wxcard.set')) { ?><!--<li <?php  if($_W['routes']=='sale.wxcard.set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/wxcard/set')?>">设置</a></li>--><?php  } ?>
    </ul>
    <?php  } ?>
<?php  } ?>

<div class='menu-header'>工具 </div>
<ul>
    <?php if(cv('sale.virtual')) { ?><li <?php  if($_W['routes']=='sale.virtual') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sale/virtual')?>">关注回复</a></li><?php  } ?>
</ul>