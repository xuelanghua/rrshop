<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .fui-list-media img{height:2.5rem;}
    .fui-list:first-child:before{display: block;}
    .yen{border:none;height:0.75rem;width:0.75rem;display: inline-block;background: #ff4753;color:#fff;font-size:0.4rem;line-height: 0.8rem;text-align: center;
        font-style: normal;border-radius: 0.75rem;-webkit-border-radius: 0.75rem;margin-right:0.15rem;}
</style>
<div class='fui-page order-detail-page'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back external" href="<?php  echo mobileUrl('order')?>"></a>
        </div>
        <div class="title">订单详情</div>
        <div class="fui-header-right" data-nomenu="">&nbsp;</div>
    </div>
    <?php  if(count($carrier_list)>0 && !$isverify && !$isvirtual) { ?>
    <div id="carrierTab" class="fui-tab fui-tab-danger">
        <a href="#tab1"  class="external active">快递配送</a>
        <a href="#tab2" class='external'>上门自提</a>
    </div>
    <?php  } ?>
    <div class='fui-content navbar'>

        <div class='fui-list-group result-list'>
            <div class='fui-list order-status'>

                <div class='fui-list-inner'>
                    <div class='title'>
                        <?php  if(empty($order['status'])) { ?>
                        <?php  if($order['paytype']==3) { ?>
                        货到付款，等待发货
                        <?php  } else { ?>
                        等待付款
                        <?php  } ?>
                        <?php  } else if($order['status']==1) { ?>
                        <?php  if($order['sendtype']>0) { ?>部分商品已发货<?php  } else { ?>买家已付款<?php  } ?>
                        <?php  if(!empty($order['ccard'])) { ?>
                        (充值中)
                        <?php  } ?>
                        <?php  } else if($order['status']==2) { ?>
                        卖家已发货
                        <?php  } else if($order['status']==3) { ?>
                        交易完成
                        <?php  if(!empty($order['ccard'])) { ?>
                        (充值完成)
                        <?php  } ?>
                        <?php  } else if($order['status']==-1) { ?>
                        交易关闭
                        <?php  } ?>

                        <?php  if($order['refundstate'] > 0) { ?>
                        (<?php  if($order['status'] ==1) { ?>申请退款<?php  } else { ?>申请售后<?php  } ?>中)
                        <?php  } ?>
                    </div>
                    <div class='text'>订单金额(含运费): &yen; <?php  echo $order['price'];?><span></div>
                </div>
                <div class='fui-list-media'>
                    <?php  if(empty($order['status'])) { ?>
                    <?php  if($order['paytype']==3) { ?>
                    <i class='icon icon-deliver'></i>
                    <?php  } else { ?>
                    <i class='icon icon-information'></i>
                    <?php  } ?>
                    <?php  } else if($order['status']==1) { ?>
                    <i class='icon icon-money'></i>
                    <?php  } else if($order['status']==2) { ?>
                    <i class='icon icon-deliver'></i>
                    <?php  } else if($order['status']==3) { ?>
                    <i class='icon icon-check'></i>
                    <?php  } else if($order['status']==-1) { ?>
                    <i class='icon icon-roundclose'></i>
                    <?php  } ?>

                </div>
            </div>
        </div>

        <?php  if(!empty($address)) { ?>
        <div class='fui-list-group' style='margin-top:5px;'>

            <?php  if($order['status'] > 1 && $order['sendtype']==0) { ?>
            <a href="<?php  echo mobileUrl('order/express',array('id'=>$order['id']))?>">
                <div class='fui-list'>
                    <div class='fui-list-media'><i class='icon icon-deliver'></i></div>
                    <div class='fui-list-inner'>
                        <?php  if(empty($express)) { ?>
                        <div class='text'><span>快递公司:<?php  echo $order['expresscom'];?></span></div>
                        <div class='text'><span>快递单号:<?php  echo $order['expresssn'];?></span></div>
                        <?php  } else { ?>
                        <div class='text'><span <?php  if($express && strexists($express['step'],'已签收')) { ?>class='text-danger'<?php  } ?>><?php  echo $express['step'];?></span></div>
                        <div class='text'><span <?php  if($express && strexists($express['step'],'已签收')) { ?>class='text-danger'<?php  } ?>><?php  echo $express['time'];?></span></div>
                        <?php  } ?>
                    </div>
                    <div class='fui-list-angle'><span class='angle'></span></div>
                </div>
            </a>
            <?php  } ?>
            <?php  if($order['status'] > 0 && $order['sendtype']>0 && $order_goods) { ?>
            <?php  if(is_array($order_goods)) { foreach($order_goods as $index => $sg) { ?>
            <a href="<?php  echo mobileUrl('order/express',array('id'=>$sg['orderid'],'sendtype'=>$sg['sendtype'],'bundle'=>chr($index+65)))?>">
                <div class='fui-list'>
                    <div class='fui-list-media' style="font-size:0.6rem;display: block;text-align: center;">
                        <i class='icon icon-deliver' style="font-size:20px;"></i>
                        <div>包裹<?php  echo chr($index+65)?></div>
                    </div>
                    <div class='fui-list-inner'>
                        <?php  if(empty($express)) { ?>
                        <div class='text'><span>快递公司:<?php  if($sg['expresscom']) { ?><?php  echo $sg['expresscom'];?><?php  } else { ?>其他快递<?php  } ?></span></div>
                        <div class='text'><span>快递单号:<?php  echo $sg['expresssn'];?></span></div>
                        <?php  } else { ?>
                        <div class='text'><span <?php  if($express && strexists($express['step'],'已签收')) { ?>class='text-danger'<?php  } ?>><?php  echo $express['step'];?></span></div>
                        <div class='text'><span <?php  if($express && strexists($express['step'],'已签收')) { ?>class='text-danger'<?php  } ?>><?php  echo $express['time'];?></span></div>
                        <?php  } ?>
                    </div>
                    <div class='fui-list-angle'><span class='angle'></span></div>
                </div>
            </a>
            <?php  } } ?>
            <?php  } ?>


            <div class='fui-list'>
                <div class='fui-list-media'><i class='icon icon-location'></i></div>
                <div class='fui-list-inner'>
                    <div class='title'><?php  echo $address['realname'];?> <?php  echo $address['mobile'];?></div>
                    <div class='text'><?php  echo $address['province'];?><?php  echo $address['city'];?><?php  echo $address['area'];?><?php  if(!empty($new_area) && !empty($address_street)) { ?> <?php  echo $address['street'];?><?php  } ?> <?php  echo $address['address'];?></div>
                </div>
            </div>
        </div>
        <?php  } ?>
        <?php  if(!empty($carrier) ||!empty($store)) { ?>

        <div class='fui-list-group' style='margin-top:5px;'>

            <div class='fui-list'>
                <div class='fui-list-media'><i class='icon icon-person2'></i></div>
                <div class='fui-list-inner'>
                    <div class='title'><?php  echo $carrier['carrier_realname'];?> <?php  echo $carrier['carrier_mobile'];?></div>
                </div>
            </div>

            <?php  if(!empty($store)) { ?>


            <div  class="fui-list store-item" >
                <div class="fui-list-media">
                    <i class='icon icon-shop'></i>
                </div>
                <div class="fui-list-inner store-inner">
                    <div class="title"> <span class='storename'><?php  echo $store['storename'];?></span></div>
                    <div class="text">
                        <span class='realname'><?php  echo $store['realname'];?></span> <span class='mobile'><?php  echo $store['mobile'];?></span>
                    </div>
                    <div class="text">
                        <span class='address'><?php  echo $store['address'];?></span>
                    </div>
                </div>
                <div class="fui-list-angle ">
                    <?php  if(!empty($store['tel'])) { ?><a href="tel:<?php  echo $store['tel'];?>" class='external '><i class=' icon icon-phone' style='color:green'></i></a><?php  } ?>
                    <a href="<?php  echo mobileUrl('store/map',array('id'=>$store['id'],'merchid'=>$store['merchid']))?>" class='external' ><i class='icon icon-location' style='color:#f90'></i></a>
                </div>
            </div>

            <?php  } ?>
        </div>
        <?php  } ?>





        <div class="fui-list-group goods-list-group">

            <div class="fui-list-group-title"><i class="icon icon-shop"></i> <?php  echo $shopname;?></div>
            <?php  $i=0;?>
            <?php  if(is_array($goods)) { foreach($goods as $g) { ?>
            <a href="<?php  echo mobileUrl('goods/detail',array('id'=>$g['goodsid']))?>">

                <div class="fui-list goods-list">
                    <div class="fui-list-media" <?php  if($g['status']==2) { ?>style="padding-left:0.5rem;"<?php  } ?>>
                    <img src="<?php  echo tomedia($g['thumb'])?>" class="round">
                </div>
                <div class="fui-list-inner">
                    <div class="text goodstitle"><?php  if($g['seckill_task']) { ?><span class="fui-label fui-label-danger"><?php  echo $g['seckill_task']['tag'];?></span><?php  } ?><?php  echo $g['title'];?></div>
                    <?php  if($g['status']==2) { ?><span class="fui-label fui-label-danger">赠品</span><?php  } ?>
                    <?php  if(!empty($g['optionid'])) { ?><div class='subtitle'><?php  echo $g['optiontitle'];?></div><?php  } ?>

                </div>
                <div class='fui-list-angle'>
                    &yen; <span class='marketprice'><?php  echo $g['price'];?></span><br/>   x<?php  echo $g['total'];?>
                </div>

        </div>
        </a>
        <?php  if(!empty($g['fullbackgoods'])) { ?>
        <div class="fui-cell-group price-cell-group" style="margin:0;">
            <a href="<?php  echo mobileUrl('member/fullback')?>" class="external">
                <div class="fui-cell" id="fullbackgoods" style="padding:0.5rem 0.3rem;<?php  if($g['fullbackgoods']['minallfullbackallprice']<=0 && $g['fullbackgoods']['minallfullbackallratio']<=0) { ?>display: none;<?php  } ?>">
                    <div class="fui-cell-label" style='width:auto;font-size:0.75rem;color:#1a1a1a;'>全返详情</div>
                    <div class="fui-cell-info" style="text-align: right;">
                        <span class="fui-cell-remark noremark" style="font-size: 0.6rem;color:#333;">
                            <i class="yen">&yen;</i>
                            <?php  if($g['fullbackgoods']['type']>0) { ?>
                            全返 <span class="text-danger"><?php  echo price_format($g['fullbackgoods']['minallfullbackallratio'],2)?>%</span> ，<span class="text-danger"><?php  echo price_format($g['fullbackgoods']['fullbackratio'],2)?>%</span>/天，共 <span class="text-danger"><?php  echo $g['fullbackgoods']['day'];?></span> 天
                            <?php  } else { ?>
                            全返 &yen;<?php  echo price_format($g['fullbackgoods']['minallfullbackallprice'],2)?>，&yen;<?php  echo price_format($g['fullbackgoods']['fullbackprice'],2)?>/天，共 <?php  echo $g['fullbackgoods']['day'];?> 天
                            <?php  } ?>
                        </span>
                    </div>
                    <div class='fui-cell-remark'></div>
                </div>
            </a>
        </div>
        <?php  } ?>

        <?php  if(!empty($g['diyformdata']) && $g['diyformdata'] != 'false') { ?>
        <div class="fui-list">
            <div class="fui-list-inner">
                <div class="text text-right">
                    <div class="btn btn-default btn-sm look-diyinfo" hide="1" data="<?php  echo $i;?>">查看提交的资料</div>
                </div>
            </div>
        </div>

        <div class="fui-cell-group price-cell-group diyinfo_<?php  echo $i;?>" style="display: none;">
            <?php  $datas = $g['diyformdata']?>
            <?php  if(is_array($g['diyformfields'])) { foreach($g['diyformfields'] as $key => $value) { ?>

            <div class="fui-cell" >
                <div class="fui-cell-label"><?php  echo $value['tp_name']?></div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark"><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/mdiyform', TEMPLATE_INCLUDEPATH)) : (include template('diyform/mdiyform', TEMPLATE_INCLUDEPATH));?></div>
            </div>

            <?php  } } ?>
        </div>
        <?php  } ?>
        <?php  $i++;?>
        <?php  } } ?>
    </div>

    <?php  if(!empty($order['virtual']) && !empty($order['virtual_str'])) { ?>
    <div class='fui-according-group'>
        <div class='fui-according expanded'>
            <div class='fui-according-header'>
                <i class='icon icon-productfeatures'></i>
                <span class="text">发货信息</span>
                <span class="remark"></span>
            </div>
            <div class="fui-according-content">
                <div class='content-block'>
                    <?php  echo $order['virtual_str'];?>
                </div>
            </div>

        </div></div>
    <?php  } ?>

    <?php  if(!empty($order['isvirtualsend']) && !empty($order['virtualsend_info'])) { ?>
    <div class='fui-according-group'>
        <div class='fui-according expanded'>
            <div class='fui-according-header'>
                <i class='icon icon-productfeatures'></i>
                <span class="text">发货信息</span>
                <span class="remark"></span>
            </div>
            <div class="fui-according-content">
                <div class='content-block'>
                    <?php  echo $order['virtualsend_info'];?>
                </div>
            </div>

        </div></div>
    <?php  } ?>

    <?php  if($order['showverify']) { ?>

    <div class='fui-according-group <?php  if(count($verifyinfo)<=3) { ?>expanded<?php  } ?> verify-container' data-verifytype="<?php  echo $order['verifytype'];?>" data-orderid="<?php  echo $order['id'];?>">
        <div class='fui-according'>
            <div class='fui-according-header'>

                <i class='icon icon-list'></i>

                <span class="text"><?php  if($order['dispatchtype']) { ?>自提码<?php  } else { ?>消费码<?php  } ?></span>
                <span class="remark"><div class="badge"><?php  echo count($verifyinfo)?></div></span>
            </div>
            <div class="fui-according-content verifycode-container">
                <?php  if($order['status']>0 || $order['paytime'] > 0) { ?>
                <div class='fui-cell-group'>
                    <?php  if(is_array($verifyinfo)) { foreach($verifyinfo as $v) { ?>
                    <div class='fui-cell verify-cell' data-verifycode="<?php  echo $v['verifycode'];?>">
                        <div class='fui-cell-label' style='width:auto'>
                            <?php  echo $v['verifycode'];?>
                        </div>
                        <div class='fui-cell-info'></div>
                        <div class='fui-cell-remark noremark'>
                            <?php  if($v['verified']) { ?>
                            <div class='fui-label fui-label-danger' >已使用</div>
                            <?php  } else if($order['verifyendtime'] > 0 && $order['verifyendtime'] < time()) { ?>
                            <div class='fui-label fui-label-warning' >已过期</div>
                            <?php  } else { ?>
                            <?php  if($order['dispatchtype']) { ?>
                            <div class='fui-label fui-label-default' >未取货</div>
                            <?php  } else { ?>
                            <?php  if($order['verifytype']==1) { ?>
                            <div class='fui-label fui-label-default' >剩余<?php  echo $goods[0]['total']-count($vs)?> 次</div>
                            <?php  } else { ?>
                            <div class='fui-label fui-label-default' >未使用</div>
                            <?php  } ?>
                            <?php  } ?>
                            <?php  } ?>
                        </div>
                    </div>
                    <?php  } } ?>
                </div>
                <?php  } else { ?>
                <div class='fui-cell-group'>
                    <div class='fui-cell verify-cell'>
                        <div class='fui-cell-label' style='width:auto;color:#ff0011;'>
                            付款后可见!
                        </div>
                    </div>
                </div>
                <?php  } ?>


            </div>
        </div>
    </div>

    <?php  } ?>

    <?php  if(!empty($stores)) { ?>
    <script language='javascript' src='https://api.map.baidu.com/api?v=2.0&ak=ZQiFErjQB7inrGpx27M1GR5w3TxZ64k7&s=1'></script>
    <div class='fui-according-group'>
        <div class='fui-according'>
            <div class='fui-according-header'>
                <i class='icon icon-shop'></i>
                <span class="text">适用门店</span>
                <span class="remark"><div class="badge"><?php  echo count($stores)?></div></span>
            </div>
            <div class="fui-according-content store-container">
                <?php  if(is_array($stores)) { foreach($stores as $item) { ?>
                <div  class="fui-list store-item"

                      data-lng="<?php  echo floatval($item['lng'])?>"
                      data-lat="<?php  echo floatval($item['lat'])?>">
                    <div class="fui-list-media">
                        <i class='icon icon-shop'></i>
                    </div>
                    <div class="fui-list-inner store-inner">
                        <div class="title"> <span class='storename'><?php  echo $item['storename'];?></span></div>
                        <div class="text">
                            地址: <span class='realname'><?php  echo $item['address'];?></span>
                        </div>
                        <div class="text">
                            电话: <span class='address'><?php  echo $item['tel'];?></span>
                        </div>
                        <div class="text location" style="color:green;display:none">正在计算距离...</div>
                    </div>
                    <div class="fui-list-angle ">
                        <?php  if(!empty($item['tel'])) { ?><a href="tel:<?php  echo $item['tel'];?>" class='external '><i class=' icon icon-phone' style='color:green'></i></a><?php  } ?>
                        <a href="<?php  echo mobileUrl('store/map',array('id'=>$item['id'],'merchid'=>$item['merchid']))?>" class='external' ><i class='icon icon-location' style='color:#f90'></i></a>
                    </div>
                </div>
                <?php  } } ?>
            </div>

            <div id="nearStore" style="display:none">

                <div class='fui-list store-item'  id='nearStoreHtml'></div>
            </div>
        </div></div>
    <?php  } ?>




    <div class='fui-cell-group price-cell-group'>
        <div class="fui-cell">
            <div class="fui-cell-label">商品小计</div>
            <div class="fui-cell-info"><?php  if($order['ispackage']) { ?><span class="text-danger" style="font-size: 0.6rem;">(套餐总价)</span><?php  } ?></div>
            <div class="fui-cell-remark noremark">&yen; <?php  echo $order['goodsprice'];?></div>
        </div>
        <div class="fui-cell">
            <div class="fui-cell-label">运费</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">&yen; <?php  echo $order['dispatchprice'];?></div>
        </div>
        <?php  if(!empty($order['lotterydiscountprice']) && $order['lotterydiscountprice']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">抽奖优惠</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">- &yen; <?php  echo $order['lotterydiscountprice'];?></div>
        </div>
        <?php  } ?>

        <?php  if(!$order['ispackage']) { ?>
        <?php  if($order['deductenough']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">满额立减</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">-&yen; <?php  echo $order['deductenough'];?></div>
        </div>
        <?php  } ?>

        <?php  if($order['couponprice']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label"  style='width:auto;'>优惠券优惠</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">-&yen; <?php  echo $order['couponprice'];?></div>
        </div>
        <?php  } ?>

        <?php  if($order['buyagainprice']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">重复购买优惠</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">-&yen; <?php  echo $order['buyagainprice'];?></div>
        </div>
        <?php  } ?>

        <?php  if($order['discountprice']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">会员优惠</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">-&yen; <?php  echo $order['discountprice'];?></div>
        </div>
        <?php  } ?>

        <?php  if($order['isdiscountprice']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">促销优惠</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">-&yen; <?php  echo $order['isdiscountprice'];?></div>
        </div>
        <?php  } ?>
        <?php  if($order['deductprice']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label"><?php  echo $_W['shopset']['trade']['credittext'];?>抵扣</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">-&yen; <?php  echo $order['deductprice'];?></div>
        </div>
        <?php  } ?>
        <?php  if($order['deductcredit2']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label"><?php  echo $_W['shopset']['trade']['moneytext'];?>抵扣</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">-&yen; <?php  echo $order['deductcredit2'];?></div>
        </div>
        <?php  } ?>

        <?php  if($order['seckilldiscountprice']>0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">秒杀优惠</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark">-&yen; <?php  echo $order['seckilldiscountprice'];?></div>
        </div>
        <?php  } ?>
        <?php  } ?>
        <div class="fui-cell">
            <div class="fui-cell-label" style='width:auto;'>实付费(含运费)</div>
            <div class="fui-cell-info"></div>
            <div class="fui-cell-remark noremark"><span class='text-danger'>&yen; <span style='font-size:.8rem'><?php  echo $order['price'];?></span></span></div>
        </div>
    </div>

    <div class="fui-cell-group info-cell-group"  style='table-layout:fixed;'>
        <?php  if(!empty($order['ccard'])) { ?>
        <?php  if(is_array($goods)) { foreach($goods as $g) { ?>
        <?php  if(!empty($g['ccardexplain'])) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">充值说明:</div>
            <div class="fui-cell-text"><?php  echo $g['ccardexplain'];?></div>
        </div>
        <?php  } ?>

        <?php  if(!empty($g['ccardtimeexplain'])) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">到账时间说明:</div>
            <div class="fui-cell-text"><?php  echo $g['ccardtimeexplain'];?></div>
        </div>
        <?php  } ?>
        <?php  } } ?>
        <?php  } ?>

        <div class="fui-cell">
            <div class="fui-cell-label">订单编号:</div>
            <div class="fui-cell-info"><?php  echo $order['ordersn'];?></div>
        </div>
        <div class="fui-cell">
            <div class="fui-cell-label">创建时间:</div>
            <div class="fui-cell-info"><?php  echo date('Y-m-d H:i:s', $order['createtime'])?></div>
        </div>
        <?php  if($order['status']>=1 && $order['paytime'] > 0) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">支付时间: </div>
            <div class="fui-cell-info"><?php  echo date('Y-m-d H:i:s', $order['paytime'])?></div>
        </div>
        <?php  } ?>
        <?php  if($order['status']>=2 || ($order['status']>=1 && $order['sendtype']>0)) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">发货时间: </div>
            <div class="fui-cell-info"><?php  echo date('Y-m-d H:i:s', $order['sendtime'])?></div>
        </div>
        <?php  } ?>
        <?php  if($order['status']==3) { ?>
        <div class="fui-cell">
            <div class="fui-cell-label">完成时间: </div>
            <div class="fui-cell-info"><?php  echo date('Y-m-d H:i:s', $order['createtime'])?></div>
        </div>
        <?php  } ?>
    </div>

    <?php  if(!empty($order_fields) && !empty($order_data)) { ?>
    <div class="fui-list-group goods-list-group">
        <div class='fui-cell-group price-cell-group'>
            <?php  $datas = $order_data?>
            <?php  if(is_array($order_fields)) { foreach($order_fields as $key => $value) { ?>
            <div class="fui-cell">
                <div class="fui-cell-label"><?php  echo $value['tp_name']?></div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark"><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/mdiyform', TEMPLATE_INCLUDEPATH)) : (include template('diyform/mdiyform', TEMPLATE_INCLUDEPATH));?></div>
            </div>
            <?php  } } ?>
        </div>
    </div>
    <?php  } ?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_copyright', TEMPLATE_INCLUDEPATH)) : (include template('_copyright', TEMPLATE_INCLUDEPATH));?>
