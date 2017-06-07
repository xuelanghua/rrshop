<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>七牛存储</h2> </div>

<form method="post" class="form-horizontal form-validate">
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启</label>
        <div class="col-sm-9">
            <?php if(cv('sysset.qiniu.edit')) { ?>
            <label class="radio-inline"><input type="radio" name="data[upload]" value="1" <?php  if($data['upload']==1) { ?> checked="checked"<?php  } ?> onclick="openQiniu(true)"/>开启</label>
            <label class="radio-inline"><input type="radio" name="data[upload]" value="0" <?php  if(empty($data['upload'])) { ?> checked="checked"<?php  } ?>  onclick="openQiniu(false)"/>关闭</label>
            <span class="help-block">开启七牛存储，关闭则使用系统默认的存储方式 [<?php  if($admin['upload']==1) { ?>七牛<?php  } else { ?>本地<?php  } ?>], <a href="http://www.qiniu.com/" target="_blank">七牛存储</a></span>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if($data['upload']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>
    <div id='qiniu' <?php  if(empty($data['upload'])) { ?>style='display:none'<?php  } ?>>
        <div class="form-group " >
            <label class="col-xs-12 col-sm-3 col-md-2 control-label must">存储区域</label>
            <div class="col-sm-9">
                <?php if(cv('sysset.qiniu.edit')) { ?>
                <select name="data[zone]" class="form-control">
                    <option value="zone0" <?php  if($data['zone']=='zone0') { ?> selected<?php  } ?>>华东</option>
                    <option value="zone1" <?php  if($data['zone']=='zone1') { ?> selected<?php  } ?>>华北</option>
                </select>
                <?php  } else { ?>
                <div class='form-control-static'><?php  if($data['zone']=='zone0') { ?>华东<?php  } else { ?>华北<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group " >
            <label class="col-xs-12 col-sm-3 col-md-2 control-label must">ACCESS_KEY</label>
            <div class="col-sm-9">
                <?php if(cv('sysset.qiniu.edit')) { ?>
                <input type="text" name="data[access_key]" class="form-control" value="<?php  echo $data['access_key'];?>" data-rule-required='true'>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['access_key'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group" >
            <label class="col-xs-12 col-sm-3 col-md-2 control-label must">SECRET_KEY</label>
            <div class="col-sm-9">
                <?php if(cv('sysset.qiniu.edit')) { ?>
                <input type="text" name="data[secret_key]" class="form-control" value="<?php  echo $data['secret_key'];?>" data-rule-required='true'/>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['secret_key'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group" >
            <label class="col-xs-12 col-sm-3 col-md-2 control-label must">BUCKET(空间名称)</label>
            <div class="col-sm-9">
                <?php if(cv('sysset.qiniu.edit')) { ?>
                <input type="text" name="data[bucket]" class="form-control" value="<?php  echo $data['bucket'];?>" data-rule-required='true'/>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['bucket'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label must">URL(空间链接)</label>
            <div class="col-sm-9">
                <?php if(cv('sysset.qiniu.edit')) { ?>
                <input type="text" name="data[url]" class="form-control" value="<?php  echo $data['url'];?>" data-rule-required='true'/>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['url'];?></div>
                <?php  } ?>
            </div>
        </div>
</div>
    <?php if(cv('sysset.qiniu.edit')) { ?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label "></label>
        <div class="col-sm-9">
            <input type="submit" value="提交" class="btn btn-primary"/>
        </div>
    </div>
    <?php  } ?>
    <script language="javascript">
        function openQiniu(open) {
            if (open) {
                $('#qiniu').show();
            } else {
                $('#qiniu').hide();
            }
        }
    </script>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>