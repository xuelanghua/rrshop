<?php defined('IN_IA') or exit('Access Denied');?><div class="alert alert-info"  >
	发放或用户从领券中心获得后的消息推送，如果标题为空就不推送消息
</div>
<div class="form-group">
                <label class="col-sm-2 control-label">推送标题</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <input type="text" name="resptitle" class="form-control" value="<?php  echo $item['resptitle'];?>"  />
		  <span class="help-block">变量 [nickname] 会员昵称 [total] 优惠券张数</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $item['resptitle'];?></div>
                    <?php  } ?>
                </div>
            </div>
				  <div class="form-group">
                    <label class="col-sm-2 control-label">推送封面</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('sale.coupon' ,$item) ) { ?>
                        <?php  echo tpl_form_field_image('respthumb', $item['respthumb'])?>
                        <?php  } else { ?>
                        <input type="hidden" name="respthumb" value="<?php  echo $item['respthumb'];?>"/>
                        <?php  if(!empty($item['thumb'])) { ?>
                        <a href='<?php  echo tomedia($item['respthumb'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($item['respthumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
				
				    <div class="form-group">
                <label class="col-sm-2 control-label">推送说明</label>
                <div class="col-sm-9 col-xs-12">
                     <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <textarea name="respdesc" class='form-control'><?php  echo $item['respdesc'];?></textarea>
					  <span class="help-block">变量 [nickname] 会员昵称 [total] 优惠券张数</span>
                       <?php  } else { ?>
                      <div class='form-control-static'><?php  echo $item['respdesc'];?></div>
                    <?php  } ?>
                </div>
            </div>
				  <div class="form-group">
                <label class="col-sm-2 control-label">推送链接</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
	                    <div class="input-group form-group" style="margin: 0;">
	                    	<input type="text" name="respurl" class="form-control" value="<?php  echo $item['respurl'];?>" id="respurl" />
			            	<span data-input="#respurl" data-toggle="selectUrl" class="input-group-addon btn btn-default" data-full="true">选择链接</span>
			            </div>
						<span class='help-block'>消息推送点击的链接，为空默认为优惠券详情</span>
                    <?php  } else { ?>
                    	<div class='form-control-static'><?php  echo $item['respurl'];?></div>
                    <?php  } ?>
                </div>
            </div>	