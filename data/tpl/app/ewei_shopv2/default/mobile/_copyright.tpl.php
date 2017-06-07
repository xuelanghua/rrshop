<?php defined('IN_IA') or exit('Access Denied');?><?php  $copyright = m('common')->getCopyright()?>
<?php  if(!empty($copyright) && !empty($copyright['copyright'])) { ?>
    <div class="footer" style='width:100%; display: block; <?php  if(!empty($copyright['bgcolor'])) { ?> background: <?php  echo $copyright['bgcolor'];?>; <?php  } ?>'>
        <?php  echo $copyright['copyright'];?>
    </div>
<?php  } ?>