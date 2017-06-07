<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active">公众号回收站</li>
</ol>
<ul class="nav nav-tabs">
	<li <?php  if($do == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo url('account/recycle');?>">公众号列表</a></li>
</ul>
<?php  if($do == 'display') { ?>
<?php  if(empty($del_accounts)) { ?>
<div class="alert alert-info">没有已删除的公众号</div>
<?php  } else { ?>
<form action="<?php  echo url('account/recycle/post')?>" method="post">
<?php  if(is_array($del_accounts)) { foreach($del_accounts as $account) { ?>
	<div class="panel panel-default">
		<div class="clearfix table-responsive panel-body">
			<table class="table">
				<tr><th><?php  echo $account['name'];?></th></tr>
				<?php  if(is_array($account['del_accounts'])) { foreach($account['del_accounts'] as $acid => $del_account) { ?>
				<tr>
					<td style="width:180px;"><image src="<?php  echo tomedia('headimg_'.$acid.'.jpg');?>?time=<?php  echo time()?>" width="50" height="50"/></td>
					<td style="width:10%;"><?php  echo $del_account['name'];?></td>
					<td><span class="pull-right">
						<?php  if(!$account['is_uniacid']) { ?>
						<a href="<?php  echo url('account/recycle/post', array('op' => 'recover','acid' => $acid))?>" class="btn btn-success">恢复</a>
						<a href="<?php  echo url('account/recycle/post', array('op' => 'delete', 'acid' => $acid))?>" class="btn btn-danger" onclick="return confirm('确认删除公众号吗，此操作不可恢复');">删除公众号</a>
						<?php  } ?>
					</span></td>
				</tr>
				<?php  } } ?>
				<?php  if($account['is_uniacid']) { ?>
				<tr>
					<td colspan="2"></td>
					<td><span class="pull-right">
						<a href="<?php  echo url('account/recycle/post', array('op' => 'recover','uniacid' => $account['uniacid'], 'acid' => $account['default_acid']))?>" class="btn btn-success"><span text>恢复</span></a>
						<a href="<?php  echo url('account/recycle/post', array('op' => 'delete', 'uniacid' => $account['uniacid'], 'acid' => $account['default_acid']))?>" class="btn btn-danger" onclick="return confirm('确认删除公众号吗，此操作不可恢复');">删除公众号</a>
					</span></td>
				</tr>
				<?php  } ?>
			</table>
		</div>
	</div>
<?php  } } ?>
</form>
<div style="text-align: center"><?php  echo $pager;?></div>
<?php  } ?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>