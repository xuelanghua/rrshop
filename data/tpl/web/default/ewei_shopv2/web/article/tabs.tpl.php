<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'><?php  echo $this->plugintitle?></div>

<ul>
	<?php if(cv('article')) { ?>
		<li <?php  if($_W[ 'action']=='' ) { ?>class="active" <?php  } ?>><a href="<?php  echo webUrl('article')?>">文章管理</a></li>
	<?php  } ?>
	<?php if(cv('article.category')) { ?>
		<li <?php  if($_W[ 'action']=='category' ) { ?>class="active" <?php  } ?>><a href="<?php  echo webUrl('article/category')?>">分类管理</a></li>
	<?php  } ?>
	<?php if(cv('article.report')) { ?>
		<li <?php  if($_W[ 'action']=='report' ) { ?>class="active" <?php  } ?>><a href="<?php  echo webUrl('article/report')?>">举报记录</a></li>
	<?php  } ?>
</ul>

<?php if(cv('article.set')) { ?>
	<div class='menu-header'>设置</div>
	<ul>
		<li <?php  if($_W[ 'action']=='set' ) { ?>class="active" <?php  } ?>><a href="<?php  echo webUrl('article/set')?>">其他设置</a></li>
	</ul>
<?php  } ?>