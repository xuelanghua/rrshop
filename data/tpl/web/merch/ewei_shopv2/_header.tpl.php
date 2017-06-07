<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header_base', TEMPLATE_INCLUDEPATH)) : (include template('_header_base', TEMPLATE_INCLUDEPATH));?>

<body class="white-bg">
<div id='topbar' class='top-navigation   gray-bg '>
    <nav class="navbar   gray-bg " role="navigation" style="width:1024px;margin:auto;">
        <div class="navbar-header" style="width:200px;">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </button>
            <?php  if(!empty($copyright) && !empty($copyright['logo'])) { ?>
            <a style='padding:0;overflow:hidden;'><img src="<?php  echo tomedia($copyright['logo'])?>" style='width:150px;height:50px;' /></a>
            <?php  } else { ?>
            <a class="navbar-brand" href="<?php  echo merchUrl()?>">LOGO</a>
            <?php  } ?>
        </div>

<style>

    .deg180{
        transform:rotate(180deg);
        -ms-transform:rotate(180deg); 	/* IE 9 */
        -moz-transform:rotate(180deg); 	/* Firefox */
        -webkit-transform:rotate(180deg); /* Safari 和 Chrome */
        -o-transform:rotate(180deg); 	/* Opera */
    }
</style>
<div class="navbar-collapse collapse" id="navbar">

    <ul class="nav navbar-nav gray-bg">

        <li <?php  if($_W['routes']=='shop') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('shop')?>">店铺</a></li>
        <?php if(mcv('goods')) { ?><li <?php  if($_W['routes']=='goods') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('goods')?>">商品</a></li><?php  } ?>
        <?php if(mcv('order')) { ?><li <?php  if($_W['routes']=='order') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('order')?>">订单</a></li><?php  } ?>
        <?php if(mcv('sale')) { ?><li <?php  if($_W['routes']=='sale') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale')?>">营销</a></li><?php  } ?>
        <?php if(mcv('statistics')) { ?><li <?php  if($_W['routes']=='statistics') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('statistics')?>">数据</a></li><?php  } ?>
        <?php  if($_W['merchisfounder'] ==1) { ?>
        <li <?php  if($_W['routes']=='perm') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('perm')?>"><?php  if(!empty($_W['accounttotal'])) { ?>权限<?php  } else { ?>查看日志<?php  } ?></a></li>
        <?php  } ?>
        <?php if(mcv('sysset')) { ?><li <?php  if($_W['routes']=='sysset') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('sysset')?>">设置</a></li><?php  } ?>
        <?php if(mcv('apply')) { ?><li <?php  if($_W['routes']=='apply') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('apply')?>">结算</a></li><?php  } ?>

        <li <?php  if($_W['routes']=='plugins') { ?> class="active"<?php  } ?>><a href="<?php  echo merchUrl('plugins')?>">应用</a></li>

    </ul>

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown" style="position:relative;" onclick="$(this).find('span').toggleClass('deg180')">
                <name style="width: 80px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;display: block;text-align: center"><?php  echo $_W['merch_username'];?>//<?php  echo $_W['uniaccount']['username'];?></name>
                <span class="caret" style="position: absolute;top: 22px;right: 12px;"></span></a>
            <ul role="menu" class="dropdown-menu">
                <li><a href="<?php  echo merchUrl('updatepassword')?>"><i class="icon icon-keyboard"></i>  修改密码</a></li>
                <li><a href="<?php  echo merchUrl('quit')?>"><i class="icon icon-back"></i>  退出</a></li>
            </ul>
        </li>
    </ul>
</div>
</nav>
</div>
<div class='wrapper main-wrapper wrapper-content '>
    <?php  if($no_left) { ?>
    <div class="page-content" style="width:1000px">
        <?php  } else { ?>
        <div class="page-menubar">
            <?php  echo $this->manageMenus()?>
        </div>
        <div class="page-content">
            <?php  } ?>
