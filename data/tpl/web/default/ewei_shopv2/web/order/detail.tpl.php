<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
    .ordertable { width:100%;position: relative;margin-bottom:10px}
    .ordertable tr td:first-child { text-align: right }
    .ordertable tr td {padding:10px 5px 0;vertical-align: top}
    .ordertable1 tr td { text-align: right; }
    .ops .btn { padding:5px 10px;}
</style>
<div class="page-heading"> <h2>订单详情</h2> </div>
<?php  if($item['status']!=-1) { ?>
<div class="step-region" >
    <ul class="ui-step ui-step-4" >
        <li <?php  if(0<=$item['status']) { ?>class="ui-step-done"<?php  } ?>>
        <div class="ui-step-title" >买家下单</div>
        <div class="ui-step-number" >1</div>
        <div class="ui-step-meta" ><?php  if(0<=$item['status']) { ?><?php  echo date('Y-m-d',$item['createtime'])?><br/><?php  echo date('H:i:s',$item['createtime'])?><?php  } ?></div>
        </li <?php  if(1<=$item['status']) { ?>class="ui-step-done"<?php  } ?>>
        <li <?php  if(!empty($item['paytime'])) { ?>class="ui-step-done"<?php  } ?>>
        <div class="ui-step-title">买家付款</div>
        <div class="ui-step-number">2</div>
        <div class="ui-step-meta"><?php  if(1<=$item['status']) { ?><?php  echo date('Y-m-d',$item['paytime'])?><br/><?php  echo date('H:i:s',$item['paytime'])?><?php  } ?></div>
        </li>
        <li <?php  if(2<=$item['status'] || ($item['status']==1 && $item['sendtype'] > 0)) { ?>class="ui-step-done"<?php  } ?>>
        <div class="ui-step-title"><?php  if($item['isverify'] == 1) { ?>
            确认使用
            <?php  } else if(!empty($item['addressid'])) { ?>
            商家发货
            <?php  } else if(!empty($item['isvirtualsend']) || !empty($item['virtual'])) { ?>
            自动发货
            <?php  } else { ?>
            确认取货
            <?php  } ?></div>
        <div class="ui-step-number" >3</div>
        <div class="ui-step-meta" ><?php  if(2<=$item['status'] || ($item['status']==1 && $item['sendtype'] > 0)) { ?><?php  echo date('Y-m-d',$item['sendtime'])?><br/><?php  echo date('H:i:s',$item['sendtime'])?><?php  } ?></div>
        </li>
        <li <?php  if(3<=$item['status']) { ?>class="ui-step-done"<?php  } ?>>
        <div class="ui-step-title">订单完成</div>
        <div class="ui-step-number" >4</div>
        <div class="ui-step-meta"><?php  if(3<=$item['status']) { ?><?php  echo date('Y-m-d',$item['finishtime'])?><br/><?php  echo date('H:i:s',$item['finishtime'])?><?php  } ?></div>
        </li>
    </ul>
</div>
<?php  } ?>
<form class="form-horizontal form" action="" method="post">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />

    <input type="hidden" name="dispatchid" value="<?php  echo $dispatch['id'];?>" />

    <div  class='row order-container'>
        <div class="order-container-left">
            <div class='panel-body' >
                <h4 class="m-t-none m-b">订单信息</h4>
                <div class="form-group" style='padding:0 10px;'>
                    <table class='ordertable' style='table-layout:fixed'>
                        <tr>
                            <td style='width:80px'>订单编号：</td>
                            <td><?php  echo $item['ordersn'];?></td>
                        </tr>
                        <tr>
                            <td>订单金额：</td>
                            <td>￥<?php  echo number_format($item['price'],2)?> &nbsp;&nbsp;<a data-toggle='popover' data-html='true' data-placement='right'
                                                                                           data-content="<table style='width:100%;'>
                <tr>
                    <td  style='border:none;text-align:right;'>商品小计：</td>
                    <td  style='border:none;text-align:right;'>￥<?php  echo number_format( $item['goodsprice'] ,2)?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>运费：</td>
                    <td  style='border:none;text-align:right;'>￥<?php  echo number_format( $item['olddispatchprice'],2)?></td>
                </tr>
                <?php  if(!$item['ispackage']) { ?>
                <?php  if($item['taskdiscountprice']>0 ) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>任务活动优惠：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['taskdiscountprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['lotterydiscountprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>游戏活动优惠：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['lotterydiscountprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['discountprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>会员折扣：</td>
                    <td  style='border:none;text-align:right;'>-￥<?php  echo number_format( $item['discountprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['deductprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>积分抵扣：</td>
                    <td  style='border:none;text-align:right;'>-￥<?php  echo number_format( $item['deductprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['deductcredit2']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>余额抵扣：</td>
                    <td  style='border:none;text-align:right;'>-￥<?php  echo number_format( $item['deductcredit2'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['deductenough']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>商城满额立减：</td>
                    <td  style='border:none;text-align:right;'>-￥<?php  echo number_format( $item['deductenough'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['merchdeductenough']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>商户满额立减：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['merchdeductenough'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['couponprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>优惠券优惠：</td>
                    <td  style='border:none;text-align:right;'>-￥<?php  echo number_format( $item['couponprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['isdiscountprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>促销优惠：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['isdiscountprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['buyagainprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>重复购买优惠：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['buyagainprice'],2)?></td>
                </tr>
                <?php  } ?>
                    <?php  if($item['seckilldiscountprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>秒杀优惠：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['seckilldiscountprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  } ?>
                <?php  if(intval($item['changeprice'])!=0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>卖家改价：</td>
                    <td  style='border:none;text-align:right;'><span style='<?php  if(0<$item['changeprice']) { ?>color:green<?php  } else { ?>color:red<?php  } ?>'><?php  if(0<$item['changeprice']) { ?>+<?php  } else { ?>-<?php  } ?>￥<?php  echo number_format(abs($item['changeprice']),2)?></span></td>
                </tr>
                <?php  } ?>
                <?php  if(intval($item['changedispatchprice'])!=0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>卖家改运费：</td>
                    <td  style='border:none;text-align:right;'><span style='<?php  if(0<$item['changedispatchprice']) { ?>color:green<?php  } else { ?>color:red<?php  } ?>'><?php  if(0<$item['changedispatchprice']) { ?>+<?php  } else { ?>-<?php  } ?>￥<?php  echo abs($item['changedispatchprice'])?></span></td>
                </tr>
                <?php  } ?>
                <tr>
                    <td style='border:none;text-align:right;'>应收款：</td>
                    <td  style='border:none;text-align:right;color:green;'>￥<?php  echo number_format($item['price'],2)?></td>
                </tr>

            </table>
"><i class='fa fa-question-circle'></i></a></td>
                        </tr>

                        <?php  if(!empty($coupon)) { ?>
                        <tr>
                            <td>优惠券：</td>
                            <td><?php  if($coupon['merchid'] == 0) { ?><a href="<?php  echo webUrl('sale/coupon/edit',array('id'=>$coupon['id']))?>" target='_blank'><?php  echo $coupon['couponname'];?></a><?php  } else { ?><?php  echo $coupon['couponname'];?><?php  } ?> &nbsp;&nbsp;<a data-toggle='popover' data-html='true' data-placement='right'
                                                                                                                                                                      data-content="<table style='width:100%;'>

                <tr>
                    <td style='border:none;text-align:right;'>优惠方式：</td>
                    <td style='border:none;text-align:right;'>
                    <?php  if($coupon['backtype']==0) { ?>
                        立减 <?php  echo $coupon['deduct'];?> 元
                    <?php  } else if($coupon['backtype']==1) { ?>
                        打 <?php  echo $coupon['discount'];?> 折
                    <?php  } else if($coupon['backtype']==2) { ?>
                        <?php  if($coupon['backmoney']>0) { ?>返 <?php  echo $coupon['backmoney'];?> 余额<?php  } ?>
                        <?php  if($coupon['backcredit']>0) { ?>返 <?php  echo $coupon['backcredit'];?> 积分<?php  } ?>
                        <?php  if($coupon['backredpack']>0) { ?>返 <?php  echo $coupon['backredpack'];?> 红包<?php  } ?>
                    <?php  } ?>
                    </td>
                </tr>


                <?php  if($coupon['backtype']==2) { ?>
                    <tr>
                        <td style='border:none;text-align:right;'>返利方式：</td>
                        <td style='border:none;text-align:right;'>
                        <?php  if($item['backwhen']==0) { ?>
                            交易完成后(过退款期限)
                        <?php  } else if($item['backwhen']==1) { ?>
                            订单完成后(收货后)
                        <?php  } else { ?>
                            订单付款后
                        <?php  } ?>
                        </td>
                    </tr>

                    <tr>
                        <td style='border:none;text-align:right;'>返利情况：</td>
                        <td style='border:none;text-align:right;'>
                        <?php  if(empty($coupon['back'])) { ?>
                            未返利
                        <?php  } else { ?>
                            已返利
                        <?php  } ?>
                        </td>
                    </tr>

                    <?php  if(!empty($coupon['back'])) { ?>
                    <tr>
                        <td style='border:none;text-align:right;'>返利时间：</td>
                        <td style='border:none;text-align:right;'><?php  echo date('Y-m-d H:i',$coupon['backtime'])?></td>
                    </tr>
                    <?php  } ?>
                <?php  } ?>


            </table>
"><i class='fa fa-question-circle'></i></a></td>
                        </tr>
                        <?php  } ?>


                        <tr>
                            <td style='width:80px'>付款方式：</td>
                            <td> <?php  if($item['paytype'] == 0) { ?>未支付<?php  } ?>
                                <?php  if($item['paytype'] == 1) { ?>余额支付<?php  } ?>
                                <?php  if($item['paytype'] == 11) { ?>后台付款<?php  } ?>
                                <?php  if($item['paytype'] == 21) { ?>微信支付<?php  } ?>
                                <?php  if($item['paytype'] == 22) { ?>支付宝支付<?php  } ?>
                                <?php  if($item['paytype'] == 23) { ?>银联支付<?php  } ?>
                                <?php  if($item['paytype'] == 3) { ?>货到付款<?php  } ?></td>
                        </tr>

                        <tr>
                            <td>买家：</td>
                            <td><a href="<?php  echo webUrl('member/list/detail',array('id'=>$member['id']))?>" target='_blank'><?php  echo $member['nickname'];?></a> &nbsp;&nbsp;<a data-toggle='popover' data-html='true' data-placement='right'
                                                                                                                                                                      data-content="<table style='width:100%;'>
                <tr>
                    <td  style='border:none;text-align:right;' colspan='2'><img src='<?php  echo $member['avatar'];?>' style='width:100px;height:100px;padding:1px;border:1px solid #ccc' /></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>ID：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $member['id'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>昵称：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $member['nickname'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>姓名：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $member['realname'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>手机号：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $member['mobile'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>微信号：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $member['weixin'];?></td>
                </tr>
                </table>
"><i class='fa fa-question-circle'></i></a></td>
                        </tr>
                        <?php  if(!empty($item['invoicename'])) { ?>
                        <tr>
                            <td style='width:80px'>发票抬头：</td>
                            <td><?php  echo $item['invoicename'];?></td>
                        </tr>
                        <?php  } ?>
                    </table>

                    <table class='ordertable' style='table-layout:fixed;border-top:1px dotted #ccc'>

                        <tr>
                            <td style='width:80px'>配送方式：</td>
                            <td>
                                <?php  if($item['isverify'] == 1) { ?>
                                    线下核销
                                <?php  } else if(!empty($item['addressid'])) { ?>
                                    快递<?php  if(!empty($dispatch['dispatchname'])) { ?>(<?php  echo $dispatch['dispatchname'];?>)<?php  } ?>
                                <?php  } else if(!empty($item['isvirtualsend']) || !empty($item['virtual'])) { ?>
                                    自动发货<?php  if(!empty($item['isvirtualsend'])) { ?>(虚拟物品)<?php  } else { ?>(虚拟卡密)<?php  } ?>
                                <?php  } else if($item['dispatchtype']) { ?>
                                    自提
                                <?php  } else { ?>
                                    其他
                                <?php  } ?>
                            </td>
                        </tr>

                        <?php  if($item['isverify']==1) { ?>
                            <tr>
                                <td style='width:80px'>核销方式：</td>
                                <td><?php  if($item['verifytype']==0) { ?>

                                    整单核销
                                    <?php  } else if($item['verifytype']==1) { ?>
                                    按次核销
                                    <?php  } else if($item['verifytype']==2) { ?>
                                    按消费码核销
                                    <?php  } ?>

                                </td>
                            </tr>

                            <?php  if($item['verifytype']==0) { ?>
                                <tr>
                                    <td style='width:80px'>消费码：</td>
                                    <td><?php  echo $item['verifycode'];?></td>
                                </tr>
                                <?php  if($item['verified']) { ?>
                                <tr>
                                    <td style='width:80px'>核销时间：</td>
                                    <td><?php  echo date('Y-m-d H:i:s', $item['verifytime'])?></td>
                                </tr>
                                <?php  if(!empty($saler)) { ?>
                                <tr>
                                    <td style='width:80px'>核销人：</td>
                                    <td><?php  echo $saler['nickname'];?>( <?php  echo $saler['salername'];?> )</td>
                                </tr>
                                <?php  } ?>
                                <?php  if(!empty($store)) { ?>
                                <tr>
                                    <td style='width:80px'>核销门店：</td>
                                    <td><?php  echo $store['storename'];?></td>
                                </tr>
                                <?php  } ?>
                            <?php  } ?>

                        <?php  } else if($item['verifytype']==1) { ?>
                        <tr>
                            <td style='width:80px'>消费记录：</td>
                            <td>
                                <a href='javascript:;' onclick='$("#verify-modal").modal()'><i class="fa fa-question-circle"></i> 查看</a>

                                <div id="verify-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                    <div class="modal-dialog" style='width:850px'>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>核销记录</h3>
                                            </div>
                                            <div class="modal-body" >
                                                <div style='max-height:500px;overflow:auto;min-width:800px;'>
                                                    <table style='width:100%;' class='table'>
                                                        <tr><td style='width:150px'>时间</td><td style='width:100px'>核销员</td><td>门店</td></tr>
                                                        <?php  if(is_array($verifyinfo)) { foreach($verifyinfo as $v) { ?>
                                                            <tr><td><?php  echo date('Y-m-d H:i',$v['verifytime'])?></td><td><?php  echo $v['salername'];?><br/><small><?php  echo $v['nickname'];?></small></td><td><?php  echo $v['storename'];?></td></tr>
                                                        <?php  } } ?>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">

                                                <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </td>
                        </tr>



                        <?php  } else if($item['verifytype']==2) { ?>
                        <tr>
                            <td style='width:80px'>消费码：</td>
                            <td><?php  echo $item['verifycode'];?></td>
                        </tr>
                        <?php  if(is_array($verifyinfo)) { foreach($verifyinfo as $v) { ?>
                        <?php  if($v['verified']) { ?>
                        <tr>
                            <td style='width:80px'><?php  echo $v['verifycode'];?></td>
                            <td>
                                <a data-toggle='popover' data-html='true' data-placement='right'
                                   data-content="<table style='width:100%;'>

                <tr>
                    <td  style='border:none;text-align:right;'>核销员：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $v['salername'];?>/<?php  echo $v['nickname'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>门店：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $v['storename'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>时间：</td>
                    <td  style='border:none;text-align:right;'><?php  echo date('Y-m-d H:i',$v['verifytime'])?></td>
                </tr>

                </table>" ><i class="fa fa-question-circle"></i> 使用信息</a>
                            </td>
                        </tr>
                        <?php  } ?>
                        <?php  } } ?>

                        <?php  } ?>

                        <?php  } ?>

                        <?php  if(!empty($item['addressid'])) { ?>
                        <tr>
                            <td style='width:80px'>收货人：</td>
                            <td style='word-break: break-all;white-space: normal'>
                                <?php  echo $user['address'];?>, <?php  echo $user['realname'];?>, <?php  echo $user['mobile'];?> <a class='js-clip' data-url="<?php  echo $user['address'];?>, <?php  echo $user['realname'];?>, <?php  echo $user['mobile'];?>">[复制]</a></td>
                        </tr>

                        <?php  } else if($item['isverify']==1 || !empty($item['virtual']) ||!empty($item['isvirtual'])) { ?>
                            <?php  if($item['status']>=2 && !empty($item['virtual']) ) { ?>
                                <tr>
                                    <td style='width:80px'>发货信息：</td>
                                    <td style='word-break: break-all;white-space: normal'><?php  echo str_replace("\n","<br/>", $item['virtual_str'])?></td>
                                </tr>
                            <?php  } ?>

                            <tr>
                                <td style='width:80px'>联系人：</td>
                                <td style='word-break: break-all;white-space: normal'><?php  echo $user['carrier_realname'];?>, <?php  echo $user['carrier_mobile'];?></td>
                            </tr>
                        <?php  } else { ?>
                            <tr>
                                <td style='width:80px'>自提码：</td>
                                <td><?php  echo $item['verifycode'];?></td>
                            </tr>
                            <tr>
                                <td style='width:80px'>自提人：</td>
                                <td style='word-break: break-all;white-space: normal'><?php  echo $user['carrier_realname'];?> <?php  echo $user['carrier_mobile'];?> </td>
                            </tr>
                            <tr>
                                <td style='width:80px'>自提点：</td>
                                <td style='word-break: break-all;white-space: normal'><?php  echo $user['address'];?>,  <?php  echo $user['realname'];?>, <?php  echo $user['mobile'];?></td>
                            </tr>
                        <?php  } ?>

                        <?php  if(!empty($item['remark'])) { ?>
                        <tr>
                            <td style='width:80px'>买家备注：</td>
                            <td style='word-break: break-all;white-space: normal'><?php  echo $item['remark'];?></td>
                        </tr>
                        <?php  } ?>

                        <?php  if(!empty($item['addressid'])) { ?>
                        <?php if(cv('order.op.changeaddress')) { ?>
                        <tr>
                            <td style='width:80px'></td>
                            <td style='word-break: break-all;white-space: normal'><?php  if($item['merchid'] == 0) { ?><a class="btn btn-primary btn-xs" data-toggle="ajaxModal" href="<?php  echo webUrl('order/op/changeaddress', array('id' => $item['id']))?>">编辑收货信息</a><?php  } ?></td>
                        </tr>
                        <?php  } ?>
                        <?php  } ?>

                    </table>

                    <?php  if(!empty($order_data)) { ?>
                    <table class='ordertable' style='table-layout:fixed;border-top:1px dotted #ccc'>
                        <tr>
                            <td style='width:120px'><h4>统一下单信息</h4></td>
                            <td></td>
                        </tr>
                        <?php  $datas = $order_data?>
                        <?php  $ii = 0;?>
                        <?php  if(is_array($order_fields)) { foreach($order_fields as $key => $value) { ?>

                        <tr <?php  if($ii>1) { ?>class="diymore2" style="display:none;"<?php  } ?>>
                            <td style='width:80px'><?php  echo $value['tp_name']?>：</td>
                            <td style="white-space: normal;">
                                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/diyform', TEMPLATE_INCLUDEPATH)) : (include template('diyform/diyform', TEMPLATE_INCLUDEPATH));?>

                            </td>
                        </tr>

                        <?php  if($ii==2) { ?>
                        <tr class="diymore22">
                            <td colspan="2"><a href="javascript:void(0);" style="padding-right: 100px;" id="showdiymore2">查看完整信息</a></td>
                        </tr>
                        <?php  } ?>

                        <?php  $ii++;?>
                        <?php  } } ?>
                    </table>
                    <?php  } ?>
                </div>
            </div>
        </div>

        <div class="order-container-right" >
            <div class='panel-body' >
                <div class='row'>
                    <div class='col-sm-3 control-label' style='padding-top:10px;'>订单状态: </div>
                    <div class="col-sm-9 col-xs-12">
                        <h3 class="form-control-static">
                            <?php  if($item['status'] == 0) { ?>
                            <?php  if($item['paytype']==3) { ?>
                            <span class="text-default">待发货</span>
                            <?php  } else { ?>
                            <span class="text-default">待付款</span>
                            <?php  } ?>
                            <?php  } ?>
                            <?php  if($item['status'] == 1) { ?>
                                <span class="text-danger">
                                <?php  if($item['isverify'] == 1) { ?>
                                    待使用
                                <?php  } else if(empty($item['addressid'])) { ?>
                                    待取货
                                <?php  } else { ?>
                                    <?php  if($item['sendtype'] > 0) { ?>部分发货<?php  } else { ?>待发货<?php  } ?>
                                <?php  } ?>
                                </span>
                            <?php  } ?>
                            <?php  if($item['status'] == 2) { ?><span class="text-warning">待收货</span><?php  } ?>
                            <?php  if($item['status'] == 3) { ?><span class="text-primary">交易完成</span><?php  } ?>
                            <?php  if($item['status'] == -1) { ?>
                            <span class="text-default">已关闭</span>
                            <?php  } ?>
                        </h3>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <div class="form-control-static">

                            <?php  if($item['status'] == 0) { ?>
                            <?php  if($item['paytype']==3) { ?>
                            此订单为货到付款订单，请商家尽快发货
                            <?php  } else { ?>
                            等待买家付款
                            <?php  } ?>
                            <?php  } ?>
                            <?php  if($item['status'] == 1 && $item['sendtype'] == 0) { ?>买家已经付款，请商家尽快发货<?php  } ?>
                            <?php  if($item['status'] == 2 || ($item['status']==1 && $item['sendtype'] > 0)) { ?>商家已发货，等待买家收货并交易完成<?php  } ?>
                            <?php  if($item['status'] == -1) { ?>
                            <?php  if(!empty($refund) && $refund['status']==1) { ?>
                            <span class="label label-default">已退款</span> <?php  if(!empty($refund['refundtime'])) { ?>退款时间: <?php  echo date('Y-m-d H:i:s',$refund['refundtime'])?><?php  } ?>
                            <?php  } ?>
                            <?php  } ?>
                        </div>
                        <?php  if(empty($order_goods)) { ?>
                        <?php  if(!empty($item['expresssn']) && $item['status']>=2 && !empty($item['addressid'])) { ?>
                        <div class="form-control-static">
                            快递公司: <?php  if(empty($item['expresscom'])) { ?>其他快递<?php  } else { ?><?php  echo $item['expresscom'];?><?php  } ?><br>
                            快递单号: <?php  echo $item['expresssn'];?> &nbsp;&nbsp;<a class='op' data-toggle="ajaxModal" href="<?php  echo webUrl('util/express', array('id' => $item['id'],'express'=>$item['express'],'expresssn'=>$item['expresssn']))?>">查看物流</a><br>
                            发货时间: <?php  echo date('Y-m-d H:i:s', $item['sendtime'])?>
                        </div>
                        <?php  } ?>
                        <?php  } else { ?>
                        <?php  if(is_array($order_goods)) { foreach($order_goods as $index => $og) { ?>
                        <label class="text-danger">
                            包裹<?php  echo chr($index+65)?>
                            <a data-toggle='popover' data-trigger="hover" data-html='true' data-placement='right'
                               data-content="<table style='width:100%;'>
               <?php  if(is_array($og['goods'])) { foreach($og['goods'] as $g) { ?>
                <tr>
                    <td  style='border:none;text-align:right;padding:0 5px 2px 0;'><img src='<?php  echo tomedia($g['thumb'])?>' width='25' height='25' alt=''></td>
                    <td  style='border:none;white-space: normal;'><?php  echo $g['title'];?></td>
                </tr>
                <?php  } } ?>
            </table>"><i class='fa fa-question-circle'></i></a>
                        </label>
                        <div class="form-control-static" style="padding-left:20px;">
                            快递公司: <?php  if(empty($og['expresscom'])) { ?>其他快递<?php  } else { ?><?php  echo $og['expresscom'];?><?php  } ?><br>
                            快递单号: <?php  echo $og['expresssn'];?> &nbsp;&nbsp;
                            <a class='op' data-toggle="ajaxModal" href="<?php  echo webUrl('util/express',array('id' => $og['orderid'],'express'=>$og['express'],'expresssn'=>$og['expresssn'],'sendtype'=>$og['sendtype']))?>">查看物流</a><br>
                            发货时间: <?php  echo date('Y-m-d H:i:s', $og['sendtime'])?>
                        </div>
                        <?php  } } ?>

                        <?php  } ?>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <p class="form-control-static ops">
                            <?php  if($item['merchid'] == 0 && $item['ismerch'] == 0) { ?>
                            <?php  $detial_flag = 1?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('order/ops', TEMPLATE_INCLUDEPATH)) : (include template('order/ops', TEMPLATE_INCLUDEPATH));?>
                            &nbsp;&nbsp;
                            <?php  if($item['status'] ==0 && $item['ispackage']==0) { ?>
                            <?php if(cv('order.op.changeprice')) { ?>
                            <a class='op'  data-toggle='ajaxModal' href="<?php  echo webUrl('order/op/changeprice',array('id'=>$item['id']))?>">订单改价</a>&nbsp;&nbsp;
                            <?php  } ?>
                            <?php  } ?>
                            <?php  if(!empty($item['agentid'])) { ?>
                            <?php if(cv('commission.changecommission')) { ?>
                            <a data-toggle="ajaxModal"  href="<?php  echo webUrl('commission/apply/changecommission', array('id' => $item['id']))?>">修改佣金</a>&nbsp;&nbsp;
                            <?php  } ?>
                            <?php  } ?>
                            <?php if(cv('order.op.remarksaler')) { ?>
                            <a  data-toggle="ajaxModal" href="<?php  echo webUrl('order/op/remarksaler', array('id' => $item['id']))?>" <?php  if(!empty($item['remarksaler'])) { ?>style='color:red'<?php  } ?> >备注</a>
                            <?php  } ?>
                            <?php  } ?>
                        </p>
                    </div>
                </div>


                <?php  if($item['status'] >0) { ?>
                <div class='order-tips' style="position: inherit;">
                    <div class='row order-tips-title'>友情提醒</div>

                    <?php  if($item['status'] == 0) { ?>
                    <?php  if($item['paytype']==3) { ?>
                    <div class='row order-tips-row'>订单为货到付款，请您务必联系买家确认后再进行发货</div>
                    <?php  } else { ?>
                    <div class='row order-tips-row'>您可以联系买家进行付款，否则订单会根据设置自动关闭</div>
                    <?php  } ?>
                    <?php  } ?>
                    <?php  if($item['status'] == 1) { ?>
                    <div class='row order-tips-row'>如果无法进行发货，请及时联系买家进行妥善处理;</div>
                    <?php  } ?>
                    <?php  if($item['status'] == 2) { ?>
                    <div class='row order-tips-row'>请及时关注物流状态，确保买家及时收到商品;</div>
                    <div class='row order-tips-row'>如果买家未收到货物或有退换货请求，请及时联系买家妥善处理</div>
                    <?php  } ?>

                    <?php  if($item['status']==3) { ?>
                    <div class='row order-tips-row'>交易成功，如买家有售后申请，请与买家进行协商，妥善处理</div>
                    <?php  } ?>
                </div>
                <?php  } ?>


            </div>

        </div>

    </div>

    <br>

    <?php  if(p('commission') && count($agents)>0) { ?>

    <div  class='row order-container'>
        <div class="row" style="margin: 20px 0 0 10px;">

            <?php  if(is_array($agents)) { foreach($agents as $key => $value) { ?>

            <div class="col-sm-4">

                <?php  if(!empty($value)) { ?>
                <h4 class="m-t-none m-b">
                    <?php  if($key == 0) { ?>
                    一级分销商
                    <?php  } else if($key == 1) { ?>
                    二级分销商
                    <?php  } else if($key == 2) { ?>
                    三级分销商
                    <?php  } ?>
                </h4>
                <div class="form-group" style='padding:0 10px;'>
                    <table class='ordertable' style='table-layout:fixed'>
                        <tr>
                            <td style='width:80px'>姓名：</td>
                            <td><a href="<?php  echo webUrl('member/list/detail',array('id'=>$value['id']))?>" target='_blank'><?php  echo $value['realname'];?></a> &nbsp;&nbsp;<a data-toggle='popover' data-html='true' data-placement='right'
                                                                                                                                                                    data-content="<table style='width:100%;'>

                <tr>
                    <td  style='border:none;text-align:right;' colspan='2'><img src='<?php  echo tomedia($value['avatar'])?>' style='width:100px;height:100px;padding:1px;border:1px solid #ccc' /></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>ID：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $value['id'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>昵称：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $value['nickname'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>姓名：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $value['realname'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>手机号：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $value['mobile'];?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>微信号：</td>
                    <td  style='border:none;text-align:right;'><?php  echo $value['weixin'];?></td>
                </tr>
                </table>
"><i class='fa fa-question-circle'></i></a></td>
                        </tr>

                        <tr>
                            <td style='width:80px'>手机号：</td>
                            <td><?php  echo $value['mobile'];?></td>
                        </tr>

                        <tr>
                            <td style='width:80px'>佣金：</td>
                            <td><?php  echo $value['commission'];?></td>
                        </tr>

                    </table>
                </div>
                <?php  } ?>

            </div>
            <?php  } } ?>
        </div>

    </div>
    <br>
    <?php  } ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <span>商品信息</span>
            <?php  if($item['ispackage']) { ?>
            <span class="text-danger" style="color:red;">（套餐优惠价：&yen;<?php  echo number_format($item['price'],2)?><?php  if($item['dispatchprice'] ) { ?>，含运费：&yen;<?php  echo number_format($item['dispatchprice'],2)?><?php  } ?>）</span>
            <?php  } ?>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:200px">标题</th>
                    <th>规格/编号/条码</th>
                    <th style="text-align: center;">单价(元)/数量</th>
                    <th style="text-align: center;"><?php  if($item['ispackage']) { ?>商品价格(元)<?php  } else { ?>折扣前/折扣后(元)<?php  } ?></th>

                    <?php  if(!empty($goods['diyformdata']) && $goods['diyformdata'] != 'false') { ?>
                    <th style="width:80px;"></th>
                    <?php  } ?>
                    <!--<th style="width:5%;">操作</th>-->
                </tr>
                </thead>
                <?php  $i=0;?>
                <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
                <tr>
                    <td class='full'>
                        <?php  if($goods['seckill_task']) { ?>
                        <span class="label label-danger"><?php  echo $goods['seckill_task']['tag'];?></span>
                        <?php  if($goods['seckill_room']) { ?><span class="label label-primary"><?php echo $goods['seckill_room']['tag']?:$goods['seckill_room']['title']?></span><?php  } ?>

                        <br/><?php  } ?>

                        <?php  if($category[$goods['pcate']]['name']) { ?>
                        <span class="text-error">[<?php  echo $category[$goods['pcate']]['name'];?>] </span><?php  } ?><?php  if($children[$goods['pcate']][$goods['ccate']]['1']) { ?>
                        <span class="text-info">[<?php  echo $children[$goods['pcate']][$goods['ccate']]['1'];?>] </span>
                        <?php  } ?>
                        <a target="_blank" href="<?php  echo webUrl('goods/edit', array('id' => $goods['id']))?>"title="查看"><?php  echo $goods['title'];?></a>
                        <?php  if(!empty($goods['invoice'])) { ?><label class='label label-danger'>支持开票</label><?php  } ?>
                    </td>
                    <td class='full'>
                        <?php  if(!empty($goods['optionname'])) { ?>
                        <span style="white-space:normal;">规格：
                            <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="right"
                                    data-content="<?php  echo $goods['optionname'];?>" data-original-title="" title=""
                                    style="word-break:keep-all;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:90px;padding:0 3px;">
                                <?php  echo $goods['optionname'];?>
                            </button>
                        </span>
                        <?php  } ?>
                        <?php  if(!empty($goods['goodssn'])) { ?><br/>编码:<?php  echo $goods['goodssn'];?><?php  } ?>
                        <?php  if(!empty($goods['productsn'])) { ?><br/>条码:<?php  echo $goods['productsn'];?><?php  } ?></td>
                    <td style="text-align: right;"><?php  echo $goods['marketprice'];?>
                        <br/>x<?php  echo $goods['total'];?></td>
                    <td style='color:red;font-weight:bold;text-align: right;'>
                        <?php  if($item['ispackage']) { ?>
                            &yen;<?php  echo number_format($goods['marketprice'],2)?>
                        <?php  } else { ?>
                            <?php  echo $goods['orderprice'];?>/<?php  echo $goods['realprice'];?>
                            <?php  if(intval($goods['changeprice'])!=0) { ?>
                            <br/>(改价<?php  if($goods['changeprice']>0) { ?>+<?php  } ?><?php  echo number_format(abs($goods['changeprice']),2)?>)
                            <?php  } ?>
                        <?php  } ?>
                    </td>

                    <?php  if(!empty($goods['diyformdata']) && $goods['diyformdata'] != 'false') { ?>
                    <td>
                        <a href='javascript:;' class=btn-xs' hide="1"  data="<?php  echo $i;?>" onclick="showDiyInfo(this)">自定义信息</a>
                    </td>
                    <?php  } ?>
                    <!--td>
                        <a href="<?php  echo webUrl('goods/edit', array('id' => $goods['id']))?>" class="btn btn-default btn-sm" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    </td-->
                </tr>

                <?php  if(!empty($goods['diyformdata']) && $goods['diyformdata'] != 'false') { ?>
                <tr>
                    <td colspan='5'>
                        <table class='ordertable' style='table-layout:fixed;display: none;' id="diyinfo_<?php  echo $i;?>">
                            <?php  $datas = $goods['diyformdata']?>
                            <?php  if(is_array($goods['diyformfields'])) { foreach($goods['diyformfields'] as $key => $value) { ?>
                            <tr>
                                <td style='width:80px'><?php  echo $value['tp_name']?>：</td>
                                <td>
                                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/diyform', TEMPLATE_INCLUDEPATH)) : (include template('diyform/diyform', TEMPLATE_INCLUDEPATH));?>
                                </td>
                            </tr>
                            <?php  } } ?>
                        </table>
                    </td>
                </tr>
                <?php  } ?>
                <?php  $i++;?>
                <?php  } } ?>

            </table>
        </div>
    </div>
</form>

<script language='javascript'>
    $(function () {
        $("#showdiymore1").click(function () {
            $(".diymore1").show();
            $(".diymore11").hide();
        });

        $("#showdiymore2").click(function () {
            $(".diymore2").show();
            $(".diymore22").hide();
        });
    });

    function showDiyInfo(obj){
        var data = $(obj).attr('data');
        var id = "diyinfo_" + data;

        var hide = $(obj).attr('hide');
        if(hide=='1'){
            $("#"+id).slideDown();
        }
        else{
            $("#"+id).slideUp();
        }
        $(obj).attr('hide',hide=='1'?'0':'1');
    }
    document.getElementById('asd').className();
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
