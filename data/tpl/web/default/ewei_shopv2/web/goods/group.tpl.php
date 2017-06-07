<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> <h2>商品组管理 <small>总数: 12</small></h2></div>

<div class="alert alert-info">商品组现主要用于店铺装修调用</div>

<form action method="post">
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">
            <div class="input-group-btn">
                <span class="btn btn-default btn-sm" type="button" data-toggle="refresh"><i class="fa fa-refresh"></i></span>
                <?php if(cv('goods.group.edit')) { ?>
                    <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('goods/group/enabled',array('enabled'=>1))?>"><i class='fa fa-circle'></i> 启用</button>
                    <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('goods/group/enabled',array('enabled'=>0))?>"><i class='fa fa-circle-o'></i> 禁用</button>
                <?php  } ?>
                <?php if(cv('goods.group.delete')) { ?>
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo webUrl('goods/group/delete')?>" disabled="disabled"><i class="fa fa-trash"></i> 删除</button>
                <?php  } ?>
                <?php if(cv('goods.group.add')) { ?>
                    <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('goods/group/add')?>"><i class="fa fa-plus"></i> 添加新组</a>
                <?php  } ?>
            </div>
        </div>
        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <input type="text" class="input-sm form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入商品组名称进行搜索">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                </span>
            </div>
        </div>
    </div>

    <?php  if(empty($list)) { ?>
    <div class="panel panel-default">
        <div class="panel-body" style="text-align: center;padding:30px;">
            未查询到<?php  if(!empty($_GPC['keyword'])) { ?>"<?php  echo $_GPC['keyword'];?>"<?php  } ?>相关商品组!
        </div>
    </div>
    <?php  } else { ?>
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <?php if(cv('goods.group.delete|goods.group.edit')) { ?>
                <th style="width:25px;"><input type="checkbox"></th>
            <?php  } ?>
            <th>商品组名称</th>
            <th style="width: 70px;">状态</th>
            <th style="width: 160px">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <tr>
            <?php if(cv('goods.group.delete|goods.group.edit')) { ?>
                <td>
                    <input type="checkbox" value="<?php  echo $item['id'];?>">
                </td>
            <?php  } ?>
            <td><?php  echo $item['name'];?></td>
            <td>
                <span class='label <?php  if($item['enabled']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
                <?php if(cv('goods.group.edit')) { ?>
                    data-toggle='ajaxSwitch'
                    data-switch-value='<?php  echo $item['enabled'];?>'
                    data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('goods/group/enabled',array('enabled'=>1,'id'=>$item['id']))?>'
                    data-switch-value1='1|启用|label label-success|<?php  echo webUrl('goods/group/enabled',array('enabled'=>0,'id'=>$item['id']))?>'
                <?php  } ?>>
                <?php  if($item['enabled']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
            </td>
            <td>
                <?php if(cv('goods.group.view|goods.group.edit')) { ?>
                    <a class="btn btn-default btn-sm" href="<?php  echo webUrl('goods/group/edit', array('id'=>$item['id']))?>"><i class="fa fa-edit"></i>  <?php if(cv('goods.group.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?></a>
                <?php  } ?>
                <?php if(cv('goods.group.delete')) { ?>
                    <a class="btn btn-default btn-sm" data-toggle="ajaxRemove" href="<?php  echo webUrl('goods/group/delete', array('id'=>$item['id']))?>" data-confirm="确定要删除该分组吗？"><i class="fa fa-remove"></i> 删除</a>
                <?php  } ?>
            </td>
        </tr>
        <?php  } } ?>
        </tbody>
    </table>
    <?php  echo $pager;?>
    <?php  } ?>

</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>