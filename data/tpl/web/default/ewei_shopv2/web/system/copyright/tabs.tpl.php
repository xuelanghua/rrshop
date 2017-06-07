<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'>版权设置</div>
<ul>
    <li <?php  if($_W['routes']=='system.copyright') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/copyright')?>">手机端</a></li>
    <li <?php  if($_W['routes']=='system.copyright.manage') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/copyright/manage')?>">管理端</a></li>

</ul>

<div class='menu-header'>公告管理</div>
<ul>
<li <?php  if($_W['routes']=='system.copyright.notice') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/copyright/notice')?>">公告通知</a></li>
</ul>