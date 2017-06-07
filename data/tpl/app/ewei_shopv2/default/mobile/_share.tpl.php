<?php defined('IN_IA') or exit('Access Denied');?><?php  $this->shopShare()?>

<script language="javascript">
        clearTimeout(window.interval);
        window.interval = setTimeout(function () {
            window.shareData = <?php  echo json_encode($_W['shopshare'])?>;
            jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || { jsApiList:[] };
            jssdkconfig.debug = false;
            jssdkconfig.jsApiList = ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','showOptionMenu', 'hideMenuItems', 'onMenuShareQZone', 'scanQRCode'];
            wx.config(jssdkconfig);
            wx.ready(function () {
                wx.showOptionMenu();

                <?php  if(!empty($_W['shopshare']['hideMenus'])) { ?>
                    wx.hideMenuItems({
                        menuList: <?php  echo  json_encode($_W['shopshare']['hideMenus'])?>
                    });
                <?php  } ?>

                wx.onMenuShareAppMessage(window.shareData);
                wx.onMenuShareTimeline(window.shareData);
                wx.onMenuShareQQ(window.shareData);
                wx.onMenuShareWeibo(window.shareData);
                wx.onMenuShareQZone(window.shareData);
            });
        },500);


		<?php  if(!empty($_W['shopset']['wap']['open']) && !is_weixin()) { ?>
		//	Share to qq
		require(['//qzonestyle.gtimg.cn/qzone/qzact/common/share/share.js'], function(setShareInfo) {
			setShareInfo({
				title: "<?php  echo $_W['shopshare']['title'];?>",
				summary: "<?php  echo $_W['shopshare']['desc'];?>",
				pic: "<?php  echo $_W['shopshare']['imgUrl'];?>",
				url: "<?php  echo $_W['shopshare']['link'];?>"
			});
		});
		<?php  } ?>
</script> 