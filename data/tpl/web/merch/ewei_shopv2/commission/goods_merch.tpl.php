<?php defined('IN_IA') or exit('Access Denied');?><script language="javascript">
    $(function() {
        $("#hascommission").click(function() {
            var obj = $(this);
            if (obj.get(0).checked) {
                $("#commission_div").show();
            } else {
                $("#commission_div").hide();
            }
        });
    })
</script>
<div class="form-group">
    <label class="col-sm-2 control-label">是否参与分销</label>
    <div class="col-sm-9 col-xs-12">
          <?php if( mce('goods' ,$item) ) { ?>
       <label class="radio-inline">
            <input type="radio"  value="0" name="nocommission" <?php  if($item['nocommission']==0) { ?>checked<?php  } ?> /> 参与分销
        </label>
        <label class="radio-inline">
            <input type="radio"  value="1" name="nocommission" <?php  if($item['nocommission']==1) { ?>checked<?php  } ?> /> 不参与分销
        </label>
        <span class="help-block">如果不参与分销，则不产生分销佣金</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($item['nocommission']==1) { ?>不参与分销<?php  } else { ?>参与分销<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">分享按钮</label>
    <div class="col-sm-9 col-xs-12">
          <?php if( mce('goods' ,$item) ) { ?>
       <label class="radio-inline">
            <input type="radio"  value="0" name="sharebtn" <?php  if(empty($item['sharebtn'])) { ?>checked<?php  } ?> /> 弹出关注提示层
        </label>
        <label class="radio-inline">
            <input type="radio"  value="1" name="sharebtn" <?php  if(!empty($item['sharebtn'])) { ?>checked<?php  } ?> /> 跳转至商品海报
        </label>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($item['nocommission']==1) { ?>不参与分销<?php  } else { ?>参与分销<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">海报图片</label>
    <div class="col-sm-9 col-xs-12">
           <?php if( mce('goods' ,$item) ) { ?>
        <?php  echo tpl_form_field_image('commission_thumb', $item['commission_thumb'])?>
        <span class='help-block'>尺寸: 640*640，如果为空默认缩略图片</span>
         <?php  } else { ?>
                            <?php  if(!empty($item['commission_thumb'])) { ?>
                                  <a href='<?php  echo tomedia($item['commission_thumb'])?>' target='_blank'>
                            <img src="<?php  echo tomedia($item['commission_thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                                  </a>
                            <?php  } ?>
                        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">独立规则</label>
    <div class="col-sm-9 col-xs-12">
          <?php if( mce('goods' ,$item) ) { ?>
       <label class="checkbox-inline">
        <input type="checkbox" id="hascommission" value="1" name="hascommission" <?php  if($item['hascommission']==1) { ?>checked<?php  } ?> />启用独立佣金比例
    </label>
        <span class="help-block">启用独立佣金设置，此商品拥有独自的佣金比例,不受分销商等级比例及默认设置限制</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($item['hascommission']==1) { ?>启用独立佣金设置<?php  } else { ?>不启用独立佣金设置<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
 
<div id="commission_div" <?php  if(empty($item['hascommission'])) { ?>style="display:none"<?php  } ?> >

<div id="commission_0"  <?php  if($commission_type!=0) { ?> style="display:none;" <?php  } ?>>
<div class='alert alert-danger'>
    如果比例为空，则使用固定规则，如果都为空则无分销佣金
</div>
    <?php  if($com_set['level']>=1) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">一级分销</label>
        <div class="col-sm-4 col-xs-12">
                     <?php if( mce('goods' ,$item) ) { ?>
            <div class="input-group">
                <input type="text" name="commission1_rate" id="commission1_rate" class="form-control" value="<?php  echo $item['commission1_rate'];?>" />
                <div class="input-group-addon">% 固定</div>
                 <input type="text" name="commission1_pay" id="commission1_pay" class="form-control" value="<?php  echo $item['commission1_pay'];?>" />
                <div class="input-group-addon">元</div>
            </div>
                     <?php  } else { ?>
                     <div class='form-control-static'>比例: <?php  echo $item['commission1_rate'];?>% 固定: <?php  echo $item['commission1_pay'];?> 元</div>
                     <?php  } ?>
        </div>
    </div>
    <?php  } ?>
     <?php  if($com_set['level']>=2) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">二级分销</label>
        <div class="col-sm-4 col-xs-12">
                <?php if( mce('goods' ,$item) ) { ?>
            <div class="input-group">
                <input type="text" name="commission2_rate" id="commission2_rate" class="form-control" value="<?php  echo $item['commission2_rate'];?>" />
                <div class="input-group-addon">% 固定</div>
                <input type="text" name="commission2_pay" id="commission2_pay" class="form-control" value="<?php  echo $item['commission2_pay'];?>" />
                <div class="input-group-addon">元</div>
            </div>
                <?php  } else { ?>
                     <div class='form-control-static'>比例: <?php  echo $item['commission2_rate'];?>% 固定: <?php  echo $item['commission2_pay'];?> 元</div>
                     <?php  } ?>
        </div>
    </div>
     <?php  } ?>
      <?php  if($com_set['level']>=3) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">三级分销</label>
        <div class="col-sm-4 col-xs-12">
                <?php if( mce('goods' ,$item) ) { ?>
            <div class="input-group">
               <input type="text" name="commission3_rate" id="commission3_rate" class="form-control" value="<?php  echo $item['commission3_rate'];?>" />
                <div class="input-group-addon">% 固定</div>
                <input type="text" name="commission3_pay" id="commission3_pay" class="form-control" value="<?php  echo $item['commission3_pay'];?>" />
                <div class="input-group-addon">元</div>
            </div>
                   <?php  } else { ?>
                     <div class='form-control-static'>比例: <?php  echo $item['commission3_rate'];?>% 固定: <?php  echo $item['commission3_pay'];?> 元</div>
                     <?php  } ?>
        </div>
    </div>
      <?php  } ?>
    </div>

</div>

<script>

</script>