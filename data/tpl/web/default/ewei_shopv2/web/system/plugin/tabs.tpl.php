<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'>应用管理</div>
<ul>
    <li <?php  if($_W['action']=='system.plugin') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/plugin')?>">应用信息</a></li>
    <li <?php  if($_W['action']=='system.plugin.coms') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/plugin/coms')?>">组件信息</a></li>
    <li <?php  if($_W['action']=='system.plugin.perm') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/plugin/perm')?>">公众号权限</a></li>
     
</ul>
