<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/plugin/qa/static/css/common.css?v=2016063000">
<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title"><?php  echo m('plugin')->getName('qa')?></div>
        <div class="fui-header-right">
            <a class="icon icon-home external" href="<?php  echo mobileUrl()?>"></a>
        </div>
    </div>
    <div class='fui-content'>

        <?php  if(!empty($advs)) { ?>
        <div class='fui-swipe' data-transition="500" data-gap="1">
            <div class='fui-swipe-wrapper'>
                <?php  if(is_array($advs)) { foreach($advs as $adv) { ?>
                <a class='fui-swipe-item' href="<?php  if(!empty($adv['link'])) { ?><?php  echo $adv['link'];?><?php  } else { ?>javascript:;<?php  } ?>"  data-nocache="true"><img src="<?php  echo tomedia($adv['thumb'])?>" /></a>
                <?php  } } ?>
            </div>
            <div class='fui-swipe-page'></div>
        </div>
        <?php  } ?>

        <form action="<?php  echo mobileUrl('qa/question')?>" method="post">
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

        <?php  if(count($category)>0) { ?>
            <div class="fui-cell-group qa-title">
                <div class="fui-cell">
                    <div class="fui-cell-text">推荐分类</div>
                    <a class="fui-cell-remark" href="<?php  echo mobileUrl('qa/category')?>" data-nocache="true">全部</a>
                </div>
            </div>
            <div class="fui-icon-group col-4 noborder">
                <?php  if(is_array($category)) { foreach($category as $item) { ?>
                    <a class="fui-icon-col" href="<?php  echo mobileUrl('qa/question', array('cate'=>$item['id']))?>" data-nocache="true">
                        <div class="icon">
                            <img src="<?php  echo tomedia($item['thumb'])?>"/>
                        </div>
                        <div class="text"><?php  echo $item['name'];?></div>
                    </a>
                <?php  } } ?>
            </div>
        <?php  } ?>

        <div class="fui-cell-group qa-title question-title hide">
            <div class="fui-cell">
                <div class="fui-cell-text">常见问题</div>
                <a class="fui-cell-remark" href="<?php  echo mobileUrl('qa/question')?>" data-nocache="true">全部</a>
            </div>
        </div>
        <div class="fui-list-group" id="container"></div>
    </div>

    <?php  if(empty($set['showtype'])) { ?>
        <script type="text/html" id="tpl_list">
            <%each list as item%>
            <div class="fui-according">
                <div class="fui-according-header">
                    <span class="text"><%item.title%></span>
                    <span class="remark"></span>
                </div>
                <div class="fui-according-content">
                    <div class="content-block"><%=item.content%></div>
                </div>
            </div>
            <%/each%>
        </script>
    <?php  } else { ?>
        <script type="text/html" id="tpl_list">
                <%each list as item%>
                <a class="fui-list" href="<?php  echo mobileUrl('qa/detail')?>&id=<%item.id%>" data-nocache="true">
                    <div class="fui-list-inner">
                        <div class="title"><%item.title%></div>
                    </div>
                    <div class="fui-list-angle">
                        <div class="angle"></div>
                    </div>
                </a>
                <%/each%>
        </script>
    <?php  } ?>
    <script language="javascript">
        require(['../addons/ewei_shopv2/plugin/qa/static/js/common.js'],function(modal){
            modal.init({cate: '', keyword: '', isrecommand: 1});
        });
    </script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>