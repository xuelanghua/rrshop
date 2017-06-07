<?php defined('IN_IA') or exit('Access Denied');?>	<script type="text/javascript">
		require(['bootstrap']);
		$('.js-clip').each(function(){
			util.clip(this, $(this).attr('data-url'));
		});
	</script>
	<div class="container-fluid footer" role="footer">
		<div class="page-header"></div>
		<span class="pull-left">
			<p><!-- <?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?> -->Powered by <a href=""><b>万贤CMS</b><!-- </a>&nbsp; &nbsp; V<?php echo IMS_VERSION;?> &copy; 2014-2015 &nbsp; &nbsp; <a href="">www.weizancms.com</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?> --></p>
		</span>
		<span class="pull-right">
			<p><!-- <?php  if(empty($_W['setting']['copyright']['footerright'])) { ?> --><a href="">万贤科技</a><!-- &nbsp; &nbsp; <a href="http://bbs.012wz.com">微赞帮助1</a> --> <!-- <?php  } else { ?><?php  echo $_W['setting']['copyright']['footerright'];?><?php  } ?><?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?>&nbsp; &nbsp; <?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?></p>
		</span>
	</div>
	<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
</body>
</html>
