<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-default panel-class" style="margin-top: 20px;">
<div class="panel-heading">添加/修改 操作员</div>
<form id="setform"  action="" method="post" class="form-horizontal form-validate">

    <div class="form-group">
        <label class="col-sm-2 control-label must">操作员名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" required/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label must">操作员权限</label>
        <div class="col-sm-8">
            <?php  if(is_array(CashierModel::perm())) { foreach(CashierModel::perm() as $k => $v) { ?>
            <label for="<?php  echo $k;?>" class="checkbox-inline">
                <input type="checkbox" name="perm[]" value="<?php  echo $k;?>" id="<?php  echo $k;?>" <?php  if(in_array($k,$perm)) { ?>checked="true"<?php  } ?> /> <?php  echo $v;?>
            </label>
            <?php  } } ?>
        </div>
    </div>

    <?php  if(!empty($item)) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">操作员收款</label>
        <div class="col-sm-9 col-xs-12">
            <p class='form-control-static'><?php  echo mobileUrl('cashier/pay',array('cashierid'=>$_W['cashierid'],'operatorid'=>$id),true)?></p>
            <div class="input-group " style="margin-top:.5em;">
                <img src="<?php  echo cashierUrl('qr',array('url'=>mobileUrl('cashier/pay',array('cashierid'=>$_W['cashierid'],'operatorid'=>$id),true)))?>" this.title='图片未找到.' class="img-responsive img-thumbnail" width="150">
            </div>
            <div class="help-block"> 用于操作员收款,订单操作员属于此操作员!</div>
        </div>
    </div>
    <?php  } ?>
    <div class="form-group-title">帐号信息</div>

    <div class="form-group">
        <label class="col-sm-2 control-label must">登录用户名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="username" value="<?php  echo $item['username'];?>" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">登录密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="password" placeholder="默认空,则不修改原密码!"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">绑定操作员微信号</label>
        <div class="col-sm-8">
            <?php  echo tpl_selector('manageopenid',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>0,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择操作人', 'items'=>$manageopenid,'url'=>cashierUrl('index/query') ))?>
        </div>
    </div>

<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <input type="submit"  value="提交" class="btn" />
    </div>
</div>

</form>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>