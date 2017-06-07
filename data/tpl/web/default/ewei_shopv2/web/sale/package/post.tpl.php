<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('sale.package.add')) { ?>
        	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sale/package/add',array('type'=>$type))?>"><i class='fa fa-plus'></i> 添加套餐</a>
        <?php  } ?>
        <a class="btn btn-default  btn-sm" href="<?php  echo webUrl('sale/package',array('type'=>$type))?>">返回列表</a>
    </span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>套餐 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></h2>
</div>


<form <?php if( ce('sale.package' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="tab-content ">
            <div class="tab-pane active">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <input type='text' class='form-control' name='displayorder' value="<?php  echo $item['displayorder'];?>" />
                            <span class="help-block">数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label must">套餐标题</label>
                        <div class="col-sm-9 col-xs-12 ">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <input type="text" id='title' name="title" class="form-control" value="<?php  echo $item['title'];?>" data-rule-required="true"/>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['title'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">套餐缩略图</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
                            <span class="help-block image-block" style="display: block;">建议为正方型图片，尺寸建议宽度为640，如果不上传默认为第一件商品缩略图。</span>
                            <?php  } else { ?>
                            <input type="hidden" name="thumb" value="<?php  echo $item['thumb'];?>" />
                            <div class='form-control-static'><?php  echo $item['thumb'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">选择商品</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <div>
                                <?php  echo tpl_selector_new('goodsid',array('preview'=>true,
                                'readonly'=>true,
                                'multi'=>1,
                                'type'=>'product',
                                'value'=>$package_goods['title'],
                                'url'=>webUrl('sale/package/query'),
                                'optionurl'=>'sale.package.hasoption',
                                'items'=>$package_goods,
                                'nokeywords'=>1,
                                'autosearch'=>1,
                                'buttontext'=>'选择商品',
                                'placeholder'=>'请选择商品')
                                )
                                ?>

                            </div>
                            <?php  } else { ?>
                            <?php  if(!empty($package_goods)) { ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style='width:80px;'>商品名称</th>
                                    <th style='width:220px;'></th>
                                    <th>价格/分销佣金</th>
                                </tr>
                                </thead>
                                <tbody id="param-items" class="ui-sortable">
                                <?php  if(is_array($package_goods)) { foreach($package_goods as $index => $item) { ?>
                                <tr class="multi-product-item" data-id="<?php  echo $item['goodsid'];?>">
                                    <input type="hidden" class="form-control img-textname" readonly="" value="<?php  echo $item['title'];?>">
                                    <input type="hidden" value="<?php  echo $item['goodsid'];?>" name="goodsid[]">
                                    <td style="width:80px;">
                                        <img src="<?php  echo tomedia($item['thumb'])?>" style="width:70px;border:1px solid #ccc;padding:1px">
                                    </td>
                                    <td style="width:220px;"><?php  echo $item['title'];?></td>
                                    <td><a class="btn btn-default btn-sm" data-toggle="ajaxModal"
                                       href="<?php  echo webUrl('sale/package/hasoption',array('goodsid'=>$item['goodsid'],'pid'=>$item['pid']))?>" id="optiontitle<?php  echo $item['goodsid'];?>">&yen;<?php  echo $item['packageprice'];?></a>
                                        <input type="hidden" id="packagegoods<?php  echo $item['goodsid'];?>" value="" name="packagegoods[<?php  echo $item['goodsid'];?>]">
                                        <input type="hidden" value="<?php  echo $item['packageprice'];?>,<?php  echo $item['commission1'];?>,<?php  echo $item['commission2'];?>,<?php  echo $item['commission3'];?>" name="packgoods<?php  echo $item['goodsid'];?>">
                                    </td>
                                </tr>
                                <?php  } } ?>
                                </tbody>
                            </table>
                            <?php  } else { ?>
                            暂无商品
                            <?php  } ?>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group cgt cgt-0">
                        <label class="col-sm-2 control-label must">套餐价格</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <div class="input-group">
                                <input type='text' class='form-control' name='price' value="<?php  echo $item['price'];?>" data-price="" data-rule-required="true"/>
                                <span class="input-group-addon">元</span>
                            </div>
                            <span class="help-block image-block" style="display: block;">套餐价格为前台显示价格，具体按照套餐商品价格结算。</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['price'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group cgt cgt-0">
                        <label class="col-sm-2 control-label">运费设置</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <div class="input-group">
                                <input type='text' class='form-control' name='freight' value="<?php  echo $item['freight'];?>"/>
                                <span class="input-group-addon">元</span>
                            </div>
                            <span class="help-block image-block" style="display: block;">运费为固定邮费统一设置，设置为0，则免邮费。</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['freight'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">货到付款</label>
                        <div class="col-xs-12 col-sm-8">
                            <div class="input-group">
                                <?php if( ce('sale.package' ,$item) ) { ?>
                                <label class="radio radio-inline">
                                    <input type="radio" name="cash" value="0" <?php  if(intval($item['cash']) ==0) { ?>checked="checked"<?php  } ?>> 不支持
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" name="cash" value="1" <?php  if(intval($item['cash']) ==1 ) { ?>checked="checked"<?php  } ?>> 支持
                                </label>
                                <?php  } else { ?>
                                <div class='form-control-static'><?php  if(intval($item['cash']) ==1 ) { ?>支持<?php  } else { ?>不支持<?php  } ?></div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">限时设置</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <div class="input-group">
                                <span class="input-group-addon">开始时间</span>
                                <?php echo tpl_form_field_date('starttime', !empty($item['starttime']) ? date('Y-m-d H:i',$item['starttime']) :date('Y-m-d H:i'), 1)?>
                                <span class="input-group-addon">结束时间</span>
                                <?php echo tpl_form_field_date('endtime', !empty($item['endtime']) ? date('Y-m-d H:i',$item['endtime']) :date('Y-m-d H:i'), 1)?>
                            </div>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo date('Y-m-d H:i',$item['starttime'])?> - <?php  echo date('Y-m-d H:i',$item['endtime'])?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">分享标题</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <input type="text" name="share_title" id="share_title" class="form-control" value="<?php  echo $item['share_title'];?>" />
                            <span class='help-block'>如果不填写，默认为套餐名称</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['share_title'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分享图标</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <?php  echo tpl_form_field_image('share_icon', $item['share_icon'])?>
                            <span class='help-block'>如果不选择，默认为套餐缩略图片</span>
                            <?php  } else { ?>
                            <?php  if(!empty($item['share_icon'])) { ?>
                            <a href='<?php  echo tomedia($item['share_icon'])?>' target='_blank'>
                            <img src="<?php  echo tomedia($item['share_icon'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                            </a>
                            <?php  } ?>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分享描述</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <textarea name="share_desc" class="form-control" ><?php  echo $item['share_desc'];?></textarea>
                            <span class='help-block'>如果不填写，则使用店铺名称</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['share_desc'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">状态</label>
                        <div class="col-xs-12 col-sm-8">
                            <div class="input-group">
                                <?php if( ce('sale.package' ,$item) ) { ?>
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

<?php if( ce('sale.package' ,$item) ) { ?>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <input type="submit"  value="提交" class="btn btn-primary" />
    </div>
</div>
<?php  } ?>

</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>