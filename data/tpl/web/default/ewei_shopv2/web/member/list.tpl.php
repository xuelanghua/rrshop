<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"> <h2>会员管理</h2> </div>

  <form action="./index.php" method="get" class="form-horizontal table-search" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="ewei_shopv2" />
                <input type="hidden" name="do" value="web" />
                <input type="hidden" name="r" value="member.list" />
<div class="page-toolbar row m-b-sm m-t-sm">
                            <div class="col-sm-4">

			   <div class="input-group-btn">
			        <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
				  <?php if(cv('member.list.edit')) { ?>
			             <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('member/list/setblack',array('isblack'=>1))?>"><i class='fa fa-user'></i> 设置黑名单</button>
				   <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('member/list/setblack',array('isblack'=>0))?>"><i class='fa fa-user-o'></i> 取消黑名单</button>
				   <?php  } ?>


				<?php if(cv('member.list.delete')) { ?>
			              <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('member/list/delete')?>"><i class='fa fa-trash'></i> 删除</button>
				 <?php  } ?>
			   </div>
                               </div>


                            <div class="col-sm-6 pull-right">

				<div class="input-group">
                                          <input type="text" class="form-control input-sm"  name="realname" value="<?php  echo $_GPC['realname'];?>" placeholder="可搜索昵称/姓名/手机号/ID"/>
				 <span class="input-group-btn">

                                        <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                                        <button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出</button>
										<button class="btn btn-sm btn-default" type="button" onclick="$('#moresearch').toggle()"> 其他 <i class="fa fa-angle-down"></i></button>
				</span>
                                </div>

                            </div>
