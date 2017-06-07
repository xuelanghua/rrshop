<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-sm-2 control-label">提现</label>
	<div class="col-sm-8 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<label class='radio-inline'>
			<input type='radio' name='can_withdraw' value='0' <?php  if(empty($item['can_withdraw'])) { ?>checked<?php  } ?> /> 关闭
		</label>
		<label class='radio-inline'>
			<input type='radio' name='can_withdraw' value='1' <?php  if($item['can_withdraw']==1) { ?>checked<?php  } ?> /> 启用
		</label>
		<?php  } else { ?>
		<div class='form-control-static'><?php  if($item['can_withdraw']==1) { ?>启用<?php  } else { ?>关闭<?php  } ?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">扣点比例</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<div class="input-group">
			<input type="text" class="form-control" name="withdraw" value="<?php  echo $item['withdraw'];?>"/>
			<div class="input-group-addon">%</div>
		</div>
		<div class="help-block">如果使用的是系统默认支付,扣点比例在申请结算时生效!</div>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['withdraw'];?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">收款微信号</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<?php  echo tpl_selector('openid',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>0,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择收款人', 'items'=>$openid,'url'=>webUrl('member/query') ))?>
		<div class="help-block">如果使用的是系统默认支付,申请结算的时候可以使用微信方式</div>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['openid'];?></div>
		<?php  } ?>
	</div>
</div>