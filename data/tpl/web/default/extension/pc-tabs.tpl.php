<?php defined('IN_IA') or exit('Access Denied');?><ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active"><?php  if($do == 'installed') { ?>已安装的PC站风格<?php  } else if($do == 'prepared') { ?>安装PC站风格<?php  } else if($do == 'designer') { ?>设计PC站风格<?php  } else if($do == 'web') { ?>管理后台风格<?php  } ?></li>
</ol>
<ul class="nav nav-tabs">
	<li<?php  if($do == 'installed') { ?> class="active"<?php  } ?>><a href="<?php  echo url('extension/pc/installed');?>">已安装的PC站风格</a></li>
	<li<?php  if($do == 'prepared' || $do == 'install') { ?> class="active"<?php  } ?>><a href="<?php  echo url('extension/pc/prepared');?>">安装PC站风格</a></li>
	<li<?php  if($do == 'designer') { ?> class="active"<?php  } ?>><a href="<?php  echo url('extension/pc/designer');?>">设计PC站风格</a></li>
</ul>
