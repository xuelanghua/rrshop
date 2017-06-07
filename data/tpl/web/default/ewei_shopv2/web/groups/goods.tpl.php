<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.table_kf {display: none;}
.table_kf.active {display: table;}
</style>
<div class="page-heading">
    <span class='pull-right'>
    <?php if(cv('groups.goods.add')) { ?>
        <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('groups/goods/add')?>"><i class='fa fa-plus'></i> 添加商品</a>
    <?php  } ?>
    </span>
    <h2>商品管理
        <small>数量: <span class='text-danger'><?php  echo $total;?></span> 条</small>
    </h2>
</div>
<form action="./index.php" method="get" class="form-horizontal" plugins="form">
    <input type='hidden' id='tab' name='type' value="<?php  echo $_GPC['type'];?>"/>
    <input type="hidden" name="c" value="site"/>
    <input type="hidden" name="a" value="entry"/>
    <input type="hidden" name="m" value="ewei_shopv2"/>
    <input type="hidden" name="do" value="web"/>
    <input type="hidden" name="r" value="groups.goods"/>
    <ul class="nav nav-arrow-next nav-tabs" id="myTab">
        <li class="<?php  if($_GPC['type']=='sale' || empty($_GPC['type'])) { ?>active<?php  } ?>" >
            <a href="<?php  echo webUrl('groups/goods',array('type'=>sale))?>">出售中 (<span class='goods-ing'>-</span>)</a>
        </li>
        <li class="<?php  if($_GPC['type']=='sold') { ?>active<?php  } ?>" >
            <a href="<?php  echo webUrl('groups/goods',array('type'=>sold))?>">已售罄 (<span class='goods-sold'>-</span>)</a>
        </li>
        <li class="<?php  if($_GPC['type']=='store') { ?>active<?php  } ?>" >
            <a href="<?php  echo webUrl('groups/goods',array('type'=>store))?>">仓库中 (<span class='goods-store'>-</span>)</a>
        </li>
        <li class="<?php  if($_GPC['type']=='recycle') { ?>active<?php  } ?>">
            <a href="<?php  echo webUrl('groups/goods',array('type'=>recycle))?>">回收站 (<span class='goods-recycle'>-</span>)</a>
        </li>
    </ul>
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">
            <div class="input-group-btn">
                <button class="btn btn-default btn-sm" type="button" data-toggle='refresh'>
                    <i class='fa fa-refresh'></i>
                </button>
                <?php if(cv('groups.goods.edit')) { ?>
                <?php  if($_GPC['type']=='store') { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('groups/goods/status',array('status'=>1))?>">
                    <i class='fa fa-circle'></i> 上架
                </button>
                <?php  } ?>
                <?php  if($_GPC['type']=='sale' || empty($_GPC['type'])) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('groups/goods/status',array('status'=>0))?>">
                    <i class='fa fa-circle-o'></i> 下架
                </button>
                <?php  } ?>
                <?php  } ?>
                <?php  if($_GPC['type']=='recycle') { ?>
                <?php if(cv('groups.goods.restore')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要恢复?" data-href="<?php  echo webUrl('groups/goods/restore')?>">
                    <i class='fa fa-reply'></i> 恢复到仓库
                </button>
                <?php  } ?>
                <?php if(cv('groups.goods.delete1')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="如果商品存在购买记录，会无法关联到商品, 确认要彻底删除吗?" data-href="<?php  echo webUrl('groups/goods/delete1')?>">
                    <i class='fa fa-remove'></i> 彻底删除
                </button>
                <?php  } ?>
                <?php  } else { ?>
                <?php if(cv('groups.goods.delete')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除吗?" data-href="<?php  echo webUrl('groups/goods/delete')?>">
                    <i class='fa fa-trash'></i> 删除
                </button>
                <?php  } ?>
                <?php  } ?>
            </div>
        </div>
        <div class="col-sm-8 pull-right">
            <select name="category" class='form-control input-sm select-sm' style="width:120px;">
                <option value="" <?php  if(empty($_GPC['category'])) { ?>selected<?php  } ?> >商品分类</option>
                <?php  if(is_array($category)) { foreach($category as $cate) { ?>
                <option value="<?php  echo $cate['id'];?>" <?php  if($_GPC['category']==$cate['id']) { ?>selected<?php  } ?>><?php  echo $cate['name'];?></option>
                <?php  } } ?>
            </select>
            <select name='status' class='form-control  input-sm' style='width:100px;'>
                <option value='' <?php  if($_GPC['status']=='') { ?>selected<?php  } ?>>状态</option>
                <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>下架</option>
                <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?> >上架</option>
            </select>
            <div class="input-group">
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-primary" type="submit">搜索</button>
                </span>
            </div>
        </div>
    </div>
</form>
<form action="" method="post">
    <table class="table table-hover table-responsive table_kf <?php  if($_GPC['type']=='sale' || empty($_GPC['type'])) { ?>active<?php  } ?>" id="tab_sale"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('groups/goods/sale', TEMPLATE_INCLUDEPATH)) : (include template('groups/goods/sale', TEMPLATE_INCLUDEPATH));?></table>
    <table class="table table-hover table-responsive table_kf <?php  if($_GPC['type']=='sold') { ?>active<?php  } ?>" id="tab_sold"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('groups/goods/sold', TEMPLATE_INCLUDEPATH)) : (include template('groups/goods/sold', TEMPLATE_INCLUDEPATH));?></table>
    <table class="table table-hover table-responsive table_kf <?php  if($_GPC['type']=='store') { ?>active<?php  } ?>" id="tab_store"> <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('groups/goods/store', TEMPLATE_INCLUDEPATH)) : (include template('groups/goods/store', TEMPLATE_INCLUDEPATH));?></table>
    <table class="table table-hover table-responsive table_kf <?php  if($_GPC['type']=='recycle') { ?>active<?php  } ?>" id="tab_recycle"> <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('groups/goods/recycle', TEMPLATE_INCLUDEPATH)) : (include template('groups/goods/recycle', TEMPLATE_INCLUDEPATH));?></table>
    <?php  echo $pager;?>
</form>
<script type="text/javascript">
$(function(){
    /*
     * 出售中 1 已售罄 2 仓库中 3 回收站 4
     * */
    $.getJSON("<?php  echo webUrl('groups/goods/total');?>",{ type: "1"},function(json){
        $(".goods-ing").text(json);
        $.getJSON("<?php  echo webUrl('groups/goods/total');?>",{ type: "2"},function(json){
            $(".goods-sold").text(json);
            $.getJSON("<?php  echo webUrl('groups/goods/total');?>",{ type: "3"},function(json){
                $(".goods-store").text(json);
                $.getJSON("<?php  echo webUrl('groups/goods/total');?>",{ type: "4"},function(json){
                    $(".goods-recycle").text(json);
                });
            });
        });
    });
})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>