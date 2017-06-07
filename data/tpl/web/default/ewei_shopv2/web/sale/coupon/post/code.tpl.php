<?php defined('IN_IA') or exit('Access Denied');?><div class="alert alert-info">
	用户发送关键词猜取优惠券
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">是否开启口令玩法</label>
    <div class="col-sm-9 col-xs-12" >
          <?php if( ce('sale.coupon' ,$item) ) { ?>
        <label class="radio-inline">
            <input type="radio" name="pwdopen" value="0" <?php  if($item['pwdopen'] == 0) { ?>checked="true"<?php  } ?> onclick="$('.couponkey').hide()"  /> 关闭
        </label>
		          <label class="radio-inline">
            <input type="radio" name="pwdopen" value="1" <?php  if($item['pwdopen'] == 1) { ?>checked="true"<?php  } ?> onclick="$('.couponkey').show()"  /> 开启
        </label>
          <?php  } else { ?> 
	 <div class='form-control-static'>
             <?php  if($item['pwdopen']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?>
          </div>
          <?php  } ?>
    </div>
</div>
		
	<div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">开始活动关键词</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <input type="text" name="pwdkey2" class="form-control" value="<?php  echo $item['pwdkey2'];?>"  />
		  <span class="help-block">从平台获取优惠券的回复关键词,如果设置关键词为空，则不使用口令玩法，如果更换关键词，则表示开启另一轮活动</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $item['pwdkey'];?></div>
                    <?php  } ?>
                </div>
            </div>
 	 <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">口令集</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                      <textarea name="pwdwords" class='form-control'><?php  echo $item['pwdwords'];?></textarea>
		  <span class="help-block">可以多个口令, 用半角逗号隔开,口令不要与其他系统关键词重复</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $item['pwdwords'];?></div>
                    <?php  } ?>
                </div>
            </div>
		
	     <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">每人猜测机会</label>
                <div class="col-sm-9 col-xs-12">
                     <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <input name="pwdtimes" class='form-control' value='<?php  echo $item['pwdtimes'];?>'>
			<span class="help-block">每人机会，空或0为不限制 </span>
                       <?php  } else { ?>
                      <div class='form-control-static'><?php  if(empty($item['pwdtimes'])) { ?>不限制<?php  } else { ?><?php  echo $item['pwdtimes'];?>次<?php  } ?></div>
					  
                    <?php  } ?>
                </div>
            </div>
	     <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">提示语</label>
                <div class="col-sm-9 col-xs-12">
                     <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <textarea name="pwdask" class='form-control'><?php  echo $item['pwdask'];?></textarea>
			<span class="help-block">默认: 请输入优惠券口令: </span>
			<span class='help-block'>变量: [nickname] 会员昵称 [couponname] 优惠券名称 [times] 已猜测次数 [lasttimes] 剩余猜测次数</span>
                       <?php  } else { ?>
                      <div class='form-control-static'><?php  if(empty($item['pwdask'])) { ?>请输入优惠券口令:<?php  } else { ?><?php  echo $item['pwdask'];?><?php  } ?></div>
					  
                    <?php  } ?>
                </div>
            </div>
	
	   <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">猜中提示语</label>
                <div class="col-sm-9 col-xs-12">
                     <?php if( ce('sale.coupon' ,$item) ) { ?>
                       <textarea name="pwdsuc" class='form-control'><?php  echo $item['pwdsuc'];?></textarea>
		     <span class="help-block">默认: 恭喜你，猜中啦！优惠券已发到您账户了!</span>
			 <span class='help-block'>变量: [nickname] 会员昵称 [couponname] 优惠券名称 [times] 已猜测次数 [lasttimes] 剩余猜测次数</span>
                       <?php  } else { ?>
                      <div class='form-control-static'><?php  if(empty($item['pwdsuc'])) { ?>恭喜你，猜中啦！优惠券已发到您账户了!<?php  } else { ?><?php  echo $item['pwdsuc'];?><?php  } ?></div>
					  
                    <?php  } ?>
                </div>
            </div>
	
	  <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">猜错提示语</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <textarea name="pwdfail" class='form-control'><?php  echo $item['pwdfail'];?></textarea>
		  <span class='help-block'>默认: 很抱歉，您猜错啦，继续猜~</span>
		  <span class='help-block'>变量: [nickname] 会员昵称 [couponname] 优惠券名称 [times] 已猜测次数 [lasttimes] 剩余猜测次数</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  if(empty($item['pwdfail'])) { ?>很抱歉，您猜错啦，继续猜~<?php  } else { ?><?php  echo $item['pwdfail'];?><?php  } ?></div>
		  
                    <?php  } ?> 
                </div>
            </div>	
	   <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">猜测次数超出限制提示</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                     <textarea name="pwdfull" class='form-control'><?php  echo $item['pwdfull'];?></textarea>
		  <span class='help-block'>默认: 很抱歉，您已经没有机会啦~</span>
		  <span class='help-block'>变量: [nickname] 会员昵称 [couponname] 优惠券名称 [times] 已猜测次数 [lasttimes] 剩余猜测次数</span>
                    <?php  } else { ?> 
                    <div class='form-control-static'><?php  if(empty($item['pwdfull'])) { ?>很抱歉，您已经没有机会啦~<?php  } else { ?><?php  echo $item['pwdfull'];?><?php  } ?></div>
                    <?php  } ?>
                </div>
            </div>	
	     <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">退出口令</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <input type="text" name="pwdexit" class="form-control" value="<?php  echo $item['pwdexit'];?>"  />
		  <span class="help-block">如果设置有次数限制，用户继续猜了，可输入退出口令，默认为0</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $item['pwdexit'];?></div>
                    <?php  } ?>
                </div>
            </div>
		   <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">退出后提示</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                     <textarea name="pwdexitstr" class='form-control'><?php  echo $item['pwdexitstr'];?></textarea>
		   <span class='help-block'>默认: 好的，等待您下次来玩!</span>
		  <span class='help-block'>变量: [nickname] 会员昵称 [couponname] 优惠券名称 [times] 已猜测次数 [lasttimes] 剩余猜测次数</span>
		  
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  if(empty($item['pwdexitstr'])) { ?>很好的，等待您下次来玩!<?php  } else { ?><?php  echo $item['pwdexitstr'];?><?php  } ?></div>
                    <?php  } ?>
                </div>
            </div>
		
	  <div class="form-group couponkey" <?php  if(empty($item['pwdopen'])) { ?>style="display:none"<?php  } ?>>
                <label class="col-sm-2 control-label">已获得提示</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                     <textarea name="pwdown" class='form-control'><?php  echo $item['pwdown'];?></textarea>
		  <span class='help-block'>默认: 您已经参加过啦,等待下次活动吧~</span>
		  <span class='help-block'>变量: [nickname] 会员昵称 [couponname] 优惠券名称 [times] 已猜测次数 [lasttimes] 剩余猜测次数</span>
                    <?php  } else { ?> 
                    <div class='form-control-static'><?php  if(empty($item['pwdown'])) { ?>您已经参加过啦,等待下次活动吧~<?php  } else { ?><?php  echo $item['pwdown'];?><?php  } ?></div>
                    <?php  } ?>
                </div>
            </div>	 