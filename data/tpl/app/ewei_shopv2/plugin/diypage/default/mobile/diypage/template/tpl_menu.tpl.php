<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($diyitem['data'])) { ?>
    <?php $diyitem['style']['pagenum']=empty($diyitem['style']['pagenum'])?8:$diyitem['style']['pagenum']?>
    <?php  if(empty($diyitem['style']['showtype']) || count($diyitem['data'])<=intval($diyitem['style']['pagenum'])) { ?>
        <div class="fui-icon-group noborder col-<?php  echo $diyitem['style']['rownum'];?> <?php  echo $diyitem['style']['navstyle'];?>" style="background: <?php  echo $diyitem['style']['background'];?>">
            <?php  if(is_array($diyitem['data'])) { foreach($diyitem['data'] as $menuitem) { ?>
                <a class="fui-icon-col external" href="<?php  echo $menuitem['linkurl'];?>" data-nocache="true">
                    <div class="icon"><img src="<?php  echo tomedia($menuitem['imgurl'])?>"></div>
                    <div class="text" style="color: <?php  echo $menuitem['color'];?>;"><?php  echo $menuitem['text'];?></div>
                </a>
            <?php  } } ?>
        </div>
    <?php  } else { ?>
        <div class="swiper swiper-<?php  echo $diyitemid;?>" data-element=".swiper-<?php  echo $diyitemid;?>" data-view="1">
            <div class="swiper-container  fui-icon-group noborder col-<?php  echo $diyitem['style']['rownum'];?> <?php  echo $diyitem['style']['navstyle'];?>" style="background: <?php  echo $diyitem['style']['background'];?>">
                <div class="swiper-wrapper" style="background: none;">
                    <?php  if(is_array($diyitem['data_temp'])) { foreach($diyitem['data_temp'] as $data_temp) { ?>
                        <div class="swiper-slide">
                            <?php  if(is_array($data_temp)) { foreach($data_temp as $menuitem) { ?>
                                <a class="fui-icon-col external" href="<?php  echo $menuitem['linkurl'];?>" data-nocache="true" <?php  if($diyitem['style']['background']!='#ffffff') { ?>style="background: <?php  echo $diyitem['style']['background'];?>"<?php  } ?>>
                                    <div class="icon"><img src="<?php  echo tomedia($menuitem['imgurl'])?>"></div>
                                    <div class="text" style="color: <?php  echo $menuitem['color'];?>;"><?php  echo $menuitem['text'];?></div>
                                </a>
                            <?php  } } ?>
                        </div>
                    <?php  } } ?>
                </div>
                <?php  if(!empty($diyitem['style']['showdot'])) { ?>
                <div class="swiper-pagination"></div>
                <?php  } ?>
            </div>
        </div>
    <?php  } ?>

<?php  } ?>