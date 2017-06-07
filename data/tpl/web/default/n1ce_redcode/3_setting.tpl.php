<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?> 
<script>
require(['bootstrap.switch', 'util'], function($, u){
	$(function(){
		$('.make-switch').bootstrapSwitch();
	});
});
</script>
<div class="main">
<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
  <div class="panel panel-default">
    <div class="panel-heading">服务号参数</div>
    <div class="panel-body">
	  <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">是否借权</label>
					<div class="col-xs-12 col-sm-9">
                        <label class="radio-inline"><input type="radio" name="brrow"
                         value="1" <?php  if($settings['brrow'] !== 2) { ?>checked="checked" <?php  } ?>>不开启</label>
						 <label class="radio-inline"><input type="radio" name="brrow"
                         value="2" <?php  if($settings['brrow'] == 2) { ?>checked="checked" <?php  } ?>>开启</label>
                    </div>
      </div>
      <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppId</label>
        <div class="col-sm-9">
          <input type="text" name="appid" value="<?php  echo $settings['appid'];?>" class="form-control"/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
        <div class="col-sm-9">
          <input type="text" name="appsecret" value="<?php  echo $settings['appsecret'];?>" class="form-control"/>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户号</label>
      <div class="col-sm-9">
        <input type="text" value="<?php  echo $settings['pay_mchid'];?>" class="form-control" name="pay_mchid">
      </div>
    </div>
    <div class="form-group">
      <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户密钥</label>
      <div class="col-sm-9">
        <input type="text" value="<?php  echo $settings['pay_signkey'];?>" class="form-control" name="pay_signkey">
      </div>
    </div>
    <div class="form-group">
      <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户证书</label>
      <div class="col-sm-9">
        <button type="button" class="btn btn-default" onClick="$('#rootca').click()"><?php  if($settings['rootca']) { ?><?php  echo $settings['rootca'];?><?php  } else { ?>上传<?php  } ?></button>
        请上传rootca.pem
        <input type="hidden" name="rootca2" value="<?php  echo $settings['rootca'];?>"/>
        <input type="file" name="rootca" id="rootca"  style="display:none;">
      </div>
    </div>
    <div class="form-group">
      <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户证书</label>
      <div class="col-sm-9">
        <button type="button" class="btn btn-default" onClick="$('#apiclient_cert').click()"><?php  if($settings['apiclient_cert']) { ?><?php  echo $settings['apiclient_cert'];?><?php  } else { ?>上传<?php  } ?></button>
        请上传apiclient_cert.pem
        <input type="hidden" name="apiclient_cert2" value="<?php  echo $settings['apiclient_cert'];?>"/>
        <input type="file" name="apiclient_cert" value="<?php  echo $settings['apiclient_cert'];?>" id="apiclient_cert" style="display:none;">
      </div>
    </div>
    <div class="form-group">
      <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户证书</label>
      <div class="col-sm-9">
        <button type="button" class="btn btn-default" onClick="$('#apiclient_key').click()"><?php  if($settings['apiclient_key']) { ?><?php  echo $settings['apiclient_key'];?><?php  } else { ?>上传<?php  } ?></button>
        请上传apiclient_key.pem
        <input type="hidden" name="apiclient_key2" value="<?php  echo $settings['apiclient_key'];?>"/>
        <input type="file" name="apiclient_key" id="apiclient_key" style="display:none;">
      </div>
    </div>
    
	<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">活动名称</label>
					<div class="col-sm-8">
						<input type="text" name="act_name" class="form-control" value="<?php  echo $settings['act_name'];?>" />
					</div>
	</div>
				
				
				
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">祝福语</label>
					<div class="col-sm-8">
						<input type="text" name="wishing" class="form-control" value="<?php  echo $settings['wishing'];?>" />
					</div>
				</div>
			
				
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">备注信息</label>
					<div class="col-sm-8">
						<input type="text" name="remark" class="form-control" value="<?php  echo $settings['remark'];?>" />
					</div>
				</div>
	
				<!--<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">提供方名称</label>
					<div class="col-sm-8">
						<input type="text" name="nick_name" class="form-control" value="<?php  echo $settings['nick_name'];?>" />
					</div>
				</div>-->


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">商户名称</label>
					<div class="col-sm-8">
						<input type="text" name="send_name" class="form-control" value="<?php  echo $settings['send_name'];?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">管理员openid</label>
					<div class="col-sm-8">
						<input type="text" name="mopenid" class="form-control" value="<?php  echo $settings['mopenid'];?>" />
						<div class="help-block">在粉丝营销-找到粉丝openid，可以在红包发放失败提醒管理员！</div>
					</div>
					
				</div>
  </div>
  
  <div class="panel panel-default">
            <div class="panel-heading">全局红包限制</div>
			<div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">限制只领取一次</label>
					<div class="col-xs-12 col-sm-9">
                        <label class="radio-inline"><input type="radio" name="xianzhi"
                         value="1" <?php  if($settings['xianzhi'] !== 2) { ?>checked="checked" <?php  } ?>>不开启</label>
						 <label class="radio-inline"><input type="radio" name="xianzhi"
                         value="2" <?php  if($settings['xianzhi'] == 2) { ?>checked="checked" <?php  } ?>>开启</label>
                    </div>
            </div>
            
  </div>
  <div class="panel panel-default">
	<div class="panel-heading">提示语设置</div>
	
	<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">红包发放成功提示语</label>
        <div class="col-sm-9">
          <input type="text" name="sendred" value="<?php  echo $settings['sendred'];?>" class="form-control"/>
		  <div class="help-block">|#昵称#| 代表用户昵称</div>
        </div>
		
    </div>
	<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">红包发放失败提示语</label>
        <div class="col-sm-9">
          <input type="text" name="sendbad" value="<?php  echo $settings['sendbad'];?>" class="form-control"/>
		  <div class="help-block">|#昵称#| 代表用户昵称，余额不足或者服务器波动会造成粉丝领取失败的提示语</div>
        </div>
		
    </div>
	<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">卡券发放成功提示语</label>
        <div class="col-sm-9">
          <input type="text" name="sendcard" value="<?php  echo $settings['sendcard'];?>" class="form-control"/>
		  <div class="help-block">|#昵称#| 代表用户昵称</div>
        </div>
		
    </div>
	<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分发放成功提示语</label>
        <div class="col-sm-9">
          <input type="text" name="sendcredit" value="<?php  echo $settings['sendcredit'];?>" class="form-control"/>
		  <div class="help-block">|#昵称#| 代表用户昵称,|#积分#|代表所获得的积分,可加入a标签超链接</div>
        </div>
		
    </div>
	<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">验证码错误或不中奖提示</label>
        <div class="col-sm-9">
          <input type="text" name="wrong" value="<?php  echo $settings['wrong'];?>" class="form-control"/>
		  <div class="help-block">|#昵称#| 代表用户昵称</div>
        </div>
		
    </div>
	<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">奖品被领取提示</label>
        <div class="col-sm-9">
          <input type="text" name="islater" value="<?php  echo $settings['islater'];?>" class="form-control"/>
		  <div class="help-block">|#昵称#| 代表用户昵称</div>
        </div>
		
    </div>
	<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">限制重复领取提示</label>
        <div class="col-sm-9">
          <input type="text" name="isget" value="<?php  echo $settings['isget'];?>" class="form-control"/>
		  <div class="help-block">|#昵称#| 代表用户昵称</div>
        </div>
		
    </div>
  </div>
  
  <div class="panel panel-default">
	<div class="panel-heading">网页领取红包设置</div>
	
	<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">未关注跳转URL</label>
        <div class="col-sm-9">
          <input type="text" name="surl" value="<?php  echo $settings['surl'];?>" class="form-control"/>
		  <div class="help-block">http开头的引导关注连接！</div>
        </div>
		
    </div>
	
  </div>
  <div class="form-group col-sm-12">
    <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
  </div>
</form>
</div>
<script>
require(['jquery','util'], function($, util){
	$(function(){
		$('#icon1,#icon2,#icon3,#icon4').click(function(){
			var types=$(this).attr("btnid");
			util.iconBrowser(function(ico){
				$('#icon_ipt'+types).val(ico);
				$('#icon_show'+types+' i').attr("class",ico);
				
			});
		});
	});
});
</script> 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>