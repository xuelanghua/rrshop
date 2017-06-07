<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class="clearfix">
    <form class="form-horizontal form" action="" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">温馨提示：此功能适合认证服务号</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">背景图</label>
                    <div class="col-sm-8 col-xs-12">
                        <?php  echo tpl_form_field_image('bgimg', $data['bgimg'])?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group margin-bottom">
            <div class="col-sm-12">
                <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
            </div>
        </div>
    </form>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>