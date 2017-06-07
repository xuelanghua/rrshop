<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
 <div class="page-heading"> 
     <span class='pull-right' style='width:280px;margin-top:20px;'>
          <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="ewei_shopv2" />
            <input type="hidden" name="do" value="web" />
            <input type="hidden" name="r" value="system.plugin.coms" />
            

                            <div class="col-sm-12">
 
		 <div class="input-group" style='padding:0;'>				 
                                        <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="组件名称/组件标识">
                                        <span class="input-group-btn">
				
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
                                </div>
								
                            </div>

  </form>
     </span>
     <h2>应用信息设置 <small>总数：<span class='text-danger'><?php  echo $total;?></span> </small></h2>
         <span>应用关闭状态时只有超级管理员才能使用，安装后默认为关闭</span> </div>
 
<form method='post' class="form-horizontal form-validate">
 
        <table class="table">
            <thead class="navbar-inner">
                <tr>
                   <th style='width:100px;'>标识</th>
                   <th style='width:80px;'>开关</th> 
                   <th style='width:200px;' >组件名称</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
		  
                <tr>
                   
                    <td><?php  echo $row['identity'];?></td>
                    <td>
						 <?php  if($row['identity']=='system') { ?>
						 --
						 <input type='hidden' name='status[<?php  echo $row['id'];?>]' value="0" />
			<?php  } else { ?>
			<label class='checkbox-inline'>
                <input type='checkbox' name='status[<?php  echo $row['id'];?>]' value="1" <?php  if($row['status']==1) { ?>checked<?php  } ?> /> 开启
            </label>
                    
		   <?php  } ?>
            
                    </td>
                    <td><input type="text" class="form-control" name="name[<?php  echo $row['id'];?>]" value="<?php  echo $row['name'];?>"></td>
                </tr>
                <?php  } } ?>
                 <tr>
                    <td colspan='6'>
                           <input type="submit"  class="btn btn-primary" value="批量修改">
                           
                    </td>
                </tr>
            </tbody>
        </table>
           <?php  echo $pager;?>
 
</form>
<script language='javascript'>
    $(function(){
        $('.desc').focus(function(){
            $(this).css('height','80px');
        }).blur(function(){
            $(this).css('height','35px');
        })
    });
 
        
    
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>