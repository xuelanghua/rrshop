<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merch/common', TEMPLATE_INCLUDEPATH)) : (include template('merch/common', TEMPLATE_INCLUDEPATH));?>
<div class="fui-page page-merch-register">
    <div class="fui-content">

        <img class="regbg" src="<?php  if(empty($set['regbg'])) { ?>../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png<?php  } else { ?><?php  echo tomedia($set['regbg'])?><?php  } ?>"/>

        <?php  if(!empty($user)) { ?>

        <?php  } else { ?>

                <?php  if(!empty($reg)) { ?>

                        <?php  if($reg['status']==-1) { ?>

                        <div class="fui-alert fui-alert-danger">
                            <p>您的申请被驳回：</p>
                            <p><?php  echo $reg['reason'];?></p>
                            <p>您也可以修改信息重新提交</p>
                        </div>

                        <?php  } else { ?>
                        <div class="fui-alert fui-alert-warning">
                            <p>您已经提交了信息，请等待我们联系您!</p>
                            <p>您也可以修改信息重新提交</p>
                        </div>
                        <?php  } ?>
                <?php  } ?>

        <div class="fui-cell-group">
            <div class="fui-cell must ">
                <div class="fui-cell-label">商户名称</div>
                <div class="fui-cell-info"><input type="text" class="fui-input" id="merchname" placeholder="商户名称" value="<?php  echo $reg['merchname'];?>"/></div>
            </div>
            <div class="fui-cell must ">
                <div class="fui-cell-label">主营项目</div>
                <div class="fui-cell-info"><input type="text" class="fui-input" id="salecate" placeholder="例如鞋帽, 化妆品等" value="<?php  echo $reg['salecate'];?>"/></div>
            </div>
            <div class="fui-cell ">
                <div class="fui-cell-label">简单介绍</div>
                <div class="fui-cell-info"><textarea id="desc" placeholder="简单介绍下商户"><?php  echo $reg['desc'];?></textarea></div>
            </div>

        </div>
        <div class="fui-cell-group">
            <div class="fui-cell must ">
                <div class="fui-cell-label">联系人</div>
                <div class="fui-cell-info"><input type="text" class="fui-input" id="realname" placeholder="您的称呼" value="<?php  echo $reg['realname'];?>"></div>
            </div>
            <div class="fui-cell must ">
                <div class="fui-cell-label">手机号</div>
                <div class="fui-cell-info"><input type="tel" class="fui-input" id="mobile" placeholder="您的手机号" value="<?php  echo $reg['mobile'];?>"/></div>
            </div>
            <div class="fui-cell-tip">请仔细填写联系方式，保证我们能尽快联系到您~</div>

        </div>

                <?php  if($template_flag) { ?>

                <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/formfields', TEMPLATE_INCLUDEPATH)) : (include template('diyform/formfields', TEMPLATE_INCLUDEPATH));?>

                <?php  } ?>


                <?php  if($set['open_protocol'] == 1) { ?>
                <div class="fui-cell-group">
                    <div class="fui-cell small ">
                        <div class="fui-cell-info">

                            <label class="checkbox-inline">
                                <input type="checkbox" class="fui-checkbox-primary" id="agree" <?php  if(!empty($reg)) { ?>checked<?php  } ?>/> 我已经阅读并了解了<a id="btn-apply" style="color:#337ab7;">【<?php  echo $apply_set['applytitle'];?>】</a>。
                            </label>

                        </div>
                    </div>

                </div>
                <?php  } ?>

                <a class="btn btn-warning btn-submit block"> <?php  if(empty($reg)) { ?>立即申请入驻<?php  } else { ?>重新提交申请<?php  } ?></a>
        <?php  } ?>

        <div class="pop-apply-hidden" style="display: none;">
            <div class="verify-pop pop">
                <div class="close"><i class="icon icon-roundclose"></i></div>
                <div class="qrcode">
                    <div class="inner">
                        <div class="title"><?php  echo $set['applytitle'];?></div>
                        <div class="text"><?php  echo $set['applycontent'];?></div>
                    </div>
                    <div class="inner-btn" style="padding: 0.5rem">
                        <div class="btn btn-warning" style="width: 100%; margin: 0">我已阅读</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script language="javascript">
        require(['../addons/ewei_shopv2/plugin/merch/static/js/register.js'], function (modal) {
            modal.init(<?php  echo json_encode($apply_set)?>);
        })
    </script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
