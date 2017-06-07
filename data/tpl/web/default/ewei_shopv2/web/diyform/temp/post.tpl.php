<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
<span class='pull-right'>

<?php if(cv('diyform.temp.add')) { ?>
<a class="btn btn-primary btn-sm" href="<?php  echo webUrl('diyform/temp/add')?>">添加新模板</a>
<?php  } ?>

<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('diyform/temp')?>">返回列表</a>


</span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>模板 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></h2>
</div>
<?php if( ce('diyform.temp' ,$item) ) { ?>
<?php  if(!empty($_GPC['id'])) { ?>
<div class="alert alert-info">警告：当模板中已经添加数据后改变模板结构有可能导致无法使用！
    <br/>使用情况：
    <br/>会员资料 (<?php  if($use_flag1) { ?>正在使用<?php  } else { ?>未使用<?php  } ?>)
    <br/>分销商申请资料 (<?php  if($use_flag2) { ?>正在使用<?php  } else { ?>未使用<?php  } ?>)
    <br/>商城商品(<?php  if($datacount3>0) { ?><?php  echo $datacount3?>种商品正在使用<?php  } else { ?>未使用<?php  } ?>)</div>
<?php  } ?>
<?php  } ?>


<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="tp_id" value="<?php  echo $item['id'];?>" />

    <div class="form-group">
        <label class="col-sm-2 control-label" style='width:90px;text-align: left;padding-left:22px;' >分类</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('diyform.temp' ,$item) ) { ?>
            <select name="cate" class="form-control">
                <option value=""></option>
                <?php  if(is_array($category)) { foreach($category as $c) { ?>
                <option value="<?php  echo $c['id'];?>" <?php  if($item['cate']==$c['id']) { ?>selected<?php  } ?>><?php  echo $c['name'];?></option>
                <?php  } } ?>
            </select>
            <?php  } else { ?>
            <?php  if(is_array($category)) { foreach($category as $c) { ?>
            <?php  if($item['cate']==$c['id']) { ?><?php  echo $c['name'];?><?php  } ?>
            <?php  } } ?>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label must" style='width:90px;text-align: left;padding-left:22px;'  >模板名称</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('diyform.temp' ,$item) ) { ?>
            <input type="text" name="tp_title" class="form-control tp_title" value="<?php  echo $item['title'];?>" placeholder="模板名称，例：用户资料" data-rule-required='true' />
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['title'];?></div>
            <?php  } ?>
        </div>
    </div>

    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/temp/tpl/data', TEMPLATE_INCLUDEPATH)) : (include template('diyform/temp/tpl/data', TEMPLATE_INCLUDEPATH));?>

    <div class="form-group">

        <div class="col-sm-9 col-xs-12">
            <?php if( ce('diyform.temp' ,$item) ) { ?>
            <input type="submit" value="提交" class="btn btn-primary"  />

            <?php  } ?>
            <a href="<?php  echo webUrl('diyform')?>"  <?php if( ce('diyform.temp' ,$item) ) { ?>style='margin-left:10px;'<?php  } ?>><span class="btn btn-default" style='margin-left:10px;'>返回列表</span></a>
        </div>
    </div>

</form>

<?php if( ce('diyform.temp' ,$item) ) { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/temp/tpl/script', TEMPLATE_INCLUDEPATH)) : (include template('diyform/temp/tpl/script', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>

<script language='javascript'>

    $('form').submit(function(){
        var check = true;
        $(".tp_title,.tp_name").each(function(){
            var val = $(this).val();
            if(!val){
                $(this).focus(),$('form').attr('stop',1),tip.msgbox.err('不能为空!');
                check =false;
                return false;
            }
        });

        if(kw == 0) {
            $(this).focus(),$('form').attr('stop',1),tip.msgbox.err('请先添加字段再提交!');
            check =false;
            return false;
        }

        if(!check){return false;}
        var o={}; // 判断重复

        if(!check){
            return false;
        }
        $('form').removeAttr('stop');
        return true;
    });

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
