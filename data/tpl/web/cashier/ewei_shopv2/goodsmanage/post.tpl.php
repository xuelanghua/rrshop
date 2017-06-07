<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-default panel-class" style="margin-top: 20px;">
<div class="panel-heading">添加/修改 商品</div>
<form id="setform"  action="" method="post" class="form-horizontal form-validate">
    <div class="form-group">
        <label class="col-sm-2 control-label must">商品名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" required/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label must">商品图片</label>
        <div class="col-sm-8">
            <?php  echo tpl_form_field_image('image',$item['image'],'../addons/ewei_shopv2/static/images/nopic.jpg',array('dest_dir'=>'cashier/'.$_W['cashierid']))?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label must">收银台分类</label>
        <div class="col-sm-8">
            <select class="form-control" name="categoryid" required>
                <?php  if(is_array($category)) { foreach($category as $c) { ?>
                <option value="<?php  echo $c['id'];?>" <?php  if($item['categoryid']==$c['id']) { ?>selected<?php  } ?>><?php  echo $c['catename'];?></option>
                <?php  } } ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" name="price" value="<?php  echo floatval($item['price'])?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" name="total" value="<?php  echo intval($item['total'])?>"/>
            <div class="help-block">当库存为-1 时 为不限制库存数量</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">商品条码</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="goodssn" value="<?php  echo $item['goodssn'];?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否上架</label>
        <div class="col-sm-9 col-xs-12">
            <label class='radio-inline'>
                <input type='radio' name='status' value='0' <?php  if(empty($item['status'])) { ?>checked<?php  } ?> /> 下架
            </label>
            <label class='radio-inline'>
                <input type='radio' name='status' value='1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 上架
            </label>
        </div>
    </div>

<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <input type="submit"  value="提交" class="btn" />
    </div>
</div>

</form>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>