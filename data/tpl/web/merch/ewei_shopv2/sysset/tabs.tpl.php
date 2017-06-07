<?php defined('IN_IA') or exit('Access Denied');?><?php if(mcv('sysset.shop')) { ?>
<div class='menu-header'>商城</div>
<ul>
    <?php if(mcv('sysset.shop')) { ?><li <?php  if($_W['routes']=='sysset.shop' ||$_W['routes']=='sysset') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sysset/shop')?>">基础设置</a></li><?php  } ?>
    </ul>
<?php  } ?>

<?php if(mcv('sysset.notice')) { ?>
<div class='menu-header'>消息</div>
<ul>
    <?php if(mcv('sysset.notice')) { ?><li  <?php  if($_W['routes']=='sysset.notice') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sysset/notice')?>">消息提醒</a></li><?php  } ?>
</ul>
<?php  } ?>