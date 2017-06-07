<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="fui-page fui-page-current page-shop-notice-detail">
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">公告详情</div>
        <div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content'>
        <div class='fui-article'>
            <div class="title"><b><?php  echo $notice['title'];?></b></div>
            <div class='subtitle'>
                发布时间 : <?php  echo date('Y-m-d H:i',$notice['createtime'])?>
            </div>
            <hr>
            <div class='content content-block'>
                <?php  echo $notice['detail'];?>
            </div>
        </div>
    </div> 
    <script >require(['init'])</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>