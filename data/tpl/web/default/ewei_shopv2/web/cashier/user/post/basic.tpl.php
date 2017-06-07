<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-sm-2 control-label">所属门店</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<?php  echo tpl_selector('storeid',array('key'=>'id','text'=>'storename', 'nokeywords'=>1,'multi'=>0,'placeholder'=>'门店名称','buttontext'=>'选择所属门店', 'items'=>$store,'url'=>webUrl('shop/verify/store/query') ))?>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['storeid'];?></div>
		<?php  } ?>
	</div>
</div>


<div class="form-group">
	<label class="col-sm-2 control-label">所属多商户</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<?php  echo tpl_selector('merchid',array('key'=>'id','text'=>'merchname', 'nokeywords'=>1,'multi'=>0,'placeholder'=>'选择所属多商户','buttontext'=>'选择所属多商户', 'items'=>$merchres,'url'=>webUrl('merch/user/query') ))?>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['merchid'];?></div>
		<?php  } ?>
	</div>
</div>

<!--<div class="form-group">
	<label class="col-sm-2 control-label">所属套餐</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<select class="form-control" name="setmeal" required>
			<?php  if(is_array($this->model->setmeal)) { foreach($this->model->setmeal as $key => $val) { ?>
			<option value="<?php  echo $key;?>" <?php  if($item['setmeal']==$key) { ?>selected<?php  } ?>><?php  echo $val;?></option>
			<?php  } } ?>
		</select>
		<?php  } else { ?>
		<div class="form-control-static">
			<?php  if(is_array($this->model->setmeal)) { foreach($this->model->setmeal as $key => $val) { ?>
			<?php  if($item['setmeal']==$key) { ?><?php  echo $val;?><?php  } ?>
			<?php  } } ?>
		</div>
		<?php  } ?>
	</div>
</div>-->

<div class="form-group">
	<label class="col-sm-2 control-label must">收银台名称</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" data-rule-required="true"/>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['title'];?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">手机端顶部banner</label>
	<div class="col-sm-8 col-xs-12">
		<?php if(cv('cashier.user.edit')) { ?>
		<?php  echo tpl_form_field_image('logo',$item['logo'],'../addons/ewei_shopv2/static/images/nopic.jpg')?>
		<?php  } else { ?>
		<?php  if(empty($item['logo'])) { ?>
		<img src="../addons/ewei_shopv2/static/images/nopic.jpg" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
		<?php  } else { ?>
		<img src="<?php  echo tomedia($item['logo'])?>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg'; this.title='图片未找到.'" class="img-responsive img-thumbnail" width="150">
		<?php  } ?>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">是否开启分销</label>
	<div class="col-sm-8 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<label class='radio-inline'>
			<input type='radio' name='isopen_commission' value='0' <?php  if(empty($item['isopen_commission'])) { ?>checked<?php  } ?> /> 不开启
		</label>
		<label class='radio-inline'>
			<input type='radio' name='isopen_commission' value='1' <?php  if($item['isopen_commission']==1) { ?>checked<?php  } ?> /> 开启
		</label>
		<div class='help-block'>如果默认开启 , 支付的人默认成为管理人的下线(前提是,用户在商城有信息且没有上级)</div>
		<?php  } else { ?>
		<div class='form-control-static'><?php  if(empty($item['isopen_commission'])) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label must">联系人</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<input type="tel" class="form-control" name="name" value="<?php  echo $item['name'];?>" data-rule-required="true"/>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['name'];?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label must">联系电话</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<input type="tel" class="form-control" name="mobile" value="<?php  echo $item['mobile'];?>" data-rule-required="true"/>
		<?php  } else { ?>
		<div class="form-control-static"><?php  echo $item['mobile'];?></div>
		<?php  } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">收银台分类</label>
	<div class="col-sm-8">
		<?php if( ce('cashier.user' ,$item) ) { ?>
		<select class="form-control" name="categoryid" required>
			<option value="0">请选择分类</option>
			<?php  if(is_array($category)) { foreach($category as $c) { ?>
			<option value="<?php  echo $c['id'];?>" <?php  if($item['categoryid']==$c['id']) { ?>selected<?php  } ?>><?php  echo $c['catename'];?></option>
			<?php  } } ?>
		</select>
		<?php  } else { ?>
		<div class="form-control-static">
			<?php  if(is_array($category)) { foreach($category as $c) { ?>
			<?php  if($item['categoryid']==$c['id']) { ?><?php  echo $c['catename'];?><?php  } ?>
			<?php  } } ?>
		</div>
		<?php  } ?>
	</div>
</div>