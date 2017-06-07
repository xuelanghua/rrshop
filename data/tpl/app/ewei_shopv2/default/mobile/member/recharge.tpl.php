<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page fui-page-current'>
    <div class="fui-header">
		<div class="fui-header-left">
			<a class="back"></a>
		</div>
		<div class="title">账户充值</div> 
		<div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content navbar' >
		<input type="hidden" id="logid" value="<?php  echo $logid;?>" />
		<input type="hidden" id="couponid" value="" />
		<div class='fui-cell-group'>
			<div class='fui-cell'>
				<div class='fui-cell-label'>当前<?php  echo $_W['shopset']['trade']['moneytext'];?></div>
				<div class='fui-cell-info'>￥<?php  echo number_format($credit,2)?></div>
			</div>
			<div class='fui-cell'>
				<div class='fui-cell-label'>充值金额</div>
				<div class='fui-cell-info'><input type='number' class='fui-input' id='money' value="<?php  echo $_GPC['money'];?>"></div>
			</div>
		</div>
		<div class='fui-cell-group'>
			<?php  if(com('coupon')) { ?>
			<div class='fui-cell' id='coupondiv' style='display:none'>
				<div class='fui-cell-label' style='width:auto'>优惠券</div>
				<div class='fui-cell-info'></div>
				<div class='fui-cell-remark'>
					<div class='badge' style='display:none'>0</div>
					<span class='text'>无可用</span>
				</div>
			</div>
			<?php  } ?>
		</div>

<?php  if(!empty($acts)) { ?>
		<div class='fui-cell-group'>
			<div class='fui-according'>
				<div class='fui-according-header'>
					<div class="text">充值活动 
						充值满 <span class='text-danger'><?php  echo $acts[0]['enough'];?></span> 元立即送 <span class='text-danger'><?php  echo $acts[0]['give'];?></span> 元
					</div>
					<?php  if(count($acts)>1) { ?><span class="remark">更多</span><?php  } ?>
				</div>
				<?php  if(count($acts)>1) { ?>
				<div class='fui-according-content'>
					<div class='content-block' style="padding: 0 0.5rem;">
						<div class="fui-cell-group" style="margin-top: 0;">
							<?php  if(is_array($acts)) { foreach($acts as $key => $enough) { ?>
								<?php  if($key>0) { ?>
								<div class="fui-cell" style="">
									<div class="fui-cell-text">充值满 <span class='text-danger'><?php  echo $enough['enough'];?></span> 元立即送 <span class='text-danger'><?php  echo $enough['give'];?></span> 元</div>
								</div>
								<?php  } ?>
							<?php  } } ?>
						</div>
					</div>
				</div>
				<?php  } ?>
			</div>
		</div>
<?php  } ?>

		<a id='btn-next' class='btn btn-success block disabled'>下一步</a>
		<?php  if($wechat['success'] || $payinfo['wechat']) { ?>
		<a id='btn-wechat' class='btn btn-success block btn-pay ' style='display:none'>微信支付</a>
		<?php  } ?>
		<?php  if(($alipay['success'] && !is_h5app()) || $payinfo['alipay']) { ?>
		<a id='btn-alipay' class='btn btn-warning  block btn-pay'  style='display:none'>支付宝支付</a>
		<?php  } ?>


		

    </div>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('order/pay/wechat_jie', TEMPLATE_INCLUDEPATH)) : (include template('order/pay/wechat_jie', TEMPLATE_INCLUDEPATH));?>
	<script language='javascript'>
		require(['biz/member/recharge'], function (modal) {
			modal.init({minimumcharge: <?php  echo $minimumcharge?>,wechat: <?php  echo intval($wechat['success'])?>,alipay:<?php  echo intval($alipay['success'])?>});
	});
</script>
</div> 

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('sale/coupon/util/picker', TEMPLATE_INCLUDEPATH)) : (include template('sale/coupon/util/picker', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>