<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
    .label-italic{font-weight: normal; font-style: italic;}
    .a-inline{margin-top: 6px}
    .input-sm{padding:2px;}
</style>
<div class="form-group">
    <label class="col-sm-2 control-label">加入领券中心</label>
    <div class="col-sm-9 col-xs-12" >
        <?php if( ce('sale.coupon' ,$item) ) { ?>
        <label class="radio-inline">
            <input type="radio" name="gettype" value="0" <?php  if($item['gettype'] == 0) { ?>checked="true"<?php  } ?>  onclick="$('.gettype').hide()"/> 不可以
        </label>
        <label class="radio-inline">
            <input type="radio" name="gettype" value="1" <?php  if($item['gettype'] == 1) { ?>checked="true"<?php  } ?> onclick="$('.gettype').show()" /> 可以
        </label>

        <span class='help-block'>会员是否可以在领券中心直接领取或购买</span>

        <?php  } else { ?> <div class='form-control-static'>
        <?php  if($item['gettype']==1) { ?>可以<?php  } else { ?>不可以<?php  } ?>
    </div>
        <?php  } ?>
    </div>
</div>
<div class="gettype" <?php  if($item['gettype']!=1) { ?>style="display:none"<?php  } ?>>

    <?php if( ce('sale.coupon' ,$item) ) { ?>


    <div class="form-group gettype" >
        <label class="col-sm-2 control-label">标签文字</label>
        <div class="col-sm-9 col-xs-12" >
            <div class="input-group">
                <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <input type='text' class='form-control' value="<?php  echo $item['tagtitle'];?>" name='tagtitle' maxlength="8"/>
                <?php  } else { ?>
                    <?php  echo $item['title'];?>
                <?php  } ?>
            </div>
        </div>
    </div>
    <div class="form-group gettype">
        <label class="col-sm-2 control-label">是否自定义标签颜色</label>
        <div class="col-sm-9 col-xs-12" >
            <?php if( ce('sale.coupon' ,$item) ) { ?>
            <label class="radio-inline">
                <input type="radio" name="settitlecolor" value="0" <?php  if($item['settitlecolor'] == 0) { ?>checked="true"<?php  } ?>  onclick="$('.setcolor').hide()"/> 不可以
            </label>
            <label class="radio-inline">
                <input type="radio" name="settitlecolor" value="1" <?php  if($item['settitlecolor'] == 1) { ?>checked="true"<?php  } ?> onclick="$('.setcolor').show()" /> 可以
            </label>

            <span class='help-block'>会员是否自定义领券中心标签文字的底色,如果不定义则使用默认颜色风格</span>
            <?php  } else { ?> <div class='form-control-static'>
            <?php  if($item['settitlecolor']==1) { ?>可以<?php  } else { ?>不可以<?php  } ?>
        </div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group setcolor" <?php  if($item['settitlecolor']!=1) { ?>style="display:none"<?php  } ?>>
        <label class="col-sm-2 control-label">标签颜色</label>
        <div class="col-sm-3 col-xs-3" >
            <div class="input-group">

                <?php if( ce('sale.coupon' ,$item) ) { ?>
                    <input  class="form-control input-sm diy-bind color" name="titlecolor" value="<?php  echo $item['titlecolor'];?>" type="color" />
                    <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fafafa').trigger('propertychange')">重置</span>
                <?php  } else { ?>
                    <span style="width:15px; background: <?php  echo $item['titlecolor'];?>"> </span>
                <?php  } ?>
            </div>
        </div>
    </div>


    <div class="form-group gettype" >
        <label class="col-sm-2 control-label">领取限制</label>
        <div class="col-sm-9 col-xs-12" >
            <div class="input-group">
                <span class="input-group-addon">每人限领</span>
                <input type='text' class='form-control' value="<?php  echo $item['getmax'];?>" name='getmax'/>
                <span class="input-group-addon">张</span>
            </div>
        </div>
    </div>
    <div class="form-group gettype" >
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12" >

            <div class="input-group">

                <span class="input-group-addon">消耗</span>
                <input type='text' class='form-control' value="<?php  echo $item['credit'];?>" name='credit'/>
                <span class="input-group-addon">积分 + 花费</span>
                <input type='text' class='form-control' value="<?php  echo $item['money'];?>" name='money'/>
                                  <span class="input-group-addon">元&nbsp;&nbsp;
                                      <label class="checkbox-inline" style='margin-top:-8px;'>
                                          <input type="checkbox" name='usecredit2' value="1" <?php  if($item['usecredit2']==1) { ?>checked<?php  } ?> /> 优先使用余额支付
                                      </label>
                                  </span></div>
            <span class="help-block">每人限领，空不限制，领取方式可任意组合，可以单独积分兑换，单独现金兑换，或者积分+现金形式兑换, 如果都为空，则可以免费领取</span>

        </div>
    </div>
    <div class="form-group gettype" >
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12" >

        </div>
    </div>
    <?php  } else { ?>
    <div class="form-group gettype" >
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12" >
            <div class='form-control-static'>消耗 <?php  echo $item['credit'];?> 积分 花费 <?php  echo $item['money'];?> 元现金</div>
        </div>
    </div>
    <?php  } ?>


    <!--会员等级限制-->
    <div class="form-group" >
        <label class="col-sm-2 control-label">是否限制会员等级</label>
        <div class="col-sm-9 col-xs-12" >
            <?php if( ce('sale.coupon' ,$item) ) { ?>
            <label class="radio-inline">
                <input type="radio" name="islimitlevel" value="0" <?php  if($item['islimitlevel'] == 0) { ?>checked="true"<?php  } ?>  onclick="$('.islimitlevel').hide()"/> 否
            </label>
            <label class="radio-inline">
                <input type="radio" name="islimitlevel" value="1" <?php  if($item['islimitlevel'] == 1) { ?>checked="true"<?php  } ?> onclick="$('.islimitlevel').show()" /> 是
            </label>
            <span class='help-block'>会员在领券中心直接领取或购买时是否需要达到指定的会员等级</span>
            <?php  } else { ?>
            <div class='form-control-static'>
                <?php  if($item['islimit']==1) { ?>是<?php  } else { ?>否<?php  } ?>
            </div>
            <?php  } ?>
        </div>
    </div>

    <!--显示隐藏会员等级限制-->
    <div class="form-group islimitlevel" <?php  if($item['islimitlevel']!=1) { ?>style="display:none"<?php  } ?>>
        <label class="col-sm-2 control-label label-italic">会员等级</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('sale.coupon' ,$item) ) { ?>
            <label class="checkbox-inline"><input type="checkbox"  class="checkall" name="limitmemberlevels[]" value="0" <?php  if(!empty($limitmemberlevels)&&in_array("0",$limitmemberlevels)) { ?> checked="true"  <?php  } ?>  /> <?php echo empty($shop['levelname'])?'普通等级':$shop['levelname']?></label>
            <?php  if(is_array($levels)) { foreach($levels as $level) { ?>
            <label class="checkbox-inline"><input type="checkbox"  class="checkall" name="limitmemberlevels[]" value="<?php  echo $level['id'];?>"  <?php  if(!empty($limitmemberlevels)&&in_array( $level['id'] , $limitmemberlevels)) { ?> checked="true"  <?php  } ?>  /> <?php  echo $level['levelname'];?></label>
            <?php  } } ?>
            <?php  } else { ?>
            <?php  if(!empty($limitmemberlevels)&&in_array("0",$limitmemberlevels)) { ?> <?php echo  empty($shop['levelname'])?'普通等级':$shop['levelname']?>  <?php  } ?>&nbsp;&nbsp;
            <?php  if(is_array($levels)) { foreach($levels as $level) { ?>
            <?php  if(!empty($limitmemberlevels)&&in_array($level['id'] , $limitmemberlevels)) { ?>
            <?php  echo $level['levelname']?>&nbsp;&nbsp;
            <?php  } ?>
            <?php  } } ?>
            <?php  } ?>
        </div>

        <!--分销商等级限制-->
        <?php  if($hascommission) { ?>
        <!--显示隐藏分销商等级限制-->
        <label class="col-sm-2 control-label label-italic">分销商等级</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('sale.coupon' ,$item) ) { ?>
            <label class="checkbox-inline"><input type="checkbox"  class="checkall" name="limitagentlevels[]" value="0" <?php  if(!empty($limitagentlevels)&&in_array("0",$limitagentlevels)) { ?> checked="true"  <?php  } ?>  /> <?php echo empty($plugin_com_set['levelname'])?'普通等级':$plugin_com_set['levelname']?></label>
            <?php  if(is_array($agentlevels)) { foreach($agentlevels as $level) { ?>
            <label class="checkbox-inline"><input type="checkbox"  class="checkall" name="limitagentlevels[]" value="<?php  echo $level['id'];?>"  <?php  if(!empty($limitagentlevels)&&in_array( $level['id'] , $limitagentlevels)) { ?> checked="true"  <?php  } ?>  /> <?php  echo $level['levelname'];?></label>
            <?php  } } ?>
            <?php  } else { ?>
            <?php  if(!empty($limitagentlevels)&&in_array("0",$limitagentlevels)) { ?> <?php echo empty($plugin_com_set['levelname'])?'普通等级':$plugin_com_set['levelname']?>  <?php  } ?>&nbsp;&nbsp;
            <?php  if(is_array($agentlevels)) { foreach($agentlevels as $level) { ?>
            <?php  if(!empty($limitagentlevels)&&in_array( $level['id'] , $limitagentlevels)) { ?>
            <?php  echo $level['levelname']?>&nbsp;&nbsp;
            <?php  } ?>
            <?php  } } ?>
            <?php  } ?>
        </div>
        <?php  } ?>

        <!--是否开启人人股东-->
        <?php  if($hasglobonus) { ?>
        <!--显示隐藏股东等级限制-->
        <label class="col-sm-2 control-label label-italic">股东等级</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('sale.coupon' ,$item) ) { ?>
                <label class="checkbox-inline"><input type="checkbox"  class="checkall" name="limitpartnerlevels[]" value="0" <?php  if(!empty($limitpartnerlevels)&&in_array("0",$limitpartnerlevels)) { ?> checked="true"  <?php  } ?>  /> <?php echo empty($plugin_globonus_set['levelname'])?'普通等级':$plugin_globonus_set['levelname']?></label>
                <?php  if(is_array($partnerlevels)) { foreach($partnerlevels as $level) { ?>
                    <label class="checkbox-inline"><input type="checkbox"  class="checkall" name="limitpartnerlevels[]" value="<?php  echo $level['id'];?>"  <?php  if(!empty($limitpartnerlevels)&&in_array( $level['id'] , $limitpartnerlevels)) { ?> checked="true"  <?php  } ?>  /> <?php  echo $level['levelname'];?></label>
                <?php  } } ?>
            <?php  } else { ?>
                <?php  if(!empty($limitpartnerlevels)&&in_array("0",$limitpartnerlevels)) { ?> <?php echo empty($plugin_globonus_set['levelname'])?'普通等级':$plugin_globonus_set['levelname']?>  <?php  } ?>&nbsp;&nbsp;
                <?php  if(is_array($partnerlevels)) { foreach($partnerlevels as $level) { ?>
                    <?php  if(!empty($limitpartnerlevels)&&in_array( $level['id'] , $limitpartnerlevels)) { ?>
                        <?php  echo $level['levelname']?>&nbsp;&nbsp;
                    <?php  } ?>
                <?php  } } ?>
            <?php  } ?>
        </div>
        <?php  } ?>

        <!--是否开启区域代理-->
        <?php  if($hasabonus) { ?>
        <!--显示隐藏区域代理等级限制-->
        <label class="col-sm-2 control-label label-italic">区域代理等级</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('sale.coupon' ,$item) ) { ?>
                <label class="checkbox-inline"><input type="checkbox"  class="checkall"  name="limitaagentlevels[]" value="0" <?php  if(!empty($limitaagentlevels)&&in_array("0",$limitaagentlevels)) { ?> checked="true"  <?php  } ?>  /> <?php echo empty($plugin_abonus_set['levelname'])?'普通等级':$plugin_abonus_set['levelname']?></label>
                <?php  if(is_array($aagentlevels)) { foreach($aagentlevels as $level) { ?>
                    <label class="checkbox-inline"><input type="checkbox"   class="checkall" name="limitaagentlevels[]" value="<?php  echo $level['id'];?>"  <?php  if(!empty($limitaagentlevels)&&in_array( $level['id'] , $limitaagentlevels)) { ?> checked="true"  <?php  } ?>  /> <?php  echo $level['levelname'];?></label>
                <?php  } } ?>
            <?php  } else { ?>
            <?php  if(!empty($limitaagentlevels)&&in_array("0",$limitaagentlevels)) { ?> <?php echo empty($plugin_abonus_set['levelname'])?'普通等级':$plugin_abonus_set['levelname']?>  <?php  } ?>&nbsp;&nbsp;
                <?php  if(is_array($aagentlevels)) { foreach($aagentlevels as $level) { ?>
                    <?php  if(!empty($limitaagentlevels)&&in_array( $level['id'] , $limitaagentlevels)) { ?>
                        <?php  echo $level['levelname']?>&nbsp;&nbsp;
                    <?php  } ?>
                <?php  } } ?>
            <?php  } ?>
        </div>
        <?php  } ?>

        <label class="col-sm-2 control-label label-italic">是否全选</label>
        <div class="col-sm-9 col-xs-12">
            <label class="a-inline">
                <a href="javascript:void(0);"  id="btnCheckAll" />全选</a>
            </label>
            <label class="a-inline">
                <a  href="javascript:void(0);"  id="btnCheckNone" />反选</a>
            </label>
            <span class='help-block'>会员只要达到您选择的任意等级即可领取</span>
        </div>

    </div>

</div>

<script language='javascript'>
    $("#btnCheckAll").bind("click", function () {
        $(".checkall").prop("checked",true);
    });

    $("#btnCheckNone").bind("click", function () {
        $(".checkall").prop("checked",false);
    });


</script>