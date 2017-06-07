<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "<?php  echo $_W['cashieruser']['title'];?>"; </script>
<link href="../addons/ewei_shopv2/plugin/cashier/static/css/mobile.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/template/mobile/default/static/css/coupon-new.css?v=2017030310126">
<div class='fui-page  fui-page-current'>
    <div class="fui-content ">
        <div class="fui-img">
            <img src="<?php  echo tomedia($_W['cashieruser']['logo'])?>"/>
        </div>
        <div class="fui-list-group cashier-list-group">
            <div class="fui-list">
                <div class="fui-list-inner">
                    <div class="title text-center"><?php  echo $_W['cashieruser']['title'];?></div>
                </div>
            </div>
        </div>
        <?php  if(!empty($member)) { ?>
        <div class="fui-cell">
            <div class="fui-cell-text">
                    <p class="price" style="text-align: left;padding: 0.3rem 0 0 0.7rem">
                        <span style="font-size: 0.7rem">当前余额 : </span><span style="font-size: 0.8rem;font-weight: bold;color: red;">¥<?php  echo $member['credit2'];?></span>
                    </p>
            </div>
            <div class="fui-cell-tip">如果支付金额不大于余额 则优先使用余额支付</div>
        </div>
        <?php  } ?>
        <div class="fui-cell-group">
            <div class="fui-cell">
                <div class="fui-cell-label">支付金额</div>
                <div class="fui-cell-info">
                    <input style="height: 1.5rem" type="text" placeholder="请输入支付金额" class="fui-input" id="money" readonly data-title="<?php  echo $goodstitle;?>" <?php  if($id) { ?>value="<?php  echo $item['money'];?>"<?php  } ?>>
                </div>
            </div>
        </div>

        <div class="fui-cell-group  sm">
            <div id='coupondiv' class="fui-cell fui-cell-click" style='display:none'>
                <div class='fui-cell-label' style='width:auto;'>优惠券</div>
                <div class='fui-cell-info'></div>
                <div class='fui-cell-remark'>
                    <div class='badge badge-danger'>0</div>
                </div>
            </div>
        </div>
        <form action="https://openapi.alipay.com/gateway.do" method="post" id="alipay"></form>

    </div>
    <table id="weiKeyBoard">
        <tbody>
        <tr>
            <td class="weiKeyNum">1</td>
            <td class="weiKeyNum">2</td>
            <td class="weiKeyNum">3</td>
            <td value="back" class="weiKeyNum"><i class="icon icon-toleft" style="font-size: 1rem;"></i></td>
        </tr>
        <tr>
            <td class="weiKeyNum">4</td>
            <td class="weiKeyNum">5</td>
            <td class="weiKeyNum">6</td>
            <!--#04be02 微信
            #FF785A 支付宝-->
            <?php  if(is_weixin()) { ?>
            <td rowspan="3" class="weiKeyNum1" style="background: #04be02;color: #fff;" id="btn-wechat"><i class="icon icon-wechat" style="font-size: 2.5rem;"></i><br/>支付</td>
            <?php  } else if($_W['cashieruser']['alipay_status']) { ?>
            <td rowspan="3" class="weiKeyNum1" style="background: #FF785A;color: #fff;" id="btn-alipay"><i class="icon icon-rectangle390" style="font-size: 2.5rem;"></i><br/>支付</td>
            <?php  } ?>
        </tr>
        <tr>
            <td class="weiKeyNum">7</td>
            <td class="weiKeyNum">8</td>
            <td class="weiKeyNum">9</td>
        </tr>
        <tr>
            <td class="weiKeyNum" style="padding: 0" id="firstTd"><i class="icon icon-sanjiao1" style="font-size: 1rem"></i></td>
            <td class="weiKeyNum">0</td>
            <td class="weiKeyNum">.</td>
        </tr>
        </tbody>
    </table>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('order/pay/wechat_jie', TEMPLATE_INCLUDEPATH)) : (include template('order/pay/wechat_jie', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('sale/coupon/util/picker', TEMPLATE_INCLUDEPATH)) : (include template('sale/coupon/util/picker', TEMPLATE_INCLUDEPATH));?>
    <script language="javascript">
        require(['../addons/ewei_shopv2/plugin/cashier/static/js/mobile.js'], function (modal) {
            modal.init(<?php  echo intval($_GPC['jie']).','.intval($_GPC['cashierid']).','.intval($_GPC['operatorid']).",'$id'"?>);
        });
    </script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>