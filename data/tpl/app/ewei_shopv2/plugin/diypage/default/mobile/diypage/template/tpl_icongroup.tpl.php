<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($diyitem['data'])) { ?>
    <div class="fui-icon-group noborder col-<?php  echo $diyitem['params']['rownum'];?> selecter" style="background-color: <?php  echo $diyitem['style']['background'];?>;
        <?php  if($diyitem['params']['bordertop']==1) { ?>border-top: 1px solid <?php  echo $diyitem['style']['bordercolor'];?>;<?php  } else { ?>border-top: none;<?php  } ?>
        <?php  if($diyitem['params']['borderbottom']==1) { ?>border-bottom: 1px solid <?php  echo $diyitem['style']['bordercolor'];?>;<?php  } else { ?>border-bottom: none;<?php  } ?>">
        <?php  $iconindex=0?>
        <?php  if(is_array($diyitem['data'])) { foreach($diyitem['data'] as $iconitem) { ?>
            <a class="fui-icon-col" style="<?php  if($diyitem['params']['border']==1&&($iconindex>0)) { ?>border-left: 1px solid <?php  echo $diyitem['style']['bordercolor'];?>;<?php  } else { ?>border-left: none;<?php  } ?>" href="<?php  echo $iconitem['linkurl'];?>" data-nocache="true">
                <?php  if($iconitem['dotnum']>0) { ?>
                    <div class="badge" style="background-color: <?php  echo $diyitem['style']['dotcolor'];?>;"><?php  echo $iconitem['dotnum'];?></div>
                <?php  } ?>
                <div class="icon icon-green radius"><i class="icon <?php  echo $iconitem['iconclass'];?>" style="color: <?php  echo $diyitem['style']['iconcolor'];?>;"></i></div>
                <div class="text" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $iconitem['text'];?></div>
            </a>
            <?php  $iconindex++?>
        <?php  } } ?>
    </div>
<?php  } ?>