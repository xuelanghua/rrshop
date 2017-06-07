<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('commission/common', TEMPLATE_INCLUDEPATH)) : (include template('commission/common', TEMPLATE_INCLUDEPATH));?>
<div class="fui-page fui-page-current page-commission-shares">
    <?php  if(is_h5app()) { ?>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">推广二维码</div>
        <div class="fui-header-right"></div>
    </div>
    <?php  } ?>
    <div class="fui-content">
        <?php  if(!empty($goods)) { ?>
        <div class="fui-list-group">
            <div class="fui-list">
                <div class="fui-list-media">
                    <i class="icon icon-money"></i>
                </div>
                <div class="fui-list-inner">
                    <div class="row">
                        <div class="row-text">预计最高<?php  echo $this->set['texts']['commission1']?> <span class='text-danger'><?php  echo $commission;?></span> <?php  echo $this->set['texts']['yuan']?>
                        </div>
                    </div>
                    <div class="subtitle">已销售 <span><?php  echo $goods['sales'];?></span> 件</div>
                </div>
            </div>
        </div>
        <?php  } ?>
        <!-- 系统生成图片 开始 -->
        <div class="img" id='posterimg'>
	    <div class='fui-cell-group'>
		<div class='fui-cell'>
		    <div class='fui-cell-info text-center'><div class="fui-preloader"></div><br/>正在生成海报，请稍后...</div>
		</div>
	    </div>
	    <img src="" style="display:none;" />
        </div>
        <div class="fui-title"><i class="icon icon-smile"></i> <?php  if(empty($set['qrcode']) || (!empty($set['qrcode'])&&empty($set['qrcode_title']))) { ?>如何赚钱<?php  } else { ?><?php  echo $set['qrcode_title'];?><?php  } ?></div>
        <div class="fui-list-group">

            <?php  if(empty($set['qrcode']) || (!empty($set['qrcode'])&&empty($set['qrcode_content']))) { ?>
            <div class="fui-list">
                <div class="fui-list-media">
                    第一步
                </div>
                <div class="fui-list-inner">
                    <div class="subtitle">转发商品链接或商品图片给微信好友；</div>
                </div>
            </div>
            <div class="fui-list">
                <div class="fui-list-media">
                    第二步
                </div>
                <div class="fui-list-inner">
                    <div class="subtitle">从您转发的链接或图片进入商城的好友，<?php  if($this->set['become_child']==1) { ?>如果您的好友下单，<?php  } ?><?php  if($this->set['become_child']==2) { ?>如果您的好友下单并付款，<?php  } ?>系统将自动锁定成为您的客户, 他们在微信商城中购买任何商品，您都可以获得<?php  echo $this->set['texts']['commission1']?>；
                    </div>
                </div>
            </div>

            <div class="fui-list">
                <div class="fui-list-media">
                    第三步
                </div>
                <div class="fui-list-inner">
                    <div class="subtitle">您可以在<?php  echo $this->set['texts']['center']?>查看【<?php  echo $this->set['texts']['mydown']?>】和【<?php  echo $this->set['texts']['order']?>】，好友确认收货后<?php  echo $this->set['texts']['commission']?>方可<?php  echo $this->set['texts']['withdraw']?>。
                    </div>
                </div>
            </div>
            <?php  } else { ?>

            <div class="fui-list">
                <div class="fui-list-inner">
                    <div class="subtitle" style="text-indent: 2em;"><?php  echo $set['qrcode_content'];?></div>
                </div>
            </div>
            <?php  } ?>
            <div class="fui-list">
                <div class="fui-card">
                    <div class="fui-card-content">
                        说明：<?php  if(empty($set['qrcode']) || (!empty($set['qrcode'])&&empty($set['qrcode_remark']))) { ?>分享后会带有独有的推荐码，您的好友访问之后，系统会自动检测并记录客户关系。如果您的好友已被其他人抢先发展成了客户，他就不能成为您的客户，以最早发展成为客户为准。<?php  } else { ?><?php  echo $set['qrcode_remark'];?><?php  } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script language='javascript'>
		require(['../addons/ewei_shopv2/plugin/commission/static/js/qrcode.js'], function (modal) {
			modal.init({goodsid: <?php  echo intval($_GPC['goodsid'])?>});
		});
	</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
