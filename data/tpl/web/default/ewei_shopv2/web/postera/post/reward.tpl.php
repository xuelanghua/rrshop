<?php defined('IN_IA') or exit('Access Denied');?> 
<div class="form-group">
    <label class="col-sm-2 control-label">推荐人获得</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <div class="input-group">
            <input type="text" name="reccredit" class="form-control" value="<?php  echo $item['reccredit'];?>" />
            <div class="input-group-addon">积分</div>
            <input type="text" name="recmoney" class="form-control" value="<?php  echo $item['recmoney'];?>" />
            <div class="input-group-addon">元现金</div>
            
        </div>
        <?php  } else { ?> 
        <div class='form-control-static'>
            <?php  if(!empty($item['recredit'])) { ?><?php  echo $item['reccredit'];?> 积分; <?php  } ?>
            <?php  if(!empty($item['recmoney'])) { ?><?php  echo $item['recmoney'];?> 元现金; <?php  } ?>
            
        </div> 
        <?php  } ?>
    </div>
</div>

	<?php  if($plugin_coupon) { ?>
	
		<div class="form-group">
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<?php if( ce('postera' ,$item) ) { ?>
					<div class="input-group recgroup">
						<div class='input-group-btn '>
			                <?php echo tpl_selector('reccouponid',array(
			                'preview'=>false, 
			                'callback'=>'select_coupon', 
			                'input'=>false,
			                'url'=>webUrl('sale/coupon/query'),
			                'items'=>$reccoupon,
			                'placeholder'=>'优惠券名称',
			                'buttontext'=>!empty($reccoupon)?"赠送优惠券: [". $reccoupon['id']."]".$reccoupon['couponname']:"选择优惠券"))
			                ?>
						</div>
						<input type="text" name="reccouponnum" class="form-control" value="<?php  echo $item['reccouponnum'];?>" />
						<div class="input-group-addon">张</div>
						<div class='input-group-btn'>
							<button type='button' onclick='removeCoupon("rec")'  class='btn btn-default' style='border-radius:0'><i class="fa fa-remove"></i></button>
						</div>
					</div>
				<?php  } else { ?>
					<?php  if(!empty($reccoupon)) { ?>
				        <div class='form-control-static'>
				        	优惠券 [<?php  echo $reccoupon['id'];?>]<?php  echo $reccoupon['couponname'];?> <?php  echo $item['reccouponnum'];?> 张
				        </div>
			        <?php  } ?>
			    <?php  } ?>
			</div>
		</div>
    <?php  } ?>

<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <div class="input-group">
            <div class="input-group-addon">每月最多</div>
            <input type="text" name="reccredit_totle" class="form-control" value="<?php  echo $item['reccredit_totle'];?>" />
            <div class="input-group-addon">积分&nbsp;&nbsp;&nbsp;每月最多</div>
            <input type="text" name="recmoney_totle" class="form-control" value="<?php  echo $item['recmoney_totle'];?>" />
            <div class="input-group-addon">元现金<?php  if($plugin_coupon) { ?>&nbsp;&nbsp;&nbsp;最多可获<?php  } ?></div>
            <?php  if($plugin_coupon) { ?>
            <input type="text" name="reccouponnum_totle" class="form-control" value="<?php  echo $item['reccouponnum_totle'];?>" />
            <div class="input-group-addon">张优惠券</div>
            <?php  } ?>
        </div>
        <div class="help-block">设置每月上限获得积分和现金数,默认0为不限制</div>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(!empty($item['recredit'])) { ?>每月最多 <?php  echo $item['reccredit_totle'];?> 积分; <?php  } ?>
            <?php  if(!empty($item['recmoney'])) { ?>每月最多 <?php  echo $item['recmoney_totle'];?> 元现金; <?php  } ?>
            <?php  if($plugin_coupon) { ?>
            <?php  if(!empty($item['recmoney'])) { ?>每月最多 <?php  echo $item['reccouponnum_totle'];?> 张优惠券; <?php  } ?>
            <?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">关注者获得</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>

        <div class="input-group">
            <input type="text" name="subcredit" class="form-control" value="<?php  echo $item['subcredit'];?>" />
            <div class="input-group-addon">积分</div>
            <input type="text" name="submoney" class="form-control" value="<?php  echo $item['submoney'];?>" />
            <div class="input-group-addon">元现金</div>
           
        </div>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(!empty($item['subcredit'])) { ?><?php  echo $item['subcredit'];?> 积分; <?php  } ?>
            <?php  if(!empty($item['submoney'])) { ?><?php  echo $item['submoney'];?> 元现金; <?php  } ?>
           
        </div>
        <?php  } ?>
    </div>
</div>
            <?php  if($plugin_coupon) { ?>
         <div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <div class="input-group subgroup">
     
            <div class='input-group-btn '>
                <?php echo tpl_selector('subcouponid',array(
                'preview'=>false, 
                'callback'=>'select_coupon', 
                'input'=>false,
                'url'=>webUrl('sale/coupon/query',array('op'=>'query')),
                'items'=>$subcoupon,
                'placeholder'=>'优惠券名称',
                'buttontext'=>!empty($subcoupon)?"赠送优惠券: [". $subcoupon['id']."]".$subcoupon['couponname']:"选择优惠券"))
                ?>
            </div>
            <input type="text" name="subcouponnum" class="form-control" value="<?php  echo $item['subcouponnum'];?>" />
            <div class="input-group-addon">张</div>
            <div class='input-group-btn'>
                <button type='button' onclick='removeCoupon("sub")'  class='btn btn-default' style='border-radius:0'><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <?php  } else { ?>
	        <?php  if(!empty($subcoupon)) { ?>
		        <div class='form-control-static'>
		            优惠券 [<?php  echo $subcoupon['id'];?>]<?php  echo $subcoupon['couponname'];?> <?php  echo $item['subcouponnum'];?> 张
		        </div>
	        <?php  } ?>
        <?php  } ?>
    </div>
</div>
         <?php  } ?>
<div class="form-group">
    <label class="col-sm-2 control-label">奖励现金方式</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <label class="radio-inline">
            <input type="radio" name="paytype" value="0" <?php  if(empty($item['paytype'])) { ?>checked<?php  } ?> /> 余额
        </label>

        <label class="radio-inline">
            <input type="radio" name="paytype" value="1" <?php  if($item['paytype']==1) { ?>checked<?php  } ?> /> 微信钱包
        </label>
        <span class='help-block'>如果奖励现金，选择微信钱包( 打到零钱包需要微信支付，并在后台上传证书)</span>
        <?php  } else { ?>
        	<div class='form-control-static'><?php  if(empty($item['paytype'])) { ?>余额<?php  } else { ?>微信钱包<?php  } ?></div>
        <?php  } ?>
    </div> 
</div>
         <script language="javascript">
         <?php  if($plugin_coupon) { ?>
              
                function removeCoupon(type){
                      $(":input[name=" + type + "couponid]").val('');
                      $("."+type + "group").find('button:first').html('选择优惠券');
                }
   
    function select_coupon(o,obj) {
         
         
         var type = $(obj).closest('.content').data('name')=='reccouponid'?'rec':'sub';
         $("."+type + "group").find('button:first').html( "赠送优惠券: [" + o.id + "]" + o.couponname );
         
    }
<?php  } ?>
	
    </script>