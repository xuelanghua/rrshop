<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> <h2>分类层级设置</h2> </div>

    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >
   
  
                <div class="form-group">
                    <label class="col-sm-2 control-label">分类级别</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.category.edit')) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="data[level]" value="-1" <?php  if($data['level']==-1) { ?>checked<?php  } ?> /> 无
                        </label>
	             <label class="radio-inline">
                            <input type="radio" name="data[level]" value="1" <?php  if($data['level']==1) { ?>checked<?php  } ?> /> 一级
                        </label>
						
                        <label class="radio-inline">
                            <input type="radio" name="data[level]" value="2" <?php  if($data['level']==2 || empty($data['level'])) { ?>checked<?php  } ?> /> 二级
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="data[level]" value="3" <?php  if($data['level']==3) { ?>checked<?php  } ?>/> 三级
                        </label>
		  
						
                        <?php  } else { ?>
                        <input type="hidden" name="data[level]" value="<?php  echo $data['level'];?>" />
                        <div class='form-control-static'>
							<?php  if($data['level']==-1) { ?>
							无分类
							<?php  } else if($data['level']==1) { ?>
							一级
							<?php  } else if($data['level']==2 || empty($data['level'])) { ?>
							二级
							<?php  } else if($data['level']==3) { ?>
							三级
							<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">显示形式</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.category.edit')) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="data[show]" value="0" <?php  if(empty($data['show'])) { ?>checked<?php  } ?> /> 单页
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="data[show]" value="1" <?php  if($data['show']==1) { ?>checked<?php  } ?>/> 多页
                        </label>
                        <?php  } else { ?>
                        <input type="hidden" name="data[show]" value="<?php  echo $data['show'];?>" />
                        <div class='form-control-static'><?php  if(empty($data['show'])) { ?>单页<?php  } else { ?>多页<?php  } ?></div>
                        <?php  } ?>
                    </div> 
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">显示样式</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.category.edit')) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="data[style]" value="0" <?php  if(empty($data['style'])) { ?>checked<?php  } ?> /> 圆形
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="data[style]" value="1" <?php  if($data['style']==1) { ?>checked<?php  } ?>/> 方形
                        </label>
                        <?php  } else { ?>
                        <input type="hidden" name="data[style]" value="<?php  echo $data['style'];?>" />
                        <div class='form-control-static'><?php  if(empty($data['style'])) { ?>圆形{style}方形<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">推荐分类广告</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.category.edit')) { ?>
                        <?php  echo tpl_form_field_image('data[advimg]', $data['advimg'])?>
                        <span class='help-block'>分类页面中，推荐分类的广告图，建议尺寸640*320</span>
                        <?php  } else { ?>
                        <input type="hidden" name="data[advimg]" value="<?php  echo $data['advimg'];?>" />
                        <?php  if(!empty($data['advimg'])) { ?>
                        <a href='<?php  echo tomedia($data['advimg'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($data['advimg'])?>" style='width:200px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">推荐分类广告链接</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.category.edit')) { ?>
	                        <div class="input-group form-group">
								<input type="text" name="data[advurl]" class="form-control" value="<?php  echo $data['advurl'];?>" id="advurl" />
								<span data-input="#advurl" data-toggle="selectUrl" class="input-group-addon btn btn-default">选择链接</span>
							</div>
                        <?php  } else { ?>
                        <input type="hidden" name="data[advurl]" value="<?php  echo $data['advurl'];?>" />
                        <div class='form-control-static'><?php  echo $data['advurl'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                  <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.category.edit')) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  />
                            
                          <?php  } ?>
                     </div>
            </div>
  
    </form>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     