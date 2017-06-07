<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-sm-2 control-label">模板选择</label>
    <div class="col-sm-9 col-xs-12">
    <?php if(cv('abonus.set.edit')) { ?>
		<select class='form-control' name='data[style]'>
		    <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
		    <option value='<?php  echo $style;?>' <?php  if($style==$data['style']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
		    <?php  } } ?>
		</select>
	<?php  } else { ?>
		<?php  echo $data['style'];?>
	<?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">申请头部图片</label>
    <div class="col-sm-9 col-xs-12">
    	<?php if(cv('abonus.set.edit')) { ?>
			<?php  echo tpl_form_field_image('data[regbg]',$data['regbg'],'../addons/ewei_shopv2/plugin/abonus/template/mobile/default/static/images/bg.png')?>
		<?php  } else { ?>
			<?php  if(empty($data['regbg'])) { ?>
				<img src="../addons/ewei_shop/plugin/abonus/template/mobile/default/static/images/bg.png" onerror="this.src='../addons/ewei_shop/plugin/abonus/template/mobile/default/static/images/bg.png'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
			<?php  } else { ?>
				<img src="<?php  echo tomedia($data['regbg'])?>" onerror="this.src='../addons/ewei_shop/plugin/abonus/template/mobile/default/static/images/bg.png'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
			<?php  } ?>
		<?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
	<div class="input-group">
	    <div class="input-group-addon">区域代理名称</div>
	    <?php if(cv('abonus.set.edit')) { ?>
	    	<input type="text" name="texts[aagent]" class="form-control" value="<?php echo empty($data['texts']['aagent'])?'区域代理':$data['texts']['aagent']?>"  />
	    <?php  } else { ?>
	    	<div class="form-control valid"><?php echo empty($data['texts']['aagent'])?'区域代理':$data['texts']['aagent']?></div>
	    <?php  } ?>
	</div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
	<div class="input-group">
	    <div class="input-group-addon">区域代理中心</div>
	    <?php if(cv('abonus.set.edit')) { ?>
	    	<input type="text" name="texts[center]" class="form-control" value="<?php echo empty($data['texts']['center'])?'区域代理中心':$data['texts']['center']?>"  />
	    <?php  } else { ?>
	    	<div class="form-control valid"><?php echo empty($data['texts']['center'])?'区域代理中心':$data['texts']['center']?></div>
	    <?php  } ?>	
	</div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
	<div class="input-group">
	    <div class="input-group-addon">成为区域代理</div>
	    <?php if(cv('abonus.set.edit')) { ?>
	    	<input type="text" name="texts[become]" class="form-control" value="<?php echo empty($data['texts']['become'])?'成为区域代理':$data['texts']['become']?>"  />
	    <?php  } else { ?>
	    	<div class="form-control valid"><?php echo empty($data['texts']['become'])?'成为区域代理':$data['texts']['become']?></div>
	    <?php  } ?>
	</div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
	<div class="input-group">
	    <div class="input-group-addon">分红</div>
	    <?php if(cv('abonus.set.edit')) { ?>
	    	<input type="text" name="texts[bonus]" class="form-control" value="<?php echo empty($data['texts']['bonus'])?'分红':$data['texts']['bonus']?>"  />
	    <?php  } else { ?>
	    	<div class="form-control valid"><?php echo empty($data['texts']['bonus'])?'分红':$data['texts']['bonus']?></div>
	    <?php  } ?>
	</div>
    </div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label"></label>
	<div class="col-sm-9 col-xs-12">
		<div class="input-group">
			<div class="input-group-addon">累计分红</div>
			<?php if(cv('abonus.set.edit')) { ?>
			<input type="text" name="texts[bonus_total]" class="form-control" value="<?php echo empty($data['texts']['bonus_total'])?'累计分红':$data['texts']['bonus_total']?>"  />
			<?php  } else { ?>
			<div class="form-control valid"><?php echo empty($data['texts']['bonus_total'])?'累计分红':$data['texts']['bonus_total']?></div>
			<?php  } ?>
		</div>
	</div>
</div>
 <div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
	<div class="input-group">
	    <div class="input-group-addon">待结算分红</div>
	    <?php if(cv('abonus.set.edit')) { ?>
	    	<input type="text" name="texts[bonus_lock]" class="form-control" value="<?php echo empty($data['texts']['bonus_lock'])?'待结算分红':$data['texts']['bonus_lock']?>"  />
	    <?php  } else { ?>
	    	<div class="form-control valid"><?php echo empty($data['texts']['bonus_lock'])?'待结算分红':$data['texts']['bonus_lock']?></div>
	    <?php  } ?>
	</div>
    </div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label"></label>
	<div class="col-sm-9 col-xs-12">
		<div class="input-group">
			<div class="input-group-addon">预计分红</div>
			<?php if(cv('abonus.set.edit')) { ?>
			<input type="text" name="texts[bonus_wait]" class="form-control" value="<?php echo empty($data['texts']['bonus_wait'])?'预计分红':$data['texts']['bonus_wait']?>"  />
			<?php  } else { ?>
			<div class="form-control valid"><?php echo empty($data['texts']['bonus_wait'])?'预计分红':$data['texts']['bonus_wait']?></div>
			<?php  } ?>
		</div>
	</div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
	<div class="input-group">
	    <div class="input-group-addon">已结算分红</div>
	    <?php if(cv('abonus.set.edit')) { ?>
	    	<input type="text" name="texts[bonus_pay]" class="form-control" value="<?php echo empty($data['texts']['bonus_pay'])?'已结算分红':$data['texts']['bonus_pay']?>"  />
	    <?php  } else { ?>
	    	<div class="form-control valid"><?php echo empty($data['texts']['bonus_pay'])?'已结算分红':$data['texts']['bonus_pay']?></div>
	    <?php  } ?>
	</div>
    </div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label"></label>
	<div class="col-sm-9 col-xs-12">
		<div class="input-group">
			<div class="input-group-addon">分红明细</div>
			<?php if(cv('abonus.set.edit')) { ?>
			<input type="text" name="texts[bonus_detail]" class="form-control" value="<?php echo empty($data['texts']['bonus_detail'])?'分红明细':$data['texts']['bonus_detail']?>"  />
			<?php  } else { ?>
			<div class="form-control valid"><?php echo empty($data['texts']['bonus_detail'])?'分红明细':$data['texts']['bonus_detail']?></div>
			<?php  } ?>
		</div>
	</div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <div class="input-group">
            <div class="input-group-addon">扣除个人所得税</div>
            <?php if(cv('abonus.set.edit')) { ?>
            <input type="text" name="texts[bonus_charge]" class="form-control" value="<?php echo empty($data['texts']['bonus_charge'])?'扣除个人所得税':$data['texts']['bonus_charge']?>"  />
            <?php  } else { ?>
            <div class="form-control valid"><?php echo empty($data['texts']['bonus_charge'])?'扣除个人所得税':$data['texts']['bonus_charge']?></div>
            <?php  } ?>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
	<div class="input-group">
	    <div class="input-group-addon">分红明细</div>
	    <?php if(cv('abonus.set.edit')) { ?>
	    	<input type="text" name="texts[bonus_detail]" class="form-control" value="<?php echo empty($data['texts']['bonus_detail'])?'分红明细':$data['texts']['bonus_detail']?>"  />
	    <?php  } else { ?>
	    	<div class="form-control valid"><?php echo empty($data['texts']['bonus_detail'])?'分红明细':$data['texts']['bonus_detail']?></div>
	    <?php  } ?>
	</div>
    </div>
</div>

