<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='page-heading'><h2>满额包邮设置</h2></div>
 
    <form id="dataform"    <?php if(cv('sale.enoughfree')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate">
      
          
          <div class="panel panel-default" >
         <div class="panel-body">
        <div class="col-sm-9 col-xs-12">
            <h4>满额包邮</h4>
            <span> 开启满包邮, 订单总金额超过多少可以包邮</span>
        </div>
        <div class="col-sm-2 pull-right" style="padding-top:10px;text-align: right" >
            <?php if(cv('sale.enoughfree')) { ?>
	<input type="checkbox" class="js-switch" name="data[enoughfree]" value="1" <?php  if($data['enoughfree']==1) { ?>checked<?php  } ?> />
               <?php  } else { ?>
               <?php  if($data['enoughfree']==1) { ?>
               <span class='text-success'>开启</span>
               <?php  } else { ?>
               <span class='text-default'>关闭</span>
               <?php  } ?>
               <?php  } ?>
        </div>
 </div>  
 
                <div id='enoughfree'  <?php  if(empty($data['enoughfree'])) { ?>style="display:none"<?php  } ?>>
                  <div class="form-group">
                       <label class="col-sm-2 control-label">单笔订单满</label>
                       <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sale.enoughfree')) { ?>
                          <div class='input-group'>
                                   <input type="text" name="data[enoughorder]"  value="<?php  echo $data['enoughorder'];?>" class="form-control" />
                                   <span class='input-group-addon'>元</span>
                           </div>
                           <span class='help-block'>如果开启满额包邮，设置0为全场包邮</span>
                           <?php  } else { ?>
                           <div class='form-control-static'><?php  if(empty($data['enoughmoney'])) { ?>全场包邮<?php  } else { ?>订单金额满<?php  echo $data['enoughmoney'];?>元包邮<?php  } ?></div>
                           <?php  } ?>
                       </div>
                   </div> 
                
                
                  <div class="form-group">
                       <label class="col-sm-2 control-label">不参加的地区</label>
                       <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sale.enoughfree')) { ?>
                           <div id="areas" class="form-control-static"><?php  echo $data['enoughareas'];?></div>
                           <a href="javascript:;" class="btn btn-default" onclick="selectAreas()">选择地区</a>
                           <input type="hidden" id='selectedareas' name="data[enoughareas]" value="<?php  echo $data['enoughareas'];?>" />
                           <input type="hidden" id='selectedareas_code' name="data[enoughareas_code]" value="<?php  echo $data['enoughareas_code'];?>" />
                           <?php  } else { ?>
                           <div class='form-control-static'><?php  echo $data['enoughareas'];?></div>
                           <?php  } ?>
                       </div>
                   </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">不参与包邮的商品</label>
                      <div class="col-sm-9">
                          <div class="form-group" style="height: auto; display: block;">
                              <div class="col-sm-12 col-xs-12">
                                  <?php if(cv('sale.enoughfree')) { ?>
                                  <?php  echo tpl_selector('goodsids',array('preview'=>true,'readonly'=>true, 'multi'=>1,'url'=>webUrl('goods/query'),'items'=>$goods,'buttontext'=>'选择商品','placeholder'=>'请选择商品'))?>
                                  <?php  } else { ?>
                                  <div class="input-group multi-img-details container ui-sortable">
                                      <?php  if(is_array($goods)) { foreach($goods as $item) { ?>
                                      <div data-name="goodsid" data-id="<?php  echo $item['id'];?>" class="multi-item">
                                          <img src="<?php  echo tomedia($item['thumb'])?>" class="img-responsive img-thumbnail">
                                          <div class="img-nickname"><?php  echo $item['title'];?></div>
                                      </div>
                                      <?php  } } ?>
                                  </div>
                                  <?php  } ?>
                              </div>
                          </div>

                      </div>
                  </div>
          </div>
        </div>

                   <?php if(cv('sale.enoughfree')) { ?>
                <div class="form-group"></div>
                   <div class="form-group">
                            
                           <div class="col-sm-9 col-xs-12">
                                 <input type="submit"  value="保存设置" class="btn btn-primary"/>
                                 
                           </div>
                    </div>
                <?php  } ?>
 
     
    </form>
 
<script language='javascript'>
  
                $(function () {
                    $(":checkbox[name='data[enoughfree]']").click(function () {
                        if ($(this).prop('checked')) {
                            $("#enoughfree").show();
                        }
                        else {
                            $("#enoughfree").hide();
                        }
                    })
                   

                })
         
             
	</script>

<?php  if(empty($new_area)) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('shop/selectareas', TEMPLATE_INCLUDEPATH)) : (include template('shop/selectareas', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('shop/selectareasNew', TEMPLATE_INCLUDEPATH)) : (include template('shop/selectareasNew', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
