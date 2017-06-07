<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
	<span class='pull-right'>
		<?php if(cv('cashier.user.add')) { ?>
			<a class="btn btn-primary btn-sm" href="<?php  echo webUrl('cashier/user/add')?>">添加新收银台</a>
		<?php  } ?>
		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('cashier/user')?>">返回列表</a>
	</span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>收银台 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></h2>
</div>

<form id="setform"  <?php if(cv('cashier.set.edit')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate">
<input type="hidden" id="tab" name="tab" value="#tab_basic" />
<div class="tabs-container">
    <ul class="nav nav-tabs" id="myTab">
        <li  <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>class="active"<?php  } ?>><a href="#tab_basic">基本设置</a></li>
        <li  <?php  if($_GPC['tab']=='printer') { ?>class="active"<?php  } ?>><a href="#tab_printer">打印设置</a></li>
        <li  <?php  if($_GPC['tab']=='pay') { ?>class="active"<?php  } ?>><a href="#tab_pay">支付设置</a></li>
        <li  <?php  if($_GPC['tab']=='sale') { ?>class="active"<?php  } ?>><a href="#tab_sale">营销设置</a></li>
        <li  <?php  if($_GPC['tab']=='withdraw') { ?>class="active"<?php  } ?>><a href="#tab_withdraw">结算设置</a></li>
        <li  <?php  if($_GPC['tab']=='account') { ?>class="active"<?php  } ?>><a href="#tab_account">账户设置</a></li>
    </ul>
    <div class="tab-content ">
        <div class="tab-pane <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>active<?php  } ?>" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('cashier/user/post/basic', TEMPLATE_INCLUDEPATH)) : (include template('cashier/user/post/basic', TEMPLATE_INCLUDEPATH));?></div>
        <div class="tab-pane <?php  if($_GPC['tab']=='printer') { ?>active<?php  } ?>" id="tab_printer"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('cashier/user/post/printer', TEMPLATE_INCLUDEPATH)) : (include template('cashier/user/post/printer', TEMPLATE_INCLUDEPATH));?></div>
        <div class="tab-pane <?php  if($_GPC['tab']=='pay') { ?>active<?php  } ?>" id="tab_pay"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('cashier/user/post/pay', TEMPLATE_INCLUDEPATH)) : (include template('cashier/user/post/pay', TEMPLATE_INCLUDEPATH));?></div>
        <div class="tab-pane <?php  if($_GPC['tab']=='sale') { ?>active<?php  } ?>" id="tab_sale"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('cashier/user/post/sale', TEMPLATE_INCLUDEPATH)) : (include template('cashier/user/post/sale', TEMPLATE_INCLUDEPATH));?></div>
        <div class="tab-pane <?php  if($_GPC['tab']=='withdraw') { ?>active<?php  } ?>" id="tab_withdraw"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('cashier/user/post/withdraw', TEMPLATE_INCLUDEPATH)) : (include template('cashier/user/post/withdraw', TEMPLATE_INCLUDEPATH));?></div>
        <div class="tab-pane <?php  if($_GPC['tab']=='account') { ?>active<?php  } ?>" id="tab_account"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('cashier/user/post/account', TEMPLATE_INCLUDEPATH)) : (include template('cashier/user/post/account', TEMPLATE_INCLUDEPATH));?></div>
    </div>
</div>
<?php if(cv('cashier.set.edit')) { ?>
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
        $(":radio[name=wechat_status],:radio[name=alipay_status]").on("click",function (e) {
            var $this = $(this);
            var $status;
            if ($this.attr('name') == 'wechat_status'){
                $status = $(":radio[name=alipay_status]:checked");
            }else{
                $status = $(":radio[name=wechat_status]:checked");
            }
            var $next = $this.parents(".form-group").next();
            $this.val()=='1' ?  $next.show() : $next.hide();
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>