<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-sm-2 control-label">手机入驻开关</label>
    <div class="col-sm-8">
        <?php if(cv('merch.set.edit')) { ?>
        <label class="radio-inline"><input type="radio" class="open_apply" name="data[apply_openmobile]" value="0" <?php  if($data['apply_openmobile'] ==0) { ?> checked="checked"<?php  } ?> /> 不允许</label>
        <label class="radio-inline"><input type="radio" class="open_apply" name="data[apply_openmobile]" value="1" <?php  if($data['apply_openmobile'] ==1) { ?> checked="checked"<?php  } ?> /> 允许</label>
        <div class='help-block'>是否允许商户从手机端申请入驻</div>
        <?php  } else { ?>
        <?php  if($data['apply_openmobile'] ==0) { ?>不允许<?php  } else { ?>允许<?php  } ?>
        <?php  } ?>
    </div>
</div>

<div class="form-group protocol-group" <?php  if(empty($data['apply_openmobile'])) { ?>style="display: none;"<?php  } ?>>
    <label class="col-sm-2 control-label">显示入驻申请协议</label>
    <div class="col-sm-8">
        <?php if(cv('merch.set.edit')) { ?>
        <label class="radio-inline"><input type="radio"  name="data[open_protocol]" value="0" <?php  if($data['open_protocol'] ==0) { ?> checked="checked"<?php  } ?> /> 隐藏</label>
        <label class="radio-inline"><input type="radio"  name="data[open_protocol]" value="1" <?php  if($data['open_protocol'] ==1) { ?> checked="checked"<?php  } ?> /> 显示</label>
        <?php  } else { ?>
        <?php  if($data['open_protocol'] ==0) { ?>隐藏<?php  } else { ?>显示<?php  } ?>
        <?php  } ?>
    </div>
</div>

<!--div class="form-group">
    <label class="col-sm-2 control-label">网页入驻开关</label>
    <div class="col-sm-8">
        <?php if(cv('merch.set.edit')) { ?>
        <label class="radio-inline"><input type="radio"  name="data[apply_openweb]" value="0" <?php  if($data['apply_openweb'] ==0) { ?> checked="checked"<?php  } ?> /> 不允许</label>
        <label class="radio-inline"><input type="radio"  name="data[apply_openweb]" value="1" <?php  if($data['apply_openweb'] ==1) { ?> checked="checked"<?php  } ?> /> 允许</label>
        <div class='help-block'>是否允许商户从PC网页端申请入驻</div>
        <?php  } else { ?>
        <?php  if($data['apply_openweb'] ==0) { ?>不允许<?php  } else { ?>允许<?php  } ?>
        <?php  } ?>
    </div>
</div-->

<div class="form-group">
    <label class="col-sm-2 control-label">入驻宣传头部图片</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('merch.set.edit')) { ?>
        <?php  echo tpl_form_field_image('data[regbg]',$data['regbg'],'../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png')?>
        <span class="help-block">入驻宣传封面 建议尺寸 640 * 320</span>
        <?php  } else { ?>
        <?php  if(empty($data['regbg'])) { ?>
        <img src="../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png" onerror="this.src='../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
        <?php  } else { ?>
        <img src="<?php  echo tomedia($data['regbg'])?>" onerror="this.src='../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
        <?php  } ?>
        <?php  } ?>
    </div>
</div>
<?php  if(p('diyform')) { ?>
<div class="form-group">
    <label class="col-sm-2 control-label">入驻表单</label>
    <div class="col-sm-8">
        <?php if(cv('merch.set.edit')) { ?>
        <label class="radio-inline" style="float: left;"><input type="radio"  name="data[apply_diyform]" value="0" <?php  if($data['apply_diyform'] ==0) { ?> checked="checked"<?php  } ?> /> 不追加</label>

        <label class="radio-inline" style="float: left;"><input type="radio"  name="data[apply_diyform]" value="1" <?php  if($data['apply_diyform'] ==1) { ?> checked="checked"<?php  } ?> /> 追加</label>
        <select id="user_diyform" name="data[apply_diyformid]" class="form-control" style="float:left;width:180px;padding-left:10px;">
            <option value="0" <?php  if($set['apply_diyformid']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
            <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
            <option value="<?php  echo $value['id'];?>" <?php  if($data['apply_diyformid']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
            <?php  } } ?>
        </select>

        <div class='help-block' style="display:block">商家入驻时需要追加的资料</div>
        <?php  } else { ?>
        <?php  if($data['apply_diyform'] ==0) { ?>不追加<?php  } else { ?>
        追加表单:
        <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
        <?php  if($set['apply_diyformid']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?>
        <?php  } } ?>
        <?php  } ?>
        <?php  } ?>
    </div>
</div>
<?php  } ?>


