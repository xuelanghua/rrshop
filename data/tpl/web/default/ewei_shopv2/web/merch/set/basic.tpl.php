<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-sm-2 control-label">是否开启多商户</label>
    <div class="col-sm-8">
        <?php if(cv('merch.set.edit')) { ?>
        <label class="radio-inline"><input type="radio"  name="data[is_openmerch]" value="0" <?php  if($data['is_openmerch'] ==0) { ?> checked="checked"<?php  } ?> /> 不开启</label>
        <label class="radio-inline"><input type="radio"  name="data[is_openmerch]" value="1" <?php  if($data['is_openmerch'] ==1) { ?> checked="checked"<?php  } ?> /> 开启</label>
        <div class='help-block'></div>
        <?php  } else { ?>
        <?php  if($data['apply_openweb'] ==0) { ?>不允许<?php  } else { ?>允许<?php  } ?>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">商户的可提现金额是否扣除分销佣金</label>
    <div class="col-sm-8">
        <?php if(cv('merch.set.edit')) { ?>
        <label class="radio-inline"><input type="radio"  name="data[deduct_commission]" value="0" <?php  if($data['deduct_commission'] ==0) { ?> checked="checked"<?php  } ?> /> 不扣除</label>
        <label class="radio-inline"><input type="radio"  name="data[deduct_commission]" value="1" <?php  if($data['deduct_commission'] ==1) { ?> checked="checked"<?php  } ?> /> 扣除</label>
        <div class='help-block'>例如: 订单金额100元,分销佣金10元<br>不扣除: 商户的可提现金额为100元<br>扣除: 商户的可提现金额为90元</div>
        <?php  } else { ?>
        <?php  if($data['deduct_commission'] ==0) { ?>不允许<?php  } else { ?>允许<?php  } ?>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">商户提现方式</label>
    <div class="col-sm-9 col-xs-12" >
        <?php if(cv('sysset.trade.edit')) { ?>
        <label for="applycashweixin" class="checkbox-inline">
            <input type="checkbox" name="data[applycashweixin]" value="1" id="applycashweixin" <?php  if(!empty($data['applycashweixin'])) { ?>checked="true"<?php  } ?> /> 提现到微信钱包
        </label>

        <label for="applycashalipay" class="checkbox-inline">
            <input type="checkbox" name="data[applycashalipay]" value="1" id="applycashalipay" <?php  if(!empty($data['applycashalipay'])) { ?>checked="true"<?php  } ?> /> 手动提现到支付宝
        </label>

        <label for="applycashcard" class="checkbox-inline">
            <input type="checkbox" name="data[applycashcard]" value="1" id="applycashcard" <?php  if(!empty($data['applycashcard'])) { ?>checked="true"<?php  } ?> /> 手动提现到银行卡
        </label>

        <div class='help-block'>支持的银行请到<a href='<?php  echo webUrl('commission/bank')?>' target='_blank'>【银行设置】</a>进行设置,使用手动提现到银行卡必须设置支持的银行</div>

        <div class='help-block'>提示: 提现方式支持多选</div>
        <?php  } else { ?> <div class='form-control-static'>
        <?php  if($data['applycashweixin']==1) { ?>提现到微信钱包; <?php  } ?>
        <?php  if($data['applycashalipay']==1) { ?>手动提现到支付宝; <?php  } ?>
        <?php  if($data['applycashcard']==1) { ?>手动提现到银行卡; <?php  } ?>
    </div>
        <?php  } ?>
    </div>
</div>