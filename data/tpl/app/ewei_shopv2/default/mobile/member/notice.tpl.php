<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page  fui-page-current member-cart-page'>
    <div class="fui-header">
	<div class="fui-header-left">
	    <a class="back"></a>
	</div>
	<div class="title">消息提醒设置</div> 
    </div>

    <div class='fui-content navbar' >
	<div class='fui-title'>订单类</div>
	<div class="fui-cell-group">
	    <div class="fui-cell"><div class="fui-cell-label">订单提交</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="submit" <?php  if(!isset($notice['submit'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">自提订单</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="carrier"  <?php  if(!isset($notice['carrier'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">订单取消</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="cancel"  <?php  if(!isset($notice['cancel'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">购买成功</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="pay"  <?php  if(!isset($notice['pay'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">订单发货</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="send"  <?php  if(!isset($notice['send'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">订单收货</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="finish"  <?php  if(!isset($notice['finish'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">退款申请</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="refund"  <?php  if(!isset($notice['refund'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">退款进度</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="refunding"  <?php  if(!isset($notice['refunding'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">退款结果</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="refund1"  <?php  if(!isset($notice['refund1'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">退款失败</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="refund2"  <?php  if(!isset($notice['refund2'])) { ?>checked<?php  } ?>></div></div>
	</div>
	
	<div class='fui-title'>会员类</div>
	<div class="fui-cell-group">
	    <div class="fui-cell"><div class="fui-cell-label">会员升级</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="upgrade"  <?php  if(!isset($notice['upgrade'])) { ?>checked<?php  } ?>></div></div>
	</div>
	
	<div class='fui-title'>充值类</div>
	<div class="fui-cell-group">
	    <div class="fui-cell"><div class="fui-cell-label">充值成功</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="recharge_ok" <?php  if(!isset($notice['recharge_ok'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">充值退款</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="recharge_refund" <?php  if(!isset($notice['recharge_refund'])) { ?>checked<?php  } ?>></div></div>
	</div>
	
	<?php  if(!!isset($_W['shopset']['trade']['withdraw'])) { ?>
	<div class='fui-title'>提现类</div>
	<div class="fui-cell-group">
	    <div class="fui-cell"><div class="fui-cell-label">提现申请</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="withdraw" <?php  if(!isset($notice['withdraw'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">提现成功</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="withdraw_ok" <?php  if(!isset($notice['withdraw_ok'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label">提现失败</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="withdraw_fail" <?php  if(!isset($notice['withdraw_fail'])) { ?>checked<?php  } ?>></div></div>
	</div>
	<?php  } ?>
	 
	<?php  if($hascommission) { ?>
	<div class='fui-title'>分销类</div>
	<div class="fui-cell-group">
	    <div class="fui-cell"><div class="fui-cell-label" style="width:auto">成为<?php  echo $cset['texts']['agent'];?></div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="commission_become" <?php  if(!isset($notice['commission_become'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label" style="width:auto">等级提升</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="commission_upgrade" <?php  if(!isset($notice['commission_upgrade'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label" style="width:auto">新增<?php  echo $cset['texts']['customer'];?></div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="commission_agent_new" <?php  if(!isset($notice['commission_agent_new'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label" style="width:auto"><?php  echo $cset['texts']['customer'];?>付款</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="commission_order_pay" <?php  if(!isset($notice['commission_order_pay'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label" style="width:auto"><?php  echo $cset['texts']['customer'];?>收货</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="commission_order_finish" <?php  if(!isset($notice['commission_order_finish'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label" style="width:auto">提现申请</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="commission_apply" <?php  if(!isset($notice['commission_apply'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label" style="width:auto">提现处理</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="commission_check" <?php  if(!isset($notice['commission_check'])) { ?>checked<?php  } ?>></div></div>
	    <div class="fui-cell"><div class="fui-cell-label" style="width:auto">商家打款</div><div class="fui-cell-info"></div><div class="fui-cell-remark noremark"><input type="checkbox" class="fui-switch fui-switch-success fui-switch-small" data-type="commission_pay" <?php  if(!isset($notice['commission_pay'])) { ?>checked<?php  } ?>></div></div>
	</div>
	<?php  } ?>
	 
    </div>

    <script language='javascript'>require(['biz/member/notice'], function (modal) {
                modal.init();
            });</script>
    <?php  $this->footerMenus()?>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>