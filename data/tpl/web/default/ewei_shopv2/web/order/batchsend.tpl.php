<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"> 
    <span class='pull-right'>
        <a class='btn btn-default btn-sm' href="<?php  echo webUrl('goods/virtual/temp')?>">返回列表</a>
    </span>

    <h2>批量发货</h2>
</div>
<div class="alert alert-info">
    功能介绍: 使用excel快速导入进行订单发货
    <br><span style="padding-left: 60px;">如重复导入数据将以最新导入数据为准，请谨慎使用</span>
    <br><span style="padding-left: 60px;">数据导入订单状态自动修改为已发货</span>
    <br><span style="padding-left: 60px;">一次导入的数据不要太多,大量数据请分批导入,建议在服务器负载低的时候进行
    <br><br>使用方法: 1. 下载Excel模板文件并录入信息
    <br><span style="padding-left: 60px;">2. 选择快递公司</span>
    <br><span style="padding-left: 60px;">3. 上传Excel导入</span>
    <br><br>格式要求：  Excel第一列必须为订单编号，第二列必须为快递单号，请确认订单编号与快递单号的备注

</div>

<form id="importform" class="form-horizontal form" action="" method="post" enctype="multipart/form-data">

    <input type="hidden" name="typeid" value="<?php  echo $item['id'];?>"/>
    <div class='form-group'>

        <div class="form-group">
            <label class="col-sm-2 control-label must">快递公司</label>
            <div class="col-sm-5 goodsname"  style="padding-right:0;" >
                <select class="form-control" name="express" id="express">
                    <option value="" data-name="">其他快递</option>

                    <?php  if(is_array($express_list)) { foreach($express_list as $value) { ?>
                    <option value="<?php  echo $value['express'];?>" data-name="<?php  echo $value['name'];?>"><?php  echo $value['name'];?></option>
                    <?php  } } ?>

                </select>
                <input type='hidden' name='expresscom' id='expresscom' value="<?php  echo $refund['expresscom'];?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label must">EXCEL</label>

            <div class="col-sm-5 goodsname"  style="padding-right:0;" >
                <input type="file" name="excelfile" class="form-control" />
                <span class="help-block">如果遇到数据重复则将进行数据更新</span>
            </div>
        </div>

    </div>

    <div class='form-group'>
        <div class="col-sm-12">
            <div class="modal-footer">
                <?php if(cv('order.batchsend.main')) { ?>
                <button type="submit" class="btn btn-primary" name="cancelsend" value="yes">确认导入</button>
                <?php  } ?>

                <?php if(cv('order.batchsend.import')) { ?>
                <a class="btn btn-primary" href="<?php  echo webUrl('order/batchsend/import')?>" style="margin-right: 10px;" ><i class="fa fa-download" title=""></i> 下载Excel模板文件</a>
                <?php  } ?>
            </div>
        </div>
    </div>
    </div>
</form>


<script language='javascript'>
    $(function(){

        $('#importform').submit(function(){
            if(!$(":input[name=excelfile]").val()){
                tip.msgbox.err("您还未选择Excel文件哦~");
                return false;
            }
        })

        $("#express").change(function () {
            var obj = $(this);
            var sel = obj.find("option:selected").attr("data-name");
            $("#expresscom").val(sel);
        });

    })

</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
