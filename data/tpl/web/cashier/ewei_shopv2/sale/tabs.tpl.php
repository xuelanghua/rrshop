<?php defined('IN_IA') or exit('Access Denied');?><div class="inner">
    <ul>
        <li <?php  if($_W['routes']=='sale') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo cashierUrl('sale')?>">
            <i class="icon icon-trade-assurance"></i>
            <span class="text">营销设置</span>
        </a>
        </li>
    </ul>
</div>
