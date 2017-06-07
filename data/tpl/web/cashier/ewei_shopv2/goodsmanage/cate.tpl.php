<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-default panel-class" style="margin-top:20px;">
    <div class="panel-heading">
         <span class='pull-right'>
        <a class='btn btn-sm' href="<?php  echo cashierUrl('goodsmanage/cate_add')?>"><i class="fa fa-plus"></i> 添加分类</a>
	</span>
        商品分类 <small>总数: <span class='text-danger'><?php  echo $total;?></span></small>
    </div>

    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal form-search" role="form">
            <input type="hidden" name="i" value="<?php  echo $_W['uniacid'];?>" />
            <input type="hidden" name="r"  value="goodsmanage.cate" />
            <div class="page-toolbar row m-b-sm m-t-sm">
                <div class="col-sm-4">
                    <div class="input-group-btn">
                        <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo cashierUrl('goodsmanage/cate_status',array('status'=>1))?>"><i class='fa fa-circle'></i> 启用</button>
                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo cashierUrl('goodsmanage/cate_status',array('status'=>0))?>"><i class='fa fa-circle-o'></i> 禁用</button>
                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo cashierUrl('goodsmanage/cate_delete')?>"><i class='fa fa-trash'></i> 删除</button>
                    </div>
                </div>

                <div class="col-sm-6 pull-right">

                    <select name="status" class='form-control input-sm select-sm'>
                        <option value="" <?php  if($_GPC['status'] == '') { ?> selected<?php  } ?>>状态</option>
                        <option value="1" <?php  if($_GPC['status']== '1') { ?> selected<?php  } ?>>启用</option>
                        <option value="0" <?php  if($_GPC['status'] == '0') { ?> selected<?php  } ?>>禁用</option>
                    </select>
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                        </span>
                    </div>
                </div>

            </div>
        </form>

        <form action="" method="post">
            <?php  if(count($list)>0) { ?>
            <table class="table table-responsive table-hover" >
                <thead class="navbar-inner">
                <tr>
                    <th style="width:25px;"><input type='checkbox' /></th>
                    <th style="width: 180px;">分类名称</th>
                    <th  style='width:80px;'>是否启用</th>
                    <th style="width: 180px;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td>
                        <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
                    </td>

                    <td><?php  echo $row['catename'];?></td>
                    <td>
                        <span class='label <?php  if($row['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
                        data-toggle='ajaxSwitch'
                        data-switch-value='<?php  echo $row['status'];?>'
                        data-switch-value0='0|禁用|label label-default|<?php  echo cashierUrl('goodsmanage/cate_status',array('status'=>1,'id'=>$row['id']))?>'
                        data-switch-value1='1|启用|label label-success|<?php  echo cashierUrl('goodsmanage/cate_status',array('status'=>0,'id'=>$row['id']))?>'>
                        <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?>
                        </span>
                    </td>
                    <td style="text-align:left;">

                        <a href="<?php  echo cashierUrl('goodsmanage/cate_edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm" >
                            <i class='fa fa-edit'></i> <?php if(cv('cashier.category.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>
                        </a>
                        <a data-toggle='ajaxRemove' href="<?php  echo cashierUrl('goodsmanage/cate_delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm" data-confirm='确认要删除分类吗?'><i class="fa fa-trash"></i> 删除</a>

                    </td>
                </tr>
                <?php  } } ?>
                <tr>
                    <td colspan='4'>
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
                    暂时没有任何商品分类!
                </div>
            </div>
            <?php  } ?>

        </form>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>