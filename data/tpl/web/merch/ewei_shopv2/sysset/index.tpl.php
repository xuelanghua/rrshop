<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> <h2>商城设置</h2> </div>
 
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >
        <div class="form-group">
            <label class="col-sm-2 control-label must">商户名称</label>
            <div class="col-sm-8">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <input type="text" class="form-control" name="merchname" value="<?php  echo $item['merchname'];?>" data-rule-required="true"/>
                <?php  } else { ?>
                <div class="form-control-static"><?php  echo $item['merchname'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">商户logo</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <?php  echo tpl_form_field_image('logo',$item['logo'],'../addons/ewei_shopv2/static/images/nopic.jpg',array('dest_dir'=>'merch/'.$_W['merchid']))?>
                <span class="help-block">商户logo 建议尺寸 300 * 300</span>
                <?php  } else { ?>
                <?php  if(empty($item['logo'])) { ?>
                <img src="../addons/ewei_shopv2/static/images/nopic.jpg" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
                <?php  } else { ?>
                <img src="<?php  echo tomedia($item['logo'])?>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
                <?php  } ?>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label must">主营项目</label>
            <div class="col-sm-8">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <input type="text" class="form-control" name="salecate" value="<?php  echo $item['salecate'];?>" data-rule-required="true"/>
                <?php  } else { ?>
                <div class="form-control-static"><?php  echo $item['merchname'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">联系人</label>
            <div class="col-sm-8">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <input type="text" class="form-control" name="realname" value="<?php  echo $item['realname'];?>" data-rule-required="true"/>
                <?php  } else { ?>
                <div class="form-control-static"><?php  echo $item['realname'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">联系电话</label>
            <div class="col-sm-8">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <input type="tel" class="form-control" name="mobile" value="<?php  echo $item['mobile'];?>" data-rule-required="true"/>
                <?php  } else { ?>
                <div class="form-control-static"><?php  echo $item['mobile'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">商户简介</label>
            <div class="col-sm-8">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <textarea name="desc1" class="form-control"><?php  echo $item['desc'];?></textarea>
                <?php  } else { ?>
                <div class="form-control-static"><?php  echo $item['desc'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">商户地址</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <input type="text" name="address" class="form-control" value="<?php  echo $item['address'];?>" />
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['address'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">商户电话</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <input type="text" name="tel" class="form-control" value="<?php  echo $item['tel'];?>" />
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['tel'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">商户位置</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(mcv('sysset.shop.edit')) { ?>
                <?php  echo tpl_form_field_coordinate('map',array('lng'=>$item['lng'],'lat'=>$item['lat']))?>
                <?php  } else { ?>
                <div class='form-control-static'>lng=<?php  echo $item['lng'];?>,lat=<?php  echo $item['lat'];?></div>
                <?php  } ?>
            </div>
        </div>

        <?php  if($diyform_flag) { ?>
        <div class="form-group-title">追加资料</div>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/diyform_input', TEMPLATE_INCLUDEPATH)) : (include template('diyform/diyform_input', TEMPLATE_INCLUDEPATH));?>
        <?php  } else { ?>
        <?php  } ?>
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(mcv('sysset.shop.edit')) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  />
                          <?php  } ?>
                     </div>
            </div>
	 
 
    </form>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     