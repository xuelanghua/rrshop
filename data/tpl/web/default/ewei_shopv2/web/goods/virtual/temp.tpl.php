<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> <h2>虚拟卡密管理</h2> </div>

<form action="./index.php" method="get" class="form-horizontal" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="goods.virtual.temp" />
    
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

                <?php if(cv('goods.virtual.temp.delete')) { ?>	
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('goods/virtual/temp/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>

                <?php if(cv('goods.virtual.temp.add')) { ?>
                <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('goods/virtual/temp/add')?>"><i class='fa fa-plus'></i> 添加模板</a>
                <?php  } ?>
            </div> 
        </div>	


        <div class="col-sm-6 pull-right">


            <div class="input-group">				 
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入模板名称进行搜索"> <span class="input-group-btn">
                   		
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
            </div>

        </div>
    </div>
</form>
<?php  if(count($items)>0) { ?>
<table class="table table-hover table-responsive" >
    <thead>
        <tr>
            <th style="width:25px;"><input type='checkbox' /></th>
            <th style="width:200px;" >模版名称</th>
            <th style="width:200px">已使用/总共数据</th>
            <th >操作</th>
        </tr>
    </thead>
    <tbody>
        <?php  if(is_array($items)) { foreach($items as $item) { ?>
        <tr>

            <td>
                <input type='checkbox'   value="<?php  echo $item['id'];?>"/>
            </td>
            <td><label class='label label-primary'><?php  echo $category[$item['cate']]['name']?></label> <?php  echo $item['title'];?></td>
            <td>
                <?php if(cv('goods.virtual.data.view')) { ?>
                <a href="<?php  echo webUrl('goods/virtual/data', array('typeid'=>$item['id']))?>" title="点击查看/编辑"><?php  echo $item['usedata'];?> / <?php  echo $item['alldata'];?> 详细</a>
                <?php  } else { ?>
                <?php  echo $item['usedata'];?> / <?php  echo $item['alldata'];?>
                <?php  } ?>
            </td>
            <td>
                <?php if(cv('goods.virtual.temp.edit|goods.virtual.temp.view')) { ?><a class='btn btn-default btn-sm' href="<?php  echo webUrl('goods/virtual/temp/edit', array('id' => $item['id']))?>"><i class='fa fa-edit'></i> <?php if(cv('goods.virtual.temp.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a><?php  } ?>
                <?php if(cv('goods.virtual.data.view')) { ?><a class='btn btn-default  btn-sm' href="<?php  echo webUrl('goods/virtual/data', array('typeid' => $item['id']))?>" ><i class='fa fa-list'></i> 数据</a><?php  } ?>
                <?php if(cv('goods.virtual.data.add')) { ?><a class='btn btn-primary  btn-sm' href="<?php  echo webUrl('goods/virtual/data/add', array('typeid' => $item['id']))?>"><i class='fa fa-plus'></i> 添加数据</a><?php  } ?>
                <?php if(cv('goods.virtual.temp.delete')) { ?><a class='btn btn-default  btn-sm'  data-toggle='ajaxRemove' href="<?php  echo webUrl('goods/virtual/temp/delete', array('id' => $item['id']))?>" data-confirm="确认删除此模版吗" title='删除模板'><i class='fa fa-trash'></i> 删除</a><?php  } ?>
            </td>
        </tr>
        <?php  } } ?> 

    </tbody>
</table>
<?php  echo $pager;?>
<?php  } else { ?>
<div class='panel panel-default'>
    <div class='panel-body' style='text-align: center;padding:30px;'>
        暂时没有任何模板!
    </div>
</div>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
