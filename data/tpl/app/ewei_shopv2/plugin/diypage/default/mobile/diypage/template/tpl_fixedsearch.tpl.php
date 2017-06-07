<?php defined('IN_IA') or exit('Access Denied');?>
<?php  $diyitem = $diyitem_search?>
    <div class="diy-fixedsearch fixed" style="<?php  if(is_h5app()&&is_ios()) { ?> top: 3.2rem;<?php  } ?>">
        <div class="background" style="background: <?php  echo $diyitem['style']['background'];?>; opacity: <?php  echo $diyitem['style']['opacity'];?>;"></div>
        <form action="<?php  echo mobileUrl('goods', array('merchid'=>$page['merch']))?>" method="post" class="inner">
            <?php  if(!empty($diyitem['params']['leftnav'])) { ?>
                <a class="leftnav" href="<?php echo !empty($diyitem['params']['leftnavlink'])?$diyitem['params']['leftnavlink']:'javascript:;'?>" data-nocache="true">
                    <?php  if($diyitem['params']['leftnav']==1 && !empty($diyitem['params']['leftnavicon'])) { ?>
                        <i class="icon <?php  echo $diyitem['params']['leftnavicon'];?>"style="color: <?php echo !empty($diyitem['style']['leftnavcolor'])?$diyitem['style']['leftnavcolor']:'#fff'?>;"></i>
                    <?php  } ?>
                    <?php  if($diyitem['params']['leftnav']==2 && !empty($diyitem['params']['leftnavimg'])) { ?>
                        <img src="<?php  echo tomedia($diyitem['params']['leftnavimg'])?>" />
                    <?php  } ?>
                </a>
            <?php  } ?>
            <div class="center <?php  echo $diyitem['params']['searchstyle'];?>">
                <input type="search" value="" placeholder="<?php  echo $diyitem['params']['placeholder'];?>" style="color: <?php  echo $diyitem['style']['searchtextcolor'];?>; opacity: <?php  echo $diyitem['style']['opacity'];?>; background: <?php  echo $diyitem['style']['searchbackground'];?>;" name="keywords" />
            </div>
            <?php  if(!empty($diyitem['params']['rightnav'])) { ?>
                <a class="rightnav"  href="<?php echo !empty($diyitem['params']['rightnavlink'])?$diyitem['params']['rightnavlink']:'javascript:;'?>" data-nocache="true">
                    <?php  if($diyitem['params']['rightnav']==1 && !empty($diyitem['params']['rightnavicon'])) { ?>
                        <i class="icon <?php  echo $diyitem['params']['rightnavicon'];?>"style="color: <?php echo !empty($diyitem['style']['rightnavcolor'])?$diyitem['style']['rightnavcolor']:'#fff'?>;"></i>
                    <?php  } ?>
                    <?php  if($diyitem['params']['rightnav']==2 && !empty($diyitem['params']['rightnavimg'])) { ?>
                        <img src="<?php  echo tomedia($diyitem['params']['rightnavimg'])?>" />
                    <?php  } ?>
                </a>
            <?php  } ?>
        </form>
    </div>
