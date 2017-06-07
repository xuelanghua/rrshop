<?php defined('IN_IA') or exit('Access Denied');?><?php  $no_left=true?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<form action="./cashier.php" method="get" class="form-horizontal table-search" role="form" style="margin:20px 100px;">
    <div class="panel panel-default panel-class">
        <div class="panel-heading">
             <span class="pull-right">
        <a class="btn btn-sm" href="<?php  echo cashierUrl('clearing/add');?>"><i class="fa fa-plus"></i> 申请提现</a>
	</span>
            提现申请
        </div>

    <div class="panel-body">

        <input type="hidden" name="i" value="<?php  echo $_GPC['i'];?>" />
        <input type="hidden" name="r" value="clearing" />
        <div class="page-toolbar row m-b-sm m-t-sm">
            <div class="col-sm-5">
                <div class="btn-group btn-group-sm" style='float:left'>
                    <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                </div>
                <?php  echo tpl_daterange('time', array('sm'=>true,'placeholder'=>'按结算时间查询'),true);?>
            </div>
            <div class="col-sm-6 pull-right">
                <select name='status'  class='form-control  input-sm select-md'   style="width:120px;">
                    <option value='' <?php  if($_GPC['status']=='') { ?>selected<?php  } ?>>结算状态</option>
                    <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>未结算</option>
                    <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?>>结算中</option>
                    <option value='2' <?php  if($_GPC['status']=='2') { ?>selected<?php  } ?>>已结算</option>
                </select>
                <div class="input-group">
                    <input type="text" class="form-control input-sm" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="可搜索收银台名称/姓名/手机号/完整编号"/>
                    <span class="input-group-btn">
                     <button class="btn btn-sm" type="submit"> 搜索</button>
                        <!--<button type="submit" name="export" value="1" class="btn btn-sm">导出</button>-->
				</span>
                </div>

            </div>
        </div>

        <table class="table table-hover table-responsive">
            <thead class="navbar-inner">
            <tr>
                <th style="width:200px;">结算编号</th>
                <th style="width:120px;">收银台信息</th>
                <th style="width:100px;">申请金额</th>
                <th style="width:120px;">申请时间</th>
                <th style="width:80px;">状态</th>
                <th style="width:100px;">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
                <td><?php  echo $row['clearno'];?></td>
                <td><?php  echo $row['name'];?><br/><?php  echo $row['mobile'];?></td>
                <td><?php  echo $row['money'];?>元</td>
                <td><?php  echo date('Y/m/d H:i',$row['createtime'])?></td>
                <td>
                    <?php  if($row['status'] == '0') { ?>
                    <label class="label label-default">待确认</label>
                    <?php  } else if($row['status'] == '1') { ?>
                    <label class="label label-warning">待结算</label>
                    <?php  } else if($row['status'] == '2') { ?>
                    <label class="label label-primary">已结算</label>
                    <?php  } ?>


                </td>
                <td style="overflow:visible;">
                    <a class='btn btn-default btn-sm' href="<?php  echo cashierUrl('clearing/edit',array('id' => $row['id']))?>">详情</a>
                    <?php  if($row['status'] != '2') { ?>
                    <a data-toggle='ajaxRemove' href="<?php  echo cashierUrl('clearing/delete',array('id' => $row['id']));?>" class="btn btn-danger btn-sm" data-confirm='确认要删除此申请吗?'>删除</a>
                    <?php  } ?>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
    </div>
</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>