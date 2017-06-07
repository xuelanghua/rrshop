<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .multi-img-details .multi-item img{height:100px;}
</style>
<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('sale.gift.add')) { ?>
        	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sale/gift/add',array('type'=>$type))?>"><i class='fa fa-plus'></i> 添加赠品</a>
        <?php  } ?>
        <a class="btn btn-default  btn-sm" href="<?php  echo webUrl('sale/gift',array('type'=>$type))?>">返回列表</a>
    </span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>赠品 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></h2>
</div>


<form <?php if( ce('sale.gift' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="tab-content ">
            <div class="tab-pane active">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <input type='text' class='form-control' name='displayorder' value="<?php  echo $item['displayorder'];?>" />
                            <span class="help-block">数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label must">赠品标题</label>
                        <div class="col-sm-9 col-xs-12 ">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <input type="text" id='title' name="title" class="form-control" value="<?php  echo $item['title'];?>" data-rule-required="true"/>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['title'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">活动类型</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="hidden" name="activitytype" value="<?php  echo $item['activity'];?>">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <label class="radio-inline">
                                <input type="radio" name="activity" value="1" <?php  if(!empty($item['id'])) { ?>disabled<?php  } ?> <?php  if(empty($item['activity']) || $item['activity'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#order').show();$('#product').hide();" />
                                订单金额
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="activity" value="2" <?php  if(!empty($item['id'])) { ?>disabled<?php  } ?>  <?php  if($item['activity'] == 2) { ?>checked="true"<?php  } ?>  onclick="$('#product').show();$('#order').hide();" />
                                指定商品
                            </label>
                            <span class="help-block">赠品类型，赠品保存后无法修改，请谨慎选择</span>
                            <?php  } else { ?>
                            <div class='form-control-static'>
                                <?php  if($item['activity'] == 1) { ?>
                                订单金额
                                <?php  } else if($item['activity']==2) { ?>
                                指定商品
                                <?php  } ?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group cgt cgt-0" id="order" <?php  if($item['activity']==2) { ?>style="display:none;"<?php  } ?>>
                        <label class="col-sm-2 control-label must">订单金额</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <div class="input-group">
                                <input type='text' class='form-control' name='orderprice' value="<?php  echo $item['orderprice'];?>" data-rule-required="true"/>
                                <span class="input-group-addon">元</span>
                            </div>
                            <span class="help-block image-block" style="display: block;">订单金额为赠品活动最低条件。</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['orderprice'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group" id="product" <?php  if($item['activity']==1 || empty($item['activity'])) { ?>style="display:none;"<?php  } ?>>
                        <label class="col-sm-2 control-label">指定商品</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <?php  echo tpl_selector('goodsid',
                        array('multi'=>1,
                            'type'=>'image',
                            'placeholder'=>'指定商品名称',
                            'buttontext'=>'选择商品',
                            'items'=>$goods,
                            'nokeywords'=>1,
                            'autosearch'=>1,
                            'url'=>webUrl('sale/gift/querygoods')))?>
                            <?php  } else { ?>
                            <?php  if(is_array($goods)) { foreach($goods as $item) { ?>
                            <a href='<?php  echo tomedia($item["thumb"])?>' target='_blank'>
                                <img src="<?php  echo tomedia($item['thumb'])?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
                            </a>
                            <?php  } } ?>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">赠品缩略图</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
                            <span class="help-block image-block" style="display: block;">建议为正方型图片，尺寸建议宽度为640，如果不上传默认为第一件赠品缩略图。</span>
                            <?php  } else { ?>
                            <input type="hidden" name="thumb" value="<?php  echo $item['thumb'];?>" />
                            <div class='form-control-static'><?php  echo $item['thumb'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">选择赠品</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <?php  echo tpl_selector('giftgoodsid',
                        array('multi'=>1,
                            'type'=>'image',
                            'placeholder'=>'自定义赠品名称',
                            'buttontext'=>'选择赠品',
                            'items'=>$gift,
                            'nokeywords'=>1,
                            'autosearch'=>1,
                            'url'=>webUrl('sale/gift/querygift')))?>
                            <span class="help-block image-block" style="display: block;">选择指定的商品参加赠品活动。</span>
                            <?php  } else { ?>
                            <?php  if(is_array($gift)) { foreach($gift as $item) { ?>
                            <a href='<?php  echo tomedia($item["thumb"])?>' target='_blank'>
                                <img src="<?php  echo tomedia($item['thumb'])?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
                            </a>
                            <?php  } } ?>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">限时设置</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
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
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <input type="text" name="share_title" id="share_title" class="form-control" value="<?php  echo $item['share_title'];?>" />
                            <span class='help-block'>如果不填写，默认为赠品名称</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['share_title'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分享图标</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.gift' ,$item) ) { ?>
                            <?php  echo tpl_form_field_image('share_icon', $item['share_icon'])?>
                            <span class='help-block'>如果不选择，默认为赠品缩略图片</span>
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
                            <?php if( ce('sale.gift' ,$item) ) { ?>
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
                                <?php if( ce('sale.gift' ,$item) ) { ?>
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

<?php if( ce('sale.gift' ,$item) ) { ?>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <input type="submit"  value="提交" class="btn btn-primary" />
    </div>
</div>
<?php  } ?>

</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>