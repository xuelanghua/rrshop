<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "<?php  echo $_W['cashieruser']['title'];?>"; </script>
<link href="../addons/ewei_shopv2/plugin/cashier/static/css/mobile.css" rel="stylesheet" type="text/css"/>
<div class='fui-page  fui-page-current'>
    <div class="fui-content ">
        <div class="fui-list-group cashier-list-group">
            <div class="fui-list">
                <div class="fui-list-inner">
                    <div class="title text-center"><?php  echo $_W['cashieruser']['title'];?>(收款端)</div>
                </div>
            </div>
        </div>
        <div class="fui-cell-group">
            <div class="fui-cell">
                <div class="fui-cell-label">收款金额</div>
                <div class="fui-cell-info"><input type="text" placeholder="请输入收款金额" class="fui-input" id="money" readonly></div>
            </div>
        </div>
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
            <td rowspan="3" class="weiKeyNum1" style="background: #04be02;color: #fff;" id="btn-pay">收款</td>
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
    <script>
        $(function () {
            var $money = $("#money");
            var weiKeyBoard = $("#weiKeyBoard");
            var weiKeyNum = $(".weiKeyNum");
            $money.click(function (e) {
                var $this = $(this);
                weiKeyBoard.addClass('in');
            });
            $("#firstTd").click(function () {
                weiKeyBoard.removeClass('in');
            });
            weiKeyNum.on('touchstart', function () {
                var $this = $(this);
                $(this).css( {"background-color": "#f8f8f8",'color':'#333333'});
                if ($this.attr('value') == 'back'){
                    $money.val($money.val().substring(0, $money.val().length - 1));
                }
                if ($this.text()){
                    if ($this.text() == '.'){
                        if ($money.val().indexOf('.') != -1){
                            return;
                        }
                    }
                    var newValue = $money.val() + $this.text();

                    if (newValue != -1){
                        var str = newValue.split('.');
                        if (typeof str[1] != 'undefined' && str[1].length>2){
                            return;
                        }
                    }

                    $money.val(newValue);

                }
            });
            weiKeyNum.on('touchend', function () {
                var $this = $(this);
                $(this).css({"background-color":"#ffffff","color":"#555"});
            });
            $money.trigger('click');
        })
    </script>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('order/pay/wechat_jie', TEMPLATE_INCLUDEPATH)) : (include template('order/pay/wechat_jie', TEMPLATE_INCLUDEPATH));?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('cashier/_footer', TEMPLATE_INCLUDEPATH)) : (include template('cashier/_footer', TEMPLATE_INCLUDEPATH));?>