<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-sm-2 control-label">可用优惠卷</label>
	<div class="col-sm-8 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
			<?php  echo tpl_selector('couponid',array(
			'preview'=>true,
			'readonly'=>true,
			'multi'=>1,
			'value'=>null,
			'url'=>webUrl('sale/coupon/querycoupons'),
			'items'=>$coupon,
			'buttontext'=>'选择优惠券',
			'placeholder'=>'请选择优惠券')
			)
			?>
		<?php  } else { ?>
		<div class="input-group multi-img-details container ui-sortable">
			<?php  if(is_array($coupon)) { foreach($coupon as $print) { ?>
			<div data-name="printerid" data-id="<?php  echo $print['id'];?>" class="multi-item">
				<img src="<?php  echo tomedia($print['thumb'])?>" class="img-responsive img-thumbnail">
				<div class="img-nickname"><?php  echo $print['title'];?></div>
			</div>
			<?php  } } ?>
		</div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">消费送积分</label>
	<div class="col-sm-8 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<label class='radio-inline'>
			<input type='radio' name='credit1' value='0' <?php  if(empty($userset['credit1'])) { ?>checked<?php  } ?> /> 关闭
		</label>
		<label class='radio-inline'>
			<input type='radio' name='credit1' value='1' <?php  if($userset['credit1']==1) { ?>checked<?php  } ?> /> 开启
		</label>
		<div class="help-block">如果这里选择开启 营销->积分优惠  没有填写 或者 场景里面没有选择收银台 这里不会生效</div>
		<?php  } else { ?>
		<div class='form-control-static'><?php  if($item['credit1']==1) { ?>显示<?php  } else { ?>不显示<?php  } ?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">积分赠送倍率</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<div class="input-group">
			<input type="text" class="form-control" name="credit1_double" value="<?php  echo $userset['credit1_double'];?>"/>
			<div class="input-group-addon">倍</div>
		</div>
		<div class="help-block">积分赠送倍率 默认为空 或者 0 的时候为1倍;</div>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['credit1_double'];?>倍</div>
		<?php  } ?>
	</div>
</div>