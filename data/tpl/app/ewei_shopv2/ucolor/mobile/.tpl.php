<?php defined('IN_IA') or exit('Access Denied');?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div style="margin:0 auto;padding:0 auto;width:100%">


    <div class="user_bar">
		<a class="top_nav fl" href="<?php  echo mobileUrl('member/notice')?>"><i class="iconfont icon-mark"></i></a>
		<a class="top_nav fr" href="<?php  echo mobileUrl('member/info')?>"><i class="iconfont icon-shezhi"></i></a>
	</div>
	
	<div class="user clear_in"   style="height:140px; background:#FE5455">
		<div class="user_face fl"><img src="<?php  echo $member['avatar'];?>" /></div>
		<div class="user_info fl">
			<div class="clear_in"><div class="user_name"><?php  echo $member['nickname'];?></div><span class="user_level"   style="color:#fff;width:90px;"><?php  if(empty($level['id'])) { ?>
				    [<?php  if(empty($_W['shopset']['shop']['levelname'])) { ?>普通会员<?php  } else { ?><?php  echo $_W['shopset']['shop']['levelname'];?><?php  } ?>]
				    <?php  } else { ?>
				    [<?php  echo $level['levelname'];?>]
				    <?php  } ?></span></div>
			<div class="user_infos">账户余额：<?php  echo number_format($member['credit2'],2)?>元</div>
		</div>
		<div class="more fr"><a href="<?php  echo mobileUrl('member/info')?>"><i class="icon-right iconfont" style="color:#ffcabb; font-size:40px; top:15px;"></i></a></div>
	</div>
	
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('order')?>"><i class="icon-vip iconfont i22"></i>我的订单<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<div class="order_list clear_in">
		<ul  style="height:80px;">
			<li>
				<a href="<?php  echo mobileUrl('order',array('status'=>0))?>">
				<i class="icon icon-card"  style="font-size:25px;"><?php  if($statics['order_0']>0) { ?><span><?php  echo $statics['order_0'];?></span><?php  } ?></i><p class="">待付款</p></a>
			</li>
			<li>
				<a href="<?php  echo mobileUrl('order',array('status'=>1))?>">
				<i class="icon icon-box" style="font-size:25px;"  ><?php  if($statics['order_1']>0) { ?><span><?php  echo $statics['order_0'];?></span><?php  } ?></i><p class="">待发货</p></a>
			</li>
			<li>
				<a href="<?php  echo mobileUrl('order',array('status'=>2))?>">
				<i class="icon icon-deliver"  style="font-size:25px;" ><?php  if($statics['order_2']>0) { ?><span><?php  echo $statics['order_0'];?></span><?php  } ?></i><p class="">待收货</p></a>
			</li>
			<li>
				<a href="<?php  echo mobileUrl('order',array('status'=>4))?>">
				<i class="icon icon-refund"  style="font-size:25px;"  ><?php  if($statics['order_4']>0) { ?><span><?php  echo $statics['order_0'];?></span><?php  } ?></i><p class="">退款/售后</p></a>
			</li>
		</ul>
	</div>
	
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('member/log')?>"><i class="icon-licaishouyi iconfont i22"></i>我的钱包<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<div class="money_list clear_in">
		<ul>

		
			<li  style="width:25%">
				<a href="javascript:;">
					<i class="icon-yiban iconfont"></i><span class="txt">余额</span><span class="num"><?php  echo number_format($member['credit2'],2)?></span>
				</a>
				
			</li>

			<li class="money_cz"  style="width:15%" >
				<a href="<?php  echo mobileUrl('member/recharge')?>" id="btnwithdraw">充值</a>

				
			</li>
			
		<?php  if($_W['shopset']['trade']['withdraw']==1) { ?>	<li class="money_cz"  style="width:15%;" >
				<a href="<?php  echo mobileUrl('member/withdraw')?>" id="btnwithdraw">提现</a>

				
			</li><?php  } ?>

			<li  >
				<a href="javascript:;">
					<i class="icon-brand iconfont"></i><span class="txt">积分</span><span class="num"><?php  echo number_format($member['credit1'],2)?></span>
				</a>
			</li>

		</ul>
	</div>
	<?php  if($hascoupon) { ?>
	<?php  if($hascouponcenter) { ?>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('sale/coupon')?>"><i class="icon-fuwuchuanga iconfont i22"></i>领取优惠券<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>
	<div class="user_warp" style="border-bottom:1px solid #e4e4e4;">
		<div class="user_tit" style="border:none;"><a href="<?php  echo mobileUrl('sale/coupon/my')?>"><i class="icon-scan iconfont i22"></i>我的优惠券<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>
	
	<div class="user_warp">
		<div class="user_tit" style="margin-top:12px;"><a href="<?php  echo mobileUrl('member/favorite');?>"><i class="icon-collect iconfont i22"></i>我的喜欢<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('member/address');?>"><i class="icon-footprint iconfont i22"></i>收货地址<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('member/cart');?>"><i class="iconfont icon-vipcard i22"></i>我的购物车<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('member/history');?>"><i class="iconfont icon-footprint i22"></i>浏览足迹<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('member/notice');?>"><i class="iconfont icon-notice i22"></i>消息提醒设置<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  if(!empty( $_W['shopset']['rank']['status'] ) || !empty( $_W['shopset']['rank']['order_status'] ) ) { ?>
	
	<?php  if(!empty( $_W['shopset']['rank']['status'] ) ) { ?>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('member/rank');?>"><i class="iconfont icon-present i22"></i><?php  echo $_W['shopset']['trade']['credittext'];?>排行<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>
	
	
	<?php  if(!empty( $_W['shopset']['rank']['order_status'] ) ) { ?>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('member/rank/order_rank');?>"><i class="iconfont icon-similar i22"></i>消费排行<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>
	
	<?php  } ?>
	
	
	<?php  if($hasauthor) { ?>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('author')?>"><i class="iconfont icon-footprint i22"></i><?php  echo $plugin_author_set['texts']['center'];?><div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>
	
	
	
	
	
	<?php  if($hassign) { ?>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('sign')?>"><i class="iconfont icon-footprint i22"></i><?php  echo $hassign;?><div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>

	<?php  if($hasglobonus) { ?>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('globonus')?>"><i class="iconfont icon-licaishouyi i22"></i><?php  echo $plugin_globonus_set['texts']['center'];?><div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>

	<?php  if($hasabonus) { ?>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('abonus')?>"><i class="iconfont icon-vip i22"></i><?php  echo $plugin_abonus_set['texts']['center'];?><div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>
	<?php  if($hasqa) { ?>
	<div class="user_warp">
		<div class="user_tit"><a href="<?php  echo mobileUrl('qa')?>"><i class="iconfont icon-footprint i22"></i>帮助中心<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>
	
	
	<?php  if(!is_weixin() && !empty($wapset['open'])) { ?>
	<div class="user_warp">
		<div class="user_tit1"><a href="<?php  if(!empty($member['mobileverify'])) { ?><?php  echo mobileUrl('member/changepwd')?><?php  } else { ?><?php  echo mobileUrl('member/bind')?><?php  } ?>"><i class="iconfont icon-footprint i22"></i>修改密码<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<div class="user_warp">
		<div class="user_tit1 btn-logout"><a href="#"><i class="iconfont icon-footprint i22"></i>退出登录<div class="fr"><i class="icon-right iconfont"></i></div></a></div>
	</div>
	<?php  } ?>
	
</div>
<div  style="height:50px;">	</div>
<script language='javascript'>
		require(['biz/member/index'], function (modal) {
			modal.init();
		});
	</script>	

<?php  $this->footerMenus()?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

