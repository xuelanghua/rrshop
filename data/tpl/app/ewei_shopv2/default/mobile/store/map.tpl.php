<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script language='javascript' src='//api.map.baidu.com/getscript?v=2.0&ak=ZQiFErjQB7inrGpx27M1GR5w3TxZ64k7'></script>
<div class='fui-page  fui-page-current store-map-page' >

    <div class="fui-header">
	<div class="fui-header-left">
	    <a class="back"></a>
	</div>
	<div class="title">门店地图</div> 
	<div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content' >
	<div id='js-map' class='map-container'></div>
	<div class='fui-footer'  style='visibility: hidden;'>
	    <div class="fui-list">
		<div class="fui-list-media">
		    <img src="<?php  echo tomedia($store['logo'])?>" />
		</div>
		<div class='fui-list-inner'>
		    <div class='title'><?php  echo $store['storename'];?></div>
		    <?php  if(!empty($store['saletime'])) { ?>
		    <div class='text'>营业时间: <?php  echo $store['saletime'];?></div>
		    <?php  } ?>
		    <?php  if(!empty($store['tel'])) { ?>
		    <div class='text'>联系电话: <?php  echo $store['tel'];?></div>
		    <?php  } ?>
		</div>
		<?php  if(!empty($store['tel'])) { ?>
		<div class="fui-list-angle">
		    <a href="tel:<?php  echo $store['tel'];?>" class='external '><i class=' icon icon-phone2' style='color:green'></i></a>
		</div>
		<?php  } ?>
	    </div>
	</div>
    </div>
    <script language='javascript'>
            require(['biz/store/map'], function (modal) {
                modal.init({store: <?php  echo json_encode($store)?>, isios: "<?php echo is_h5app()&&is_ios()?1:0?>"});
            });</script>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>