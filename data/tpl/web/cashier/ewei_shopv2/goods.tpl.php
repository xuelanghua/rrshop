<?php defined('IN_IA') or exit('Access Denied');?><?php  $no_left = true?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<style>
    html,body{
        overflow-x:hidden;
    }
    .calculator {
        width: 350px;
        -webkit-user-select: none; /* Chrome all / Safari all */
        -moz-user-select: none; /* Firefox all */
        -ms-user-select: none; /* IE 10+ */
        -o-user-select: none;
        user-select: none;
        color: #333;
        float: left;
        margin-left:10px;
        margin-top:10px;
    }

    #navbar {
        margin-left: 1px;
        width: 100%;
    }

    .calculator tr {
        width: 350px
    }

    .calculator td {
        height: 70px;
        width: 70px;
        font-size: 20px;
        line-height: 70px;
        text-align: center;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(255, 255, 255, 0);
        color: #666

    }

    .calculator td:active,
    .calculator td:hover {
        color: #333;
        font-weight: bold;
        background: #fff;
    }

    /*.calculator td:hover {*/
    /*background: #eee;*/
    /*}*/

    /*.calculator td:active {*/
    /*background: #ddd;*/
    /*}*/

    .show {
        height: 90px;
        line-height: 90px;
        font-size: 32px;
        text-align: left;
        padding: 0 10px;
        border: none;

        margin: 0;
        width: 100%;
        color: #fff;
        outline: none;
    }

    .show::-webkit-input-placeholder {
        color: #c7c7c7;
        opacity: .5;
    }

    .money_container {
        display: flex;
        border-bottom: 1px solid #eee;
    }

    .money_container .text {
        width: 80px;
        height: 90px;
        line-height: 90px;
        font-size: 32px;
        color: #fff;
        text-align: center;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .paytype {
        float: left;
        border-radius: 5px;
        cursor: pointer;
        padding: 5px;
        margin-right:5px;
        border:1px solid transparent;;
    }

    .paytype.active,
    .paytype:hover {
        background:rgba(255,255,255,0.5);
        border:1px solid rgba(255,255,255,0.2)
    }

    #tip {
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 16px;
        color: #fff;
    }

    .row-container{
        text-align: center;width:90%;margin:auto;
        min-width:375px;
    }

    .paytype img {
        width: 85px;
    }

    .form-control {
        padding: 5px;
    }

    .goods-group-out {
        padding: 15px;
    }
    .goods-group {
        overflow-y: auto;
        max-height:450px;
    }
    .goods-group .item {
        height: 100px;
        width: 100px;
        background: #fff;
        position: relative;
        float: left;
        margin-right: 5px;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .goods-group .item img {
        height: inherit;
        width: inherit;
    }

    .goods-group .item .title {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        padding: 3px 5px;
        color: #fff;
        max-height: 40px;
        overflow: hidden;
    }
    .goods-group .nogoods {
        color: #fff;
    }
    .goods-group .nogoods i{
        font-size: 150px;
    }
    .goods-group .nogoods div{
        margin-top: 50px;
        font-size: 20px;
    }

</style>


<div class="container " style="margin-top:50px;">
    <div class="row-container">
        <div class="panel panel-default panel-class  ">
            <div class="panel-body">

                <div class="col-sm-6">
                    <div class="row" style="min-height: 300px; border-bottom: 1px solid #fff;">
                        <table class="table left">
                            <thead>
                            <th>名称</th>
                            <th style="width: 100px;">规格</th>
                            <th style="width: 80px;">单价</th>
                            <th style="width: 120px;">数量</th>
                            </thead>
                            <tbody id="tb_left"></tbody>
                        </table>
                    </div>
                    <div class="row">
                        <form action="" method="post" class="form-horizontal" style="padding-top: 20px;">
                            <input type="hidden" value="-1" name="data[paytype]"/>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-addon">收款</div>
                                        <input type="text" class="form-control" name="data[money]" value="" data-rule-required="true" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="paytype active" data-paytype="-1">
                                        <img src="../addons/ewei_shopv2/plugin/cashier/static/images/autopay.png"/>
                                    </div>
                                    <?php  if(!empty($_W['cashieruser']['wechat_status'])) { ?>
                                    <div class="paytype" data-paytype="0">
                                        <img src="../addons/ewei_shopv2/plugin/cashier/static/images/wechatpay.png"/>
                                    </div>
                                    <?php  } ?>
                                    <?php  if(!empty($_W['cashieruser']['alipay_status'])) { ?>
                                    <div class="paytype" data-paytype="1">
                                        <img src="../addons/ewei_shopv2/plugin/cashier/static/images/alipay.png"/>
                                    </div>
                                    <?php  } ?>
                                    <div class="paytype" data-paytype="3">
                                        <img src="../addons/ewei_shopv2/plugin/cashier/static/images/cash.png"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" <?php  if(empty($userset['use_credit2'])) { ?>style="display:none"<?php  } ?>>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="tel" class="form-control" name="data[mobile]" value="" placeholder="请输入会员手机号"/>
                                    <div class="input-group-btn">
                                        <input type="button" value="查询" class="btn" id="check_member"/>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="form-group" style="display:none">
                        <div class="col-sm-12">
                            <div class="form-control-static" style="color:white"><i class='fa fa-spinner fa-spin'></i> 正在查询...</div>
                        </div>
                    </div>

                    <div class="form-group"  style="display:none">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">昵称</div>
                                <input type="text" class="form-control" name="data[nickname]" value="" readonly/>
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon">账户余额</div>
                                <input type="number" class="form-control" name="data[credit2]" value="0" step="0.01" readonly/>
                                <div class="input-group-addon">  抵用金额</div>
                                <input type="number" class="form-control" name="data[deduction]" value="0" step="0.01"/>
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon">还需支付</div>
                                <input type="text" class="form-control" value="0" id="paymoney" readonly/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="qrcode">
                        <div class="col-sm-12">
                            <div class="input-group">

                                <input type="text" class="form-control" name="data[auth_code]" value="" data-rule-required="true" placeholder="请扫描或输入微信或支付宝付款码"/>
                                <div class="input-group-btn">
                                    <input type="submit" value="提交" class="btn"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="submit" style="display: none">
                        <div class="col-sm-12">
                            <input type="submit" value="提交" class="btn btn-block"/>
                        </div>
                    </div>

                    <div class="form-group" id="ordre-status" style="display:none">
                        <div class="col-sm-12">
                            <div class="form-control-static" style="color:white"><i class='fa fa-spinner fa-spin'></i> 正在刷新支付状态...</div>
                        </div>
                    </div>

                    </form>
                    </div>
                </div>
                <div class="col-sm-6" style="padding-left: 40px;">
                    <div class="input-group">
                        <input type="text" class="form-control valid" id="searchgoods" placeholder="搜索商品名称/商品条码">
                        <div class="input-group-btn" style="width: 120px">
                            <select class="form-control m-b">
                                <option value="0">选择分类</option>
                                <?php  if(is_array($cate)) { foreach($cate as $ca) { ?>
                                <option value="<?php  echo $ca['id'];?>"><?php  echo $ca['catename'];?></option>
                                <?php  } } ?>
                                <option value="shop">商城商品</option>
                            </select>
                            </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn " id="query">搜索</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="goods-group-out">
                            <div class="goods-group" id="goodsdata">
                                <div class="nogoods">
                                    <div>请搜索商品</div>
                                    <i class="icon icon-emoji"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<script>
    var winselfgoods = {};
    var wingoods = {};
    $(function () {

        $(window).off('keydown').keydown(function (k) {
            var $attr = $(k.target);
            if ($attr.attr('id') == "data[auth_code]" || $attr.attr('name') == "data[deduction]" || $attr.attr('name') == "data[mobile]" || $attr.attr('id') == "searchgoods") {
                //如果是手机号,则模拟点击
                if ($attr.attr('name') == "data[mobile]" && k.keyCode == '13'){
                    k.preventDefault();
                    $("#check_member").trigger('click');
                }

                //如果是手机号,则模拟点击
                if ($attr.attr('id') == "searchgoods" && k.keyCode == '13'){
                    k.preventDefault();
                    $("#query").trigger('click');
                    $attr.val('').focus();
                }
            }
        });

        //查询商品
        $("#query").click(function (e) {
            e.preventDefault();
            var $this = $(this);
            var val = $.trim($this.parent().prev().prev().val());
            var cate = $this.parent().prev().find('select').val();
            if (val == '' && cate == '0'){
                tip.msgbox.suc('请选择分类或者输入关键字!');
                return;
            }
            var issn= /^[0-9]{8,14}$/.test(val);
            $.getJSON("<?php  echo cashierUrl('goods/get_goods')?>",{keyword:val,cate:cate},function (data) {
                if (data.status == 0){
                    tip.msgbox.suc(data.result.message);
                }else{
                    var $goodsdata = $("#goodsdata");
                    $goodsdata.html('');
                    var selfgoods = data.result.selfgoods;
                    var goods = data.result.goods;
                    if (selfgoods.length>0){
                        var html = '';
                        $.each(selfgoods,function (key,value) {
                            html += '<div class="item goods" data-id="'+value.id+'" data-title="'+value.title+'" data-option="0" data-selfgoods="1"><img src="'+value.thumb+'" /><div class="title">'+value.title+'</div></div>';
                            winselfgoods[value.id] = value;
                        });
                        $goodsdata.html(html)
                    }

                    if(goods.length>0){
                        var html = '';
                        $.each(goods,function (key,value) {
                            var x;
                            var option = false;
                            if (value.options != false){
                                for (x in value.options){
                                    option = value.options[x];
                                    break;
                                }
                            }

                            html += '<div class="item goods" data-id="'+value.id+'" data-title="'+value.title+'" data-option="'+(option==false?0:option.id)+'" data-selfgoods="0"><img src="'+value.thumb+'" /><div class="title">'+value.title+'</div></div>';
                            wingoods[value.id] = value;
                        });
                        $goodsdata.append(html)
                    }
                    if (issn){
                        $(".goods").trigger('click');
                    }
                }
            });
        });

        //点击添加商品
        $(document).on('click','.goods',function (e) {
            var $this = $(this);
            var data = $this.data();
            var goods;
            if (data.selfgoods == '0'){
                goods = wingoods[data.id];
            }else {
                goods = winselfgoods[data.id];
            }
            var html = '<tr data-id="'+data.id+'" data-title="'+data.title+'" data-option="'+data.option+'" data-selfgoods="'+data.selfgoods+'">';
            html += '<td style="text-align: left;">'+goods.title+'</td>';
            html += '<td style="text-align: left;">';
            if (data.option!=0){
                html += '<select class="form-control input-sm select-option">';
                $.each(goods.options,function (index,item) {
                    html += '<option value="'+item.id+'">'+item.title+'</option>';
                });
                html += '</select>';
            }else{
                html += '无';
            }
            html += '<td class="col-sm-3">';
            html += '<input type="number" class="form-control input-sm price" value="'+goods.price+'"  style="text-align: center;"/>';
            html += '</td>';
            html += '<td class="col-sm-4">';
            html += '<div class="input-group input-group-sm">';
            html += '<div class="input-group-btn"><button class="btn" onclick="num(this)">-</button></div>';
            html += '<input type="number" class="form-control total" value="1" style="text-align: center"/>';
            html += '<div class="input-group-btn"><button class="btn" onclick="num(this)">+</button></div>';
            html += '</div>';
            html += '</td>';
            html += '</tr>';
            $("#tb_left").append(html);
            calculate();
        });

        //切换规格
        $(document).on("change",".select-option",function(){
            var $this = $(this);
            $this.parents('tr').data('option',$this.val());
            var data = $this.parents('tr').data();
            var goods;
            if (data.selfgoods == '0'){
                goods = wingoods[data.id];
            }else {
                goods = winselfgoods[data.id];
            }
            $this.parent().next().find(":input").val(goods.options[$this.val()].marketprice);
            calculate();
        });

        //修改金额
        $(document).on("change","#tb_left input",function(){
            calculate();
        });

        //点击查询手机会员信息
        $("#check_member").on('click', function (e) {
            var $this = $(this);
            var $parents = $(this).parents(".form-group");
            var mobile = $parents.find(':input[name="data[mobile]"]').val();
            var $tishi = $parents.next();
            var $credit = $tishi.next();
            if (mobile == '' || mobile.length != 11) {
                tip.msgbox.err('请输入正确的手机号!');
                return false;
            }
            $parents.next().show();
            $.getJSON("<?php  echo cashierUrl('goods/query_member',array('cashierid'=>$_W['cashierid']))?>", {mobile: mobile}, function (data) {
                $tishi.hide();
                $credit.hide();
                if (data.status == 0) {
                    tip.msgbox.err('未查到该会员!');
                } else if (data.status == 1){
                    tip.prompt("请输入您的密码",function (value) {
                        $.post("<?php  echo cashierUrl('goods/verify_password',array('cashierid'=>$_W['cashierid']))?>",{password:value,mobile:mobile},function (vdata) {
                            if (vdata.status==0){
                                tip.msgbox.err('密码错误!!!');
                            }else if (vdata.status==1){
                                show_member($credit,vdata);
                            }
                        },'json');
                    },true);
                }else if(data.status == 2){
                    tip.prompt("请设置您的密码",function (value) {
                        $.post("<?php  echo cashierUrl('goods/set_password',array('cashierid'=>$_W['cashierid']))?>",{password:value,mobile:mobile},function (vdata) {
                            if (vdata.status==0){
                                tip.msgbox.err('设置失败!!!');
                            }else if (vdata.status==1){
                                show_member($credit,vdata);
                            }
                        },'json');
                    },true);
                }
            });
        });

        //表单提交
        $('form').submit(function (e) {
            e.preventDefault();
            $('input[type="submit"]').attr('disabled',true);
            var $this = $(this);
            var ordre_status = $('#ordre-status');

            var trs = $("#tb_left").find('tr');
            var selfgoods = new Array();
            var goods = new Array();
            if (trs.length>0){
                trs.each(function (index,item) {
                    var $item = $(item);
                    var array;
                    if ($item.data('selfgoods') == '1'){
                        array = {
                            'goodsid':$item.data('id'),
                            'price':$item.find(':input.price').val(),
                            'total':$item.find(':input.total').val()
                        };
                        selfgoods.push(array);
                    }else {
                        array = {
                            'goodsid':$item.data('id'),
                            'optionid':$item.data('option'),
                            'price':$item.find(':input.price').val(),
                            'total':$item.find(':input.total').val()
                        };
                        goods.push(array);
                    }

                });
            }
            ordre_status.show();
            var formData = {
                selfgoods:selfgoods,
                goods:goods,
                'data[paytype]':$this.find(":input[name='data[paytype]']").val(),
                'data[money]':$this.find(":input[name='data[money]']").val(),
                'data[mobile]':$this.find(":input[name='data[mobile]']").val(),
                'data[nickname]':$this.find(":input[name='data[nickname]']").val(),
                'data[credit2]':$this.find(":input[name='data[credit2]']").val(),
                'data[deduction]':$this.find(":input[name='data[deduction]']").val(),
                'data[auth_code]':$this.find(":input[name='data[auth_code]']").val()
            };
            $.post("<?php  echo cashierUrl('goods')?>", formData, function (data) {
                if (data.status == 0) {
                    window.nul = setInterval(function () {
                        $.getJSON("<?php  echo cashierUrl('goods/orderquery')?>" + "&orderid=" + data.result.message, function (order) {
                            if (order.status == 1) {
                                ordre_status.hide();
                                tip.msgbox.suc('支付成功!');
                                clearInterval(window.nul);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);
                            }
                        })
                    }, 3000);
                } else if (data.status == 1) {
                    ordre_status.hide();
                    tip.msgbox.suc('支付成功!');
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                } else if (data.status == -101) {
                    ordre_status.hide();
                    tip.msgbox.err(data.result.message);
                    return false;
                }
            }, 'json')
        });
        $('.paytype').click(function () {
            var obj = $(this), paytype = obj.data('paytype');
            $('.paytype.active').removeClass('active');
            obj.addClass('active');
            $(":hidden[name='data[paytype]']").val(paytype);

            if (paytype == 3) {
                $("#qrcode").hide();
                $("#submit").show();
            } else {
                $("#qrcode").show();
                $("#submit").hide();
            }
        });

        $(":input[name='data[deduction]']").change(function () {
            var $this = $(this);
            var money = $(":input[name='data[money]']").val();
            var $prev = $this.parent().find(":input[name='data[credit2]']");
            if (parseFloat($this.val()) > parseFloat($prev.val())){
                $this.val($prev.val());
            }
            if (parseFloat($this.val()) > parseFloat(money)){
                $this.val(money);
            }
            $("#paymoney").val((parseFloat(money)-parseFloat($this.val())).toFixed(2));
        });

    });

    function num(obj) {
        var $this = $(obj);
        if ($this.text() == '-') {
            var text = $this.parent().next();
            if (text.val() <= 1) {
                $this.parents('tr').remove();
            } else {
                text.val(parseFloat(text.val()) - 1);
            }
        } else {
            var text = $this.parent().prev();
            text.val(parseFloat(text.val()) + 1);
        }
        calculate();
    }

    function calculate(){
        var trs = $("#tb_left").find('tr');
        var money = 0;
        var gid = {};
        if (trs.length>0){
            trs.each(function (index,item) {
                var $item = $(item);
                if (typeof gid[$item.data('id')+'_'+$item.data('selfgoods')+'_'+$item.data('option')] == 'undefined'){
                    gid[$item.data('id')+'_'+$item.data('selfgoods')+'_'+$item.data('option')] = index;
                }else {
                    var re = trs.eq(gid[$item.data('id')+'_'+$item.data('selfgoods')+'_'+$item.data('option')]).find(':input.total');
                    re.val(parseInt(re.val())+1);
                    $item.remove();
                }
                money += parseFloat($item.find(':input.price').val())*parseInt($item.find(':input.total').val());
            });
        }
        $(':input[name="data[money]"]').val(money.toFixed(2));
    }

    function log(log) {
        console.log(log);
    }

    function show_member($credit,vdata) {
        $credit.find(":input[name='data[nickname]']").val(vdata.result.nickname);
        $credit.find(":input[name='data[credit2]']").val(vdata.result.credit2);
        var money = $(":input[name='data[money]']").val();
        var deduction = $credit.find(":input[name='data[deduction]']");
        if (parseFloat(vdata.result.credit2) > parseFloat(money)){
            deduction.val(money);
        }else{
            deduction.val(vdata.result.credit2);
        }
        $("#paymoney").val((parseFloat(money)-parseFloat(deduction.val())).toFixed(2));
        $credit.show();
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>