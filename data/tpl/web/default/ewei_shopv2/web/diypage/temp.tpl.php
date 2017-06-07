<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<link href="../addons/ewei_shopv2/plugin/diypage/static/css/template.css?v=201606141600" rel="stylesheet" type="text/css"/>

<form action="./index.php" method="get">
	<input type="hidden" name="c" value="site">
	<input type="hidden" name="a" value="entry">
	<input type="hidden" name="m" value="ewei_shopv2">
	<input type="hidden" name="do" value="web">
	<input type="hidden" name="r" value="diypage.temp">
	<input type="hidden" name="type" value="<?php  echo $_GPC['type'];?>">
	<input type="hidden" name="cate" value="<?php  echo $_GPC['cate'];?>">
	<div class="page-heading">
		<span class="pull-right input-group" style="width: 200px">
			<input type="text" class="input-sm form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入模板名称">
			<span class="input-group-btn">
				<button class="btn btn-sm btn-primary" type="submit" style="margin-left: 0; border-radius: 0"> 搜索</button>
			</span>
		</span>
		<h2>模板管理 <small>总数(<?php  echo $total;?>)</small></h2>
	</div>
</form>

<div class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-2 control-label" style="width: 75px; font-size: 14px; padding: 0;">模板类型</div>
		<div class="col-sm-10">
			<a class="btn btn-xs <?php  if($_GPC['type']=='') { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>'', 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">全部类型</a>
			<a class="btn btn-xs <?php  if($_GPC['type']==1) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>1, 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">自定义页面</a>
			<a class="btn btn-xs <?php  if($_GPC['type']==2) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>2, 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">商城首页</a>
			<?php  if($_W['plugin']!='merch'&&empty($_W['merchid'])) { ?>
				<a class="btn btn-xs <?php  if($_GPC['type']==3) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>3, 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">会员中心</a>
				<?php  if(p('commission')) { ?>
				<a class="btn btn-xs <?php  if($_GPC['type']==4) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>4, 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">分销中心</a>
				<?php  } ?>
				<a class="btn btn-xs <?php  if($_GPC['type']==5) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>5, 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">商品详情</a>
				<?php  if(p('creditshop')) { ?>
				<a class="btn btn-xs <?php  if($_GPC['type']==6) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>6, 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">积分商城</a>
				<?php  } ?>
				<?php  if(p('seckill')) { ?>
				<a class="btn btn-xs <?php  if($_GPC['type']==7) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>7, 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">整点秒杀</a>
				<?php  } ?>
				<?php  if(p('exchange')) { ?>
				<a class="btn btn-xs <?php  if($_GPC['type']==8) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('type'=>8, 'cate'=>$_GPC['cate'], 'keyword'=>$_GPC['keyword']))?>">兑换中心</a>
				<?php  } ?>
			<?php  } ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label" style="width: 75px; font-size: 14px; padding: 0;">模板分类</div>
		<div class="col-sm-10">
			<a class="btn btn-xs <?php  if($_GPC['cate']=='') { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('cate'=>'', 'type'=>$_GPC['type'], 'keyword'=>$_GPC['keyword']))?>">全部分类</a>
			<a class="btn btn-xs <?php  if($_GPC['cate']=='0') { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('cate'=>'0', 'type'=>$_GPC['type'], 'keyword'=>$_GPC['keyword']))?>">未分类</a>
			<?php  if(is_array($category)) { foreach($category as $item) { ?>
			<a class="btn btn-xs <?php  if($_GPC['cate']==$item['id']) { ?>btn-info<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo webUrl('diypage/temp', array('cate'=>$item['id'], 'type'=>$_GPC['type'], 'keyword'=>$_GPC['keyword']))?>"><?php  echo $item['name'];?></a>
			<?php  } } ?>
		</div>
	</div>
</div>

<div class="row">
	<?php  if(empty($list)) { ?>
		<div class="panel panel-default" style="margin: 0 15px;">
			<div class="panel-body" style="text-align: center; padding:30px 0;">
				未查询到模板!
			</div>
		</div>
	<?php  } else { ?>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<div class="item">
				<img src="<?php  echo tomedia($item['preview'])?>" onerror="this.src='../addons/ewei_shopv2/plugin/diypage/static/images/nopic.jpg'" />
				<div class="cate">
					<?php  if($item['uniacid']==0) { ?>
						<span class="label label-primary">系统</span>
					<?php  } ?>
					<span class="label label-<?php  echo $allpagetype[$item['type']]['class'];?>"><?php  echo $allpagetype[$item['type']]['name'];?></span>
				</div>
				<div class="title"><?php  if(!empty($item['name'])) { ?><?php  echo $item['name'];?><?php  } else { ?>未命名<?php  } ?></div>
				<div class="mask">
					<div class="btns">
						<a class="btn btn-primary btn-block btn-sm create" data-href="<?php  echo webUrl('diypage/page')?>.<?php  echo $allpagetype[$item['type']]['pagetype'];?>.add&tid=<?php  echo $item['id'];?>&type=<?php  echo $item['type'];?>">创建页面</a>
						<?php  if(empty($item['uniacid'])) { ?>
							<?php  if($_W['isfounder']) { ?>
								<a class="btn btn-default btn-block btn-sm delete" data-tid="<?php  echo $item['id'];?>">删除模板</a>
							<?php  } ?>
						<?php  } else { ?>
							<?php if(cv('diypage.temp.delete')) { ?>
								<a class="btn btn-default btn-block btn-sm delete" data-tid="<?php  echo $item['id'];?>">删除模板</a>
							<?php  } ?>
						<?php  } ?>
					</div>
				</div>
			</div>
		<?php  } } ?>
	<?php  } ?>
</div>
<?php  echo $pager;?>

<script>
	$(".item").hover(function () {
		$(this).find('.mask').stop().fadeIn();
		$(this).find('.title').stop().fadeIn();
	}, function () {
		$(this).find('.mask').stop().fadeOut();
		$(this).find('.title').stop().fadeOut();
	});
	$(".create").unbind('click').click(function () {
		var href = $(this).data('href');
		if(!href) {
			tip.confirm("创建失败，模板参数错误！");
			return;
		}
		location.href = href;
	});
	$(".delete").unbind('click').click(function () {
		var _this = $(this);
		var status = _this.data('status');
		var tid = _this.data('tid');
		if(status) {
			tip.msgbox.err("正在删除中，请稍候。");
		}
		if(!tid){
			tip.msgbox.err("模板参数错误，请刷新重试！");
			return;
		}
		tip.confirm("删除后不可恢复，确定创建此模板？", function () {
			_this.data('status',1).text('删除中..');
			$.post("<?php  echo webUrl('diypage/temp/delete')?>", {id: tid,}, function (r) {
				if (r.status==0) {
					tip.msgbox.suc("删除成功！");
					_this.closest('.item').fadeOut().remove();
					setTimeout(function () {
						location.reload();
					}, 500);
				} else {
					tip.msgbox.err(r.result.message);
					_this.data('status',0).text('删除模板');
				}
			}, 'json');
		});
	});
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>