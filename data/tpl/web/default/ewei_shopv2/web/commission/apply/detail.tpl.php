<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> 
    <span class='pull-right'>
        <?php  if($status==1 && cv('commission.apply.check')) { ?>
        <a href="javascript:;" onclick="checkall(true)" class="btn btn-success btn-sm">批量审核通过</a>
        <a href="javascript:;" onclick="checkall(false)" class="btn btn-danger btn-sm">批量审核不通过</a>
        <?php  } ?>
    </span>
    <h2>提现申请信息
        <small> 共计 <span style="color:red; "><?php  echo $totalcount;?></span> 个订单 , 金额共计 <span style="color:red; "><?php  echo $totalmoney;?></span> 元 佣金总计 <span style="color:red; "><?php  echo $totalcommission;?></span> 元
        </small>
    </h2>
</div>
<div class="step-region" >
    <ul class="ui-step ui-step-4" >
        <li <?php  if($apply['status']>=1) { ?>class="ui-step-done"<?php  } ?>>
            <div class="ui-step-title" >申请中</div>
            <div class="ui-step-number" >1</div>
            <div class="ui-step-meta" ><?php  if(1<=$apply['status']) { ?><?php  echo date('Y-m-d',$apply['applytime'])?><br/><?php  echo date('H:i:s',$apply['applytime'])?><?php  } ?></div>
        </li>
        <li  <?php  if($apply['status']>=2) { ?>class="ui-step-done"<?php  } ?>>
            <div class="ui-step-title">商家审核</div>
            <div class="ui-step-number">2</div>
            <div class="ui-step-meta"><?php  if(2<=$apply['status']) { ?><?php  echo date('Y-m-d',$apply['checktime'])?><br/><?php  echo date('H:i:s',$apply['checktime'])?><?php  } ?></div>
        </li>
        <li <?php  if($apply['status']>=3) { ?>class="ui-step-done"<?php  } ?>>
            <div class="ui-step-title">商家打款</div>
            <div class="ui-step-number" >3</div>
            <div class="ui-step-meta" ><?php  if(3<=$apply['status']) { ?><?php  echo date('Y-m-d',$apply['paytime'])?><br/><?php  echo date('H:i:s',$apply['paytime'])?><?php  } ?></div>
        </li>
        <li <?php  if($apply['status']==-1) { ?>class="ui-step-done"<?php  } ?>>
            <div class="ui-step-title">无效</div>
            <div class="ui-step-number" >!</div>
            <div class="ui-step-meta" ><?php  if(-1==$apply['status']) { ?><?php  echo date('Y-m-d',$apply['invalidtime'])?><br/><?php  echo date('H:i:s',$apply['invalidtime'])?><?php  } ?></div>
        </li>
    </ul>
</div>

