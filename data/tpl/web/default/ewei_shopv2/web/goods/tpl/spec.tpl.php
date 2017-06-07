<?php defined('IN_IA') or exit('Access Denied');?>     <div class='spec_item' id='spec_<?php  echo $spec['id'];?>' >
         <div style='border:1px solid #e7eaec;padding:10px;margin-bottom: 10px;' >
	<input name="spec_id[]" type="hidden" class="form-control spec_id" value="<?php  echo $spec['id'];?>"/>
	<div class="form-group">
	<div class="col-sm-12">
            <?php if( ce('goods' ,$item) ) { ?>
			<div class='input-group'>
			<input name="spec_title[<?php  echo $spec['id'];?>]" type="text" class="form-control  spec_title" value="<?php  echo $spec['title'];?>" placeholder="规格名称 (比如: 颜色)"/>
			<div class='input-group-btn'>
			<a href="javascript:;" id="add-specitem-<?php  echo $spec['id'];?>" specid='<?php  echo $spec['id'];?>' class='btn btn-info add-specitem' onclick="addSpecItem('<?php  echo $spec['id'];?>')"><i class="fa fa-plus"></i> 添加规格项</a>
			<a href="javascript:void(0);" class='btn btn-danger' onclick="removeSpec('<?php  echo $spec['id'];?>')"><i class="fa fa-remove"></i></a>
			</div>
			</div>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $spec['title'];?></div>
                        <?php  } ?>
		</div>
	</div>
	<div class="form-group">
	<div class="col-md-12">
			<div id='spec_item_<?php  echo $spec['id'];?>' class='spec_item_items'>
			<?php  if(is_array($spec['items'])) { foreach($spec['items'] as $specitem) { ?>
			     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tpl/spec_item', TEMPLATE_INCLUDEPATH)) : (include template('goods/tpl/spec_item', TEMPLATE_INCLUDEPATH));?>
			<?php  } } ?>
			</div>
		</div>
	</div>  
   </div> 
</div>