<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'><?php  echo $this->plugintitle?></div>
<ul>
    <li <?php  if($_W['action']=='') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('lottery')?>">活动管理</a></li>
</ul>
<div class='menu-header'>系统设置</div>
<ul>
    <li <?php  if($_W['action']=='setting.setlottery') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('lottery/setting/setlottery')?>">说明&通知设置</a></li>
    <li <?php  if($_W['action']=='setting.setstart') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('lottery/setting/setstart')?>">入口设置</a></li>
</ul>

