<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
    <span class='pull-right'>
        <?php if(cv('merch.category.add')) { ?>
        	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('merch/category/add')?>"><i class='fa fa-plus'></i> 添加商户分类</a>
        <?php  } ?>
    </span>
    <h2>商户分类管理</h2>
</div>

<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="merch.category" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">
            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(cv('merch.category.edit')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('merch/category/status',array('status'=>1))?>"><i class='fa fa-circle'></i> 启用</button>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('merch/category/status',array('status'=>0))?>"><i class='fa fa-circle-o'></i> 禁用</button>
                <?php  } ?>
                <?php if(cv('merch.category.delete')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('merch/category/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>
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
            <th style="width: 180px;">分类图标</th>
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
                <img src="<?php  echo tomedia($row['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;">
            </td>
            <td>
                <span class='label <?php  if($row['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
                <?php if(cv('merch.category.edit')) { ?>
                data-toggle='ajaxSwitch'
                data-switch-value='<?php  echo $row['status'];?>'
                data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('merch/category/status',array('status'=>1,'id'=>$row['id']))?>'
                data-switch-value1='1|启用|label label-success|<?php  echo webUrl('merch/category/status',array('status'=>0,'id'=>$row['id']))?>'
                <?php  } ?> >
                <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?>
                </span>
            </td>
            <td style="text-align:left;">

                <?php if(cv('merch.category.view|merch.category.edit')) { ?>
                <a href="<?php  echo webUrl('merch/category/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm" >
                    <i class='fa fa-edit'></i> <?php if(cv('merch.group.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>
                </a>
                <?php  } ?>

                <?php if(cv('merch.category.delete')) { ?>
                <a data-toggle='ajaxRemove' href="<?php  echo webUrl('merch/category/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm" data-confirm='确认要删除分类吗?'><i class="fa fa-trash"></i> 删除</a>
                <?php  } ?>

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
    <?php  echo $pager;?>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何商户分组!
        </div>
    </div>
    <?php  } ?>

</form>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>