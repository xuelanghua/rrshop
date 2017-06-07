<?php defined('IN_IA') or exit('Access Denied');?><?php  $ps = p('commission')->getSet()?>
<div class="fui-navbar">
    <a href="<?php  echo mobileUrl('abonus')?>" class="external nav-item <?php  if($_W['routes']=='abonus') { ?>active<?php  } ?>">
        <span class="icon icon-home"></span>
        <span class="label"><?php  echo $this->set['texts']['center']?></span>
    </a>

    <a href="<?php  echo mobileUrl('abonus/bonus',array('status'=>0))?>"
       class="external nav-item <?php  if($_W['routes']=='abonus.bonus' && $_GPC['status']==0) { ?>active<?php  } ?>">
        <span class="icon icon-money"></span>
        <span class="label"><?php  echo $this->set['texts']['bonus_total']?></span>
    </a>

    <a href="<?php  echo mobileUrl('abonus/bonus',array('status'=>2))?>"
       class="external nav-item <?php  if($_W['routes']=='abonus.bonus' && $_GPC['status']==2) { ?>active<?php  } ?>">
        <span class="icon icon-process"></span>
        <span class="label"><?php  echo $this->set['texts']['bonus_lock']?></span>
    </a>

    <a href="<?php  echo mobileUrl('abonus/bonus',array('status'=>1))?>"
       class="external nav-item <?php  if($_W['routes']=='abonus.bonus' && $_GPC['status']==1) { ?>active<?php  } ?>">
        <span class="icon icon-manageorder"></span>
        <span class="label"><?php  echo $this->set['texts']['bonus_pay']?></span>
    </a>


    <a href="<?php  echo mobileUrl('commission')?>"
       class="external nav-item <?php  if($_W['routes']=='commission') { ?>active<?php  } ?>">
        <span class="icon icon-group"></span>
        <span class="label"><?php  echo $ps['texts']['center']?></span>
    </a>
</div>
