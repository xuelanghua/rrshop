<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('shop.refundaddress.add')) { ?>
        	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('shop/refundaddress/add')?>"><i class='fa fa-plus'></i> 添加退货地址</a>
        <?php  } ?>
    </span>
    <h2>退货地址管理</h2> </div>

<form action="" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="shop.refundaddress" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">
            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(cv('shop.refundaddress.delete')) { ?>
                	<button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('shop/refundaddress/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>
            </div>
        </div>	


        <div class="col-sm-6 pull-right">
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
                <th>名称</th>
                <th style='width:80px;'>联系人</th>
                <th style='width:100px;'>手机</th>
                <th>地址</th>
                <th style='width:60px;'>默认</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td>
                    <input type='checkbox' value="<?php  echo $item['id'];?>"/>
                </td>

                <td><?php  echo $item['title'];?></td>
                <td><?php  echo $item['name'];?></td>
                <td><?php  echo $item['mobile'];?></td>
                <td><?php  echo $item['address'];?></td>

                <td>
                    <span class='label <?php  if($item['isdefault']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?> defaults'
                        <?php if(cv('shop.refundaddress.edit')) { ?>
	                        data-toggle='ajaxSwitch'
	                        data-switch-value='<?php  echo $item['isdefault'];?>'
	                        data-switch-value0='0|否|label label-default defaults|<?php  echo webUrl('shop/refundaddress/setdefault',array('isdefault'=>1,'id'=>$item['id']))?>'
	                        data-switch-value1='1|是|label label-success defaults|<?php  echo webUrl('shop/refundaddress/setdefault',array('isdefault'=>0,'id'=>$item['id']))?>'
	                        data-switch-css='.defaults'
	                        data-switch-other = 'true'
                        <?php  } ?>
                        >
                        <?php  if($item['isdefault']==1) { ?>是<?php  } else { ?>否<?php  } ?></span>
                </td>
                <td style="text-align:left;">
                    <?php if(cv('shop.refundaddress.view|shop.refundaddress.edit')) { ?>
                    	<a href="<?php  echo webUrl('shop/refundaddress/edit', array('id' => $item['id']))?>" class="btn btn-default btn-sm">
                    		<i class='fa fa-edit'></i> <?php if(cv('shop.refundaddress.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>
                    	</a>
                    <?php  } ?>
                    <?php if(cv('shop.refundaddress.delete')) { ?>
                    	<a data-toggle='ajaxRemove' href="<?php  echo webUrl('shop/refundaddress/delete', array('id' => $item['id']))?>"class="btn btn-default btn-sm" data-confirm='确认要删除此退货地址吗?'><i class="fa fa-trash"></i> 删除</a>
                    <?php  } ?>
                </td>
            </tr>
            <?php  } } ?>

            <tr>
                <td colspan='7'>

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
                    暂时没有任何退货地址!
                </div>
            </div>
            <?php  } ?>
        </form>

        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>