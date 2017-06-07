<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .multi-img-details .multi-item img{height:100px;}
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
        border-top: none;
    }.refund-group{display: none;}
</style>
<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('sale.fullback.add')) { ?>
        	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sale/fullback/add')?>"><i class='fa fa-plus'></i> 添加商品</a>
        <?php  } ?>
        <a class="btn btn-default  btn-sm" href="<?php  echo webUrl('sale/fullback')?>">返回列表</a>
    </span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>商品 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['titles'];?>】<?php  } ?></small></h2>
</div>


<form <?php if( ce('sale.fullback' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="tab-content ">
            <div class="tab-pane active">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.fullback' ,$item) ) { ?>
                            <input type='text' class='form-control' name='displayorder' value="<?php  echo $item['displayorder'];?>" />
                            <span class="help-block">数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label must">商品标题</label>
                        <div class="col-sm-9 col-xs-12 ">
                            <?php if( ce('sale.fullback' ,$item) ) { ?>
                            <input type="text" id='titles' name="titles" class="form-control" value="<?php  echo $item['titles'];?>" data-rule-required="true"/>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['titles'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">全返类型</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.fullback' ,$item) ) { ?>
                            <label class="radio-inline">
                                <input type="radio" name="type" value="0" <?php  if(empty($item['type']) || $item['type'] == 0) { ?>checked="true"<?php  } ?>  />
                                指定金额
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" value="1"  <?php  if($item['type'] == 1) { ?>checked="true"<?php  } ?> />
                                金额比例
                            </label>
                            <?php  } else { ?>
                            <div class='form-control-static'>
                                <?php  if($item['type'] == 0) { ?>
                                指定金额
                                <?php  } else if($item['type']==1) { ?>
                                金额比例
                                <?php  } ?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label must">选择商品</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.fullback' ,$item) ) { ?>
                            <div>
                                <?php  echo tpl_selector_new('goodsid',array('preview'=>true,
                                'readonly'=>true,
                                'required'=>true,
                                'type'=>'fullback',
                                'value'=>$item['title'],
                                'url'=>webUrl('sale/fullback/query'),
                                'optionurl'=>'sale.fullback.hasoption',
                                'items'=>$item,
                                'nokeywords'=>1,
                                'autosearch'=>1,
                                'buttontext'=>'选择商品',
                                'placeholder'=>'请选择商品')
                                )
                                ?>
                            </div>
                            <?php  } else { ?>
                            <?php  if(!empty($goods)) { ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style='width:80px;'>商品名称</th>
                                    <th style='width:220px;'></th>
                                    <th>全返金额</th>
                                </tr>
                                </thead>
                                <tbody id="param-items" class="ui-sortable">
                                <?php  if(!empty($goods)) { ?>
                                <tr class="multi-product-item" data-id="<?php  echo $goods['goodsid'];?>">
                                    <input type="hidden" class="form-control img-textname" readonly="" value="<?php  echo $goods['title'];?>">
                                    <input type="hidden" value="<?php  echo $goods['goodsid'];?>" name="goodsid[]">
                                    <td style="width:80px;">
                                        <img src="<?php  echo tomedia($goods['thumb'])?>" style="width:70px;border:1px solid #ccc;padding:1px">
                                    </td>
                                    <td style="width:220px;"><?php  echo $goods['title'];?></td>
                                    <td><a class="btn btn-default btn-sm" data-toggle="ajaxModal"
                                           href="<?php  echo webUrl('sale/package/hasoption',array('goodsid'=>$goods['goodsid'],'id'=>$goods['id']))?>" id="optiontitle<?php  echo $goods['goodsid'];?>">&yen;<?php  echo $goods['packageprice'];?></a>
                                        <input type="hidden" id="fullbackgoods<?php  echo $goods['goodsid'];?>" value="" name="fullbackgoods[<?php  echo $goods['goodsid'];?>]">
                                        <input type="hidden" value="<?php  echo $goods['allfullbackprice'];?>,<?php  echo $goods['fullbackprice'];?>,<?php  echo $goods['allfullbackratio'];?>,<?php  echo $goods['fullbackratio'];?>,<?php  echo $goods['day'];?>" name="fullgoods<?php  echo $goods['goodsid'];?>">
                                    </td>
                                </tr>
                                <?php  } ?>
                                </tbody>
                            </table>
                            <?php  } else { ?>
                            暂无商品
                            <?php  } ?>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group cgt cgt-3">
                        <label class="col-sm-2 control-label">全返时间</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.fullback' ,$item) ) { ?>
                            <div class="input-group">
                                <span class="input-group-addon">确认收货</span>
                                <input type="number" class="form-control" name="startday" value="<?php  echo $item['startday'];?>">
                                <span class="input-group-addon">天后，开始全返</span>
                            </div>
                            <span class="help-block">全返的时间尽量设置超过系统允许【确认收货】->【申请退款】的时间</span>
                            <?php  } else { ?>
                            <div class='form-control-static'>确认收货：<?php  echo $coupon['startday'];?>天后，开始全返</div>
                            <?php  } ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">全返开始后是否支持退款</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.fullback' ,$item) ) { ?>
                            <label class="radio-inline">
                                <input type="radio" name="refund" value="0" <?php  if(empty($item['refund']) || $item['refund'] == 0) { ?>checked="true"<?php  } ?>  />
                                否
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="refund" value="1"  <?php  if($item['refund'] == 1) { ?>checked="true"<?php  } ?> />
                                是
                            </label>
                            <div class="input-group refund-group-click <?php  if($item['refund'] == 0) { ?>refund-group<?php  } ?>" style="padding-top:10px;">
                                <div class="alert alert-danger">
                                    如果您选择全返商品支持退款，会员在全返开始后发起【退款】请求，可退款金额将减去已返金额，已返金额不会退款；如果全返金额大于商品实际价格，不能退款。
                                </div>
                            </div>
                            <?php  } else { ?>
                            <div class='form-control-static'>
                                <?php  if($item['refund'] == 0) { ?>
                                不支持退款
                                <?php  } else if($item['refund']==1) { ?>
                                支持退款
                                <?php  } ?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">状态</label>
                        <div class="col-xs-12 col-sm-8">
                            <div class="input-group">
                                <?php if( ce('sale.fullback' ,$item) ) { ?>
                                <label class="radio radio-inline">
                                    <input type="radio" name="status" value="0" <?php  if(intval($item['status']) ==0) { ?>checked="checked"<?php  } ?>> 关闭
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" name="status" value="1" <?php  if(intval($item['status']) ==1 ) { ?>checked="checked"<?php  } ?>> 开启
                                </label>
                                <?php  } else { ?>
                                <div class='form-control-static'><?php  if(intval($item['status']) ==1 ) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

<?php if( ce('sale.fullback' ,$item) ) { ?>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <input type="submit"  value="提交" class="btn btn-primary" />
    </div>
</div>
<?php  } ?>

</form>
<script>
    $(function () {
        $(":radio[name=refund]").off("click").on("click",function () {
            if($(this).val()==1){
                $(".refund-group-click").show();
            }else{
                $(".refund-group-click").hide();
            }
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>