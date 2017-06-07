<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "<?php  if(!empty($page)&&!empty($page['data']['page']['title'])) { ?><?php  echo $page['data']['page']['title'];?><?php  } else { ?><?php  echo $_W['shopset']['shop']['name'];?><?php  } ?>"; </script>
<link rel="stylesheet" href="../addons/ewei_shopv2/static/js/dist/swiper/swiper.min.css">
<link href="../addons/ewei_shopv2/plugin/diypage/static/css/foxui.diy.css?v=201612121750"rel="stylesheet"type="text/css"/>
<style type="text/css">
    <?php  if(is_h5app()&&is_ios()) { ?>
        .fui-header ~ .diy-fixedsearch {top: 3.2rem;}
    <?php  } ?>
</style>
<?php  if($page['type']==4) { ?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('commission/common', TEMPLATE_INCLUDEPATH)) : (include template('commission/common', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<div class='fui-page  fui-page-current <?php  if($page['type']==3) { ?>member-page<?php  } else if($page['type']==4) { ?>page-commission-index<?php  } ?>' style="top: 0; background-color: <?php  echo $page['data']['page']['background'];?>; ">
<?php  if(!empty($page['data']['page']['followbar'])) { ?>
    <?php  $this->followBar(true, $page['merch'])?>
<?php  } ?>
<?php  if(!is_weixin()) { ?>
    <div class="fui-header">
        <div class="fui-header-left">
            <?php  if($page['type']==1) { ?>
            <a href="<?php  echo mobileUrl()?>" class="external"><i class="icon icon-home"></i> </a>
            <?php  } ?>
        </div>
        <div class="title"><?php  if(!empty($page)&&!empty($page['data']['page']['title'])) { ?><?php  echo $page['data']['page']['title'];?><?php  } else { ?><?php  echo $_W['shopset']['shop']['name'];?><?php  } ?></div>
        <div class="fui-header-right"></div>
    </div>
<?php  } ?>

<?php  if(!empty($diyitem_search)) { ?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diypage/template/tpl_fixedsearch', TEMPLATE_INCLUDEPATH)) : (include template('diypage/template/tpl_fixedsearch', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>

<div class="fui-content <?php  if($page['diymenu']>-1) { ?>navbar<?php  } ?>" id="container" style="background-color: <?php  echo $page['data']['page']['background'];?>; <?php  if($page['diymenu']>-1) { ?>padding-bottom: 0;<?php  } ?>">
    <?php  if(!empty($diyitems)) { ?>
        <?php  if(is_array($diyitems)) { foreach($diyitems as $diyitemid => $diyitem) { ?>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diypage/template/tpl_'.$diyitem['id'], TEMPLATE_INCLUDEPATH)) : (include template('diypage/template/tpl_'.$diyitem['id'], TEMPLATE_INCLUDEPATH));?>
        <?php  } } ?>
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_copyright', TEMPLATE_INCLUDEPATH)) : (include template('_copyright', TEMPLATE_INCLUDEPATH));?>
    <?php  } ?>
</div>

<?php  if($page['diymenu']>-1) { ?>
    <?php  $this->footerMenus($page['diymenu'])?>
<?php  } ?>

<?php  $diypage=true?>

<?php  if(!empty($page['data']['page']['diylayer'])) { ?>
    <?php  $this->diyLayer(false, false, $page['merch'])?>
<?php  } ?>
<?php  if(!empty($page['data']['page']['diygotop'])) { ?>
    <?php  $this->diyGotop(true, false, $page['merch'])?>
<?php  } ?>

<?php  if(!empty($page['data']['page']['danmu'])) { ?>
    <?php  $this->diyDanmu(true)?>
<?php  } ?>


<?php  if(!empty($startadv)) { ?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diypage/startadv', TEMPLATE_INCLUDEPATH)) : (include template('diypage/startadv', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>


<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=ZQiFErjQB7inrGpx27M1GR5w3TxZ64k7&s=1"></script>
<script language="javascript">
    require(['../addons/ewei_shopv2/plugin/diypage/static/js/mobile.js'], function(modal){
        modal.init();
    });
</script>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>