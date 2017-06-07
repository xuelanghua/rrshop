<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">

    <div class="alert alert-danger">
        警告：当模板中已经添加数据后切换自定义表单模板有可能导致无法使用！
    </div>

    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义表单形式</label>

        <?php if( mce('goods' ,$item) ) { ?>
        <div class="col-sm-9 col-xs-12">
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="0" name="diyformtype" <?php  if(empty($item['diyformtype'])) { ?>checked="true"<?php  } ?>> 关闭
            </label>
            <label class="radio radio-inline" style="float: left;">
                <input type="radio" value="2" name="diyformtype" <?php  if($item['diyformtype'] == 2) { ?>checked="true"<?php  } ?>> 开启
            </label>
        </div>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(empty($item['diyformtype'])) { ?>
            关闭
            <?php  } else { ?>
            开启
            <?php  } ?>
        </div>
        <?php  } ?>

    </div>

    <div class="diyform-group" style="margin:0 25px;" <?php  if($item['diyformtype'] != 2) { ?>style="display:none;"<?php  } ?>>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/temp/tpl/data', TEMPLATE_INCLUDEPATH)) : (include template('diyform/temp/tpl/data', TEMPLATE_INCLUDEPATH));?>
    </div>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/temp/tpl/script_merch', TEMPLATE_INCLUDEPATH)) : (include template('diyform/temp/tpl/script_merch', TEMPLATE_INCLUDEPATH));?>

<script>
    $(function () {
        $(':radio[name=diyformtype]').click(function () {
            window.type = $("input[name='diyformtype']:checked").val();

            if(window.type=='2'){
                $('.diyform-group').show();
            } else {
                $('.diyform-group').hide();
            }
        })
    })
</script>
