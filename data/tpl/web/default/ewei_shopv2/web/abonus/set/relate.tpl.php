<?php defined('IN_IA') or exit('Access Denied');?>

            <div class="form-group">
                <label class="col-sm-2 control-label">成为代理商条件</label>
                <div class="col-sm-9 col-xs-12">
                	<?php if(cv('commission.set.edit')) { ?>
                        <label class="radio-inline"><input type="radio"  name="data[become]" value="0" <?php  if($data['become'] ==0) { ?> checked="checked"<?php  } ?> data-needcheck="0" onclick="showBecome(this)"/> 后台指定</label>
	                    <label class="radio-inline"><input type="radio"  name="data[become]" value="1" <?php  if($data['become'] ==1) { ?> checked="checked"<?php  } ?> data-needcheck="1" onclick="showBecome(this)"/> 申请</label>
					<?php  } else { ?>
                        <?php  if($data['become'] ==0) { ?>后台指定<?php  } ?>
						<?php  if($data['become'] ==1) { ?>申请<?php  } ?>
					<?php  } ?>
                </div>
            </div>

            <div class="form-group protocol-group" <?php  if($data['become'] !=1) { ?>style="display: none;"<?php  } ?>>
                <label class="col-sm-2 control-label">显示申请协议</label>
                <div class="col-sm-8">
                    <?php if(cv('commission.set.edit')) { ?>
                    <label class="radio-inline"><input type="radio"  name="data[open_protocol]" value="0" <?php  if($data['open_protocol'] ==0) { ?> checked="checked"<?php  } ?> /> 隐藏</label>
                    <label class="radio-inline"><input type="radio"  name="data[open_protocol]" value="1" <?php  if($data['open_protocol'] ==1) { ?> checked="checked"<?php  } ?> /> 显示</label>
                    <?php  } else { ?>
                    <?php  if($data['open_protocol'] ==0) { ?>隐藏<?php  } else { ?>显示<?php  } ?>
                    <?php  } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">指定区域代理说明</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('abonus.set.edit')) { ?>
                    <textarea class="form-control" name="data[noregdesc]" rows="5"><?php  echo $data['noregdesc'];?></textarea>
                    <span class="help-block">当“成为代理商条件”选择指定条件时，非代理商的提示文字, 默认显示为：想成为区域代理商吗？请立即联系我们！</span>
                    <?php  } else { ?>
                    <?php  echo $data['centerdesc'];?>
                    <?php  } ?>
                </div>
            </div>