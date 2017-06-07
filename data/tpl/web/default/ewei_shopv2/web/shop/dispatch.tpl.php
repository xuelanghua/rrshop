<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('shop.dispatch.add')) { ?>
        	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('shop/dispatch/add')?>"><i class='fa fa-plus'></i> 添加配送方式</a>
        <?php  } ?>
    </span>
    <h2>配送方式管理</h2> </div>

<form action="" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="shop.dispatch" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(cv('shop.dispatch.edit')) { ?>
	                <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('shop/dispatch/enabled',array('enabled'=>1))?>"><i class='fa fa-circle'></i> 启用</button>
	                <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('shop/dispatch/enabled',array('enabled'=>0))?>"><i class='fa fa-circle-o'></i> 禁用</button>
                <?php  } ?>
                <?php if(cv('shop.dispatch.delete')) { ?>	
                	<button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('shop/dispatch/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>
            </div>
        </div>	


        <div class="col-sm-6 pull-right">

            <select name="enabled" class='form-control input-sm select-sm'>
                <option value="" <?php  if($_GPC['enabled'] == '') { ?> selected<?php  } ?>>状态</option>
                <option value="1" <?php  if($_GPC['enabled']== '1') { ?> selected<?php  } ?>>显示</option>
                <option value="0" <?php  if($_GPC['enabled'] == '0') { ?> selected<?php  } ?>>隐藏</option>
            </select>	
            <div class="input-group">				 
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
            </div>

        </div>
    </div>
</form>

<form action="" method="post">
    <?php  if(count($list)>0) { ?>
    <table class="table table-hove table-responsive">
        <thead class="navbar-inner">
            <tr>
                <th style="width:25px;"><input type='checkbox' /></th>
                  <th style='width:50px'>顺序</th>
                <th>名称</th>
                <th  style='width:100px;'>计费方式</th>
                <th style='width:80px;'>首重(首件)价格</th>
                <th style='width:80px;'>续重(续件)价格</th>
                <th style='width:60px;'>状态</th>
                <th style='width:60px;'>默认</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td>
                    <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
                </td>
                  <td>
                    <?php if(cv('shop.dispatch.edit')) { ?>
                    	<a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('shop/dispatch/displayorder',array('id'=>$item['id']))?>" ><?php  echo $item['displayorder'];?></a>
                    <?php  } else { ?>
                    	<?php  echo $row['displayorder'];?> 
                    <?php  } ?>
                <td><?php  echo $item['dispatchname'];?></td>

	                <?php  if($item['calculatetype']==0) { ?>
		                <td>按重量计费</td>
		                <td><?php  echo $item['firstprice'];?></td>
		                <td><?php  echo $item['secondprice'];?></td>
	                <?php  } else { ?>
		                <td>按件计费</td>
		                <td><?php  echo $item['firstnumprice'];?></td>
		                <td><?php  echo $item['secondnumprice'];?></td>
	                <?php  } ?>

                <td>
                    <span class='label <?php  if($item['enabled']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>' 
                          <?php if(cv('shop.dispatch.edit')) { ?>
	                          data-toggle='ajaxSwitch' 
	                          data-switch-value='<?php  echo $item['enabled'];?>'
	                          data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('shop/dispatch/enabled',array('enabled'=>1,'id'=>$item['id']))?>'  
	                          data-switch-value1='1|启用|label label-success|<?php  echo webUrl('shop/dispatch/enabled',array('enabled'=>0,'id'=>$item['id']))?>'  
                          <?php  } ?>>
                          <?php  if($item['enabled']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>

                    </td>
                    <td>
                        <span class='label <?php  if($item['isdefault']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?> defaults' 
                              <?php if(cv('shop.dispatch.edit')) { ?>
	                              data-toggle='ajaxSwitch' 
	                              data-switch-value='<?php  echo $item['isdefault'];?>'
	                              data-switch-value0='0|否|label label-default defaults|<?php  echo webUrl('shop/dispatch/setdefault',array('isdefault'=>1,'id'=>$item['id']))?>'  
	                              data-switch-value1='1|是|label label-success defaults|<?php  echo webUrl('shop/dispatch/setdefault',array('isdefault'=>0,'id'=>$item['id']))?>'  
	                              data-switch-css='.defaults'
	                              data-switch-other = 'true'
                              <?php  } ?>>
                              <?php  if($item['isdefault']==1) { ?>是<?php  } else { ?>否<?php  } ?></span>
                        </td>
                        <td style="text-align:left;">
                            <?php if(cv('shop.dispatch.view|shop.dispatch.edit')) { ?>
                            	<a href="<?php  echo webUrl('shop/dispatch/edit', array('id' => $item['id']))?>" class="btn btn-default btn-sm" >
                            		<i class='fa fa-edit'></i> <?php if(cv('shop.dispatch.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>
                            	</a>
                            <?php  } ?>
                            <?php if(cv('shop.dispatch.delete')) { ?>
                            	<a data-toggle='ajaxRemove' href="<?php  echo webUrl('shop/dispatch/delete', array('id' => $item['id']))?>"class="btn btn-default btn-sm" data-confirm='确认要删除此配送方式吗?'><i class="fa fa-trash"></i> 删除</a>
                            <?php  } ?>
                        </td>
                    </tr> 
                    <?php  } } ?>
                    <tr>
                        <td colspan='9'>
                            <div class='pagers' style='float:right;'>
                                <?php  echo $pager;?>			
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php  } else { ?>
            <div class='panel panel-default'>
                <div class='panel-body' style='text-align: center;padding:30px;'>
                    暂时没有任何配送方式!
                </div>
            </div>
            <?php  } ?>
        </form>

        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>