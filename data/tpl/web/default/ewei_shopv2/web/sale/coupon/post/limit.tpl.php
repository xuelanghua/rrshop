<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
    .coupon-radio{display: block;}
</style>
<div class="form-group">
    <label class="col-sm-2 control-label">优惠使用限制</label>
    <div class="col-sm-9 col-xs-12" >
        <?php if( ce('sale.coupon' ,$item) ) { ?>
        <label class="radio-inline coupon-radio">
            <input type="radio" name="limitdiscounttype" value="0" <?php  if($item['limitdiscounttype'] == 0) { ?>checked="true"<?php  } ?>  /> 不添加优惠使用限制
        </label>
        <label class="radio-inline coupon-radio">
            <input type="radio" name="limitdiscounttype" value="1" <?php  if($item['limitdiscounttype'] == 1) { ?>checked="true"<?php  } ?>" /> 不允许与促销优惠同时使用
        </label>
        <label class="radio-inline coupon-radio">
            <input type="radio" name="limitdiscounttype" value="2" <?php  if($item['limitdiscounttype'] == 2) { ?>checked="true"<?php  } ?>  /> 不允许与会员折扣同时使用
        </label>
        <label class="radio-inline coupon-radio">
            <input type="radio" name="limitdiscounttype" value="3" <?php  if($item['limitdiscounttype'] == 3) { ?>checked="true"<?php  } ?>  /> 不允许与促销优惠和会员折扣同时使用
        </label>
        <span class='help-block'>优惠券是否可以与特定优惠同时使用</span>

        <?php  } else { ?> <div class='form-control-static'>
            <?php  if($item['limitdiscounttype']==0) { ?>不添加优惠使用限制
            <?php  } else if($item['limitdiscounttype']==1) { ?>不允许与促销优惠同时使用
            <?php  } else if($item['limitdiscounttype']==2) { ?>不允许与会员折扣同时使用
            <?php  } else if($item['limitdiscounttype']==3) { ?>不允许与促销优惠和会员折扣同时使用
            <?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">商品分类使用限制</label>
    <div class="col-sm-9 col-xs-12" >
          <?php if( ce('sale.coupon' ,$item) ) { ?>
        <label class="radio-inline coupon-radio">
            <input type="radio" name="limitgoodcatetype" value="0" <?php  if($item['limitgoodcatetype'] == 0) { ?>checked="true"<?php  } ?>  onclick="$('.selectcats').hide();"/> 不添加商品分类限制
        </label>
        <label class="radio-inline coupon-radio">
            <input type="radio" name="limitgoodcatetype" value="1" <?php  if($item['limitgoodcatetype'] == 1) { ?>checked="true"<?php  } ?> onclick="$('.selectcats').show();" /> 允许以下商品分类使用
        </label>
        <span class='help-block'>优惠券是否只能用于特定商品或商品类型</span>
		
          <?php  } else { ?> <div class='form-control-static'>
                <?php  if($item['limitgoodcatetype']==0) { ?>不添加商品分类限制
                <?php  } else if($item['limitgoodcatetype']==1) { ?>允许以下商品分类使用
                <?php  } ?>
          </div>
          <?php  } ?>
    </div>
</div>

<div class="form-group selectcats" <?php  if($item['limitgoodcatetype']!=1&&$item['limitgoodcatetype']!=2) { ?>style="display:none"<?php  } ?>>
    <?php if( ce('sale.coupon' ,$item) ) { ?>
        <div class="form-group" >
            <label class="col-sm-2 control-label">选择商品分类</label>
            <div class="col-sm-9 col-xs-12">
                <select id="cates"  name='cates[]' class="form-control select2" style='width:605px;' multiple='' >
                    <?php  if(is_array($goodcategorys)) { foreach($goodcategorys as $c) { ?>
                    <option value="<?php  echo $c['id'];?>" <?php  if(is_array($cates) &&  in_array($c['id'],$cates)) { ?>selected<?php  } ?> ><?php  echo $c['name'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>
    <?php  } else { ?>
        <div class='form-control-static ops'>
            <?php  if(is_array($cates)) { foreach($cates as $c) { ?>
            <a><?php  echo $goodcategorys[$c]['name'];?></a>
            <?php  } } ?>
        </div>
    <?php  } ?>

</div>

<div class="form-group">
    <label class="col-sm-2 control-label">商品使用限制</label>
    <div class="col-sm-9 col-xs-12" >
        <?php if( ce('sale.coupon' ,$item) ) { ?>
        <label class="radio-inline coupon-radio">
            <input type="radio" name="limitgoodtype" value="0" <?php  if($item['limitgoodtype'] == 0) { ?>checked="true"<?php  } ?> onclick="$('.selectgoods').hide();" /> 不添加商品限制
        </label>
        <label class="radio-inline coupon-radio">
            <input type="radio" name="limitgoodtype" value="1" <?php  if($item['limitgoodtype'] == 1) { ?>checked="true"<?php  } ?> onclick="$('.selectgoods').show();" /> 允许以下商品使用
        </label>

        <?php  } else { ?>
            <div class='form-control-static'>
            <?php  if($item['limitgoodtype']==0) { ?>不添加商品限制
                <?php  } else if($item['limitgoodtype']==1) { ?>允许以下商品使用
            <?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>

<div class="form-group selectgoods" <?php  if($item['limitgoodtype']!=1&&$item['limitgoodtype']!=2) { ?>style="display:none"<?php  } ?>>

    <?php if( ce('sale.coupon' ,$item) ) { ?>
        <div class="form-group" >
            <label class="col-sm-2 control-label">选择商品</label>
            <div class="col-sm-9 col-xs-12">
                <div class="form-group ">
                    <?php  echo tpl_selector('goodsid',array(
                    'preview'=>true,
                    'readonly'=>true,
                    'multi'=>1,
                    'value'=>$item['title'],
                    'url'=>webUrl('sale/coupon/querygoods'),
                    'items'=>$goods,
                    'buttontext'=>'选择商品',
                    'placeholder'=>'请选择商品')
                    )
                    ?>
                </div>
                <span class='help-block'>添加限制的商品必须已上架,并且不属于砍价商品.</span>
            </div>
        </div>
    <?php  } else { ?>
        <?php  if(!empty($goods)) { ?>
            <?php  if(is_array($goods)) { foreach($goods as $item) { ?>
                <a href="<?php  echo tomedia($item['thumb'])?>" target='_blank'>
                    <img src="<?php  echo tomedia($item['thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                </a>
            <?php  } } ?>
        <?php  } else { ?>
            暂无商品
        <?php  } ?>
    <?php  } ?>

</div>









