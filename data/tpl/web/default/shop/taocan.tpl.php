<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active">套餐绑定</li>
</ol>
<style type="text/css">
    .panel-body > ul{list-style:none;margin: 0px;padding: 0px}
    .panel-body > ul li{display: inline-block}
</style>
<div class="clearfix">
	<form action="<?php  echo url('shop/taocan');?>" method="post" class="form-horizontal" role="form">
		<div class="panel panel-default">
			<div class="panel-heading">套餐绑定</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">基础套餐</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<select name="jichuid" id="jichuid" class="form-control">
							<?php  if(is_array($usersgroup)) { foreach($usersgroup as $group) { ?>
							<option value="<?php  echo $group['id'];?>" <?php  if($_W['setting']['taocan']['jichuid'] == $group['id']) { ?>selected<?php  } ?>><?php  echo $group['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">商业套餐</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<select name="shangyeid" id="shangyeid" class="form-control">
							<?php  if(is_array($usersgroup)) { foreach($usersgroup as $group) { ?>
							<option value="<?php  echo $group['id'];?>" <?php  if($_W['setting']['taocan']['shangyeid'] == $group['id']) { ?>selected<?php  } ?>><?php  echo $group['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">行业套餐</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<select name="hangyeid" id="hangyeid" class="form-control">
							<?php  if(is_array($usersgroup)) { foreach($usersgroup as $group) { ?>
							<option value="<?php  echo $group['id'];?>" <?php  if($_W['setting']['taocan']['hangyeid'] == $group['id']) { ?>selected<?php  } ?>><?php  echo $group['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">至尊套餐</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<select name="zhizunid" id="zhizunid" class="form-control">
							<?php  if(is_array($usersgroup)) { foreach($usersgroup as $group) { ?>
							<option value="<?php  echo $group['id'];?>" <?php  if($_W['setting']['taocan']['zhizunid'] == $group['id']) { ?>selected<?php  } ?>><?php  echo $group['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-8 col-lg-9 col-xs-12">
				<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>