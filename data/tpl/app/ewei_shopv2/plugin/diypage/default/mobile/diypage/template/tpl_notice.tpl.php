<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($diyitem['data'])) { ?>
    <div class="fui-notice" style="background: <?php  echo $diyitem['style']['background'];?>" data-speed="<?php  echo $diyitem['params']['speed'];?>">
        <div class="image"><img src="<?php  echo tomedia($diyitem['params']['iconurl'])?>" onerror="this.src='../addons/ewei_shopv2/static/images/hotdot.jpg'"></div>
        <div class="icon"><i class="icon icon-notification1" style="font-size: 0.7rem; color: <?php  echo $diyitem['style']['iconcolor'];?>;"></i></div>
        <div class="text" style="color: <?php  echo $diyitem['style']['color'];?>;">
            <ul>
                <?php  if(is_array($diyitem['data'])) { foreach($diyitem['data'] as $noticeitem) { ?>
                    <?php  if($diyitem['params']['noticedata']==0) { ?>
                        <li><a href="<?php  if(!empty($noticeitem['linkurl'])) { ?><?php  echo $noticeitem['linkurl'];?><?php  } else { ?><?php  echo mobileUrl('shop/notice/detail', array('id'=>$noticeitem['id'], 'merchid'=>$page['merch']))?><?php  } ?>" style="color: <?php  echo $diyitem['style']['color'];?>;" data-nocache="true"><?php  echo $noticeitem['title'];?></a></li>
                    <?php  } else if($diyitem['params']['noticedata']==1) { ?>
                        <li><a href="<?php  echo $noticeitem['linkurl'];?>" style="color: <?php  echo $diyitem['style']['color'];?>;" data-nocache="true"><?php  echo $noticeitem['title'];?></a></li>
                    <?php  } ?>
                <?php  } } ?>
            </ul>
        </div>
    </div>
<?php  } ?>