<?php defined('IN_IA') or exit('Access Denied');?><script language='javascript'>
	$(function(){
		$.ajax({
			url: "<?php  echo mobileUrl('util/task')?>",
			cache:false
		});
	})
</script>

<script language="javascript">require(['init']);</script>


<?php  if(is_h5app()) { ?>
	<?php  $this->shopShare()?>
	<script language='javascript'>
		require(['biz/h5app'], function (modal) {
			modal.init({
				share: <?php  echo json_encode($_W['shopshare'])?>,
				backurl: "<?php  echo $_GPC['backurl'];?>",
				statusbar: "<?php  echo intval($_W['shopset']['wap']['statusbar'])?>",
				payinfo: <?php  echo json_encode($payinfo)?>
			});
			<?php  if($initWX) { ?>
			modal.initWX();
			<?php  } ?>
		});
	</script>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('headmenu', TEMPLATE_INCLUDEPATH)) : (include template('headmenu', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>

<script language="javascript">
	window.shareData = <?php  echo json_encode($_W['shopshare'])?>;
	jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || { jsApiList:[] };
	jssdkconfig.debug = false;
	jssdkconfig.jsApiList = ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','showOptionMenu', 'hideMenuItems', 'onMenuShareQZone','scanQRCode'];
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
		$("#btn-pay").on('click',function () {
			var money = $.trim( $("#money").val() );
			if (isNaN(money) || money<=0){
				FoxUI.toast.show('输入金额有误!');
				return;
			}
			FoxUI.confirm('确认收款金额为: ' + money + " 元?",'收款确认',function(){
                wx.scanQRCode({
                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                    success: function (res) {
						FoxUI.defaults.loaderText = '支付结果等待中!';
						FoxUI.loader.show('loading');
						var result = res.resultStr.replace('CODE_128,',''); // 当needResult 为 1 时，扫码返回的结果
                        $.post("<?php  echo mobileUrl('cashier/collection',array('cashierid'=>$_W['cashierid']))?>",{money:money,auth_code:result},function (data) {
                            if(data.status == 0)
                            {
                            	nul = setInterval(function () {
									$.getJSON("<?php  echo mobileUrl('cashier/pay/orderquery',array('cashierid'=>$_W['cashierid']))?>"+"&orderid="+data.result.message,function (order) {
										if (order.status == 1){
											location.href = "<?php  echo mobileUrl('cashier/pay/success',array('cashierid'=>$_W['cashierid']))?>"+"&orderid="+data.result.message;
										}
									})
								},5000);
                            }else if (data.status == 1){
                            	location.href = "<?php  echo mobileUrl('cashier/pay/success',array('cashierid'=>$_W['cashierid']))?>"+"&orderid="+data.result.message;
                            }else if (data.status == -101){
								FoxUI.loader.hide();
								FoxUI.alert(data.result.message);
							}
                        },'json')
                    }
                });
			});
		});
	});

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

<?php  $this->diyLayer(true, $diypage)?>

<?php  $this->wapQrcode()?>
<span style="display:none"><?php  echo $_W['shopset']['shop']['diycode'];?></span>
</body>
</html>
