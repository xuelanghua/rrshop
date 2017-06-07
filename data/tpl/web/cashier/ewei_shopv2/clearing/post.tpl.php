<?php defined('IN_IA') or exit('Access Denied');?><?php  $no_left=true?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="row" style="margin:20px 100px;">
<div class="page-heading">
	<span class='pull-right'>
		<a class="btn btn-warning  btn-sm" href="<?php  echo cashierUrl('clearing')?>">返回列表</a>
	</span>
    <h2>生成结算单</h2>
</div>


<form id="setform" action="" method="post" class="form-horizontal form-validate">
    <input type="hidden" name="clearno" value="<?php  echo $clearing['clearno'];?>">
    <div class="panel panel-default panel-class">
        <div class="panel-heading">
            可申请提现金额为 <span class="text-danger"><?php  echo $total_money;?></span> 元 <?php  if(!empty($list)) { ?>(实际提现金额 <span class="text-danger"><?php  echo $money;?></span> 元)<?php  } ?>
           交易完成后 <span class="text-danger"><?php  echo $payday;?></span> 天,可提现</h5>
            </div>
        <div class="panel-body">
            <table class="table table-hover no-margins">
                <thead>
                <tr>
                    <th class="col-sm-1">状态</th>
                    <th class="col-sm-2">日期</th>
                    <th class="col-sm-1">金额</th>
                    <th class="col-sm-2">用户</th>
                    <th class="col-sm-3">订单号</th>
                    <th class="col-sm-2">是否结算</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $key => $value) { ?>
                <tr>
                    <td><?php  if($value['status']) { ?><span class="label label-primary">已支付</span><?php  } else { ?><span class="label label-default">未支付</span><?php  } ?>
                    </td>
                    <td><?php  echo date('Y-m-d H:i',$value['createtime'])?></td>
                    <td class="text-navy"><?php  echo $value['money'];?></td>
                    <td><?php  echo $user[$value['openid']]['nickname'];?></td>
                    <td class="text-navy"><?php  echo $value['logno'];?></td>
                    <td><?php  if($value['is_applypay']=='0') { ?><span class="label label-default">未结算</span><?php  } else if($value['is_applypay']=='1') { ?><span class="label label-warning">申请中</span><?php  } else if($value['is_applypay']=='1') { ?><span class="label label-danger">已结算</span><?php  } ?></td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
            <div class="text-center"><?php  echo $pager;?></div>


            <?php  if(!empty($list)) { ?>

            <?php  if($clearing['charge']!=0 ) { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">收银台提现手续费</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="input-group">
                        <input type="text" class="form-control" value="<?php  echo $clearing['charge'];?>" disabled/>
                        <div class="input-group-addon">%</div>
                    </div>
                    <span class="help-block">收银台提现时,扣除手续费</span>
                </div>
            </div>
            <?php  } ?>

            <?php  if(empty($clearing)&&!empty($set['withdrawcharge'])) { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">收银台提现手续费</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="input-group">
                        <input type="text" class="form-control" value="<?php  echo $withdraw;?>" disabled/>
                        <div class="input-group-addon">%</div>
                    </div>
                    <span class="help-block">收银台提现时,扣除手续费</span>
                </div>
            </div>
            <?php  } ?>


            <div class="form-group">
                <label class="col-sm-2 control-label">提现方式</label>
                <div class="col-sm-8">
                    <label class="radio-inline"><input type="radio"  name="paytype" value="0" <?php  if(empty($clearing['paytype'])) { ?>checked="true"<?php  } ?> <?php  if(!empty($clearing)) { ?>disabled<?php  } ?>/> 微信</label>
                    <?php  if(!empty($set['cashalipay'])) { ?>
                    <label class="radio-inline"><input type="radio"  name="paytype" value="1" <?php  if($clearing['paytype']=='1') { ?>checked="true"<?php  } ?> <?php  if(!empty($clearing)) { ?>disabled<?php  } ?>/> 支付宝</label>
                    <?php  } ?>
                    <?php  if(!empty($set['cashcard'])) { ?>
                    <label class="radio-inline"><input type="radio"  name="paytype" value="2" <?php  if($clearing['paytype']=='2') { ?>checked="true"<?php  } ?> <?php  if(!empty($clearing)) { ?>disabled<?php  } ?>/> 银行卡</label>
                    <?php  } ?>
                </div>
            </div>

            <div class="form-group paytype1" <?php  if($clearing['paytype'] != '1') { ?>style="display: none"<?php  } ?>>
            <label class="col-sm-2 control-label">支付宝姓名</label>
            <div class="col-sm-8">
                <input type="text" name="data[alipayname]" class="form-control" value="<?php  echo $payinfo['alipayname'];?>"  placeholder="例如:张三(请填写支付宝账户所对应的姓名,以免打错)" <?php  if(!empty($clearing)) { ?>disabled<?php  } ?>/>
            </div>
        </div>

        <div class="form-group paytype1" <?php  if($clearing['paytype'] != '1') { ?>style="display: none"<?php  } ?>>
        <label class="col-sm-2 control-label">支付宝账号</label>
        <div class="col-sm-8">
            <input type="text" name="data[alipaynum]" class="form-control" value="<?php  echo $payinfo['alipaynum'];?>"  <?php  if(!empty($clearing)) { ?>disabled<?php  } ?>/>
        </div>
    </div>

    <div class="form-group paytype2" <?php  if($clearing['paytype'] != '2') { ?>style="display: none"<?php  } ?>>
    <label class="col-sm-2 control-label">银行名称</label>
    <div class="col-sm-8">
        <input type="text" name="data[cardtitle]" class="form-control" value="<?php  echo $payinfo['cardtitle'];?>"  placeholder="例如:中国银行" <?php  if(!empty($clearing)) { ?>disabled<?php  } ?>/>
    </div>
</div>

<div class="form-group paytype2" <?php  if($clearing['paytype'] != '2') { ?>style="display: none"<?php  } ?>>
<label class="col-sm-2 control-label">收款人</label>
<div class="col-sm-8">
    <input type="text" name="data[cardname]" class="form-control" value="<?php  echo $payinfo['cardname'];?>" placeholder="例如:张三(请填写银行账户所对应的姓名,以免打错)" <?php  if(!empty($clearing)) { ?>disabled<?php  } ?> />
</div>
</div>

<div class="form-group paytype2" <?php  if($clearing['paytype'] != '2') { ?>style="display: none"<?php  } ?>>
<label class="col-sm-2 control-label">银行账户</label>
<div class="col-sm-8">
    <input type="text" name="data[cardnum]" class="form-control" value="<?php  echo $payinfo['cardnum'];?>" <?php  if(!empty($clearing)) { ?>disabled<?php  } ?> />
</div>
</div>

<?php  } ?>

<?php  if(empty($id)) { ?>
<div class="form-group" style="margin-top:20px;">
    <div class="col-sm-9 col-xs-12">
        <input type="submit"  value="提交申请" class="btn" />
    </div>
</div>
<?php  } ?>

            </div>
    </div>


</form>
</div>
<script>
    $(function () {
        $(":input[name='paytype']").click(function (e) {
            var $this = $(this);
            var paytype1 = $(".paytype1");
            var paytype2 = $(".paytype2");
            paytype1.hide(),paytype2.hide();
            if ($this.val()==1){
                paytype1.show();
            }
            if ($this.val()==2){
                paytype2.show();
            }
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>