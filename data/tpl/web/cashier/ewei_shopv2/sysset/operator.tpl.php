<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-default panel-class" style="margin-top:20px;">
    <div class="panel-heading">
         <span class='pull-right'>
        <a class='btn btn-sm' href="<?php  echo cashierUrl('sysset/operator/add')?>"><i class="fa fa-plus"></i> 添加收款员</a>
	</span>
         操作员管理 <small>总数: <span class='text-danger'><?php  echo $total;?></span></small>
    </div>
    <div class="panel-body">
        <form action="./cashier.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="i" value="<?php  echo $_W['uniacid'];?>" />
            <input type="hidden" name="r" value="sysset.operator" />

            <div class="page-toolbar row m-b-sm m-t-sm">
                <div class="col-sm-3">

                    <div class="input-group-btn">
                        <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo cashierUrl('sysset/operator/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                    </div>
                </div>


                <div class="col-sm-8 pull-right">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="二维码名称/收款名称"/>
                        <span class="input-group-btn">

                                        <button class="btn btn-sm" type="submit"> 搜索</button>
				</span>
                    </div>

                </div>
            </div>
        </form>
        <?php  if(count($list)>0) { ?>

        <table class="table table-hover table-responsive">
            <thead class="navbar-inner" >
            <tr>
                <th style="width:25px;"><input type='checkbox' /></th>
                <th style='width:150px;'>操作员名称</th>
                <th style='width:120px;'>绑定微信</th>
                <th style='width:120px;'>创建时间</th>
                <th style='width:100px;'>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr rel="pop" data-title="ID: <?php  echo $row['id'];?> ">

                <td>
                    <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
                </td>
                <td><?php  echo $row['title'];?></td>
                <td><?php  if(empty($row['manageopenid'])) { ?>暂无<?php  } else { ?><?php  echo $member[$row['manageopenid']]['nickname'];?><?php  } ?></td>
                <td><?php  echo date('Y-m-d H:i',$row['createtime'])?></td>
                <td  style="overflow:visible;">
                    <a href="<?php  echo cashierUrl('sysset/operator/edit', array('id' => $row['id']))?>" class="btn btn-sm" >
                        <i class='fa fa-edit'></i> 修改
                    </a>
                    <a data-toggle='ajaxRemove' href="<?php  echo cashierUrl('sysset/operator/delete', array('id' => $row['id']))?>"class="btn btn-sm" data-confirm='确认要删除此操作员吗?'><i class="fa fa-trash"></i> 删除</a>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>

        <?php  } else { ?>
        <div class='panel panel-default panel-class'>
            <div class='panel-body' style='text-align: center;padding:30px;color: #fff;'>
                暂时没有任何收银台操作员!
            </div>
        </div>
        <?php  } ?>
    </div>
</div>


<script language="javascript">


</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>