<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'><?php  echo $this->plugintitle?></div>
<ul>
    <li <?php  if($_W['action']=='') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('postera')?>">海报管理</a></li>
    <?php  if($_GPC['method']=='scan') { ?><li class="active"><a href="<?php  echo webUrl('postera/scan',array('id'=>$_GPC['id']))?>">扫描记录</a></li><?php  } ?>
    <?php  if($_GPC['method']=='log') { ?><li class="active"><a href="<?php  echo webUrl('postera/log',array('id'=>$_GPC['id']))?>">关注记录</a></li><?php  } ?>
</ul>
