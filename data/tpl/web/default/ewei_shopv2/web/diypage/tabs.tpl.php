<?php defined('IN_IA') or exit('Access Denied');?><ul class="menu-head-top">
	<li <?php  if($_GPC['r']=='diypage') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage')?>"><?php  echo m('plugin')->getName('diypage')?> <i class="fa fa-caret-right"></i></a></li>
</ul>


<?php if(cv('diypage.page.sys|diypage.page.diy')) { ?>
<div class='menu-header'>页面管理</div>
<ul>
	<?php if(cv('diypage.page.sys')) { ?>
	<li <?php  if($_GPC['r']=='diypage.page.sys'||$_GPC['r']=='diypage.page.sys.edit'||$_GPC['r']=='diypage.page.sys.add') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/page/sys')?>" style="cursor: pointer;">系统页面</a></li>
	<?php  } ?>

	<?php  if($_W['plugin']!='merch') { ?>
	<?php if(cv('diypage.page.plu')) { ?>
	<li <?php  if($_GPC['r']=='diypage.page.plu'||$_GPC['r']=='diypage.page.plu.edit'||$_GPC['r']=='diypage.page.plu.add') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/page/plu')?>" style="cursor: pointer;">应用页面</a></li>
	<?php  } ?>
	<?php  } ?>

	<?php if(cv('diypage.page.diy')) { ?>
	<li <?php  if($_GPC['r']=='diypage.page.diy'||$_GPC['r']=='diypage.page.diy.edit'||$_GPC['r']=='diypage.page.diy.add') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/page/diy')?>" style="cursor: pointer;">自定义页面</a></li>
	<?php  } ?>

	<?php if(cv('diypage.page.sys.add|diypage.page.diy.add')) { ?>
	<li <?php  if($_GPC['r']=='diypage.page.create') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/page/create')?>" style="cursor: pointer;">新建页面</a></li>
	<?php  } ?>
</ul>

<?php  } ?>
<?php if(cv('diypage.page.mod')) { ?>
<div class='menu-header'>公用模块</div>
<ul>
	<?php if(cv('diypage.page.mod')) { ?>
	<li <?php  if($_GPC['r']=='diypage.page.mod' || $_GPC['r']=='diypage.page.mod.edit') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/page/mod')?>" style="cursor: pointer;">模块管理</a></li>
	<?php  } ?>
	<?php if(cv('diypage.page.mod.add')) { ?>
	<li <?php  if($_GPC['r']=='diypage.page.mod.add') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/page/mod/add')?>" style="cursor: pointer;">新建模块</a></li>
	<?php  } ?>
</ul>
<?php  } ?>


<?php if(cv('diypage.menu')) { ?>
<div class='menu-header'>自定义菜单</div>
<ul>
	<?php if(cv('diypage.menu')) { ?>
	<li <?php  if($_GPC['r']=='diypage.menu' || $_GPC['r']=='diypage.menu.edit') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/menu')?>" style="cursor: pointer;">菜单管理</a></li>
	<?php  } ?>
	<?php if(cv('diypage.menu.add')) { ?>
	<li <?php  if($_GPC['r']=='diypage.menu.add') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/menu/add')?>" style="cursor: pointer;">新建菜单</a></li>
	<?php  } ?>
</ul>
<?php  } ?>

<?php if(cv('diypage.shop.layer|diypage.shop.followbar|diypage.shop.gotop')) { ?>
<div class='menu-header'>其他功能</div>
<ul>
	<?php if(cv('diypage.shop.layer')) { ?>
	<li <?php  if($_GPC['r']=='diypage.shop.layer') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/shop/layer')?>">悬浮按钮</a></li>
	<?php  } ?>
	<?php if(cv('diypage.shop.gotop')) { ?>
	<li <?php  if($_GPC['r']=='diypage.shop.gotop') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/shop/gotop')?>">返回顶部</a></li>
	<?php  } ?>
	<?php if(cv('diypage.shop.followbar')) { ?>
	<li <?php  if($_GPC['r']=='diypage.shop.followbar') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/shop/followbar')?>">关注条</a></li>
	<?php  } ?>
	<?php if(cv('diypage.shop.adv')) { ?>
	<li <?php  if($_GPC['r']=='diypage.shop.adv'||$_GPC['r']=='diypage.shop.adv.add'||$_GPC['r']=='diypage.shop.adv.edit') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/shop/adv')?>">启动广告</a></li>
	<?php  } ?>
	<?php if(cv('diypage.shop.danmu')) { ?>
	<li <?php  if($_GPC['r']=='diypage.shop.danmu') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/shop/danmu')?>">下单提醒</a></li>
	<?php  } ?>
</ul>
<?php  } ?>

<?php if(cv('diypage.shop.page|diypage.shop.menu')) { ?>
<div class='menu-header'>商城设置</div>
<ul>
	<?php if(cv('diypage.shop.page')) { ?>
	<li <?php  if($_GPC['r']=='diypage.shop.page') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/shop/page')?>" style="cursor: pointer;">页面设置</a></li>
	<?php  } ?>
	<?php if(cv('diypage.shop.menu')) { ?>
	<li <?php  if($_GPC['r']=='diypage.shop.menu') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/shop/menu')?>" style="cursor: pointer;">菜单设置</a></li>
	<?php  } ?>
</ul>
<?php  } ?>

<?php if(cv('diypage.temp')) { ?>
<div class='menu-header'>模板管理</div>
<ul>
	<li <?php  if($_GPC['r']=='diypage.temp') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/temp')?>" style="cursor: pointer;">全部模板</a></li>
	<?php if(cv('diypage.temp.category')) { ?>
	<li <?php  if($_GPC['r']=='diypage.temp.category') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diypage/temp/category')?>" style="cursor: pointer;">模板分类</a></li>
	<?php  } ?>
</ul>
<?php  } ?>