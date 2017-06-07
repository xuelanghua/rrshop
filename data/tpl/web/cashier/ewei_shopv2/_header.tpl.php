<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header_base', TEMPLATE_INCLUDEPATH)) : (include template('_header_base', TEMPLATE_INCLUDEPATH));?>
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

        <?php  if($this->model->is_perm('index')) { ?>
        <li <?php  if($_W['routes']=='index') { ?> class="active"<?php  } ?>>
        <a  href="<?php  echo cashierUrl('index')?>">
            <i class="icon icon-recharge"></i>
            <div class="text">我要收款</div></a>
        </li>
        <?php  } ?>

        <?php  if($this->model->is_perm('goods')) { ?>
        <li <?php  if($_W['routes']=='goods') { ?> class="active"<?php  } ?>>
        <a  href="<?php  echo cashierUrl('goods')?>">
            <i class="icon icon-goods"></i>
            <div class="text">商品收款</div></a>
        </li>
        <?php  } ?>

        <?php  if($this->model->is_perm('order')) { ?>
        <li <?php  if($_W['routes']=='order') { ?> class="active"<?php  } ?>><a href="<?php  echo cashierUrl('order')?>">
        <i class="icon icon-order"></i>
        <div class="text">收款订单</div></a>
        </a></li>
        <?php  } ?>

        <?php  if($this->model->is_perm('statistics')) { ?>
        <li <?php  if($_W['routes']=='statistics') { ?> class="active"<?php  } ?>><a href="<?php  echo cashierUrl('statistics')?>">
        <i class="icon icon-rank"></i>
        <div class="text">收款统计</div></a>
        </a></li>
        <?php  } ?>

        <?php  if($this->model->is_perm('sale')) { ?>
        <li <?php  if($_W['routes']=='sale') { ?> class="active"<?php  } ?>><a href="<?php  echo cashierUrl('sale')?>">
        <i class="icon icon-trade-assurance"></i>
        <div class="text">营销设置</div>
        <?php  } ?>

        <?php  if(!empty($_W['cashieruser']['can_withdraw'])) { ?>
            <?php  if($this->model->is_perm('clearing')) { ?>
            <li <?php  if($_W['routes']=='clearing') { ?> class="active"<?php  } ?>><a href="<?php  echo cashierUrl('clearing')?>">
            <i class="icon icon-refund"></i>
            <div class="text">申请提现</div>
            <?php  } ?>
        <?php  } ?>

        <?php  if($this->model->is_perm('sysset')) { ?>
        <li <?php  if($_W['routes']=='sysset') { ?> class="active"<?php  } ?>><a href="<?php  echo cashierUrl('sysset')?>">
        <i class="icon icon-settings"></i>
        <div class="text">基础设置</div></a>
    </a></li>
        <?php  } ?>


        </a></li>

    </ul>

    <ul class="nav navbar-nav navbar-right" style="">
        <li>
            <a href="<?php  echo cashierUrl('quit')?>">
                <i class="icon icon-light"></i>
                <div class="text">退出</div></a>
            </a>

        </li>
    </ul>
</div>
</nav>
</div>
<!--<script language="javascript">-->
    <!--$(function(){-->
        <!--var top =$('.page-menu .inner').height();-->
        <!--$('.page-menu .inner').css('margin-top',-top + 'px').show();-->

    <!--})-->
<!--</script>-->
<div class='wrapper main-wrapper wrapper-content ' >
    <?php  if($no_left) { ?>
    <div class="page-content  col-sm-12" >
        <?php  } else { ?>
        <div class="col-sm-2 page-menu">
            <?php  echo $this->manageMenus()?>
        </div>


        <div class="col-sm-10  page-body">
            <?php  } ?>
