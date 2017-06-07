<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!empty($advs)) { ?>
	<div class='fui-swipe' > 
	    <div class='fui-swipe-wrapper'>
	    	<?php  if(is_array($advs)) { foreach($advs as $item) { ?>
	    		<div class='fui-swipe-item' <?php  if(!empty($item['link'])) { ?>onclick="location.href='<?php  echo $item['link'];?>'"<?php  } ?>><img src="<?php  echo tomedia($item['thumb'])?>" /></div>
			<?php  } } ?>
	    </div>
	    <div class='fui-swipe-page'></div>
	</div>
<?php  } ?>