<?php defined('IN_IA') or exit('Access Denied');?><?php  if($type=='good') { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('lottery/query/query_goods', TEMPLATE_INCLUDEPATH)) : (include template('lottery/query/query_goods', TEMPLATE_INCLUDEPATH));?>
<?php  } else if($type=='coupon') { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('lottery/query/query_coupon', TEMPLATE_INCLUDEPATH)) : (include template('lottery/query/query_coupon', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
