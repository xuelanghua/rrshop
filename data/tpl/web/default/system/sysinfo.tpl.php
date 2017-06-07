<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active">系统信息</li>
</ol>
<div class="main">
	<div class="panel panel-info">
		<div class="panel-heading">用户信息</div>
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<tr>
				<th style="width:250px;">用户ID</th>
				<td><?php  echo $info['uid'];?></td>
			</tr>
			<tr>
				<th>当前公众号</th>
				<td><?php  echo $info['account'];?></td>
			</tr>
		</table>
		</div>
	</div>
	
	<div class="panel panel-info">
		<div class="panel-heading">系统信息</div>
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<tr>
				<th style="width:250px;">系统程序版本</th>
				<td>Weizan V9 Release  <?php  echo IMS_RELEASE_DATE;?> &nbsp; &nbsp; <a href="http://www.efwww.com" target="_blank">查看最新版本</a></td>
			</tr>
			<tr>
				<th>产品系列</th>
				<td>
				<?php  if((IMS_FAMILY == 'x') || (IMS_FAMILY == 's')) { ?>
				您的产品是商业版Weizan V9 &nbsp; &nbsp; <a href="<?php  echo url('cloud/up');?>">更新升级</a>
                  <?php  } else { ?>
				您的产品是开源版, 没有购买商业授权, 不能用于商业用途
				<?php  } ?>
				</td>
			</tr>
            			<tr>
				<th>更新记录</th>
				<td>当前已更新至WZ_V98.0版本20170504 &nbsp; &nbsp; <a href="http://www.efwww.com" target="_blank">查看最新版本</a></td>
			</tr>
			<tr>
				<th>服务器系统</th>
				<td><?php  echo $info['os'];?></td>
			</tr>
			<tr>
				<th>PHP版本 </th>
				<td>PHP Version <?php  echo $info['php'];?></td>
			</tr>
			<tr>
				<th>服务器软件</th>
				<td><?php  echo $info['sapi'];?></td>
			</tr>
			<tr>
				<th>服务器 MySQL 版本</th>
				<td><?php  echo $info['mysql']['version'];?></td>
			</tr>
			<tr>
				<th>上传许可</th>
				<td><?php  echo $info['limit'];?></td>
			</tr>
			<tr>
				<th>当前数据库尺寸</th>
				<td><?php  echo $info['mysql']['size'];?></td>
			</tr>
			<tr>
				<th>当前附件根目录</th>
				<td><?php  echo $info['attach']['url'];?></td>
			</tr>
			<tr>
				<th>当前附件尺寸</th>
				<td><?php  echo $info['attach']['size'];?></td>
			</tr>
		</table>
		</div>
	</div>
</div><!---易 福 源 码 网-->
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>
