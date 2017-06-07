<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diypage/_common', TEMPLATE_INCLUDEPATH)) : (include template('diypage/_common', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <span class="pull-right">
        <a class="btn btn-default btn-sm" href="<?php echo $pagetype=='sys' ? webUrl('diypage/page/sys') : webUrl('diypage/page/diy')?>"><i class="fa fa-reply"></i> 返回列表</a>
    </span>
    <h2>
        <?php  if($do=='edit') { ?>编辑<?php  } else { ?>新建<?php  } ?> <?php  echo $typename;?> <?php  if($pagetype!='mod') { ?>页面<?php  } ?>
        <?php  if(!empty($page)) { ?>
            <small><?php  if($do=='edit') { ?>(<?php  if($pagetype=='mod') { ?>模块<?php  } else { ?>页面<?php  } ?>名称: <?php  echo $page['name'];?>)<?php  } else if(($do=='add' && !empty($template) && !empty($template['data']))) { ?>(通过模板：<?php  echo $template['name'];?> 创建)<?php  } ?></small>
        <?php  } ?>
    </h2>
</div>

<div class="diy-phone" data-merch="<?php  echo intval($_W['merchid'])?>">
    <div class="phone-head"></div>
    <div class="phone-body">
        <div class="phone-title" id="page">loading...</div>
        <div class="phone-main" id="phone">
            <p style="text-align: center; line-height: 400px">您还没有添加任何元素</p>
        </div>
    </div>
    <div class="phone-foot"></div>
</div>

<div class="diy-editor form-horizontal" id="diy-editor">
    <div class="editor-arrow"></div>
    <div class="inner"></div>
</div>

<div class="diy-menu">
    <div class="navs" id="navs"></div>
    <div class="action">
        <nav class="btn btn-default btn-sm" style="float: left; display: none" id="gotop"><i class="icon icon-top" style="font-size: 12px"></i> 返回顶部</nav>
        <?php  if($pagetype=='sys') { ?>
            <?php if(cv('diypage.page.sys.savetemp')) { ?>
                <nav class="btn btn-warning btn-sm btn-save" data-type="savetemp">另存为模板</nav>
            <?php  } ?>
        <?php  } ?>
        <?php  if($pagetype=='diy') { ?>
            <?php if(cv('diypage.page.diy.savetemp')) { ?>
                <nav class="btn btn-warning btn-sm btn-save" data-type="savetemp">另存为模板</nav>
            <?php  } ?>
        <?php  } ?>
        <?php  if($pagetype=='plu') { ?>
            <?php if(cv('diypage.page.plu.savetemp')) { ?>
                <nav class="btn btn-warning btn-sm btn-save" data-type="savetemp">另存为模板</nav>
            <?php  } ?>
        <?php  } ?>
        <nav class="btn btn-primary btn-sm btn-save" data-type="save">保存<?php  if($pagetype=='mod') { ?>模块<?php  } else { ?>页面<?php  } ?></nav>
        <?php  if($pagetype=='sys' || $pagetype=='diy' || $pagetype=='plu') { ?>
            <?php  if($_GPC['type']!=5 && $page['type']!=5 && $_GPC['type']!=7 && $page['type']!=7 && $_GPC['type']!=8 && $page['type']!=8) { ?>
                <nav class="btn btn-success btn-sm btn-save" data-type="preview">保存并预览</nav>
            <?php  } ?>
        <?php  } ?>
    </div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diypage/_template', TEMPLATE_INCLUDEPATH)) : (include template('diypage/_template', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diypage/_template_edit', TEMPLATE_INCLUDEPATH)) : (include template('diypage/_template_edit', TEMPLATE_INCLUDEPATH));?>

<script type="text/javascript" src="./resource/components/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/lang/zh-cn/zh-cn.js"></script>

<script language="javascript">
    var path = '../../plugin/diypage/static/js/diy.min';
    myrequire([path,'tpl','web/biz'],function(modal,tpl){
        modal.init({
            tpl: tpl,
            attachurl: "<?php  echo $_W['attachurl'];?>",
            id: '<?php  echo intval($_GPC["id"])?>',
            type: <?php  echo $type;?>,
            data: <?php  if(!empty($page['data'])) { ?><?php  echo json_encode($page['data'])?><?php  } else { ?>null<?php  } ?>,
            diymenu: <?php  echo json_encode($diymenu)?>,
            diyadvs: <?php  echo json_encode($diyadvs)?>,
            levels: <?php  if(!empty($levels)) { ?><?php  echo json_encode($levels)?><?php  } else { ?>null<?php  } ?>,
            merch: <?php  if($_W['plugin']=='merch' && !empty($_W['merchid'])) { ?>1<?php  } else { ?>0<?php  } ?>,
            plugins: <?php  echo $hasplugins;?>,
            shopset: <?php  echo json_encode($_W['shopset']['shop'])?>
        });
    });
    function selectUrlCallback(href){
        var ue =  UE.getEditor('rich');
        if(href){
            ue.execCommand('link', {href: href, 'data-nocache': 'true'});
        }
    }
    function callbackGoods(data) {
        myrequire([path],function(modal) {
            modal.callbackGoods(data);
        });
    }
    function callbackCategory (data) {
        myrequire([path],function(modal) {
            modal.callbackCategory(data);
        });
    }
    function callbackGroup (data) {
        myrequire([path],function(modal) {
            modal.callbackGroup(data);
        });
    }
    function callbackMerch (data) {
        myrequire([path],function(modal) {
            modal.callbackMerch(data);
        });
    }
    function callbackMerchCategory (data) {
        myrequire([path],function(modal) {
            modal.callbackMerchCategory(data);
        });
    }
    function callbackMerchGroup (data) {
        myrequire([path],function(modal) {
            modal.callbackMerchGroup(data);
        });
    }
    function callbackSeckill (data) {
        myrequire([path],function(modal) {
            modal.callbackSeckill(data);
        });
    }
    function callbackCoupon (data) {
        myrequire([path],function(modal) {
            modal.callbackCoupon(data);
        });
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>