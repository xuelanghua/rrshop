<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
   .mc-list a {
      position: relative;
   }
   .mc-list span  {

      float:right;margin-right:20px;
   }
</style>

<div class='menu-header'>入驻申请</div>
<ul class="mc-list">
   <?php if(cv('merch.reg')) { ?><li <?php  if($_W['routes']=='merch.reg' && $_GPC['status']==0) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/reg',array('status'=>0))?>">申请中 <span class="text-danger" id="reg0">-</span></a> </li><?php  } ?>
   <?php if(cv('merch.reg')) { ?><li <?php  if($_W['routes']=='merch.reg' && $_GPC['status']==-1) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/reg',array('status'=>-1))?>">驳回 <span class="text-default"  id="reg_1">-</span></a> </li><?php  } ?>
</ul>

<div class='menu-header'>商户管理</div>
<ul class="mc-list">
   <?php if(cv('merch.user')) { ?><li <?php  if($_W['routes']=='merch.user' && $_GPC['status']==0) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/user',array('status'=>0))?>">待入驻 <span class="text-success"  id="user0">-</span></a></li><?php  } ?>
   <?php if(cv('merch.user')) { ?><li <?php  if($_W['routes']=='merch.user' && $_GPC['status']==1) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/user',array('status'=>1))?>">入驻中 <span class="text-primary"  id="user1">-</span></a></li><?php  } ?>
   <?php if(cv('merch.user')) { ?><li <?php  if($_W['routes']=='merch.user' && $_GPC['status']==2) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/user',array('status'=>2))?>">暂停中 <span class="text-warning"  id="user2">-</span></a></li><?php  } ?>
   <?php if(cv('merch.user')) { ?><li <?php  if($_W['routes']=='merch.user' && $_GPC['status']==3) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/user',array('status'=>3))?>">即将到期 <span class="text-danger"   id="user3">-</span></a></li><?php  } ?>
   <?php if(cv('merch.group')) { ?><li <?php  if($_W['routes']=='merch.group') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/group')?>">商户分组</a></li><?php  } ?>
   <?php if(cv('merch.category')) { ?><li <?php  if($_W['routes']=='merch.category') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/category')?>">商户分类</a></li><?php  } ?>
</ul>

<div class='menu-header'>数据</div>
<ul class="mc-list">
   <?php if(cv('merch.statistics.order')) { ?><li <?php  if($_W['routes']=='merch.statistics.order') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/statistics/order')?>">订单统计</a></li><?php  } ?>
   <?php if(cv('merch.statistics.merch')) { ?><li <?php  if($_W['routes']=='merch.statistics.merch') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/statistics/merch')?>">商户统计</a></li><?php  } ?>
</ul>

<div class='menu-header'>提现申请</div>
<ul class="mc-list">
    <?php if(cv('merch.check.status1')) { ?><li <?php  if($_W['routes']=='merch.check.status1') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/check/status1')?>">待确认的 <span class="text-default"  id="status1">-</span></a></li><?php  } ?>
    <?php if(cv('merch.check.status2')) { ?><li <?php  if($_W['routes']=='merch.check.status2') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/check/status2')?>">待打款的 <span class="text-primary"  id="status2">-</span></a></li><?php  } ?>
    <?php if(cv('merch.check.status3')) { ?><li <?php  if($_W['routes']=='merch.check.status3') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/check/status3')?>">已打款的 <span class="text-success"  id="status3">-</span></a></li><?php  } ?>
    <?php if(cv('merch.check.status_1')) { ?><li <?php  if($_W['routes']=='merch.check.status_1') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/check/status_1')?>">无效的 <span class="text-success"  id="status_1">-</span></a></li><?php  } ?>
</ul>

<!--div class='menu-header'>结算订单</div>
<ul class="mc-list">

   <?php if(cv('merch.clearing.status0')) { ?><li <?php  if($_W['routes']=='merch.clearing.status0') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/clearing/status0')?>">待确认 <span class="text-default"  id="status0">-</span></a></li><?php  } ?>
   <?php if(cv('merch.clearing.status1')) { ?><li <?php  if($_W['routes']=='merch.clearing.status1') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/clearing/status1')?>">待结算 <span class="text-primary"  id="status1">-</span></a></li><?php  } ?>
   <?php if(cv('merch.clearing.status2')) { ?><li <?php  if($_W['routes']=='merch.clearing.status2') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/clearing/status2')?>">已结算 <span class="text-success"  id="status2">-</span></a></li><?php  } ?>
   <?php if(cv('merch.clearing.add')) { ?><li <?php  if($_W['routes']=='merch.clearing.add') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/clearing/add')?>">创建结算单</a></li><?php  } ?>

</ul-->

<div class='menu-header'>设置</div>
<ul>

   <?php if(cv('merch.set')) { ?><li <?php  if($_W['routes']=='merch.set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/set')?>">基础设置</a></li><?php  } ?>
   <?php if(cv('merch.notice')) { ?><li <?php  if($_W['routes']=='merch.notice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/notice')?>">通知设置</a></li><?php  } ?>
   <?php if(cv('merch.cover')) { ?><li <?php  if($_W['routes']=='merch.cover') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/cover')?>">入口设置</a></li><?php  } ?>
   <?php if(cv('merch.category.swipe')) { ?><li <?php  if($_W['routes']=='merch.category.swipe') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('merch/category.swipe')?>">商户分类幻灯</a></li><?php  } ?>

</ul>
<script language="javascript">
   $(function(){
      $.ajax({
         url: "<?php  echo webUrl('merch/util/totals')?>",
         dataType:'json',
         cache:false,
         success:function(ret){
            $('#reg0').html( ret.result.reg0);
            $('#reg_1').html( ret.result.reg_1);
            $('#user0').html( ret.result.user0);
            $('#user1').html( ret.result.user1);
            $('#user2').html( ret.result.user2);
            $('#user3').html( ret.result.user3);
//            $('#status0').html( ret.result.status0);
            $('#status1').html( ret.result.status1);
            $('#status2').html( ret.result.status2);
            $('#status3').html( ret.result.status3);
            $('#status_1').html( ret.result.status_1);
         }
      });

   });

</script>