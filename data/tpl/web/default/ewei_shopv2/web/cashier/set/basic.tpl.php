<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-sm-2 control-label">是否开启收银台</label>
	<div class="col-sm-8">
		<?php if(cv('cashier.set.edit')) { ?>
		<label class="radio-inline"><input type="radio"  name="data[isopen]" value="0" <?php  if($data['isopen'] ==0) { ?> checked="checked"<?php  } ?> /> 不开启</label>
		<label class="radio-inline"><input type="radio"  name="data[isopen]" value="1" <?php  if($data['isopen'] ==1) { ?> checked="checked"<?php  } ?> /> 开启</label>
		<div class='help-block'></div>
		<?php  } else { ?>
		<?php  if($data['isopen'] ==0) { ?>不允许<?php  } else { ?>允许<?php  } ?>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">收银台登录地址</label>
	<div class="col-sm-9 col-xs-12">
		<p class='form-control-static'>
			<a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php  echo $_W['siteroot'];?>web/cashier.php?i=<?php  echo $_W['uniacid'];?>" >
				<?php  echo $_W['siteroot'];?>web/cashier.php?i=<?php  echo $_W['uniacid'];?>
			</a>
			<span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true"
				  data-content="<img src='<?php  echo $qrcode;?>' width='130' alt='链接二维码'>" data-placement="auto right">
				<i class="glyphicon glyphicon-qrcode"></i>
			</span>
		</p>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">登录页面背景</label>
	<div class="col-sm-9 col-xs-12">
		<?php if(cv('cashier.set.edit')) { ?>
		<?php  echo tpl_form_field_image('data[bg]',$data['bg'],'../addons/ewei_shopv2/plugin/cashier/static/images/bg.jpg')?>
		<span class="help-block">入驻宣传封面 建议尺寸400 * 180</span>
		<?php  } else { ?>
		<?php  if(empty($data['regbg'])) { ?>
		<img src="../addons/ewei_shopv2/plugin/cashier/template/mobile/default/static/images/regbg.png" class="img-responsive img-thumbnail" width="150">
		<?php  } else { ?>
		<img src="<?php  echo tomedia($data['regpic'])?>" onerror="this.src='../addons/ewei_shopv2/plugin/cashier/template/mobile/default/static/images/regbg.png'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
		<?php  } ?>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">支付几天后可提现</label>
	<div class="col-sm-8">
		<?php if(cv('cashier.set.edit')) { ?>
		<div class="input-group">
			<input type="text" name="data[payday]" class="form-control" value="<?php  echo $data['payday'];?>">
			<span class="input-group-addon">天</span>
		</div>
		<span class="help-block">不填写则,支付完成就可以提现</span>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['payday'];?></div>
		<?php  } ?>
	</div>
</div>