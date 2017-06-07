<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "抽奖说明"; </script>

<link rel="stylesheet" href="../addons/ewei_shopv2/plugin/lottery/static/style/lottery.css?<?php  echo time();?>" />

<div class='fui-page  fui-page-current'>

    <div class="fui-content">

        <div class="lottery-head">
            <img src="../addons/ewei_shopv2/plugin/lottery/static/images/lottery_banner.png" style="height: 10rem;width: 100%;">
        </div>
        <div class="lottery-title"><span class="title-left">所有抽奖</span></div>
        <div class="lottery-content">
            <?php  echo $set_info;?>
        </div>

    </div>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

