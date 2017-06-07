<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-sm-2 control-label">是否开启区域代理</label>
    <div class="col-sm-8">
    	<?php if(cv('commission.set.edit')) { ?>
			<label class="radio-inline"><input type="radio"  name="data[open]" value="0" <?php  if($data['open'] ==0) { ?> checked="checked"<?php  } ?> /> 不开启</label>
			<label class="radio-inline"><input type="radio"  name="data[open]" value="1" <?php  if($data['open'] ==1) { ?> checked="checked"<?php  } ?> /> 开启</label>
			<div class='help-block'>默认分红比例请到<a href='<?php  echo webUrl('abonus/level')?>' target='_blank'>【代理商等级】</a>进行设置</div>
		<?php  } else { ?>
			<?php  if($data['open'] ==0) { ?>不开启<?php  } else { ?>开启<?php  } ?>
		<?php  } ?>
    </div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">内购分红</label>
	<div class="col-sm-9 col-xs-12">
		<?php if(cv('commission.set.edit')) { ?>
		<label class="radio-inline"><input type="radio"  name="data[selfbuy]" value="0" <?php  if($data['selfbuy'] ==0) { ?> checked="checked"<?php  } ?> /> 关闭</label>
		<label class="radio-inline"><input type="radio"  name="data[selfbuy]" value="1" <?php  if($data['selfbuy'] ==1) { ?> checked="checked"<?php  } ?> /> 开启</label>
		<span class='help-block'>开启分红内购，代理商品自己购买的订单也计算分红</span>
		<?php  } else { ?>
		<?php  if($data['selfbuy'] ==0) { ?>关闭<?php  } else { ?>开启<?php  } ?>
		<?php  } ?>
	</div>
</div>

