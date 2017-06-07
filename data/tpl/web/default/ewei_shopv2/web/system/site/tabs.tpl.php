<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'>网站</div>
<ul>
    <li <?php  if($_W['routes']=='system.site') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site')?>">基本设置</a></li>
    <li <?php  if($_W['routes']=='system.site.banner') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/banner')?>">幻灯片</a></li>
    <li <?php  if($_W['routes']=='system.site.casecategory') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/casecategory')?>">案例分类</a></li>
    <li <?php  if($_W['routes']=='system.site.case') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/case')?>">案例</a></li>
    <li <?php  if($_W['routes']=='system.site.link') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/link')?>">友情链接</a></li>

</ul>

<div class='menu-header'>文章</div>
<ul>
    <li <?php  if($_W['routes']=='system.site.category') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/category')?>">文章分类</a></li>
    <li <?php  if($_W['routes']=='system.site.article') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/article')?>">文章管理</a></li>
</ul>

<div class='menu-header'>内容</div>
<ul>
    <li <?php  if($_W['routes']=='system.site.companycategory') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/companycategory')?>">内容分类</a></li>
    <li <?php  if($_W['routes']=='system.site.companyarticle') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/companyarticle')?>">内容管理</a></li>
</ul>

<div class='menu-header'>留言板</div>
<ul>
    <li <?php  if($_W['routes']=='system.site.guestbook') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/guestbook')?>">留言内容</a></li>
</ul>
<div class='menu-header'>基础设置</div>
<ul>
    <li <?php  if($_W['routes']=='system.site.setting') { ?>class='active'<?php  } ?>><a href="<?php  echo webUrl('system/site/setting')?>">基础设置</a></li>
</ul>