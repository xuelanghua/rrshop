<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"> <h2>抽奖记录 <small>人数: <span class='text-danger'><?php  echo $total;?></span></small></h2> </div>

<form action="./index.php" method="get" class="form-horizontal table-search"  role="form">
	<input type="hidden" name="c" value="site" />
	<input type="hidden" name="a" value="entry" />
	<input type="hidden" name="m" value="ewei_shopv2" />
	<input type="hidden" name="do" value="web" />
	<input type="hidden" name="r"  value="lottery.log" />
	<input type="hidden" name="id" value="<?php  echo $_GPC['id'];?>" />
	<div class="page-toolbar row m-b-sm m-t-sm">
		<div class="col-sm-5">
			<div class="btn-group btn-group-sm" style='float:left'>
				<button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

			</div> 
			<div class='input-group input-group-sm'   >
				<?php  echo tpl_daterange('time', array('placeholder'=>'抽奖时间'),true);?>
			</div>
		</div>	


		<div class="col-sm-6 pull-right">

			<div class="input-group">
				<input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="昵称/姓名/手机号"> <span class="input-group-btn">

					<button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
			</div>

		</div>
	</div>
</form>


<form action="" method="post" onsubmit="return formcheck(this)">

	<?php  if(count($list)>0) { ?>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th style='width:100px;'>参与人</th>
				<th style='width:100px;'></th>
				<th style='width:120px;'>奖励</th>
				<th>参与时间</th>
				<th>操作</th>
			</tr>
		</thead> 
		<tbody>  
			<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<?php  $row['lottery_data']=unserialize($row['lottery_data']);?>
			<tr>
				<td><span data-toggle='tooltip' title='<?php  echo $row['nickname'];?>'><img src='<?php  echo $row['avatar'];?>' style='width:20px;height:20px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname'];?></span></td>
				<td><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>
				<td  data-toggle="tooltip" title="<?php  if(!empty($row['lottery_data'])) { ?><?php  echo $this->model->lottery_complain($row['lottery_data']);?><?php  } else { ?>无奖励<?php  } ?>"> <?php  if(!empty($row['lottery_data'])) { ?><?php  echo mb_substr($this->model->lottery_complain($row['lottery_data']),0,10,'utf-8');?><?php  } else { ?>无奖励<?php  } ?>
				</td>
				<td><?php  echo date('Y-m-d H:i',$row['addtime']);?></td>
				<td><a class='btn btn-default' href="<?php  echo webUrl('lottery/log',array('id'=>$row['lottery_id'],'keyword'=>$row['nickname']));?>" title='此用户抽奖列表'><i class='fa fa-users'></i></a></td>
			</tr>
			<?php  } } ?>
		</tbody>
	</table>
	<?php  echo $pager;?>
	<?php  } else { ?>
	<div class='panel panel-default'>
		<div class='panel-body' style='text-align: center;padding:30px;'>
			暂时没有任何参与记录!
		</div>
	</div>

	<?php  } ?>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
