<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> <h2>交易设置</h2> </div>

<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >
    <div class='form-group-title'>线下核销设置</div>
    <div class="form-group">
        <label class="col-sm-2 control-label">线下核销是否填写联系人</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('creditshop.set.edit')) { ?>
            <label class='radio radio-inline'>
                <input type='radio' value='1' name='data[set_realname]' <?php  if($data['set_realname']==1) { ?>checked<?php  } ?> /> 隐藏
            </label>
            <label class='radio radio-inline'>
                <input type='radio' value='0' name='data[set_realname]'  <?php  if($data['set_realname']==0) { ?>checked<?php  } ?> /> 显示
            </label>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if($data['set_realname']==1) { ?>隐藏<?php  } else { ?>显示<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">线下核销是否填写联系方式</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('creditshop.set.edit')) { ?>
            <label class='radio radio-inline'>
                <input type='radio' value='1' name='data[set_mobile]' <?php  if($data['set_mobile']==1) { ?>checked<?php  } ?> /> 隐藏
            </label>
            <label class='radio radio-inline'>
                <input type='radio' value='0' name='data[set_mobile]'  <?php  if($data['set_mobile']==0) { ?>checked<?php  } ?> /> 显示
            </label>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if($data['set_mobile']==1) { ?>隐藏<?php  } else { ?>显示<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class='form-group-title'>自动关闭未付款订单</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">下单几天后</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div class="input-group">
                <input type="text" name="data[closeorder]" class="form-control" value="<?php  echo $data['closeorder'];?>" />
                <div class="input-group-addon">天</div>
            </div>
            <span class='help-block'>订单下单未付款，n天后自动关闭，空为不自动关闭</span>
            <?php  } else { ?>
            <input type="hidden" name="data[closeorder]" value="<?php  echo $data['closeorder'];?>"/>
            <div class='form-control-static'>
                <?php  if(empty($data['closeorder'])) { ?>9<?php  } else { ?><?php  echo $data['closeorder'];?><?php  } ?> 天
            </div>
            <?php  } ?>
        </div>
    </div>

    <div class='form-group-title'>未付款订单关闭前发送推送信息</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">订单关闭前</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div class="input-group">
                <input type="text" name="data[willcloseorder]" class="form-control" value="<?php  echo $data['willcloseorder'];?>" />
                <div class="input-group-addon">分钟</div>
            </div>
            <span class='help-block'>订单下单未付款自动关闭前多少分钟发送推送消息，0或空为默认30分钟。需要前往消息提醒设置中开启对应推送模块</span>
            <?php  } else { ?>
            <input type="hidden" name="data[willcloseorder]" value="<?php  echo $data['willcloseorder'];?>"/>
            <div class='form-control-static'>
                <?php  if(empty($data['willcloseorder'])) { ?>30<?php  } else { ?><?php  echo $data['willcloseorder'];?><?php  } ?> 分钟
            </div>
            <?php  } ?>
        </div>
    </div>

    <div class='form-group-title'>自动收货</div>


    <div class="form-group">
        <label class="col-sm-2 control-label">发货几天后</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div class="input-group">
                <input type="text" name="data[receive]" class="form-control" value="<?php  echo $data['receive'];?>" />
                <div class="input-group-addon">天</div>
            </div>
            <span class='help-block'>订单发货后，用户收货的天数，如果在期间未确认收货，系统自动完成收货，空为不自动收货</span>
            <?php  } else { ?>
            <input type="hidden" name="data[receive]" value="<?php  echo $data['receive'];?>"/>
            <div class='form-control-static'>
                <?php  if(empty($data['receive'])) { ?>9<?php  } else { ?><?php  echo $data['receive'];?><?php  } ?> 天
            </div>
            <?php  } ?>
        </div>
    </div>
    <div class='form-group-title'>退款申请</div>


    <div class="form-group">
        <label class="col-sm-2 control-label">完成订单几天后</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div class="input-group">
                <input type="text" name="data[refunddays]" class="form-control" value="<?php  echo $data['refunddays'];?>" />
                <div class="input-group-addon">天</div>
            </div>
            <span class='help-block'>订单完成后 ，用户在x天内可以发起退款申请，设置0天不允许完成订单退款</span>
            <?php  } else { ?>
            <input type="hidden" name="data[refunddays]" value="<?php  echo $data['refunddays'];?>"/>
            <div class='form-control-static'>
                <?php  if(empty($data['refunddays'])) { ?>不允许完成订单退款<?php  } else { ?><?php  echo $data['refunddays'];?><?php  } ?> 天
            </div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">退款说明</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <textarea  name="data[refundcontent]" class="form-control" value="<?php  echo $data['refundcontent'];?>" ><?php  echo $data['refundcontent'];?></textarea>
            <span class='help-block'>用户在申请退款页面的说明</span>
            <?php  } else { ?>
            <input type="hidden" name="data[refundcontent]" value="<?php  echo $data['refundcontent'];?>"/>
            <div class='form-control-static'>
                <?php  echo $data['refundcontent'];?>
            </div>
            <?php  } ?>
        </div>
    </div>
    <div class='form-group-title'>余额积分设置</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">文字</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div class='input-group'>
                <span class='input-group-addon'>积分=</span>
                <input type="text" name="data[credittext]" class="form-control" value="<?php echo empty($data['credittext'])?'积分':$data['credittext']?>" />
                <span class='input-group-addon'>余额=</span>
                <input type="text" name="data[moneytext]" class="form-control"value="<?php echo empty($data['moneytext'])?'余额':$data['moneytext']?>" />
            </div>
            <?php  } else { ?>

            <div class='form-control-static'>
                积分文字:  <?php echo empty($data['credittext'])?'积分':$data['credittext']?> 余额文字: <?php echo empty($data['moneytext'])?'余额':$data['moneytext']?>

            </div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">账户充值</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <label class='radio-inline'><input type='radio' name='data[closerecharge]' value='0' <?php  if(empty($data['closerecharge'])) { ?>checked<?php  } ?> onclick="$('.recharge-group').show()"/> 开启</label>
            <label class='radio-inline'><input type='radio' name='data[closerecharge]' value='1' <?php  if($data['closerecharge']=='1') { ?>checked<?php  } ?>  onclick="$('.recharge-group').hide()"/> 关闭</label>
            <span class='help-block'>是否允许用户对账户余额进行充值</span>
            <?php  } else { ?>
            <input type="hidden" name="data[withdraw]" value="<?php  echo $data['withdraw'];?>"/>
            <div class='form-control-static'><?php  if($data['closerechage']==1) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group recharge-group" <?php  if($data['closerecharge']=='1') { ?>style="display:none;"<?php  } ?>>
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('sysset.trade.edit')) { ?>
        <div class='input-group'>
            <span class='input-group-addon'>充值</span>
            <input type="text" name="data[money]" class="form-control" value="<?php  echo $data['money'];?>" />
            <span class='input-group-addon'>元 增加</span>
            <input type="text" name="data[credit]" class="form-control" value="<?php  echo $data['credit'];?>" />
            <span class='input-group-addon'>分</span>
        </div>
        <span class='help-block'>用户充值获得的积分,累计形式 比如 充值1元 送1积分,充值200，就送200积分</span>
        <?php  } else { ?>
        <input type="hidden" name="data[money]" value="<?php  echo $data['money'];?>"/>
        <input type="hidden" name="data[credit]" value="<?php  echo $data['credit'];?>"/>
        <div class='form-control-static'>
            <?php  if(empty($data['money'])) { ?>
            充值无积分
            <?php  } else { ?>
            <?php  echo $data['money'];?> 元增加 <?php  echo $data['credit'];?> 积分
            <?php  } ?>
        </div>
        <?php  } ?>
    </div>
    </div>

    <div class="form-group recharge-group" <?php  if($data['closerecharge']=='1') { ?>style="display:none;"<?php  } ?>>
        <label class="col-sm-2 control-label">最低充值金额</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div class="input-group">
                <input type="text" name="data[minimumcharge]" class="form-control" value="<?php  echo $data['minimumcharge'];?>" />
                <div class="input-group-addon">元</div>
            </div>
            <span class='help-block'>账户充值时,最低允许的充值金额</span>
            <span class='help-block'>例如 最低充值金额设置为10元,只有充值金额大于等于10元时,才允许充值</span>
            <?php  } else { ?>
            <input type="hidden" name="data[minimumcharge]" value="<?php  echo $data['minimumcharge'];?>"/>
            <div class='form-control-static'>
                <?php  echo $data['minimumcharge'];?>元
            </div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">余额提现</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <label class='radio-inline'><input type='radio' name='data[withdraw]' value='1' <?php  if($data['withdraw']==1) { ?>checked<?php  } ?>/> 开启</label>
            <label class='radio-inline'><input type='radio' name='data[withdraw]' value='0' <?php  if($data['withdraw']==0) { ?>checked<?php  } ?> /> 关闭</label>
            <span class='help-block'>是否允许用户将余额提出</span>
            <?php  } else { ?>
            <input type="hidden" name="data[withdraw]" value="<?php  echo $data['withdraw'];?>"/>
            <div class='form-control-static'><?php  if($data['withdraw']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">余额提现方式</label>
        <div class="col-sm-9 col-xs-12" >
            <?php if(cv('sysset.trade.edit')) { ?>
            <label for="withdrawcashweixin" class="checkbox-inline">
                <input type="checkbox" name="data[withdrawcashweixin]" value="1" id="withdrawcashweixin" <?php  if(!empty($data['withdrawcashweixin'])) { ?>checked="true"<?php  } ?> /> 提现到微信钱包
            </label>

            <label for="withdrawcashalipay" class="checkbox-inline">
                <input type="checkbox" name="data[withdrawcashalipay]" value="1" id="withdrawcashalipay" <?php  if(!empty($data['withdrawcashalipay'])) { ?>checked="true"<?php  } ?> /> 手动提现到支付宝
            </label>

            <label for="withdrawcashcard" class="checkbox-inline">
                <input type="checkbox" name="data[withdrawcashcard]" value="1" id="withdrawcashcard" <?php  if(!empty($data['withdrawcashcard'])) { ?>checked="true"<?php  } ?> /> 手动提现到银行卡
            </label>

            <div class='help-block'>支持的银行请到<a href='<?php  echo webUrl('commission/bank')?>' target='_blank'>【银行设置】</a>进行设置,使用手动提现到银行卡必须设置支持的银行</div>

            <div class='help-block'>提示: 提现方式支持多选</div>
            <?php  } else { ?> <div class='form-control-static'>
            <?php  if($data['withdrawcashweixin']==1) { ?>提现到微信钱包; <?php  } ?>
            <?php  if($data['withdrawcashalipay']==1) { ?>手动提现到支付宝; <?php  } ?>
            <?php  if($data['withdrawcashcard']==1) { ?>手动提现到银行卡; <?php  } ?>
        </div>
            <?php  } ?>
        </div>
    </div>



    <div class="form-group">
        <label class="col-sm-2 control-label">余额提现限制</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <input type="text" name="data[withdrawmoney]" class="form-control" value="<?php  echo $data['withdrawmoney'];?>" />
            <span class='help-block'>余额满多少才能提现,空或0不限制</span>
            <?php  } else { ?>
            <input type="hidden" name="data[withdrawmoney]" value="<?php  echo $data['withdrawmoney'];?>"/>
            <div class='form-control-static'>
                <?php  if(empty($data['withdrawmoney'])) { ?>不限制<?php  } else { ?><?php  echo $data['withdrawmoney'];?> 元 <?php  } ?>
            </div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">余额提现手续费</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div class="input-group">
                <input type="text" name="data[withdrawcharge]" class="form-control" value="<?php  echo $data['withdrawcharge'];?>" />
                <div class="input-group-addon">%</div>
            </div>
            <span class='help-block'>余额提现时,扣除的手续费.空为不扣除手续费</span>
            <?php  } else { ?>
            <input type="hidden" name="data[withdrawcharge]" value="<?php  echo $data['withdrawcharge'];?>"/>
            <div class='form-control-static'>
                <?php  echo $data['withdrawcharge'];?>%
            </div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">免手续费金额区间</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div class='input-group'>
                <span class='input-group-addon'>开始金额￥</span>
                <input type="text" name="data[withdrawbegin]" class="form-control" value="<?php  echo $data['withdrawbegin'];?>" />
                <span class='input-group-addon'>结束金额￥</span>
                <input type="text" name="data[withdrawend]" class="form-control" value="<?php  echo $data['withdrawend'];?>" />
            </div>
            <span class='help-block'>当手续费金额在此区间内时,不扣除手续费. 结束金额 必须大于 开始金额才能生效</span>
            <span class='help-block'>例如 设置开始金额0元 结束金额5元,只有手续费金额高于5元时,才扣除</span>
            <?php  } else { ?>
            <input type="hidden" name="data[withdrawbegin]" value="<?php  echo $data['withdrawbegin'];?>"/>
            <input type="hidden" name="data[withdrawend]" value="<?php  echo $data['withdrawend'];?>"/>
            <div class='form-control-static'>
                <?php  echo $data['withdrawbegin'];?> 元 - <?php  echo $data['withdrawend'];?>元
            </div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group recharge-group">
        <label class="col-sm-2 control-label">会员积分上限</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
                <div class="input-group">
                    <input type="number" name="data[maxcredit]" class="form-control" value="<?php  echo intval($data['maxcredit'])?>" />
                    <div class="input-group-addon">积分</div>
                </div>
                <span class='help-block text-danger'>会员最高积分，0为不限制(会员积分大于等于此值时将无法继续增加，后台手动充值不限制，已持有积分不限制)</span>
            <?php  } else { ?>
                <input type="hidden" name="data[maxcredit]" value="<?php  echo $data['maxcredit'];?>"/>
                <div class='form-control-static'>
                    <?php  echo $data['maxcredit'];?>积分
                </div>
            <?php  } ?>
        </div>
    </div>

    <div class='form-group-title'>评价</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">订单评价</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <label class='radio-inline'><input type='radio' name='data[closecomment]' value='0' <?php  if(empty($data['closecomment'])) { ?>checked<?php  } ?> /> 允许</label>
            <label class='radio-inline'><input type='radio' name='data[closecomment]' value='1' <?php  if($data['closecomment']=='1') { ?>checked<?php  } ?>  /> 不允许</label>
            <span class='help-block'>是否允许用户对订单进行评价</span>
            <?php  } else { ?>
            <input type="hidden" name="data[closecomment]" value="<?php  echo $data['closecomment'];?>"/>
            <div class='form-control-static'><?php  if($data['closecomment']==1) { ?>不允许<?php  } else { ?>允许<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">显示评价 </label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <label class='radio-inline'><input type='radio' name='data[closecommentshow]' value='0' <?php  if(empty($data['closecommentshow'])) { ?>checked<?php  } ?>/> 显示</label>
            <label class='radio-inline'><input type='radio' name='data[closecommentshow]' value='1' <?php  if($data['closecommentshow']=='1') { ?>checked<?php  } ?> /> 关闭</label>
            <span class='help-block'>是否允许商品详情页面显示评价</span>
            <?php  } else { ?>
            <input type="hidden" name="data[closecommentshow]" value="<?php  echo $data['closecommentshow'];?>"/>
            <div class='form-control-static'><?php  if($data['closecommentshow']==1) { ?>关闭<?php  } else { ?>显示<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">评价免审核 </label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <label class='radio-inline'><input type='radio' name='data[commentchecked]' value='1' <?php  if($data['commentchecked']=='1') { ?>checked<?php  } ?> /> 是</label>
            <label class='radio-inline'><input type='radio' name='data[commentchecked]' value='0' <?php  if(empty($data['commentchecked'])) { ?>checked<?php  } ?>/> 否</label>
            <span class='help-block'>用户发表的评价是否免审核</span>
            <?php  } else { ?>
            <input type="hidden" name="data[commentchecked]" value="<?php  echo $data['commentchecked'];?>"/>
            <div class='form-control-static'><?php  if($data['commentchecked']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class='form-group-title'>获取微信共享收货地址</div>



    <div class='panel-body'>

        <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('sysset.trade.edit')) { ?>
                <label class='radio-inline'><input type='radio' name='data[shareaddress]' value='0' <?php  if($data['shareaddress']==0) { ?>checked<?php  } ?> /> 关闭</label>
                <label class='radio-inline'><input type='radio' name='data[shareaddress]' value='1' <?php  if($data['shareaddress']==1) { ?>checked<?php  } ?>/> 开启</label>
                <span class='help-block'>是否在用户添加收货地址时候获取用户的微信收货地址</span>
                <?php  } else { ?>
                <input type="hidden" name="data[shareaddress]" value="<?php  echo $data['shareaddress'];?>"/>
                <div class='form-control-static'><?php  if($data['shareaddress']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>
    </div>


    <div class='form-group-title'>限时购名称</div>



    <div class='panel-body'>

        <div class="form-group">
            <label class="col-sm-2 control-label">限时购名称</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('sysset.trade.edit')) { ?>
                <input  name="data[istimetext]" class="form-control"  value="<?php echo empty($data['istimetext'])?'限时购':$data['istimetext']?>" />
                <span class='help-block'>商品详情页面限时购名称前缀 ,默认为"限时购" ,商品可单独设置</span>
                <?php  } else { ?>
                <input type="hidden" name="data[istimetext]" value="<?php  echo $data['istimetext'];?>"/>
                <div class='form-control-static'>
                    <?php  echo $data['istimetext'];?>
                </div>
                <?php  } ?>
            </div>
        </div>
    </div>


    <div class='form-group-title'>商城不配送区域</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">不配送区域</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <div id="areas" class="form-control-static"><?php  echo $data['nodispatchareas'];?></div>
            <a href="javascript:;" class="btn btn-default" onclick="selectAreas()">选择地区</a>
            <input type="hidden" id='selectedareas' name="data[nodispatchareas]" value="<?php  echo $data['nodispatchareas'];?>" />
            <input type="hidden" id='selectedareas_code' name="data[nodispatchareas_code]" value="<?php  echo $data['nodispatchareas_code'];?>" />
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $data['nodispatchareas'];?></div>
            <?php  } ?>
        </div>
    </div>



    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.trade.edit')) { ?>
            <input type="submit" value="提交" class="btn btn-primary"  />
            <?php  } ?>
        </div>
    </div>


</form>

<?php  if(empty($new_area)) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('shop/selectareas', TEMPLATE_INCLUDEPATH)) : (include template('shop/selectareas', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('shop/selectareasNew', TEMPLATE_INCLUDEPATH)) : (include template('shop/selectareasNew', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     