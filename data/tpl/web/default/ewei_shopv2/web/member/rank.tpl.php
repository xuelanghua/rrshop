<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='page-heading'><h2>排行榜设置  <?php if(cv('member.rank')) { ?><?php  } ?></h2></div>

<form <?php if(cv('member.rank.edit')) { ?>action="" method="post"<?php  } ?> class='form-horizontal form-validate'>

    <div class="form-group-title">积分排行榜设置</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">直接链接</label>
        <div class="col-sm-9 col-xs-12">
            <p class='form-control-static'>
                <a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php  echo mobileUrl('member/rank',array(),true)?>" >
                    <?php  echo mobileUrl('member/rank',array(),true)?>
                </a>
                <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true"
                      data-content="<img src='<?php  echo $qrcode_credit;?>' width='130' alt='链接二维码'>" data-placement="auto right">
                    <i class="glyphicon glyphicon-qrcode"></i>
                </span>
            </p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">积分排行榜开关</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('member.rank.edit')) { ?>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" <?php  if(empty($item['status'])) { ?>checked<?php  } ?> /> 关闭
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="1" <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 开启
            </label>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if(empty($item['status'])) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">积分榜显示数量</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('member.rank.edit')) { ?>
            <input type="text" name="num" class="form-control" value="<?php  echo $item['num'];?>"/>
            <span class='help-block'>如果不填写，默认显示前50名</span>
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['num'];?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group-title">消费排行榜设置</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">直接链接</label>
        <div class="col-sm-9 col-xs-12">
            <p class='form-control-static'>
                <a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php  echo mobileUrl('member/rank/order_rank',array(),true)?>" >
                    <?php  echo mobileUrl('member/rank/order_rank',array(),true)?>
                </a>
                <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true"
                      data-content="<img src='<?php  echo $qrcode_money;?>' width='130' alt='链接二维码'>" data-placement="auto right">
                    <i class="glyphicon glyphicon-qrcode"></i>
                </span>
            </p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">消费排行榜开关</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('member.rank.edit')) { ?>
            <label class="radio-inline">
                <input type="radio" name="order_status" value="0" <?php  if(empty($item['order_status'])) { ?>checked<?php  } ?> /> 关闭
            </label>
            <label class="radio-inline">
                <input type="radio" name="order_status" value="1" <?php  if($item['order_status']==1) { ?>checked<?php  } ?> /> 开启
            </label>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if(empty($item['order_status'])) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">消费榜显示数量</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('member.rank.edit')) { ?>
            <input type="text" name="order_num" class="form-control" value="<?php  echo $item['order_num'];?>"/>
            <span class='help-block'>如果不填写，默认显示前50名</span>
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['order_num'];?></div>
            <?php  } ?>
        </div>
    </div>
    <?php if(cv('member.rank.edit')) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <input type="submit" class="btn btn-primary" value="保存">
    </div>
    <?php  } ?>
</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>