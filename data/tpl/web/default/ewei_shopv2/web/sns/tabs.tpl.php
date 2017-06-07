<?php defined('IN_IA') or exit('Access Denied');?><ul class="menu-head-top">
    <li <?php  if($_W['routes']=='sns') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('sns')?>">概述 <i class="fa fa-caret-right"></i></a></li>
</ul>
<div class='menu-header'><?php  echo $this->plugintitle?></div>
<ul>
    <?php if(cv('sns.adv')) { ?><li <?php  if($_W['routes']=='sns.adv'||$_W['routes']=='sns.adv.edit'||$_W['routes']=='sns.adv.add') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/adv')?>">幻灯片管理</a></li><?php  } ?>
    <?php if(cv('sns.level')) { ?><li <?php  if($_W['routes']=='sns.level') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/level')?>">等级管理</a></li><?php  } ?>
</ul>
<div class='menu-header'>社区管理</div>
<ul>
    <?php if(cv('sns.category')) { ?><li <?php  if($_W['routes']=='sns.category'|| $_W['routes']=='sns.category.edit'|| $_W['routes']=='sns.category.add') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/category')?>">分类管理</a></li><?php  } ?>
    <?php if(cv('sns.board')) { ?><li <?php  if($_W['routes']=='sns.board' || $_W['routes']=='sns.board.edit') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/board')?>">版块管理</a></li><?php  } ?>
    <?php if(cv('sns.manage')) { ?><li <?php  if($_W['routes']=='sns.manage' || $_W['routes']=='sns.manage.edit') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/manage')?>">版主管理</a></li><?php  } ?>
    <?php if(cv('sns.member')) { ?><li <?php  if($_W['routes']=='sns.member') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/member')?>">会员管理</a></li><?php  } ?>
</ul>
<div class='menu-header'>话题管理</div>
    <ul>
    <?php if(cv('sns.posts')) { ?><li <?php  if($_W['routes']=='sns.posts') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/posts')?>">话题管理</a></li><?php  } ?>
    <?php if(cv('sns.replys')) { ?><li <?php  if($_W['routes']=='sns.replys') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/replys')?>">评论管理</a></li><?php  } ?>
</ul>
<div class='menu-header'>投诉管理</div>
<ul>
    <?php if(cv('sns.complain.category')) { ?><li <?php  if($_W['routes']=='sns.complain.category') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/complain/category')?>">投诉类别</a></li><?php  } ?>
    <?php if(cv('sns.complain')) { ?><li <?php  if($_GPC['type']=='untreated') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/complain',array('type'=>'untreated'))?>">待审核</a></li><?php  } ?>
    <?php if(cv('sns.complain')) { ?><li <?php  if($_GPC['type']=='cancel') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/complain',array('type'=>'cancel'))?>">未通过</a></li><?php  } ?>
    <?php if(cv('sns.complain')) { ?><li <?php  if($_GPC['type']=='processed') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/complain',array('type'=>'processed'))?>">已审核</a></li><?php  } ?>
    <?php if(cv('sns.complain')) { ?><li <?php  if($_GPC['type']=='deleted') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/complain',array('type'=>'deleted'))?>">已删除</a></li><?php  } ?>
    <?php if(cv('sns.complain')) { ?><li <?php  if($_W['routes']=='sns.complain' && $_GPC['type']=='') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/complain')?>">全部投诉</a></li><?php  } ?>
</ul>
<div class='menu-header'>基础设置</div>
<ul>
    <?php if(cv('sns.cover')) { ?><li <?php  if($_W['action']=='cover') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/cover')?>">入口设置</a></li><?php  } ?>
    <?php if(cv('sns.notice')) { ?><li  <?php  if($_W['action']=='notice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/notice')?>">通知设置</a></li><?php  } ?>
    <?php if(cv('sns.set')) { ?><li <?php  if($_W['action']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('sns/set')?>">基础设置</a></li><?php  } ?>
</ul>