<form <?php if(cv('commission.apply.check|commission.apply.pay|commission.apply.cancel')) { ?>action="" method='post'<?php  } ?> class='form-horizontal form-validate'>

    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="commission.apply" />
    <input type="hidden" name="id" value="<?php  echo $apply['id'];?>" />
    
    <div class="panel panel-default">
        <div class='panel-heading'>
            提现者信息
        </div>
        <div class='panel-body'>
            <div style='height:auto;width:120px;float:left;'>
                <img src='<?php  echo $member['avatar'];?>' style='width:100px;height:100px;border:1px solid #ccc;padding:1px' />
            </div>
            <div style='float:left;height:auto;overflow: hidden;width:600px'>
                <p><b>昵称:</b> <?php  echo $member['nickname'];?>    <b>姓名:</b> <?php  echo $member['realname'];?>  <b>手机号:</b> <?php  echo $member['mobile'];?>    <b>微信号:</b> <?php  echo $member['weixin'];?></p>
                <p><b>分销等级:</b>  <?php  echo $agentLevel['levelname'];?> (
                    <?php  if($this->set['level']>=1) { ?>一级比例: <span style='color:blue'><?php  echo $agentLevel['commission1'];?>%</span><?php  } ?>
                    <?php  if($this->set['level']>=2) { ?>二级比例: <span style='color:blue'><?php  echo $agentLevel['commission2'];?>%</span><?php  } ?>
                    <?php  if($this->set['level']>=3) { ?>三级比例: <span style='color:blue'><?php  echo $agentLevel['commission3'];?>%</span><?php  } ?>
                    )</p>
                <p>
                    <b>下级:</b> 总共 <span style='color:red'><?php  echo $member['agentcount'];?></span> 人 
                    <?php  if($this->set['level']>=1) { ?><b>一级:</b><span style='color:red'><?php  echo $member['level1'];?></span>  人<?php  } ?>  
                    <?php  if($this->set['level']>=2) { ?><b>二级:</b> <span style='color:red'><?php  echo $member['level2'];?></span>  人<?php  } ?> 
                    <?php  if($this->set['level']>=3) { ?><b>三级: </b><span style='color:red'><?php  echo $member['level3'];?></span> 人<?php  } ?>
                    点击:  <span style='color:red'><?php  echo $member['clickcount'];?></span> 次 
                <p>
                    <b>累计佣金: </b><span style='color:red'><?php  echo $member['commission_total'];?></span> 元  
                    <b>待审核佣金: </b><span style='color:red'><?php  echo $member['commission_apply'];?></span> 元  
                    <b>待打款佣金: </b><span style='color:red'><?php  echo $member['commission_check'];?></span> 元  
                    <b>结算期佣金: </b><span style='color:red'><?php  echo $member['commission_lock'];?></span> 元  </p>
                <p>
                    <b>申请佣金: </b><span style='color:red'><?php  echo $apply['commission'];?></span> 元  
                </p>
                <?php  if((float)$apply['sendmoney']) { ?>
                <p>
                    <b>已打款(红包才有): </b><span style='color:red'><?php  echo $apply['sendmoney'];?></span> 元
                </p>
                <?php  } ?>
                <p>
                    <b>打款方式: </b>
                    <?php  if(empty($apply['type'])) { ?>
                    <span class='label label-primary'><?php  echo $apply_type[$apply['type']];?></span>
                    <?php  } else if($apply['type'] == 1) { ?>
                    <span class='label label-success'><?php  echo $apply_type[$apply['type']];?></span>
                    <?php  } else if($apply['type'] == 2) { ?>
                    <span class='label label-warning'><?php  echo $apply_type[$apply['type']];?></span>
                    <b>姓名: </b><span style='color:red' id="realname"><?php  echo $apply['realname'];?></span>
                    <b>支付宝帐号: </b><span style='color:red' id="alipay"><?php  echo $apply['alipay'];?></span>
                    <?php  } else if($apply['type'] == 3) { ?>
                    <span class='label label-danger'><?php  echo $apply_type[$apply['type']];?></span>
                    <b>姓名: </b><span style='color:red' id="realname"><?php  echo $apply['realname'];?></span>
                    <b>银行: </b><span style='color:red' id="bankname"><?php  echo $apply['bankname'];?></span>
                    <b>卡号: </b><span style='color:red' id="bankcard"><?php  echo $apply['bankcard'];?></span>
                    <?php  } ?>
                </p>


            </div>
        </div>

        <div class='panel-body'>
            <table class="table">
                <thead class="navbar-inner">
                    <tr>
                        <th style='width:190px;'>订单号</th>
                        <th>金额</th>
                        <th>付款方式</th>
                        <th>下单时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr  style="background: #eee">
                        <td><?php  echo $row['ordersn'];?></td>
                        <td
                            ><b><?php  echo $row['price'];?></b> <a ><i class="fa fa-question-circle"  data-toggle='popover' data-placement='right' data-html='true' data-trigger='hover'
                                                       data-content="<table class='table table-hover'>

                                                       <tr><th>总金额</th><td><?php  echo $row['price'];?></td></tr>
                                                       <tr><th>商品小计</th><td><?php  echo $row['goodsprice'];?></td></tr>
                                                       <tr><th>运费</th><td><?php  echo $row['dispatchprice'];?></td></tr>
                                                       <tr><th>会员折扣</th><td><?php  if($row['discountprice']>0) { ?>-<?php  echo $row['discountprice'];?><?php  } ?></td></tr>
                                                       <tr><th>积分抵扣</th><td><?php  if($row['deductprice']>0) { ?>-<?php  echo $row['deductprice'];?><?php  } ?></td></tr>
                                                       <tr><th>余额抵扣</th><td><?php  if($row['deductcredit2']>0) { ?>-<?php  echo $row['deductcredit2'];?><?php  } ?></td></tr>
                                                       <tr><th>满额立减</th><td><?php  if($row['deductenough']>0) { ?>-<?php  echo $row['deductenough'];?><?php  } ?></td></tr>
                                                       <tr><th>优惠券优惠</th><td><?php  if($row['couponprice']>0) { ?>-<?php  echo $row['couponprice'];?><?php  } ?></td></tr>
                                                       <tr><th>卖家改价</th><td><?php  if(0<$item['changeprice']) { ?>+<?php  } else { ?>-<?php  } ?><?php  echo number_format(abs($item['changeprice']),2)?></td></tr>
                                                       <tr><th>卖家改运费</th><td><?php  if(0<$item['changedipatchpriceprice']) { ?>+<?php  } else { ?>-<?php  } ?><?php  echo number_format(abs($item['changedipatchpriceprice']),2)?></td></tr>
                                                       </table>"></i></a></td>

                        <td><?php  if($row['paytype'] == 1) { ?>
                            <span class="label label-danger">余额支付</span>
                            <?php  } else if($row['paytype'] == 11) { ?>
                            <span class="label label-default">后台付款</span>
                            <?php  } else if($row['paytype'] == 21) { ?>
                            <span class="label label-success">微信支付</span>
                            <?php  } else if($row['paytype'] == 22) { ?>
                            <span class="label label-danger">支付宝支付</span>
                            <?php  } else if($row['paytype'] == 22) { ?>
                            <span class="label label-primary">银联支付</span>
                            <?php  } else if($row['paytype'] == 3) { ?>
                            <span class="label label-primary">货到付款</span>
                            <?php  } ?>
                        </td>

                        <td><?php  echo date('Y-m-d H:i',$row['createtime'])?></td>   
                    </tr>	
                    <tr >

                        <td colspan="4">
                            <table width="100%" class='table'>
                                <thead class="navbar-inner">
                                    <tr>
                                        <th style='width:40px;'>商品</th>
                                        <th style='width:130px;'></th>
                                        <th style='width:70px;text-align: right;;'>单价/数量</td>

                                        <th>佣金</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  if(is_array($row['goods'])) { foreach($row['goods'] as $g) { ?>
                                    <tr>
                                        <td style='height:40px;'><img src="<?php  echo tomedia($g['thumb'])?>" style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;"></td>
                                        <td><span><?php  echo $g['title'];?></span><br/><span><?php  echo $g['optionname'];?></span>
                                        </td>

                                        <td style='text-align: right'><?php  echo number_format($g['price']/$g['total'],2)?><br/>x<?php  echo $g['total'];?></td>

                                        <td>

                                            <?php  if($this->set['level']>=1 && $row['level']==1) { ?>
                                            <p>
                                            <div class='input-group'>
                                                <span class='input-group-addon'>一级佣金</span>
                                                <span class='input-group-addon' style='width:80px;'><?php  echo $g['commission1'];?></span>

                                                <span class='input-group-addon'>
                                                    <?php  if($g['status1']==-1) { ?>
                                                    <span class='label label-default'>未通过</span>
                                                    <?php  } else if($g['status1']==1) { ?>

                                                    <label class='radio-inline' style='margin-top:-7px;'><input type='radio'  class='status1' value='-1'  name="status1[<?php  echo $g['id'];?>]" /> 不通过</label>
                                                    <label class='radio-inline'  style='margin-top:-7px;'><input type='radio'  value='2'   name="status1[<?php  echo $g['id'];?>]"  /> 通过</label>


                                                    <?php  } else if($g['status1']==2) { ?>
                                                    <span class='label label-success'>通过</span>
                                                    <?php  } else if($g['status1']==3) { ?>
                                                    <span class='label label-warning'>已打款</span>
                                                    <?php  } ?>
                                                </span>
                                                <span class='input-group-addon'>备注</span>  
                                                <input type='text' class='form-control' name='content1[<?php  echo $g['id'];?>]' style='width:150px;' value="<?php  echo $g['content1'];?>">
                                            </div></p>
                                            <?php  } ?>

                                            <?php  if($this->set['level']>=2  && $row['level']==2) { ?><p>

                                            <div class='input-group'>
                                                <span class='input-group-addon'>二级佣金</span>
                                                <span class='input-group-addon' style='background:#fff;width:80px;'><?php  echo $g['commission2'];?></span>
                                                <span class='input-group-addon'>状态</span>    
                                                <span class='input-group-addon' style='background:#fff'>
                                                    <?php  if($g['status2']==-1) { ?>
                                                    <span class='label label-default'>未通过</span>
                                                    <?php  } else if($g['status2']==1) { ?>

                                                    <label class='radio-inline'><input type='radio' class='status2' value='-1'  name="status2[<?php  echo $g['id'];?>]" /> 不通过</label>
                                                    <label class='radio-inline'><input type='radio'  value='2'  name="status2[<?php  echo $g['id'];?>]"  /> 通过</label>

                                                    <?php  } else if($g['status2']==2) { ?>
                                                    <span class='label label-success'>通过</span>
                                                    <?php  } else if($g['status2']==3) { ?>
                                                    <span class='label label-warning'>已打款</span>
                                                    <?php  } ?>
                                                </span>
                                                <span class='input-group-addon'>备注</span>  
                                                <input type='text' class='form-control' name='content2[<?php  echo $g['id'];?>]' style='width:200px;' value="<?php  echo $g['content2'];?>">
                                            </div>
                                            </p>
                                            <?php  } ?>
                                            <?php  if($this->set['level']>=2  && $row['level']==3) { ?><p>

                                            <div class='input-group'>
                                                <span class='input-group-addon'>三级佣金</span>
                                                <span class='input-group-addon' style='background:#fff;width:80px;'><?php  echo $g['commission3'];?></span>
                                                <span class='input-group-addon'>状态</span>    
                                                <span class='input-group-addon' style='background:#fff'>
                                                    <?php  if($g['status3']==-1) { ?>
                                                    <span class='label label-default'>未通过</span>
                                                    <?php  } else if($g['status3']==1) { ?>

                                                    <label class='radio-inline'><input type='radio' class='status3' value='-1' name="status3[<?php  echo $g['id'];?>]" /> 不通过</label>
                                                    <label class='radio-inline'><input type='radio' value='2' name="status3[<?php  echo $g['id'];?>]"  /> 通过</label>

                                                    <?php  } else if($g['status3']==2) { ?>
                                                    <span class='label label-success'>通过</span>
                                                    <?php  } else if($g['status3']==3) { ?>
                                                    <span class='label label-warning'>已打款</span>
                                                    <?php  } ?>
                                                </span>
                                                <span class='input-group-addon'>备注</span>  
                                                <input type='text' class='form-control' name='content3[<?php  echo $g['id'];?>]' style='width:200px;'  value="<?php  echo $g['content3'];?>">
                                            </div>
                                            </p>
                                            <?php  } ?>
                                        </td>
                                    </tr>
                                    <?php  } } ?>
                                </tbody></table>	   
                        </td></tr>	
                    <?php  } } ?>
            </table>
        </div>

        <?php  if($apply['status']==2) { ?>
        <div class='panel-heading'>
            打款信息
        </div>
        <div class='panel-body'>
            此次佣金总额:  <span style='color:red'><?php  echo $totalcommission;?></span> 元
            应该打款：<span style='color:red'><?php  echo $totalpay;?></span> 元
            实际佣金：<span style='color:red'>
                <?php  if($deductionmoney > 0) { ?>
                <?php  echo $realmoney;?>
                <?php  } else { ?>
                <?php  echo $totalpay;?>
                <?php  } ?>
            </span> 元
            个人所得税金额：<span style='color:red'><?php  echo $deductionmoney;?></span> 元
            个人所得税：<span style='color:red'><?php  echo $charge;?>%</span>

        </div>
        <?php  } ?>

        <?php  if($apply['status']==3) { ?>
        <div class='panel-heading'>
            打款信息
        </div>
        <div class='panel-body'>
            此次佣金总额:  <span style='color:red'><?php  echo $totalcommission;?></span> 元
            实际打款：<span style='color:red'><?php  echo $totalpay;?></span> 元
            实际到账：<span style='color:red'>
                <?php  if($deductionmoney > 0) { ?>
                <?php  echo $realmoney;?>
                <?php  } else { ?>
                <?php  echo $totalpay;?>
                <?php  } ?>
            </span> 元
            个人所得税金额：<span style='color:red'><?php  echo $deductionmoney;?></span> 元
            个人所得税：<span style='color:red'><?php  echo $charge;?>%</span>
        </div>
        <?php  } ?>

    </div>  
    <div class="form-group col-sm-12">
        <?php  if($apply['status']==1) { ?>
        <?php if(cv('commission.apply.refuse')) { ?>
        <input type="submit" name="submit_refuse" value="驳回申请" class="btn btn-danger" onclick='return refuse()'/>
        <?php  } ?>
        <?php if(cv('commission.apply.check')) { ?>
        <input type="submit" name="submit_check" value="提交审核" class="btn btn-primary" onclick='return check()'/>
        <?php  } ?>
        <?php  } ?>

        <?php  if($apply['status']==2) { ?>

        <?php if(cv('commission.apply.cancel')) { ?>
        <input type="submit" name="submit_cancel" value="重新审核" class="btn btn-default"  onclick='return cancel()'/>
        <?php  } ?>
        <?php if(cv('commission.apply.pay')) { ?>
        <?php  if(empty($apply['type'])) { ?>
        <input type="submit" name="submit_pay" value="打款到余额账户" class="btn btn-primary"  style='margin-left:10px;' onclick='return pay_credit()'/>
        <?php  } else if($apply['type'] == 1) { ?>
        <input type="submit" name="submit_pay" value="打款到微信钱包" class="btn btn-primary" style='margin-left:10px;' onclick='return pay_weixin()'/>
        <?php  } else if($apply['type'] == 2) { ?>
        <input type="submit" name="submit_pay" value="确认打款到支付宝" class="btn btn-primary" style='margin-left:10px;' onclick='return pay_alipay()'/>
        <?php  } else if($apply['type'] == 3) { ?>
        <input type="submit" name="submit_pay" value="确认打款到银行卡" class="btn btn-primary" style='margin-left:10px;' onclick='return pay_bank()'/>

        <?php  } ?>
        <input type="submit" name="submit_pay" value="手动处理" class="btn btn-warning" style='margin-left:10px;' onclick='return payed()'/>
        <?php  } ?>
        <?php  } ?>
        <?php  if($apply['status']==-1) { ?>
        <?php if(cv('commission.apply.cancel')) { ?>
        <input type="submit" name="submit_cancel" value="重新审核" class="btn btn-default"  onclick='return cancel()'/>
        <?php  } ?>

        <?php  } ?>

        <input type="button" class="btn btn-default" name="submit" onclick="history.go(-1)" value="返回" style='margin-left:10px;' />

    </div>
