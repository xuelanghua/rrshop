<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($do == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo url('members/muser/list');?>">用户信息</a></li>
</ul>
<?php  if($do == 'post') { ?>
<div class="panel panel-default">
  <div class="panel-heading">用户信息</div>
  <div class="panel-body">
   <form action="<?php  echo url('members/mrecharge')?>" class="form-horizontal form" method="post" enctype="multipart/form-data" target="_blank">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">充值金额：</label>
    <div class="col-sm-10">
      <input class="form-control" name="recharge_number" type="text" placeholder="充值金额" value="10"  style="width:30%">
      
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">支付方式：</label>
    <div class="col-sm-10">
    <?php  if(false) { ?>
      <input type="radio" name="pay_type" value="alipay" >
      <label for="pay">支付宝</label><?php  } ?>
      <input type="radio" name="pay_type" value="yunpay" checked>
      <label for="pay">云支付</label>
    </div>
    
  </div>

  <div class="form-group">
     <div class="col-sm-10" style="margin-left:20%;">
     <button type="button" class="btn btn-warning buy">确认充值</button>
     </div>
  </div>
</form>
  </div>              
</div>
<div class="modal fade" id="myModal" data-backdrop="static" style="top: 25%">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title">充值提醒</h4>

            </div>

            <div class="modal-body" style="line-height: 30px;text-indent: 2em;font-size: 16px;font-weight: bold">

                请在新弹出的第三方支付平台完成支付，即可自动充值到帐户，未完成支付前请不要关闭本窗口。<br/>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-warning done">完成支付</button>

            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div>
<script>
require(['bootstrap'],function($){
	$("button.buy").on("click",function(){
	
				$("button.buy").removeAttr("disabled");
	
				$('#myModal').modal('show');
	
				$("form.form").action = "<?php  echo url('members/mrecharge')?>";
	
				$("form.form").submit();
	
			});
});
</script>
<?php  } else if($do == 'mlist') { ?>
 <div class="panel panel-default">

                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th style="width: 5%;text-align: center">id</th>

                            <th>用户名</th>

                            <th>注册时间</th>

                            <th style="width: 20%">当前积分</th>

                           <?php  if($_W['isfounder']) { ?><th style="width: 30%">操作</th><?php  } ?> 

                        </tr>

                        </thead>

                        <tbody>

                        <?php  if(is_array($list)) { foreach($list as $item) { ?>

                        <tr>

                            <td style="text-align: center"><?php  echo $item["uid"];?></td>

                            <td><?php  echo $item["username"];?></td>

                            <td><?php  echo date('Y-m-d H:i:s',$item["joindate"])?></td>
                            
                            <?php  $memberprcie=pdo_fetch("SELECT * FROM ".tablename('buymod_members')." where uid=:uid",array(':uid' => $item["uid"]));?>

                            <td>￥<?php  echo $memberprcie["credit"];?></td>

                            <td >

                                <div class="btn-group text-left">

                                    <a class="btn btn-default btn-sm" href="<?php  echo url('members/mRecord/paylist',array('uid'=>$item['uid']))?>" title="充值记录"><i class="fa fa-share"></i>充值记录</a>

                                    <a class="btn btn-default btn-sm" href="<?php  echo url('members/mRecord/modlist',array('uid'=>$item['uid']))?>" title="消费记录"><i class="fa fa-share"></i>消费记录</a>

                                    <a class="btn btn-default btn-sm" href="<?php  echo url('members/maddmod/addmod',array('uid'=>$item['uid']))?>" title="消费记录"><i class="fa fa-edit"></i>授权</a>

                                </div>

                            </td>

                        </tr>

                        <?php  } } ?>

                        </tbody>

                    </table>

                    <div style="margin: 10px"><?php  echo $pager;?></div>

                </div>

            </section>

        </aside>

    </div>

</div>

<?php  } else if($do == 'addmod') { ?>
<div class="panel panel-default">

  <div class="panel-heading">授权</div>

  <div class="panel-body">

    <form class="form-horizontal" action="" method="POST">
    <input type="hidden" name="uid" class="form-control" id="uid" value="<?php  echo $uid;?>">

  <div class="form-group">

    <label for="inputEmail3" class="col-sm-2 control-label">积分：</label>

    <div class="col-sm-10">

      <input type="text" name="credit" class="form-control" id="credit" value="0">

    </div>

  </div>

  <div class="form-group">

    <label for="inputPassword3" class="col-sm-2 control-label">该用户名下公众号：</label>

    <div class="col-sm-10">

      <select class="col-xs-12 col-sm-3 col-md-2"  name="weid" id="weid" style="width:10%;" >
      <option value="">选择公众号</option>
     <?php  if(is_array($gzh)) { foreach($gzh as $row) { ?>
     <?php  $gzhname=pdo_fetch("SELECT * FROM " . tablename('uni_account')."where uniacid=".$row['uniacid']);?>
                <option value="<?php  echo $row['uniacid'];?>"><?php  echo $gzhname['name'];?></option>
      <?php  } } ?>
    </select>	

    </div>

  </div>

  <div class="form-group">

    <label for="inputPassword3" class="col-sm-2 control-label">授权模块：</label>

    <div class="col-sm-10">
<select class="col-xs-12 col-sm-3 col-md-2"  name="module" id="module" style="width:10%;" >
      <option value="">选择模块</option>
     <?php  if(is_array($modules)) { foreach($modules as $row) { ?>
      <?php  if(!$row['issystem']) { ?>
                <option value="<?php  echo $row['name'];?>"><?php  echo $row['title'];?></option>
       <?php  } ?>
      <?php  } } ?>
    </select>	
    </div>

  </div>

  <div class="form-group">

    <label for="inputEmail3" class="col-sm-2 control-label">到期时间：</label>

    <div class="col-sm-10">

      <?php  echo tpl_form_field_date('endtime');?>
    </div>

  </div>
  <div class="form-group">

    <div class="col-sm-offset-2 col-sm-10">

      <input type="submit" name="submit" class="btn btn-info" value="提交" />

      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />

    </div>

  </div>

</form>

  </div>

</div>
<?php  } else if($do == 'list') { ?>

<div class="rule panel panel-default">
    <div class="panel-heading">用户名称：<?php  echo $user['username'];?><span style="margin-left:35px;">积分：<?php  echo $member['credit'];?></span></div>
	<div class="table-responsive panel-body">
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th >模块名称</th>
				<th>状态</th>
                <th >对应公众号id</th>
				<th >购买时间</th>
				<th >到期时间</th>
				<?php  if($_W['isfounder']) { ?><th >操作</th><?php  } ?>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($modules)) { foreach($modules as $row) { ?>
			<tr>
				<td><?php  echo $row['name'];?></td>
				<td><?php  if($row['status']=='1') { ?><span style="color:#093;">已购买</span><?php  } ?><?php  if($row['status']=='2') { ?><span style="color:#F00;">到期禁用</span><?php  } ?></td>
                <td><?php  echo $row['weid'];?></td>
				<td><?php  echo date('Y-m-d',$row['starttime']);?></td>
				<td><?php  echo date('Y-m-d',$row['endtime']);?></td>
				<td>
                <?php  if($_W['isfounder']) { ?>
                <a href="<?php  echo url('members/mmodset', array('id' => $row['id']))?>" class="btn btn-default btn-sm" title="禁用" data-toggle="tooltip" data-placement="top" ><i class="fa fa-edit">禁用</i></a>
                <?php  } ?>
                </td>
			</tr>
			<?php  } } ?>
		</tbody>
	</table>
	</div>
</div>
<?php  echo $pager;?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>