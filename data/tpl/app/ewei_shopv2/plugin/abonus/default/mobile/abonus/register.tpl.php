<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('abonus/common', TEMPLATE_INCLUDEPATH)) : (include template('abonus/common', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "<?php  echo $this->set['texts']['become']?>"; </script>
<div class='fui-page fui-page-current page-abonus-register'>
    <?php  if(is_h5app()) { ?>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">成为区域代理商</div>
        <div class="fui-header-right"></div>
    </div>
    <?php  } ?>
    <div class='fui-content'>
        <img style='width:100%;position: relative' src="<?php  if(empty($set['regbg'])) { ?>../addons/ewei_shopv2/plugin/abonus/template/mobile/default/static/images/bg.png<?php  } else { ?><?php  echo tomedia($set['regbg'])?><?php  } ?>" />
        <?php  if(empty($set['become'])) { ?>
        <div class='content-empty' >
            <i class='icon icon-money text-warning'></i>
            <br/><span class="text-default"><?php  if(empty($set['noregdesc'])) { ?>
			想成为区域代理商吗？请立即联系我们！
			<?php  } else { ?>
			<?php  echo $set['noregdesc'];?>
			<?php  } ?>
			<br/>

		</span>
            <br/><a class="btn btn-warning" href="<?php  echo mobileUrl()?>">去商城逛逛</a>
        </div>

        <?php  } else { ?>


        <?php  if($member['aagentblack']) { ?>
        <div class='content-empty' >
            <i class='icon icon-info text-danger'></i>
            <br/><span class="text-danger">禁止访问，请联系客服！</span>
            <br/><a class="btn btn-danger" href="<?php  echo mobileUrl()?>">去商城逛逛</a>
        </div>

        <?php  } else { ?>

        <?php  if($member['aagentstatus']==1 && $member['isaagent']==1) { ?>
        <div class='content-info'>
            <i class='icon icon-roundcheck text-success'></i>
            <br/><span class="text-success">您的申请已经审核通过！</span>
            <br/><a class="btn btn-danger" href="<?php  echo mobileUrl()?>">去商城逛逛</a>
        </div>
        <?php  } ?>
        <?php  if($member['aagentstatus']==0 && $member['isaagent']==1) { ?>
        <div class='content-info' >
            <i class='icon icon-time'></i>
            <br/><span class="">谢谢您的支持，我们会尽快联系您!</span>
            <br/><a class="btn btn-danger" href="<?php  echo mobileUrl()?>">去商城逛逛</a>
        </div>
        <?php  } ?>


        <?php  if(empty($member['aagentstatus']) &&  empty($member['isaagent']) && $set['become']=='1') { ?>
        <div class="fui-cell-group" style='margin-top:0'>
            <div class="fui-cell-title">
                欢迎加入<span class='text-danger'><?php  echo $_W['shopset']['shop']['name'];?></span>，请填写申请信息
            </div>

            <?php  if($template_flag) { ?>

            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/formfields', TEMPLATE_INCLUDEPATH)) : (include template('diyform/formfields', TEMPLATE_INCLUDEPATH));?>

            <?php  } else { ?>

            <div class='fui-cell must'>
                <div class='fui-cell-label'>姓名</div>
                <div class='fui-cell-info'><input type="text" class='fui-input' id='realname' placeholder="请填写真实姓名，用于结算" value="<?php  echo $member['realname'];?>" /></div>
            </div>

            <div class='fui-cell must'>
                <div class='fui-cell-label'>手机号</div>
                <div class='fui-cell-info'><input type="tel" class='fui-input' id='mobile' placeholder="请填写手机号码方便联系" value="<?php  echo $member['mobile'];?>" /></div>
            </div>

            <div class='fui-cell'>
                <div class='fui-cell-label'>微信号</div>
                <div class='fui-cell-info'><input type="text" class='fui-input' id='weixin' placeholder="请填写微信号" value="<?php  echo $member['weixin'];?>" /></div>
            </div>

            <div class='fui-cell'>
                <div class='fui-cell-label'>代理类型</div>
                <div class='fui-cell-info'>
                    <label class="radio-inline">
                        <input type="radio" class='fui-radio fui-radio-warning' name='aagenttype' value='1'/> 省级
                    </label>
                    <label class="radio-inline">
                        <input type="radio" class='fui-radio fui-radio-warning' name='aagenttype'  value="2"/> 市级
                    </label>
                    <label class="radio-inline">
                        <input type="radio" class='fui-radio fui-radio-warning' name='aagenttype'  value="3"/> 区级
                    </label>
                </div>
            </div>

            <div class='fui-cell' id="div_province" style="display:none;">
                <div class='fui-cell-label'>代理省份</div>
                <div class='fui-cell-info'>
                    <input type="text" class='fui-input' id="citypicker1" placeholder="请选择代理省份"  readonly/>
                </div>
            </div>

            <div class='fui-cell' id="div_city"  style="display:none;">
                <div class='fui-cell-label'>代理城市</div>
                <div class='fui-cell-info'>
                    <input type="text" class='fui-input' id="citypicker2" placeholder="请选择代理城市"  readonly/>
                </div>
            </div>

            <div class='fui-cell' id="div_area"  style="display:none;">
                <div class='fui-cell-label'>代理地区</div>
                <div class='fui-cell-info'>
                    <input type="text" class='fui-input' id="citypicker3" placeholder="请选择代理地区"  readonly/>
                </div>
            </div>


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

            <div class="pop-apply-hidden" style="display: none;">
                <div class="verify-pop pop">
                    <div class="close"><i class="icon icon-roundclose"></i></div>
                    <div class="qrcode">
                        <div class="inner">
                            <div class="title"><?php  echo $set['applytitle'];?></div>
                            <div class="text"><?php  echo $set['applycontent'];?></div>
                        </div>
                        <div class="inner-btn" style="padding: 0.5rem;">
                            <div class="btn btn-warning" style="width: 100%; margin: 0;">我已阅读</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  } ?>


        </div>
        <div class='btn btn-warning block btn-submit'>申请成为<?php  echo $this->set['texts']['agent']?></div>


        <div class='fui-list-group vip-group'>

            <?php  if(empty($set['register_bottom'])) { ?>

            <div class='fui-list'>
                <div class='fui-list-media '><i class='icon icon-vip'></i></div>
                <div class='fui-list-inner'>
                    <div class='subtitle'><?php  echo $this->set['texts']['agent']?>特权</div>
                </div>
            </div>

            <div class='fui-list'>
                <div class='fui-list-media'><i class='icon icon-shengfen text-danger'></i></div>
                <div class='fui-list-inner'>
                    <div class='subtitle'>坐享<?php  echo $this->set['texts']['bonus']?></div>
                    <div class='text'>成为<?php  echo $this->set['texts']['agent']?>后，您可以享受您代理的区域营业额的<?php  echo $this->set['texts']['bonus']?>收益</div>
                </div>
            </div>
            <?php  } else if($set['register_bottom'] == 1) { ?>

                <?php  if(!empty($set['register_bottom_title1']) || !empty($set['register_bottom_content1'])) { ?>
                <div class='fui-list'>
                    <div class='fui-list-media '><i class='icon icon-vip'></i></div>
                    <div class='fui-list-inner'>
                        <div class='subtitle'><?php  echo $set['register_bottom_title1'];?></div>
                        <div class='text'><?php  echo $set['register_bottom_content1'];?></div>
                    </div>
                </div>
                <?php  } ?>

                <?php  if(!empty($set['register_bottom_title2']) || !empty($set['register_bottom_content2'])) { ?>
                <div class='fui-list'>
                    <div class='fui-list-media '><i class='icon icon-shengfen text-danger'></i></div>
                    <div class='fui-list-inner'>
                        <div class='subtitle'><?php  echo $set['register_bottom_title2'];?></div>
                        <div class='text'><?php  echo $set['register_bottom_content2'];?></div>
                    </div>
                </div>
                <?php  } ?>

                <?php  if(!empty($set['register_bottom_remark'])) { ?>
                <div class='fui-list'>
                    <div class='fui-list-inner'>
                        <div class='text'><?php  echo $set['register_bottom_remark'];?></div>
                    </div>
                </div>
                <?php  } ?>

            <?php  } else if($set['register_bottom'] == 2) { ?>
            <div class="row">
                <?php  echo $set['register_bottom_content'];?>
            </div>
            <?php  } ?>
        </div>




        <?php  } ?>

        <?php  } ?>

        <?php  } ?>



    </div>
    <script language="javascript">
        require(['../addons/ewei_shopv2/plugin/abonus/static/js/register.js'], function (modal) {
            modal.init(<?php  echo json_encode($apply_set)?>);

        })
    </script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
