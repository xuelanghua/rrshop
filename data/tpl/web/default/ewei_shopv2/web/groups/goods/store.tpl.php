<?php defined('IN_IA') or exit('Access Denied');?><thead>
<tr>
    <th style="width:25px;"><input type='checkbox'/></th>
    <th style="width:50px;">排序</th>
    <th style="width:70px;">商品标题</th>
    <th style="width:170px;">&nbsp;</th>
    <th style="width:80px;text-align: right;">团购价</th>
    <th style="width:80px;text-align: right;">单购价</th>
    <th style="width:80px;text-align: center;">库存</th>
    <th style="width:80px;text-align: center;">销量</th>
    <th style="width:50px;text-align: center;">状态</th>
    <th style="text-align: center;">操作</th>
</tr>
</thead>
<tbody>
<?php  if($list) { ?>
<?php  if(is_array($list)) { foreach($list as $row) { ?>
<tr>
    <td><input type='checkbox' value="<?php  echo $row['id'];?>"/></td>
    <td> <?php if(cv('groups.goods.edit')) { ?>
        <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('groups/goods/property',array('type'=>'displayorder','id'=>$row['id']))?>"><?php  echo $row['displayorder'];?></a>
        <?php  } else { ?>
        <?php  echo $row['displayorder'];?>
        <?php  } ?>
    </td>
    <td><img src="<?php  echo tomedia($row['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"/>
    </td>
    <td>
        <?php  if(!empty($row['subtitle'])) { ?><span class='label label-warning'><?php  echo $row['subtitle'];?></span><?php  } ?>
        <span class='label label-primary'><?php  echo $row['name'];?></span><br/><?php  echo $row['title'];?>
    </td>
    <td style="text-align: right;"><?php  echo $row['groupsprice'];?></td>
    <td style="text-align: right;"><?php  if($row['singleprice']) { ?><?php  echo $row['singleprice'];?><?php  } else { ?>--<?php  } ?></td>
    <td style="text-align: center;"><?php  echo $row['stock'];?></td>
    <td style="text-align: center;">
        <?php  echo $row['sales'];?>
        <!--<span class='label <?php  if($row['ishot']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
        <?php if(cv('groups.goods.edit')) { ?>
        data-toggle='ajaxSwitch'
        data-switch-value='<?php  echo $row['ishot'];?>'
        data-switch-value0='0|否|label label-default|<?php  echo webUrl('groups/goods/property',array('type'=>'ishot', 'value'=>1,'id'=>$row['id']))?>'
        data-switch-value1='1|是|label label-success|<?php  echo webUrl('groups/goods/property',array('type'=>'ishot', 'value'=>0,'id'=>$row['id']))?>'
        <?php  } ?>><?php  if($row['ishot']==1) { ?>否<?php  } else { ?>是<?php  } ?></span>-->
    </td>
    <td style="text-align: center;">
        <span class='label <?php  if($row['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
        <?php if(cv('groups.goods.edit')) { ?>
        data-toggle='ajaxSwitch'
        data-switch-value='<?php  echo $row['status'];?>'
        data-switch-value0='0|下架|label label-default|<?php  echo webUrl('groups/goods/property',array('type'=>'status', 'value'=>1,'id'=>$row['id']))?>'
        data-switch-value1='1|上架|label label-success|<?php  echo webUrl('groups/goods/property',array('type'=>'status', 'value'=>0,'id'=>$row['id']))?>'
        <?php  } ?>><?php  if($row['status']==1) { ?>上架<?php  } else { ?>下架<?php  } ?></span>
    </td>
    <td style="text-align: center;">
        <?php if(cv('groups.goods.view|groups.goods.edit')) { ?>
        <a class='btn btn-default btn-sm' href="<?php  echo webUrl('groups/goods/edit',array('id' => $row['id']));?>">
            <i class='fa fa-edit'></i> <?php if(cv('groups.goods')) { ?>编辑<?php  } else { ?>查看<?php  } ?>
        </a>
        <?php  } ?>
        <?php if(cv('groups.goods.delete')) { ?>
        <a class='btn btn-default btn-sm' data-toggle='ajaxRemove' href="<?php  echo webUrl('groups/goods/delete',array('id' => $row['id']));?>" data-confirm="确定要删除该商品吗？">
            <i class='fa fa-remove'></i> 删除
        </a>
        <?php  } ?>
    </td>
</tr>
<?php  } } ?>
<?php  } else { ?>
<tr>
    <td colspan="10" style="text-align: center;">暂时没有任何商品!</td>
</tr>
<?php  } ?>
</tbody>