<?php defined('IN_IA') or exit('Access Denied');?><!--<div class='menu-header'>收银设置</div>-->
<!--<ul>-->
    <!--<li <?php  if($_W['routes']=='sysset') { ?>class="active"<?php  } ?>><a href="<?php  echo cashierUrl('sysset')?>">基础设置</a></li>-->
    <!--<li <?php  if($_W['routes']=='sysset.userset') { ?>class="active"<?php  } ?>><a href="<?php  echo cashierUrl('sysset/userset')?>">用户设置</a></li>-->
    <!--<li <?php  if($_W['routes']=='sysset.operator') { ?>class="active"<?php  } ?>><a href="<?php  echo cashierUrl('sysset/operator')?>">操作员管理</a></li>-->
<!--</ul>-->

<!--<div class='menu-header'>收银二维码</div>-->
<!--<ul>-->
    <!--<li <?php  if($_W['routes']=='sysset.qrcode' || $_W['routes']=='sysset.qrcode.edit') { ?>class="active"<?php  } ?>><a href="<?php  echo cashierUrl('sysset/qrcode')?>">收款二维码管理</a></li>-->
    <!--<li <?php  if($_W['routes']=='sysset.qrcode.add') { ?>class="active"<?php  } ?>><a href="<?php  echo cashierUrl('sysset/qrcode/add')?>">生成收款二维码</a></li>-->
<!--</ul>-->


<div class="inner">
    <ul>
        <li <?php  if($_W['routes']=='sysset') { ?>class="active"<?php  } ?>>
            <a href="<?php  echo cashierUrl('sysset')?>">
                <i class="icon icon-settings"></i>
                <span class="text">基础设置</span>
            </a>
        </li>
        <li <?php  if($_W['routes']=='sysset.userset') { ?>class="active"<?php  } ?>>
            <a href="<?php  echo cashierUrl('sysset/userset')?>">
                <i class="icon icon-group"></i>
                <span class="text">用户设置</span>
            </a>
        </li>

        <li <?php  if($_W['routes']=='sysset.operator') { ?>class="active"<?php  } ?>>
            <a href="<?php  echo cashierUrl('sysset/operator')?>">
                <i class="icon icon-person2"></i>
                <span class="text">操作员管理</span>
            </a>
        </li>
    </ul>
<div class="menu-header">收款二维码</div>
    <ul>
        <li <?php  if($_W['routes']=='sysset.qrcode' || $_W['routes']=='sysset.qrcode.edit') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo cashierUrl('sysset/qrcode')?>">
            <i class="icon icon-qrcode"></i>
            <span class="text">收款二维码</span>
        </a></li>
        <li <?php  if($_W['routes']=='sysset.qrcode.add') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo cashierUrl('sysset/qrcode/add')?>">
            <i class="icon icon-qrcode1"></i>
            <span class="text">生成二维码</span>
        </a></li>
    </ul>
    <div class="menu-header">商品管理</div>
    <ul>
        <li <?php  if($_W['routes']=='goodsmanage' || $_W['routes']=='goodsmanage.add' || $_W['routes']=='goodsmanage.edit') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo cashierUrl('goodsmanage')?>">
            <i class="icon icon-shop"></i>
            <span class="text">商品管理</span>
        </a></li>
        <li <?php  if($_W['routes']=='goodsmanage.cate' || $_W['routes']=='goodsmanage.cate_add' || $_W['routes']=='goodsmanage.cate_edit') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo cashierUrl('goodsmanage.cate')?>">
            <i class="icon icon-folder"></i>
            <span class="text">商品分类</span>
        </a></li>
    </ul>
</div>
