<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'><?php  echo $this->plugintitle?></div>
<ul>

    <?php if(cv('diyform.temp')) { ?><li <?php  if($_W['action']=='temp') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diyform/temp')?>" style="cursor: pointer;">模板管理</a></li><?php  } ?>
    <?php if(cv('diyform.category')) { ?><li <?php  if($_W['action']=='category') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diyform/category')?>" style="cursor: pointer;">分类管理</a></li><?php  } ?>
 
     <?php if(cv('diyform.set')) { ?><li <?php  if($_W['action']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('diyform/set')?>" style="cursor: pointer;">基础设置</a></li><?php  } ?>
</ul>
