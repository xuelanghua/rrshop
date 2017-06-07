<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <span class='pull-right'>
        <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('cashier/user/add')?>"><i class="fa fa-plus"></i> 添加收银台</a>
	</span>
    <h2>收银台管理 <small>总数: <span class='text-danger'><?php  echo $total;?></span></small></h2> </div>
<form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="cashier.user" />

    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-3">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(cv('cashier.user.edit')) { ?>

                <div class="btn-group btn-group-sm">
                    <button data-toggle="dropdown" class="btn btn-default">账户状态 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class='btn'  data-toggle='batch' data-href="<?php  echo webUrl('cashier/user/status',array('status'=>1))?>"  data-confirm='确认要设置为开启收银台吗?'>开启</a></li>
                        <li><a class='btn'  data-toggle='batch' data-href="<?php  echo webUrl('cashier/user/status',array('status'=>0))?>" data-confirm='确认要设置为关闭收银台吗?'>关闭</a></li>
                    </ul>
                </div>
                <?php  } ?>

                <?php if(cv('cashier.user.delete')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('cashier/user/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>
            </div>
        </div>


        <div class="col-sm-8 pull-right">
            <select name='categoryid' class='form-control  input-sm select-md' style="width:100px;"  >
                <option value=''>分类</option>
                <?php  if(is_array($category)) { foreach($category as $g) { ?>
                <option value="<?php  echo $g['id'];?>" <?php  if($_GPC['categoryid']==$g['id']) { ?>selected<?php  } ?>><?php  echo $g['catename'];?></option>
                <?php  } } ?>
            </select>

            <select name='status' class='form-control  input-sm select-md' style="width:100px;"  >
                <option value=''>审核状态</option>
                <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>关闭</option>
                <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?>>开启</option>
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
        <th style='width:150px;'>收银台名称</th>
        <th style='width:120px;'>联系人</th>
        <th style='width:120px;'>申请时间</th>
        <th style='width:70px;'>状态</th>
        <th style='width:100px;'>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr rel="pop" data-title="ID: <?php  echo $row['id'];?> ">

        <td>
            <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
        </td>
        <td><?php  echo $row['title'];?></td>
        <td><?php  echo $row['name'];?><br/><?php  echo $row['mobile'];?></td>
        <td><?php  echo date('Y-m-d H:i',$row['createtime'])?></td>
        <td>
            <?php  if(empty($row['status'])) { ?>
            <span class="label label-default">关闭</span>
            <?php  } else { ?>
            <span class="label label-primary">开启</span>
            <?php  } ?>
        </td>
        <td  style="overflow:visible;">
            <?php if(cv('cashier.user.view|cashier.user.edit')) { ?>
            <a href="<?php  echo webUrl('cashier/user/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm" >
                <i class='fa fa-edit'></i> <?php if(cv('cashier.user.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>
            </a>
            <?php  } ?>
            <?php if(cv('cashier.user.delete')) { ?>
            <a data-toggle='ajaxRemove' href="<?php  echo webUrl('cashier/user/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm" data-confirm='确认要删除此商户吗?'><i class="fa fa-trash"></i> 删除</a>
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
        暂时没有任何收银台用户!
    </div>
</div>
<?php  } ?>
<script language="javascript">


</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>