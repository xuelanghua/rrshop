<?php defined('IN_IA') or exit('Access Denied');?><form class="form-horizontal form-validate" action="<?php  if($edit_flag==1) { ?><?php  echo merchUrl('order/op/changeExpress')?><?php  } else { ?><?php  echo merchUrl('order/op/send')?><?php  } ?>" method="post" enctype="multipart/form-data">
	<input type='hidden' name='id' value='<?php  echo $id;?>' />

	<div class="modal-dialog">
           <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"><?php  if($edit_flag==1) { ?>修改物流信息<?php  } else { ?>订单发货<?php  } ?></h4>
            </div>
            <div class="modal-body">
                   	<div class="form-group">
						<label class="col-sm-2 control-label">收 货 人</label>
						<div class="col-sm-9 col-xs-12">
							<div class="form-control-static">
								联系人: <?php  echo $address['realname'];?> / <?php  echo $address['mobile'];?> <br/>
								地    址: <?php  echo $address['province'];?><?php  echo $address['city'];?><?php  echo $address['area'];?> <?php  echo $address['address'];?>
							</div>
						</div>
					</div>
                                
					<div class="form-group">
						<label class="col-sm-2 control-label">快递公司</label>
						<div class="col-sm-9 col-xs-12">
							<select class="form-control" name="express" id="express">
                                <option value="" data-name="">其他快递</option>

                                <?php  if(is_array($express_list)) { foreach($express_list as $value) { ?>
                                <option value="<?php  echo $value['express'];?>" data-name="<?php  echo $value['name'];?>"><?php  echo $value['name'];?></option>
                                <?php  } } ?>

							</select>
							<input type='hidden' name='expresscom' id='expresscom' value="<?php  echo $item['expresscom'];?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label must">快递单号</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="expresssn" class="form-control" value="<?php  echo $item['expresssn'];?>" data-rule-required='true' />
						</div>
					</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit"><?php  if($edit_flag==1) { ?>保存信息<?php  } else { ?>确认发货<?php  } ?></button>
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
            </div>
        </div>
</form>

<script language="javascript">

    $("select[name=express]").val("<?php  echo $item['express'];?>");

    $("#express").change(function () {
        var obj = $(this);
        var sel = obj.find("option:selected").attr("data-name");
        $("#expresscom").val(sel);
    });

</script>



