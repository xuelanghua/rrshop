<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-default panel-class" style="margin-top:20px;">
    <div class="panel-heading">
         <span class='pull-right'>
            <a class='btn btn-sm' href="<?php  echo cashierUrl('goodsmanage/goods')?>"><i class="fa fa-shopping-cart"></i> 商城商品管理 </a>
            <a class='btn btn-sm' href="<?php  echo cashierUrl('goodsmanage/add')?>"><i class="fa fa-plus"></i> 添加收款商品</a>
        </span>
         商品管理 <small>总数: <span class='text-danger'><?php  echo $total;?></span></small>
    </div>
    <div class="panel-body">
        <form action="./cashier.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="i" value="<?php  echo $_W['uniacid'];?>" />
            <input type="hidden" name="r" value="goodsmanage" />

            <div class="page-toolbar row m-b-sm m-t-sm">
                <div class="col-sm-3">

                    <div class="input-group-btn">
                        <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo cashierUrl('goodsmanage/delete')?>"><i class='fa fa-trash'></i> 删除</button>
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
                <th style='width:150px;'>商品名称</th>
                <th style='width:120px;'>价格</th>
                <th style='width:120px;'>库存</th>
                <th style='width:100px;'>状态</th>
                <th style='width:100px;'>创建时间</th>
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
                <td><?php  echo $row['price'];?></td>
                <td><?php  if($row['total']==-1) { ?>不限制<?php  } else { ?><?php  echo $row['total'];?><?php  } ?></td>
                <td>
                    <span class='label <?php  if($row['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
                    data-toggle='ajaxSwitch'
                    data-switch-value='<?php  echo $row['status'];?>'
                    data-switch-value0='0|禁用|label label-default|<?php  echo cashierUrl('goodsmanage/status',array('status'=>1,'id'=>$row['id']))?>'
                    data-switch-value1='1|启用|label label-success|<?php  echo cashierUrl('goodsmanage/status',array('status'=>0,'id'=>$row['id']))?>'>
                    <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?>
                    </span>
                </td>
                <td><?php  echo date('Y-m-d H:i',$row['createtime'])?></td>
                <td  style="overflow:visible;">
                    <a href="<?php  echo cashierUrl('goodsmanage/edit', array('id' => $row['id']))?>" class="btn btn-sm" >
                        <i class='fa fa-edit'></i> 修改
                    </a>
                    <a data-toggle='ajaxRemove' href="<?php  echo cashierUrl('goodsmanage/delete', array('id' => $row['id']))?>"class="btn btn-sm" data-confirm='确认要删除此操作员吗?'><i class="fa fa-trash"></i> 删除</a>
                </td>
            </tr>
            <?php  } } ?>
            <tr>
                <td colspan='7'>
                    <div class='pagers' style='float:right;'>
                        <?php  echo $pager;?>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <?php  } else { ?>
        <div class='panel panel-default panel-class'>
            <div class='panel-body' style='text-align: center;padding:30px;color: #fff;'>
                暂时没有任何收银台商品!
            </div>
        </div>
        <?php  } ?>
    </div>
</div>


<script language="javascript">


</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>