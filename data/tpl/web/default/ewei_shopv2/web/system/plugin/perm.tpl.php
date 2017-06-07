<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

 <div class="page-heading"> <h2>应用权限</h2></div>
<div class="panel panel-default" >
    <div class="panel-body">
        <div class="col-sm-9 col-xs-12">
            <h4>公众号应用权限</h4>
            <span>如果开启，除超级管理员所属的公众号都要设置应用的使用权限。</span>
        </div>
        <div class="col-sm-2 pull-right" style="padding-top:10px;text-align: right" >
			<input type="checkbox" class="js-switch" value="1" <?php  if($permset) { ?>checked<?php  } ?> data-toggle="ajaxPost"  data-href="<?php  echo webUrl('system/plugin/perm/switchs')?>" />
        </div>
    </div>
</div>

 <?php  if($permset) { ?>
    <form action="./index.php" method="get" class="form-horizontal">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="ewei_shopv2" />
            <input type="hidden" name="do" value="web" />
            <input type="hidden" name="r" value="system.plugin.perm" />
 <div class="page-heading"> 
        <div class='pull-right search' style='width:400px;margin-right:0;padding-right: 0' >
     
    
		 <div class="input-group" >	
                    
                                        <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="公众号名称">
                                        <span class="input-group-btn">
				
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
		 <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('system/plugin/perm/add')?>"><i class="fa fa-plus"></i> 添加新权限</a>
           </div>



     </div>
     <h2>公众号权限列表</h2>
         </div>
 
<?php  if(count($list)>0) { ?>
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th style="width:150px;">公众号</th>
                        
                        <th style="width:250px;">组件权限</th>
                        <th style="width:250px;">应用权限</th>
                        <th>操作</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                      
                        <td>
                            <?php  if(!empty($row['username']) && empty($row['type']) ) { ?>用户: <?php  echo $row['username'];?><?php  } ?>
                            <?php  if(!empty($row['name']) && $row['type']==1) { ?><?php  echo $row['name'];?><?php  } ?>
							  <?php  if(empty($row['type'])) { ?>
                          <label class='label label-default'>失效</label>
                          <?php  } ?>
                        </td>
                         <td style='word-break: break-all;white-space: normal'> 
                            <?php  if(is_array($row['coms'])) { foreach($row['coms'] as $c) { ?>
                            <?php  echo $c['name'];?>;
                            <?php  } } ?>
                        </td>
                        <td style='word-break: break-all;white-space: normal'> 
                            <?php  if(is_array($row['plugins'])) { foreach($row['plugins'] as $p) { ?>
                            <?php  echo $p['name'];?>;
                            <?php  } } ?>
                        </td>
                        <td> 
                            <a class='btn btn-default btn-sm' href="<?php  echo webUrl('system/plugin/perm/edit', array('id' => $row['id']))?>"><i class="fa fa-edit"></i> 编辑</a>
                            <a class='btn btn-default btn-sm' data-toggle="ajaxRemove"  href="<?php  echo webUrl('system/plugin/perm/delete', array('id' => $row['id']))?>" data-confirm="确认删除此公众号权限吗？"><i class="fa fa-trash"></i> 删除</a></td>
                    </tr>
                    <?php  } } ?>
                </tbody>
            </table>
            <?php  echo $pager;?>
 <?php  } else { ?>
 <div class='panel panel-default'>
	<div class='panel-body' style='text-align: center;padding:30px;'>
		 暂时没有任何公众号权限设置!
	</div>
</div>
 <?php  } ?>
 <?php  } ?>

  </form>

  
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>