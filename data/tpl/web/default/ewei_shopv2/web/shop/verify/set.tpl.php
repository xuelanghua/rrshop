<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>O2O设置</h2> </div>

<form id="dataform" action="" method="post" class="form-horizontal form-validate">
    <div class="form-group">
	<label class="col-sm-2 control-label must">核销方式</label>
	<div class="col-sm-9 col-xs-12">
		<?php if(cv('shop.verify.set.edit')) { ?>
		    <label class='radio radio-inline'>
			<input type='radio' name='type' value='0' <?php  if($type==0) { ?>checked<?php  } ?> /> 关键词方式
		    </label>
		    <label class='radio radio-inline'>
			<input type='radio' name='type' value='1' <?php  if($type==1) { ?>checked<?php  } ?> /> 页面方式
		    </label>
		    <span class='help-block'>关键词方式：在公众平台以关键词提示形式进行核销</span>
		    <span class='help-block'>页面方式：从图文页面中进行消费码核销
				<a href="javascript:;" class='btn btn-default btn-sm js-clip' data-url="<?php  echo mobileUrl('verify/page',null,true)?>">
				<i class='fa fa-link'></i> 复制链接
				</a>
				<a href="javascript:void(0);" class="btn btn-default btn-sm" data-toggle="popover" data-trigger="hover" data-html="true"
				   data-content="<img src='<?php  echo $qrcode;?>' width='130' alt='链接二维码'>" data-placement="auto right">
					<i class="glyphicon glyphicon-qrcode"></i>
				</a>
			</span>
		<?php  } else { ?> 
		    <div class="form-control-static"><?php  if(!empty($type)) { ?>页面方式<?php  } else { ?>关键词方式<?php  } ?></div>
	    <?php  } ?>
	</div>
    </div>
    
    <div class="form-group">
	<label class="col-sm-2 control-label must">关键词</label>
	<div class="col-sm-9 col-xs-12">
		<?php if(cv('shop.verify.set.edit')) { ?>
		    <input type="text" name="keyword" class="form-control" value="<?php  echo $keyword;?>" data-rule-required='true' />
		    <span class='help-block'>店员核销使用，使用方法: 回复关键词后系统会提示输入消费码</span>
	    <?php  } else { ?> 
		    <div class="form-control-static"><?php  echo $keyword;?></div>
	    <?php  } ?>
	</div>
    </div>
    
    <div class="form-group">
	<label class="col-sm-2 control-label"></label>
	<div class="col-sm-9 col-xs-12">
		<?php if(cv('shop.verify.set.edit')) { ?>
	    	<input type="submit"  value="保存设置" class="btn btn-primary"/>
	    <?php  } ?>
	</div>
    </div>

</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
