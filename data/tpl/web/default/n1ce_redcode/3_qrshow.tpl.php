<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<div class="panel panel-default">
		<div class="table-responsive panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:100px;">过期时间</th>
					<th style="width:100px;">场景ID<i></i></th>
					<th style="width:80px;">二维码</th>
					<th style="width:100px;">生成时间</th>
					<th style="width:100px">到期时间</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
				<tr>
					<td><?php  echo $row['expire'];?></td>
					<td><?php  echo $row['qrcid'];?></td>
					<td><a href="<?php  echo $row['showurl'];?>" target="_blank">查看</a></td>
					<td style="font-size:12px; color:#666;">
					<?php  echo date('Y-m-d <br /> h:i:s', $row['createtime']);?>
					</td>
					<td style="font-size:12px; color:#666;">
					<?php  echo $row['endtime'];?>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<?php  echo $pager;?>
		</div>
	</div>
<script type="text/javascript">
	require(['bootstrap'],function($){
		$('.btn').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>