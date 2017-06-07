<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
    <h2>基础设置</h2>
</div>

<div class="alert alert-danger">警告：当模板中已经添加数据后切换自定义表单模板有可能导致无法使用！</div>

<form id="setform" action="" method="post" class="form-horizontal form-validate">

    <div class="form-group">
        <label class="col-sm-2 control-label">会员资料</label>



        <div class="col-sm-9 col-xs-12">

            <?php if(cv('diyform.set.edit')) { ?>
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="0" name="setdata[user_diyform_open]" <?php  if(empty($set['user_diyform_open'])) { ?>checked<?php  } ?>> 关闭
            </label>
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="1" name="setdata[user_diyform_open]" <?php  if($set['user_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
            </label>


            <select id="user_diyform" name="setdata[user_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px">
                <option value="0" <?php  if($set['user_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                <option value="<?php  echo $value['id'];?>" <?php  if($set['user_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                <?php  } } ?>
            </select>
            <?php  } else { ?>
            <div class="form-control-static">
                <?php  if($set['user_diyform_open'] == 1) { ?>
                开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['user_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
                <?php  } else { ?>
                关闭
                <?php  } ?>
            </div>
            <?php  } ?>
        </div>


    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">分销商申请资料</label>


        <div class="col-sm-9 col-xs-12">
            <?php if(cv('diyform.set.edit')) { ?>

            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="0" name="setdata[commission_diyform_open]" <?php  if(empty($set['commission_diyform_open'])) { ?>checked<?php  } ?>> 关闭
            </label>
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="1" name="setdata[commission_diyform_open]" <?php  if($set['commission_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
            </label>


            <select id="commission_diyform" name="setdata[commission_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px;">
                <option value="0" <?php  if($set['commission_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                <option value="<?php  echo $value['id'];?>" <?php  if($set['commission_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                <?php  } } ?>
            </select>

            <?php  } else { ?>
            <div class="form-control-static">
                <?php  if($set['commission_diyform_open'] == 1) { ?>
                开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['commission_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
                <?php  } else { ?>
                关闭
                <?php  } ?>
            </div>
            <?php  } ?>
        </div>


    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">订单统一下单表单</label>


        <div class="col-sm-9 col-xs-12">
            <?php if(cv('diyform.set.edit')) { ?>
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="0" name="setdata[order_diyform_open]" <?php  if(empty($set['order_diyform_open'])) { ?>checked<?php  } ?>> 关闭
            </label>
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="1" name="setdata[order_diyform_open]" <?php  if($set['order_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
            </label>

            <div>
            <select id="commission_diyform1" name="setdata[order_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px;">
                <option value="0" <?php  if($set['order_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                <option value="<?php  echo $value['id'];?>" <?php  if($set['order_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                <?php  } } ?>
            </select>
            </div>
            <div style="margin-left: 320px;">
            全局统一设置，购买任意产品，在确认订单页面都需要填写
            </div>
            <?php  } else { ?>
            <div class="form-control-static">
                <?php  if($set['order_diyform_open'] == 1) { ?>
                开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['order_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
                <?php  } else { ?>
                关闭
                <?php  } ?>
            </div>
            <?php  } ?>


        </div>


    </div>


<?php  if(p('globonus')) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">股东申请资料</label>


        <div class="col-sm-9 col-xs-12">
            <?php if(cv('diyform.set.edit')) { ?>

            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="0" name="setdata[globonus_diyform_open]" <?php  if(empty($set['globonus_diyform_open'])) { ?>checked<?php  } ?>> 关闭
            </label>
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="1" name="setdata[globonus_diyform_open]" <?php  if($set['globonus_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
            </label>


            <select id="globonus_diyform" name="setdata[globonus_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px;">
                <option value="0" <?php  if($set['globonus_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                <option value="<?php  echo $value['id'];?>" <?php  if($set['globonus_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                <?php  } } ?>
            </select>

            <?php  } else { ?>
            <div class="form-control-static">
                <?php  if($set['globonus_diyform_open'] == 1) { ?>
                开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['globonus_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
                <?php  } else { ?>
                关闭
                <?php  } ?>
            </div>
            <?php  } ?>
        </div>


    </div>
<?php  } ?>



    <?php  if(p('abonus')) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">区域代理申请资料</label>


        <div class="col-sm-9 col-xs-12">
            <?php if(cv('diyform.set.edit')) { ?>

            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="0" name="setdata[abonus_diyform_open]" <?php  if(empty($set['abonus_diyform_open'])) { ?>checked<?php  } ?>> 关闭
            </label>
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="1" name="setdata[abonus_diyform_open]" <?php  if($set['abonus_diyform_open'] == 1) { ?>checked<?php  } ?>> 启用
            </label>


            <select id="abonus_diyform" name="setdata[abonus_diyform]" class="form-control" style="width:167px; float: left;margin-left:10px;">
                <option value="0" <?php  if($set['abonus_diyform']==0) { ?>selected<?php  } ?>>--选择自定义表单--</option>
                <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?>
                <option value="<?php  echo $value['id'];?>" <?php  if($set['abonus_diyform']==$value['id']) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                <?php  } } ?>
            </select>

            <?php  } else { ?>
            <div class="form-control-static">
                <?php  if($set['abonus_diyform_open'] == 1) { ?>
                开启 -   <?php  if(is_array($form_list)) { foreach($form_list as $key => $value) { ?><?php  if($set['abonus_diyform']==$value['id']) { ?><?php  echo $value['title'];?><?php  } ?><?php  } } ?>
                <?php  } else { ?>
                关闭
                <?php  } ?>
            </div>
            <?php  } ?>
        </div>


    </div>
    <?php  } ?>

    <?php if(cv('diyform.set.edit')) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>

        <div class="col-sm-9">
            <input type="submit"  value="提交" class="btn btn-primary"/>
        </div>
    </div>

    <?php  } ?>

</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>