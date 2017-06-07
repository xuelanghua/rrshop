<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-content">
    <div class="page-heading"><h2>入口设置</h2></div>

    <form class="form-horizontal form-validate"  role="form" method="post" >
        <div class="alert alert-warning">入口描述则是用户对应的抽奖列表</div>
        <div class="form-group">
            <label class="col-sm-2 control-label">直接链接</label>
            <div class="col-sm-9 col-xs-12">
                <p class='form-control-static'>
                    <a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php  echo mobileUrl('lottery',null,true)?>" ><?php  echo mobileUrl('lottery',null,true)?></a>
                    <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true"
                          data-content="<img src='<?php  echo $qrcode;?>' width='130' alt='链接二维码'>" data-placement="auto right">
                        <i class="glyphicon glyphicon-qrcode"></i>
                    </span>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">关键词</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('lottery.edit')) { ?>
                <input type='text' class='form-control' name='keyword' value="<?php  echo $set['keyword'];?>" data-rule-required="true" />
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $set['keyword'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">封面标题</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('lottery.edit')) { ?>
                <input type='text' class='form-control' name='title' value="<?php  echo $set['title'];?>" />
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $set['title'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">封面图片</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('lottery.edit')) { ?>
                <?php  echo tpl_form_field_image('thumb',$set['thumb'])?>
                <?php  } else { ?>
                <?php  if(!empty($set['thumb'])) { ?>
                <div class='form-control-static'>
                    <img src="<?php  echo tomedia($set['thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                </div>
                <?php  } ?>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">封面描述</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('lottery.edit')) { ?>
                <textarea name='desc' class='form-control'><?php  echo $set['desc'];?></textarea>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $set['desc'];?></div>
                <?php  } ?>
            </div>
        </div>

        <?php if(cv('lottery.setting.edit|lottery.setting.add')) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10 col-xs-12">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
        <?php  } ?>
    </form>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
