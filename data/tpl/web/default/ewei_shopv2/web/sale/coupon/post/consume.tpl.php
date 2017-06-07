<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
                <label class="col-sm-2 control-label">优惠方式</label>
                <div class="col-sm-9 col-xs-12">
					<input type="hidden" name="coupontype" value="0"/>
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                     <label class="radio-inline " ><input type="radio" name="backtype" onclick='showbacktype(0)' value="0" <?php  if($item['backtype']==0) { ?>checked<?php  } ?>>立减</label>
                     <label class="radio-inline"><input type="radio" name="backtype" onclick='showbacktype(1)' value="1" <?php  if($item['backtype']==1) { ?>checked<?php  } ?>>打折</label>
                     <label class="radio-inline "><input type="radio" name="backtype" onclick='showbacktype(2)' value="2" <?php  if($item['backtype']==2) { ?>checked<?php  } ?>>返利</label>
                       <?php  } else { ?>
                      <div class='form-control-static'>
						  <?php  if($item['backtype']==0) { ?>
						  立减
						  <?php  } else if($item['backtype']==1) { ?>
						  打折
						  <?php  } else { ?>
						  返利
						  <?php  } ?>
					  </div>
                    <?php  } ?>
                </div>
 </div>
<div class="form-group">
                <label class="col-sm-2 control-label"></label>
                
                    <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <div class="col-sm-9 col-xs-12 backtype backtype0" <?php  if($item['backtype']!=0) { ?>style='display:none'<?php  } ?>>
                    <div class='input-group'>
                        <span class='input-group-addon'>立减</span>
                        <input type='text' class='form-control' name='deduct' value="<?php  echo $item['deduct'];?>"/>
                        <span class='input-group-addon'>元</span>
                     </div>
                        </div>
					
                     <div class="col-sm-9 col-xs-12 backtype backtype1"  <?php  if($item['backtype']!=1) { ?>style='display:none'<?php  } ?>>
                    <div class='input-group'>
                        <span class='input-group-addon'>打</span>
                        <input type='text' class='form-control' name='discount'  placeholder='0.1-10' value="<?php  echo $item['discount'];?>"/>
                        <span class='input-group-addon'>折</span>
                     </div>   </div>
                     <div class="col-sm-9 col-xs-12 backtype backtype2"  <?php  if($item['backtype']!=2) { ?>style='display:none'<?php  } ?>>
                    <div class='input-group'>
                        <span class='input-group-addon'>返</span>
                        <input type='text' class='form-control' name='backmoney' value="<?php  echo $item['backmoney'];?>"/>
                        <span class='input-group-addon'>余额 返</span>
                        <input type='text' class='form-control' name='backcredit' value="<?php  echo $item['backcredit'];?>"/>
                        <span class='input-group-addon'>积分 返</span>
                        <input type='text' class='form-control'  name='backredpack'  value="<?php  echo $item['backredpack'];?>"/>
                        <span class='input-group-addon'>现金</span>
                     </div>   
                    　<span class='help-block'>带%为返消费金额的百分比: 如10% ，消费200元，返20元，反现金，需要商户平台有钱，并需要上传微信证书</span>
               </div>
	
                  
                       <?php  } else { ?>
                      <div class='form-control-static'>
						  <?php  if($item['backtype']==0) { ?>
						  立减 <?php  echo $item['deduct'];?> 元
						  <?php  } else if($item['backtype']==1) { ?>
						  打 <?php  echo $item['discount'];?> 折
						  <?php  } else if($item['backtype']==2) { ?>
						  <?php  if($item['backmoney']>0) { ?>返 <?php  echo $item['backmoney'];?> 余额;<?php  } ?>
						  <?php  if($item['backcredit']>0) { ?>返 <?php  echo $item['backcredit'];?> 积分;<?php  } ?>
						  <?php  if($item['backredpack']>0) { ?>返 <?php  echo $item['backredpack'];?> 现金;<?php  } ?>
						  <?php  } ?>
					  </div>
                    <?php  } ?>
                </div>
 
           				
		  <div class="form-group backtype backtype2"  <?php  if($item['backtype']!=2) { ?>style='display:none'<?php  } ?>>
			   <label class="col-sm-2 control-label">返利方式</label>
			  <div class="col-sm-9 col-xs-12" >
				        <?php if( ce('sale.coupon' ,$item) ) { ?>
				   <label class="radio-inline" >
					<input type="radio" name="backwhen" value="0" <?php  if($item['backwhen'] == 0) { ?>checked="true"<?php  } ?> /> 交易完成后（过退款期限自动返利）
				</label>
			   
                         <label class="radio-inline"'>
					<input type="radio" name="backwhen" value="1" <?php  if($item['backwhen'] == 1) { ?>checked="true"<?php  } ?> /> 订单完成后（收货后）
				</label>
						  <label   class="radio-inline" >
					<input type="radio" name="backwhen" value="2" <?php  if($item['backwhen'] == 2) { ?>checked="true"<?php  } ?>  /> 订单付款后
				</label>
						<?php  } else { ?>
						
						<div class='form-control-static'>
						  <?php  if($item['backwhen']==0) { ?>
						  交易完成后（过退款期限自动返利）
						  <?php  } else if($item['backwhen']==1) { ?>
						 订单完成后（收货后）
						  <?php  } else { ?>
						  订单付款后
						  <?php  } ?>
					  </div>
						<?php  } ?>
			  </div>
                    </div>
