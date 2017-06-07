<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="../addons/ewei_shopv2/static/js/dist/area/cascade.js"></script>
<div class="page-heading"> 
    <span class='pull-right'>
        <?php if(cv('shop.refundaddress.add')) { ?>
        	<a class="btn btn-primary btn-sm" href="<?php  echo webUrl('shop/refundaddress/add')?>">添加新退货地址</a>
        <?php  } ?>
        <a class="btn btn-default  btn-sm" href="<?php  echo webUrl('shop/refundaddress')?>">返回列表</a>
    </span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>退货地址 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></h2>
</div>


<form <?php if( ce('shop.refundaddress' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
    <div class="form-group">
        <label class="col-sm-2 control-label must">退货地址名称</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('shop.refundaddress' ,$item) ) { ?>
            	<input type="text" id='title' name="title" class="form-control" value="<?php  echo $item['title'];?>" data-rule-required='true' />
            <?php  } else { ?>
            	<div class='form-control-static'><?php  echo $item['title'];?></div>
            <?php  } ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label must">联系人</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('shop.refundaddress' ,$item) ) { ?>
            	<input type="text" id='name' name="name" class="form-control" value="<?php  echo $item['name'];?>"  required style="width: 300px;"/>
            <?php  } else { ?>
            	<div class='form-control-static'><?php  echo $item['name'];?></div>
            <?php  } ?>

        </div>`
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label must">手机</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('shop.refundaddress' ,$item) ) { ?>
            	<input type="text" id='mobile' name="mobile" class="form-control" value="<?php  echo $item['mobile'];?>" style="width: 300px;"/>
            <?php  } else { ?>
            	<div class='form-control-static'><?php  echo $item['mobile'];?></div>
            <?php  } ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">电话</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('shop.refundaddress' ,$item) ) { ?>
            	<input type="text" id='tel' name="tel" class="form-control" value="<?php  echo $item['tel'];?>" style="width: 300px;"/>
            <?php  } else { ?>
            	<div class='form-control-static'><?php  echo $item['mobile'];?></div>
            <?php  } ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">邮编</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('shop.refundaddress' ,$item) ) { ?>
            	<input type="text" id='zipcode' name="zipcode" class="form-control" value="<?php  echo $item['zipcode'];?>" style="width: 300px;"/>
            <?php  } else { ?>
            	<div class='form-control-static'><?php  echo $item['zipcode'];?></div>
            <?php  } ?>

        </div>
    </div>

    <?php  if(!empty($item['id'])) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">地址</label>
        <div class="col-sm-9 col-xs-12">
            <div class='form-control-static'><?php  echo $item['province']?> <?php  echo $item['city']?> <?php  echo $item['area']?></div>
        </div>
    </div>
    <?php  } ?>

    <div class="form-group">
        <label class="col-sm-2 control-label must"><?php  if(!empty($item['id'])) { ?>新<?php  } ?>地址</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('shop.refundaddress' ,$item) ) { ?>
	            <p>
	                <select id="sel-provance" name="province" onChange="selectCity();" class="select form-control" style="width:130px;display:inline;">
	                    <option value="" selected="true">省/直辖市</option>
	                </select>
	                <select id="sel-city" name="city" onChange="selectcounty(0)" class="select form-control" style="width:135px;display:inline;">
	                    <option value="" selected="true">请选择</option>
	                </select>
	                <select id="sel-area" name="area" class="select form-control" style="width:130px;display:inline;">
	                    <option value="" selected="true">请选择</option>
	                </select>
	            </p>
	            <p>
	                <input type="text" name="address" id="address" class="form-control" style="width:300px;" required value="<?php  echo $item['address']?>">
	            </p>
            <?php  } ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label ">是否默认</label>

        <div class="col-sm-9 col-xs-12">
            <?php if( ce('shop.refundaddress' ,$item) ) { ?>
	            <label class='radio-inline'>
	                <input type='radio' name='isdefault' id="isdefault1" value='1' <?php  if($item['isdefault']==1) { ?>checked<?php  } ?> /> 是
	            </label>
	            <label class='radio-inline'>
	                <input type='radio' name='isdefault' id="isdefault0" value='0' <?php  if($item['isdefault']==0) { ?>checked<?php  } ?> /> 否
	            </label>
            <?php  } else { ?>
            	<div class='form-control-static'><?php  if(empty($item['calculatetype'])) { ?>按重量计费<?php  } else { ?>按件计费<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label "></label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('shop.refundaddress' ,$item) ) { ?>
            	<input type="submit" value="提交" class="btn btn-primary"  />
            <?php  } ?>
            <input type="button" name="back" onclick='history.back()' <?php if(cv('shop.refundaddress.add|shop.refundaddress.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
        </div>
    </div>


</div>
</div>

</form>
</div>

<script language='javascript'>

    <?php if( ce('shop.refundaddress' ,$item) ) { ?>
    $(function(){
        cascdeInit("<?php  echo $new_area?>","0","<?php  echo $item['province']?>","<?php  echo $item['city']?>","<?php  echo $item['area']?>");
    });
    <?php  } ?>

    function formcheck() {

        if ($("#title").isEmpty()) {
            Tip.focus("title", "请填写退货地址名称!", "top");
            return false;
        }

        if ($("#name").isEmpty()) {
            Tip.focus("name", "请填写联系人!", "top");
            return false;
        }

        if ($("#mobile").isEmpty()) {
            Tip.focus("mobile", "请填写手机!", "top");
            return false;
        }

        if($('#sel-province').val()=='请选择省份') {
            Tip.focus("sel-province", "请选择省份!", "top");
            return false;
        }

        if ($("#address").isEmpty()) {
            Tip.focus("address", "请填写地址!", "top");
            return false;
        }

        return true;
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>