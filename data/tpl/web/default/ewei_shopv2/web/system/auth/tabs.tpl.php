<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'>授权管理</div>
<ul>
    <?php if(cv('system.auth')) { ?><li <?php  if($_W['routes']=='system.auth') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('system/auth')?>">授权管理</a></li><?php  } ?>
    <?php if(cv('system.auth.update')) { ?><li  <?php  if($_W['routes']=='system.auth.upgrade') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('system/auth/upgrade')?>">系统更新</a></li><?php  } ?>
</ul>
