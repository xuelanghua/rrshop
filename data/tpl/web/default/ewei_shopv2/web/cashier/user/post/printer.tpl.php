<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-sm-2 control-label">是否打印小票</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<label class='radio-inline'>
			<input type='radio' name='printer_status' value='0' <?php  if(empty($userset['printer_status'])) { ?>checked<?php  } ?> /> 不开启
		</label>
		<label class='radio-inline'>
			<input type='radio' name='printer_status' value='1' <?php  if($userset['printer_status']==1) { ?>checked<?php  } ?> /> 开启
		</label>
		<div class='help-block'>开启小票打印,配置下面打印信息,就可以打印</div>
		<?php  } else { ?>
		<div class='form-control-static'><?php  if(empty($item['printer_status'])) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">选择打印机</label>
	<div class="col-sm-8 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<?php  echo tpl_selector('printer',array(
         'preview'=>true,
		'readonly'=>true,
		'nokeywords'=>true,
		'multi'=>1,
		'value'=>null,
		'url'=>webUrl('sysset/printer/printer_query'),
		'items'=>$order_printer_array,
		'buttontext'=>'选择打印机',
		'placeholder'=>'请选择打印机')
		)?>
		<?php  } else { ?>
		<div class="input-group multi-img-details container ui-sortable">
			<?php  if(is_array($order_printer_array)) { foreach($order_printer_array as $print) { ?>
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
	<label class="col-sm-2 control-label">商品收款模板</label>
	<div class="col-sm-8 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<select class='form-control' name='printer_template'>
			<option >选择您需要的订单打印模板</option>
			<?php  if(is_array($order_template)) { foreach($order_template as $value) { ?>
			<option value="<?php  echo $value['id'];?>" <?php  if($value['id']==$userset['printer_template']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
			<?php  } } ?>
		</select>
		<div class="help-block">商品收款打印的模板</div>
		<?php  } else { ?>
		<div class='form-control-static'>
			<?php  if(empty($userset['printer_template'])) { ?>选择您需要的订单打印模板<?php  } else { ?><?php  echo $userset['printer_template'];?><?php  } ?>
		</div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">普通收款模板</label>
	<div class="col-sm-8 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<select class='form-control' name='printer_template_default'>
			<option >选择您需要的订单打印模板</option>
			<?php  if(is_array($order_template)) { foreach($order_template as $value) { ?>
			<option value="<?php  echo $value['id'];?>" <?php  if($value['id']==$userset['printer_template_default']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
			<?php  } } ?>
		</select>
		<div class="help-block">普通收款打印的模板</div>
		<?php  } else { ?>
		<div class='form-control-static'>
			<?php  if(empty($userset['printer_template_default'])) { ?>选择您需要的订单打印模板<?php  } else { ?><?php  echo $userset['printer_template_default'];?><?php  } ?>
		</div>
		<?php  } ?>
	</div>
</div>