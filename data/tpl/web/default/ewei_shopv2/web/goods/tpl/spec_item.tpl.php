<?php defined('IN_IA') or exit('Access Denied');?><?php if( ce('goods' ,$item) ) { ?>
<div class="spec_item_item" style="float:left;margin:5px;width:250px; position: relative">
	<input type="hidden" class="form-control spec_item_show" name="spec_item_show_<?php  echo $spec['id'];?>[]" value="<?php  echo $specitem['show'];?>" />
	<input type="hidden" class="form-control spec_item_id" name="spec_item_id_<?php  echo $spec['id'];?>[]" value="<?php  echo $specitem['id'];?>" />
	
	<div class="input-group">
		<span class="input-group-addon">
			<input type="checkbox" <?php  if($specitem['show']==1) { ?>checked<?php  } ?> value="1" onclick='showItem(this)'>
		</span>
		<input type="text" class="form-control spec_item_title" name="spec_item_title_<?php  echo $spec['id'];?>[]" VALUE="<?php  echo $specitem['title'];?>" />
		
		<span class="input-group-addon spec_item_thumb <?php  if(!empty($specitem['thumb'])) { ?>has_thumb<?php  } ?>">
			           <input type='hidden'  name="spec_item_thumb_<?php  echo $spec['id'];?>[]" value="<?php  echo $specitem['thumb'];?>"
						/>
				<img onclick="selectSpecItemImage(this)" onerror="this.src='<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg'" 
					 src="<?php  if(empty($specitem['thumb'])) { ?><?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg<?php  } else { ?><?php  echo tomedia($specitem['thumb'])?><?php  } ?>" style='width:100%;'
					 <?php  if(!empty($specitem['thumb'])) { ?>
							data-toggle='popover'
							data-html ='true'
							data-placement='top'
							data-trigger ='hover'
							data-content="<img src='<?php  echo tomedia($specitem['thumb'])?>' style='width:100px;height:100px;' />"
                                                            <?php  } ?>
					 >
				<i class="fa fa-times-circle" <?php  if(empty($specitem['thumb'])) { ?>style="display:none"<?php  } ?>></i> 
		</span>
		
		<span class="input-group-addon">
			<a href="javascript:;" onclick="removeSpecItem(this)" title='删除'><i class="fa fa-times"></i></a>
	  		<a href="javascript:;" class="fa fa-arrows" title="拖动调整显示顺序" ></a>
		</span>
	</div>
  
                         <div class="input-group choosetemp" style='margin-bottom: 10px;<?php  if($item['type']!=3) { ?>display:none<?php  } ?>'> 
                        <input type="hidden" name="spec_item_virtual_<?php  echo $spec['id'];?>[]" value="<?php  echo $specitem['virtual'];?>" class="form-control spec_item_virtual"  id="temp_id_<?php  echo $specitem['id'];?>">
                        <input type="text" name="spec_item_virtualname_<?php  echo $spec['id'];?>[]" value="<?php  if(empty($specitem['virtual'])) { ?>未选择<?php  } else { ?><?php  echo $specitem['title2'];?><?php  } ?>" class="form-control spec_item_virtualname" readonly="" id="temp_name_<?php  echo $specitem['id'];?>">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="choosetemp('<?php  echo $specitem['id'];?>')">选择虚拟物品</button>
                        </div>
                    </div>
</div>
<?php  } else { ?>
   <div class="multi-item" style='float:left' >
                                    <img class="img-responsive img-thumbnail" src='<?php  echo tomedia($specitem['thumb'])?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                                     <div class='img-nickname'><?php  echo $specitem['title'];?></div>
 </div>
<?php  } ?>


