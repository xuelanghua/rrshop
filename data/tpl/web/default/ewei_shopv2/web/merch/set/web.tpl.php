<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-sm-2 control-label">商户地址</label>
	<div class="col-sm-9 col-xs-12">
		<p class='form-control-static'>
			<a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php  echo $_W['siteroot'];?>web/merchant.php?i=<?php  echo $_W['uniacid'];?>" >
				<?php  echo $_W['siteroot'];?>web/merchant.php?i=<?php  echo $_W['uniacid'];?>
			</a>
			<span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true"
				  data-content="<img src='<?php  echo $qrcode;?>' width='130' alt='链接二维码'>" data-placement="auto right">
				<i class="glyphicon glyphicon-qrcode"></i>
			</span>
		</p>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">登录页面宣传图</label>
	<div class="col-sm-9 col-xs-12">
		<?php if(cv('merch.set.edit')) { ?>
		<?php  echo tpl_form_field_image('data[regpic]',$data['regpic'],'../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png')?>
		<span class="help-block">入驻宣传封面 建议尺寸400 * 180</span>
		<?php  } else { ?>
		<?php  if(empty($data['regbg'])) { ?>
		<img src="../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png" onerror="this.src='../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
		<?php  } else { ?>
		<img src="<?php  echo tomedia($data['regpic'])?>" onerror="this.src='../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
		<?php  } ?>
		<?php  } ?>
	</div>
</div>