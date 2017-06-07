<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>充值记录</h2> </div>
<form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="finance.log.recharge" />
    <div class="page-toolbar row m-b-sm m-t-sm">


        <div class="col-sm-4" style='padding-right:0;'>

            <div class="btn-group btn-group-sm" style='float:left'>
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

            </div>
            <select name='status' class='form-control  input-sm'   style="width:240px;"  >
                <option value='' <?php  if($_GPC['status']=='') { ?>selected<?php  } ?>>状态</option>
                <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?>><?php  if($_GPC['type']==0) { ?>充值成功<?php  } else { ?>完成<?php  } ?></option>
                <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>><?php  if($_GPC['type']==0) { ?>未充值<?php  } else { ?>申请中<?php  } ?></option>
                <?php  if($_GPC['type']==1) { ?><option value='-1' <?php  if($_GPC['status']=='-1') { ?>selected<?php  } ?>>失败</option><?php  } ?>

            </select>
        </div>

        <div class="col-sm-8 pull-right" style='text-align: right'>

            <select name='groupid' class='form-control  input-sm select-md' style="width:140px;float: right;"  >
                <option value=''>会员分组</option>
                <?php  if(is_array($groups)) { foreach($groups as $group) { ?>
                <option value='<?php  echo $group['id'];?>' <?php  if($_GPC['groupid']==$group['id']) { ?>selected<?php  } ?>><?php  echo $group['groupname'];?></option>
                <?php  } } ?>
            </select>
            <select name='level' class='form-control  input-sm select-md' style="width:140px;float: right;"  >
                <option value=''>会员等级</option>
                <?php  if(is_array($levels)) { foreach($levels as $level) { ?>
                <option value='<?php  echo $level['id'];?>' <?php  if($_GPC['level']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                <?php  } } ?>
            </select>
            <?php  if($_GPC['type']==0) { ?>

            <select name='rechargetype'  class='form-control  input-sm select-md'   style="width:140px;float: right;"  >
                <option value='' <?php  if($_GPC['rechargetype']=='') { ?>selected<?php  } ?>>充值方式</option>
                <option value='wechat' <?php  if($_GPC['rechargetype']=='wechat') { ?>selected<?php  } ?>>微信</option>
                <option value='alipay' <?php  if($_GPC['rechargetype']=='alipay') { ?>selected<?php  } ?>>支付宝</option>
                <option value='system' <?php  if($_GPC['rechargetype']=='system') { ?>selected<?php  } ?>>后台</option>
                <option value='system1' <?php  if($_GPC['rechargetype']=='system1') { ?>selected<?php  } ?>>后台扣款</option>
                <?php  if(p('ccard')) { ?><option value='ccard' <?php  if($_GPC['rechargetype']=='ccard') { ?>selected<?php  } ?>>充值卡返佣</option><?php  } ?>
            </select>

            <?php  } ?>

        </div>
    </div>

    <div class="page-toolbar row"
         id='moresearch' >
        <div class='col-sm-4' style='padding-right:0'>
            <?php  echo tpl_daterange('time', array('sm'=>true,'placeholder'=>'充值时间'),true);?>
        </div>

        <div class="col-sm-8 pull-right">

            <select name='searchfield'  class='form-control  input-sm select-md'   style="width:110px;"  >

                <option value='logno' <?php  if($_GPC['searchfield']=='logno') { ?>selected<?php  } ?>>充值单号</option>
                <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>会员信息</option>

            </select>
            <div class="input-group " >
                <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词" />
                <span class="input-group-btn">
                <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                <?php if(cv('finance.log.recharge.export')) { ?>
                	<button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出 Excel</button>
                <?php  } ?>
            </span>
            </div>

        </div>

    </div>
</form>

<table class="table table-hover table-responsive">
    <thead class="navbar-inner">
    <tr>

        <th style='width:200px;'>充值单号</th>
        <th style='width:120px;'>粉丝</th>
        <th style='width:100px;'>会员信息</th>

        <th style='width:80px;'>充值金额</th>
        <th style='width:100px;'>充值时间</th>
        <th style='width:80px;'>充值方式</th>
        <th style='width:70px;'>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr>
        <td><?php  if(!empty($row['logno'])) { ?>
            <?php  if(strlen($row['logno'])<=22) { ?>
            <?php  echo $row['logno'];?>
            <?php  } else { ?>
            recharge<?php  echo $row['id'];?>
            <?php  } ?>
            <?php  } else { ?>
            recharge<?php  echo $row['id'];?>
            <?php  } ?></td>
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
        <td><?php  echo $row['money'];?></td>
        <td><?php  echo date('Y-m-d',$row['createtime'])?><br/><?php  echo date('H:i',$row['createtime'])?></td>


        <td>
            <?php  if($row['rechargetype']=='alipay') { ?>
            <span class='label label-warning'>支付宝</span>
            <?php  } else if($row['rechargetype']=='wechat') { ?>
            <span class='label label-success'>微信</span>
            <?php  } else if($row['rechargetype']=='system') { ?>
            <?php  if($row['money']>0) { ?>
            <span class='label label-primary'>后台</span>
            <?php  } else { ?>
            <span class='label label-default'>扣款</span>
            <?php  } ?>
            <?php  } else if($row['rechargetype']=='ccard') { ?>
            <span class='label label-primary'>充值卡返佣</span>
            <?php  } ?>
        </td>


        <td>
            <?php  if($row['status']==0) { ?>
            <span class='label label-default'><?php  if($row['type']==1) { ?>申请中<?php  } else { ?>未充值<?php  } ?></span>
            <?php  } else if($row['status']==1) { ?>
            <span class='label label-success'>成功</span>
            <?php  } else if($row['status']==-1) { ?>
            <span class='label label-default'><?php  if($row['type']==1) { ?>拒绝<?php  } else { ?>失败<?php  } ?></span>
            <?php  } else if($row['status']==3) { ?>
            <span class='label label-danger'><?php  if($row['type']==0) { ?>退款<?php  } ?></span>
            <?php  } ?>
        </td>

        <td>

            <?php  if($row['status']==1) { ?>
	            <?php  if($row['rechargetype']=='alipay' || $row['rechargetype']=='wechat') { ?>
		            <?php if(cv('finance.log.refund')) { ?>
		            	<a class='btn btn-danger btn-sm' data-toggle='ajaxPost' data-confirm="确认退款到<?php  if($row['rechargetype']=='alipay') { ?>支付宝<?php  } else { ?>微信钱包<?php  } ?>?" href="<?php  echo webUrl('finance/log/refund',array('id' => $row['id']));?>">退款</a>
		            <?php  } ?>
	            <?php  } ?>
            <?php  } ?>

        </td>
    </tr>

    <?php  if(!empty($row['remark'])) { ?>
    <tr style=";border-bottom:none;background:#f9f9f9;">
        <td colspan='8' style='text-align:left'>
            备注:<span class="text-info"><?php  echo $row['remark'];?></span>
        </td>
    </tr>
    <?php  } ?>

    <?php  } } ?>
    </tbody>
</table>
<?php  echo $pager;?>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>