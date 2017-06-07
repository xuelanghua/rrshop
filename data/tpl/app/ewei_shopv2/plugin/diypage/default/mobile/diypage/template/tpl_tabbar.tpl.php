<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($diyitem['data'])) { ?>
    <?php  if(count($diyitem['data'])<=3) { ?>
        <div class="fui-tab fui-tab-success">
            <?php  if(is_array($diyitem['data'])) { foreach($diyitem['data'] as $tabitem) { ?>
                <a class="<?php  if($tabitem['active']) { ?>active<?php  } ?> external" href="<?php  echo $tabitem['linkurl'];?>" style="<?php  echo $tabitem['style'];?>"><?php echo empty($tabitem['text'])?"未设置":$tabitem['text']?></a>
            <?php  } } ?>
        </div>
    <?php  } else { ?>
        <div class="swiper swiper-<?php  echo $diyitemid;?>" data-element=".swiper-<?php  echo $diyitemid;?>" data-view="3" data-slideto="<?php  echo $diyitem['params']['slideto'];?>">
            <div class="fui-tab fui-tab-success swiper-container">
                <div class="swiper-wrapper">
                    <?php  if(is_array($diyitem['data'])) { foreach($diyitem['data'] as $tabitem) { ?>
                        <a class="swiper-slide item external <?php  if($tabitem['active']) { ?>active<?php  } ?>" href="<?php  echo $tabitem['linkurl'];?>" style="<?php  echo $tabitem['style'];?>"><?php echo empty($tabitem['text'])?"未设置":$tabitem['text']?></a>
                    <?php  } } ?>
                </div>
            </div>
        </div>
    <?php  } ?>
<?php  } ?>