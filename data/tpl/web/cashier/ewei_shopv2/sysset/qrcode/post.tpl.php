<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="panel panel-default panel-class" style="margin-top:20px;">
    <div class="panel-heading">生成收款二维码</div>
    <div class="panel-body">
        <form id="setform"  action="" method="post" class="form-horizontal form-validate">
            <div class="form-group">
                <label class="col-sm-2 control-label must">二维码名称</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" data-rule-required="true"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">收款名称</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="goodstitle" value="<?php  echo $item['goodstitle'];?>" />
                    <span class="help-block">如果为空,则是收银台名称</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label must">固定金额</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="money" value="<?php  echo $item['money'];?>" data-rule-required="true"/>
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
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>