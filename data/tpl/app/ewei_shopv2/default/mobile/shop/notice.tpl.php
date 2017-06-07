<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('commission/common', TEMPLATE_INCLUDEPATH)) : (include template('commission/common', TEMPLATE_INCLUDEPATH));?>
<div class="fui-page fui-page-current page-commission-team">
	<div class="fui-header">
		<div class="fui-header-left">
			<a href="<?php  echo mobileUrl('shop');?>" class="back"></a>
		</div>
		<div class="title">商城公告</div>
	</div>
	<div class="fui-content navbar">

		<div class='content-empty' style='display:none;'>
			<i class='icon icon-group'></i><br/>暂时没有任何公告
		</div>
		<div class="fui-title"></div>
		<div class="fui-list-group" id="container"></div>
		<div class='infinite-loading'><span class='fui-preloader'></span><span class='text'> 正在加载...</span></div>

	</div>
</div> 

<script id='tpl_shop_notice' type='text/html'>
	<%each list as notice%>
	<a <%if notice.link !=''%>class="external"<%/if%> href="<%if notice.link !=''%><%notice.link%><%else%><?php  echo mobileUrl('shop/notice/detail')?>&id=<%notice.id%><%/if%>" data-nocache="true">
		<div class="fui-list">
			<div class="fui-list-media">
				<img data-lazy="<%if notice.thumb%><%notice.thumb%><%else%><?php  echo tomedia($_W['shopset']['shop']['logo'])?><%/if%>" class="round">
				<!--<div class="badge">1</div>-->
			</div>
			<div class="fui-list-inner">
				<div class="row">
					<div class="row-text"><%if notice.title%><%notice.title%><%else%>未获取<%/if%></div>
				</div>
				<div class="subtitle"><%notice.createtime%></div>
			</div>
			<div class="fui-list-angle">
				<div class="angle"></div>
			</div>
		</div>
	</a>
	<%/each%>
</script>
<script language='javascript'>require(['biz/shop/notice'], function (modal) {modal.init();});</script>
<?php  $this->footerMenus()?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>