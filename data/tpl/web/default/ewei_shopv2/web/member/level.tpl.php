<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>



<div class="page-heading"> <h2>会员等级管理</h2> </div>

<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="member.level" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(cv('member.level.edit')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('member/level/enabled',array('enabled'=>1))?>"><i class='fa fa-circle'></i> 启用</button>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('member/level/enabled',array('enabled'=>0))?>"><i class='fa fa-circle-o'></i> 禁用</button>
                <?php  } ?>
                <?php if(cv('member.level.delete')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('member/level/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>

                <?php if(cv('member.level.add')) { ?>
                <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('member/level/add')?>"><i class='fa fa-plus'></i> 添加会员等级</a>
                <?php  } ?>
            </div>
        </div>


        <div class="col-sm-6 pull-right">

            <select name="enabled" class='form-control input-sm select-sm'>
                <option value="" <?php  if($_GPC['enabled'] == '') { ?> selected<?php  } ?>>状态</option>
                <option value="1" <?php  if($_GPC['enabled']== '1') { ?> selected<?php  } ?>>启用</option>
                <option value="0" <?php  if($_GPC['enabled'] == '0') { ?> selected<?php  } ?>>禁用</option>
            </select>
            <div class="input-group">
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">

                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
            </div>

        </div>
    </div>
</form>

<form action="" method="post" >


    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th style="width:25px;"><input type='checkbox' /></th>
            <th style="width:60px;">等级</th>
            <th>等级名称</th>
            <th style="width:60px;">会员数</th>
            <th style="width:80px;">折扣</th>

            <th>升级条件</th>
            <th style="width:80px;">状态</th>
            <th style="width:260px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>


        <tr <?php  if($row['id']=='default') { ?>style='background:#eee;<?php  if(!empty($_GPC['keyword'])) { ?>display:none;<?php  } ?>'<?php  } ?>>
        <td><?php  if($row['id']!='default') { ?>

            <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
            <?php  } ?>
        </td>

        <td>
            <?php  if($row['id']=='default') { ?>
            --
            <?php  } else { ?>
            <?php  echo $row['level'];?>
            <?php  } ?>
        </td>

        <td><?php  echo $row['levelname'];?></td>
        <td><?php  echo $row['membercount'];?></td>
        <td><?php  echo $row['discount'];?></td>
        <td>
            <?php  if($row['id']=='default') { ?>
            默认等级
            <?php  } else { ?>

            <?php  if(empty($shopset['leveltype'])) { ?>
            <?php  if($row['ordermoney']>0) { ?>
            完成订单金额满 <?php  echo $row['ordermoney'];?>元
            <?php  } else { ?>
            不自动升级
            <?php  } ?>
            <?php  } ?>
            <?php  if($shopset['leveltype']==1) { ?>
            <?php  if($row['ordercount']>0) { ?>
            完成订单数量满 <?php  echo $row['ordercount'];?>个
            <?php  } else { ?>
            不自动升级
            <?php  } ?>
            <?php  } ?>
            <?php  } ?>
        </td>
        <td>
            <?php  if($row['id']!='default') { ?>
            <span class='label <?php  if($row['enabled']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
            <?php if(cv('member.level.edit')) { ?>
            data-toggle='ajaxSwitch'
            data-switch-value='<?php  echo $row['enabled'];?>'
            data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('member/level/enabled',array('enabled'=>1,'id'=>$row['id']))?>'
            data-switch-value1='1|启用|label label-success|<?php  echo webUrl('member/level/enabled',array('enabled'=>0,'id'=>$row['id']))?>'
            <?php  } ?>
            >
            <?php  if($row['enabled']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
            <?php  } ?>


        </td>
        <td>

            <?php if(cv('member.list')) { ?>
            <a class='btn btn-default  btn-sm' href="<?php  echo webUrl('member/list', array('level' => $row['id']))?>"><i class='fa fa-users'></i> 等级会员</a>
            <?php  } ?>

            <?php if(cv('member.level.view|member.level.edit')) { ?><a href="<?php  echo webUrl('member/level/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm"
                ><i class='fa fa-edit'></i> <?php if(cv('member.level.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?></a><?php  } ?>
            <?php  if($row['id']!='default') { ?>
            <?php if(cv('member.level.delete')) { ?><a data-toggle='ajaxRemove' href="<?php  echo webUrl('member/level/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm" data-confirm='确认要删除此会员等级吗?'><i class="fa fa-trash"></i> 删除</a><?php  } ?>
            <?php  } ?>


            </tr>
            <?php  } } ?>

        </tbody>
    </table>

</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
