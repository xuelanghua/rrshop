<?php defined('IN_IA') or exit('Access Denied');?><div class="fui-navbar">

    <a href="<?php  if(empty($_GPC['merchid'])) { ?><?php  echo mobileUrl()?><?php  } else { ?><?php  echo mobileUrl('merch')?><?php  } ?>" class="external nav-item">
        <span class="icon icon-home"></span>
        <span class="label">首页</span>
    </a>
    <?php  if(intval($_W['shopset']['category']['level'])!=-1) { ?>
    <a href="<?php  echo mobileUrl('shop/category')?>" class="external nav-item <?php  if($_W['routes']=='shop.category') { ?>active<?php  } ?>" >
        <span class="icon icon-list"></span>
        <span class="label">全部分类</span>
    </a>
    <?php  } else { ?>
    <a href="<?php  echo mobileUrl('goods')?>" class="external nav-item <?php  if($_W['routes']=='goods') { ?>active<?php  } ?>" >
        <span class="icon icon-list"></span>
        <span class="label">全部商品</span>
    </a>
    <?php  } ?>

    <a href="<?php  echo mobileUrl('member/cart')?>" class="external nav-item <?php  if($_W['routes']=='member.cart') { ?>active<?php  } ?>" id="menucart">
        <span class="icon icon-cart"></span>
        <span class="label">购物车</span>
        <?php  if($cartcount>0) { ?><span class="badge"><?php  echo $cartcount;?></span><?php  } ?>
    </a>
    <a href="<?php  echo mobileUrl('member')?>" class="external nav-item  <?php  if($_W['routes']=='member') { ?>active<?php  } ?>">
        <span class="icon icon-person2"></span>
        <span class="label">会员中心</span>
    </a>

    <a href="<?php  echo mobileUrl('', array('merchid' => -1))?>" class="external nav-item">
        <span class="icon icon-back"></span>
        <span class="label">返回商城</span>
    </a>
</div>
