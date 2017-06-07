<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <?php if(cv('diypage.shop.adv.add')) { ?>
        <span class="pull-right">
            <a class="btn btn-default btn-sm" href="<?php  echo webUrl('diypage/shop/adv/add')?>">新建启动广告</a>
        </span>
    <?php  } ?>
	<h2>启动广告管理 <small>总数(<?php  echo $total;?>)</small></h2>
</div>

<form action="" method="post">
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">
            <div class="input-group-btn">
                <span class="btn btn-default btn-sm" type="button" data-toggle="refresh"><i class="fa fa-refresh"></i></span>
                <?php if(cv('diypage.shop.adv.delete')) { ?>
                    <button class="btn btn-default btn-sm" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo webUrl('diypage/shop/adv/delete')?>" disabled="disabled"><i class="fa fa-trash"></i> 删除</button>
                <?php  } ?>
            </div>
        </div>

        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <input type="text" class="input-sm form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入广告标题进行搜索">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                </span>
            </div>

        </div>
    </div>

    <?php  if(empty($list)) { ?>
    <div class="panel panel-default">
        <div class="panel-body" style="text-align: center;padding:30px;">
            未查询到<?php  if(!empty($_GPC['keyword'])) { ?>"<?php  echo $_GPC['keyword'];?>"<?php  } ?>相关全屏广告!
        </div>
    </div>
    <?php  } else { ?>
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th style="width:25px;"><input type="checkbox"></th>
                <th>广告名称</th>
                <th style="width: 80px; text-align: center;">状态</th>
                <th style="width: 100px;">创建时间</th>
                <th style="width: 100px;">最后修改时间</th>
                <th style="width: 160px">操作</th>
            </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php  echo $item['id'];?>">
                        </td>
                        <td><?php  echo $item['name'];?></td>
                        <td style="text-align: center;">
                            <?php  if(!empty($item['status'])) { ?>
                                <label class="label label-primary">已启用</label>
                            <?php  } else { ?>
                                <label class="label label-default">未启用</label>
                            <?php  } ?>
                        </td>
                        <td><?php  echo date('Y-m-d', $item['createtime'])?><br><?php  echo date('H:i:s', $item['createtime'])?></td>
                        <td><?php  echo date('Y-m-d', $item['lastedittime'])?><br><?php  echo date('H:i:s', $item['lastedittime'])?></td>
                        <td>
                            <?php if(cv('diypage.shop.adv.edit')) { ?>
                                <a class="btn btn-default btn-sm" href="<?php  echo webUrl('diypage/shop/adv/edit', array('id'=>$item['id']))?>"><i class="fa fa-edit"></i>  编辑</a>
                            <?php  } ?>
                            <?php if(cv('diypage.shop.adv.delete')) { ?>
                                <a class="btn btn-default btn-sm" data-toggle="ajaxRemove" href="<?php  echo webUrl('diypage/shop/adv/delete', array('id'=>$item['id']))?>" data-confirm="确定要删除该菜单吗？"><i class="fa fa-remove"></i> 删除</a>
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