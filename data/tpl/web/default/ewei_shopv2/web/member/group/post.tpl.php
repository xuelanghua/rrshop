<?php defined('IN_IA') or exit('Access Denied');?> <form <?php if( ce('member.group' ,$group) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?php  echo $group['id'];?>" />
 <input type="hidden" name="r" value="member.group.<?php  if(!empty($group['id'])) { ?>edit<?php  } else { ?>add<?php  } ?>" />
    
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"><?php  if(!empty($group['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>会员分组</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="col-sm-2 control-label must">分组名称</label>
                    <div class="col-sm-9 col-xs-12">
                         <?php if( ce('member.group' ,$group) ) { ?>
                        <input type="text" name="groupname" class="form-control" value="<?php  echo $group['groupname'];?>" data-rule-required="true" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $group['groupname'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                        
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">提交</button>
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
            </div>
        </div>
</form>