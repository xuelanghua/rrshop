<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title"><?php  if(empty($address)) { ?>新建地址<?php  } else { ?>编辑地址<?php  } ?></div>
        <div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content'>
        <form method='post' class='form-ajax' >
            <input type='hidden' id='addressid' value="<?php  echo $address['id'];?>"/>
            <div class='fui-cell-group'>
                <div class='fui-cell'>
                    <div class='fui-cell-label'>收件人</div>
                    <div class='fui-cell-info'><input type="text" id='realname'  name='realname' value="<?php  echo $address['realname'];?>" placeholder="收件人" class="fui-input"/></div>
                </div>
                <div class='fui-cell'>
                    <div class='fui-cell-label'>联系电话</div>
                    <div class='fui-cell-info'><input type="tel" id='mobile' name='mobile' value="<?php  echo $address['mobile'];?>" placeholder="联系电话"  class="fui-input"/></div>
                </div>

                <div class='fui-cell'>
                    <div class='fui-cell-label'>所在地区</div>
                    <div class='fui-cell-info'><input type="text" id='areas'  name='areas' data-value="<?php  if(!empty($show_data) && !empty($address)) { ?><?php  echo $address['datavalue'];?><?php  } ?>" value="<?php  if(!empty($show_data) && !empty($address)) { ?><?php  echo $address['province'];?> <?php  echo $address['city'];?> <?php  echo $address['area'];?><?php  } ?>" placeholder="所在地区"  class="fui-input" readonly=""/></div>
                </div>

                <?php  if(!empty($new_area) && !empty($address_street)) { ?>
                <div class='fui-cell'>
                    <div class='fui-cell-label'>所在街道</div>
                    <div class='fui-cell-info'><input type="text" id='street'  name='street' data-value="<?php  if(!empty($address)) { ?><?php  echo $address['streetdatavalue'];?><?php  } ?>" value="<?php  if(!empty($address)) { ?><?php  echo $address['street'];?><?php  } ?>" placeholder="所在街道"  class="fui-input" readonly=""/></div>
                </div>
                <?php  } ?>

                <div class='fui-cell'>
                    <div class='fui-cell-label'>详细地址</div>
                    <div class='fui-cell-info'><input type="text" id='address' name='address' value="<?php  echo $address['address'];?>" placeholder='街道，楼牌号等'  class="fui-input"/></div>
                </div>
            </div>


            
            <a id="btn-submit" class='external btn btn-danger block'>保存地址</a>
              <?php  if(is_weixin() && $_W['shopset']['trade']['shareaddress']) { ?>
                 <a id="btn-address" class='btn btn-success block'>读取微信地址</a>
              <?php  } ?>


        </form>
    </div>
    <script language='javascript' type="text/javascript">

        require(['biz/member/address'], function (modal) {
            modal.initPost({new_area: <?php  echo $new_area?>, address_street: <?php  echo $address_street?>});
        });
    </script>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>