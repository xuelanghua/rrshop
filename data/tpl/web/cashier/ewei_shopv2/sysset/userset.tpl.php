<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-default panel-class"style="margin-top:20px;">
    <div class="panel-body">
        <form id="setform"  action="" method="post" class="form-horizontal form-validate">
            <input type="hidden" id="tab" name="tab" value="#tab_basic" />
            <div class="tabs-container">
                <ul class="nav nav-tabs" id="myTab">
                    <li  <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>class="active"<?php  } ?>><a href="#tab_basic">基本设置</a></li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane   <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>active<?php  } ?>" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sysset/userset/base', TEMPLATE_INCLUDEPATH)) : (include template('sysset/userset/base', TEMPLATE_INCLUDEPATH));?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <input type="submit"  value="提交" class="btn" />
                </div>
            </div>
        </form>
    </div>

</div>
<script language='javascript'>
    require(['bootstrap'], function () {
        $('#myTab a').click(function (e) {
            $('#tab').val($(this).attr('href'));
            e.preventDefault();
            $(this).tab('show');
        })
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>