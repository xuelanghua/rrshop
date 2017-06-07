<?php defined('IN_IA') or exit('Access Denied');?><?php if(cv('sysset.shop|system.follow|sysset.close')) { ?>
<div class='menu-header'>商城</div>
<ul>
    <?php if(cv('sysset.shop')) { ?><li <?php  if($_W['routes']=='sysset.shop' ||$_W['routes']=='sysset') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/shop')?>">基础设置</a></li><?php  } ?>
    <?php if(cv('sysset.follow')) { ?><li  <?php  if($_W['routes']=='sysset.follow') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/follow')?>">关注及分享</a></li><?php  } ?>
    <?php if(cv('sysset.close')) { ?><li <?php  if($_W['routes']=='sysset.close') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/close')?>">商城状态</a></li><?php  } ?>
    <?php if(cv('sysset.templat')) { ?><li <?php  if($_W['routes']=='sysset.templat') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/templat')?>">模板设置</a></li><?php  } ?>
    <?php  if(com('sms') && com('wap')) { ?>
        <?php if(cv('sysset.wap')) { ?><li <?php  if($_W['routes']=='sysset.wap') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/wap')?>">全网通设置</a></li><?php  } ?>
    <?php  } ?>
</ul>
<?php  } ?>

<?php if(cv('sysset.notice|sysset.tmessage')) { ?>
<div class='menu-header'>交易</div>
<ul>
    <?php if(cv('sysset.trade')) { ?><li  <?php  if($_W['routes']=='sysset.trade') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/trade')?>">交易设置</a></li><?php  } ?>
    <?php if(cv('sysset.payset')) { ?><li  <?php  if($_W['routes']=='sysset.payset') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/payset')?>">支付方式</a></li><?php  } ?>
</ul>
<?php  } ?>


<?php if(cv('sysset.notice|sysset.tmessage|sysset.sms.temp')) { ?>
<div class='menu-header'>消息推送</div>
<ul>
    <?php if(cv('sysset.notice')) { ?><li  <?php  if($_W['routes']=='sysset.notice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/notice')?>">消息提醒</a></li><?php  } ?>
    <?php if(cv('sysset.tmessage')) { ?><li <?php  if($_W['routes']=='sysset.tmessage') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/tmessage')?>">自定义消息库</a></li><?php  } ?>
    <?php if(cv('sysset.tmessage')) { ?><li><a href="<?php  echo webUrl('sysset/weixintemplate')?>">模板消息管理</a></li><?php  } ?>
    <?php  if(com('sms')) { ?>
    <?php if(cv('sysset.sms.temp')) { ?>
    <li <?php  if($_W['routes']=='sysset.sms.temp') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/sms/temp')?>">短信消息库</a></li>
    <?php  } ?>
    <?php  } ?>
</ul>
<?php  } ?>

<?php  if(com('sms')) { ?>
<?php if(cv('sysset.sms.set|sysset.sms.temp')) { ?>
<div class='menu-header'>短信配置</div>
<ul>
    <?php if(cv('sysset.sms.set')) { ?>
    <li  <?php  if($_W['routes']=='sysset.sms.set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/sms/set')?>">短信接口设置</a></li>
    <?php  } ?>
</ul>
<?php  } ?>
<?php  } ?>

<?php  if(com('printer')) { ?>
<?php if(cv('sysset.printer')) { ?>
<div class='menu-header'>小票打印机</div>
<li <?php  if($_W['routes']=='sysset.printer.printer_list') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/printer/printer_list')?>">打印机管理</a></li>
<li <?php  if($_W['routes']=='sysset.printer') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/printer')?>">打印机模板库</a></li>
<li <?php  if($_W['routes']=='sysset.printer.set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/printer/set')?>">打印设置</a></li>
<?php  } ?>
<?php  } ?>


<?php if(cv('sysset.member|sysset.category|sysset.contact')) { ?>
<div class='menu-header'>其他</div>
<ul>
    <?php if(cv('sysset.member')) { ?><li  <?php  if($_W['routes']=='sysset.member') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/member')?>">会员设置</a></li><?php  } ?>
    <?php if(cv('sysset.category')) { ?><li  <?php  if($_W['routes']=='sysset.category') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/category')?>">分类层级</a></li><?php  } ?>
    <?php if(cv('sysset.contact')) { ?><li  <?php  if($_W['routes']=='sysset.contact') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/contact')?>">联系方式</a></li><?php  } ?>
    <?php if(cv('sysset.area')) { ?><li  <?php  if($_W['routes']=='sysset.area') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/area')?>">地址库设置</a></li><?php  } ?>
    <?php if(cv('sysset.express')) { ?><li  <?php  if($_W['routes']=='sysset.express') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/express')?>">物流信息接口</a></li><?php  } ?>
</ul>
<?php  } ?>

<?php if(cv('sysset.qiniu|goods.edit|sysset.sms.set')) { ?>
<div class='menu-header'>工具</div>
<ul>
    <?php  if(com('qiniu')) { ?>
    <?php if(cv('sysset.qiniu')) { ?><li  <?php  if($_W['routes']=='sysset.qiniu') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/qiniu')?>">七牛存储</a></li><?php  } ?>
    <?php  } ?>
    <?php if(cv('goods.edit')) { ?><li  <?php  if($_W['routes']=='sysset.goodsprice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/goodsprice')?>">商品价格修复</a></li><?php  } ?>
</ul>
<?php  } ?>



<?php if(cv('sysset.cover.shop|sysset.cover.member|sysset.cover.order|sysset.cover.favorite|sysset.cover.cart|sysset.cover.coupon')) { ?>
<div class='menu-header'>入口</div>
<ul>
    <?php if(cv('sysset.cover.shop')) { ?><li <?php  if($_W['routes']=='sysset.cover.shop') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/cover/shop')?>">商城入口</a></li><?php  } ?>
    <?php if(cv('sysset.cover.member')) { ?><li  <?php  if($_W['routes']=='sysset.cover.member') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/cover/member')?>">会员中心入口</a></li><?php  } ?>
    <?php if(cv('sysset.cover.order')) { ?><li  <?php  if($_W['routes']=='sysset.cover.order') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/cover/order')?>">订单入口</a></li><?php  } ?>
    <?php if(cv('sysset.cover.favorite')) { ?><li  <?php  if($_W['routes']=='sysset.cover.favorite') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/cover/favorite')?>">收藏入口</a></li><?php  } ?>
    <?php if(cv('sysset.cover.cart')) { ?><li  <?php  if($_W['routes']=='sysset.cover.cart') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/cover/cart')?>">购物车入口</a></li><?php  } ?>
    <?php if(cv('sysset.cover.coupon')) { ?><li  <?php  if($_W['routes']=='sysset.cover.coupon') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sysset/cover/coupon')?>">优惠券入口</a></li><?php  } ?>
</ul>
<?php  } ?>