<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-default panel-class" style="margin-top:20px;">
    <div class="panel-body">
        <form id="setform"  action="" method="post" class="form-horizontal form-validate">
        <div class="form-group">
            <label class="col-sm-2 control-label must">收银台名称</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" data-rule-required="true"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">手机端顶部banner</label>
            <div class="col-sm-8 col-xs-12">
                <?php  echo tpl_form_field_image('logo',$item['logo'],'../addons/ewei_shopv2/static/images/nopic.jpg',array('dest_dir'=>'cashier/'.$_W['cashierid']))?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">是否开启分销</label>
            <div class="col-sm-9 col-xs-12">
                <label class='radio-inline'>
                    <input type='radio' name='isopen_commission' value='0' <?php  if(empty($item['isopen_commission'])) { ?>checked<?php  } ?> /> 不开启
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='isopen_commission' value='1' <?php  if($item['isopen_commission']==1) { ?>checked<?php  } ?> /> 开启
                </label>
                <div class='help-block'>如果默认开启 , 支付的人默认成为管理人的下线(前提是,用户在商城有信息且没有上级)</div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label must">联系人</label>
            <div class="col-sm-8">
                <input type="tel" class="form-control" name="name" value="<?php  echo $item['name'];?>" data-rule-required="true"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label must">联系电话</label>
            <div class="col-sm-8">
                <input type="tel" class="form-control" name="mobile" value="<?php  echo $item['mobile'];?>" data-rule-required="true"/>
            </div>
        </div>

         <?php  if(!empty($item['show_paytype'])) { ?>
         <div class="form-group-title">微信支付</div>
        <div class="form-group">
            <label class="col-sm-2 control-label">微信支付</label>
            <div class="col-sm-9 col-xs-12">
                <label class='radio-inline'>
                    <input type='radio' name='wechat_status' value='0' <?php  if(empty($item['wechat_status'])) { ?>checked<?php  } ?> /> 使用系统默认
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='wechat_status' value='1' <?php  if($item['wechat_status']==1) { ?>checked<?php  } ?> /> 自定义
                </label>
            </div>
        </div>

        <div <?php  if(empty($item['wechat_status'])) { ?>style="display:none;"<?php  } ?>>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="wechatpay[appid]" value="<?php  echo $wechatpay['appid'];?>" placeholder="服务商公众号(AppId)">
                <div class="help-block">如果是服务商 , 这个填写服务商AppId . 如果不是子商户 此处为空</div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="wechatpay[mch_id]" value="<?php  echo $wechatpay['mch_id'];?>" placeholder="服务商微信支付商户号(Mch_Id)">
                <div class="help-block">如果是服务商 , 这个填写服务商Mch_Id . 如果不是子商户 此处为空</div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="wechatpay[sub_appid]" value="<?php  echo $wechatpay['sub_appid'];?>" placeholder="公众号(AppId 必填)">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="wechatpay[sub_mch_id]" value="<?php  echo $wechatpay['sub_mch_id'];?>" placeholder="微信支付商户号(Mch_Id)">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="wechatpay[apikey]" value="<?php  echo $wechatpay['apikey'];?>" placeholder="微信支付密钥(APIKEY)">
                <div class="help-block">如果是服务商 , 这个填写服务商APIKEY . 如果不是则填写当前商户的APIKEY</div>
            </div>
        </div>
        </div>
        <div class="form-group-title">支付宝支付</div>
        <div class="form-group">
            <label class="col-sm-2 control-label">支付宝支付</label>
            <div class="col-sm-9 col-xs-12">
                <label class='radio-inline'>
                    <input type='radio' name='alipay_status' value='0' <?php  if(empty($item['alipay_status'])) { ?>checked<?php  } ?> /> 关闭
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='alipay_status' value='1' <?php  if($item['alipay_status']==1) { ?>checked<?php  } ?> /> 自定义
                </label>
            </div>
        </div>

        <div <?php  if(empty($item['alipay_status'])) { ?>style="display:none;"<?php  } ?>>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="alipay[app_id]" value="<?php  echo $alipay['app_id'];?>" placeholder="支付宝应用(APPID)">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="alipay[seller_id]" value="<?php  echo $alipay['seller_id'];?>" placeholder="seller_id">
                <div class="help-block">	如果该值为空，则默认为商户签约账号对应的支付宝用户ID 例如 : 2088102146225135  非支付宝账号</div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="alipay[app_auth_token]" value="<?php  echo $alipay['app_auth_token'];?>" placeholder="app_auth_token">
                <div class="help-block"> 支付宝授权token,如果授权给其他用户,填写这项</div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">RSA(SHA1)公钥</label>
            <div class="col-sm-9 col-xs-12">
                <textarea name="alipay[publickey]" class="form-control" rows="5"></textarea>
                <?php  if(!empty($alipay['publickey'])) { ?>
                <div class='help-block text-danger'>已填写</div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">RSA(SHA1)私钥</label>
            <div class="col-sm-9 col-xs-12">
                <textarea name="alipay[privatekey]" class="form-control" rows="5"></textarea>
                <?php  if(!empty($alipay['privatekey'])) { ?>
                <div class='help-block text-danger'>已填写</div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">支付宝公钥</label>
            <div class="col-sm-9 col-xs-12">
                <textarea name="alipay[alipublickey]" class="form-control" rows="5"></textarea>
                <?php  if(!empty($alipay['alipublickey'])) { ?>
                <div class='help-block text-danger'>已填写</div>
                <?php  } ?>
            </div>
        </div>

        </div>
        <?php  } ?>

<div class="form-group-title">收款信息</div>
        <div class="form-group" id="openid">
            <label class="col-sm-2 control-label">收款微信号</label>
            <div class="col-sm-8">
                <?php  echo tpl_selector('openid',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>0,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择收款人', 'items'=>$openid,'url'=>cashierUrl('index/query') ))?>
                <div class="help-block">如果使用的是系统默认支付,申请结算的时候可以使用微信方式</div>
            </div>
        </div>

        <?php  if($diyform_flag) { ?>
        <div class="form-group-title">追加资料</div>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/diyform_input', TEMPLATE_INCLUDEPATH)) : (include template('diyform/diyform_input', TEMPLATE_INCLUDEPATH));?>
        <?php  } ?>

        <div class="form-group-title">帐号信息</div>

        <div class="form-group">
            <label class="col-sm-2 control-label must">后台登录用户名</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="username" value="<?php  echo $item['username'];?>" required/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">后台登录密码</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="password" placeholder="默认空,则不修改原密码!"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label must">绑定管理员微信号</label>
            <div class="col-sm-8">
                <?php  echo tpl_selector('manageopenid',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>0,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择通知人', 'items'=>$manageopenid,'url'=>cashierUrl('index/query') ))?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label must">绑定管理员微信号</label>
            <div class="col-sm-8">
                <?php  echo tpl_selector('management',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>1,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择手机端管理员', 'items'=>$management,'url'=>cashierUrl('index/query') ))?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="submit"  value="提交" class="btn" />
            </div>
        </div>

        </form>
    </div>
</div>
<script>
    $(function () {
        $(":radio[name=wechat_status],:radio[name=alipay_status]").on("click",function (e) {
            var $this = $(this);
            var $status;
            if ($this.attr('name') == 'wechat_status'){
                $status = $(":radio[name=alipay_status]:checked");
            }else{
                $status = $(":radio[name=wechat_status]:checked");
            }
            var $next = $this.parents(".form-group").next();
            $this.val()=='1' ?  $next.show() : $next.hide();
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>