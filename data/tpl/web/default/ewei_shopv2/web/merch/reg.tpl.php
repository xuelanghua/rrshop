<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <span class='pull-right'>
        <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('merch/user/add')?>"><i class="fa fa-plus"></i> 添加多商户</a>
	</span>
    <h2>多商户入驻申请 <small>总数: <span class='text-danger'><?php  echo $total;?></span></small></h2> </div>
<form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="merch.reg" />

    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                 <?php if(cv('merch.reg.delete')) { ?>
                 <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('merch/reg/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                 <?php  } ?>
            </div>
        </div>


        <div class="col-sm-7 pull-right">


            <select name='status' class='form-control  input-sm select-md' style="width:100px;"  >
                <option value=''>状态</option>
                <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>申请中</option>
                <option value='-1' <?php  if($_GPC['status']=='-1') { ?>selected<?php  } ?>>驳回</option>
            </select>
            <div class="input-group">
                <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="商户名称/联系人/手机号"/>
				 <span class="input-group-btn">
                                 <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
				</span>
            </div>

        </div>
    </div>
</form>
<?php  if(count($list)>0) { ?>

<table class="table table-hover table-responsive">
    <thead class="navbar-inner" >
    <tr>
        <th style="width:25px;"><input type='checkbox' /></th>

        <th style='width:150px;'>商户名称</th>
        <th style='width:90px;'>主营项目</th>
        <th style='width:90px;'>联系人</th>
        <th style='width:90px;'>申请时间</th>
        <th style='width:100px;'>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr rel="pop" data-title="ID: <?php  echo $row['id'];?> ">

        <td>
            <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
        </td>
        <td><?php  echo $row['merchname'];?></td>
        <td><?php  echo $row['salecate'];?></td>
        <td><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>
        <td><?php  echo date('Y-m-d', $row['applytime'])?><br/><?php  echo date('H:i', $row['applytime'])?></td>
        <td  style="overflow:visible;">

            <?php if(cv('merch.reg.detail')) { ?>
            <a  href="<?php  echo webUrl('merch/reg/detail', array('id' => $row['id']))?>" class="btn btn-default btn-sm" >
                <i class='fa fa-edit'></i> 处理申请
            </a>
            <?php  } ?>

            <?php if(cv('merch.reg.delete')) { ?>
            <a data-toggle='ajaxRemove' href="<?php  echo webUrl('merch/reg/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm" data-confirm='确认要删除此商户吗?'><i class="fa fa-trash"></i> 删除</a>
            <?php  } ?>

        </td>
    </tr>
    <?php  } } ?>
    </tbody>
</table>
<?php  echo $pager;?>

<?php  } else { ?>
<div class='panel panel-default'>
    <div class='panel-body' style='text-align: center;padding:30px;'>
        暂时没有任何入驻申请!
    </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>