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
</style>
<div class="page-heading">
    <div class="pull-right" style="text-align: right;margin-top: 10px;" >
        <strong>高级模式</strong>
        <input class="js-switch small" type="checkbox" <?php  if(!empty($data['tm']['is_advanced'])) { ?>checked<?php  } ?>/>
    </div>
    <h2>通知设置</h2>

</div>
<form id="setform"  action="" method="post" class="form-horizontal form-validate">
    <input type="hidden" value="<?php  echo intval($data['tm']['is_advanced'])?>" name='data[is_advanced]' />
    <div class='alert alert-info'>
        默认为全部开启，用户在会员中心可自行设置是否开启, 模板消息自动替换变量
    </div>
    <div class='alert alert-success'>
        使用高级模式 , 将全部启用自定义的模板内容进行推送 !
    </div>

    <div class="form-group normal">
        <label class="col-sm-2 control-label">任务处理通知</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="data[templateid]" class="form-control" value="<?php  echo $data['tm']['templateid'];?>" />
            <div class="help-block">公众平台模板消息编号: OPENTM200605630 </div>
        </div>
    </div>

    <div class="form-group-title">商家通知 - 入驻申请</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">选择通知人</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('merch.notice.edit')) { ?>
            <?php  echo tpl_selector('openids',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>1,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择通知人', 'items'=>$salers,'url'=>webUrl('member/query') ))?>
            <span class='help-block'>选择多商户下面所有通知的通知人，可以指定多个人，如果不填写则不通知</span>
            <?php  } else { ?>
            <div class="input-group multi-img-details" id='saler_container'>
                <?php  if(is_array($salers)) { foreach($salers as $saler) { ?>
                <div class="multi-item saler-item" openid='<?php  echo $saler['openid'];?>'>
                <img class="img-responsive img-thumbnail" src='<?php  echo $saler['avatar'];?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                <div class='img-nickname'><?php  echo $saler['nickname'];?></div>
                <input type="hidden" value="<?php  echo $saler['openid'];?>" name="openids[]">
            </div>
            <?php  } } ?>
        </div>
        <?php  } ?>
    </div>
    </div>
    <div class="normal">
        <div class="form-group">
            <label class="col-sm-2 control-label">标题</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" name="data[merch_applytitle]" class="form-control" value="<?php  echo $data['tm']['merch_applytitle'];?>" />
                <div class="help-block">标题，默认"商户入驻申请"</div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">内容</label>
            <div class="col-sm-9 col-xs-12">
                <textarea  name="data[merch_apply]" class="form-control" ><?php  echo $data['tm']['merch_apply'];?></textarea>
                模板变量: [商户名称] [主营项目] [联系人] [手机号] [申请时间]
                <br/>如果不填写默认内容为: [商户名称]在[申请时间]提交了入驻申请，请到后台查看~
            </div>
        </div>
    </div>
    <div class="advanced">
        <div class="form-group">
            <label class="col-sm-2 control-label">入驻申请</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" name="data[merch_apply_advanced]">
                    <option>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['merch_apply_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group" style="display: <?php  if($opensms) { ?>block<?php  } else { ?>none<?php  } ?>;">
        <label class="col-sm-2 control-label">短信通知</label>
        <div class="col-sm-9 col-xs-12">
            <select class="select2" name="data[merch_apply_sms]">
                <option>从短信模板库中选择</option>
                <?php  if(is_array($template_sms)) { foreach($template_sms as $template_val) { ?>
                <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['merch_apply_sms'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['name'];?></option>
                <?php  } } ?>
            </select>
        </div>
    </div>
    <div class="form-group" style="display: <?php  if($opensms) { ?>block<?php  } else { ?>none<?php  } ?>;">
        <label class="col-sm-2 control-label">短信通知人</label>
        <div class="col-sm-9 col-xs-12">
            <textarea class="form-control" name="data[mobiles]" style="padding: 5px;"><?php  echo $data['tm']['mobiles'];?></textarea>
            <div class="help-block">可填写多个手机号以英文逗号隔开(,)，提醒人为空或者未选择短信模板则不发送</div>
        </div>
    </div>

    <div class="form-group-title">商家通知 - 提现申请提交通知</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">提现申请通知人</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('merch.notice.edit')) { ?>
            <?php  echo tpl_selector('applyopenids',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>1,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择通知人', 'items'=>$applysalers,'url'=>webUrl('member/query') ))?>
            <span class='help-block'>选择多商户下面所有通知的通知人，可以指定多个人，如果不填写则不通知</span>
            <?php  } else { ?>
            <div class="input-group multi-img-details" id='saler_container_apply'>
                <?php  if(is_array($applysalers)) { foreach($applysalers as $saler) { ?>
                <div class="multi-item saler-item" applyopenid='<?php  echo $saler['openid'];?>'>
                <img class="img-responsive img-thumbnail" src='<?php  echo $saler['avatar'];?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                <div class='img-nickname'><?php  echo $saler['nickname'];?></div>
                <input type="hidden" value="<?php  echo $saler['openid'];?>" name="applyopenids[]">
            </div>
            <?php  } } ?>
        </div>
        <?php  } ?>
    </div>

    <div  class="normal">
        <div class="form-group">
            <label class="col-sm-2 control-label">标题</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('merch.notice.edit')) { ?>
                <input type="text" name="data[merch_applymoneytitle]" class="form-control" value="<?php  echo $data['tm']['merch_applymoneytitle'];?>" />
                <div class="help-block">标题，默认"提现申请提交通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['merch_applymoneytitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">内容</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('merch.notice.edit')) { ?>
                <textarea  name="data[merch_applymoney]" class="form-control" ><?php  echo $data['tm']['merch_applymoney'];?></textarea>
                模板变量  [商户名称] [金额] [联系人] [手机号] [申请时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['merch_applymoney'];?></div>
                <?php  } ?>
            </div>
        </div>
    </div>
    <div class="advanced">
        <div class="form-group">
            <label class="col-sm-2 control-label">提现申请提交通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" name="data[merch_applymoney_advanced]">
                    <option>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['merch_applymoney_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group" style="display: <?php  if($opensms) { ?>block<?php  } else { ?>none<?php  } ?>;">
        <label class="col-sm-2 control-label">短信通知</label>
        <div class="col-sm-9 col-xs-12">
            <select class="select2" name="data[merch_applymoney_sms]">
                <option>从短信模板库中选择</option>
                <?php  if(is_array($template_sms)) { foreach($template_sms as $template_val) { ?>
                <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['merch_applymoney_sms'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['name'];?></option>
                <?php  } } ?>
            </select>
        </div>
    </div>
    <div class="form-group" style="display: <?php  if($opensms) { ?>block<?php  } else { ?>none<?php  } ?>;">
        <label class="col-sm-2 control-label">短信通知人</label>
        <div class="col-sm-9 col-xs-12">
            <textarea class="form-control" name="data[applymobiles]" style="padding: 5px;"><?php  echo $data['tm']['applymobiles'];?></textarea>
            <div class="help-block">可填写多个手机号以英文逗号隔开(,)，提醒人为空或者未选择短信模板则不发送</div>
        </div>
    </div>


        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <input type="submit" value="提交" class="btn btn-primary" />
            </div>
        </div>
</form>
<script>
    $(function () {
        $(".js-switch").click(function () {
            $(":input[name='data[is_advanced]']").val( this.checked ?1:0);
            if (this.checked)
            {
                $(".advanced").show();
                $(".alert-success").show();
                $(".normal").hide();
                $(".alert-info").hide();
            }
            else
            {
                $(".advanced").hide();
                $(".alert-success").hide();
                $(".normal").show();
                $(".alert-info").show();
            }
        })

        if($(":input[name='data[is_advanced]']").val() == 1)
        {
            $(".advanced").show();
            $(".alert-success").show();
            $(".normal").hide();
            $(".alert-info").hide();
        }
        else
        {
            $(".advanced").hide();
            $(".alert-success").hide();
            $(".normal").show();
            $(".alert-info").show();
        }
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>