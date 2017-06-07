<?php defined('IN_IA') or exit('Access Denied');?>  <div class="form-group">
                <label class="col-sm-2 control-label">是否使用统一说明 </label>
                <div class="col-sm-9 col-xs-12">
                   <?php if( ce('sale.coupon' ,$item) ) { ?>
				   <label class="radio-inline" >
					<input type="radio" name="descnoset" value="0" <?php  if($item['descnoset'] == 0) { ?>checked="true"<?php  } ?> /> 使用
				</label>
			   
                         <label class="radio-inline"'>
					<input type="radio" name="descnoset" value="1" <?php  if($item['descnoset'] == 1) { ?>checked="true"<?php  } ?> /> 不使用
				</label>
				   <span class='help-block'>统一说明在<a href="<?php  echo webUrl('sale/coupon/set')?>" target='_blank'>【基础设置】</a>中设置，如果使用统一说明，则在优惠券说明前面显示统一说明</span>
						<?php  } else { ?>
						
						<div class='form-control-static'>
						  <?php  if($item['descnoset']==0) { ?>
						  使用
						  <?php  } else if($item['descnoset']==1) { ?>
						 不使用
						  <?php  } else { ?>
						  <?php  } ?>
					  </div>
						<?php  } ?>
                </div>
            </div>
			
						
			<div class="form-group">
	<label class="col-sm-2 control-label">使用说明</label>
	<div class="col-sm-9 col-xs-12">
                  <?php if( ce('sale.coupon' ,$item) ) { ?>
                            <?php  echo tpl_ueditor('desc',$item['desc'])?>
                            <?php  } else { ?>
                            <textarea id='desc' style='display:none'><?php  echo $item['desc'];?></textarea>
                            <a href='javascript:preview_html("#desc")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
	</div>
		</div>  