<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
    <span class='pull-right'>

        <?php if(mcv('goods.add')) { ?>
        <a class='btn btn-primary btn-sm' href="<?php  echo merchUrl('goods/add')?>"><i class='fa fa-plus'></i> 添加商品</a>
        <?php  } ?>
    </span>
    <h2>商品管理</h2> </div>

<form action="./merchant.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="goods" />
    <input type="hidden" name="goodsfrom" value="<?php  echo $goodsfrom;?>" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(mcv('goods.edit')) { ?>
                <?php  if($_GPC['goodsfrom']=='sale') { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo merchUrl('goods/status',array('status'=>0))?>"><i class='fa fa-circle-o'></i> 下架</button>
                <?php  } ?>
                <?php  if($_GPC['goodsfrom']=='stock') { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo merchUrl('goods/status',array('status'=>1))?>"><i class='fa fa-circle'></i> 上架</button>

                <?php  } ?>
                <?php  } ?>

                <?php  if($_GPC['goodsfrom']=='cycle') { ?>
                <?php if(mcv('goods.delete1')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="如果商品存在购买记录，会无法关联到商品, 确认要彻底删除吗?" data-href="<?php  echo merchUrl('goods/delete1')?>"><i class='fa fa-remove'></i> 彻底删除</button>
                <?php  } ?>

                <?php if(mcv('goods.restore')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要恢复?" data-href="<?php  echo merchUrl('goods/restore')?>"><i class='fa fa-reply'></i> 恢复到仓库</button>
                <?php  } ?>

                <?php  } else { ?>
                <?php if(mcv('goods.delete')) { ?>
                <button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除吗?" data-href="<?php  echo merchUrl('goods/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>
                <?php  } ?>



            </div> 
        </div>	


        <div class="col-sm-8 pull-right">

            <select name="cate" class='form-control input-sm select-sm select2' style="width:200px;" data-placeholder="商品分类">
                <option value="" <?php  if(empty($_GPC['cate'])) { ?>selected<?php  } ?> >商品分类</option>
                <?php  if(is_array($category)) { foreach($category as $c) { ?>
                <option value="<?php  echo $c['id'];?>" <?php  if($_GPC['cate']==$c['id']) { ?>selected<?php  } ?> ><?php  echo $c['name'];?></option>
                <?php  } } ?>
            </select>

            <div class="input-group">				 
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="ID/名称/编号/条码"> <span class="input-group-btn">
                    		
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
            </div>

        </div>
    </div>
</form>

<?php  if(count($list)>0) { ?>
<table class="table table-hover table-responsive"> 
    <thead class="navbar-inner">
        <tr>
            <th style="width:25px;"><input type='checkbox' /></th>
            <th style="width:60px;text-align:center;">排序</th>
            <th style="width:60px;">商品</th>
            <th  style="width:200px;">&nbsp;</th>

            <th style="width:70px;" >价格</th>
            <th style="width:70px;" >库存</th>
            <th style="width:80px;" >销量</th>
            <?php  if($goodsfrom!='cycle') { ?>
            <th  style="width:60px;" >状态</th>
            <?php  } ?>
            <th style="">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <tr>


            <td>
                <input type='checkbox'  value="<?php  echo $item['id'];?>"/>
            </td>

            <td style='text-align:center;'>
                <?php if(mcv('goods.edit')) { ?>
                <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo merchUrl('goods/change',array('type'=>'merchdisplayorder','id'=>$item['id']))?>" ><?php  echo $item['merchdisplayorder'];?></a>
                <?php  } else { ?>
                <?php  echo $item['displayorder'];?> 
                <?php  } ?>
            </td>
            <td>
                <img src="<?php  echo tomedia($item['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"  />
            </td>
            <td class='full' style="overflow-x: hidden">
                <?php  if(!empty($category[$item['pcate']])) { ?>
                	<span class="text-danger">[<?php  echo $category[$item['pcate']]['name'];?>]</span>
                <?php  } ?>
                <?php  if(!empty($category[$item['ccate']])) { ?>
                	<span class="text-info">[<?php  echo $category[$item['ccate']]['name'];?>]</span>
                <?php  } ?>
                <?php  if(!empty($category[$item['tcate']]) && intval($shopset['catlevel'])==3) { ?>
                	<span class="text-info">[<?php  echo $category[$item['tcate']]['name'];?>]</span>
                <?php  } ?>
                <br/>
                <?php if(mcv('goods.edit')) { ?>
                <a href='javascript:;' data-toggle='ajaxEdit' data-edit='textarea'  data-href="<?php  echo merchUrl('goods/change',array('type'=>'title','id'=>$item['id']))?>" ><?php  echo $item['title'];?></a>
                <?php  } else { ?>
                <?php  echo $item['title'];?>
                <?php  } ?>
            </td>

            <td>
                <?php  if($item['hasoption']==1) { ?>
                <?php if(mcv('goods.edit')) { ?>
                <span data-toggle='tooltip' title='多规格不支持快速修改'><?php  echo $item['marketprice'];?></span>
                <?php  } else { ?>
                <?php  echo $item['marketprice'];?>
                <?php  } ?>
                <?php  } else { ?>
                <?php if(mcv('goods.edit')) { ?>

                <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo merchUrl('goods/change',array('type'=>'marketprice','id'=>$item['id']))?>" ><?php  echo $item['marketprice'];?></a>
                <?php  } else { ?>
                <?php  echo $item['marketprice'];?>
                <?php  } ?><?php  } ?>

            </td>

            <td>
                <?php  if($item['hasoption']==1) { ?>
                <?php if(mcv('goods.edit')) { ?>
                <span data-toggle='tooltip' title='多规格不支持快速修改'><?php  echo $item['total'];?></span>
                <?php  } else { ?>
                <?php  echo $item['total'];?>
                <?php  } ?>
                <?php  } else { ?>
                <?php if(mcv('goods.edit')) { ?>
                <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo merchUrl('goods/change',array('type'=>'total','id'=>$item['id']))?>" ><?php  echo $item['total'];?></a>							
                <?php  } else { ?>
                <?php  echo $item['total'];?>
                <?php  } ?><?php  } ?>
            </td>
            <td><?php  echo $item['salesreal'];?></td>

            <?php  if($goodsfrom!='cycle') { ?>
            <td  style="overflow:visible;">
                <span class='label <?php  if($item['status']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>' 
                      <?php if(mcv('goods.edit')) { ?>
                      data-toggle='ajaxSwitch' 
                      data-confirm = "确认是<?php  if($item['status']==1) { ?>下架<?php  } else { ?>上架<?php  } ?>？"
                      data-switch-refresh='true'
                      data-switch-value='<?php  echo $item['status'];?>'
                      data-switch-value0='0|下架|label label-default|<?php  echo merchUrl('goods/status',array('status'=>1,'id'=>$item['id']))?>'  
                      data-switch-value1='1|上架|label label-success|<?php  echo merchUrl('goods/status',array('status'=>0,'id'=>$item['id']))?>'  
                      <?php  } ?>
                      >
                      <?php  if($item['status']==1) { ?>上架<?php  } else { ?>下架<?php  } ?></span>



                </td>
                <?php  } ?>
                <td  style="overflow:visible;position:relative">

                        <?php if(mcv('goods.edit|goods.view')) { ?>
                        	<a  class='btn btn-default btn-sm' href="<?php  echo merchUrl('goods/edit', array('id' => $item['id'],'goodsfrom'=>$goodsfrom,'page'=>$page))?>" title="<?php if(mcv('goods.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class='fa fa-edit'></i> <?php if(mcv('goods.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a>
                        <?php  } ?>
                        <?php  if($_GPC['goodsfrom']=='cycle') { ?>
                        <?php if(mcv('goods.restore')) { ?>
                        <a  class='btn btn-default btn-sm' data-toggle='ajaxRemove' href="<?php  echo merchUrl('goods/restore', array('id' => $item['id']))?>" data-confirm='确认要恢复?'><i class='fa fa-reply'></i> 恢复到仓库</a>
                        <?php  } ?>
                        <?php if(mcv('goods.delete1')) { ?>
                        <a  class='btn btn-default btn-sm' data-toggle='ajaxRemove' href="<?php  echo merchUrl('goods/delete1', array('id' => $item['id']))?>" data-confirm='如果此商品存在购买记录，会无法关联到商品, 确认要彻底删除吗?？'><i class='fa fa-remove'></i> 彻底删除</a>
                        <?php  } ?>
                        <?php  } else { ?>
                        <?php if(mcv('goods.delete')) { ?>
                        <a  class='btn btn-default btn-sm' data-toggle='ajaxRemove' href="<?php  echo merchUrl('goods/delete', array('id' => $item['id']))?>" data-confirm='确认删除此商品？'><i class='fa fa-trash'></i> 删除</a>
                        <?php  } ?>
                        <?php  } ?>


                        <?php  if($_GPC['goodsfrom']!='cycle') { ?>
                        <a href="javascript:;" class='btn btn-default btn-sm js-clip' data-url="<?php  echo mobileUrl('goods/detail', array('id' => $item['id']),true)?>">
                            <i class='fa fa-link'></i> 复制链接
                        </a>
                        <a href="javascript:void(0);" class="btn btn-default btn-sm" data-toggle="popover" data-trigger="hover" data-html="true"
                              data-content="<img src='<?php  echo $item['qrcode'];?>' width='130' alt='链接二维码'>" data-placement="auto right">
                            <i class="glyphicon glyphicon-qrcode"></i>
                        </a>
                        <?php  } ?>


                    </td>
                </tr>
                <tr>
                    <td colspan='<?php  if($goodsfrom=='cycle') { ?>8<?php  } else { ?>9<?php  } ?>' style='text-align: right;border-top:none;padding:5px 0;' class='aops'>

                        <a class='<?php  if($item['isnew']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'  
                       <?php if(mcv('goods.property')) { ?>
                       data-toggle='ajaxSwitch' 
                       data-switch-value='<?php  echo $item['isnew'];?>'
                       data-switch-value0='0||text-default|<?php  echo merchUrl('goods/property',array('type'=>'new', 'data'=>1,'id'=>$item['id']))?>'  
                       data-switch-value1='1||text-danger|<?php  echo merchUrl('goods/property',array('type'=>'new','data'=>0,'id'=>$item['id']))?>'  
                       <?php  } ?>
                       >新品</a>
                        <!--a class='<?php  if($item['ishot']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'
                           <?php if(mcv('goods.property')) { ?>
                           data-toggle='ajaxSwitch'
                           data-switch-value='<?php  echo $item['ishot'];?>'
                           data-switch-value0='0||text-default|<?php  echo merchUrl('goods/property',array('type'=>'hot', 'data'=>1,'id'=>$item['id']))?>'
                           data-switch-value1='1||text-danger|<?php  echo merchUrl('goods/property',array('type'=>'hot','data'=>0,'id'=>$item['id']))?>'
                           <?php  } ?>
                           >热卖</a>
                         <a class='<?php  if($item['isrecommand']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'
                            <?php if(mcv('goods.property')) { ?>
                            data-toggle='ajaxSwitch'
                            data-switch-value='<?php  echo $item['isrecommand'];?>'
                            data-switch-value0='0||text-default|<?php  echo merchUrl('goods/property',array('type'=>'recommand', 'data'=>1,'id'=>$item['id']))?>'
                            data-switch-value1='1||text-danger|<?php  echo merchUrl('goods/property',array('type'=>'recommand','data'=>0,'id'=>$item['id']))?>'
                            <?php  } ?>
                            >推荐</a-->
                          <a class='<?php  if($item['isdiscount']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'  
                             <?php if(mcv('goods.property')) { ?>
                             data-toggle='ajaxSwitch' 
                             data-switch-value='<?php  echo $item['isdiscount'];?>'
                             data-switch-value0='0||text-default|<?php  echo merchUrl('goods/property',array('type'=>'discount', 'data'=>1,'id'=>$item['id']))?>'  
                             data-switch-value1='1||text-danger|<?php  echo merchUrl('goods/property',array('type'=>'discount','data'=>0,'id'=>$item['id']))?>'  
                             <?php  } ?>
                             >促销</a>
                           <a class='<?php  if($item['issendfree']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'  
                              <?php if(mcv('goods.property')) { ?>
                              data-toggle='ajaxSwitch' 
                              data-switch-value='<?php  echo $item['issendfree'];?>'
                              data-switch-value0='0||text-default|<?php  echo merchUrl('goods/property',array('type'=>'sendfree', 'data'=>1,'id'=>$item['id']))?>'  
                              data-switch-value1='1||text-danger|<?php  echo merchUrl('goods/property',array('type'=>'sendfree','data'=>0,'id'=>$item['id']))?>'  
                              <?php  } ?>
                              >包邮</a>
                            <a class='<?php  if($item['istime']==1) { ?>text-danger<?php  } else { ?>text-default<?php  } ?>'  
                               <?php if(mcv('goods.property')) { ?>
                               data-toggle='ajaxSwitch' 
                               data-switch-value='<?php  echo $item['istime'];?>'
                               data-switch-value0='0||text-default|<?php  echo merchUrl('goods/property',array('type'=>'time', 'data'=>1,'id'=>$item['id']))?>'  
                               data-switch-value1='1||text-danger|<?php  echo merchUrl('goods/property',array('type'=>'time','data'=>0,'id'=>$item['id']))?>'  
                               <?php  } ?>
                               >限时卖</a>

                             </td>
                            </tr>
                            <?php  } } ?>
                           </tbody>
                          </table>
                          <?php  echo $pager;?>
                          <?php  } else { ?>
                          <div class='panel panel-default'>
                              <div class='panel-body' style='text-align: center;padding:30px;'>
                                  暂时没有任何商品!
                              </div>
                          </div>
                          <?php  } ?>
                          <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
