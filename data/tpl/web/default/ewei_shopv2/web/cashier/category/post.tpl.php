<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
	<span class='pull-right'>
		<?php if(cv('cashier.category.add')) { ?>
			<a class="btn btn-primary btn-sm" href="<?php  echo webUrl('cashier/category/add')?>">添加新收银台分类</a>
		<?php  } ?>
		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('cashier/category')?>">返回列表</a>
	</span>
	<h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>收银台分组 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['catename'];?>】<?php  } ?></small></h2>
</div>

<form <?php if( ce('cashier.category' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />

<div class="form-group">
	<label class="col-sm-2 control-label">排序</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('cashier.category' ,$item) ) { ?>
		<input type="text" name="displayorder" id="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
		<span class='help-block'>数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
		<?php  } else { ?>
		<div class='form-control-static'><?php  echo $item['displayorder'];?></div>
		<?php  } ?>
	</div>
</div>

 <div class="form-group">
	<label class="col-sm-2 control-label must">分类名称</label>
	<div class="col-sm-9 col-xs-12 ">
		<?php if( ce('cashier.category' ,$item) ) { ?>
		<input type="text" id='catename' name="catename" class="form-control" value="<?php  echo $item['catename'];?>" data-rule-required="true" />
		<?php  } else { ?>
		<div class='form-control-static'><?php  echo $item['catename'];?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">是否显示</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('cashier.category' ,$item) ) { ?>
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
		<?php if( ce('cashier.category' ,$item) ) { ?>
		<input type="submit" value="提交" class="btn btn-primary"  />
		<?php  } ?>
		<input type="button" name="back" onclick='history.back()' <?php if(cv('cashier.category.add|cashier.category.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
	</div>
</div>

</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>