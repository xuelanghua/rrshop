<?php defined('IN_IA') or exit('Access Denied');?> 
     
	 <div class="form-group">
		<label class="col-sm-2 control-label">购物券优惠券统一使用说明</label>
		<div class="col-sm-9 col-xs-12">
			  <?php if(cv('sale.coupon.set')) { ?>
                                 <?php  echo tpl_ueditor('data[consumedesc]',$data['consumedesc'])?>
			   <span class='help-block'>统一说明会放到购物券单独说明的前面</span>
                            <?php  } else { ?>
                            <textarea id='consumedesc' style='display:none'><?php  echo $data['consumedesc'];?></textarea>
							
                            <a href='javascript:preview_html("#consumedesc")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
		</div>
	</div>
		 
	 <div class="form-group">
		<label class="col-sm-2 control-label">充值优惠券统一使用说明</label>
		<div class="col-sm-9 col-xs-12">
			  <?php if(cv('sale.coupon.set')) { ?>
                            <?php  echo tpl_ueditor('data[rechargedesc]',$data['rechargedesc'])?>
							<span class='help-block'>统一说明会放到充值券单独说明的前面</span>
                            <?php  } else { ?>
                            <textarea id='rechargedesc' style='display:none'><?php  echo $data['rechargedesc'];?></textarea>
                            <a href='javascript:preview_html("#rechargedesc")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
		</div>
	</div>
		 
 

<div class="form-group">
                <label class="col-sm-2 control-label">会员中心开启状态</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sale.coupon.set')) { ?>
					<label class="radio-inline "><input type="radio" name="data[closemember]" value="0" <?php  if($data['closemember']==0) { ?>checked<?php  } ?>> 开启</label>
					<label class="radio-inline"><input type="radio" name="data[closemember]"  value="1" <?php  if($data['closemember']==1) { ?>checked<?php  } ?>> 关闭</label>
					<span class="help-block">是否开启会员中心优惠券</span>
					<?php  } else { ?>
					<div class='form-control-static'>
						<?php  if($data['closemember']==0) { ?>
						开启
						<?php  } else if($data['closemember']==1) { ?>
						关闭
						<?php  } ?>
					</div>
                    <?php  } ?>
                </div>
   </div>				
	<div class="form-group">
                <label class="col-sm-2 control-label">领券中心开启状态</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sale.coupon.set')) { ?>
					<label class="radio-inline "><input type="radio" name="data[closecenter]" value="0" <?php  if($data['closecenter']==0) { ?>checked<?php  } ?>> 开启</label>
					<label class="radio-inline"><input type="radio" name="data[closecenter]"  value="1" <?php  if($data['closecenter']==1) { ?>checked<?php  } ?>> 关闭</label>
					<?php  } else { ?>
					<div class='form-control-static'>
						<?php  if($data['closecenter']==0) { ?>
						开启
						<?php  } else if($data['closecenter']==1) { ?>
						关闭
						<?php  } ?>
					</div>
                    <?php  } ?>
                </div>
			</div>


	 <script type="text/javascript" language="javascript" >
		 function display(num){
			 $("#"+num).show();
		 }

		 function disappear(num){
			 $("#"+num).hide();
		 }
	 </script>


	 <div class="form-group">
		<label class="col-sm-2 control-label">用户推送优惠卷模板</label>
		<div class="col-sm-9 col-xs-12 position-parent">
			<?php if(cv('sale.coupon.set')) { ?>
				 <label class="radio-inline" >
					 <input type="radio" name="data[showtemplate]"  value="1" <?php  if($data['showtemplate'] == 1) { ?>checked="true"<?php  } ?> />
					 <a href="#" onmouseover="display('t1')" onmouseout="disappear('t1')">模板1</a>
				 </label>
				 <label class="radio-inline"'>
					<input type="radio" name="data[showtemplate]" value="2" <?php  if($data['showtemplate'] == 2) { ?>checked="true"<?php  } ?> />
					<a href="#" onmouseover="display('t2')" onmouseout="disappear('t2')">模板2(默认)</a>
				 </label>
			 <?php  } else { ?>
				<div class='form-control-static'>
					 <?php  if($data['showtemplate']==1) { ?>
						模板1
					 <?php  } else { ?>
						模板2(默认)
					 <?php  } ?>
				 </div>
			 <?php  } ?>
			<div id="t1" class="position-t" style="display: none;">
				<img src="<?php  echo $_W['siteroot'];?>addons/ewei_shopv2/static/images/t1.png" width="100%">
			</div>
			<div id="t2" class="position-t" style="display: none;">
				<img src="<?php  echo $_W['siteroot'];?>addons/ewei_shopv2/static/images/t2.png" width="100%">
			</div>
		</div>
	</div>

	 <style type="text/css">
		 .position-parent{position: relative;}
		 .position-t{position: absolute;bottom: 30px;border:1px solid #777;padding:5px;background: #fff;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
		 z-index: 10000;width:300px;}
	 </style>
