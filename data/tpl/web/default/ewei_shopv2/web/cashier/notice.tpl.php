<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .select2{
        margin:0;
        width:100%;
        height:34px;
        border-radius: 3px;
        border-color: rgb(229, 230, 231);
    }
    .select2 .select2-choice{
        height: 34px;
        line-height: 32px;
        border-radius: 3px;
        border-color: rgb(229, 230, 231);
    }
    .select2 .select2-choice .select2-arrow{
        background: #fff;
    }
    .form-group .radio-inline{
        padding-top: 0px;;
    }
</style>
<div class="page-heading">
    <h2>通知设置</h2>

</div>
<form id="setform"  <?php if(cv('cashier.notice.edit')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate">
<?php if(cv('cashier.notice.edit')) { ?>
<div class='alert alert-success'>
    使用高级模式 , 将全部启用自定义的模板内容进行推送 ! <span class="text-danger"><a href="<?php  echo webUrl('sysset/tmessage')?>">模板库(点击进入)</a></span>
</div>
<?php  } ?>

<div class="form-group">
    <label class="col-sm-2 control-label">选择通知人</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('cashier.notice.edit')) { ?>
        <?php  echo tpl_selector('openids',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>1,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择通知人', 'items'=>$salers,'url'=>webUrl('member/query') ))?>
        <span class='help-block'>可以指定多个人，如果不填写则不通知</span>
        <?php  } else { ?>
        <div class="input-group multi-img-details" id='saler_container'>
            <?php  if(is_array($salers)) { foreach($salers as $saler) { ?>
            <div class="multi-item saler-item" openid='<?php  echo $saler['openid'];?>'>
                <input type="hidden" value="<?php  echo $saler['openid'];?>" name="openids[]">
                <img class="img-responsive img-thumbnail" src='<?php  echo $saler['avatar'];?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                <div class='img-nickname'><?php  echo $saler['nickname'];?></div>
            </div>
        <?php  } } ?>
    </div>
    <?php  } ?>
    </div>
</div>
<!--<div class="form-group">
    <label class="col-sm-2 control-label">申请通知</label>
    <div class="col-sm-9 col-xs-12">
        <select class="select2" <?php if(cv('cashier.notice.edit')) { ?>name="data[apply]"<?php  } else { ?>disabled<?php  } ?>>
        <option value=''>从模板消息库中选择</option>
        <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
        <option value="<?php  echo $template_val['id'];?>" <?php  if($notice['apply'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
        <?php  } } ?>
        </select>
    </div>
</div>-->

<div class="form-group">
    <label class="col-sm-2 control-label">申请结算通知</label>
    <div class="col-sm-9 col-xs-12">
        <select class="select2" <?php if(cv('cashier.notice.edit')) { ?>name="data[apply_clearing]"<?php  } else { ?>disabled<?php  } ?>>
        <option value=''>从模板消息库中选择</option>
        <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
        <option value="<?php  echo $template_val['id'];?>" <?php  if($notice['apply_clearing'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
        <?php  } } ?>
        </select>
    </div>
</div>

<!--    <div class="form-group">
        <label class="col-sm-2 control-label">审核通知</label>
        <div class="col-sm-9 col-xs-12">
            <select class="select2" <?php if(cv('cashier.notice.edit')) { ?>name="data[checked]"<?php  } else { ?>disabled<?php  } ?>>
            <option value=''>从模板消息库中选择</option>
            <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
            <option value="<?php  echo $template_val['id'];?>" <?php  if($notice['checked'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
            <?php  } } ?>
            </select>
        </div>
    </div>-->

    <div class="form-group">
        <label class="col-sm-2 control-label">打款通知</label>
        <div class="col-sm-9 col-xs-12">
            <select class="select2" <?php if(cv('cashier.notice.edit')) { ?>name="data[pay]"<?php  } else { ?>disabled<?php  } ?>>
            <option value=''>从模板消息库中选择</option>
            <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
            <option value="<?php  echo $template_val['id'];?>" <?php  if($notice['pay'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
            <?php  } } ?>
            </select>
            <div class="help-block">申请结算打款后 , 通知申请打款的人(收款微信号)</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">支付通知(管理端)</label>
        <div class="col-sm-9 col-xs-12">
            <select class="select2" <?php if(cv('cashier.notice.edit')) { ?>name="data[pay_cashier]"<?php  } else { ?>disabled<?php  } ?>>
            <option value=''>从模板消息库中选择</option>
            <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
            <option value="<?php  echo $template_val['id'];?>" <?php  if($notice['pay_cashier'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
            <?php  } } ?>
            </select>
            <div class="help-block">总店收的收款成功款项 , 发送给管理员微信 . 如果是操作员收的,发送给操作员</div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">支付通知(用户端)</label>
        <div class="col-sm-9 col-xs-12">
            <select class="select2" <?php if(cv('cashier.notice.edit')) { ?>name="data[pay_cashier_user]"<?php  } else { ?>disabled<?php  } ?>>
            <option value=''>从模板消息库中选择</option>
            <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
            <option value="<?php  echo $template_val['id'];?>" <?php  if($notice['pay_cashier_user'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
            <?php  } } ?>
            </select>
            <div class="help-block">如果用户是通过微信支付,则通知支付用户支付成功</div>
        </div>
    </div>

<?php if(cv('cashier.notice.edit')) { ?>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9">
        <input type="submit" value="提交" class="btn btn-primary" />
    </div>
</div>
<?php  } ?>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>