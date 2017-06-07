<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo url('platform/special/display')?>">系统回复</a></li>
</ul>
<div class="clearfix">
	<form class="form form-horizontal" action="" method="post">
		<input type="hidden" name="id" value="<?php  echo $rule['rule']['id'];?>">
		<div class="panel panel-default">
			<div class="panel-heading">
				系统回复
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">欢迎信息关键字:</label>
					<div class="col-sm-9 col-xs-12" style="position:relative">
						<div class="input-group">
							<input type="text" name="welcome" class="form-control" id="welcomeinput" value="<?php  echo $setting['welcome'];?>" placeholder="可根据关键字直接关联指定的回复规则" autocomplete="off" />
							<div class="input-group-btn">
								<span class="btn btn-primary" id="welcome_search"><i class="fa fa-search"></i> 搜索</span>
							</div>
						</div>
						<div id="welcome_menu" style="width:100%;position:absolute;top:32px;left:16px;display:none;z-index:10000">
							<ul class="dropdown-menu" style="display:block;width:91%;height:400px;overflow-y:scroll;"></ul>
						</div>
						<div class="help-block">设置用户添加公众帐号好友时，发送的欢迎信息。<a href="javascript:;" id="welcome"><i class="fa fa-github-alt"></i> 表情</a></div>
						<div class="help-block">
							指定用户添加公众帐号好友时，发送的欢迎信息, 你可以在这里输入关键字, 那么用户添加公众号好友时就相当于发送这个内容至系统系统<br>
							这个过程是程序模拟的, 比如这里添加关键字: 欢迎关注, 那么用户添加公众号好友时, 系统系统相当于接受了粉丝用户的消息, 内容为"欢迎关注"
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">默认回复关键字:</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="text" name="default" class="form-control" id="defaultinput" value="<?php  echo $setting['default'];?>" placeholder="可根据关键字直接关联指定的回复规则" />
							<div class="input-group-btn">
								<span class="btn btn-primary search" id="default_search"><i class="fa fa-search"></i> 搜索</span>
							</div>
						</div>		
						<div id="default_menu" style="width:100%;position:absolute;top:32px;left:16px;display:none;z-index:10000">
							<ul class="dropdown-menu" style="display:block;width:91%;height:400px;overflow-y:scroll"></ul>
						</div>
						<div class="help-block">当系统不知道该如何回复粉丝的消息时，默认发送的内容。<a href="javascript:;" id="default"><i class="fa fa-github-alt"></i> 表情</a></div>
						<div class="help-block">
							指定系统不知道该如何回复粉丝的消息时，发送的默认信息, 你可以在这里输入关键字, 那么系统不知道该如何回复粉丝的消息时就相当于发送这个内容至系统系统<br>
							这个过程是程序模拟的, 比如这里添加关键字: ￥@%&%#@*, 系统不知道该如何回复粉丝的消息, 系统系统相当于接受了粉丝用户的消息, 内容为"￥@%&%#@*"
						</div>
					</div>
				</div>
				<?php  if($_W['isfounder']) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">用户审核关键字:</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="text" name="shenhe" class="form-control" id="defaultinput" value="<?php  echo $shenhe;?>" placeholder="用户审核关键字" />
						</div>		
						<div class="help-block">用户后台注册以后，可关注公众号输入审核关键字+用户账户进行自动审核。</div>
						<div class="help-block">
							例如，设置审核关键字为“审核”，用户注册账号“text”。此时，用户只需关注公众号并向公众号发送“审核text”即可实现自动审核。如不需要该功能，可不设置。
						</div>
						<div class="help-block">
							！！！注意：这里设置审核关键词后，还需在文字回复里面添加一个回复规则，触发关键字设置为——高级触发——正则表达式——“^审核关键字”，规则名称和回复内容任意。例如，关键字设置为“审核”，则添加正则表达式“^审核”。
						</div>
					</div>
				</div>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
					<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
</div>
<script>
		util.emotion($("#default"), $("#defaultinput")[0]);
		util.emotion($("#welcome"), $("#welcomeinput")[0]);
		function select_keyword(clickid, menuid, inputid){
			$(clickid).click(function(){
				var search_value = $(inputid).val(); 
				$('body').append('<div class="layer_bg"></div>');
				$('.layer_bg').height($(document).height());
				$('.layer_bg').css({width : '100%', position : 'absolute', top : '0', left : '0', 'z-index' : '0'});
				$.post("<?php  echo url('platform/special/search_key')?>", {'key_word' : search_value}, function(data){
					var data = $.parseJSON(data);
					var total = data.length;
					var html = '';
					if(total > 0) {
						for(var i = 0; i < total; i++) {
							html += '<li><a href="javascript:;">' + data[i] + '</a></li>';
						}
					} else {
						html += '<li><a href="javascript:;" class="no-result">没有匹配到您输入的关键字</a></li>';
					}
					$(menuid + ' ul').html(html);
					$(menuid + ' ul li a[class!="no-result"]').click(function(){
						$('.layer_bg').remove();
						$(inputid).val($(this).html());
						$(menuid).hide();
					});
					$(menuid).show();
				}); 
				$('.layer_bg').click(function(){
					$(menuid).hide();
					$(this).remove();
				});

			});
			$(inputid).keydown(function(event){
				if(event.keyCode == 13){
					$(clickid).click();
					return false;
				}
			});
		}
		select_keyword('#welcome_search', '#welcome_menu', '#welcomeinput');	
		select_keyword('#default_search', '#default_menu', '#defaultinput');	
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
