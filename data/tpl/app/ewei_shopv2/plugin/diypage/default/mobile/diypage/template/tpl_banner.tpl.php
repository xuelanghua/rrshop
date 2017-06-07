<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($diyitem['data'])) { ?>
    <div class='fui-swipe'>
        <div class='fui-swipe-wrapper'>
            <?php  if(is_array($diyitem['data'])) { foreach($diyitem['data'] as $banneritem) { ?>
                <a class='fui-swipe-item' href="<?php  echo $banneritem['linkurl'];?>" data-nocache="true"><img src="<?php  echo tomedia($banneritem['imgurl'])?>" style="display: block; width: 100%; height: auto;"/></a>
            <?php  } } ?>
        </div>
        <style>
            .fui-swipe-page .fui-swipe-bullet {background: <?php  echo $diyitem['style']['background'];?>; opacity: <?php  echo $diyitem['style']['opacity'];?>;}
            .fui-swipe-page .fui-swipe-bullet.active {opacity: 1;}
        </style>
        <div class="fui-swipe-page <?php  echo $diyitem['style']['dotalign'];?> <?php  echo $diyitem['style']['dotstyle'];?>" style="padding: 0 <?php  echo $diyitem['style']['leftright'];?>px; bottom: <?php  echo $diyitem['style']['bottom'];?>px; "></div>
    </div>
<?php  } ?>