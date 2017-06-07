<?php defined('IN_IA') or exit('Access Denied');?><ul class="menu-head-top">
    <li <?php  if($_W['action']=='') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exhelper')?>">快递助手概述 <i class="fa fa-caret-right"></i></a></li>
</ul>
<div class='menu-header'><?php  echo $this->plugintitle?></div>
<ul>
	<?php if(cv('exhelper.printset')) { ?><li <?php  if($_W['action']=='printset') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exhelper/printset')?>" style="cursor: pointer;">打印机设置</a></li><?php  } ?>
    <?php if(cv('exhelper.short')) { ?><li <?php  if($_W['action']=='short') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exhelper/short')?>" style="cursor: pointer;">商品简称设置</a></li><?php  } ?>
</ul>
<div class='menu-header'>模板管理</div>
<ul>
	<?php if(cv('exhelper.temp.express')) { ?><li <?php  if($_W['action']=='temp.express') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exhelper/temp/express')?>" style="cursor: pointer;">快递单</a></li><?php  } ?>
    <?php if(cv('exhelper.temp.invoice')) { ?><li <?php  if($_W['action']=='temp.invoice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exhelper/temp/invoice')?>" style="cursor: pointer;">发货单</a></li><?php  } ?>
    <?php if(cv('exhelper.sender')) { ?><li <?php  if($_W['action']=='sender') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exhelper/sender')?>" style="cursor: pointer;">发件人信息</a></li><?php  } ?> 
</ul>
<div class='menu-header'>打印</div>
<ul>
	<?php if(cv('exhelper.print.single')) { ?><li <?php  if($_W['action']=='print.single') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exhelper/print/single')?>" style="cursor: pointer;">单个打印</a></li><?php  } ?>
    <?php if(cv('exhelper.print.batch')) { ?><li <?php  if($_W['action']=='print.batch') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exhelper/print/batch')?>" style="cursor: pointer;">批量打印</a></li><?php  } ?>
</ul>