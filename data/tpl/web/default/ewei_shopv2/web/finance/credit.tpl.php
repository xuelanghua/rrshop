<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2><?php  if($type=='credit1') { ?>积分<?php  } else { ?>余额<?php  } ?>明细</h2> </div>
<form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="finance.credit.<?php  echo $type;?>" />

        <div class="page-toolbar row m-b-sm m-t-sm">
            <div class="col-sm-5">

                <div class="btn-group btn-group-sm" style='float:left'>
                    <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

                </div>


                <div class='input-group input-group-sm'   >


                    <?php  echo tpl_daterange('time', array('sm'=>true,'placeholder'=>'操作时间'),true);?>

                </div>
            </div>


            <div class="col-sm-7 pull-right">

                <select name='groupid' class='form-control  input-sm select-md' style="width:100px;float: left;"  >
                    <option value=''>会员分组</option>
                    <?php  if(is_array($groups)) { foreach($groups as $group) { ?>
                    <option value='<?php  echo $group['id'];?>' <?php  if($_GPC['groupid']==$group['id']) { ?>selected<?php  } ?>><?php  echo $group['groupname'];?></option>
                    <?php  } } ?>
                </select>
                <select name='level' class='form-control  input-sm select-md' style="width:100px;float: left;"  >
                    <option value=''>会员等级</option>
                    <?php  if(is_array($levels)) { foreach($levels as $level) { ?>
                    <option value='<?php  echo $level['id'];?>' <?php  if($_GPC['level']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                    <?php  } } ?>
                </select>
                <div class="input-group">
                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入会员信息/操作人信息" />
                <span class="input-group-btn">

                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                    <?php  if($type=='credit') { ?>
                        <?php if(cv('finance.credit.credit1.export')) { ?>
                        <button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出 Excel</button>
                        <?php  } ?>
                    <?php  } else { ?>
                        <?php if(cv('finance.credit.credit2.export')) { ?>
                        <button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出 Excel</button>
                        <?php  } ?>
                    <?php  } ?>

                </span>
                </div>

            </div>
        </div>

</form>

<table class="table table-hover table-responsive">
    <thead class="navbar-inner">
    <tr>
        <th style='width:120px;'>粉丝</th>
        <th style='width:100px;'>会员信息</th>
        <th style='width:80px;'><?php  if($type=='credit1') { ?>积分<?php  } else { ?>余额<?php  } ?>变化</th>
        <th style='width:80px;'>备注</th>
        <th style='width:80px;'>操作人</th>
        <th style='width:100px;'>操作时间</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr >

        <td data-toggle='tooltip' title='<?php  echo $row['nickname'];?>'>
        <?php if(cv('member.list.detail')) { ?>
        <a  href="<?php  echo webUrl('member/list/detail',array('id' => $row['mid']));?>" target='_blank'>
            <img src='<?php  echo tomedia($row['avatar'])?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname'];?>
        </a>
        <?php  } else { ?>
        <img src='<?php  echo tomedia($row['avatar'])?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname'];?>
        <?php  } ?>

        </td>
        <td><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>
        <td><?php  echo $row['num'];?></td>
        <td data-toggle='popover' data-html='true' data-placement='top' data-trigger='hover' data-content='<?php  echo $row['remark'];?>'><?php  echo $row['remark'];?></td>
        <td><?php  if(empty($row['username'])) { ?>本人<?php  } else { ?><?php  echo $row['username'];?><?php  } ?></td>
        <td><?php  echo date('Y-m-d H:i:s',$row['createtime'])?></td>
    </tr>
    <?php  } } ?>
    </tbody>
</table>
<?php  echo $pager;?>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>