<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
    <?php if(cv('diypage.page.sys.add|diypage.page.diy.add')) { ?>
        <span class="pull-right">
            <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('diypage/page/create')?>"><i class="fa fa-plus"></i> 新建页面</a>
        </span>
    <?php  } ?>
    <h2><?php  if($pagetype=='sys') { ?>系统页面<?php  } else if($pagetype=='diy') { ?>自定义页面<?php  } else if($pagetype=='plu') { ?>应用页面<?php  } else if($pagetype=='mod') { ?>公用模块<?php  } ?> <small>总数(<?php  echo $total;?>)</small></h2>

</div>

<form action="<?php echo !empty($_W['merchid'])?'./merchant.php':'./index.php'?>" <?php if(cv('diypage.page.sys.delete|diypage.page.diy.delete|diypage.page.mod.delete')) { ?>method="get"<?php  } ?>>
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="diypage.page.<?php  echo $pagetype;?>" />

    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">
            <div class="input-group-btn">
                <span class="btn btn-default btn-sm" type="button" data-toggle="refresh"><i class="fa fa-refresh"></i></span>
                <?php  if($pagetype=='sys') { ?>
                    <?php if(cv('diypage.page.sys.delete')) { ?>
                        <button class="btn btn-default btn-sm" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo webUrl('diypage/page/sys/delete')?>" disabled="disabled"><i class="fa fa-trash"></i> 删除</button>
                    <?php  } ?>
                <?php  } ?>
                <?php  if($pagetype=='diy') { ?>
                    <?php if(cv('diypage.page.diy.delete')) { ?>
                        <button class="btn btn-default btn-sm" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo webUrl('diypage/page/diy/delete')?>" disabled="disabled"><i class="fa fa-trash"></i> 删除</button>
                    <?php  } ?>
                <?php  } ?>
                <?php  if($pagetype=='plu') { ?>
                    <?php if(cv('diypage.page.plu.delete')) { ?>
                        <button class="btn btn-default btn-sm" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo webUrl('diypage/page/plu/delete')?>" disabled="disabled"><i class="fa fa-trash"></i> 删除</button>
                    <?php  } ?>
                <?php  } ?>
                <?php  if($pagetype=='mod') { ?>
                    <?php if(cv('diypage.page.mod.delete')) { ?>
                        <button class="btn btn-default btn-sm" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo webUrl('diypage/page/mod/delete')?>" disabled="disabled"><i class="fa fa-trash"></i> 删除</button>
                    <?php  } ?>
                <?php  } ?>
            </div>
        </div>


        <div class="col-sm-7 pull-right">
            <?php  if($pagetype=='sys') { ?>
                <select name="type" class="form-control  input-sm" style="width:120px;">
                    <option value="" <?php  if(empty($_GPC['type'])) { ?> selected<?php  } ?>>页面类型</option>
                    <option value="2" <?php  if(intval($_GPC['type'])==2) { ?> selected<?php  } ?>>商城首页</option>
                    <option value="3" <?php  if(intval($_GPC['type'])==3) { ?> selected<?php  } ?>>会员中心</option>
                    <option value="5" <?php  if(intval($_GPC['type'])==5) { ?> selected<?php  } ?>>商品详情页</option>
                </select>
            <?php  } else if($pagetype=='plu') { ?>
                <select name="type" class="form-control  input-sm" style="width:120px;">
                    <option value="" <?php  if(empty($_GPC['type'])) { ?> selected<?php  } ?>>页面类型</option>
                    <?php  if(p('creditshop')) { ?>
                        <option value="4" <?php  if(intval($_GPC['type'])==4) { ?> selected<?php  } ?>>分销中心</option>
                    <?php  } ?>
                    <?php  if(p('creditshop')) { ?>
                        <option value="6" <?php  if(intval($_GPC['type'])==6) { ?> selected<?php  } ?>>积分商城</option>
                    <?php  } ?>
                    <?php  if(p('seckill')) { ?>
                        <option value="7" <?php  if(intval($_GPC['type'])==7) { ?> selected<?php  } ?>>整点秒杀</option>
                    <?php  } ?>
                    <?php  if(p('exchange')) { ?>
                        <option value="8" <?php  if(intval($_GPC['type'])==8) { ?> selected<?php  } ?>>兑换中心</option>
                    <?php  } ?>
                </select>
            <?php  } ?>
            <div class="input-group">
                <input type="text" class="input-sm form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入页面标题关键字进行搜索">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                </span>
            </div>

        </div>
    </div>

    <?php  if(empty($list)) { ?>
        <div class="panel panel-default">
            <div class="panel-body" style="text-align: center;padding:30px;">
                未查询到<?php  if(!empty($_GPC['keyword'])) { ?>"<?php  echo $_GPC['keyword'];?>"<?php  } ?>相关<?php  if($pagetype=='mod') { ?>模块<?php  } else { ?>页面<?php  } ?>!
            </div>
        </div>
    <?php  } else { ?>

        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th style="width:25px;"><input type="checkbox"></th>
                <th><?php  if($pagetype=='mod') { ?>模块<?php  } else { ?>页面<?php  } ?>名称(点击预览)</th>
                <?php  if($pagetype=='sys'||$pagetype=='plu') { ?>
                    <th style="width: 90px; text-align: center;">页面类型</th>
                <?php  } ?>
                <?php  if($pagetype!='mod') { ?>
                    <th style="width: 100px;">关键字</th>
                <?php  } ?>
                <th style="width: 95px;">创建时间</th>
                <th style="width: 95px;">最后修改时间</th>
                <th style="width: 210px">操作</th>
            </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php  echo $item['id'];?>">
                        </td>
                        <td>
                            <a href="<?php  if($item['type']==5||$item['type']==7||$item['type']==8) { ?>javascript:tip.msgbox.err('<?php  if($item['type']==5) { ?>商品详情页<?php  } else if($item['type']==5) { ?>秒杀专题页<?php  } else { ?>兑换中心<?php  } ?>涉及商品数据问题，请至手机端预览');<?php  } else { ?><?php  echo webUrl('diypage/page/preview', array('id'=>$item['id']))?><?php  } ?>" target="_blank">
                                <?php  if(($pagetype=='sys'||$pagetype=='plu') && !empty($diypagedata)) { ?>
                                    <?php  if($diypagedata['home']==$item['id'] || $diypagedata['member']==$item['id'] || $diypagedata['commission']==$item['id'] || $diypagedata['detail']==$item['id'] || $diypagedata['creditshop']==$item['id'] || $diypagedata['seckill']==$item['id'] || $diypagedata['exchange']==$item['id']) { ?>
                                        <span class="label label-default" style="padding: 3px 5px;">已应用</span>
                                    <?php  } ?>
                                <?php  } ?>
                                <?php  echo $item['name'];?>
                            </a>
                        </td>
                        <?php  if($pagetype=='sys'||$pagetype=='plu') { ?>
                            <td style="text-align: center;"><span class="label label-<?php  echo $item['typeclass'];?>"><?php  echo $item['typename'];?></span></td>
                        <?php  } ?>
                        <?php  if($pagetype!='mod') { ?>
                            <td>
                                <?php  if($item['type']==5||$item['type']==7||$item['type']==8) { ?>-
                                <?php  } else { ?>
                                    <?php  if(empty($item['keyword'])) { ?><b>未设置</b><?php  } else { ?><?php  echo $item['keyword'];?><?php  } ?>
                                <?php  } ?>
                            </td>
                        <?php  } ?>
                        <td><?php  echo date('Y-m-d', $item['createtime'])?><br><?php  echo date('H:i:s', $item['createtime'])?></td>
                        <td><?php  echo date('Y-m-d', $item['lastedittime'])?><br><?php  echo date('H:i:s', $item['lastedittime'])?></td>
                        <td>
                            <?php  if($pagetype=='sys') { ?>
                                <?php if(cv('diypage.page.sys.edit')) { ?>
                                    <a class="btn btn-default btn-sm" href="<?php  echo webUrl('diypage/page/sys/edit', array('id'=>$item['id']))?>"><i class="fa fa-edit"></i>  编辑</a>
                                <?php  } ?>
                                <?php if(cv('diypage.page.sys.delete')) { ?>
                                    <a class="btn btn-default btn-sm" data-toggle="ajaxRemove" href="<?php  echo webUrl('diypage/page/sys/delete', array('id'=>$item['id']))?>" data-confirm="确定要删除该页面吗？"><i class="fa fa-remove"></i> 删除</a>
                                <?php  } ?>
                            <?php  } ?>
                            <?php  if($pagetype=='diy') { ?>
                                <?php if(cv('diypage.page.diy.edit')) { ?>
                                   <a class="btn btn-default btn-sm" href="<?php  echo webUrl('diypage/page/diy/edit', array('id'=>$item['id']))?>"><i class="fa fa-edit"></i>  编辑</a>
                                <?php  } ?>
                                <?php if(cv('diypage.page.diy.delete')) { ?>
                                    <a class="btn btn-default btn-sm" data-toggle="ajaxRemove" href="<?php  echo webUrl('diypage/page/diy/delete', array('id'=>$item['id']))?>" data-confirm="确定要删除该页面吗？"><i class="fa fa-remove"></i> 删除</a>
                                <?php  } ?>
                            <?php  } ?>
                            <?php  if($pagetype=='plu') { ?>
                                <?php if(cv('diypage.page.plu.edit')) { ?>
                                   <a class="btn btn-default btn-sm" href="<?php  echo webUrl('diypage/page/plu/edit', array('id'=>$item['id']))?>"><i class="fa fa-edit"></i>  编辑</a>
                                <?php  } ?>
                                <?php if(cv('diypage.page.plu.delete')) { ?>
                                    <a class="btn btn-default btn-sm" data-toggle="ajaxRemove" href="<?php  echo webUrl('diypage/page/plu/delete', array('id'=>$item['id']))?>" data-confirm="确定要删除该页面吗？"><i class="fa fa-remove"></i> 删除</a>
                                <?php  } ?>
                            <?php  } ?>
                            <?php  if($pagetype=='mod') { ?>
                                <?php if(cv('diypage.page.mod.edit')) { ?>
                                    <a class="btn btn-default btn-sm" href="<?php  echo webUrl('diypage/page/mod/edit', array('id'=>$item['id']))?>"><i class="fa fa-edit"></i>  编辑</a>
                                <?php  } ?>
                                <?php if(cv('diypage.page.mod.delete')) { ?>
                                    <a class="btn btn-default btn-sm" data-toggle="ajaxRemove" href="<?php  echo webUrl('diypage/page/mod/delete', array('id'=>$item['id']))?>" data-confirm="确定要删除该页面吗？"><i class="fa fa-remove"></i> 删除</a>
                                <?php  } ?>
                            <?php  } ?>

                            <?php  if($pagetype!='mod' && $item['type']!=5 && $item['type']!=7 && $item['type']!=8) { ?>
                                <a class="btn btn-default btn-sm js-clip" title="复制链接" data-href="<?php  echo mobileUrl('diypage', array('id'=>$item['id']), true)?>">
                                    <i class="fa fa-link"></i>
                                </a>

                                <a href="javascript:void(0);" class="btn btn-default btn-sm" data-toggle="popover" data-trigger="hover" data-html="true"
                                      data-content="<img src='<?php  echo $item['qrcode'];?>' width='130' alt='链接二维码'>" data-placement="auto right">
                                    <i class="glyphicon glyphicon-qrcode"></i>
                                </a>
                            <?php  } ?>

                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    <?php  } ?>
</form>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>