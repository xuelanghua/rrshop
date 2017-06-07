<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-default panel-class"style="margin-top:20px;">
    <div class="panel-body">
        <form id="setform"  action="" method="post" class="form-horizontal form-validate">
            <input type="hidden" id="tab" name="tab" value="#tab_rand" />
            <div class="tabs-container">
                <ul class="nav nav-tabs" id="myTab">
                    <li  <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='rand') { ?>class="active"<?php  } ?>><a href="#tab_rand">随机立减</a></li>
                    <li  <?php  if($_GPC['tab']=='enough') { ?>class="active"<?php  } ?>><a href="#tab_enough">满额立减</a></li>
                    <li  <?php  if($_GPC['tab']=='discount') { ?>class="active"<?php  } ?>><a href="#tab_discount">固定折扣</a></li>
                    <li  <?php  if($_GPC['tab']=='coupon') { ?>class="active"<?php  } ?>><a href="#tab_coupon">赠送优惠券</a></li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane   <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='rand') { ?>active<?php  } ?>" id="tab_rand"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/rand', TEMPLATE_INCLUDEPATH)) : (include template('sale/rand', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane   <?php  if($_GPC['tab']=='enough') { ?>active<?php  } ?>" id="tab_enough"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/enough', TEMPLATE_INCLUDEPATH)) : (include template('sale/enough', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane   <?php  if($_GPC['tab']=='discount') { ?>active<?php  } ?>" id="tab_discount"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/discount', TEMPLATE_INCLUDEPATH)) : (include template('sale/discount', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane   <?php  if($_GPC['tab']=='coupon') { ?>active<?php  } ?>" id="tab_coupon"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/coupon', TEMPLATE_INCLUDEPATH)) : (include template('sale/coupon', TEMPLATE_INCLUDEPATH));?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="submit"  value="提交" class="btn" />
                </div>
            </div>
        </form>
    </div>

</div>
<script language='javascript'>
    require(['bootstrap'], function () {
        $('#myTab a').click(function (e) {
            $('#tab').val($(this).attr('href'));
            e.preventDefault();
            $(this).tab('show');
        })
    });
    function myFunction() {
        var p = document.getElementById('aad');
        p.removeChild(document.getElementById('input-group'));
    }
    function addlink(){
        var html ='<div class="input-group" style="margin-top: 10px;margin-bottom: 10px">';
        html+='<input type="number" name="data[rand][rand_left][]" class="form-control">';
        html+='<span class="input-group-addon">元 &nbsp;&nbsp;&nbsp;至</span>';
        html+='<input type="number" name="data[rand][rand_right][]" class="form-control">';
        html+='<span class="input-group-addon">元 &nbsp;&nbsp;&nbsp;概率</span>';
        html+='<input type="text" name="data[rand][rand][]" class="form-control">';
        html+='<span class="input-group-addon">%</span>';
        html+='<span class="input-group-btn"><button type="button" class="btn btn-danger" onclick="$(this).parents(\'.input-group\').remove()">删除</button></span>';
        html+='</div>';
        $('#aad').append(html);
    }

    function addrandtime(obj,name){
        var $this = $(obj).parent().prev();
        var html ='<div class="input-group" style="margin-top: 10px;margin-bottom: 10px">';
        html+='<input type="number" name="data['+name+'][start1][]" class="form-control" value="0">';
        html+='<span class="input-group-addon">:</span>';
        html+='<input type="number" name="data['+name+'][start2][]" class="form-control" value="0">';
        html+='<span class="input-group-addon">至</span>';
        html+='<input type="number" name="data['+name+'][end1][]" class="form-control" value="0">';
        html+='<span class="input-group-addon">:</span>';
        html+='<input type="number" name="data['+name+'][end2][]" class="form-control" value="0">';
        html+='<span class="input-group-btn"><button type="button" class="btn btn-danger" onclick="$(this).parents(\'.input-group\').remove()">删除</button></span>';
        html+='</div>';
        $this.append(html);
    }

    function addConsumeItem(){
        var html= '<div class="input-group recharge-item"  style="margin-top:5px">';
        html+='<span class="input-group-addon">支付满</span>';
        html+='<input type="text" class="form-control" name="enough[]"  />';
        html+='<span class="input-group-addon">元 立减</span>';
        html+='<input type="text" class="form-control"  name="give[]"  />';
        html+='<span class="input-group-addon">元</span>';
        html+='<div class="input-group-btn"><button type="button" class="btn btn-danger" onclick="$(this).parents(\'.recharge-item\').remove()"><i class="fa fa-remove"></i></button></div>';
        html+='</div>';
        $('.recharge-items').append(html);
    }
    function removeConsumeItem(obj){
        $(obj).closest('.recharge-item').remove();
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>