<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'><?php  echo $this->plugintitle?></div>
<ul>
    <?php if(cv('taobao.main')) { ?><li <?php  if($_W['action']=='') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('taobao')?>">淘宝助手</a></li><?php  } ?>
    <?php if(cv('taobao.jingdong')) { ?><li <?php  if($_W['action']=='jingdong') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('taobao.jingdong')?>">京东助手</a></li><?php  } ?>
    <?php if(cv('taobao.one688')) { ?><li <?php  if($_W['action']=='one688') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('taobao.one688')?>">1688助手</a></li><?php  } ?>
    <?php if(cv('taobao.taobaocsv')) { ?><li <?php  if($_W['action']=='taobaocsv') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('taobao.taobaocsv')?>">淘宝CSV上传</a></li><?php  } ?>
</ul>