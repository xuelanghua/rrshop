<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='page-heading'><h2>友情链接管理  <?php if(cv('system.site.link.edit')) { ?><small>拖动可以排序</small><?php  } ?></h2></div>

<form action="" method="post" class='form-validate'>

    <table class="table  table-responsive">
        <thead class="navbar-inner">
        <tr>
            <th style="width:60px;">ID</th>
            <th  style="width:100px;">链接名称</th>
            <th  style="width:400px;">链接地址</th>
            <th style="width:80px;">图标</th>
            <th style="width:80px;"></th>
            <th></th>
        </tr>
        </thead>
        <tbody id='tbody-items'>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td>
                <?php  echo $row['id'];?>
                <input type="hidden" name="id[]" value="<?php  echo $row['id'];?>" >
            </td>

            <td>
                <?php if(cv('system.site.link.edit')) { ?>
                <input type="text" class="form-control" name="name[]" value="<?php  echo $row['name'];?>" >
                <?php  } else { ?>
                <?php  echo $row['name'];?>
                <?php  } ?>
            </td>

            <td>
                <?php if(cv('system.site.link.edit')) { ?>
                <input type="text" class="form-control" name="url[]" value="<?php  echo $row['url'];?>" >
                <?php  } else { ?>
                <?php  echo $row['name'];?>
                <?php  } ?>
            </td>

            <td>
                <input type='hidden'  name="thumb[]" value="<?php  echo $row['thumb'];?>" />
                <img onclick="selectImage(this)" onerror="this.src='<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg'"
                     src="<?php  if(empty($row['thumb'])) { ?><?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg<?php  } else { ?><?php  echo tomedia($row['thumb'])?><?php  } ?>"
                     <?php  if(!empty($row['thumb'])) { ?>
                data-toggle='popover'
                data-html ='true'
                data-placement='top'
                data-trigger ='hover'
                data-content="<img src='<?php  echo tomedia($row['thumb'])?>' style='width:30px;height:30px;' />"
                <?php  } ?>
                style="width:40px;height:40px">
            </td>

            <td>
                <input type="hidden" class="form-control" name="status[]" value="<?php  echo $row['status'];?>">
                <label class='checkbox-inline' onclick="$(this).prev(':hidden').val( $(this).find(':checkbox').get(0).checked?'1':'0' ); ">
                    <input type='checkbox' <?php  if($row['status']==1) { ?>checked<?php  } ?>  /> 显示
                </label>
            </td>

            <td>
                <?php if(cv('system.site.link.delete')) { ?>
                <a href="<?php  echo webUrl('system/site/link/delete', array('id' => $row['id']))?>" data-toggle='ajaxRemove' class="btn btn-default btn-sm" data-confirm="确认删除此分类?"><i class="fa fa-trash"></i> 删除</a><?php  } ?>
            </td>

        </tr>
        <?php  } } ?>
        </tbody>
        <tr>
            <td colspan="5">
                <?php if(cv('system.site.link.add')) { ?>
                <input name="button" type="button" class="btn btn-default" value="添加链接" onclick='addlink()'>
                <?php  } ?>
                <?php if(cv('system.site.link.edit|system.site.link.add')) { ?>
                <input type="submit" class="btn btn-primary" value="保存链接">
                <?php  } ?>
            </td>
        </tr>


    </table>
    <?php  echo $pager;?>


</form>
<script>

    <?php if(cv('system.site.link.edit')) { ?>
    require(['jquery.ui'],function(){
        $('#tbody-items').sortable();
    })
    <?php  } ?>

    function addlink(){
        var html ='<tr>';
        html+='<td><i class="fa fa-plus"></i></td>';
        html+='<td>';
        html+='<input type="hidden" class="form-control" name="id[]" value=""><input type="text" class="form-control" name="name[]" value="">';
        html+='</td>';
        html+='<td>';
        html+='<input type="text" class="form-control" name="url[]" value="">';
        html+='</td>';
        html+='<td>';
        html+='<input type="hidden"  name="thumb[]" value="{$row[\'thumb\']}" />';
        html+='<img onclick="selectImage(this)" onerror="this.src=\'<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg\'" src="<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg>" style=\'width:40px;height:40px;\'';
        html+='</td>';
        html+='<td>';
        html+='<input type="hidden"  name="status[]" value="1" />';
        html+='</td>';

        html+='<td></td></tr>';;
        $('#tbody-items').append(html);
    }

    function selectImage(obj){
        util.image('',function(val){

            $(obj).attr('src',val.url).popover({
                trigger: 'hover',
                html: true,
                container: $(document.body),
                content: "<img src='" + val.url  + "' style='width:40px;height:40px;' />",
                placement: 'top'
            });

            var group  =$(obj).parent();

            group.find(':hidden').val(val.url), group.find('i').show().unbind('click').click(function(){
                $(obj).attr('src',"<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg");
                group.find(':hidden').val('');
                group.find('i').hide();
                $(obj).popover('destroy');
            });
        });
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>