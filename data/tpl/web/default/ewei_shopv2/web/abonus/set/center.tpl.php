<?php defined('IN_IA') or exit('Access Denied');?> <div class="form-group">
                <label class="col-sm-2 control-label">会员中心显示区域代理入口</label>
                <div class="col-sm-9 col-xs-12">
                	<?php if(cv('abonus.set.edit')) { ?>
                	<label class="radio-inline"><input type="radio"  name="data[openmembercenter]" value="0" <?php  if(empty($data['openmembercenter'])) { ?> checked="checked"<?php  } ?> /> 关闭</label>
                    <label class="radio-inline"><input type="radio"  name="data[openmembercenter]" value="1" <?php  if($data['openmembercenter'] ==1) { ?> checked="checked"<?php  } ?> /> 显示</label>
                    <span class="help-block">会员中心是否显示区域代理中心入口</span>
                    <?php  } else { ?>
                    	<?php  if(empty($data['openorderdetail'])) { ?>关闭<?php  } else { ?>显示<?php  } ?>
                    <?php  } ?>

                </div> 
           </div>
	   <div class="form-group">
                <label class="col-sm-2 control-label">分销中心显示区域代理中心入口</label>
                <div class="col-sm-9 col-xs-12">
                	<?php if(cv('abonus.set.edit')) { ?>
                	<label class="radio-inline"><input type="radio"  name="data[closecommissioncenter]" value="0" <?php  if(empty($data['closecommissioncenter'])) { ?> checked="checked"<?php  } ?> /> 显示</label>
                    <label class="radio-inline"><input type="radio"  name="data[closecommissioncenter]" value="1" <?php  if($data['closecommissioncenter'] ==1) { ?> checked="checked"<?php  } ?> /> 关闭</label>
                    <span class="help-block">分销中心是否显示区域代理中心入口</span>
                    <?php  } else { ?>
                    	<?php  if(!empty($data['closecommissioncenter'])) { ?>关闭<?php  } else { ?>显示<?php  } ?>
                    <?php  } ?>

                </div> 
           </div>

 <div class="form-group">
     <label class="col-sm-2 control-label">区域代理须知</label>
     <div class="col-sm-9 col-xs-12">
         <?php if(cv('abonus.set.edit')) { ?>
           <textarea class="form-control" name="data[centerdesc]" rows="5"><?php  echo $data['centerdesc'];?></textarea>
         <span class="help-block">在区域代理中心显示</span>
         <?php  } else { ?>
            <?php  echo $data['centerdesc'];?>
         <?php  } ?>
     </div>
 </div>


 <div class="form-group">
     <label class="col-sm-2 control-label">申请说明</label>
     <div class="col-sm-9 col-xs-12">
         <?php if(cv('abonus.set.edit')) { ?>
         <label class="radio-inline"><input type="radio"  name="data[register_bottom]" value="0" <?php  if(empty($data['register_bottom'])) { ?> checked="checked"<?php  } ?> /> 默认</label>
         <label class="radio-inline"><input type="radio"  name="data[register_bottom]" value="1" <?php  if($data['register_bottom'] ==1) { ?> checked="checked"<?php  } ?> /> 模式1(标题和内容替换)</label>
         <label class="radio-inline"><input type="radio"  name="data[register_bottom]" value="2" <?php  if($data['register_bottom'] ==2) { ?> checked="checked"<?php  } ?> /> 模式2(整体替换)</label>
         <?php  } else { ?>
         <?php  if(empty($data['register_bottom'])) { ?>否<?php  } else { ?>是<?php  } ?>
         <?php  } ?>
         <span class="help-block"></span>
     </div>
 </div>

 <div class="r-group12" <?php  if(empty($data['register_bottom'])) { ?>style="display: none"<?php  } ?>>
 <div class="col-sm-5">
     <img src="../addons/ewei_shopv2/plugin/abonus/static/images/register_example.jpg" height="100%" width="100%"/>
 </div>
 </div>


 <div class="col-sm-7 r-group1" <?php  if($data['register_bottom']!=1) { ?>style="display: none"<?php  } ?>>

 <div class="form-group">
     <label class="col-sm-2 control-label"></label>
     <div class="col-sm-9 col-xs-12">
         图中的小图标不可替换
     </div>
 </div>

 <div class="form-group">
     <label class="col-sm-2 control-label">标题1</label>
     <div class="col-sm-9 col-xs-12">
         <?php if(cv('abonus.set.edit')) { ?>
         <input type='text' class='form-control' name='data[register_bottom_title1]' value="<?php  echo $data['register_bottom_title1'];?>" />
         <?php  } else { ?>
         <?php  echo $data['register_bottom_title1'];?>
         <?php  } ?>
     </div>
 </div>

 <div class="form-group">
     <label class="col-sm-2 control-label">内容1</label>
     <div class="col-sm-9 col-xs-12">
         <?php if(cv('abonus.set.edit')) { ?>
         <textarea class='form-control' name="data[register_bottom_content1]" rows="3"><?php  echo $data['register_bottom_content1'];?></textarea>
         <?php  } else { ?>
         <?php  echo $data['register_bottom_content1'];?>
         <?php  } ?>
     </div>
 </div>

 <div class="form-group">
     <label class="col-sm-2 control-label">标题2</label>
     <div class="col-sm-9 col-xs-12">
         <?php if(cv('abonus.set.edit')) { ?>
         <input type='text' class='form-control' name='data[register_bottom_title2]' value="<?php  echo $data['register_bottom_title2'];?>" />
         <?php  } else { ?>
         <?php  echo $data['register_bottom_title2'];?>
         <?php  } ?>
     </div>
 </div>

 <div class="form-group">
     <label class="col-sm-2 control-label">内容2</label>
     <div class="col-sm-9 col-xs-12">
         <?php if(cv('abonus.set.edit')) { ?>
         <textarea class='form-control' name="data[register_bottom_content2]" rows="3"><?php  echo $data['register_bottom_content2'];?></textarea>
         <?php  } else { ?>
         <?php  echo $data['register_bottom_content2'];?>
         <?php  } ?>
     </div>
 </div>

 <div class="form-group">
     <label class="col-sm-2 control-label">说明</label>
     <div class="col-sm-9 col-xs-12">
         <?php if(cv('abonus.set.edit')) { ?>
         <textarea class='form-control' name="data[register_bottom_remark]" rows="6"><?php  echo $data['register_bottom_remark'];?></textarea>
         <?php  } else { ?>
         {$data['register_bottom_remark ']}
         <?php  } ?>
     </div>
 </div>
 </div>

 <div class="col-sm-7 r-group2" <?php  if($data['register_bottom']!=2) { ?>style="display: none"<?php  } ?>>
 <div class="form-group">
     <label class="col-sm-2 control-label"></label>
     <div class="col-sm-9 col-xs-12">
         <?php if(cv('abonus.set.edit')) { ?>
         <?php  echo tpl_ueditor('data[register_bottom_content]',$data['register_bottom_content'],array('height'=>200))?>
         <?php  } else { ?>
         <textarea id='register_bottom_content' style='display:none'><?php  echo $data['register_bottom_content'];?></textarea>
         <a href='javascript:preview_html("#register_bottom_content")' class="btn btn-default">查看内容</a>
         <?php  } ?>
     </div>
 </div>
 </div>

 <script>
     $(function () {
         $(":radio[name='data[register_bottom]']").on('click',function (e) {
             var $this = $(this);

             if($this.val()==0){
                 $(".r-group12").hide();
                 $(".r-group1").hide();
                 $(".r-group2").hide();
             } else if($this.val()==1){
                 $(".r-group12").show();
                 $(".r-group1").show();
                 $(".r-group2").hide();
             } else if($this.val()==2){
                 $(".r-group12").show();
                 $(".r-group1").hide();
                 $(".r-group2").show();
             }
         })
     });
 </script>