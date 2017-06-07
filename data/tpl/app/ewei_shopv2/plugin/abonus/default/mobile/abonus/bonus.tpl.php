<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('abonus/common', TEMPLATE_INCLUDEPATH)) : (include template('abonus/common', TEMPLATE_INCLUDEPATH));?>
<div class="fui-page fui-page-current page-commission-log">
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title"><?php  echo $this->set['texts']['bonus_detail']?>(<span id='total'></span>)</div>
    </div>
    <div class="fui-content navbar">
       
		<div class='fui-cell-group' style='margin-top:0px;'>
			<div class='fui-cell'>
				<div class='fui-cell-label' style='width:auto'>
                    <?php  if($status==1) { ?>
                    <?php  echo $this->set['texts']['bonus_pay']?>
                    <?php  } else if($status==2) { ?>
                    <?php  echo $this->set['texts']['bonus_lock']?>
                    <?php  } else { ?>
                    <?php  echo $this->set['texts']['bonus_total']?>
                    <?php  } ?>
                </div>
				<div class='fui-cell-info'></div>
				<div class='fui-cell-remark noremark'>+<span>
                      <?php  if($status==1) { ?>
                    <?php  echo $bonus['ok'];?>
                    <?php  } else if($status==2) { ?>
                    <?php  echo $bonus['lock'];?>
                    <?php  } else { ?>
                    <?php  echo $bonus['total'];?>
                    <?php  } ?>

                </span>元</div>
			</div>
		</div>
 <div class="fui-tab fui-tab-warning" id="tab">
            <a class="external  <?php  if($status==0) { ?>active<?php  } ?>" href="<?php  echo mobileUrl('abonus/bonus',array('status'=>0))?>" >全部</a>
            <a class="external  <?php  if($status==2) { ?>active<?php  } ?>" href="<?php  echo mobileUrl('abonus/bonus',array('status'=>2))?>" >待结算</a>
            <a class="external  <?php  if($status==1) { ?>active<?php  } ?>" href="<?php  echo mobileUrl('abonus/bonus',array('status'=>1))?>" >已结算</a>
        </div>
        <div class='content-empty' style='display:none;'>
            <i class='icon icon-manageorder'></i><br/>暂时没有任何数据
        </div>
        <div class="fui-list-group" id="container"></div>
        <div class='infinite-loading'><span class='fui-preloader'></span><span class='text'> 正在加载...</span></div>

 

<script id='tpl_abonus_bonus_list' type='text/html'>
    <%each list as log%>
   
        <a class="fui-list">
            <div class="fui-list-inner">
                <div class="row">
                    <div class="row-text"><%log.payno%></div>
                </div>
                <div class="text">
                    <?php  echo $this->set['texts']['bonus']?>信息:<br/>
                    <%if log.aagenttype<=1%>
                    省级: <%log.paymoney1%>(<%log.bonus1%>%<%if log.chargemoney1>0%><?php  echo $this->set['texts']['bonus_charge']?>: <%log.chargemoney1%><%/if%>)
                    <br/>
                    <%/if%>
                    <%if log.aagenttype<=2%>
                    市级: <%log.paymoney2%>(<%log.bonus2%>%<%if log.chargemoney2>0%><?php  echo $this->set['texts']['bonus_charge']?>: <%log.chargemoney2%><%/if%>)
                    <br/>
                    <%/if%>
                    区级: <%log.paymoney3%>(<%log.bonus3%>%<%if log.chargemoney3>0%><?php  echo $this->set['texts']['bonus_charge']?>: <%log.chargemoney3%><%/if%>)


                </div>


            </div>
            <div class="row-remark">
                <p>+<%log.paymoney%></p>
                <p><%log.statusstr%></p>
            </div>
        </a>
     
    <%/each%>
</script>
   </div>

<script language='javascript'>
    require(['../addons/ewei_shopv2/plugin/abonus/static/js/bonus.js'], function (modal) {
    modal.init({ status: <?php  echo $status;?> });
});
</script>
</div>
<?php  $this->footerMenus()?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
