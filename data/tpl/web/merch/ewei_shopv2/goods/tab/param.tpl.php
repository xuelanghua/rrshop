<?php defined('IN_IA') or exit('Access Denied');?>
    <table class="table">
        <thead>
            <tr>
              
                <td style='width:150px;'>参数名称</td>
                <td>参数值 <small>拖动行可进行排序</small></td>
	 <th style='width:50px;'></th>
            </tr>
        </thead>
        <tbody id="param-items">
            <?php  if(is_array($params)) { foreach($params as $p) { ?>
            <tr>
               
                <td>
                      <?php if( mce('goods' ,$item) ) { ?>
                    <input name="param_title[]" type="text" class="form-control param_title" value="<?php  echo $p['title'];?>"/>
                    <?php  } else { ?>
                      <?php  echo $p['title'];?>
                    <?php  } ?>
                    <input name="param_id[]" type="hidden" class="form-control" value="<?php  echo $p['id'];?>"/>
                </td>
                <td>
                       <?php if( mce('goods' ,$item) ) { ?>
                    <input name="param_value[]" type="text" class="form-control param_value" value="<?php  echo $p['value'];?>"/>
                <?php  } else { ?>   <?php  echo $p['value'];?>
                    <?php  } ?>
                </td>
	<td>
                   <?php if( mce('goods' ,$item) ) { ?>
                    <a href="javascript:;" class='btn btn-default btn-sm' onclick="deleteParam(this)" title="删除"><i class='fa fa-remove'></i></a>
                    <?php  } ?>
                </td>
            </tr>
            <?php  } } ?>
        </tbody>
           <?php if( mce('goods' ,$item) ) { ?>
        <tbody>
            <tr>
                
                <td colspan="3">
                    <a href="javascript:;" id='add-param' onclick="addParam()" class="btn btn-default"  title="添加参数"><i class='fa fa-plus'></i> 添加参数</a>
                </td>
            </tr>
        </tbody>
        <?php  } ?>
    </table>
 

<script language="javascript">
    $(function() {
	require(['jquery.ui'],function(){
	  $("#param-items").sortable();
    });
        $("#chkoption").click(function() {
            var obj = $(this);
            if (obj.get(0).checked) {
                $("#tboption").show();
                $(".trp").hide();
            }
            else {
                $("#tboption").hide();
                $(".trp").show();
            }
        });
    })
    function addParam() {
        var url = "<?php  echo merchUrl('goods/tpl',array('tpl'=>'param'))?>";
//        return false;
        $.ajax({
            "url": url,
            success: function(data) {
                $('#param-items').append(data);
            }
        });
        return;
    }
    function deleteParam(o) {
        $(o).parent().parent().remove();
    }
</script>