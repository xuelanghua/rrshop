<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
	.order-list a {
		position: relative;
	}
	.order-list span  {
	 
	float:right;margin-right:20px;
	}
</style>
<ul class="menu-head-top">
    <li <?php  if($_W['action']=='order') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('order')?>">订单概述 <i class="fa fa-caret-right"></i></a></li>
</ul>

<?php if(cv('order.list.status1|order.list.status2|order.list.status0|order.list.status3|order.list.status_1|order.list.main')) { ?>
<div class='menu-header'>订单</div>
<ul class='order-list'>
    <?php if(cv('order.list.status1')) { ?>
    <li <?php  if($_W['routes']=='order.list.status1') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/list/status1')?>">待发货 <span class='text-danger status1'>--</span></a>
    </li>
    <?php  } ?>
    
    <?php if(cv('order.list.status2')) { ?>
    <li <?php  if($_W['routes']=='order.list.status2') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/list/status2')?>">待收货 <span class='text-warning status2'>--</span></a>
    </li>
    <?php  } ?>

    <?php if(cv('order.list.status0')) { ?>
    <li <?php  if($_W['routes']=='order.list.status0') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/list/status0')?>">待付款 <span class="status0">--</span></a>
    </li>
    <?php  } ?>
    <?php if(cv('order.list.status3')) { ?>
    <li <?php  if($_W['routes']=='order.list.status3') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/list/status3')?>">已完成 <span class='text-primary status3'>--</span></a>
    </li>
    <?php  } ?>
    
     <?php if(cv('order.list.status_1')) { ?>
    <li <?php  if($_W['routes']=='order.list.status_1') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/list/status_1')?>">已关闭 <span class="status_1">--</span></a>
    </li>
    <?php  } ?>

             <?php if(cv('order.list.main')) { ?>
    <li <?php  if($_W['routes']=='order.list' && $_GPC['status']=='' && $_GPC['refund']!='1') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/list')?>" >全部订单<span class="all">--</span></a>
    </li>
    <?php  } ?>
    
    <?php  if($operation == 'detail') { ?>
    <li class="active">
        <a href="#">订单详情</a>
    </li>
    <?php  } ?>
</ul>
<?php  } ?>
  <?php if(cv('order.list.status4|order.list.status5')) { ?>
<div class='menu-header'>维权</div>
<ul class='order-list'>
    <?php if(cv('order.list.status4')) { ?>
    <li <?php  if($_W['routes']=='order.list.status4') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/list/status4')?>">维权申请 <span class='text-danger status4'>--</span></a>
    </li>
    <?php  } ?>
     
    <?php if(cv('order.list.status5')) { ?>
    <li <?php  if($_W['routes']=='order.list.status5') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/list/status5')?>">维权完成 <span class="status5">--</span></a>
    </li>
    <?php  } ?>
      </ul>
<?php  } ?>

<?php if(cv('order.export|order.batchsend')) { ?>
<div class='menu-header'>工具</div>
<ul>
    <?php if(cv('order.export')) { ?>
    <li <?php  if($operation=='export') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/export')?>">自定义导出</a>
    </li>
    <?php  } ?>

    <?php if(cv('order.batchsend')) { ?>
    <li <?php  if($operation=='batchsend') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('order/batchsend')?>">批量发货</a>
    </li>
    <?php  } ?>
</ul>
<?php  } ?>
<script>
    $(function () {
        $.ajax({type: "GET",url: "<?php  echo webUrl('order/list/ajaxgettotals')?>",dataType:"json",success: function(data){
                var res = data.result;
                $("span.status0").text(res.status0);
                $("span.status1").text(res.status1);
                $("span.status2").text(res.status2);
                $("span.status3").text(res.status3);
                $("span.status4").text(res.status4);
                $("span.status5").text(res.status5);
                $("span.status_1").text(res.status_1);
                $("span.all").text(res.all);
            }
        });
    });
</script>