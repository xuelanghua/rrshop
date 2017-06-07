<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="gw-container">
	<div class="row" style="border-top: 4px solid #44b549;border-bottom: 1px solid #d9dadc; background-color: #FFFFFF;">
	<div class="col-xs-12 col-sm-3 col-lg-2">
			<div style="height: 60px;background: transparent url(<?php  if(!empty($_W['setting']['copyright']['blogo'])) { ?><?php  echo tomedia($_W['setting']['copyright']['blogo']);?><?php  } else { ?>./resource/images/top-logo.png<?php  } ?>) center center no-repeat;background-color: white;"></div>
	</div>
	<?php  if(!empty($_W['uniacid']) && !defined('IN_MESSAGE')) { ?>
	<div class="col-xs-12 col-sm-9 col-lg-10">
			<div class="navbar navbar-default" style="margin-bottom: 0px;background-color: #FFFFFF;border-color: #FFFFFF;border: 0px solid transparent;">
				<div class="container-fluid">
				<ul class="nav navbar-nav">
				<li class="active"><a href="./?refresh"><i class="fa fa-cogs"></i> 系统管理</a></li>
				<li><a href="<?php  echo url('home/welcome/platform');?>" target="_blank"><i class="fa fa-share"></i> 继续管理公众号（<?php  echo $_W['account']['name'];?>）</a></li>
				<li><a href="https://mp.weixin.qq.com/" target="_blank"><i class="fa fa-wechat"></i> 微信公众平台</a></li>
			    </ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown topbar-notice">
					<a type="button" data-toggle="dropdown">
						<i class="fa fa-bell"></i>
						<span class="badge" id="notice-total">0</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="dLabel">
						<div class="topbar-notice-panel">
							<div class="topbar-notice-arrow"></div>
							<div class="topbar-notice-head">
								<span>系统公告</span>
								<a href="<?php  echo url('article/notice-show/list');?>" class="pull-right">更多公告>></a>
							</div>
							<div class="topbar-notice-body">
								<ul id="notice-container"></ul>
							</div>
						</div>
					</div>
				</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "> <i class="fa fa-comments"></i> <?php  echo $_W['account']['name'];?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php  if($_W['role'] != 'operator') { ?>
							<li><a href="<?php  echo url('account/post', array('uniacid' => $_W['uniacid']));?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 编辑当前账号资料</a></li>
							<?php  } ?>
							<li><a href="<?php  echo url('account/display');?>" target="_blank"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
							<li><a href="<?php  echo url('utility/emulator');?>" target="_blank"><i class="fa fa-mobile fa-fw"></i> 模拟测试</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-user"></i>  <?php  echo $_W['user']['username'];?> (<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>公众号管理员<?php  } else { ?>公众号操作员<?php  } ?>) <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
						<?php  if($_W['role'] == 'founder') { ?>
							<li class="divider"></li>
							<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-sitemap fa-fw"></i> 系统选项</a></li>
							<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-cloud-download fa-fw"></i> 自动更新</a></li>
							<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh fa-fw"></i> 更新缓存</a></li>
							<li class="divider"></li>
							<?php  } ?>
							<li><a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
						</ul>
					</li>
				</ul>
				</div>
			</div>
