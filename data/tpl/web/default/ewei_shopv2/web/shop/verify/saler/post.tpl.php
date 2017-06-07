<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"> 
	
	<span class='pull-right'>
		
		<?php if(cv('shop.verify.saler.add')) { ?>
                            <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('shop/verify/saler/add')?>">添加新店员</a>
		<?php  } ?>
                
		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('shop/verify/saler')?>">返回列表</a>
                
                
	</span>
	<h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>店员 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['salername'];?>】<?php  } ?></small></h2> 
</div>

    <form <?php if( ce('shop.verify.saler' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
 
               
                <div class="form-group">
                    <label class="col-sm-2 control-label must">选择会员</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.verify.saler' ,$item) ) { ?>
                           <?php  echo tpl_selector('openid',array('key'=>'openid', 'required'=>true, 'text'=>'nickname', 'thumb'=>'avatar','placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择会员 ', 'items'=>$saler,'url'=>webUrl('member/query') ))?>
                        <?php  } else { ?>
                             <?php  if(!empty($saler)) { ?>
                             <span class='help-block'><img  style="width:100px;height:100px;border:1px solid #ccc;padding:1px" src="<?php  echo tomedia($saler['avatar'])?>"/><br/>
                                 <?php  if(!empty($saler)) { ?><?php  echo $saler['nickname'];?>/<?php  echo $saler['realname'];?>/<?php  echo $saler['mobile'];?><?php  } ?></span>
                            <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
				
				  
                <div class="form-group">
                    <label class="col-sm-2 control-label must">店员姓名</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.verify.saler' ,$item) ) { ?>
                        <input type="text" name="salername" class="form-control" value="<?php  echo $item['salername'];?>" data-rule-required='true'/>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['salername'];?></div>
                        <?php  } ?>
                    </div>
                </div>
					   
                 <div class="form-group">
                    <label class="col-sm-2 control-label">所属门店</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( ce('shop.verify.saler' ,$item) ) { ?>
                          <?php  echo tpl_selector('storeid',array('text'=>'storename','preview'=>true,'type'=>'text',  'thumb'=>'avatar','placeholder'=>'门店名称','buttontext'=>'选择门店 ', 'items'=>$store,'url'=>webUrl('shop/verify/store/query')))?>
						  <span class='help-block'>如果不选择门店，则可以进行全门店的核销</span>
                        <?php  } else { ?>
                           <div class='form-control-static'><?php  if(empty($store['storename'])) { ?>全店核销<?php  } else { ?><?php  echo $store['storename'];?><?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-9 col-xs-12">
                             <?php if( ce('shop.verify.saler' ,$item) ) { ?>
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
                
           <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( ce('shop.verify.saler' ,$item) ) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  />
                            
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('shop.verify.saler.add|shop.verify.saler.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
            </div>
    </form>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
 