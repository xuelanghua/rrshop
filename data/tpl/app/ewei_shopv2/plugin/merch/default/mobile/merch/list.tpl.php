<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merch/common', TEMPLATE_INCLUDEPATH)) : (include template('merch/common', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/plugin/qa/static/css/common.css?v=2016063000">
<style>
    .fui-list-group{
        margin-top: 0;
    }
</style>
<div class="fui-page page-merch-list">
    <div class="fui-header">
        <div class="fui-header-left"></div>
        <div class="title">入驻商户</div>
        <div class="fui-header-right"></div>
    </div>
    <div class="fui-content" style="bottom: 2.4rem">

        <form action="<?php  echo mobileUrl('merch/list/merchuser')?>" method="post">
            <div class="fui-searchbar bar">
                <div class="searchbar center">
                    <input type="submit" class="searchbar-cancel searchbtn" value="搜索" />
                    <div class="search-input">
                        <i class="icon icon-search"></i>
                        <input type="search" placeholder="输入关键字..." class="search" name="keyword">
                    </div>
                </div>
            </div>
        </form>

        <div class='fui-swipe' >
            <div class='fui-swipe-wrapper'>
                <?php  if(is_array($category_swipe)) { foreach($category_swipe as $swipe) { ?>
                <div class='fui-swipe-item'><img src="<?php  echo tomedia($swipe['thumb'])?>"/></div>
                <?php  } } ?>
            </div>
            <div class='fui-swipe-page'></div>
        </div>

        <?php  if(count($category)>0) { ?>
        <div class="fui-cell-group qa-title">
            <div class="fui-cell">
                <div class="fui-cell-text">推荐分类</div>
                <a class="fui-cell-remark external" href="<?php  echo mobileUrl('merch/list/category')?>">全部</a>
            </div>
        </div>
        <div class="fui-icon-group col-4 noborder">
            <?php  if(is_array($category)) { foreach($category as $item) { ?>
            <a class="fui-icon-col external" href="<?php  echo mobileUrl('merch/list/merchuser', array('cateid'=>$item['id']))?>">
                <div class="icon">
                    <img src="<?php  echo tomedia($item['thumb'])?>"/>
                </div>
                <div class="text"><?php  echo $item['catename'];?></div>
            </a>
            <?php  } } ?>
        </div>
        <?php  } ?>

        <div class="fui-cell-group qa-title">
            <div class="fui-cell">
                <div class="fui-cell-text">推荐商家</div>
                <a class="fui-cell-remark external" href="<?php  echo mobileUrl('merch/list/merchuser')?>">全部</a>
            </div>
        </div>

        <div class="fui-list-group">
            <?php  if(is_array($merchuser)) { foreach($merchuser as $key => $value) { ?>
                <a class="fui-list external" href="<?php  echo mobileUrl('merch',array('merchid'=>$value['id']))?>">
                    <div class="fui-list-media">
                        <img src="<?php  echo tomedia($value['logo'])?>" class="round">
                        <!--<div class="badge">1</div>-->
                    </div>
                    <div class="fui-list-inner">
                        <div class="row">
                            <div class="row-text"><?php  echo $value['merchname'];?></div>
                            <!--<div class="row-remark">11:11</div>-->
                            <div class="angle"></div>
                        </div>
                        <div class="subtitle"><?php  echo $value['desc'];?></div>
                    </div>
                </a>
            <?php  } } ?>
        </div>
    </div>
    <?php  $this->footerMenus()?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
