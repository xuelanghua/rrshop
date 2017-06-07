<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
	
	<span class='pull-right'>
		
		 <?php if(cv('abonus.level.add')) { ?>
                            <a class='btn btn-primary btn-sm' data-toggle='ajaxModal' href="<?php  echo webUrl('abonus/level/add')?>"><i class="fa fa-plus"></i> 添加新等级</a>
		 <?php  } ?>
                 
	</span>
    <h2>区域代理等级</h2>
</div>

<table class="table table-responsive table-hover">
    <thead>
    <tr>
        <th style='width:160px;'>等级名称</th>
        <th style='width:100px;'>省级分红比例</th>
        <th style='width:100px;'>市级分红比例</th>
        <th style='width:100px;'>区级分红比例</th>
        <th>升级条件</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr <?php  if($row['id']=='default') { ?>style='background:#f2f2f2'<?php  } ?>>
    <td><?php  echo $row['levelname'];?><?php  if($row['id']=='default') { ?>【默认等级】<?php  } ?></td>
    <td><?php  echo number_format((float)$row['bonus1'],4)?>%</td>
    <td><?php  echo number_format((float)$row['bonus2'],4)?>%</td>
    <td><?php  echo number_format((float)$row['bonus3'],4)?>%</td>
    <td>	<?php  if($row['id']!='default') { ?>
        <?php  if($leveltype==0) { ?><?php  if($row['ordermoney']>0) { ?>分销订单金额满 <?php  echo $row['ordermoney'];?> 元 <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  if($leveltype==1) { ?><?php  if($row['ordermoney']>0) { ?>一级分销订单金额满 <?php  echo $row['ordermoney'];?> 元 <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  if($leveltype==2) { ?><?php  if($row['ordercount']>0) { ?>分销订单数量满 <?php  echo $row['ordercount'];?> 个 <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  if($leveltype==3) { ?><?php  if($row['ordercount']>0) { ?>一级分销订单数量满 <?php  echo $row['ordercount'];?> 个 <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  if($leveltype==4) { ?><?php  if($row['ordermoney']>0) { ?>自购订单金额满 <?php  echo $row['ordermoney'];?> 元 <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  if($leveltype==5) { ?><?php  if($row['ordercount']>0) { ?>自购订单数量满 <?php  echo $row['ordercount'];?> 个 <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>

        <?php  if($leveltype==6) { ?><?php  if($row['downcount']>0) { ?>下级总人数满 <?php  echo $row['downcount'];?> 个（分销商+非分销商） <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  if($leveltype==7) { ?><?php  if($row['downcount']>0) { ?>一级下级人数满 <?php  echo $row['downcount'];?> 个（分销商+非分销商） <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>

        <?php  if($leveltype==8) { ?><?php  if($row['downcount']>0) { ?>团队总人数满 <?php  echo $row['downcount'];?> 个（分销商） <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  if($leveltype==9) { ?><?php  if($row['downcount']>0) { ?>一级团队人数满 <?php  echo $row['downcount'];?> 个（分销商） <?php  } else { ?>不自动升级<?php  } ?><?php  } ?>


        <?php  if($leveltype==10) { ?><?php  if($row['commissionmoney']>0) { ?>已提现佣金总金额满 <?php  echo $row['commissionmoney'];?> 元<?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  if($leveltype==11) { ?><?php  if($row['bonusmoney']>0) { ?>已发放分红总金额满 <?php  echo $row['bonusmoney'];?> 元<?php  } else { ?>不自动升级<?php  } ?><?php  } ?>
        <?php  } else { ?>
        默认等级
        <?php  } ?>
    </td>
    <td>
        <?php if(cv('abonus.level.edit')) { ?>
        <a class='btn btn-default btn-sm' data-toggle='ajaxModal'  href="<?php  echo webUrl('abonus/level/edit', array('id' => $row['id']))?>" title="<?php if(cv('abonus.level.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class='fa fa-edit'></i> <?php if(cv('abonus.level.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a>
        <?php  } ?>
        <?php  if($row['id']!='default') { ?>
        <?php if(cv('abonus.level.delete')) { ?>
        <a class='btn btn-default btn-sm' data-toggle='ajaxRemove'  href="<?php  echo webUrl('abonus/level/delete', array('id' => $row['id']))?>" data-confirm="确认删除此等级吗？"><i class='fa fa-remove'></i> 删除</a></td>
    <?php  } ?>
    <?php  } ?>

    </tr>
    <?php  } } ?>

    </tbody>
</table>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

