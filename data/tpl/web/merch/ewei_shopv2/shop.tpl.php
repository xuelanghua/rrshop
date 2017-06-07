<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-sm-10">
            <div class="contact-box">
                <div class="col-sm-1" style="padding:0">

                    <img onerror="this.src='<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg'"
                    src="<?php  if(empty($user['logo'])) { ?><?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg<?php  } else { ?><?php  echo tomedia($user['logo'])?><?php  } ?>" style="width:65px;height:65px;border-radius:5px">

                </div>
                <div class="col-sm-7"  style="padding-left:10px">
                     <h3><?php  echo $user['merchname'];?></h3>
                     <p><?php  echo $user['desc'];?></p>
                     <p class='form-control-static'>
                         店铺链接: <a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php  echo $url?>" ><?php  echo $url?></a>
                        <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true"
                              data-content="<img src='<?php  echo $qrcode;?>' width='130' alt='链接二维码'>" data-placement="auto right">
                            <i class="glyphicon glyphicon-qrcode"></i>
                        </span>
                     </p>
                </div>

                <div class="col-sm-3"  style="padding-left:10px" id="qrcode">
                </div>

                <div class="col-sm-1" style="padding-left: 0"><a class="btn btn-primary btn-sm" href="<?php  echo merchUrl('sysset')?>" style="color: #fff"> 点击修改</a></div>
                <div class="clearfix"></div>

            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-sm-10">
            <div class="contact-box" style="border: 1px solid #e7eaec">
                <div class="forum-item">
                    <div class="row">
                        <a href="<?php  echo merchUrl('goods',array('goodsfrom'=>'out'))?>">
                            <div class="col-sm-4 forum-info">
                                                <span class="views-number goods_totals">
                                                    --
                                                </span>
                                <div>
                                    <small>已售罄商品</small>
                                </div>
                            </div>
                        </a>

                        <a href="<?php  echo merchUrl('order/list/status1')?>">
                            <div class="col-sm-4 forum-info">
                                                <span class="views-number status1">
                                                   --
                                                </span>
                                <div>
                                    <small>待发货订单</small>
                                </div>
                            </div>
                        </a>

                        <a href="<?php  echo merchUrl('order/list/status4')?>">
                            <div class="col-sm-4 forum-info">
                                                <span class="views-number status4">
                                                   --
                                                </span>
                                <div>
                                    <small>维权中订单</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10 col-sm-10">
            <?php  if(!empty($order_ok)) { ?>
            <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
                <div class="ibox-title">
                    <h5>用户购买待发货订单</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th class="col-sm-1">状态</th>
                            <th class="col-sm-2">日期</th>
                            <th class="col-sm-1">金额</th>
                            <th class="col-sm-2">用户</th>
                            <th class="col-sm-3">订单号</th>
                            <th class="col-sm-2">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if(is_array($order_ok)) { foreach($order_ok as $key => $value) { ?>
                        <tr>
                            <td><span class="label label-warning">待发货</span>
                            </td>
                            <td><?php  echo date('Y-m-d H:i',$value['createtime'])?></td>
                            <td class="text-navy"><?php  echo $value['price'];?></td>
                            <td><?php echo !empty($value['address']['realname']) ? $value['address']['realname'] : $value['invoicename']?></td>
                            <td class="text-navy"><?php  echo $value['ordersn'];?></td>
                            <td>
                                <?php if(mcv('order.detail')) { ?>
                                <a href="<?php  echo merchUrl('order/detail',array('id'=>$value['id']))?>" class="btn btn-xs btn-primary">查看详情</a></td>
                            <?php  } ?>
                        </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } else { ?>
            <div class="panel panel-default">
                <div class="panel-body" style="text-align: center;padding:30px;">
                    暂时没有任何待处理订单!
                </div>
            </div>
            <?php  } ?>
        </div>

    </div>

<script type="text/javascript">
    require(['jquery.qrcode'],function(q){
        $("#qrcode").qrcode({
            width: 150, //宽度
            height:150, //高度
            text: "<?php  echo $url?>"
        });
    });

    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "<?php  echo merchUrl('order/list/ajaxgettotals')?>",
            dataType: "json",
            success: function (data) {
                shopajax();
                var res = data.result;
                $("span.status1").text(res.status1);
                $("span.status4").text(res.status4);
            }
        });

        function shopajax() {
            $.ajax({
                type: "GET",
                url: "<?php  echo merchUrl('shop/ajax')?>",
                dataType: "json",
                success: function (data) {
                    var res = data.result;
                    $("span.goods_totals").text(res.goods_totals);
                }
            });
        }
    });
</script>


    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>