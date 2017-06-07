<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> <h2>会员设置</h2> </div>

    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >
    
   
				
                <div class="form-group">
                    <label class="col-sm-2 control-label">会员等级说明链接</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.member.edit')) { ?>
                        <input type="text" name="data[levelurl]" class="form-control" value="<?php  echo $data['levelurl'];?>" />
                        <?php  } else { ?>
                        <input type="hidden" name="data[levelurl]" value="<?php  echo $data['levelurl'];?>" />
                        <div class='form-control-static'><?php  echo $data['levelurl'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                	<div class="form-group">
                    <label class="col-sm-2 control-label">会员等级升级依据</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.member.edit')) { ?>
                        <label class="radio radio-inline">
                              <input type="radio" name="data[leveltype]" value="0" <?php  if(empty($data['leveltype'])) { ?>checked<?php  } ?>/> 已完成的订单金额
                        </label>
                       <label class="radio radio-inline">
                              <input type="radio" name="data[leveltype]" value="1" <?php  if($data['leveltype']==1) { ?>checked<?php  } ?>/> 已完成的订单数量
                        </label>
                        <span class="help-block">默认为完成订单金额</span> 
                        <?php  } else { ?>
                        <input type="hidden" name="data[leveltype]" value="<?php  echo $data['leveltype'];?>" />
                        <div class='form-control-static'>
							<?php  if(empty($data['leveltype'])) { ?>
							 已完成的订单金额
							 <?php  } else if($data['leveltype']==1) { ?>
							 已完成的订单数量
							 <?php  } ?>
						</div>
                        <?php  } ?>
                    </div>
                </div>
 
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.member.edit')) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  />
                            
                          <?php  } ?>
                     </div>
            </div>
      
    </form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     
