<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
	.feed-activity-list {
		width: 100%;
		overflow: hidden;
		padding-top: 10px;
		padding-bottom: 10px;
		border-bottom: 1px solid #f2f2f2
	}
	
	.feed-element {
		float: left;
		cursor: pointer;
		width: 400px;
		padding: 10px;
		margin: 0;
		margin-right: 10px;
		margin-left: 10px;
		border: none;
	}
	
	.feed-element::after {
		display: none
	}
	
	.feed-element .title {
		font-size: 14px;
		font-weight: bold;
		height: 32px;
		margin-top: 10px;
	}
	
	.feed-activity-list .feed-element {
		border: none;
		border-right: 1px solid #f2f2f2;
	}
	
	.feed-element img.img-circle,
	.dropdown-messages-box img.img-circle {
		width: 60px;
		height: 60px;
		border-radius: 10px;
	}
	
	.media-body {
		margin-top: 3px;
	}
</style>
<div class="page-heading">
	<h2>我的应用</h2> 
</div>

<div class='panel panel-default' style='border:none;'>
	<?php  if(is_array($category)) { foreach($category as $ck => $cv) { ?> 
		<?php  if(count($cv['plugins'])<=0) { ?><?php  continue;?><?php  } ?> 
		<div class="panel-heading" style='background:none;border:none;'>
			<?php  echo $cv['name'];?>
		</div>
		<div class="feed-activity-list">
			<?php  if(is_array($cv['plugins'])) { foreach($cv['plugins'] as $plugin) { ?>
				<?php  if(com_run('perm::check_plugin',$plugin['identity'])) { ?>
				<?php if(cv($plugin['identity'])) { ?>
					<div class="feed-element" onclick="location.href='<?php  echo webUrl($plugin['identity'])?>'">
						<span class="pull-left">
							<img src="<?php echo empty($plugin['thumb'])?'../addons/ewei_shopv2/static/images/plugin.png': tomedia($plugin['thumb'])?>" class="img-circle" alt="image">
						</span>
						<div class="media-body ">
							<span class="title"><?php  echo $plugin['name'];?></span>
							<br>
							<small class="text-muted"><?php  echo $plugin['desc'];?></small>
						</div>
					</div>
				<?php  } ?>
				<?php  } ?>
			<?php  } } ?>
		</div>
	<?php  } } ?>
</div>
<script>
	$(document).ready(function () {
		$('.feed-activity-list,.plugin_tabs').each(function(){
			if($(this).children().length<=0){
				$(this).prev().remove();
				$(this).remove();
			}
		});
	})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>