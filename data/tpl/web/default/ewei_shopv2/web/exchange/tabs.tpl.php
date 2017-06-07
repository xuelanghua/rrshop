<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
    .order-list a {
        position: relative;
    }
    .order-list span  {

        float:right;margin-right:20px;
    }
</style>

<ul class="menu-head-top">
    <li <?php  if($_W['action']=='history.statistics') { ?> class="active" <?php  } ?>><a href="<?php  echo webUrl('exchange');?>">兑换中心 <i class="fa fa-caret-right"></i></a></li>
</ul>
<div class='menu-header'>兑换分类</div>
<ul>
    <?php if(cv('exchange.goods')) { ?><li <?php  if(substr($_W['action'],0,5)=='goods') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exchange.goods');?>">商品兑换</a></li><?php  } ?>
    <?php if(cv('exchange.balance')) { ?><li <?php  if(substr($_W['action'],0,7)=='balance') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exchange.balance');?>">余额兑换</a></li><?php  } ?>
    <?php if(cv('exchange.redpacket')) { ?><li <?php  if(substr($_W['action'],0,9)=='redpacket') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exchange.redpacket');?>">红包兑换</a></li><?php  } ?>
    <?php if(cv('exchange.score')) { ?><li <?php  if(substr($_W['action'],0,5)=='score') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exchange.score');?>">积分兑换</a></li><?php  } ?>
    <?php if(cv('exchange.coupon')) { ?><li <?php  if(substr($_W['action'],0,6)=='coupon') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exchange.coupon');?>">优惠券兑换</a></li><?php  } ?>
    <?php if(cv('exchange.group')) { ?><li <?php  if(substr($_W['action'],0,5)=='group') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exchange.group');?>">组合兑换</a></li><?php  } ?>
</ul>
<div class='menu-header lynn_order'>商品订单</div>
<ul class="order-list">
    <?php if(cv('exchange.record.daifahuo')) { ?>
    <li <?php  if($_W['action']=='record.daifahuo') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('exchange/record/daifahuo');?>">待发货<span class='text-danger status1'>--</span></a>
    </li>
    <?php  } ?>
    <?php if(cv('exchange.record.daishouhuo')) { ?>
    <li <?php  if($_W['action']=='record.daishouhuo') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('exchange/record/daishouhuo');?>">待收货<span class='text-warning status2'>--</span></a>
    </li>
    <?php  } ?>
    <?php if(cv('exchange.record.daifukuan')) { ?>
    <li <?php  if($_W['action']=='record.daifukuan') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('exchange/record/daifukuan');?>">待付款<span class=" status3">--</span></a>
    </li>
    <?php  } ?>
    <?php if(cv('exchange.record.yiguanbi')) { ?>
    <li <?php  if($_W['action']=='record.yiguanbi') { ?>class="active"<?php  } ?>>
    <a href="<?php  echo webUrl('exchange/record/yiguanbi');?>">已关闭<span class="status5">--</span></a>
    </li>
    <?php  } ?>
    <?php if(cv('exchange.record.yiwancheng')) { ?>
    <li <?php  if($_W['action']=='record.yiwancheng') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('exchange/record/yiwancheng');?>">已完成<span class='text-primary status4'>--</span></a>
    </li>
    <?php  } ?>
    <?php if(cv('exchange.record.main')) { ?>
    <li <?php  if($_W['action']=='record') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo webUrl('exchange/record');?>">全部订单<span class="all">--</span></a>
    </li>
    <?php  } ?>
</ul>
<div class='menu-header'>其他</div>
<ul>
    <?php if(cv('exchange.history')) { ?><li <?php  if($_W['action']=='history') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exchange.history');?>">兑换记录</a></li><?php  } ?>
    <?php if(cv('exchange.setting.download')) { ?><li <?php  if($_W['action']=='setting.download') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('exchange.setting.download');?>">文件管理</a></li><?php  } ?>
</ul>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({url: "<?php  echo webUrl('exchange/record/ajaxorder');?>",
            success: function(msg){
            var str = '';
            for (var i = 2;i < msg.length-2;i++){
                str += msg[i];
            }
            var arr = str.split('","');
                $(".status1").text(arr[0]);//daifahuo
                $(".status2").text(arr[2]);//daishouhuo
                $(".status3").text(arr[1]);//weifukuan
                $(".status5").text(arr[4]);//yiguanbi
                $(".status4").text(arr[3]);//yiwancheng
                $(".all").text(arr[5]);//all
            }
        });
    });
</script>
