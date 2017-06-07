<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
	<span class="pull-right">
		<?php if(cv('lottery.add')) { ?>
		<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('lottery/add',array('lottery_type'=>1))?>"><i class="fa fa-plus"></i> 添加大转盘</a>
		<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('lottery/add',array('lottery_type'=>2))?>"><i class="fa fa-plus"></i> 添加刮刮卡</a>
		<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('lottery/add',array('lottery_type'=>3))?>"><i class="fa fa-plus"></i> 添加九宫格</a>
		<?php  } ?>
	</span>
	<h2>抽奖活动管理 <small>总数: <?php  echo $total;?></small></h2>
</div>

<form action="./index.php" method="get" class="form-horizontal" role="form">
	<input type="hidden" name="c" value="site" />
	<input type="hidden" name="a" value="entry" />
	<input type="hidden" name="m" value="ewei_shopv2" />
	<input type="hidden" name="do" value="web" />
	<input type="hidden" name="r"  value="lottery" />

	<div class="page-toolbar row m-b-sm m-t-sm">
		<div class="col-sm-4">

			<div class="input-group-btn">
				<button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

				<?php if(cv('lottery.delete')) { ?>	
				<button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('lottery/index/delete')?>"><i class='fa fa-trash'></i> 删除</button>
				<?php  } ?>

			</div> 
		</div>	


		<div class="col-sm-6 pull-right">

			<div class="input-group">				 
				<input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">
					<button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
			</div>

		</div>
	</div>
</form>

<?php  if(count($list)>0) { ?>

<form action="" method="post" >


	<table class="table table-hover table-responsive">
		<thead>
			<tr>

				<th style="width:25px;"><input type='checkbox' /></th>
				<th  style='width:150px;'>活动名称</th>
				<th  style='width:150px;'>活动类型</th>
				<th  style='width:80px;'>参与数</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<tr>
				<td>
					<input type='checkbox'   value="<?php  echo $row['lottery_id'];?>"/>
				</td>
				<td><?php  echo $row['lottery_title'];?></td>
				<td><?php  if($row['lottery_type']==1) { ?>大转盘<?php  } else if($row['lottery_type']==2) { ?>刮刮卡<?php  } else if($row['lottery_type']==3) { ?>九宫格<?php  } ?></td>
				<td><?php  echo $row['viewcount'];?></td>

				<td>
					<?php if(cv('lottery.log')) { ?>
					<a class='btn btn-default btn-sm' href="<?php  echo webUrl('lottery/log', array('id' => $row['lottery_id'],'lottery_type'=>$row['lottery_type']))?>"><i class='fa fa-qrcode'></i> 参与记录</a>
					<?php  } ?>

					<?php if(cv('lottery.edit|lottery.view')) { ?>
						<a class='btn btn-default btn-sm' href="<?php  echo webUrl('lottery/edit', array( 'id' => $row['lottery_id'],'lottery_type'=>$row['lottery_type']))?>"><i class='fa fa-edit'></i> <?php if(cv('lottery.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a>
					<?php  } ?>
					<?php if(cv('lottery.delete')) { ?><a class='btn btn-default btn-sm' data-toggle="ajaxRemove"  href="<?php  echo webUrl('lottery/index/delete', array('id' => $row['lottery_id']))?>"  title='删除' data-confirm="确认删除此活动吗？"><i class='fa fa-trash'></i> 删除</a><?php  } ?>
				</td>

			</tr>
			<?php  } } ?>
		</tbody>
	</table>
	<?php  echo $pager;?>    
	<?php  } else { ?>
	<div class='panel panel-default'>
		<div class='panel-body' style='text-align: center;padding:30px;'>
			暂时没有任何活动!
		</div>
	</div>
	<?php  } ?>
</form> 

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
