<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'>数据管理</div>
<ul>
    <li <?php  if($_W['routes']=='system.data') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/data')?>">数据清理</a></li>
    <li <?php  if($_W['routes']=='system.data.transfer') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/data/transfer')?>">数据转移</a></li>
    <li <?php  if($_W['routes']=='system.data.backup') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/data/backup')?>">数据下载</a></li>
</ul>

<div class='menu-header'>计划任务</div>
<ul>
    <li <?php  if($_W['routes']=='system.data.task') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/data/task')?>">计划任务</a></li>
</ul>

<div class='menu-header'>工具</div>
<ul>
    <li  <?php  if($_W['routes']=='system.data.qiniu') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('system/data/qiniu')?>">七牛存储</a></li>
</ul>