<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
 
<div class="page-heading">
    <span class="pull-right">
           <?php  if('perm.user.add') { ?>
                   <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('perm/user/add')?>"><i class="fa fa-plus"></i> 添加新操作员</a>
           <?php  } ?>
    </span>
    <h2>操作员管理</h2>
</div>


           <form action="./index.php" method="get" class="form-horizontal" user="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="ewei_shopv2" />
                <input type="hidden" name="do" value="web" />
                <input type="hidden" name="r"  value="perm.user" />
<div class="page-toolbar row m-b-sm m-t-sm">
                            <div class="col-sm-4">
				 
			   <div class="input-group-btn">
			        <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
				  <?php if(cv('perm.user.edit')) { ?>
			                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('perm/user/status',array('status'=>1))?>"><i class='fa fa-circle'></i> 启用</button>
				   <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('perm/user/status',array('status'=>0))?>"><i class='fa fa-circle-o'></i> 禁用</button>
				   <?php  } ?>
				<?php if(cv('perm.user.delete')) { ?>	
			        <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('perm/user/delete')?>"><i class='fa fa-trash'></i> 删除</button>
				<?php  } ?>
	 
			   </div> 
                               </div>	
	  
			 
                            <div class="col-sm-6 pull-right">
		  <select name="roleid" class='form-control input-sm select-sm'>
                            <option value="" <?php  if($_GPC['roleid']=='') { ?> selected<?php  } ?>>角色</option>
                            <option value="0" <?php  if($_GPC['roleid']=='0') { ?> selected<?php  } ?>>无角色</option>
                            <?php  if(is_array($roles)) { foreach($roles as $role) { ?>
                            <option value="<?php  echo $role['id'];?>" <?php  if($_GPC['roleid']== $role['id']) { ?> selected<?php  } ?>><?php  echo $role['rolename'];?></option>
                            <?php  } } ?>
                            
                        </select>  
				<select name="status" class='form-control input-sm select-sm'>
					<option value="" <?php  if($_GPC['status'] == '') { ?> selected<?php  } ?>>状态</option>
					 <option value="1" <?php  if($_GPC['status']== '1') { ?> selected<?php  } ?>>启用</option>
					 <option value="0" <?php  if($_GPC['status'] == '0') { ?> selected<?php  } ?>>禁用</option>
				</select>	
				<div class="input-group">				 
                                        <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">
						
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
                                </div>
								
                            </div>
</div>
  </form>
 <?php  if(count($list)>0) { ?>
 

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                         <th style="width:25px;"><input type='checkbox' /></th>
                        <th style='width:200px'>登录ID</th>
                        <th style='width:100px'>角色</th>
                        <th style='width:100px'>姓名</th>
                        <th style='width:100px'>手机</th>
                        <th style='width:80px'>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                         <td><input type='checkbox'   value="<?php  echo $row['id'];?>"/></td>
                        <td><?php  echo $row['username'];?></td>
                        <td><?php echo !empty($row['rolename'])?$row['rolename']:'无'?></td>
                        <td><?php  echo $row['realname'];?></td>
                        <td><?php  echo $row['mobile'];?></td>
                        <td>
                           <span class='label <?php  if($row['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>' 
										  <?php if(cv('shop.adv.edit')) { ?>
										  data-toggle='ajaxSwitch' 
										  data-switch-value='<?php  echo $row['status'];?>'
										  data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('perm/user/status',array('status'=>1,'id'=>$row['id']))?>'  
										  data-switch-value1='1|启用|label label-success|<?php  echo webUrl('perm/user/status',array('status'=>0,'id'=>$row['id']))?>'  
										  <?php  } ?>
										>
										  <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
                        </td>
                        <td>
                            <?php if(cv('perm.user.view|perm.user.edit')) { ?><a class='btn btn-default btn-sm' href="<?php  echo webUrl('perm/user/edit', array('id' => $row['id']))?>"><i class="fa fa-edit"></i>  <?php if(cv('perm.role.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a><?php  } ?>
                            <?php if(cv('perm.user.delete')) { ?><a class='btn btn-default btn-sm' data-toggle='ajaxRemove'  href="<?php  echo webUrl('perm/user/delete', array('id' => $row['id']))?>" data-confirm="确认删除此操作员吗？"><i class="fa fa-trash"></i> 删除</a><?php  } ?>
                        
                        </td>
                    </tr>
                    <?php  } } ?>
                 
                </tbody>
            </table>
            <?php  echo $pager;?>
          <?php  } else { ?>
<div class='panel panel-default'>
	<div class='panel-body' style='text-align: center;padding:30px;'>
		 暂时没有任何操作员!
	</div>
</div>

</form>



<?php  } ?>
<script language='javascript'>
 
                function search_users() {
		$("#module-menus1").html("正在搜索....")
		$.get('<?php  echo webUrl('perm/user',array('op'=>'query'));?>', {
			keyword: $.trim($('#search-kwd1').val())
		}, function(dat){
			$('#module-menus1').html(dat);
		});
	}
	function select_user(o) {
		$("#userid").val(o.id);
		$("#user").val( o.username );
                                var perms = o.perms.split(',');
                                $(':checkbox')
                                $(':checkbox').removeAttr('disabled').removeAttr('checked').each(function(){
                                    
                                    var _this = $(this);
                                    var perm = '';
                                    if( _this.data('group') ){
                                        perm+=_this.data('group');
                                    }
                                    if( _this.data('child') ){
                                        perm+="." +_this.data('child');
                                    }
                                    if( _this.data('op') ){
                                        perm+="." +_this.data('op');
                                    }
                                    if( $.arrayIndexOf(perms,perm)!=-1){
                                        $(this).attr('disabled',true).get(0).checked =true;
                                    }
                                     
                                });
		$(".close").click();
	}
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
 