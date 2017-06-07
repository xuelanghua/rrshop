<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> <h2>商城设置</h2> </div>

    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >
                <div class="form-group">
                    <label class="col-sm-2 control-label">商城名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
                        	<input type="text" name="data[name]" class="form-control" value="<?php  echo $data['name'];?>" />
                        <?php  } else { ?>
	                        <input type="hidden" name="data[name]" value="<?php  echo $data['name'];?>"/>
	                        <div class='form-control-static'><?php  echo $data['name'];?></div>
                        <?php  } ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商城LOGO</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
                        <?php  echo tpl_form_field_image('data[logo]', $data['logo'])?>
                        <span class='help-block'>正方型图片</span>
                        <?php  } else { ?>
                        <input type="hidden" name="data[logo]" value="<?php  echo $data['logo'];?>"/>
                        <?php  if(!empty($data['logo'])) { ?>
                        <a href='<?php  echo tomedia($data['logo'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($data['logo'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
             <div class="form-group">
                    <label class="col-sm-2 control-label">商城简介</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
                        <textarea name="data[description]" class="form-control richtext" cols="70"><?php  echo $data['description'];?></textarea>
                        <?php  } else { ?>
                        <textarea name="data[description]" class="form-control richtext" cols="70" style="display:none"><?php  echo $data['description'];?></textarea>
                        <div class='form-control-static'><?php  echo $data['description'];?></div>
                        <?php  } ?>
                    </div>
                </div>

	
                <div class="form-group">
                    <label class="col-sm-2 control-label">店招</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
                        <?php  echo tpl_form_field_image('data[img]', $data['img'])?>
                        <span class='help-block'>商城首页店招，建议尺寸640*450</span>
                        <?php  } else { ?>
                        <input type="hidden" name="data[img]" value="<?php  echo $data['img'];?>"/>
                        <?php  if(!empty($data['img'])) { ?>
                        <a href='<?php  echo tomedia($data['img'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($data['img'])?>" style='width:200px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商城海报</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
                        <?php  echo tpl_form_field_image('data[signimg]', $data['signimg'])?>
                        <span class='help-block'>推广海报，建议尺寸640*640</span>
                        <?php  } else { ?>
                        <input type="hidden" name="data[signimg]" value="<?php  echo $data['signimg'];?>"/>
                        <?php  if(!empty($data['signimg'])) { ?>
                        <a href='<?php  echo tomedia($data['signimg'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($data['signimg'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">获取未关注者信息</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="data[getinfo]" value="2" <?php  if($data['getinfo']==2) { ?>checked=""<?php  } ?>> 关闭
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="data[getinfo]" value="1" <?php  if(empty($data['getinfo']) || $data['getinfo']==1) { ?>checked=""<?php  } ?>> 开启
                        </label>
                        <?php  } else { ?>
                        <input type="hidden" name="data[name]" value="<?php  echo $data['name'];?>"/>
                        <div class='form-control-static'><?php  if($data['getinfo']==0) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
                        <?php  } ?>
                        <div class="help-block"> 如果开启此选项,则是会弹出绿色微信授权框</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">售罄图标</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
                        <?php  echo tpl_form_field_image('data[saleout]', $data['saleout'])?>
                        <span class='help-block'>商品售罄图标，建议尺寸80*80，空则不显示</span>
                        <?php  } else { ?>
                        <input type="hidden" name="data[saleout]" value="<?php  echo $data['saleout'];?>"/>
                        <?php  if(!empty($data['saleout'])) { ?>
                        <a href='<?php  echo tomedia($data['saleout'])?>' target='_blank'>
                        <img src="<?php  echo tomedia($data['saleout'])?>" style='width:200px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">加载图标</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
                            <?php  echo tpl_form_field_image('data[loading]', $data['loading'])?>
                            <span class='help-block'>商品列表图片加载图标，建议尺寸100*100(根据实际需求调整)，空则不显示</span>
                        <?php  } else { ?>
                            <input type="hidden" name="data[loading]" value="<?php  echo $data['loading'];?>"/>
                            <?php  if(!empty($data['loading'])) { ?>
                                <a href=""<?php  echo tomedia($data['loading'])?>" target='_blank'>
                                <img src="<?php  echo tomedia($data['loading'])?>" style='width:200px;border:1px solid #ccc;padding:1px' />
                                </a>
                            <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label">全局统计代码</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.shop.edit')) { ?>
			 <textarea name="data[diycode]" class="form-control richtext" cols="70" rows="5"><?php  echo $data['diycode'];?></textarea>
                        <?php  } else { ?>
                        <textarea name="data[diycode]" class="form-control richtext" cols="70" style="display:none"  rows="5"><?php  echo $data['diycode'];?></textarea>
                        <div class='form-control-static'><?php  echo $data['diycode'];?></div>
                        <?php  } ?>
                    </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">开启导航条</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sysset.shop.edit')) { ?>
                    <label class="radio-inline"><input type="radio" name="data[funbar]" value="0" <?php  if(empty($data['funbar'])) { ?>checked=""<?php  } ?>> 关闭</label>
                    <label class="radio-inline"><input type="radio" name="data[funbar]" value="1" <?php  if(intval($data['funbar'])==1) { ?>checked=""<?php  } ?>> 样式一(左侧满屏可折叠)</label>
                    <label class="radio-inline"><input type="radio" name="data[funbar]" value="2" <?php  if(intval($data['funbar'])==2) { ?>checked=""<?php  } ?>> 样式二(右侧跟随)</label>
                    <?php  } else { ?>
                    <input type="hidden" name="data[name]" value="<?php  echo $data['name'];?>"/>
                    <div class='form-control-static'><?php  if(empty($data['funbar'])) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
                    <?php  } ?>
                    <div class="help-block"> 如果开启此选项，导航内容请到导航条中编辑</div>
                </div>
            </div>
			
			
			<div class="form-group">
		        <label class="col-sm-2 control-label">左侧快捷进入</label>
		        <div class="col-sm-9 col-xs-12">
		            <?php if(cv('sysset.shop.edit')) { ?>
		            <label class="radio-inline">
		                <input type="radio" name="data[yingyong_flag]" value='1' <?php  if($data['yingyong_flag']==1) { ?>checked<?php  } ?> /> 关闭
		            </label>
		            <label class="radio-inline">
		                <input type="radio" name="data[yingyong_flag]" value='0' <?php  if($data['yingyong_flag']==0) { ?>checked<?php  } ?> /> 开启
		            </label>
		
		            <?php  } else { ?>
		
		            <div class='form-control-static'><?php  if($data['yingyong_flag']==0) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
		            <?php  } ?>
		        </div>
		    </div>
				 
				 
  
	 
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.shop.edit')) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  />
                          <?php  } ?>
                     </div>
            </div>
	 
 
    </form>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>