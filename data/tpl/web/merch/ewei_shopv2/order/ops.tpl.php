<?php defined('IN_IA') or exit('Access Denied');?>
<?php  if(empty($item['statusvalue'])) { ?>
<!--未付款-->

<?php if(mcv('order.op.pay')) { ?>
<?php  if($item['paytypevalue']==3) { ?>
<a class="btn btn-primary btn-xs" data-toggle="ajaxModal"  href="<?php  echo merchUrl('order/op/send', array('id' => $item['id']))?>">确认发货</a>
<?php  } else { ?>
<!--<a class="btn btn-primary btn-xs" data-toggle="ajaxPost" href="<?php  echo merchUrl('order/op/pay', array('id' => $item['id']))?>" data-confirm="确认此订单已付款吗？">确认付款</a>-->
<?php  } ?>
<?php  } ?>

<?php  } else if($item['statusvalue'] == 1) { ?>
<!--已付款-->

<?php  if(!empty($item['addressid']) ) { ?>
<!--快递 发货-->
<?php if(mcv('order.op.send')) { ?>
<a class="btn btn-primary btn-xs" data-toggle="ajaxModal"  href="<?php  echo merchUrl('order/op/send', array('id' => $item['id']))?>">确认发货</a>
<?php  } ?>
<?php  } else { ?>
<?php  if($item['isverify']==1) { ?>
<!--核销 确认核销-->
<?php if(mcv('order.op.verify')) { ?>
<a class="btn btn-primary btn-xs" data-toggle='ajaxPost' href="<?php  echo merchUrl('order/op/fetch', array('id' => $item['id']))?>" data-confirm="确认使用吗？">确认使用</a>
<?php  } ?>
<?php  } else { ?>
<!--自提 确认取货-->
<?php if(mcv('order.op.fetch')) { ?>
<a class="btn btn-primary btn-xs" data-toggle='ajaxPost'  href="<?php  echo merchUrl('order/op/fetch', array('id' => $item['id']))?>" data-confirm="确认取货吗？">确认取货</a>
<?php  } ?>
<?php  } ?>

<?php  } ?>


<?php  } else if($item['statusvalue'] == 2) { ?>
<!--已发货-->
<?php  if(!empty($item['addressid'])) { ?>
<!--快递 取消发货-->

<?php  if($detial_flag == 1) { ?>
<?php if(mcv('order.op.send')) { ?><a class="btn btn-success btn-xs" data-toggle="ajaxModal"  href="<?php  echo merchUrl('order/op/changeexpress', array('id' => $item['id']))?>">修改物流</a>&nbsp;&nbsp;&nbsp;<?php  } ?>
<?php  } ?>

<?php  if($merch_user['finishchecked'] == 1) { ?>
<?php if(mcv('order.op.finish')) { ?><?php  if(strexists($_W['action'],'order.list')) { ?><?php  } ?><a class="btn btn-primary btn-xs" data-toggle='ajaxPost'  href="<?php  echo merchUrl('order/op/finish', array('id' => $item['id']))?>" data-confirm="确认订单收货吗？">确认收货</a><?php  } ?>
<?php  } ?>

<?php if(mcv('order.op.sendcancel')) { ?><?php  if(strexists($_W['action'],'order.list')) { ?><br/><?php  } ?>
<a class="btn-xs" data-toggle='ajaxModal'  href="<?php  echo merchUrl('order/op/sendcancel', array('id' => $item['id']))?>" >取消发货</a><?php  } ?>

<?php  } ?>

<?php  } else if($item['statusvalue'] == 3) { ?>

<?php  } ?>
