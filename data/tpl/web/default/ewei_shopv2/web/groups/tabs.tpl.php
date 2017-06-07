<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
    .order-list a {
        position: relative;
    }
    .order-list span  {

        float:right;margin-right:20px;
    }
</style>

<?php 
$plugins = pdo_fetch("select status from ".tablename('ewei_shop_plugin')." where identity = :identity ",array(':identity'=>'exhelper'));
if($plugins['status']==1){
$exhelper = 1;
}else{
$exhelper = 0;
}
?>
<ul class="menu-head-top">
    <li <?php  if($_W['action']=='') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('groups')?>">拼团概述 <i class="fa fa-caret-right"></i></a></li>
</ul>
<div class='menu-header'><?php  echo $this->plugintitle?></div>
<ul>
    <?php if(cv('groups.goods')) { ?><li <?php  if($_W['action']=='goods') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('groups/goods')?>">商品管理</a></li><?php  } ?>
    <?php if(cv('groups.category')) { ?><li <?php  if($_W['action']=='category') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('groups/category')?>">分类管理</a></li><?php  } ?>
    <?php if(cv('groups.adv')) { ?><li <?php  if($_W['action']=='adv') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('groups/adv')?>">幻灯片管理</a></li><?php  } ?>
</ul>
<?php if(cv('groups.order')) { ?>
<div class='menu-header lynn_order'>订单管理</div>
<ul class="order-list">
    <li <?php  if($_GPC['status']==1) { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('groups/order',array('status'=>1))?>">待发货<span class='text-danger status1'>--</span></a>
    </li>
    <li <?php  if($_GPC['status']==2) { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('groups/order',array('status'=>2))?>">待收货<span class='text-warning status2'>--</span></a>
    </li>
    <li <?php  if($_GPC['status']==3) { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('groups/order',array('status'=>3))?>">待付款<span class=" status3">--</span></a>
    </li>
    <li <?php  if($_GPC['status']==4) { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('groups/order',array('status'=>4))?>">已完成<span class='text-primary status4'>--</span></a>
    </li>
    <li <?php  if($_GPC['status']==5) { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('groups/order',array('status'=>5))?>">已关闭<span class="status5">--</span></a>
    </li>
    <li <?php  if($_GPC['status']=='all') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('groups/order',array('status'=>'all'))?>">全部订单<span class="all">--</span></a>
    </li>
</ul>
<?php  } ?>
<?php if(cv('groups.verify')) { ?>
<div class='menu-header'>核销查询</div>
<ul class="order-list">
    <li <?php  if($_GPC['verify']=='normal') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/verify',array('verify'=>normal))?>">未核销<span class='text-warning verify1'>--</span></a>
    </li>
    <li  <?php  if($_GPC['verify']=='over') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/verify',array('verify'=>over))?>">已核销<span class='text-danger verify2'>--</span></a>
    </li>
    <li  <?php  if($_GPC['verify']=='cancel') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/verify',array('verify'=>cancel))?>">已取消<span class='text-danger verify3'>--</span></a>
    </li>
</ul>
<?php  } ?>
<?php if(cv('groups.team')) { ?>
<div class='menu-header'>拼团管理</div>
<ul class="order-list">
    <li <?php  if($_GPC['type']=='success') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/team',array('type'=>success))?>">拼团成功<span class='text-warning team1'>--</span></a>
    </li>
    <li  <?php  if($_GPC['type']=='ing') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/team',array('type'=>ing))?>">拼团中<span class='text-danger team2'>--</span></a>
    </li>
    <li <?php  if($_GPC['type']=='error') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/team',array('type'=>error))?>">拼团失败<span class='text-primary team3'>--</span></a>
    </li>
    <li <?php  if($_GPC['type']=='all') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/team',array('type'=>all))?>">全部拼团<span class='allteam'>--</span></a>
    </li>
</ul>
<?php  } ?>
<?php if(cv('groups.refund')) { ?>
<div class='menu-header'>维权设置</div>
<ul class="order-list">
    <li <?php  if($_GPC['status']=='apply') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/refund',array('status'=>apply))?>">维权申请<span class='text-warning refund1'>--</span></a>
    </li>
    <li <?php  if($_GPC['status']=='over') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('groups/refund',array('status'=>over))?>">维权完成<span class='text-danger refund2'>--</span></a>
    </li>
</ul>
<?php  } ?>
<div class='menu-header'>基础设置</div>
<ul>
    <?php if(cv('groups.cover')) { ?><li <?php  if($_W['action']=='cover') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('groups/cover')?>">入口设置</a></li><?php  } ?>
    <?php if(cv('groups.notice')) { ?><li  <?php  if($_W['action']=='notice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('groups/notice')?>">通知设置</a></li><?php  } ?>
    <?php if(cv('groups.set')) { ?><li <?php  if($_W['action']=='set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('groups/set')?>">基础设置</a></li><?php  } ?>
    <?php  if(p('exhelper') && !empty($exhelper)) { ?>
    <?php if(cv('exhelper')) { ?><li <?php  if($_W['action']=='exhelper') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('groups/exhelper')?>">快递打印</a></li><?php  } ?>
    <?php  } ?>
    <?php if(cv('groups.batchsend')) { ?>
    <li <?php  if($_W['action']=='batchsend') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('groups/batchsend')?>">批量发货</a>
    </li>
    <?php  } ?>
</ul>
<script>
    $(function () {
        $.ajax({type: "GET",async: false,url: "<?php  echo webUrl('groups/order/ajaxgettotals')?>",dataType:"json",success: function(data){
            var res = data.result;
            $("span.status1").text(res.status1);
            $("span.status2").text(res.status2);
            $("span.status3").text(res.status3);
            $("span.status4").text(res.status4);
            $("span.status5").text(res.status5);
            $("span.all").text(res.all);
            /*拼团管理*/
            $("span.team1").text(res.team1);
            $("span.team2").text(res.team2);
            $("span.team3").text(res.team3);
            $("span.allteam").text(res.allteam);
            /*维权申请*/
            $("span.refund1").text(res.refund1);
            $("span.refund2").text(res.refund2);
            /*核销查询*/
            $("span.verify1").text(res.verify1);
            $("span.verify2").text(res.verify2);
            $("span.verify3").text(res.verify3);
        }
        });
    });
</script>