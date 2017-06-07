<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
	<span class='pull-right'>

		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('merch/reg')?>">返回列表</a>
	</span>
    <h2>处理商户入驻申请
        <small><?php  echo $item['merchname'];?></small>
    </h2>
</div>


<form id="setform" <?php if(cv('merch.reg.detail')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate">
<input type="hidden" name="id" value="<?php  echo $item['id'];?>"/>

<div class="form-group">
    <label class="col-sm-2 control-label">昵称</label>
    <div class="col-sm-8">
        <div class="form-control-static"><a target="_blank" href="<?php  echo webUrl('member/list/detail',array('id'=>$member['id']))?>"> <?php  echo $member['nickname'];?></a></div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">openid</label>
    <div class="col-sm-8">
        <div class="form-control-static"><?php  echo $item['openid'];?></div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label must">商户名称</label>
    <div class="col-sm-8">
        <?php if( ce('merch.user' ,$item) ) { ?>
        <input type="text" class="form-control" name="merchname" value="<?php  echo $item['merchname'];?>" data-rule-required="true"/>
        <?php  } else { ?>
        <div class="form-control-static"><?php  echo $item['merchname'];?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label must">主营项目</label>
    <div class="col-sm-8">
        <?php if( ce('merch.user' ,$item) ) { ?>
        <input type="text" class="form-control" name="salecate" value="<?php  echo $item['salecate'];?>" data-rule-required="true"/>
        <?php  } else { ?>
        <div class="form-control-static"><?php  echo $item['merchname'];?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label must">联系人</label>
    <div class="col-sm-8">
        <?php if( ce('merch.user' ,$item) ) { ?>
        <input type="text" class="form-control" name="realname" value="<?php  echo $item['realname'];?>" data-rule-required="true"/>
        <?php  } else { ?>
        <div class="form-control-static"><?php  echo $item['realname'];?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label must">联系电话</label>
    <div class="col-sm-8">
        <?php if( ce('merch.user' ,$item) ) { ?>
        <input type="tel" class="form-control" name="mobile" value="<?php  echo $item['mobile'];?>" data-rule-required="true"/>
        <?php  } else { ?>
        <div class="form-control-static"><?php  echo $item['mobile'];?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">商户简介</label>
    <div class="col-sm-8">
        <?php if( ce('merch.user' ,$item) ) { ?>
        <textarea name="desc" class="form-control"><?php  echo $item['desc'];?></textarea>
        <?php  } else { ?>
        <div class="form-control-static"><?php  echo $item['desc'];?></div>
        <?php  } ?>
    </div>
</div>


<?php  if($diyform_flag) { ?>

<div class="form-group-title">追加资料</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/diyform_input', TEMPLATE_INCLUDEPATH)) : (include template('diyform/diyform_input', TEMPLATE_INCLUDEPATH));?>

<?php  } ?>

<div class="form-group-title">申请操作</div>
<div class="form-group">
    <label class="col-sm-2 control-label">申请状态</label>
    <div class="col-sm-8">
        <?php if(cv('merch.reg.detail')) { ?>
        <label class="radio-inline">
            <input type="radio" name="status" value="0" <?php  if($item['status']==0) { ?>checked<?php  } ?> onclick='showReason(false)'/>
            申请中
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" value="-1" <?php  if($item['status']==-1) { ?>checked<?php  } ?>
            onclick='showReason(true)'/> 驳回申请
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" value="1" <?php  if($item['status']==1) { ?>checked<?php  } ?> onclick='showReason(false)'/>
            允许入驻
        </label>
        <?php  } else { ?>
        <div class="form-control-static">
            <?php  if($item['status']==0) { ?>
              申请中
            <?php  } else if($item['stauts']==-1) { ?>
            驳回申请
            <?php  } else if($item['stauts']==1) { ?>
            允许入驻
            <?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>

<div class="form-group" id="reason" <?php  if($item['status']!=-1) { ?>style='display:none'<?php  } ?>>
<label class="col-sm-2 control-label">驳回理由</label>
<div class="col-sm-8">
    <?php if(cv('merch.reg.detail')) { ?>
    <textarea name="reason" class="form-control"><?php  echo $item['reason'];?></textarea>
    <?php  } else { ?>
    <div class="form-control-static"><?php  echo $item['reason'];?></div>
    <?php  } ?>
</div>
</div>


<?php if(cv('merch.reg.detail')) { ?>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <input type="submit" value="提交" class="btn btn-primary"/>
    </div>
</div>
<?php  } ?>

</form>
<script>
    function showReason(show) {
        if (show) {
            $('#reason').show();
        } else {
            $('#reason').hide();
        }
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>