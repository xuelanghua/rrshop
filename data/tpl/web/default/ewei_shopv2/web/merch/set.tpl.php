<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>基础设置</h2> </div>


<form id="setform"  <?php if(cv('merch.set.edit')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate">

    <input type="hidden" id="tab" name="tab" value="#tab_basic" />
    <div class="tabs-container">
		 <ul class="nav nav-tabs" id="myTab">
			<li <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>class="active"<?php  } ?>><a href="#tab_basic">基本</a></li>
			<li <?php  if($_GPC['tab']=='enter') { ?>class="active"<?php  } ?>><a href="#tab_enter">入驻设置</a></li>
			<li <?php  if($_GPC['tab']=='web') { ?>class="active"<?php  } ?>><a href="#tab_web">多商户端</a></li>
			<li <?php  if($_GPC['tab']=='protocol') { ?>class="active"<?php  } ?>><a href="#tab_protocol">入驻申请协议</a></li>
		</ul>
		<div class="tab-content ">
			<div class="tab-pane <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>active<?php  } ?>" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('merch/set/basic', TEMPLATE_INCLUDEPATH)) : (include template('merch/set/basic', TEMPLATE_INCLUDEPATH));?></div>
			<div class="tab-pane <?php  if($_GPC['tab']=='enter') { ?>active<?php  } ?>" id="tab_enter"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('merch/set/enter', TEMPLATE_INCLUDEPATH)) : (include template('merch/set/enter', TEMPLATE_INCLUDEPATH));?></div>
			<div class="tab-pane <?php  if($_GPC['tab']=='web') { ?>active<?php  } ?>" id="tab_web"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('merch/set/web', TEMPLATE_INCLUDEPATH)) : (include template('merch/set/web', TEMPLATE_INCLUDEPATH));?></div>
			<div class="tab-pane <?php  if($_GPC['tab']=='protocol') { ?>active<?php  } ?>" id="tab_protocol"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('merch/set/protocol', TEMPLATE_INCLUDEPATH)) : (include template('merch/set/protocol', TEMPLATE_INCLUDEPATH));?></div>
		</div>
	</div>
<?php if(cv('merch.set.edit')) { ?>
    <div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<input type="submit"  value="提交" class="btn btn-primary" />
		</div>
    </div>
<?php  } ?>

</form>

<script language='javascript'>
        require(['bootstrap'], function () {
            $('#myTab a').click(function (e) {
                $('#tab').val($(this).attr('href'));
                e.preventDefault();
                $(this).tab('show');
            })
        });

        $(function () {
            $('.open_apply').click(function () {
                var type = $(".open_apply:checked").val();
                if (type == '1') {
                    $('.protocol-group').show();
                } else {
                    $('.protocol-group').hide();
                }
            })
        });

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>