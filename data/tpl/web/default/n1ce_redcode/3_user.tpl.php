<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<a href="<?php  echo $this->createWebUrl('userpost')?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="导出"><i class="fa fa-times"></i> 导出领取成功记录</a>
<a href="<?php  echo $this->createWebUrl('userdelete')?>" onclick="return confirm('确认清空吗，清空后，不可恢复？');return false;" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="清空"><i class="fa fa-times"></i> 清空领取记录</a>
<div class="main">
	<div class="category">
	<div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="150">粉丝标识</th>
                            <th width="100">奖品</th>
							<th width="150">红包金额</th>
							<th width="150">对应卡密</th>
                            <th width="150">领取时间</th>
							<th width="150">领取状态</th>
                            <th width="150">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <tr>
							
							
                            <td><?php  echo $row['nickname'];?></td>
							
                            <td><?php  echo $row['name']?></td>
							<td><?php  echo $row['money']/100?>元</td>
							<td>
                                <?php  echo $row['code'];?>
                            </td>
                            <td><?php  echo date('Y-m-d H:i:s',$row['time'])?></td>
							<td>
                                <?php  if($row['status'] == 1) { ?>
                                    <span class="label label-success">领取成功</span>
                                <?php  } else if($row['status'] == 3) { ?>
                                    <span class="label label-success">待领取</span>
								<?php  } else { ?>
									<span class="label label-danger">领取失败</span>
                                <?php  } ?>
                            </td>
                            <td>
                                <?php  if($row['status'] == 1) { ?>
                                    <span class="label label-success">无需操作</span>
                                <?php  } else if($_W['account']['level'] < 4) { ?>
                                    <a href="<?php  echo $this->createWebUrl('sendred', array('op' => 'send', 'id' => $row['id'],'openid' => $row['bopenid'],'money' => $row['money']))?>" onclick="return confirm('确认发送吗，发送后，无法撤回？');return false;" title="手动发送"><span class="label label-danger">点击发送红包</span></a>
								<?php  } else { ?>
									<a href="<?php  echo $this->createWebUrl('sendred', array('op' => 'send', 'id' => $row['id'],'openid' => $row['openid'],'money' => $row['money']))?>" onclick="return confirm('确认发送吗，发送后，无法撤回？');return false;" title="手动发送"><span class="label label-danger">点击发送红包</span></a>
                                <?php  } ?>
                            </td>
                        </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
	</div>

</div>
<?php  echo $pager;?>
		
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>