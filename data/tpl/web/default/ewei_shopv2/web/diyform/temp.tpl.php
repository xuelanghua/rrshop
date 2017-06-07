<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"> 
    <span class='pull-right'>
               <?php if(cv('diyform.temp.add')) { ?>
					  <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('diyform/temp/add')?>"><i class='fa fa-plus'></i> 添加模板</a>
				       <?php  } ?>
    </span>
    <h2>模板管理 <small>总数: <span class='text-danger'><?php  echo $total;?></span></small></h2> </div>

<form action="./index.php" method="get" class="form-horizontal" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="diyform.temp" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

                <?php if(cv('diyform.temp.delete')) { ?>
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('diyform/temp/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>


            </div>
        </div>


        <div class="col-sm-6 pull-right">

            <div class="input-group">
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">
						
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
            </div>

        </div>
    </div>
</form>

<?php  if(count($items)>0) { ?>
<table class="table table-responsive">
    <thead>
    <tr>
        <th style="width:25px;"><input type='checkbox' /></th>
        <th >模板名称</th>
        <th style="width:200px">使用情况(正在使用)</th>
        <th >操作</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($items)) { foreach($items as $item) { ?>
    <tr>

        <td><input type='checkbox'   value="<?php  echo $item['id'];?>"/></td>
        <td><?php  if(!empty($category[$item['cate']]['name'])) { ?><label class='label label-primary'><?php  echo $category[$item['cate']]['name']?></label><?php  } ?> <?php  echo $item['title'];?></td>
        <td>
            <?php  if($item['use_flag1']) { ?>
            会员资料
            <?php  } ?>
            <?php  if($item['use_flag2']) { ?>
            分销商申请资料
            <?php  } ?>
            <?php  if($item['datacount3']) { ?>
            <?php  echo $item['datacount3']?>种商品
            <?php  } ?>
        </td>  
        <td> 
            <?php if(cv('diyform.temp.edit|diyform.temp.view')) { ?><a class='btn btn-default' href="<?php  echo webUrl('diyform/temp/edit', array( 'id' => $item['id']))?>"><i class='fa fa-edit'></i> <?php if(cv('diyform.temp.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a><?php  } ?>
            <?php if(cv('diyform.data')) { ?><!--a class='btn btn-default' href="<?php  echo webUrl('diyform/data', array('typeid' => $item['id']))?>" title='查看已有数据'><i class='fa fa-list'></i></a--><?php  } ?>
            <?php if(cv('diyform.temp.delete')) { ?>
            <?php  if(!$item['err']) { ?>
            <a data-toggle='ajaxRemove' class='btn btn-default btn-sm'  href="<?php  echo webUrl('diyform/temp/delete', array('id' => $item['id']))?>" data-confirm="确认删除此模板吗？"><i class='fa fa-remove'></i> 删除</a><?php  } ?>
            <?php  } ?>
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
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
