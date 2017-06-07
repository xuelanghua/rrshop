<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($diyitem['data'])) { ?>
    <div class="diy-coupon col-<?php  echo $diyitem['params']['couponstyle'];?>" style="margin: <?php  echo $diyitem['style']['margintop'];?>px 0; background: <?php  echo $diyitem['style']['background'];?>;">
        <?php  if(is_array($diyitem['data'])) { foreach($diyitem['data'] as $couponitem) { ?>
            <?php  if(!empty($couponitem['couponid'])) { ?>
                <a class="diy-coupon-item" href="<?php  echo mobileUrl('sale/coupon/detail', array('id'=>$couponitem['couponid']))?>" data-nocache="true">
                    <div class="inner" style="border: 1px solid <?php  echo $couponitem['bordercolor'];?>; background: <?php  echo $couponitem['background'];?>; color: <?php  echo $couponitem['textcolor'];?>; margin: <?php  echo $diyitem['style']['margintop'];?>px <?php  echo $diyitem['style']['marginleft'];?>px">
                        <div class="name"><?php  echo $couponitem['price'];?></div>
                        <div class="desc"><?php  echo $couponitem['desc'];?></div>
                    </div>
                </a>
            <?php  } ?>
        <?php  } } ?>
    </div>
<?php  } ?>