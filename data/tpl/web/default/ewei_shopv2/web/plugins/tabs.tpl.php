<?php defined('IN_IA') or exit('Access Denied');?> <?php  $category = m('plugin')->getList(1)?>
 <?php  if(is_array($category)) { foreach($category as $ck => $cv) { ?>
    <?php  if(count($cv['plugins'])<=0) { ?><?php  continue;?><?php  } ?>
     <div class='menu-header'><?php  echo $cv['name'];?></div>
    <ul class="plugin_tabs">
        <?php  if(is_array($cv['plugins'])) { foreach($cv['plugins'] as $plugin) { ?>
            <?php  if(com_run('perm::check_plugin',$plugin['identity'])) { ?>
	        <?php if(cv($plugin['identity'])) { ?>
	        	<li <?php  if($_GPC['p'] == $plugin['identity']) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl($plugin['identity'])?>"><?php  echo $plugin['name'];?></a></li>
	        <?php  } ?>
            <?php  } ?>
        <?php  } } ?>
   </ul>  
<?php  } } ?>

