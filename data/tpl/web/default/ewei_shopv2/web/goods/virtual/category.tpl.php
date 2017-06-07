<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
	<h2>虚拟卡密分类</h2>
</div>
 
     <form action="" method="post" class="form-validate">
 
        <table class="table table-hover  table-responsive">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:60px;">ID</th>
                    <th>分类名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id='tbody-items'>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td>
                        <?php if(cv('goods.virtual.category.edit')) { ?>
                           <input type="text" class="form-control" name="catname[<?php  echo $row['id'];?>]" value="<?php  echo $row['name'];?>">
                        <?php  } else { ?>
                           <?php  echo $row['name'];?>
                        <?php  } ?>
                    </td>
                    <td>
                          <?php if(cv('goods.virtual.category.delete')) { ?><a data-toggle="ajaxRemove" href="<?php  echo webUrl('goods/virtual/category/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm" data-confirm="确认删除此分类?"><i class="fa fa-trash"></i> 删除</a><?php  } ?>
                    </td>
                    </td>
                </tr>
                <?php  } } ?> 
            </tbody>
			
				<tr>
					<td colspan="3">
						  <?php if(cv('goods.virtual.category.add')) { ?>
            <input type="button" class="btn btn-default" value="添加分类" onclick='addCategory()'>
           <?php  } ?>
           <?php if(cv('goods.virtual.category.edit|goods.virtual.category.add')) { ?>
            <input type="submit" class="btn btn-primary" value="保存分类">
           <?php  } ?>
						
					</td>
				</tr>
        </table>
        <?php  echo $pager;?>
  
 
</form>
<script>
    function addCategory(){
         var html ='<tr>';
         html+='<td><i class="fa fa-plus"></i></td>';
         html+='<td>';
         html+='<input type="text" class="form-control" name="catname[new]" value="">';
         html+='</td><td></td></tr>';;
         $('#tbody-items').append(html);
    }

</script>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

