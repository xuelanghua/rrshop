<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">推送方式</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>

        <label class="radio-inline">
            <input type="radio" name="resptype" value="0" <?php  if(empty($item['resptype'])) { ?>checked<?php  } ?> /> 图文推送
        </label>
        <label class="radio-inline">
            <input type="radio" name="resptype" value="1" <?php  if($item['resptype']==1) { ?>checked<?php  } ?> /> 文字推送
        </label>
        <span class='help-block'>选择图片推送还是纯文字推送</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($item['resptype']==1) { ?>图文推送<?php  } else { ?>文字推送<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="resptype0" <?php  if($item['resptype']!=0) { ?>style="display:none;"<?php  } ?>>
<div class="form-group">
    <label class="col-sm-2 control-label">推送标题</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <input type="text" name="resptitle" class="form-control" value="<?php  echo $item['resptitle'];?>" />
        <span class="help-block">如果设置为空，则不推送内容</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['resptitle'];?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group"> 
    <label class="col-sm-2 control-label">推送封面</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <?php  echo tpl_form_field_image('respthumb',$item['respthumb'])?>
        <?php  } else { ?>
        <?php  if(!empty($item['respthumb'])) { ?>
        <a href='<?php  echo tomedia($item['respthumb'])?>' target='_blank'>
           <img src="<?php  echo tomedia($item['respthumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
        </a>
        <?php  } ?>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">推送描述</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <textarea name='respdesc' class='form-control'><?php  echo $item['respdesc'];?></textarea>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['respdesc'];?></div>
        <?php  } ?>
    </div>
</div> 
<div class="form-group">
    <label class="col-sm-2 control-label">推送链接</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <input type="text" name="respurl" class="form-control" value="<?php  echo $item['respurl'];?>" />
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['respurl'];?></div>
        <?php  } ?>
    </div>
</div>
</div>

<div class="resptype1" <?php  if($item['resptype']!=1) { ?>style="display:none;"<?php  } ?>>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">推送文字</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('postera' ,$item) ) { ?>
        <textarea name="resptext" class="form-control"><?php  echo $item['resptext'];?></textarea>
        <span class="help-block">如果设置为空，则不推送内容</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['resptext'];?></div>
        <?php  } ?>
    </div>
</div>
</div>