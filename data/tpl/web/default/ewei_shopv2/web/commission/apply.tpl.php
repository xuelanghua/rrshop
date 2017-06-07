<?php defined('IN_IA') or exit('Access Denied');?> <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"> <h2><?php  echo $applytitle;?>提现申请 总数：<?php  echo $total;?></h2> </div>


<form action="./index.php" method="get" class="form-horizontal  table-search" role="form" id="form1">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="commission.apply" />
    <input type="hidden" name="status" value="<?php  echo $status;?>" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-6">

            <div class="btn-group btn-group-sm" style='float:left'>
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

            </div>


            <div class='input-group input-group-sm'   >


                <select name='timetype'   class='form-control  input-sm select-md'   style="width:95px;"  >
                    <option value=''>不按时间</option>
                    <?php  if($status>=1) { ?><option value='applytime' <?php  if($_GPC['timetype']=='applytime') { ?>selected<?php  } ?>>申请时间</option><?php  } ?>
                    <?php  if($status>=2) { ?><option value='checktime' <?php  if($_GPC['timetype']=='checktime') { ?>selected<?php  } ?>>审核时间</option><?php  } ?>
                    <?php  if($status>=3) { ?><option value='paytime' <?php  if($_GPC['timetype']=='paytime') { ?>selected<?php  } ?>>打款时间</option><?php  } ?>
                </select>


                <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>

            </div>
        </div>

        <div class="col-sm-6 pull-right">
            <select name='agentlevel' class='form-control  input-sm select-md' style="width:100px;">
                <option value=''>等级</option>
                <?php  if(is_array($agentlevels)) { foreach($agentlevels as $level) { ?>
                <option value='<?php  echo $level['id'];?>' <?php  if($_GPC['agentlevel']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                <?php  } } ?>
            </select>
            <select name='searchfield'  class='form-control  input-sm select-md'   style="width:110px;"  >
                <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>会员信息</option>
                <option value='applyno' <?php  if($_GPC['searchfield']=='applyno') { ?>selected<?php  } ?>>提现单号</option>
            </select>
            <div class="input-group">
                <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"/>
				<span class="input-group-btn">
					<button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
					   <?php if(cv('commission.agent.export')) { ?>
							<button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出</button>
							<?php  } ?>
				</span>
            </div>

        </div>
    </div>
</form>

<?php  if(count($list)>0) { ?>

<table class="table table-hover">
    <thead class="navbar-inner">
    <tr>
        <th style='width:200px;'>提现单号</th>

        <th style='width:90px;'>分销等级</th>
        <th style='width:90px;'>提现方式</th>
        <th style='width:100px;'>申请佣金<br><?php  if($status==3) { ?>实际到账<?php  } else { ?>实际佣金<?php  } ?><br>个人所得税
        </th>
        <th style='width:90px;'>已发送金额 <br/>(微信红包)</th>
        <?php  if($status==-1) { ?>
        <th style='width:100px;'>无效时间</th>

        <?php  } else if($status>=3) { ?>
        <th style='width:100px;'>打款时间</th>

        <?php  } else if($status>=2) { ?>
        <th style='width:100px;'>审核时间</th>

        <?php  } else if($status>=1) { ?>
        <th style='width:100px;'>申请时间</th>

        <?php  } ?>

        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr>
        <td><?php  echo $row['applyno'];?><br>
            <?php if(cv('member.list.view')) { ?>
            <a  href="<?php  echo webUrl('member/list/detail',array('id' => $row['mid']));?>" target='_blank'>
                <img src='<?php  echo tomedia($row['avatar'])?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname'];?>
            </a>
            <?php  } else { ?>
            <img src='<?php  echo tomedia($row['avatar'])?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname'];?>
            <?php  } ?>
            <br/>
            <?php  echo $row['realname'];?>/<?php  echo $row['mobile'];?>
        </td>
        <td><?php  echo $row['levelname'];?></td>
        <td><?php  echo $row['typestr'];?></td>
        <td><?php  echo $row['commission'];?>
            <br>
            <?php  if($row['deductionmoney'] > 0) { ?>
            <?php  echo $row['realmoney'];?>
            <?php  } else { ?>
            <?php  echo $row['commission'];?>
            <?php  } ?>
            <br>
            <?php  echo $row['charge'];?>%</td>
        <td><?php  if((float)$row['sendmoney'] != 0) { ?><?php  echo $row['sendmoney'];?><?php  } else { ?>-<?php  } ?></td>
        <td >
            <?php  if($row['status']!=1) { ?><a data-toggle='popover' data-content="
                         <?php  if($status>=1 && $row['status']!=1) { ?>申请时间: <br/><?php  echo date('Y-m-d',$row['applytime'])?><br/><?php  echo date('H:i',$row['applytime'])?><?php  } ?>
                         <?php  if($status>=2 && $row['status']!=2) { ?><br/>审核时间: <br/><?php  echo date('Y-m-d',$row['checktime'])?><br/><?php  echo date('H:i',$row['checktime'])?><?php  } ?>
                         <?php  if($status>=3 && $row['status']!=3) { ?><br/>付款时间: <br/><?php  echo date('Y-m-d',$row['paytime'])?><br/><?php  echo date('H:i',$row['paytime'])?><?php  } ?>
                         <?php  if($status==-1) { ?><br/>无效时间: <br/><?php  echo date('Y-m-d',$row['invalidtime'])?><br/><?php  echo date('H:i',$row['invalidtime'])?><?php  } ?>
                         
                            " data-html="true" data-trigger="hover"><?php  } ?>
            <?php  if($status>=1) { ?>
            <?php  echo date('Y-m-d',$row['applytime'])?><br/><?php  echo date('H:i',$row['applytime'])?>
            <?php  } else if($status>=2) { ?>
            <?php  echo date('Y-m-d',$row['checktime'])?><br/><?php  echo date('H:i',$row['applytime'])?>
            <?php  } else if($status>=3) { ?>
            <?php  echo date('Y-m-d',$row['paytime'])?><br/><?php  echo date('H:i',$row['paytime'])?>
            <?php  } else if($status==-1) { ?>
            <?php  echo date('Y-m-d',$row['invalidtime'])?><br/><?php  echo date('H:i',$row['invalidtime'])?>
            <?php  } ?>
            <?php  if($row['status']!=1) { ?><i class="fa fa-question-circle"></i></a><?php  } ?>
        </td>
        <td>
        	<?php if(cv('commission.apply.detail')) { ?>
            	<a class='btn btn-default btn-sm' href="<?php  echo webUrl('commission/apply/detail',array('id' => $row['id'],'status'=>$row['status']))?>">详情</a>
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
        暂时没有任何<?php  echo $applytitle;?>提现申请!
    </div>
</div>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>