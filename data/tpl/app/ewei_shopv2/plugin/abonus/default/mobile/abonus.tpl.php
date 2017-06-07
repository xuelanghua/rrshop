<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('abonus/common', TEMPLATE_INCLUDEPATH)) : (include template('abonus/common', TEMPLATE_INCLUDEPATH));?>
<div class="fui-page fui-page-current">
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title"><?php  echo $this->set['texts']['center']?></div>
    </div>

    <div class="fui-content navbar" >

        <div class="fui-cell-group" style="margin-top:0;">
            <div class="fui-cell">
                <div class="fui-cell-icon headimg">
                    <img src="<?php  echo $member['avatar'];?>" class="round">
                </div>
                <div class="fui-cell-text">
                    <p><?php  echo $member['nickname'];?></p>
                </div>
                <div class="fui-cell-remark noremark">
                    <span class="text text-danger">【<?php  echo $levelname;?>】</span>
                     <?php  if(!empty($set['levelurl'])) { ?>
                    <a href="<?php  echo $set['levelurl'];?>"><span class="icon icon-help text-danger"></span></a>
                    <?php  } ?>
                </div>
            </div>
        </div>

        <div class="block-1 bgg">
            <p class="title">
                <?php  if($set['paytype']==2) { ?>本周<?php  } else { ?>本月<?php  } ?><?php  echo $this->set['texts']['bonus_wait']?></p>
            <p class="price"><?php  echo $bonus_wait;?></p>

            <p class="price1">
                <?php  if($member['aagenttype']<=1) { ?>省级: <?php  echo number_format($bonus_wait1,2)?> <?php  } ?>  <?php  if($member['aagenttype']<=2) { ?>市级 <?php  echo number_format($bonus_wait2,2)?><?php  } ?> 区级 <?php  echo number_format($bonus_wait3,2)?>
            </p>



        </div>




        <div class="fui-block-group col-<?php  echo $cols;?>  " style='margin-top:0;overflow: hidden;border-bottom:none;'>

            <a class="fui-block-child external" href="<?php  echo mobileUrl('abonus/bonus')?>">
                <div class="icon text-yellow"><i class="icon icon-money"></i></div>
                <div class="title" style="font-size:.7rem;"><?php  echo $this->set['texts']['bonus_total']?></div>
                <div class="text"  style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['total'],2)?></span></div>
            </a>

            <?php  if($member['aagenttype']<=1) { ?>
            <div class="fui-block-child external">
                <div class="icon icon-gray"><i class="icon icon-shengfen"></i></div>
                <div class="title" style="font-size:.7rem;">省级</div>
                <div class="text"  style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['total1'],2)?></span></div>
            </div>
            <?php  } ?>
            <?php  if($member['aagenttype']<=2) { ?>
            <div class="fui-block-child external">
                <div class="icon icon-gray"><i class="icon icon-city"></i></div>
                <div class="title" style="font-size:.7rem;">市级</div>
                <div class="text" style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['total2'],2)?></span></div>
            </div>
            <?php  } ?>

            <div class="fui-block-child external">
                <div class="icon icon-gray"><i class="icon icon-location-area"></i></div>
                <div class="title" style="font-size:.7rem;">区级</div>
                <div class="text" style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['total3'],2)?></span></div>
            </div>
        </div>

            <div class="fui-block-group col-<?php  echo $cols;?>  " style='margin-top:0; overflow: hidden;border-bottom:none;'>

                <a class="fui-block-child external" href="<?php  echo mobileUrl('abonus/bonus',array('status'=>1))?>">
                    <div class="icon text-blue"><i class="icon icon-process"></i></div>
                    <div class="title" style="font-size:.7rem;"><?php  echo $this->set['texts']['bonus_lock']?></div>
                    <div class="text"  style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['lock1'],2)?></span></div>
                </a>
                <?php  if($member['aagenttype']<=1) { ?>
                <div class="fui-block-child external">
                    <div class="icon icon-gray"><i class="icon icon-shengfen"></i></div>
                    <div class="title" style="font-size:.7rem;">省级</div>
                    <div class="text"  style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['lock1'],2)?></span></div>
                </div>
<?php  } ?>
                <?php  if($member['aagenttype']<=2) { ?>
                <div class="fui-block-child external">
                    <div class="icon icon-gray"><i class="icon icon-city"></i></div>
                    <div class="title" style="font-size:.7rem;">市级</div>
                    <div class="text" style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['lock2'],2)?></span></div>
                </div>
                <?php  } ?>
                <div class="fui-block-child external" ">
                    <div class="icon icon-gray"><i class="icon icon-location-area"></i></div>
                    <div class="title" style="font-size:.7rem;">区级</div>
                    <div class="text" style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['lock3'],2)?></span></div>
                </div>
            </div>


            <div class="fui-block-group col-<?php  echo $cols;?>  " style='margin-top:0; overflow: hidden;border-bottom:none;'>

                <a class="fui-block-child external" href="<?php  echo mobileUrl('abonus/bonus',array('status'=>2))?>">
                    <div class="icon text-orange"><i class="icon icon-manageorder"></i></div>
                    <div class="title" style="font-size:.7rem;"><?php  echo $this->set['texts']['bonus_pay']?></div>
                    <div class="text"  style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['ok'],2)?></span></div>
                </a>

                <?php  if($member['aagenttype']<=1) { ?>
                <div class="fui-block-child external">
                    <div class="icon icon-gray"><i class="icon icon-shengfen"></i></div>
                    <div class="title" style="font-size:.7rem;">省级</div>
                    <div class="text"  style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['ok1'],2)?></span></div>
                </div>
                <?php  } ?>

                <?php  if($member['aagenttype']<=2) { ?>
                <div class="fui-block-child external">
                    <div class="icon icon-gray"><i class="icon icon-city"></i></div>
                    <div class="title" style="font-size:.7rem;">市级</div>
                    <div class="text" style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['ok2'],2)?></span></div>
                </div>
                <?php  } ?>
                <div class="fui-block-child external">
                    <div class="icon icon-gray"><i class="icon icon-location-area"></i></div>
                    <div class="title" style="font-size:.7rem;">区级</div>
                    <div class="text" style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo number_format($bonus['ok3'],2)?></span></div>
                </div>
            </div>




        <?php  if(!empty($set['centerdesc'])) { ?>
        <div class='fui-according-group'>
            <div class='fui-according expanded'>
                <div class='fui-according-header'>
                    <div class='text'><?php  echo $this->set['texts']['agent']?>须知</div>
                    <div class='remark'></div>
                </div>
                <div class='fui-according-content'>
                    <div class='content-block'>

                       <?php  echo $set['centerdesc'];?>
                    </div>
                </div>

            </div>
        </div>
   <?php  } ?>


    </div>
</div>
<?php  echo $this->footerMenus()?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>