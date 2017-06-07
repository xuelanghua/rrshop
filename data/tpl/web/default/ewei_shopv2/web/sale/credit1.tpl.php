<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>基础设置</h2> </div>


<form id="setform"  <?php if(cv('sale.credit1')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate">
    <input type="hidden" id="tab" name="tab" value="#tab_basic" />
    <div class="tabs-container">
		<ul class="nav nav-tabs" id="myTab">
			<li  <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>class="active"<?php  } ?>><a href="#tab_basic">购物送积分</a></li>

			<li  <?php  if($_GPC['tab']=='money') { ?>class="active"<?php  } ?>><a href="#tab_money">充值送积分</a></li>
		</ul>
		<div class="tab-content ">
			<div class="tab-pane   <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>active<?php  } ?>" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/credit1/basic', TEMPLATE_INCLUDEPATH)) : (include template('sale/credit1/basic', TEMPLATE_INCLUDEPATH));?></div>

			<div class="tab-pane   <?php  if($_GPC['tab']=='money') { ?>active<?php  } ?>" id="tab_money"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/credit1/money', TEMPLATE_INCLUDEPATH)) : (include template('sale/credit1/money', TEMPLATE_INCLUDEPATH));?></div>
		</div>
	</div>
<?php if(cv('sale.credit1')) { ?>
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

		function addConsumeItem(obj,name,enough1,enough2,give){
			var $this = $(obj).parent().prev();
			var html= '<div class="input-group recharge-item"  style="margin-top:5px">';
			html+='<span class="input-group-addon">'+name+'</span>';
			html+='<input type="text" class="form-control" name="'+enough1+'[]"  />';
			html+='<span class="input-group-addon">元至</span>';
			html+='<input type="text" class="form-control" name="'+enough2+'[]"  />';
			html+='<span class="input-group-addon">元&nbsp;&nbsp;|&nbsp;&nbsp;每消费1元赠送</span>';
			html+='<input type="text" class="form-control"  name="'+give+'[]"  />';
			html+='<span class="input-group-addon">积分</span>';
			html+='<div class="input-group-btn"><button type="button" class="btn btn-danger" onclick="$(this).parents(\'.recharge-item\').remove()"><i class="fa fa-remove"></i></button></div>';
			html+='</div>';
			$this.append(html);
		}
		function removeConsumeItem(obj){
			$(obj).closest('.recharge-item').remove();
		}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>