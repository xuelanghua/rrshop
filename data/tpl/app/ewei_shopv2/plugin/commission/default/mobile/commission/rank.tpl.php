<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="../addons/ewei_shopv2/template/mobile/default/static/css/rank.css">
<div class="fui-page fui-page-current page-rank orange" style="overflow:auto;">
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title"><?php  echo $commission_title;?>排名</div>
        <div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content navbar'>
        <div class="rankhead">
        <div class="head">
            <div class="child">
                <!--<span><?php  echo $user['seven'];?></span>-->
                <!--<p class="text">本周<?php  echo $_W['shopset']['trade']['credittext'];?></p>-->
            </div>
            <div class="child gold">
                <span><?php echo ($user['paiming']>=$commission_rank['num'] || empty($user['paiming']) ) ? '暂未上榜' : $user['paiming']?></span>
                <p class="text">我的名次</p>
            </div>
            <div class="child">
                <span><?php  echo $user['commission_total'];?></span>
                <p class="text"><?php  echo $commission_title;?></p>
            </div>
        </div>
        <div class="title"><?php  echo $commission_title;?>排名为<?php  if($commission_rank['type'] == '0') { ?>定时刷新<?php  } else { ?>实时更新<?php  } ?>(最多显示<?php  echo $commission_rank['num'];?>名)</div>
    </div>
<div class="rankline">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
</div>
<div class="ranklist">
    <div class="main">
        <div class="line title">
            <div class="col">排名</div>
            <div class="col">昵称</div>
            <div class="col"><?php  echo $commission_title;?></div>
        </div>

        <div id="container" ></div>
        <a id="btn-more" class="btn btn-danger block">点击加载更多</a>



    </div>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_copyright', TEMPLATE_INCLUDEPATH)) : (include template('_copyright', TEMPLATE_INCLUDEPATH));?>
</div>
<script id="tpl_list" type="text/html">
     <%each list as row,index%>

     <div class="line">
         <div class="col<% if ((page+index)<4) %> icon-<%page+index%><%/if%>"><% if ((page+index)>3) %><%page+index%><%/if%></div>
         <div class="col">
             <div class="face"><img src="<%row.avatar%>" /></div>
             <div class="name"><%row.nickname%></div>
         </div>
         <div class="col index-1"><%row.commission_total%></div>
     </div>
    <%/each%>
</script>
    <script language='javascript'>
        require(['../addons/ewei_shopv2/plugin/commission/static/js/rank.js'], function (modal) {
            modal.init();
        });
    </script>
    </div>
</div>
<?php  $this->footerMenus()?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>