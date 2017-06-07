<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'>权限系统</div>

<ul>

    <?php if(cv('perm.role')) { ?><li <?php  if($_W['action']=='perm.role') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('perm/role')?>">角色</a></li><?php  } ?>
    <?php if(cv('perm.user')) { ?><li <?php  if($_W['action']=='perm.user') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('perm/user')?>">操作员</a></li><?php  } ?>
    <?php if(cv('perm.log')) { ?><li <?php  if($_W['action']=='perm.log') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('perm/log')?>">操作日志</a></li><?php  } ?>

</ul>
 