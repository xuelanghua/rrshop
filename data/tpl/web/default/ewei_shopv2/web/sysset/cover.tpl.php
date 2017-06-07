<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2><?php  echo $cover['name'];?>入口设置</h2> </div>
<form id="setform"  action="" method="post" class="form-horizontal form-validate" >
 
           <div class="form-group">
                <label class="col-sm-2 control-label">直接链接</label>
                <div class="col-sm-9 col-xs-12">
                    <p class='form-control-static'>
                        <a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php  echo $cover['url']?>" ><?php  echo $cover['url']?></a>
                        <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true"
                              data-content="<img src='<?php  echo m('qrcode')->createQrcode($cover['url'])?>' width='130' alt='链接二维码'>" data-placement="auto right">
                            <i class="glyphicon glyphicon-qrcode"></i>
                        </span>
                    </p>
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-sm-2 control-label must" >关键词</label>
                <div class="col-sm-9 col-xs-12">
                	<?php if(cv('sysset.cover.' . $cover['key'] . '.edit')) { ?>
                     <input type='text' class='form-control' name='cover[keyword]' value="<?php  echo $cover['keyword']['content'];?>" data-rule-required="true" />
                    <?php  } else { ?>
                    	<div class='form-control-static'><?php  echo $cover['keyword']['content'];?></div>
                    <?php  } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">封面标题</label>
                <div class="col-sm-9 col-xs-12">
                	<?php if(cv('sysset.cover.' . $cover['key'] . '.edit')) { ?>
                     	<input type='text' class='form-control' name='cover[title]' value="<?php  echo $cover['cover']['title'];?>" />
                     <?php  } else { ?>
                     	<div class='form-control-static'><?php  echo $cover['cover']['title'];?></div>
                     <?php  } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">封面图片</label>
                <div class="col-sm-9 col-xs-12">
                	<?php if(cv('sysset.cover.' . $cover['key'] . '.edit')) { ?>
                     	<?php  echo tpl_form_field_image('cover[thumb]',$cover['cover']['thumb'])?>
                     <?php  } else { ?>
                     
	                      <?php  if(!empty($cover['cover']['thumb'])) { ?>
	                        <a href="<?php  echo tomedia($cover['cover']['thumb'])?>" target='_blank'>
	                           <img src="<?php  echo tomedia($cover['cover']['thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
	                        </a>
	                        <?php  } ?>
	                        
                        <?php  } ?>
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">封面描述</label>
                <div class="col-sm-9 col-xs-12">
                	<?php if(cv('sysset.cover.' . $cover['key'] . '.edit')) { ?>
                    	<textarea name='cover[desc]' class='form-control'><?php  echo $cover['cover']['description'];?></textarea>
                     <?php  } else { ?>
                     	<div class='form-control-static'><?php  echo $cover['cover']['description'];?></div>
                     <?php  } ?>
                </div>
            </div>
               <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-9">
                	<?php if(cv('sysset.cover.' . $cover['key'] . '.edit')) { ?>
	                    <label class="radio-inline">
	                        <input type="radio" name="cover[status]" value="0" <?php  if(empty($cover['rule']['status'])) { ?> checked="checked"<?php  } ?> />
	                               禁用
	                    </label>
	                    <label class="radio-inline">
	                        <input type="radio" name="cover[status]" value="1" <?php  if($cover['rule']['status']==1) { ?> checked="checked"<?php  } ?>/>
	                               启用
	                    </label>
                    <?php  } else { ?>
                    	<?php echo empty($cover['rule']['status'])?'禁用':'启用'?>
                    <?php  } ?>
                </div>
            </div>
          
         <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
            	<?php if(cv('sysset.cover.' . $cover['key'] . '.edit')) { ?>
                	<input type="submit" value="提交" class="btn btn-primary" />
                <?php  } ?>
            </div>
        </div>
 
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>