</div>

<?php  if($order['canverify']) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('order/verify', TEMPLATE_INCLUDEPATH)) : (include template('order/verify', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>

<div class='fui-footer'>
    <?php  if($order['userdeleted']==0) { ?>
        <?php  if($order['status']==0) { ?>
            <div class="btn btn-default btn-default-o order-cancel">取消订单
                <select data-orderid="<?php  echo $order['id'];?>">

                    <option value="">不取消了</option>
                    <option value="我不想买了">我不想买了</option>
                    <option value="信息填写错误，重新拍">信息填写错误，重新拍</option>
                    <option value="同城见面交易">同城见面交易</option>
                    <option value="其他原因">其他原因</option>
                </select>
            </div>
            <?php  if(is_mobile()) { ?>
                <?php  if($order['paytype']!=3) { ?>
                    <?php  if($order['paytype']!=3 && empty($ispeerpay)) { ?>
                        <a class="btn btn-danger" href="<?php  echo mobileUrl('order/pay',array('id'=>$order['id']))?>">支付订单</a>
                    <?php  } else { ?>
                        <a class="btn btn-danger" href="<?php  echo mobileUrl('order/pay/peerpayshare',array('id'=>$order['id']))?>">代付订单</a>
                    <?php  } ?>
                <?php  } ?>
            <?php  } ?>
        <?php  } ?>
        <?php  if($order['canverify']&&$order['status']!=-1&&$order['status']!=0) { ?>
        <div class="btn btn-default btn-default-o pull-left order-verify" data-orderid="<?php  echo $order['id'];?>" data-verifytype="<?php  echo $order['verifytype'];?>" style="margin-left:.5rem;" >
            <i class="icon icon-qrcode"></i>
            <span><?php  if($order['dispatchtype']) { ?>我要取货<?php  } else { ?>我要使用<?php  } ?></span>
        </div>
        <?php  } ?>

        <?php  if($order['status']==3 || $order['status']==-1) { ?>
        <div class="btn btn-default btn-default-o order-delete" data-orderid="<?php  echo $order['id'];?>">删除订单</div>
        <?php  } ?>


        <?php  if($order['status']==3 && $order['iscomment']==1) { ?>
        <a class="btn btn-default btn-default-o" href="<?php  echo mobileUrl('order/comment',array('id'=>$order['id']))?>">追加评价</a>
        <?php  } ?>
        <?php  if($order['status']==3 && $order['iscomment']==0 && empty($_W['shopset']['trade']['closecomment'])) { ?>
        <a class="btn btn-default btn-default-o" href="<?php  echo mobileUrl('order/comment',array('id'=>$order['id']))?>">评价</a>
        <?php  } ?>
        <?php  if($order['status']==2) { ?>
        <div class="btn btn-default btn-default-o order-finish" data-orderid="<?php  echo $order['id'];?>">确认收货</div>
        <?php  } ?>

        <?php  if($order['canrefund']) { ?>
        <a data-nocache="true" class="btn btn-default" href="<?php  echo mobileUrl('order/refund',array('id'=>$order['id']))?>"><?php  if(!empty($order['refundstate'])) { ?>查看<?php  } ?><?php  if($order['status'] ==1) { ?>申请退款<?php  } else { ?>申请售后<?php  } ?><?php  if(!empty($order['refundstate'])) { ?>进度<?php  } ?></a>
        <?php  } ?>

        <?php  if($order['refundstate'] > 0 && $refund['status']!=5) { ?>
        <a class='btn btn-default-o btn-cancel'>取消申请</a>
        <?php  } ?>
    <?php  } else if($order['userdeleted']==1) { ?>
    <div class="btn btn-default btn-default-o order-deleted" data-orderid="<?php  echo $order['id'];?>">彻底删除订单</div>

    <div class="btn btn-default btn-default-o order-recover" data-orderid="<?php  echo $order['id'];?>">恢复订单</div>
    <?php  } ?>
</div>
<script language='javascript'>
    require(['biz/order/detail'], function (modal) {
        FoxUI.according.init();
        modal.init({orderid: "<?php  echo $orderid;?>",fromDetail:true});
    });

</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>