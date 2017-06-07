<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
    .moresearch { padding:0px 10px;}
    .moresearch .col-sm-2 {
        padding:0 5px
    }
</style>
<div class="page-heading">
     
         <span class='pull-right'>
 		<a class="btn btn-default  btn-sm" href="<?php  echo referer()?>">返回列表</a>
 	</span>

    <h2>分销关系 <small>总数: <span class='text-danger'><?php  echo $total;?></span></small></h2> </div>
<!--<div class="panel panel-default">
    <div class='panel-body'>
        <div style='height:100px;width:110px;float:left;'>
            <img src='<?php  echo $member['avatar'];?>' style='width:100px;height:100px;border:1px solid #ccc;padding:1px' />
        </div>
        <div style='float:left;height:100px;overflow: hidden'>
            昵称: <?php  echo $member['nickname'];?><br/>
            姓名: <?php  echo $member['realname'];?> <br/>
            手机号: <?php  echo $member['mobile'];?> /  微信号: <?php  echo $member['weixin'];?><br/>
            下级会员(非分销商): <span style='color:red'><?php  echo $level11;?></span> 人    <br/>
            下级分销商: 总共 <span style='color:red'><?php  echo $member['agentcount'];?></span> 人
            <?php  if($this->set['level']>=1) { ?>一级: <span style='color:red'><?php  echo $level1;?> </span>  人<?php  } ?>
            <?php  if($this->set['level']>=2) { ?>二级: <span style='color:red'><?php  echo $level2;?></span>  人<?php  } ?>
            <?php  if($this->set['level']>=3) { ?>三级: <span style='color:red'><?php  echo $level3;?></span> 人<?php  } ?>
            点击:  <span style='color:red'><?php  echo $member['clickcount'];?></span> 次
        </div>
    </div>
</div>-->

