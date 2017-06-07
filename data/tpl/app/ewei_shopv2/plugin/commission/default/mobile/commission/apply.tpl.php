<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "<?php  echo $this->set['texts']['center']?>"; </script>
<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">申请<?php  echo $this->set['texts']['withdraw']?></div>

    </div>
    <div class='fui-content navbar' >
        <div class='fui-cell-group'>

            <div class='fui-cell'>
                <div class='fui-cell-info'>我的<?php  echo $this->set['texts']['commission_ok']?></div>
            </div>
            <div class='fui-cell'>
                <div class='fui-cell-label big' style='width:auto;font-size:1.2rem;'>￥</div>
                <div class='fui-cell-info' style='font-size:1.2rem;' id='current'><?php  echo number_format($commission_ok,2)?></div>
            </div>

            <div class="fui-cell">
                <div class="fui-cell-label" style="width: 120px;"><span class="re-g">提现方式</span></div>
                <div class="fui-cell-info">

                    <select id="applytype">
                        <?php  if(is_array($type_array)) { foreach($type_array as $key => $value) { ?>
                        <option value="<?php  echo $key;?>" <?php  if(!empty($value['checked'])) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div class="fui-cell-remark"></div>
            </div>

            <?php  if(!empty($type_array['2']) || !empty($type_array['3'])) { ?>
            <div class="fui-cell ab-group" <?php  if(empty($type_array[2]['checked']) || empty($type_array[3]['checked']) ) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">姓名</div>
                <div class="fui-cell-info"><input type="text" id="realname" name="realname" class='fui-input' value="<?php  echo $last_data['realname'];?>" max="25"/></div>
            </div>
            <?php  } ?>

            <?php  if(!empty($type_array['2'])) { ?>
            <div class="fui-cell alipay-group" <?php  if(empty($type_array[2]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">支付宝帐号</div>
                <div class="fui-cell-info"><input type="text" id="alipay" name="alipay" class='fui-input' value="<?php  echo $last_data['alipay'];?>" max="25"/></div>
            </div>

            <div class="fui-cell alipay-group" <?php  if(empty($type_array[2]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">确认帐号</div>
                <div class="fui-cell-info"><input type="text" id="alipay1" name="alipay1" class='fui-input' value="<?php  echo $last_data['alipay'];?>" max="25"/></div>
            </div>
            <?php  } ?>

            <?php  if(!empty($type_array['3'])) { ?>
            <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;"><span class="re-g">选择银行</span></div>
                <div class="fui-cell-info">

                    <select id="bankname">
                        <?php  if(is_array($banklist)) { foreach($banklist as $key => $value) { ?>
                        <option value="<?php  echo $bankname;?>" <?php  if(!empty($last_data) && $last_data['bankname'] == $value['bankname']) { ?>selected<?php  } ?>><?php  echo $value['bankname'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div class="fui-cell-remark"></div>
            </div>

            <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">银行卡号</div>
                <div class="fui-cell-info"><input type="text" id="bankcard" name="bankcard" class='fui-input' value="<?php  echo $last_data['bankcard'];?>" max="25"/></div>
            </div>

            <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">确认卡号</div>
                <div class="fui-cell-info"><input type="text" id="bankcard1" name="bankcard1`" class='fui-input' value="<?php  echo $last_data['bankcard'];?>" max="25"/></div>
            </div>
            <?php  } ?>

        </div>

        <a class='btn btn-success block btn-submit <?php  if(!$cansettle) { ?>disabled<?php  } ?>' data-type="1">下一步</a>

        <div class='fui-cell-group' <?php  if(empty($set_array['charge'])) { ?>style="display: none;"<?php  } ?>>
            <div class='fui-cell'>
                <div class='fui-cell-info' id="chargeinfo">查看详细信息</div>
            </div>

            <?php  if(!empty($set_array['charge'])) { ?>
            <div class='fui-cell charge-group' style="display: none;">
                <div class='fui-cell-info'>佣金提现<?php  echo $this->set['texts']['commission_charge']?> <?php  echo $set_array['charge'];?>%</div>
            </div>
            <?php  } ?>

            <?php  if(!empty($set_array['end'])) { ?>
            <div class='fui-cell charge-group' style="display: none;">
                <div class='fui-cell-info'> <?php  echo $this->set['texts']['commission_charge']?>金额在￥<?php  echo $set_array['begin'];?>到￥<?php  echo $set_array['end'];?>间免收</div>
            </div>
            <?php  } ?>

            <?php  if(!empty($deductionmoney)) { ?>
            <div class='fui-cell charge-group' style="display: none;">
                <div class='fui-cell-info'>本次提现将<?php  echo $this->set['texts']['commission_charge']?>金额 ￥ <?php  echo $deductionmoney;?></div>
            </div>
            <?php  } ?>

            <?php  if(!empty($set_array['charge'])) { ?>
            <div class='fui-cell charge-group' style="display: none;">
                <div class='fui-cell-info'>本次提现实际到账金额 ￥ <?php  echo $realmoney;?></div>
            </div>
            <?php  } ?>

        </div>

    </div>
    <script language='javascript'>
        require(['../addons/ewei_shopv2/plugin/commission/static/js/apply.js'], function (modal) {
            modal.init({
                withdraw:<?php  echo floatval($withdraw)?>
            });
        });
    </script>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
