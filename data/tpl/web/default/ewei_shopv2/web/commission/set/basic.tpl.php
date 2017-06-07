<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-sm-2 control-label">分销层级</label>    
    <div class="col-sm-8">
    	<?php if(cv('commission.set.edit')) { ?>
			<label class="radio-inline"><input type="radio"  name="data[level]" value="0" <?php  if($data['level'] ==0) { ?> checked="checked"<?php  } ?> /> 不开启</label>
			<label class="radio-inline"><input type="radio"  name="data[level]" value="1" <?php  if($data['level'] ==1) { ?> checked="checked"<?php  } ?> /> 一级分销</label>
			<label class="radio-inline"><input type="radio"  name="data[level]" value="2" <?php  if($data['level'] ==2) { ?> checked="checked"<?php  } ?> /> 二级分销</label>
			<label class="radio-inline"><input type="radio"  name="data[level]" value="3" <?php  if($data['level'] ==3) { ?> checked="checked"<?php  } ?> /> 三级分销</label>
			<div class='help-block'>默认佣金比例请到<a href='<?php  echo webUrl('commission/level')?>' target='_blank'>【分销商等级】</a>进行设置</div>
		<?php  } else { ?>
			<?php  if($data['level'] ==0) { ?>不开启<?php  } ?>
			<?php  if($data['level'] ==1) { ?>一级分销<?php  } ?>
			<?php  if($data['level'] ==2) { ?>二级分销<?php  } ?>
			<?php  if($data['level'] ==3) { ?>三级分销<?php  } ?>
		<?php  } ?>
    </div>
</div> 
<div class="form-group">
    <label class="col-sm-2 control-label">分销内购</label>
    <div class="col-sm-9 col-xs-12">
    	<?php if(cv('commission.set.edit')) { ?>
			<label class="radio-inline"><input type="radio"  name="data[selfbuy]" value="0" <?php  if($data['selfbuy'] ==0) { ?> checked="checked"<?php  } ?> /> 关闭</label>
			<label class="radio-inline"><input type="radio"  name="data[selfbuy]" value="1" <?php  if($data['selfbuy'] ==1) { ?> checked="checked"<?php  } ?> /> 开启</label>
			<span class='help-block'>开启分销内购，分销商自己购买商品，享受一级佣金，上级享受二级佣金，上上级享受三级佣金</span>
		<?php  } else { ?>
			<?php  if($data['selfbuy'] ==0) { ?>关闭<?php  } else { ?>开启<?php  } ?>
		<?php  } ?>
    </div>
</div>

