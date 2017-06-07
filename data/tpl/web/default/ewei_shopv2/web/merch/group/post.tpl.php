<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
	<span class='pull-right'>
		<?php if(cv('merch.group.add')) { ?>
			<a class="btn btn-primary btn-sm" href="<?php  echo webUrl('merch/group/add')?>">添加新商户分组</a>
		<?php  } ?>
		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('merch/group')?>">返回列表</a>
	</span>
	<h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>商户分组 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['groupname'];?>】<?php  } ?></small></h2>
</div>

<form <?php if( ce('merch.group' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
 <div class="form-group">
	<label class="col-sm-2 control-label must">分组名称</label>
	<div class="col-sm-9 col-xs-12 ">
		<?php if( ce('merch.group' ,$item) ) { ?>
		<input type="text" id='groupname' name="groupname" class="form-control" value="<?php  echo $item['groupname'];?>" data-rule-required="true" />
		<?php  } else { ?>
		<div class='form-control-static'><?php  echo $item['groupname'];?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group-title">权限</div>

<div class="form-group">
	<label class="col-sm-2 control-label">商品免审核</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('merch.group' ,$item) ) { ?>
		<label class='radio-inline'>
			<input type='radio' name='goodschecked' value=1' <?php  if($item['goodschecked']==1) { ?>checked<?php  } ?> /> 是
		</label>
		<label class='radio-inline'>
			<input type='radio' name='goodschecked' value=0' <?php  if($item['goodschecked']==0) { ?>checked<?php  } ?> /> 否
		</label>
		<span class="help-block">商户添加的商品是否免审核</span>
		<?php  } else { ?>
		<div class='form-control-static'><?php  if(empty($item['goodschecked'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">设置商品佣金</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('merch.group' ,$item) ) { ?>
        <label class='radio-inline'>
            <input type='radio' name='commissionchecked' value=1' <?php  if($item['commissionchecked']==1) { ?>checked<?php  } ?> /> 是
        </label>
        <label class='radio-inline'>
            <input type='radio' name='commissionchecked' value=0' <?php  if($item['commissionchecked']==0) { ?>checked<?php  } ?> /> 否
        </label>
        <span class="help-block">商户添加的商品是否可以设置商品佣金</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['commissionchecked'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">修改订单价格</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('merch.group' ,$item) ) { ?>
        <label class='radio-inline'>
            <input type='radio' name='changepricechecked' value=1' <?php  if($item['changepricechecked']==1) { ?>checked<?php  } ?> /> 是
        </label>
        <label class='radio-inline'>
            <input type='radio' name='changepricechecked' value=0' <?php  if($item['changepricechecked']==0) { ?>checked<?php  } ?> /> 否
        </label>
        <span class="help-block">商户是否可以修改订单价格</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['changepricechecked'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">订单确认收货</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('merch.group' ,$item) ) { ?>
        <label class='radio-inline'>
            <input type='radio' name='finishchecked' value=1' <?php  if($item['finishchecked']==1) { ?>checked<?php  } ?> /> 是
        </label>
        <label class='radio-inline'>
            <input type='radio' name='finishchecked' value=0' <?php  if($item['finishchecked']==0) { ?>checked<?php  } ?> /> 否
        </label>
        <span class="help-block">商户是否可以在后台点击确认收货</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['finishchecked'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group-title">其他</div>

<div class="form-group">
	<label class="col-sm-2 control-label">是否默认分组</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('merch.group' ,$item) ) { ?>
		<label class='radio-inline'>
			<input type='radio' name='isdefault' value='1' <?php  if($item['isdefault']==1) { ?>checked<?php  } ?> /> 是
		</label>
		<label class='radio-inline'>
			<input type='radio' name='isdefault' value='0' <?php  if($item['isdefault']==0) { ?>checked<?php  } ?> /> 否
		</label>
		<span class="help-block">商户入驻后默认的分组</span>
		<?php  } else { ?>
		<div class='form-control-static'><?php  if(empty($item['isdefault'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">状态</label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('merch.group' ,$item) ) { ?>
		<label class='radio-inline'>
			<input type='radio' name='status' value=1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 启用
		</label>
		<label class='radio-inline'>
			<input type='radio' name='status' value=0' <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 禁用
		</label>
		<?php  } else { ?>
		<div class='form-control-static'><?php  if(empty($item['status'])) { ?>禁用<?php  } else { ?>启用<?php  } ?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label"></label>
	<div class="col-sm-9 col-xs-12">
		<?php if( ce('merch.group' ,$item) ) { ?>
		<input type="submit" value="提交" class="btn btn-primary"  />
		<?php  } ?>
		<input type="button" name="back" onclick='history.back()' <?php if(cv('merch.group.add|merch.group.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
	</div>
</div>

</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>