</form>
<script language='javascript'>
    function checkall(ischeck) {
        var val = ischeck ? 2 : -1;

        $('.status1,.status2,.status3').each(function () {
            $(this).closest('.input-group-addon').find(":radio[value='" + val + "']").get(0).checked = true;
        });
    }
    function check() {
        var pass = true;
        $('.status1,.status2,.status3').each(function () {
            if (!$(this).get(0).checked && !$(this).parent().next().find(':radio').get(0).checked) {
                tip.msgbox.err('请选择审核状态!');
                $(this).closest('.input-group-addon').popover({
                    container: $(document.body),
                    placement: 'top',
                    html: true,
                    content: "<span class='text-danger'>请选择审核状态</span>"
                }).popover('show');
                $(this).focus();
                pass = false;
                return false;
            } else {
                $(this).closest('.input-group-addon').popover('destroy');
            }
        });
        if (!pass) {
            return false;
        }
        $(':input[name=r]').val('commission.apply.check');
        return confirm('确认已核实成功并要提交?\r\n(提交后还可以撤销审核状态, 申请将恢复到申请状态)');
    }
    function refuse() {
        $(':input[name=r]').val('commission.apply.refuse');
        return confirm('确认驳回申请?\r\n( 分销商可以重新提交提现申请)');
    }
    function cancel() {
       $(':input[name=r]').val('commission.apply.cancel');
        return confirm('确认撤销审核?\r\n( 所有状态恢复到申请状态)');
    }
    function pay_credit() {
        $(':input[name=r]').val('commission.apply.pay');
        return confirm('确认打款到此用户的余额账户?');
    }
    function pay_weixin() {
        $(':input[name=r]').val('commission.apply.pay');
        return confirm('确认打款到此用户的微信钱包?');
    }
    function pay_alipay() {
        $(':input[name=r]').val('commission.apply.pay');
        return confirm('确认打款到此用户的支付宝? 姓名:' + $("#realname").html() + ' 支付宝帐号:' + $("#alipay").html());
    }

    function pay_bank() {
        $(':input[name=r]').val('commission.apply.pay');
        return confirm('确认打款到此用户的银行卡? ' + $("#bankname").html() + ' 姓名: 卡号:' + $("#bankcard").html());
    }

    function payed() {
        $(':input[name=r]').val('commission.apply.payed');
        return confirm('选择手动处理 , 系统不进行任何打款操作!\r\n请确认你已通过线下方式为用户打款!!!\r\n是否进行手动处理 ');
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>