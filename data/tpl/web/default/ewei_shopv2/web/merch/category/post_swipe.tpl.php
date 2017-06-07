<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
	<span class='pull-right'>
		<?php if(cv('merch.category.swipe.add')) { ?>
			<a class="btn btn-primary btn-sm" href="<?php  echo webUrl('merch/category/add_swipe')?>">添加新商户分类幻灯</a>
		<?php  } ?>
		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('merch/category/swipe')?>">返回列表</a>
	</span>
	<h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>商户分组 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['groupname'];?>】<?php  } ?></small></h2>
</div>

<form <?php if( ce('merch.group' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />

<div class="form-group">
	<label class="col-sm-2 control-label">排序</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('merch.category.swipe' ,$item) ) { ?>
		<input type="text" name="displayorder" id="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
		<span class='help-block'>数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
		<?php  } else { ?>
		<div class='form-control-static'><?php  echo $item['displayorder'];?></div>
		<?php  } ?>
	</div>
</div>

 <div class="form-group">
	<label class="col-sm-2 control-label must">幻灯名称</label>
	<div class="col-sm-9 col-xs-12 ">
		<?php if( ce('merch.category.swipe' ,$item) ) { ?>
		<input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" data-rule-required="true" />
		<?php  } else { ?>
		<div class='form-control-static'><?php  echo $item['title'];?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">幻灯图片</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('merch.category.swipe' ,$item) ) { ?>
		<?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
		<span class="help-block">建议尺寸: 640*360 尺寸图片 </span>
		<?php  } else { ?>
		<?php  if(!empty($item['thumb'])) { ?>
		<a href='<?php  echo tomedia($item['thumb'])?>' target='_blank'>
		<img src="<?php  echo tomedia($item['thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
		</a>
		<?php  } ?>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">是否显示</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('merch.category.swipe' ,$item) ) { ?>
		<label class='radio-inline'>
			<input type='radio' name='status' value='1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 是
		</label>
		<label class='radio-inline'>
			<input type='radio' name='status' value='0' <?php  if(empty($item['status'])) { ?>checked<?php  } ?> /> 否
		</label>
		<?php  } else { ?>
		<div class='form-control-static'><?php  if(empty($item['status'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label"></label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('merch.category.swipe' ,$item) ) { ?>
		<input type="submit" value="提交" class="btn btn-primary"  />
		<?php  } ?>
		<input type="button" name="back" onclick='history.back()' <?php if(cv('merch.category.swipe.add|merch.category.swipe.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
	</div>
</div>

</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>