<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diypage/_common', TEMPLATE_INCLUDEPATH)) : (include template('diypage/_common', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <span class='pull-right' style="padding: 15px 10px;">
	    	<strong>左侧跟随</strong>
	    	<input class="js-switch small" id="phoneposition" type="checkbox" value="1" checked />
    </span>
    <h2><?php  if(!empty($menu)) { ?>编辑<?php  } else { ?>新建<?php  } ?>自定义菜单 <?php  if(!empty($menu)) { ?><small>(菜单名称: <?php  echo $menu['name'];?>)</small><?php  } ?></h2>
</div>

<div class="diy-phone" style="position: fixed;" data-merch="<?php  echo intval($_W['merchid'])?>">
    <div class="phone-head"></div>
    <div class="phone-body">
        <div class="phone-title" id="page">自定义菜单</div>
        <div class="phone-main" id="phone" style="position: relative; overflow: hidden">
            <p style="text-align: center; line-height: 400px">loading...</p>
        </div>
    </div>
    <div class="phone-foot"></div>
</div>  
 
<div class="diy-editor form-horizontal" id="diy-editor" style="float: right;">
    <div class="editor-arrow"></div>
    <div class="inner"></div>
</div>



<div class="diy-menu">
    <div class="action">
        <nav class="btn btn-default btn-sm" style="float: left; display: none" id="gotop"><i class="icon icon-top" style="font-size: 12px"></i> 返回顶部</nav>
        <nav class="btn btn-primary btn-sm btn-save" data-type="save">保存菜单</nav>
    </div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diypage/_template_menu', TEMPLATE_INCLUDEPATH)) : (include template('diypage/_template_menu', TEMPLATE_INCLUDEPATH));?>

<script language="javascript">
    var path = '../../plugin/diypage/static/js/diy.menu';
    myrequire([path,'tpl','web/biz'],function(modal,tpl){
        modal.init({
            tpl: tpl,
            attachurl: "<?php  echo $_W['attachurl'];?>",
            id: '<?php  echo intval($_GPC["id"])?>',
            menu: <?php  if(!empty($menu['data'])) { ?><?php  echo json_encode($menu['data'])?><?php  } else { ?>null<?php  } ?>,
            merch: <?php  if($_W['plugin']=='merch' && !empty($_W['merchid'])) { ?>1<?php  } else { ?>0<?php  } ?>
        });
    });
    function showSubMenu(obj) {
        $(obj).toggleClass('on').siblings().removeClass('on');
        $(obj).find('.child').toggleClass('in');
        $(obj).siblings().find('.child').removeClass('in')
    }
    $(function () {
       $("#phoneposition").click(function () {
           var div = $(this).next();
           if(div.hasClass('checked')){
               $(".diy-phone").css({'position': 'fixed'});
           }else{
               $(".diy-phone").css('position', 'relative');
           }
       });
    });
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>