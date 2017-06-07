<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"><h2>系统授权 </h2></div>


<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >

    <div class="form-group">
        <label class="col-sm-2 control-label">网站域名</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="domain" class="form-control" value="<?php  echo $domain;?>" readonly/>
            <span class="help-block">服务器域名</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">网站IP</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="ip" class="form-control" value="<?php  echo $ip;?>" readonly/>
            <span class="help-block">网站IP地址</span>		
        </div>
    </div>
	
	
	
	
  
    <div class="form-group">
        
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <div class='form-control-static'>
                <?php  if(!empty($result['status'])) { ?>
                <input type="button" style="margin-left:10px;" onclick="location.href='<?php  echo webUrl('system/auth/upgrade')?>'" value="系统升级" class="btn btn-primary" />
                <?php  } ?>

            </div>
        </div>
    </div>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>