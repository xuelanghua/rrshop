<?php defined('IN_IA') or exit('Access Denied');?>
<div class="form-group">
    <label class="col-sm-2 control-label">是否开启</label>
    <div class="col-sm-9 col-xs-12">

        <?php if( mce('goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="noticetype" value="" <?php  if(empty($item['noticetype']) ) { ?>checked="true"<?php  } ?>  /> 关闭</label>
        <label class="radio-inline"><input type="radio" name="noticetype" value="1" <?php  if($item['noticetype'] == 1) { ?>checked="true"<?php  } ?>   /> 开启</label>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['noticetype'])) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group notice">
    <label class="col-sm-2 control-label">商家付款通知</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( mce('goods' ,$item) ) { ?>
        <?php  echo tpl_selector('noticeopenid',array('key'=>'openid','text'=>'nickname','multi'=>1 ,'thumb'=>'avatar','placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择通知人', 'items'=>$saler,'url'=>webUrl('member/query') ))?>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(!empty($saler)) { ?><?php  echo $saler['nickname'];?><?php  } else { ?>无<?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>

