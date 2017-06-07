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
    <div class="pull-right" style="text-align: right;margin-top: 10px;" >
        <strong>高级模式</strong>
        <?php if(cv('abonus.notice.edit')) { ?>
        	<input class="js-switch small" type="checkbox" <?php  if(!empty($data['tm']['is_advanced'])) { ?>checked<?php  } ?>/>
        <?php  } else { ?>
        	<?php  if(!empty($data['tm']['is_advanced'])) { ?>开启<?php  } else { ?>关闭<?php  } ?>
        <?php  } ?>
    </div>
    <h2>通知设置</h2>

</div>
<form id="setform"  <?php if(cv('abonus.notice.edit')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate">
    <input type="hidden" value="<?php  echo intval($data['tm']['is_advanced'])?>" name='data[is_advanced]' />
    <?php if(cv('abonus.notice.edit')) { ?>
    <div class='alert alert-success' id="advanced_alert">
        使用高级模式 , 将全部启用自定义的模板内容进行推送 ! <span class="text-danger"><a href="<?php  echo webUrl('sysset/tmessage')?>">模板库(点击进入)</a></span>
    </div>
    <div class='alert alert-info' id="normal_alert">
        默认为全部开启，用户在会员中心可自行设置是否开启, 模板消息自动替换变量
    </div>
    <?php  } ?>
    <div id="normal">
        <div class="form-group">
            <label class="col-sm-2 control-label">任务处理通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <input type="text" name="data[templateid]" class="form-control" value="<?php  echo $data['tm']['templateid'];?>" />
                <div class="help-block">公众平台模板消息编号: OPENTM200605630 </div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['templateid'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">成为区域代理通知</label>
            <div class="col-sm-9 col-xs-12">

                <?php if(cv('abonus.notice.edit')) { ?>
                <input type="text" name="data[becometitle]" class="form-control" value="<?php  echo $data['tm']['becometitle'];?>" />
                <div class="help-block">标题，默认"成为区域代理通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['becometitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <textarea  name="data[become]" class="form-control" ><?php  echo $data['tm']['become'];?></textarea>
                模板变量: [昵称] [时间] [代理级别] [代理区域]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['become'];?></div>
                <?php  } ?>

            </div>
        </div>
 


        <div class="form-group">
            <label class="col-sm-2 control-label">省级代理分红发放通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <input type="text" name="data[paytitle1]" class="form-control" value="<?php  echo $data['tm']['paytitle1'];?>" />
                <div class="help-block">标题，默认"省级代理分红发放通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['paytitle1'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <textarea  name="data[pay1]" class="form-control" ><?php  echo $data['tm']['pay1'];?></textarea>
                模板变量 [昵称] [打款方式] [省级分红金额] [市级分红金额] [区级分红金额]  [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['pay1'];?></div>
                <?php  } ?>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">市级代理分红发放通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <input type="text" name="data[paytitle2]" class="form-control" value="<?php  echo $data['tm']['paytitle2'];?>" />
                <div class="help-block">标题，默认"市级代理分红发放通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['paytitle2'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <textarea  name="data[pay2]" class="form-control" ><?php  echo $data['tm']['pay2'];?></textarea>
                模板变量 [昵称] [打款方式] [市级分红金额] [区级分红金额]  [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['pay2'];?></div>
                <?php  } ?>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">区级代理分红发放通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <input type="text" name="data[paytitle3]" class="form-control" value="<?php  echo $data['tm']['paytitle3'];?>" />
                <div class="help-block">标题，默认"区级代理分红发放通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['paytitle3'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <textarea  name="data[pay3]" class="form-control" ><?php  echo $data['tm']['pay3'];?></textarea>
                模板变量 [昵称] [打款方式] [区级分红金额]  [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['pay3'];?></div>
                <?php  } ?>
            </div>
        </div>




        <div class="form-group">
            <label class="col-sm-2 control-label">省级代理等级升级通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <input type="text" name="data[upgradetitle]" class="form-control" value="<?php  echo $data['tm']['upgradetitle'];?>" />
                <div class="help-block">标题，默认"省级代理等级升级通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['upgradetitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <textarea  name="data[upgrade1]" class="form-control" ><?php  echo $data['tm']['upgrade1'];?></textarea>
                模板变量: [昵称] [旧等级]  [旧省级分红比例] [旧市级分红比例] [旧区级分红比例]  [新等级] [新省级分红比例] [新市级分红比例] [新区级分红比例] [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['upgrade1'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">市级代理等级升级通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <input type="text" name="data[upgradetitle2]" class="form-control" value="<?php  echo $data['tm']['upgradetitle2'];?>" />
                <div class="help-block">标题，默认"市级代理等级升级通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['upgradetitle2'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <textarea  name="data[upgrade2]" class="form-control" ><?php  echo $data['tm']['upgrade2'];?></textarea>
                模板变量: [昵称] [旧等级]  [旧市级分红比例] [旧区级分红比例]  [新等级] [新市级分红比例] [新区级分红比例] [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['upgrade2'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">区级代理等级升级通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <input type="text" name="data[upgradetitle3]" class="form-control" value="<?php  echo $data['tm']['upgradetitle3'];?>" />
                <div class="help-block">标题，默认"区级代理等级升级通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['upgradetitle3'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('abonus.notice.edit')) { ?>
                <textarea  name="data[upgrade3]" class="form-control" ><?php  echo $data['tm']['upgrade3'];?></textarea>
                模板变量: [昵称] [旧等级]  [旧区级分红比例]  [新等级] [新区级分红比例] [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['upgrade3'];?></div>
                <?php  } ?>
            </div>
        </div>

    </div>
    <div id="advanced">
        <div class="form-group">
            <label class="col-sm-2 control-label">成为区域代理通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('abonus.notice.edit')) { ?>name="data[become_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['become_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>
        <div class="form-group-title">区域等级升级通知</div>
        <div class="form-group">
            <label class="col-sm-2 control-label">省级代理等级升级通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('abonus.notice.edit')) { ?>name="data[upgrade1_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                <option value=''>从模板消息库中选择</option>
                <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['upgrade1_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                <?php  } } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">市级代理等级升级通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('abonus.notice.edit')) { ?>name="data[upgrade2_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                <option value=''>从模板消息库中选择</option>
                <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['upgrade2_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                <?php  } } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">区级代理等级升级通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('abonus.notice.edit')) { ?>name="data[upgrade3_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                <option value=''>从模板消息库中选择</option>
                <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['upgrade3_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                <?php  } } ?>
                </select>
            </div>
        </div>

        <div class="form-group-title">区域代理分红发放通知</div>
        <div class="form-group">
            <label class="col-sm-2 control-label">区域代理分红发放通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('abonus.notice.edit')) { ?>name="data[pay_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['pay_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>


    </div>
    <?php if(cv('abonus.notice.edit')) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9">
            <input type="submit" value="提交" class="btn btn-primary" />
        </div>
    </div>
    <?php  } ?>
</form>
<script>
    $(function () {
        $(".js-switch").click(function () {
            $(":input[name='data[is_advanced]']").val( this.checked ?1:0);
            if (this.checked)
            {
                $("#advanced,#advanced_alert").show();
                $("#normal,#normal_alert").hide();
            }
            else
            {
                $("#advanced,#advanced_alert").hide();
                $("#normal,#normal_alert").show();
            }
        })

        if($(":input[name='data[is_advanced]']").val() == 1)
        {
            $("#advanced,#advanced_alert").show();
            $("#normal,#normal_alert").hide();
        }
        else
        {
            $("#advanced,#advanced_alert").hide();
            $("#normal,#normal_alert").show();
        }
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>