<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group cashother-group">
    <label class="col-sm-2 control-label">其他提现方式</label>
    <div class="col-sm-9 col-xs-12" >
        <?php if(cv('cashier.set.edit')) { ?>
        <label for="cashalipay" class="checkbox-inline">
            <input type="checkbox" name="data[cashalipay]" value="1" id="cashalipay" <?php  if(!empty($data['cashalipay'])) { ?>checked="true"<?php  } ?> /> 手动提现到支付宝
        </label>
        <label for="cashcard" class="checkbox-inline">
            <input type="checkbox" name="data[cashcard]" value="1" id="cashcard" <?php  if(!empty($data['cashcard'])) { ?>checked="true"<?php  } ?> /> 手动提现到银行卡
        </label>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if($data['cashalipay']==1) { ?>手动提现到支付宝; <?php  } ?>
            <?php  if($data['cashweixin']==1) { ?>手动提现到银行卡; <?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>

<!--<div class="form-group">
    <label class="col-sm-2 control-label">收银台提现手续费</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('cashier.set.edit')) { ?>
        <div class="input-group">
            <input type="text" name="data[withdrawcharge]" class="form-control" value="<?php  echo $data['withdrawcharge'];?>" />
            <div class="input-group-addon">%</div>
        </div>
        <span class="help-block">收银台提现时,扣除手续费</span>
        <?php  } else { ?>
        <?php echo empty($data['withdrawcharge'])?0:$data['withdrawcharge']?>%
        <?php  } ?>
    </div>
</div>-->

