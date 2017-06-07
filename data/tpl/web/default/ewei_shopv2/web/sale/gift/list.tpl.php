<?php defined('IN_IA') or exit('Access Denied');?><?php  if(count($gifts)>0) { ?>
<?php  if(is_array($gifts)) { foreach($gifts as $item) { ?>
<tr>
    <td>
        <input type='checkbox'  value="<?php  echo $item['id'];?>"/>
    </td>
    <td style='text-align:center;'>
        <?php if(cv('sale.gift.edit')) { ?>
        <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('sale/gift/change',array('typechange'=>'displayorder','id'=>$item['id']))?>" ><?php  echo $item['displayorder'];?></a>
        <?php  } else { ?>
        <?php  echo $item['displayorder'];?>
        <?php  } ?>
    </td>
    <td>
        <img src="<?php  echo tomedia($item['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"  />
    </td>
    <td class='full' style="overflow-x: hidden">
        <?php if(cv('sale.gift.edit')) { ?>
        <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('sale/gift/change',array('typechange'=>'title','id'=>$item['id']))?>" ><?php  echo $item['title'];?></a>
        <?php  } else { ?>
        <?php  echo $item['title'];?>
        <?php  } ?>
    </td>
    <td  style="overflow:visible;">
        <span class='label <?php  if($item['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
        <?php if(cv('sale.gift.edit')) { ?>
        data-toggle='ajaxSwitch'
        data-confirm = "确认是<?php  if($item['status']==1) { ?>关闭<?php  } else { ?>开启<?php  } ?>？"
        data-switch-refresh='true'
        data-switch-value='<?php  echo $item['status'];?>'
        data-switch-value0='0|关闭|label label-default|<?php  echo webUrl('sale/gift/status',array('status'=>1,'id'=>$item['id']))?>'
        data-switch-value1='1|开启|label label-success|<?php  echo webUrl('sale/gift/status',array('status'=>0,'id'=>$item['id']))?>'
        <?php  } ?>>
        <?php  if($item['status']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></span>
    </td>
    <td  style="overflow:visible;position:relative;text-align: right;">
        <?php if(cv('sale.gift.edit|sale.gift.view')) { ?>
        <a  class='btn btn-default btn-sm' href="<?php  echo webUrl('sale/gift/edit', array('type'=>$_GPC['type'],'id' => $item['id'],'page'=>$page))?>" title="<?php if(cv('sale.gift.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>">
            <i class='fa fa-edit'></i> <?php if(cv('sale.gift.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>
        </a>
        <?php  } ?>
        <?php if(cv('sale.gift.delete1')) { ?>
        <a  class='btn btn-default btn-sm' data-toggle='ajaxRemove' href="<?php  echo webUrl('sale/gift/delete1', array('id' => $item['id']))?>" data-confirm='如果此活动存在购买记录，会无法关联到商品, 确认要彻底删除吗?？'><i class='fa fa-remove'></i> 彻底删除</a>
        <?php  } ?>
    </td>
</tr>
<tr>
    <td colspan='3' style='text-align: left;border-top:none;padding:5px 0;' class='aops'>
        <?php  if(!empty($item['merchname']) && $item['merchid'] > 0) { ?>
        <span class="text-default" style="margin-left: 95px;">商户名称:</span><span class="text-info"><?php  echo $item['merchname'];?></span>
        <?php  } ?>
    </td>

    <td colspan='3' style='text-align: right;border-top:none;padding:5px 0;' class='aops'></td>
</tr>
<?php  } } ?>
<?php  } else { ?>
<td colspan="6" style="text-align: center;">暂时没有任何赠品!</td>
<?php  } ?>