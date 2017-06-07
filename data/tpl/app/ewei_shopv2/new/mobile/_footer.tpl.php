<?php defined('IN_IA') or exit('Access Denied');?><?php  $task_mode =intval(m('cache')->getString('task_mode', 'global'))?>
<?php  if($task_mode==0) { ?>
<script language='javascript'>
	$(function(){
		$.getJSON("<?php  echo mobileUrl('util/task')?>");
	})
</script>
<?php  } ?>

<script language="javascript">
	require(['init']);

	setTimeout(function () {
		if($(".danmu").length>0){
			$(".danmu").remove();
		}
	}, 500);
</script>


<?php  if(is_h5app()) { ?>
	<?php  $this->shopShare()?>
	<script language='javascript'>
		require(['biz/h5app'], function (modal) {
			modal.init({
				share: <?php  echo json_encode($_W['shopshare'])?>,
				backurl: "<?php  echo $_GPC['backurl'];?>",
				statusbar: "<?php  echo intval($_W['shopset']['wap']['statusbar'])?>",
				payinfo: <?php  echo json_encode($payinfo)?>
			});
			<?php  if($initWX) { ?>
			modal.initWX();
			<?php  } ?> 
		});

	</script>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('headmenu', TEMPLATE_INCLUDEPATH)) : (include template('headmenu', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_share', TEMPLATE_INCLUDEPATH)) : (include template('_share', TEMPLATE_INCLUDEPATH));?>

<?php $merchid = !empty($goods['merchid'])?$goods['merchid']:$_GPC['merchid']?>

<?php $this->diyLayer(true, $diypage, $merchid?$merchid:false)?>
<?php  if(!$hideGoTop) { ?>
	<?php  $this->diyGotop(true, $diypage)?>
<?php  } ?>

<?php  $this->wapQrcode()?>
<span style="display:none"><?php  echo $_W['shopset']['shop']['diycode'];?></span>
</body>
</html>
