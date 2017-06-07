<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('groups.category.add')) { ?>
        <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('groups/category/add')?>">添加新商品分类</a>
        <?php  } ?>
    </span>
    <h2>商品分类</h2>
</div>
<?php  if(count($list)>0) { ?>
<form action="" method="post">
    <table class="table table-hover table-responsive">
        <thead class="navbar-inner">
            <tr>
                <th style="width:50px;">ID</th>
                <th style='width:80px'>显示顺序</th>
                <th>标题</th>
                <th>状态</th>
                <th >操作</th>
            </tr>
        </thead>
        <tbody id="sort">
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
                <td><?php  echo $row['id'];?></td>
                <td>
                    <?php if(cv('groups.category.edit')) { ?>
                    <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('groups/category/displayorder',array('id'=>$row['id']))?>" ><?php  echo $row['displayorder'];?></a>
                    <?php  } else { ?>
                    <?php  echo $row['displayorder'];?>
                    <?php  } ?>
                </td>
                <td><img src="<?php  echo tomedia($row['thumb'])?>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic100.jpg'" style="width:30px;height:30px;padding:1px;border:1px solid #ccc" /> <?php  echo $row['name'];?></td>
                <td>
                    <span class='label <?php  if($row['enabled']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
                          <?php if(cv('groups.category.edit')) { ?>
                          data-toggle='ajaxSwitch'
                          data-switch-value='<?php  echo $row['enabled'];?>'
                          data-switch-value0='0|隐藏|label label-default|<?php  echo webUrl('groups/category/enabled',array('enabled'=>1,'id'=>$row['id']))?>'
                          data-switch-value1='1|显示|label label-success|<?php  echo webUrl('groups/category/enabled',array('enabled'=>0,'id'=>$row['id']))?>'
                          <?php  } ?>
                          >
                          <?php  if($row['enabled']==1) { ?>显示<?php  } else { ?>隐藏<?php  } ?></span>
                    </td>
                    <td style="text-align:left;">
                        <?php if(cv('groups.category.view|groups.category.edit')) { ?>
                        <a href="<?php  echo webUrl('groups/category/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm"
                           title="<?php if(cv('groups.category.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>"><i class="fa fa-edit"></i> <?php if(cv('groups.category.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?></a><?php  } ?>
                        <?php if(cv('groups.category.delete')) { ?>
                        <a data-toggle='ajaxRemove' href="<?php  echo webUrl('groups/category/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm" data-confirm="确认删除此分类?" title="删除"><i class="fa fa-trash"></i> 删除</a><?php  } ?>
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
        <?php  } else { ?>
        <div class='panel panel-default'>
            <div class='panel-body' style='text-align: center;padding:30px;'>
                暂时没有任何商品分类
            </div>
            <?php  } ?>
    </form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>