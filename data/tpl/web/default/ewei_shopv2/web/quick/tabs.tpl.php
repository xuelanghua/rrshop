<?php defined('IN_IA') or exit('Access Denied');?><ul class="menu-head-top">
	<li <?php  if($_GPC['r']=='quick') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('quick')?>"><?php  echo m('plugin')->getName('quick')?> <i class="fa fa-caret-right"></i></a></li>
</ul>

<?php if(cv('quick.pages')) { ?>
	<div class='menu-header'>购买页面</div>
	<ul>
		<li <?php  if($_GPC['r']=='quick.pages'||$_GPC['r']=='quick.pages.edit') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('quick/pages')?>">全部页面</a></li>
		<?php if(cv('quick.pages.add')) { ?>
			<li <?php  if($_GPC['r']=='quick.pages.add') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('quick/pages/add')?>">新建页面</a></li>
		<?php  } ?>
	</ul>
<?php  } ?>

<?php if(cv('quick.adv')) { ?>
	<div class='menu-header'>公用设置</div>
	<ul>
		<li <?php  if($_GPC['r']=='quick.adv'||$_GPC['r']=='quick.adv.edit'||$_GPC['r']=='quick.adv.add') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('quick/adv')?>">幻灯片</a></li>
	</ul>
<?php  } ?>