<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> 
	
	<span class='pull-right'>
		
		<?php if(cv('shop.verify.store.add')) { ?>
                            <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('shop/verify/store/add')?>">添加新门店</a>
		<?php  } ?>
                
		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('shop/verify/store')?>">返回列表</a>
                
                
	</span>
	<h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>门店 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['storename'];?>】<?php  } ?></small></h2> 
</div>
 
    <form <?php if( ce('shop.verify.store' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
    
                <div class="form-group">
                    <label class="col-sm-2 control-label must">门店名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.verify.store' ,$item) ) { ?>
                        <input type="text" name="storename" class="form-control" value="<?php  echo $item['storename'];?>" data-rule-required="true" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['storename'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">门店LOGO</label>
                    <div class="col-sm-9 col-xs-12">
                          <?php if( ce('shop.verify.store' ,$item) ) { ?>
                               <?php  echo tpl_form_field_image('logo',$item['logo'])?>
                               <?php  } else { ?>
                        <?php  if(!empty($item['logo'])) { ?>
	                        <a href='<?php  echo tomedia($item['logo'])?>' target='_blank'>
	                           <img src="<?php  echo tomedia($item['logo'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
	                        </a>
                        <?php  } ?>
			<?php  } ?>
                    </div>
                </div>
	
               <div class="form-group">
                    <label class="col-sm-2 control-label">门店地址</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( ce('shop.verify.store' ,$item) ) { ?>
                        <input type="text" name="address" class="form-control" value="<?php  echo $item['address'];?>" />
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['address'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">门店电话</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( ce('shop.verify.store' ,$item) ) { ?>
                        <input type="text" name="tel" class="form-control" value="<?php  echo $item['tel'];?>" />
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['tel'];?></div>
                        <?php  } ?>
                    </div>
                </div>
	 <div class="form-group">
                    <label class="col-sm-2 control-label">营业时间</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( ce('shop.verify.store' ,$item) ) { ?>
                        <input type="text" name="saletime" class="form-control" value="<?php  echo $item['saletime'];?>" />
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['saletime'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">门店位置</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( ce('shop.verify.store' ,$item) ) { ?>
                        <?php  echo tpl_form_field_coordinate('map',array('lng'=>$item['lng'],'lat'=>$item['lat']))?>
                               <?php  } else { ?>
                        <div class='form-control-static'>lng=<?php  echo $item['lng'];?>,lat=<?php  echo $item['lat'];?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">门店支持</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.verify.store' ,$item) ) { ?>
                        <label class='radio-inline'>
                            <input type='radio' name='type' value='1' <?php  if($item['type']==1) { ?>checked<?php  } ?> /> 支持自提
                        </label>

                        <label class='radio-inline'>
                            <input type='radio' name='type' value='2' <?php  if($item['type']==2) { ?>checked<?php  } ?> /> 支持核销
                        </label>

                        <label class='radio-inline'>
                            <input type='radio' name='type' value='3' <?php  if($item['type']==3) { ?>checked<?php  } ?> /> 支持自提+核销
                        </label>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  if($item['type']==1) { ?>支持自提<?php  } else if($item['type']==2) { ?>支持核销<?php  } else if($item['type']==3) { ?>支持自提+核销<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group" id="pick_info" <?php  if(empty($item['type']) || $item['type']==2) { ?>style="display:none;"<?php  } ?>>
                    <label class="col-sm-2 control-label">自提信息</label>
                    <div class="col-sm-10 col-xs-12">
                        <?php if( ce('shop.verify.store' ,$item) ) { ?>


                        <label class="radio-inline" style="float: left;padding-left:0px;">联系人</label>

                        <div class="col-sm-9 col-xs-12" style="width: 120px; float: left; margin: 0px 20px 0px -5px;">
                            <input type="text" value="<?php  echo $item['realname'];?>" class="form-control" name="realname" style="width:120px;padding:5px;">
                        </div>

                        <label class="radio-inline" style="float: left;">联系电话</label>
                        <div class="col-sm-9 col-xs-12" style="width: 120px; float: left; margin: 0px 20px 0px -5px;">
                            <input type="text" value="<?php  echo $item['mobile'];?>" class="form-control" name="mobile" style="width:120px;padding:5px;">
                        </div>
						
		    <label class="radio-inline" style="float: left;">自提时间</label>
                        <div class="col-sm-9 col-xs-12" style="width: 200px; float: left; margin: 0px 0px 0px -5px;">
                            <input type="text" value="<?php  echo $item['fetchtime'];?>" class="form-control" name="fetchtime" style="width:200px;padding:5px;">
                        </div>

                        <?php  } else { ?>
                        <div class='form-control-static'>联系人:<?php  echo $item['realname'];?> 联系电话:<?php  echo $item['mobile'];?></div>
                        <?php  } ?>
                    </div>
                </div>


               <div class="form-group">
                    <label class="col-sm-2 control-label">门店简介</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( ce('shop.verify.store' ,$item) ) { ?>
                         <textarea name="desc" class="form-control richtext" cols="70"><?php  echo $item['desc'];?></textarea>
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['desc'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( ce('shop.verify.store' ,$item) ) { ?>
                        <label class='radio-inline'>
                            <input type='radio' name='status' value=1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 启用
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='status' value=0' <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 禁用
                        </label>
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  if($item['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>

<?php  if($printer) { ?>
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
        'buttontext'=>'选择商品',
        'placeholder'=>'请选择商品')
        )?>
        <?php  } else { ?>
        <div class="input-group multi-img-details container ui-sortable">
            <?php  if(is_array($order_printer_array)) { foreach($order_printer_array as $it) { ?>
            <div data-name="goodsid" data-id="<?php  echo $it['id'];?>" class="multi-item">
                <img src="<?php  echo tomedia($it['thumb'])?>" class="img-responsive img-thumbnail">
                <div class="img-nickname"><?php  echo $it['title'];?></div>
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
            <option value="<?php  echo $value['id'];?>" <?php  if($value['id']==$item['order_template']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
            <?php  } } ?>
        </select>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(empty($item['order_template'])) { ?>选择您需要的订单打印模板<?php  } else { ?><?php  echo $item['order_template'];?><?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">订单打印方式</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('sysset.notice.edit')) { ?>
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
<?php  } ?>
                
                      <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( ce('shop.verify.store' ,$item) ) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  />
                            
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('shop.verify.store.add|shop.verify.store.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
            </div>
 </form>
<script language='javascript'>
    $(function () {
        $(':radio[name=type]').click(function () {
            type = $("input[name='type']:checked").val();

            if(type=='1' || type=='3'){
                $('#pick_info').show();
            } else {
                $('#pick_info').hide();
            }
        })
    })
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>