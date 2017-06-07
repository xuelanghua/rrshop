<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "<?php  echo $_W['cashieruser']['title'];?>"; </script>
<link href="../addons/ewei_shopv2/plugin/cashier/static/css/mobile.css" rel="stylesheet" type="text/css"/>
<div class="fui-page fui-page-current">
    <div class="fui-header">
        <div class="title">收银台管理端</div>
    </div>

    <div class="fui-content" >
        <div class="block-1">
            <p class="title">当日流水</p>
            <p class="price"><?php  echo $today;?></p>
        </div>

        <div class="fui-block-group col-3" style='margin-top:0; overflow: hidden;'>
            <a class="fui-block-child external">
                <div class="icon text-yellow"><i class="icon icon-money"></i></div>
                <div class="title" style="font-size:.7rem;">累计流水</div>
                <div class="text"  style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo $total;?></span> 元</div>
            </a>
            <a class="fui-block-child external">
                <div class="icon text-orange"><i class="icon icon-manageorder"></i></div>
                <div class="title" style="font-size:.7rem;">当月流水</div>
                <div class="text" style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo $month;?></span> 元</div>
            </a>

            <a class="fui-block-child external">
                <div class="icon text-cancel"><i class="icon icon-manageorder"></i></div>
                <div class="title" style="font-size:.7rem;">当周流水</div>
                <div class="text" style="font-size:.7rem;padding-top:.2rem;"><span><?php  echo $week;?></span> 元</div>
            </a>

            <a class="fui-block-child external" href="<?php  echo mobileUrl('cashier/manage/detail',array('cashierid'=>$_W['cashierid']))?>">
                <div class="icon text-blue"><i class="icon icon-process"></i></div>
                <div class="title" style="font-size:.7rem;">账单详细</div>
                <div class="text" style="font-size:.7rem;padding-top:.2rem;"></div>
            </a>

            <a class="fui-block-child external" href="<?php  echo mobileUrl('cashier',array('cashierid'=>$_W['cashierid']))?>">
                <div class="icon text-red"><i class="icon icon-post"></i></div>
                <div class="title" style="font-size:.7rem;">点击收款</div>
                <div class="text" style="font-size:.7rem;padding-top:.2rem;"></div>
            </a>
        </div>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>