<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
	
	<span class='pull-right'>
		
		<?php if(cv('lottery.add')) { ?>
        <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('lottery/add',array('lottery_type'=>1))?>"><i class="fa fa-plus"></i> 添加大转盘</a>
		<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('lottery/add',array('lottery_type'=>2))?>"><i class="fa fa-plus"></i> 添加刮刮卡</a>
		<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('lottery/add',array('lottery_type'=>3 ))?>"><i class="fa fa-plus"></i> 添加九宫格</a>
		<?php  } ?>

		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('lottery')?>">返回列表</a>


	</span>
    <h2><?php  if(!empty($item['lottery_id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>抽奖 <small><?php  if(!empty($item['lottery_id'])) { ?>修改【<?php  echo $item['lottery_title'];?>】<?php  } ?></small></h2>
</div>

<link rel="stylesheet" href="../addons/ewei_shopv2/plugin/lottery/static/style/post.css" />
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['lottery_id'];?>" />
    <ul class="nav nav-arrow-next nav-tabs" id="myTab">
        <li <?php  if($_GPC['tab']=='basic' || empty($_GPC['tab'])) { ?>class="active"<?php  } ?> ><a href="#tab_basic">基本</a></li>
        <?php  if(!empty($item['lottery_id'])) { ?>
        <li <?php  if($_GPC['tab']=='design') { ?>class="active"<?php  } ?> ><a href="#tab_design">设计</a></li>
        <?php  if($type!=2) { ?>
        <li <?php  if($_GPC['tab']=='preview') { ?>class="active"<?php  } ?> ><a href="#tab_preview">预览</a></li>
        <?php  } ?>
        <?php  } ?>
    </ul>

    <div class="tab-content">
        <div class="tab-pane  <?php  if($_GPC['tab']=='basic' || empty($_GPC['tab'])) { ?>active<?php  } ?>" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('lottery/post/basic', TEMPLATE_INCLUDEPATH)) : (include template('lottery/post/basic', TEMPLATE_INCLUDEPATH));?></div>
        <div class="tab-pane  <?php  if($_GPC['tab']=='design') { ?>active<?php  } ?>" id="tab_design"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('lottery/post/design', TEMPLATE_INCLUDEPATH)) : (include template('lottery/post/design', TEMPLATE_INCLUDEPATH));?></div>
        <?php  if($type!=2) { ?>
        <div class="tab-pane  <?php  if($_GPC['tab']=='design') { ?>active<?php  } ?>" id="tab_preview"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('lottery/post/preview', TEMPLATE_INCLUDEPATH)) : (include template('lottery/post/preview', TEMPLATE_INCLUDEPATH));?></div>
        <?php  } ?>
    </div>

    <div class="form-group"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('lottery' ,$item) ) { ?>
            <input type="submit" value="提交" class="btn btn-primary"  />
            <input type="hidden" name="reward_data" value="">
            <input type="hidden" name="reward_rank" value="">

            <input type="hidden" name="lottery_type" value="<?php  echo $type;?>" />
            <?php  } ?>
            <input type="button" name="back" onclick='history.back()' <?php if(cv('lottery.add|lottery.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
        </div>
    </div>
</form>

<script language='javascript'>
    require(['bootstrap'],function(){
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $('#tab').val( $(this).attr('href'));
            $(this).tab('show');
        })
    });

    function showGoodsSelect(show){
        if(show){
            $('#goodsdiv').show();
        }
        else{
            $('#goodsdiv').hide();
        }
    }

    $('form').submit(function(){
        if($('.rec_reward_data').length < $('#rec-rank .panel').length){
            tip.msgbox.err('有未选择奖励的奖项');
            $('form').attr('stop',1);
            return false;
        }
        var rec_reward = [];
        $('.rec_reward_data').each(function () {
            var obj = $(this);
            var type = obj.data('type');
            var d = {};
            d.rank = obj.data('rank');
            if(type==1){
                d.type=1;
                d.num=obj.data('value');
            }else if(type==2){
                d.type=2;
                d.num=obj.data('value');
                d.total=obj.data('total');
                d.moneytype=obj.data('moneytype');
            }else if(type==3){
                d.type=3;
                d.num=obj.data('value');
                d.total=obj.data('total');
                if(d.num<1){
                    tip.msgbox.err('微信企业付款需支付1元以上!');
                    $('form').attr('stop',1);
                    return false;
                }
            }else if(type==4){
                d.type=4;
                d.goods_id=obj.data('goodsid');
                d.img=obj.data('img');
                d.goods_name = obj.data('goodsname');
                d.goods_price = obj.data('goodsprice');
                var goods_spec = obj.data('goodsec');
                if(goods_spec>0){
                    d.goods_spec = goods_spec;
                    d.goods_specname = obj.data('specname');
                }else{
                    d.goods_spec = 0;
                    d.goods_specname = '无规格';
                }
                d.goods_total = obj.data('goodsnum');
                d.goods_totalcount = obj.data('goodstotal');
            }else if(type==5){
                d.type=5;
                d.coupon_id=obj.data('couponid');
                d.img=obj.data('img');
                d.coupon_name=obj.data('couponname');
                d.coupon_num=obj.data('couponnum');
                d.coupon_total=obj.data('coupontotal');

            }
            rec_reward.push(d);
        });
        var reward_rank = [];
        $('#rec-rank .panel').each(function () {
            var obj = $(this);
            var d = {};
            d.rank = obj.data('rank');
            d.title = obj.data('title');
            d.icon = obj.data('icon');
            d.probability = obj.data('probability');
            reward_rank.push(d);
        });
        $('input[name="reward_data"]').val( JSON.stringify(rec_reward));
        $('input[name="reward_rank"]').val( JSON.stringify(reward_rank));
        $('form').removeAttr('stop');
        return true;

    });

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