<form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="commission.statistics.user" />
    <input type="hidden" name="id" value="<?php  echo $agentid;?>" />
    <input type="hidden" name="searchstart" value="1" />
    <div class='row  m-b-sm m-t-sm moresearch' style='overflow: hidden;'>

        <div class="col-sm-2">
            <select name='isagent'  class='form-control  input-sm'  >
                <option value=''>是否分销商</option>
                <option value='0' <?php  if($_GPC['isagent']=='0') { ?>selected<?php  } ?>>不是</option>
                <option value='1' <?php  if($_GPC['isagent']=='1') { ?>selected<?php  } ?>>是</option>
            </select>
        </div>

        <div class="col-sm-2">
            <select name='level' class='form-control  input-sm' >
                <option value=''>下线层级</option>
                <?php  if($this->set['level']>=1) { ?><option value='1' <?php  if($_GPC['level']=='1') { ?>selected<?php  } ?>>一级下线</option><?php  } ?>
                <?php  if($this->set['level']>=2) { ?><option value='2' <?php  if($_GPC['level']=='2') { ?>selected<?php  } ?>>二级下线</option><?php  } ?>
                <?php  if($this->set['level']>=3) { ?><option value='3' <?php  if($_GPC['level']=='3') { ?>selected<?php  } ?>>三级下线</option><?php  } ?>
            </select>
        </div>

        <div class="col-sm-2">
            <select name='followed' class='form-control  input-sm'>
                <option value=''>关注</option>
                <option value='0' <?php  if($_GPC['followed']=='0') { ?>selected<?php  } ?>>未关注</option>
                <option value='1' <?php  if($_GPC['followed']=='1') { ?>selected<?php  } ?>>已关注</option>
                <option value='2' <?php  if($_GPC['followed']=='2') { ?>selected<?php  } ?>>取消关注</option>
            </select>
        </div>


        <!--<div class="col-sm-2">
            <select name='agentlevel' class='form-control  input-sm'>
                <option value=''>等级</option>
                <?php  if(is_array($agentlevels)) { foreach($agentlevels as $level) { ?>
                <option value='<?php  echo $level['id'];?>' <?php  if($_GPC['agentlevel']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                <?php  } } ?>
            </select>
        </div>-->

        <!--<div class="col-sm-2">
            <select name='isagentblack'  class='form-control  input-sm'    >
                <option value=''>黑名单</option>
                <option value='0' <?php  if($_GPC['isagentblack']=='0') { ?>selected<?php  } ?>>否</option>
                <option value='1' <?php  if($_GPC['isagentblack']=='1') { ?>selected<?php  } ?>>是</option>
            </select>
        </div>-->

    </div>

    <div class="page-toolbar row m-b-sm m-t-sm ">
        <div class="col-sm-5">
            <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh' style='float:left;'><i class='fa fa-refresh'></i></button>
            <?php  echo tpl_daterange('createtime', array('sm'=>true, 'placeholder'=>'会员注册时间'),true);?>
        </div>

        <div class="col-sm-7 pull-right">
            <!--<select name='searchfield'  class='form-control  input-sm select-sm'   style="width:120px;"  >

                <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>下线信息</option>
                <option value='parent' <?php  if($_GPC['searchfield']=='parent') { ?>selected<?php  } ?>>推荐人信息</option>

            </select>-->
            <div class="input-group">
                <?php  echo tpl_daterange('time', array('sm'=>true, 'placeholder'=>'成为分销商时间'),true);?>
                <!--<input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="昵称/姓名/手机号"/>-->
                 <span class="input-group-btn">
                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                     <button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出</button>

                </span>
            </div>

        </div>
    </div>

</form>

    <?php  if(count($list)>0) { ?>

    <table class="table table-hover table-responsive">
        <thead class="navbar-inner" >
        <tr>
            <th style='width:130px;'>上级</th>
            <th style='width:100px;'>上级ID<br/>上级姓名</th>
            <th style='width:100px;'>粉丝</th>
            <th style='width:100px;'>层级</th>
            <th style='width:110px;'>姓名<br/>手机号码<br/>等级</th>
            <th style='width:80px;'>累计佣金<br/>打款佣金</th>
            <th style='width:80px;'>下级分销商</th>

            <th style='width:140px;'>注册时间<br/>审核时间</th>
            <th style='width:70px;'>状态<br/>关注</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td >
                <span data-toggle='tooltip' title='<?php  echo $row['pagent']['nickname'];?>'>
                <?php  if(!empty($row['pagent']['avatar'])) { ?>
                <img src='<?php  echo $row['pagent']['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                <?php  } ?>
                <?php  if(empty($row['pagent']['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['pagent']['nickname'];?><?php  } ?>
                </span>
            </td>

            <td><?php  echo $row['pagent']['id'];?> <br/> <?php  echo $row['pagent']['realname'];?>
            </td>

            <td >
                <span data-toggle='tooltip' title='<?php  echo $row['nickname'];?>'>
                <?php  if(!empty($row['avatar'])) { ?>
                <img src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                <?php  } ?>
                <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>
                </span>
            </td>
            <td><?php  if($row['level'] == 1) { ?>
                一级下线
                <?php  } else if($row['level'] == 2) { ?>
                二级下线
                <?php  } else if($row['level'] == 3) { ?>
                三级下线
                <?php  } ?>

            </td>
            <td><?php  echo $row['realname'];?> <br/> <?php  echo $row['mobile'];?><br/><?php  if($row['isagent']==1) { ?>
                <?php  if(empty($row['levelname'])) { ?> <?php echo empty($this->set['levelname'])?'普通等级':$this->set['levelname']?><?php  } else { ?><?php  echo $row['levelname'];?><?php  } ?></td>
            <?php  } else { ?>
            -<?php  } ?>

            <td><?php  if($row['isagent']==1) { ?>
                <?php  echo $row['commission_total'];?><br/><?php  echo $row['commission_pay'];?>
                <?php  } else { ?>
                -<?php  } ?>
            </td>
            <td >  <?php  if($row['isagent']==1) { ?>
                <?php  echo $row['levelcount'];?>
                <?php  if($row['levelcount']>0) { ?>
                <a data-toggle='popover' data-placement='bottom' data-html="true" data-content='<?php  if($row['level1']>0) { ?>一级：<?php  echo $row['level1'];?> 人<?php  } ?><?php  if($row['level2']>0) { ?><br/> 二级：<?php  echo $row['level2'];?> 人<?php  } ?><?php  if($row['level3']>0) { ?><br/>三级：<?php  echo $row['level3'];?> 人<?php  } ?>'>
                <i class='fa fa-question-circle'></i>
                </a>
                <?php  } ?>
                <?php  } else { ?>
                -<?php  } ?>

            </td>
            <td><?php  echo date('Y-m-d H:i',$row['createtime'])?><br/>
                <?php  if(!empty($row['agenttime']) && $row['isagent']==1) { ?>
                <?php  echo date('Y-m-d H:i',$row['agenttime'])?>
                <?php  } else { ?>
                -
                <?php  } ?>
            </td>
            <td>

                <?php  if($row['isagent']==1) { ?>
                <span class='label <?php  if($row['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'>
                <?php  if($row['status']==1) { ?>已审核<?php  } else { ?>未审核<?php  } ?></span>
                <br/>


                <span class='label <?php  if($row['agentblack']==0) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'>
                <?php  if($row['agentblack']==1) { ?>黑名单<?php  } else { ?>正常<?php  } ?></span>

                <?php  } else { ?>
                -
                <?php  } ?>

                <br/>
                <?php  if(empty($row['followed'])) { ?>
                <?php  if(empty($row['uid'])) { ?>
                <label class='label label-default'>未关注</label>
                <?php  } else { ?>
                <label class='label label-warning'>取消关注</label>
                <?php  } ?>
                <?php  } else { ?>
                <label class='label label-primary'>已关注</label>
                <?php  } ?>
            </td>

            <td  style="overflow:visible;">

                <div class="btn-group btn-group-sm">
                    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="javascript:;">操作 <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">

                        <?php if(cv('member.list.view')) { ?><li><a href="<?php  echo webUrl('member/list/detail',array('id' => $row['id']));?>" title='会员信息' target='_blank'><i class='fa fa-user'></i> 会员信息</a></li>	<?php  } ?>
                        <?php  if($row['isagent']==1) { ?>
                        <li class="divider"></li>
                        <?php if(cv('order.list')) { ?><li><a  href="<?php  echo webUrl('order/list',array('agentid' => $row['id']));?>" title='推广订单'  target='_blank'><i class='fa fa-list'></i> 推广订单</a></li><?php  } ?>
                        <?php if(cv('commission.agent.user')) { ?><li><a  href="<?php  echo webUrl('commission/agent/user',array('id' => $row['id']));?>"  title='推广下线'  target='_blank'><i class='fa fa-users'></i> 推广下线</a></li><?php  } ?>
                        <li class="divider"></li>
                        <?php  } ?>

                        <?php if(cv('order.list')) { ?><li><a  href="<?php  echo webUrl('order/list', array('op' => 'display','searchfield'=>'member', 'keyword'=>$row['nickname']))?>" title='会员订单' target='_blank'><i class='fa fa-list'></i> 会员订单</a></li><?php  } ?>
                    </ul>
                </div>


            </td>
        </tr>
        <?php  } } ?>
        </tbody>
    </table>
    <?php  echo $pager;?>

    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何信息!
        </div>
    </div>
    <?php  } ?>
    <script language="javascript">



        require(['bootstrap'],function(){
            $("[rel=pop]").popover({
                trigger:'manual',
                placement : 'left',
                title : $(this).data('title'),
                html: 'true',
                content : $(this).data('content'),
                animation: false
            }).on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(this).siblings(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide")
                    }
                }, 100);
            });


        });


    </script>


    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>