</div>
				<div class="page-toolbar row" <?php  if($_GPC['followed']=='' && $_GPC['level']=='' && $_GPC['groupid']=='' && $_GPC['isblack']=='' && $_GPC['time']['start']==''  && $_GPC['time']['end']=='' ) { ?>style='display:none;'<?php  } ?> id='moresearch' >


					<div class="col-sm-12">

			 	  <select name='followed' class='form-control  input-sm select-md' style="width:140px">
								<option value=''>关注</option>
								<option value='0' <?php  if($_GPC['followed']=='0') { ?>selected<?php  } ?>>未关注</option>
								<option value='1' <?php  if($_GPC['followed']=='1') { ?>selected<?php  } ?>>已关注</option>
								<option value='2' <?php  if($_GPC['followed']=='2') { ?>selected<?php  } ?>>取消关注</option>
							</select>


	<select name='level' class='form-control  input-sm select-md' style="width:140px;"  >
                        <option value=''>等级</option>
                        <?php  if(is_array($levels)) { foreach($levels as $level) { ?>
                        <option value='<?php  echo $level['id'];?>' <?php  if($_GPC['level']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                        <?php  } } ?>
                    </select>
		<select name='groupid' class='form-control  input-sm select-md' style="width:140px;"  >
                        <option value=''>分组</option>
                        <?php  if(is_array($groups)) { foreach($groups as $group) { ?>
                        <option value='<?php  echo $group['id'];?>' <?php  if($_GPC['groupid']==$group['id']) { ?>selected<?php  } ?>><?php  echo $group['groupname'];?></option>
                        <?php  } } ?>
                    </select>

                       <select name='isblack'  class='form-control  input-sm select-md'   style="width:140px;"  >
                        <option value=''>黑名单</option>
                        <option value='0' <?php  if($_GPC['isblack']=='0') { ?>selected<?php  } ?>>否</option>
                        <option value='1' <?php  if($_GPC['isblack']=='1') { ?>selected<?php  } ?>>是</option>
                    </select>


                        <?php  echo tpl_daterange('time', array('sm'=>true, 'placeholder'=>'注册时间'),true);?>




                            </div>


				</div>
  </form>

 
        <table class="table table-hover table-responsive">
            <thead class="navbar-inner">
                <tr>
                      <th style="width:25px;"><input type='checkbox' /></th>
		 

                    <th style="width:150px;">粉丝</th>
                    <th style="width:120px;">会员信息</th>
                    
                    <th style="width:100px;">等级/分组</th>
                    <th style="width:100px;">注册时间</th>
                    <th style="width:100px;">积分/余额</th>
                    <th style="width:100px;">成交</th>
                    
                    <th style="width:100px;">关注/黑名单</th>
                    <th style="width:70px;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr rel="pop" data-title="ID: <?php  echo $row['id'];?> " data-content="推荐人 <br/> <?php  if(empty($row['agentid'])) { ?>
				  <?php  if($row['isagent']==1) { ?>
				      <label class='label label-primary'>总店</label>
				      <?php  } else { ?>
				       <label class='label label-default'>暂无</label>
				      <?php  } ?>
				<?php  } else { ?>
				
                    	<?php  if(!empty($row['agentavatar'])) { ?>
                         <img src='<?php  echo $row['agentavatar'];?>' style='width:20px;height:20px;padding1px;border:1px solid #ccc' />
                       <?php  } ?>
                       [<?php  echo $row['agentid'];?>]<?php  if(empty($row['agentnickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['agentnickname'];?><?php  } ?>
					   <?php  } ?>">
					
			
                   	<td style="position: relative; ">
					<input type='checkbox'   value="<?php  echo $row['id'];?>"/></td>
                    <td  >
			<div  >
                    	<?php  if(!empty($row['avatar'])) { ?>
                         <img src='<?php  echo tomedia($row['avatar'])?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                       <?php  } ?>
                       <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>
                        </div>
                    </td>
                    <td><?php  echo $row['realname'];?><br/><span <?php  if(!empty($row['mobileverify'])) { ?>class="text-info" title="已绑定"<?php  } ?>><?php  echo $row['mobile'];?></span></td>
                    
                    <td><?php  if(empty($row['levelname'])) { ?>普通会员<?php  } else { ?><?php  echo $row['levelname'];?><?php  } ?>
                        <br/><?php  if(empty($row['groupname'])) { ?>无分组<?php  } else { ?><?php  echo $row['groupname'];?><?php  } ?></td>
      
                    <td><?php  echo date("Y-m-d",$row['createtime'])?><br/><?php  echo date("H:i:s",$row['createtime'])?></td>
                    <td><label class="label label-primary">积分: <?php  echo intval($row['credit1'])?></label>
						<br/><label class="label label-danger">余额: <?php  echo $row['credit2'];?></label></td>
                    
                    <td><label class="label label-primary">订单: <?php  echo $row['ordercount'];?></label>
						<br/><label class="label label-danger">金额: <?php  echo floatval($row['ordermoney'])?></label></td>
                    <td> 
		 
						<?php  if(empty($row['followed'])) { ?>
                            <?php  if(empty($row['unfollowtime'])) { ?>
                                <label class='label label-default'>未关注</label>
                            <?php  } else { ?>
                                <label class='label label-warning'>取消关注</label>
                            <?php  } ?>
                        <?php  } else { ?>
                            <label class='label label-success'>已关注</label>
                        <?php  } ?>
					
					<br/><label class='label <?php  if($row['isblack']==1) { ?>label-error<?php  } else { ?>label-primary<?php  } ?>' 
										  <?php if(cv('member.list.edit')) { ?>
										  data-toggle='ajaxSwitch' 
										  data-switch-value='<?php  echo $row['isblack'];?>'
										  data-switch-value0='0|正常|label label-primary|<?php  echo webUrl('member/list/setblack',array('isblack'=>1,'id'=>$row['id']))?>'
										  data-switch-value1='1|黑名单|label label-error|<?php  echo webUrl('member/list/setblack',array('isblack'=>0,'id'=>$row['id']))?>'
										  <?php  } ?>
					>
										  <?php  if($row['isblack']==1) { ?>黑名单<?php  } else { ?>正常<?php  } ?></label>
					
					</td>
             
                      
                            <td  style="overflow:visible;">
                        
                        <div class="btn-group btn-group-sm" >
                                <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="javascript:;">操作 <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-left" role="menu" style='z-index: 9999'>
                               
                        <?php if(cv('member.list.detail')) { ?>
                        	<li><a href="<?php  echo webUrl('member/list/detail',array('id' => $row['id']));?>" title="会员详情"><i class='fa fa-edit'></i> 会员详情</a></li>
                        <?php  } ?>
                        <?php if(cv('order.list')) { ?>
                        	<li><a href="<?php  echo webUrl('order/list', array('searchfield'=>'member','keyword'=>$row['nickname']))?>" title='会员订单'><i class='fa fa-list'></i> 会员订单</a></li>
                        <?php  } ?>
                        <?php if(cv('finance.recharge.credit1')) { ?><li><a data-toggle="ajaxModal" href="<?php  echo webUrl('finance/recharge', array('type'=>'credit1','id'=>$row['id']))?>" title='充值积分'><i class='fa fa-credit-card'></i> 充值积分</a></li><?php  } ?>
                        <?php if(cv('finance.recharge.credit2')) { ?><li><a data-toggle="ajaxModal" href="<?php  echo webUrl('finance/recharge', array('type'=>'credit2','id'=>$row['id']))?>" title='充值余额'><i class='fa fa-money'></i> 充值余额 </a></li><?php  } ?>
                        <?php if(cv('member.list.delete')) { ?><li><a  data-toggle='ajaxRemove'  href="<?php  echo webUrl('member/list/delete',array('id' => $row['id']));?>" title='删除会员' data-confirm="确定要删除该会员吗？"><i class='fa fa-remove'></i> 删除会员</a></li><?php  } ?>
                                </ul>
                            </div>

               
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
           <?php  echo $pager;?>
		   <script language="javascript">
			     <?php  if($opencommission) { ?>
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
	<?php  } ?>
			   
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>