</div>
<?php  } else { ?>
<div class="col-xs-12 col-sm-9 col-lg-10">
			<div class="navbar navbar-default" style="margin-bottom: 0px;background-color: #FFFFFF;border-color: #FFFFFF;border: 0px solid transparent;">
				<div class="container-fluid">
				<ul class="nav navbar-nav">
				<li class="active"><a href="./?refresh"><i class="fa fa-cogs"></i> 管理首页</a></li>
				<li><a href="https://mp.weixin.qq.com/" target="_blank"><i class="fa fa-wechat"></i> 微信公众平台</a></li>
				<?php  if(IMS_FAMILY != 'x') { ?>
				<li><a href="http://bbs.012wz.com" target="_blank"><i class="fa fa-comment"></i> 论坛</a></li>
				<li><a href="http://wiki.012wz.com/" target="_blank"><i class="fa fa-suitcase"></i> 帮助</a></li>
				<?php  } ?>
			    </ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown topbar-notice">
					<a type="button" data-toggle="dropdown">
						<i class="fa fa-bell"></i>
						<span class="badge" id="notice-total">0</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="dLabel">
						<div class="topbar-notice-panel">
							<div class="topbar-notice-arrow"></div>
							<div class="topbar-notice-head">
								<span>系统公告</span>
								<a href="<?php  echo url('article/notice-show/list');?>" class="pull-right">更多公告>></a>
							</div>
							<div class="topbar-notice-body">
								<ul id="notice-container"></ul>
							</div>
						</div>
					</div>
				</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "> <i class="fa fa-comments"></i>  <?php  echo $_W['user']['username'];?> (<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>公众号管理员<?php  } else { ?>公众号操作员<?php  } ?>) <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
						<?php  if($_W['role'] == 'founder') { ?>
							<li class="divider"></li>
							<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-sitemap fa-fw"></i> 系统选项</a></li>
							<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-cloud-download fa-fw"></i> 自动更新</a></li>
							<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh fa-fw"></i> 更新缓存</a></li>
							<li class="divider"></li>
							<?php  } ?>
							<li><a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
						</ul>
					</li>
				</ul>
				</div>
			</div>
</div>
<?php  } ?>
</div>

	<div class="container-fluid" style="margin-top: 36px;margin-bottom: 88px;min-height: 700px;">
		<?php  if(defined('IN_MESSAGE')) { ?>
		<div class="jumbotron clearfix alert alert-<?php  echo $label;?>">
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-lg-2">
					<i class="fa fa-5x fa-<?php  if($label=='success') { ?>check-circle<?php  } ?><?php  if($label=='danger') { ?>times-circle<?php  } ?><?php  if($label=='info') { ?>info-circle<?php  } ?><?php  if($label=='warning') { ?>exclamation-triangle<?php  } ?>"></i>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
					<?php  if(is_array($msg)) { ?>
						<h2>MYSQL 错误：</h2>
						<p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
						<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
					<?php  } else { ?>
					<h2><?php  echo $caption;?></h2>
					<p><?php  echo $msg;?></p>
					<?php  } ?>
					<?php  if($redirect) { ?>
					<p><a href="<?php  echo $redirect;?>">如果你的浏览器没有自动跳转，请点击此链接</a></p>
					<script type="text/javascript">
						setTimeout(function () {
							location.href = "<?php  echo $redirect;?>";
						}, 3000);
					</script>
					<?php  } else { ?>
						<p>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>] &nbsp; [<a href="./?refresh">首页</a>]</p>
					<?php  } ?>
				</div>
		<?php  } else { ?>
		<div class="row">

				<div class="col-xs-12 col-sm-3 col-lg-2 big-menu" style="padding-right: 0px;">
					<div id="search-menu">
						<input class="form-control input-lg" style="border-radius:0; font-size:14px; height:43px;" type="text" placeholder="输入菜单名称可快速查找">
					</div>
				
					<div class="panel panel-default">
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-home"></i> 管理中心</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-0">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-0">
							<li class="list-group-item <?php  if($controller == 'system') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/welcome');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="系统管理">
									<a class="pull-right" href="<?php  echo url('system/welcome');?>"><i class="fa fa-home"></i></a>
									系统管理
							</li>
							<li class="list-group-item <?php  if($controller == 'account') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('account/display');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="公众号管理">
									<a class="pull-right" href="<?php  echo url('account/display');?>"><i class="fa fa-wechat"></i></a>
									公众号管理
							</li>
							<li class="list-group-item <?php  if($a == 'recycle') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('account/recycle');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="公众号回收站">
									<a class="pull-right" href="<?php  echo url('account/recycle');?>"><i class="fa fa-trash-o"></i></a>
									公众号回收站
							</li>
							
						</ul>
						<?php  if($_W['isfounder']) { ?>
												<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-joomla"></i> 应用商城管理</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-2">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-2">
                        							<li class="list-group-item " onclick="window.location.href = '<?php  echo url('cloud/up');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="一键更新">
									<a class="pull-right" href="<?php  echo url('cloud/up');?>"><i class="fa fa-cloud-download"></i></a>
									一键更新
							</li>
							<li class="list-group-item <?php  if($do == 'mymodule') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('home/welcome/members');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="应用商店">
									<a class="pull-right" href="<?php  echo url('home/welcome/members');?>"><i class="fa fa-joomla"></i></a>
									应用商店
							</li>
							<li class="list-group-item <?php  if($do == 'list') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('shop/module/list');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="应用管理">
									<a class="pull-right" href="<?php  echo url('shop/module/list');?>"><i class="fa fa-cubes"></i></a>
									应用管理
							</li>
							<li class="list-group-item <?php  if($do == 'record') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('member/member/record');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="消费记录">
									<a class="pull-right" href="<?php  echo url('member/member/record');?>"><i class="fa fa-money"></i></a>
									消费记录
							</li>
							<li class="list-group-item <?php  if($do == 'chongzhi') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('member/member/chongzhi');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="充值记录">
									<a class="pull-right" href="<?php  echo url('member/member/chongzhi');?>"><i class="fa fa-money"></i></a>
									充值记录
							</li>
							<li class="list-group-item <?php  if($do == 'payset') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('shop/mpayset/payset');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="支付设置">
									<a class="pull-right" href="<?php  echo url('shop/mpayset/payset');?>"><i class="fa fa-check-square"></i></a>
									支付设置
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('shop/taocan');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="套餐绑定">
									<a class="pull-right" href="<?php  echo url('shop/taocan');?>"><i class="fa fa-exchange"></i></a>
									套餐绑定
							</li>
							<li class="list-group-item <?php  if($do == 'mkset') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('shop/mkdel/mkset');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="相关设置">
									<a class="pull-right" href="<?php  echo url('shop/mkdel/mkset');?>"><i class="fa fa-sitemap"></i></a>
									相关设置
							</li>
							
						</ul>
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-cubes"></i> 功能扩展</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-3">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-3">
							<li class="list-group-item <?php  if($do == 'module') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('extension/module');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="模块管理">
									<a class="pull-right" href="<?php  echo url('extension/module');?>"><i class="fa fa-cubes"></i></a>
									模块管理
							</li>
							<li class="list-group-item <?php  if($do == 'subscribe') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('extension/subscribe/subscribe');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="订阅管理">
									<a class="pull-right" href="<?php  echo url('extension/subscribe/subscribe');?>"><i class="fa fa-volume-up"></i></a>
									订阅管理
							</li>
							<li class="list-group-item <?php  if($do == 'yuming') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('extension/service/display');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="常用服务">
									<a class="pull-right" href="<?php  echo url('extension/service/display');?>"><i class="fa fa-glass"></i></a>
									常用服务
							</li>
							<li class="list-group-item <?php  if($do == 'copyright') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('extension/theme');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="微站风格">
									<a class="pull-right" href="<?php  echo url('extension/theme');?>"><i class="fa fa-photo"></i></a>
									微站风格
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('extension/pc');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="PC站风格">
									<a class="pull-right" href="<?php  echo url('extension/pc');?>"><i class="fa fa-laptop"></i></a>
									PC站风格
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('extension/theme/web');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="后台皮肤">
									<a class="pull-right" href="<?php  echo url('extension/theme/web');?>"><i class="fa fa-image"></i></a>
									后台皮肤
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('extension/menu');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="系统菜单">
									<a class="pull-right" href="<?php  echo url('extension/menu');?>"><i class="fa fa-list"></i></a>
									系统菜单
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('extension/platform');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="微信开放平台">
									<a class="pull-right" href="<?php  echo url('extension/platform');?>"><i class="fa fa-cubes"></i></a>
									微信开放平台
							</li>
							
						</ul>
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-rss-square"></i> 文章/公告</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-4">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-4">
							<li class="list-group-item <?php  if($do == 'base') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('article/about');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="关于我们">
									<a class="pull-right" href="<?php  echo url('article/about');?>"><i class="fa fa-meh-o"></i></a>
									关于我们
							</li>
							<li class="list-group-item <?php  if($controller == '') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('article/news');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="新闻管理">
									<a class="pull-right" href="<?php  echo url('article/news');?>"><i class="fa fa-file-audio-o"></i></a>
									新闻管理
							</li>
							<li class="list-group-item <?php  if($do == 'yuming') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('article/notice');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="公告管理">
									<a class="pull-right" href="<?php  echo url('article/notice');?>"><i class="fa fa-rss-square"></i></a>
									公告管理
							</li>
							<li class="list-group-item <?php  if($do == 'copyright') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('article/case');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="案例管理">
									<a class="pull-right" href="<?php  echo url('article/case');?>"><i class="fa fa-align-center"></i></a>
									案例管理
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('article/product');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="产品管理">
									<a class="pull-right" href="<?php  echo url('article/product');?>"><i class="fa fa-thumbs-o-up"></i></a>
									产品管理
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('article/agent');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="代理公司">
									<a class="pull-right" href="<?php  echo url('article/agent');?>"><i class="fa fa-users"></i></a>
									代理公司
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('website/wenda');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="问答系统">
									<a class="pull-right" href="<?php  echo url('website/wenda');?>"><i class="fa fa-question"></i></a>
									问答系统
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('article/link');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="友情链接">
									<a class="pull-right" href="<?php  echo url('article/link');?>"><i class="fa fa-chain"></i></a>
									友情链接
							</li>
							
						</ul>
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-wechat"></i> 公众号管理</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-5">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-5">
							<li class="list-group-item <?php  if($do == 'base') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('account/display');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="公众号列表">
									<a class="pull-right" href="<?php  echo url('account/display');?>"><i class="fa fa-wechat"></i></a>
									公众号列表
							</li>
							<li class="list-group-item <?php  if($controller == '') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('account/batch');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="批量操作公众号">
									<a class="pull-right" href="<?php  echo url('account/batch');?>"><i class="fa fa-align-left"></i></a>
									批量操作公众号
							</li>
							<li class="list-group-item <?php  if($do == 'yuming') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('account/groups');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="公众号服务套餐">
									<a class="pull-right" href="<?php  echo url('account/groups');?>"><i class="fa fa-comments-o"></i></a>
									公众号服务套餐
							</li>
							<li class="list-group-item <?php  if($do == 'copyright') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('account/recycle');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="公众号回收站">
									<a class="pull-right" href="<?php  echo url('account/recycle');?>"><i class="glyphicon glyphicon-trash"></i></a>
									公众号回收站
							</li>
							
						</ul>
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-user"></i> 用户管理</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-6">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-6">
							<li class="list-group-item <?php  if($do == 'base') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/profile');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="我的账号">
									<a class="pull-right" href="<?php  echo url('user/profile');?>"><i class="fa fa-briefcase"></i></a>
									我的账户
							</li>
							<li class="list-group-item <?php  if($controller == '') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/display');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="用户管理">
									<a class="pull-right" href="<?php  echo url('user/display');?>"><i class="fa fa-user"></i></a>
									用户管理
							</li>
							<li class="list-group-item <?php  if($do == 'yuming') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/group');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="用户组管理">
									<a class="pull-right" href="<?php  echo url('user/group');?>"><i class="fa fa-users"></i></a>
									用户组管理
							</li>
							<li class="list-group-item <?php  if($do == 'copyright') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/registerset');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="注册选项">
									<a class="pull-right" href="<?php  echo url('user/registerset');?>"><i class="fa fa-user-md"></i></a>
									注册选项
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/fields');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="资料字段管理">
									<a class="pull-right" href="<?php  echo url('user/fields');?>"><i class="glyphicon glyphicon-list-alt"></i></a>
									资料字段管理
							</li>
							
						</ul>
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-cogs"></i> 系统管理</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-7">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-7">
							<li class="list-group-item <?php  if($do == 'base') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/updatecache');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="更新缓存">
									<a class="pull-right" href="<?php  echo url('system/updatecache');?>"><i class="fa fa-refresh"></i></a>
									更新缓存
							</li>
							<li class="list-group-item <?php  if($controller == '') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/site');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="站点设置">
									<a class="pull-right" href="<?php  echo url('system/site');?>"><i class="fa fa-cogs"></i></a>
									站点设置
							</li>
							<li class="list-group-item <?php  if($do == 'yuming') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/mbsite');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="手机模板DIY">
									<a class="pull-right" href="<?php  echo url('system/mbsite');?>"><i class="fa fa-wrench"></i></a>
									手机模板DIY
							</li>
							<li class="list-group-item <?php  if($do == 'copyright') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/attachment');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="附件设置">
									<a class="pull-right" href="<?php  echo url('system/attachment');?>"><i class="fa fa-download"></i></a>
									附件设置
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/common');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="其他设置">
									<a class="pull-right" href="<?php  echo url('system/common');?>"><i class="fa fa-gear"></i></a>
									其他设置
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/database');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="数据库">
									<a class="pull-right" href="<?php  echo url('system/database');?>"><i class="fa fa-database"></i></a>
									数据库
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/tools');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="工具">
									<a class="pull-right" href="<?php  echo url('system/tools');?>"><i class="fa fa-legal"></i></a>
									工具
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/sysinfo');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="系统信息">
									<a class="pull-right" href="<?php  echo url('system/sysinfo');?>"><i class="fa fa-exclamation"></i></a>
									系统信息
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/logs');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="查看日志">
									<a class="pull-right" href="<?php  echo url('system/logs');?>"><i class="fa fa-book"></i></a>
									查看日志
							</li>
							
						</ul>
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-wrench"></i> 系统工具</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-8">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-8">
							<li class="list-group-item <?php  if($do == 'base') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/tools/scan');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="木马查杀">
									<a class="pull-right" href="<?php  echo url('system/tools/scan');?>"><i class="fa fa-bug"></i></a>
									木马查杀
							</li>
							<li class="list-group-item <?php  if($controller == '') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/tools/bom');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="bom检测">
									<a class="pull-right" href="<?php  echo url('system/tools/bom');?>"><i class="fa fa-file-code-o"></i></a>
									bom检测
							</li>
							<li class="list-group-item <?php  if($do == 'yuming') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/optimize');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="性能优化">
									<a class="pull-right" href="<?php  echo url('system/optimize');?>"><i class="fa fa-rocket"></i></a>
									性能优化
							</li>
							<li class="list-group-item <?php  if($do == 'copyright') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('system/filecheck');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="系统文件校验">
									<a class="pull-right" href="<?php  echo url('system/filecheck');?>"><i class="fa fa-file"></i></a>
									系统文件校验
							</li>
							
						</ul>
						<?php  } else { ?>
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-user"></i> 会员服务</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-0">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-0">
							<li class="list-group-item <?php  if($do == 'list') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('home/welcome/members');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="应用商店">
									<a class="pull-right" href="<?php  echo url('home/welcome/members');?>"><i class="fa fa-joomla"></i></a>
									应用商店
							</li>
							
							<li class="list-group-item <?php  if($do == 'member') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('member/member/member');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="在线充值">
									<a class="pull-right" href="<?php  echo url('member/member');?>"><i class="fa fa-money"></i></a>
									在线充值
							</li>
							<li class="list-group-item <?php  if($do == 'record') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('member/member/record');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="消费记录">
									<a class="pull-right" href="<?php  echo url('member/member/record');?>"><i class="fa fa-money"></i></a>
									消费记录
							</li>
							<li class="list-group-item <?php  if($do == 'buy') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('member/buypackage/buy');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="增值业务">
									<a class="pull-right" href="<?php  echo url('member/buypackage/buy');?>"><i class="fa fa-coffee"></i></a>
									增值业务
							</li>
							<li class="list-group-item <?php  if($do == 'test') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/display');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="下级用户管理">
									<a class="pull-right" href="<?php  echo url('user/display');?>"><i class="fa fa-users"></i></a>
									下级用户管理
							</li>
							
						</ul>
						<div class="panel-heading" style='padding: 14px 15px;'>
							<h4 class="panel-title"><i class="fa fa-gears"></i> 设置中心</h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-1">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-1">
							<li class="list-group-item <?php  if($do == 'base') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/profile/base');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="我的账号">
									<a class="pull-right" href="<?php  echo url('user/profile/base');?>"><i class="fa fa-user"></i></a>
									我的账户
							</li>
							<li class="list-group-item <?php  if($controller == '') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/profile');?>';" style="cursor:pointer; overflow:hidden;padding-left: 35px;" kw="修改密码">
									<a class="pull-right" href="<?php  echo url('user/profile');?>"><i class="fa fa-key"></i></a>
									修改密码
							</li>
							<li class="list-group-item <?php  if($do == 'yuming') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/set/yuming');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="域名绑定">
									<a class="pull-right" href="<?php  echo url('user/set/yuming');?>"><i class="fa fa-bars"></i></a>
									域名绑定
							</li>
							<li class="list-group-item <?php  if($do == 'copyright') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/set/copyright');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="版权设置">
									<a class="pull-right" href="<?php  echo url('user/set/copyright');?>"><i class="fa fa-gears"></i></a>
									版权设置
							</li>
							<li class="list-group-item <?php  if($do == 'pifu') { ?> active<?php  } ?>" onclick="window.location.href = '<?php  echo url('user/set/pifu');?>';" style="cursor:pointer; overflow:hidden; padding-left: 35px;" kw="自定义皮肤">
									<a class="pull-right" href="<?php  echo url('user/set/pifu');?>"><i class="fa fa-wrench"></i></a>
									自定义皮肤
							</li>
							
						</ul>
						<?php  } ?>
					</div>
					
					<script type="text/javascript">
						require(['bootstrap'], function(){
							$('.ext-type').click(function(){
								var id = $(this).data('id');
								util.cookie.del('ext_type');
								util.cookie.set('ext_type', id, 8640000);
								location.reload();
								return false;
							});

							$('#search-menu input').keyup(function() {
								var a = $(this).val();
								$('.big-menu .list-group-item, .big-menu .panel-heading').hide();
								$('.big-menu .list-group-item').each(function() {
									$(this).css('border-left', '0');
									if(a.length > 0 && $(this).attr('kw').indexOf(a) >= 0) {
										$(this).parents(".panel").find('.panel-heading').show();
										$(this).show().css('border-left', '3px #428bca double');
									}
								});
								if(a.length == 0) {
									$('.big-menu .list-group-item, .big-menu .panel-heading').show();
								}
							});
						});
					</script>
				</div>
		<div class="col-xs-12 col-sm-9 col-lg-10 well">
<?php  } ?>
<script>
	var h = document.documentElement.clientHeight;
	$(".gw-container").css('min-height',h);
	<?php  echo site_profile_perfect_tips();?>
</script>