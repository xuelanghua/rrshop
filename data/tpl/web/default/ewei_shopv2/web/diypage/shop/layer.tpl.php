<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diypage/_common', TEMPLATE_INCLUDEPATH)) : (include template('diypage/_common', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <h2>自定义悬浮按钮设置</h2>
</div>

<div class="diy-phone" data-merch="<?php  echo intval($_W['merchid'])?>">
    <div class="phone-head"></div>
    <div class="phone-body">
        <div class="phone-title" id="page">页面标题</div>
        <div class="phone-main" id="phone" style="position: relative; overflow: hidden; height: 500px;">
            <p style="text-align: center; line-height: 400px">loading...</p>
        </div>
    </div>
    <div class="phone-foot"></div>
</div>

<div class="diy-editor form-horizontal" id="diy-editor">
    <div class="editor-arrow"></div>
    <div class="inner"></div>
</div>



<div class="diy-menu">
    <div class="action">
        <nav class="btn btn-primary btn-sm btn-save" data-type="save">保存并设置</nav>
    </div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diypage/_template_layer', TEMPLATE_INCLUDEPATH)) : (include template('diypage/_template_layer', TEMPLATE_INCLUDEPATH));?>

<script language="javascript">
    var path = '../../plugin/diypage/static/js/diy.layer';
    myrequire([path,'tpl','web/biz'],function(modal,tpl){
        modal.init({
            tpl: tpl,
            attachurl: "<?php  echo $_W['attachurl'];?>",
            layer: <?php  if(!empty($diylayer)) { ?><?php  echo json_encode($diylayer)?><?php  } else { ?>null<?php  } ?>,
            merch: <?php  if($_W['plugin']=='merch' && !empty($_W['merchid'])) { ?>1<?php  } else { ?>0<?php  } ?>
        });
    });
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>