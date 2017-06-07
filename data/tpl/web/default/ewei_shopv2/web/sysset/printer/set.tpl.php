<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"><h2>小票打印设置</h2></div>

<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">选择订单打印机</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.printer.set')) { ?>
            <?php  echo tpl_selector('order_printer',array(
             'preview'=>true,
            'readonly'=>true,
            'nokeywords'=>true,
            'multi'=>1,
            'value'=>$item['title'],
            'url'=>webUrl('sysset/printer/printer_query'),
            'items'=>$order_printer_array,
            'buttontext'=>'选择打印机',
            'placeholder'=>'请选择打印机')
            )?>
            <?php  } else { ?>
            <div class="input-group multi-img-details container ui-sortable">
                <?php  if(is_array($order_printer_array)) { foreach($order_printer_array as $item) { ?>
                <div data-name="goodsid" data-id="<?php  echo $item['id'];?>" class="multi-item">
                    <img src="<?php  echo tomedia($item['thumb'])?>" class="img-responsive img-thumbnail">
                    <div class="img-nickname"><?php  echo $item['title'];?></div>
                </div>
                <?php  } } ?>
            </div>

            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">选择订单打印模板</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.printer.set')) { ?>
            <select class='form-control' name='order_template'>
                <option >选择您需要的订单打印模板</option>
                <?php  if(is_array($order_template)) { foreach($order_template as $value) { ?>
                <option value="<?php  echo $value['id'];?>" <?php  if($value['id']==$data['order_template']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                <?php  } } ?>
            </select>
            <?php  } else { ?>
            <div class='form-control-static'>
                <?php  if(empty($data['order_template'])) { ?>选择您需要的订单打印模板<?php  } else { ?><?php  echo $data['order_template'];?><?php  } ?>
            </div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">订单打印方式</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.printer.set')) { ?>
            <label class="checkbox-inline">
                <input type="checkbox" value="1" name='ordertype[]' <?php  if(in_array('1',$ordertype)) { ?>checked<?php  } ?> /> 下单打印
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" value="2" name='ordertype[]' <?php  if(in_array('2',$ordertype)) { ?>checked<?php  } ?> /> 付款打印
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" value="3" name='ordertype[]' <?php  if(in_array('3',$ordertype)) { ?>checked<?php  } ?> /> 确认收货打印
            </label>
            <div class="help-block">通知商家方式</div>
            <?php  } else { ?>
            <input type="hidden" name="data[ordertype]" value="<?php  echo $data['ordertype'];?>" />
            <div class='form-control-static'><?php  if(in_array('1',$ordertype)) { ?>下单打印;<?php  } ?><?php  if(in_array('2',$ordertype)) { ?>付款打印;<?php  } ?><?php  if(in_array('3',$ordertype)) { ?>确认收货打印;<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">多商户订单</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.printer.set')) { ?>
            <label class="radio-inline"><input type="radio" name="printer_merch" value="0" <?php  if(empty($data['printer_merch'])) { ?>checked<?php  } ?>> 不打印</label>
            <label class="radio-inline"><input type="radio" name="printer_merch" value="1" <?php  if(!empty($data['printer_merch'])) { ?>checked<?php  } ?>> 打印</label>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if(empty($data['printer_merch'])) { ?>不打印<?php  } else { ?>打印<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.printer.set')) { ?>
            <input type="submit" value="提交" class="btn btn-primary"/>
            <?php  } ?>
        </div>
    </div>

</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>