<?php defined('IN_IA') or exit('Access Denied');?>  
<div class="form-group">
    <label class="col-sm-2 control-label must">海报名称</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" data-rule-required="true" />
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['title'];?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label must">海报类型</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <label class="radio-inline">
            <input type="radio" name="type" value="1" <?php  if($item['type']==1) { ?>checked<?php  } ?> onclick="showGoodsSelect(false)"/> 商城海报
        </label>

        <label class="radio-inline">
            <input type="radio" name="type" value="2" <?php  if($item['type']==2) { ?>checked<?php  } ?> onclick="showGoodsSelect(false)"  /> 小店海报
        </label>

        <label class="radio-inline">
            <input type="radio" name="type" value="3" <?php  if($item['type']==3) { ?>checked<?php  } ?> onclick="showGoodsSelect(true)" /> 商品海报
        </label>

        <label class="radio-inline"> 
            <input type="radio" name="type" value="4" <?php  if($item['type']==4) { ?>checked<?php  } ?>  onclick="showGoodsSelect(false)" /> 自定义海报
        </label>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if($item['type']==1) { ?>商城海报<?php  } ?>
            <?php  if($item['type']==2) { ?>小店海报<?php  } ?>
            <?php  if($item['type']==3) { ?>商品海报<?php  } ?>
            <?php  if($item['type']==4) { ?>自定义海报<?php  } ?>
        </div>
        <?php  } ?>
    </div> 
</div> 

<div class="form-group" id='goodsdiv' <?php  if(empty($goods)) { ?>style="display:none"<?php  } ?>>
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                  <div class="col-sm-9 col-xs-12">
                          <?php if( ce('postera' ,$item) ) { ?>
                           <?php  echo tpl_selector('goodsid',array(
                           'url'=>webUrl('goods/query'),
                           'items'=>$goods,
                           'placeholder'=>'商品名称',
                           'buttontext'=>'选择商品'))
                           ?>
		 	  
                      <?php  } else { ?>
                             <div class='form-control-static'><?php  echo $goods['title'];?></div>
                             <?php  } ?>
                             
                    </div>
                </div>			  
		

<div class="form-group">
    <label class="col-sm-2 control-label must">关键词</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <input type="text" name="keyword2" class="form-control" value="<?php  echo $item['keyword2'];?>" data-rule-required="true"  />
        <span class='help-block'>生成海报的关键词</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['keyword2'];?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">活动有效期</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
        <span class='help-block'>粉丝在活动有效期外是不能生成海报</span>
        <span class='help-block'>粉丝生成的海报有效期为生成日起到活动结束时间内最长30天</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['days'];?>天</div>
        <?php  } ?>
    </div> 
</div>



<div class="form-group">
    <label class="col-sm-2 control-label">活动未开始提示</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>

        <textarea name="starttext" class="form-control"  ><?php  echo $item['starttext'];?></textarea>
        <span class="help-block">默认：活动于 [starttime] 开始，请耐心等待...</span>
        <span class="help-block">变量：[starttime] 活动开始时间 [endtime] 活动结束时间</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['starttext'])) { ?>活动于 [starttime] 开始，请耐心等待...<?php  } else { ?><?php  echo $item['starttext'];?><?php  } ?></div>
        <?php  } ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">活动结束提示</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>

        <textarea name="endtext" class="form-control"  ><?php  echo $item['endtext'];?></textarea>
        <span class="help-block">默认：活动已结束，谢谢您的关注!</span>
        <span class="help-block">变量：[starttime] 活动开始时间 [endtime] 活动结束时间</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['endtext'])) { ?>活动已结束，谢谢您的关注!<?php  } else { ?><?php  echo $item['endtext'];?><?php  } ?></div>
        <?php  } ?>

    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">生成等待文字</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>

        <textarea name="waittext" class="form-control"  ><?php  echo $item['waittext'];?></textarea>
        <span class="help-block">例如：您的专属海报正在拼命生成中，请等待片刻...</span>
        <span class="help-block">变量：[starttime] 活动开始时间 [endtime] 活动结束时间</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['waittext'])) { ?>未填写<?php  echo $item['waittext'];?><?php  } ?></div>
        <?php  } ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">是否启用</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <label class="radio-inline">
            <input type="radio" name="status" value="0" <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 禁用
        </label>

        <label class="radio-inline">
            <input type="radio" name="status" value="1" <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 启用
        </label>

        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if($item['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?>
        </div>
        <?php  } ?>
    </div> 
</div> 