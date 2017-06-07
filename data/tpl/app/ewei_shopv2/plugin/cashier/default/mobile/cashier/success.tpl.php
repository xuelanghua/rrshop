<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "<?php  echo $item['title'];?>"; </script>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/template/mobile/default/static/css/coupon.css?v=2.0.0">
<style>
	.page-payok {
		/*background: #efeff4;*/
	}

	.page-payok .payok-title {
		font-size: 0.85rem;
		color: #21b101;
		padding: 0.7rem;
	}

	.page-payok .payok-title .ico {
		height: 1.2rem;
		width: 1.2rem;
		background: #21b101;
		display: inline-block;
		border-radius: 1.2rem;
		vertical-align: bottom;
		text-align: center;
	}

	.page-payok .payok-title .ico .icon {
		height: 1.2rem;
		line-height: 1.2rem;
		color: #fff;
	}

	.page-payok .payok-main {
		height: auto;
		background: #fff;
		overflow: hidden;
        margin-top: 0.5rem;
	}

	.page-payok .payok-main .top {
		height: auto;
		padding: 1.4rem 0;
		overflow: hidden;
		text-align: center;
	}

	.page-payok .payok-main .top .title {
		height: 1rem;
		line-height: 1rem;
		font-size: 0.8rem;
	}

	.page-payok .payok-main .top .price {
		height: 1.6rem;
		line-height: 1.6rem;
		font-size: 1.6rem;
	}

	.page-payok .payok-main .bottom {
		height: auto;
		overflow: hidden;
        padding: 0.85rem 0;
        border-top: 1px solid #f4f4f4;
	}

    .page-payok .payok-main .bottom .line {
        height: auto;
        overflow: hidden;
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        padding: 0.1rem 1rem;
        color: #888;
    }

    .page-payok .payok-main .bottom .line .title {
        width: 6rem;
        text-align: left;
    }
    .page-payok .payok-main .bottom .line .text {
        width: 100%;
        text-align: right;
        -webkit-box-flex: 1;
        -ms-flex: 1;
    }
    .fui-page, .fui-page-current{
        background: #fff;
    }
    .coupon-picker{
        background: #fff;
    }
    .fui-list.coupon-list.coupon-item2{
        border: 1px solid #e4e4e4;
    }
</style>


<div class='fui-page  fui-page-current shop-index-page'>


	<div class="fui-content page-payok">
		<div class="payok-main">
            <div class="top">
                <div class="title"><div class="payok-title">
			<span class="ico">
                <i class="icon icon-check"></i>
			</span>
                    <span>支付成功</span>
                </div></div>
            </div>

			<div class="top">
                <div class="title"><?php  echo $item['title'];?></div>
				<div class="price">&yen;<?php  echo $item['money'];?></div>
			</div>
			<div class="bottom">
                <div class="line">
                    <div class="title">商　　品</div>
                    <div class="text"><?php  echo $item['goodstitle'];?></div>
                </div>
                <div class="line">
                    <div class="title">交易时间</div>
                    <div class="text"><?php  echo $item['time'];?></div>
                </div>
                <div class="line">
                    <div class="title">支付方式</div>
                    <div class="text"><?php  echo $item['paytype'];?></div>
                </div>
                <div class="line">
                    <div class="title">交易单号</div>
                    <div class="text"><?php  echo $item['out_trade_no'];?></div>
                </div>
                <?php  if(!empty($item['randommoney'])) { ?>
                <div class="line">
                    <div class="title">随机立减</div>
                    <div class="text">-&yen;<?php  echo $item['randommoney'];?></div>
                </div>
                <?php  } ?>
                <?php  if(!empty($item['enough'])) { ?>
                <div class="line">
                    <div class="title">满额立减</div>
                    <div class="text">-&yen;<?php  echo $item['enough'];?></div>
                </div>
                <?php  } ?>
                <?php  if(!empty($item['deduction'])) { ?>
                <div class="line">
                    <div class="title"><?php  echo $_W['shopset']['trade']['moneytext'];?>抵扣</div>
                    <div class="text">-&yen;<?php  echo $item['deduction'];?></div>
                </div>
                <?php  } ?>
                <?php  if(!empty($item['discountmoney'])) { ?>
                <div class="line">
                    <div class="title">固定折扣</div>
                    <div class="text">-&yen;<?php  echo $item['discountmoney'];?></div>
                </div>
                <?php  } ?>
                <?php  if(!empty($item['couponpay'])) { ?>
                <div class="line">
                    <div class="title">优惠券减免</div>
                    <div class="text">-&yen;<?php  echo $item['couponpay'];?></div>
                </div>
                <?php  } ?>

                <?php  if(!empty($item['present_credit1'])) { ?>
                <div class="line">
                    <div class="title"><?php  echo $_W['shopset']['trade']['credittext'];?>赠送</div>
                    <div class="text">+<?php  echo $item['present_credit1'];?></div>
                </div>
                <?php  } ?>
            </div>

            <?php  if(!empty($coupon) && $_W['openid'] == $log['openid']) { ?>
            <div class="coupon-picker">
                <div class="coupon-container coupon-picker-container">
                    <div id='container' class="coupon-container coupon-index-list">
                        <div class="fui-list coupon-list coupon-item2 coupon-list-allow <?php  echo $coupon['color'];?>" style="background: #fff;-webkit-border-radius: 0.3rem;border-radius:0.3rem;">
                            <i class="coupon-top-i"></i><i class="coupon-bot-i"></i>
                            <div class="fui-list-inner coupon-index-list-left" style="height:auto;">
                                <div class="coupon-index-list-info fui-list" style="margin:0;">
                                    <div class="fui-list-media">
                                        <?php  if($coupon['thumb']!='') { ?>
                                        <img src='<?php  echo $coupon['thumb'];?>' />
                                        <?php  } ?>
                                    </div>
                                    <div class="fui-list-inner">
                                        <h3><?php  echo $coupon['couponname'];?></h3>
                                        <p class="coupon-full"><?php  echo $coupon['backstr'];?><?php  if($coupon['backpre']) { ?>￥<?php  } ?><span><?php  echo $coupon['backmoney'];?></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="fui-list-media coupon-index-list-right" style="height:100%;" onclick="location.href='<?php  echo mobileUrl('sale/coupon/my')?>'">
                                <i class="coupon-list-ling" style="vertical-align: middle;margin-top:1rem;">立即查看</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  } ?>
		</div>

        <!--<a class="btn btn-success block" href="<?php  echo mobileUrl()?>">继续收款</a>-->

	</div>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>