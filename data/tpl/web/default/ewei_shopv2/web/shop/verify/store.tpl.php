<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
 
<div class="page-heading">
    <span class='pull-right'>
            <?php if(cv('shop.verify.store.add')) { ?>
					  <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('shop/verify/store/add')?>"><i class='fa fa-plus'></i> 添加门店</a>
				       <?php  } ?>
    </span>
    <h2>门店管理</h2> </div>
	
  <form action="" method="get">

                   <input type="hidden" name="c" value="site" />
                   <input type="hidden" name="a" value="entry" />
                   <input type="hidden" name="m" value="ewei_shopv2" />
                   <input type="hidden" name="do" value="web" />
                   <input type="hidden" name="r" value="shop.verify.store" />
<div class="page-toolbar row m-b-sm m-t-sm">
                            <div class="col-sm-4">
				 
			   <div class="input-group-btn">
			        <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
				  <?php if(cv('shop.verify.store.edit')) { ?>
			             <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('shop/verify/store/status',array('status'=>1))?>"><i class='fa fa-circle'></i> 启用</button>
				   <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('shop/verify/store/status',array('status'=>0))?>"><i class='fa fa-circle-o'></i> 禁用</button>
				   <?php  } ?>
				<?php if(cv('shop.verify.store.delete')) { ?>	
			        <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('shop/verify/store/delete')?>"><i class='fa fa-trash'></i> 删除</button>
					<?php  } ?>
		
				   
			   </div> 
                               </div>	
	  
			 
                            <div class="col-sm-6 pull-right">
			 
				 <select name="type" class='form-control input-sm select-md'>
                                           <option value="0" <?php  if(empty($_GPC['type'])) { ?>selected<?php  } ?>>门店支持</option>
                                           <option value="1" <?php  if($_GPC['type']==1) { ?>selected<?php  } ?>>自提</option>
                                           <option value="2" <?php  if($_GPC['type']==2) { ?>selected<?php  } ?>>核销</option>
                                           <option value="3" <?php  if($_GPC['type']==3) { ?>selected<?php  } ?>>自提+核销</option>

                                       </select>
				<div class="input-group">				 
                                        <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="门店名称/地址/电话"> <span class="input-group-btn">
						
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
                                </div>
								
                            </div>
</div>
  </form>
 
 <?php  if(count($list)>0) { ?>

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
				 <th style="width:25px;"><input type='checkbox' /></th>		
				  <th style='width:50px'>顺序</th>
                        <th style="width:160px;">门店名称</th>
                        <th style="width:180px;">地址/电话</th>
                        <th style="width:90px;">核销员数量</th>
                        <th style="width:100px;">门店支持</th>
                        <th style="width:80px;">状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
						
								<td>
									<input type='checkbox'   value="<?php  echo $row['id'];?>"/>
							</td>
							  <td>
                    <?php if(cv('shop.verify.store.edit')) { ?>
                    <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('shop/verify/store/displayorder',array('id'=>$row['id']))?>" ><?php  echo $row['displayorder'];?></a>
                    <?php  } else { ?>
                    <?php  echo $row['displayorder'];?> 
                    <?php  } ?>
                </td>
                        <td><?php  echo $row['storename'];?></td>
                        
                        <td><?php  echo $row['tel'];?><br/><?php  echo $row['address'];?></td>
                        <td><?php  echo $row['salercount'];?></td>
                        <td>
                            <?php  if($row['type']==1) { ?>自提<?php  } else if($row['type']==2) { ?>核销<?php  } else if($row['type']==3) { ?>自提+核销<?php  } ?>

                        </td>
                        <td>
                                 <span class='label <?php  if($row['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>' 
										  <?php if(cv('shop.verify.store.edit')) { ?>
										  data-toggle='ajaxSwitch' 
										  data-switch-value='<?php  echo $row['status'];?>'
										  data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('shop/verify/store/status',array('status'=>1,'id'=>$row['id']))?>'  
										  data-switch-value1='1|启用|label label-success|<?php  echo webUrl('shop/verify/store/status',array('status'=>0,'id'=>$row['id']))?>'  
										  <?php  } ?>
										>
										  <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
                            </td>
                        <td>
                          <?php if(cv('shop.verify.store.edit|shop.verify.store.view')) { ?>
						  <a class='btn btn-default btn-sm' href="<?php  echo webUrl('shop/verify/store/edit', array('id' => $row['id']))?>"><i class='fa fa-edit'></i> <?php if(cv('shop.verify.store.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a><?php  } ?>
                          <?php if(cv('shop.verify.store.delete')) { ?><a class='btn btn-default  btn-sm' data-toggle="ajaxRemove"  href="<?php  echo webUrl('shop/verify/store/delete', array('id' => $row['id']))?>" data-confirm="确认删除此门店吗？"><i class='fa fa-trash'></i> 删除</a><?php  } ?></td>

                    </tr>
                    <?php  } } ?>
                 
                </tbody>
            </table>
 
       </form>

<?php  echo $pager;?>
        <?php  } else { ?>
<div class='panel panel-default'>
	<div class='panel-body' style='text-align: center;padding:30px;'>
		 暂时没有任何门店!
	</div>
</div>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>