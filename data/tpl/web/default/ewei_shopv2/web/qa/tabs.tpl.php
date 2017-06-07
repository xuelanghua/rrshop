<?php defined('IN_IA') or exit('Access Denied');?><ul class="menu-head-top">
	<li <?php  if($_GPC['r']=='qa') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('qa')?>"><?php  echo $this->plugintitle?> <i class="fa fa-caret-right"></i></a></li>
</ul>

<?php if(cv('qa.adv')) { ?>
<div class='menu-header'>幻灯片</div>
<ul>
	<li <?php  if($_GPC['r']=='qa.adv' || $_GPC['r']=='qa.adv.add' || $_GPC['r']=='qa.adv.edit') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('qa/adv')?>">幻灯片管理</a></li>
</ul>
<?php  } ?>

<?php if(cv('qa.question')) { ?>
	<div class='menu-header'>问题管理</div>
	<ul>
		<li <?php  if($_GPC['r']=='qa.question' || $_GPC['r']=='qa.question.edit') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('qa/question')?>">问题管理</a></li>
		<?php if(cv('qa.question.add')) { ?>
		<li <?php  if($_GPC['r']=='qa.question.add') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('qa/question/add')?>">添加问题</a></li>
		<?php  } ?>
	</ul>
<?php  } ?>

<?php if(cv('qa.category')) { ?>
	<div class='menu-header'>分类管理</div>
	<ul>
		<li <?php  if($_GPC['r']=='qa.category' || $_GPC['r']=='qa.category.add' || $_GPC['r']=='qa.category.edit') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('qa/category')?>" style="cursor: pointer;">问题分类</a></li>
	</ul>
<?php  } ?>

<?php if(cv('qa.set')) { ?>
	<div class='menu-header'>设置</div>
	<ul>
		<li <?php  if($_GPC['r']=='qa.set') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('qa/set')?>">基础设置</a></li>
	</ul>
<?php  } ?>