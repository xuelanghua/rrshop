<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .table_kf {display: none;}
    .table_kf.active {display: table-footer-group;}
</style>
<div class="page-heading"> 
    <span class='pull-right'>
        <?php if(cv('sale.package.add')) { ?>
        <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sale/package/add',array('type'=>$type))?>"><i class='fa fa-plus'></i> 添加套餐</a>
        <?php  } ?>
    </span>
    <h2>套餐管理</h2> </div>

<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type='hidden' id='tab' name='type' value="<?php  echo $_GPC['type'];?>"/>
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="sale.package" />
    <input type="hidden" name="goodsfrom" value="<?php  echo $goodsfrom;?>" />

    <ul class="nav nav-arrow-next nav-tabs" id="myTab">
        <li class="<?php  if(empty($_GPC['type'])) { ?>active<?php  } ?>" >
            <a href="<?php  echo webUrl('sale/package')?>">所有套餐</a>
        </li>
        <li class="<?php  if($_GPC['type']=='ing') { ?>active<?php  } ?>" >
            <a href="<?php  echo webUrl('sale/package',array('type'=>'ing'))?>">进行中</a>
        </li>
        <li class="<?php  if($_GPC['type']=='none') { ?>active<?php  } ?>" >
            <a href="<?php  echo webUrl('sale/package',array('type'=>'none'))?>">未开始</a>
        </li>
        <li class="<?php  if($_GPC['type']=='end') { ?>active<?php  } ?>">
            <a href="<?php  echo webUrl('sale/package',array('type'=>'end'))?>">已结束</a>
        </li>
    </ul>
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-6">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(cv('sale.package.edit')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('sale/package/status',array('status'=>0))?>">
                    <i class='fa fa-circle-o'></i> 下架
                </button>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('salse/package/status',array('status'=>1))?>">
                    <i class='fa fa-circle'></i> 上架
                </button>
                <?php  } ?>
                <?php if(cv('sale.package.delete1')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="如果商品存在购买记录，会无法关联到商品, 确认要彻底删除吗?" data-href="<?php  echo webUrl('sale/package/delete1')?>">
                    <i class='fa fa-remove'></i> 彻底删除
                </button>
                <?php  } ?>
            </div> 
        </div>
        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="套餐名称"> <span class="input-group-btn">
                <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
            </div>
        </div>
    </div>
</form>
<form action="" method="post">
    <table class="table table-hover table-responsive">
        <thead class="navbar-inner">
        <tr>
            <th style="width:25px;"><input type='checkbox' /></th>
            <th style="width:60px;text-align:center;">排序</th>
            <th style="width:80px;">套餐名称</th>
            <th  style="">&nbsp;</th>
            <th style="width:70px;" >价格</th>
            <th  style="width:60px;" >状态</th>
            <th style="width:260px;text-align: center;">操作</th>
        </tr>
        </thead>
        <tbody class=" table_kf <?php  if($_GPC['type']=='all' || empty($_GPC['type'])) { ?>active<?php  } ?>" id="tab_all"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/package/list', TEMPLATE_INCLUDEPATH)) : (include template('sale/package/list', TEMPLATE_INCLUDEPATH));?></tbody>
        <tbody class=" table_kf <?php  if($_GPC['type']=='ing') { ?>active<?php  } ?>" id="tab_ing"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/package/list', TEMPLATE_INCLUDEPATH)) : (include template('sale/package/list', TEMPLATE_INCLUDEPATH));?></tbody>
        <tbody class=" table_kf <?php  if($_GPC['type']=='none') { ?>active<?php  } ?>" id="tab_none"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/package/list', TEMPLATE_INCLUDEPATH)) : (include template('sale/package/list', TEMPLATE_INCLUDEPATH));?></tbody>
        <tbody class=" table_kf <?php  if($_GPC['type']=='end') { ?>active<?php  } ?>" id="tab_end"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/package/list', TEMPLATE_INCLUDEPATH)) : (include template('sale/package/list', TEMPLATE_INCLUDEPATH));?></tbody>
    </table>
</form>
<div style="text-align:right;width:100%;">
    <?php  echo $pager;?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
