<?php defined('IN_IA') or exit('Access Denied');?><script src="./resource/js/lib/jquery-1.11.1.min.js"></script>
<script src="<?php  echo EWEI_SHOPV2_LOCAL?>static/js/require.js"></script>
<script src="./resource/js/app/config.js"></script>
<style type="text/css">
    .popover{z-index:10000;}
    .alert{margin-top:10px;}
</style>
<div class="alert alert-danger">
    <p class="alert-link">以下商品不能参加优惠套餐活动：</p>
    <p>虚拟商品、限时购商品、促销商品、核销商品、会员权限商品、多商户商品；以及参加积分商城/拼团的商品。</p>
</div>
<div style='max-height:500px;overflow:auto;min-width:850px;'>
    <table class="table">
        <thead>
        <tr>
            <td>商品</td>
            <td style="width:100px;text-align: center;">商品价格</td>
            <td style="width:100px;text-align: center;">库存</td>
            <th style="width:100px;text-align: center;">操作</th>
        </tr>
        </thead>
        <tbody id="param-items" class="ui-sortable">
        <?php  if(is_array($ds)) { foreach($ds as $row) { ?>
        <tr>
            <td>
                <img src="<?php  echo tomedia($row['thumb'])?>" style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['title'];?>
            </td>
            <td style="text-align: right;">&yen;<?php  echo $row['marketprice'];?></td>
            <td style="text-align: right;"><?php  echo $row['total'];?></td>
            <td style="text-align: center;">
                <?php  if($row['type'] != 1 || $row['isdiscount'] > 0 || $row['istime'] > 0 || $row['isverify'] > 1 || $row['groupstype'] >0 || $row['total'] <= 0 ) { ?>
                <span>不支持</span>&nbsp;&nbsp;

                <a data-toggle='popover' data-html='true' data-placement='right' data-content="<table style='width:100%;'>
                <?php  if($row['isverify'] > 1) { ?><tr><td  style='border:none;'>核销商品</td></tr><?php  } ?>
                <?php  if($row['type'] == 2) { ?><tr><td  style='border:none;'>虚拟商品</td></tr><?php  } ?>
                <?php  if($row['type'] == 3) { ?><tr><td  style='border:none;'>虚拟物品（卡密）</td></tr><?php  } ?>
                <?php  if($row['type'] == 10) { ?><tr><td  style='border:none;'>话费流量充值</td></tr><?php  } ?>
                <?php  if($row['isdiscount'] > 0) { ?><tr><td  style='border:none;'>促销商品</td></tr><?php  } ?>
                <?php  if($row['istime'] > 0) { ?><tr><td  style='border:none;'>限时卖商品</td></tr><?php  } ?>
                <?php  if($row['total'] <= 0) { ?><tr><td  style='border:none;'>库存不足</td></tr><?php  } ?>
                <?php  if($row['groupstype'] > 0) { ?><tr><td  style='border:none;'>拼团商品</td></tr><?php  } ?>
                </table>"><i class='fa fa-question-circle'></i></a>

                <?php  } else { ?>
                <a href="javascript:;" class="label label-primary" onclick='biz.selector_new.set(this, <?php  echo json_encode($row);?>)'>选择</a>
                <?php  } ?>
            </td>
        </tr>
        <?php  } } ?>
        <?php  if(count($ds)<=0) { ?>
        <tr>
            <td colspan='4' align='center'>未找到商品</td>
        </tr>
        <?php  } ?>
        </tbody>
    </table>
    <div style="text-align:right;width:100%;">
        <?php  echo $pager;?>
    </div>
</div>
<script type="text/javascript">
    require(['bootstrap'], function ($) {
        $('[data-toggle="tooltip"]').tooltip({
            container: $(document.body)
        });
        $('[data-toggle="popover"]').popover({
            container: $(document.body)
        });
    });
    //分页函数
    var type = '';
    function select_page(url,pindex,obj) {
        if(pindex==''||pindex==0){
            return;
        }
        var keyword = $.trim($("#goodsid_input").val());
        $("#goodsid_input").html('<div class="tip">正在进行搜索...</div>');

        $.ajax({
            url:"<?php  echo webUrl('sale/package/query')?>",
            type:'get',
            data:{title:keyword,page:pindex,psize:10},
            async : false, //默认为true 异步
            success:function(data){
                $(".content").html(data);
            }
        });
    }

</script>