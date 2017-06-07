<?php defined('IN_IA') or exit('Access Denied');?><ul class="menu-head-top">
    <li <?php  if($_GPC['r']=='mmanage') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('mmanage')?>"><?php  echo m('plugin')->getName('mmanage')?> <i class="fa fa-caret-right"></i></a></li>
</ul>

<?php if(cv('mmanage.setting')) { ?>
    <div class='menu-header'>设置</div>
    <ul>
        <li <?php  if($_GPC['r']=='mmanage.setting') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('mmanage/setting')?>">基本设置</a></li>
    </ul>
<?php  } ?>