<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

    <div class="page-content">
        <div class="page-heading">
            <?php if(cv('bargain.warehouse')) { ?>
    <span class='pull-right'>
                <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('bargain/warehouse');?>"><i class='fa fa-plus'></i> 添加商品</a>
            </span><?php  } ?>
            <h1>
                <span class='label label-success' style="background-color: #18a689">
                      砍价中</span>
            </h1> </div>
        <form action="" method="post" class="form-horizontal form-search" role="form">
        <div class="input-group">
            <input type="text" class="input-sm form-control" name="search" value="" placeholder="商品名称" style="width: 300px;float: right;"> <span class="input-group-btn">
            <button class="btn btn-sm btn-primary" type="submit" style="float: left"> 搜索</button> </span>
        </div>
        </form>
        <br>
        <form action="./index.php" method="get" class="form-horizontal form-search" role="form">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="ewei_shopv2" />
            <input type="hidden" name="do" value="web" />
            <input type="hidden" name="r"  value="goods" />
            <input type="hidden" name="goodsfrom" value="sale" />

        </form>

        <table class="table table-hover table-responsive">
            <thead class="navbar-inner">
            <tr>
                <th style="width:50px;">序号</th>
                <th style="width:50px;">商品</th>
                <th  style="width:160px;">&nbsp;</th>
                <th style="width:80px;" >标价</th>
                <th style="width:80px;" >底价</th>

                <th style="width:70px;" >库存</th>
                <th style="width:80px;" >已发起</th>
                <th style="width:70px;" >距结束</th>

                <th style="">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($onSell)) { foreach($onSell as $key => $value) { ?>
            <tr>
                <td>
                    <?php  echo $key+$psize*$page-$psize+1;?>
                </td>
                <td>
                    <img src="<?php  echo tomedia($value['thumb']);?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"  />
                </td>
                <td class='full' style="overflow-x: hidden">
                    <br/>
                    <a title="<?php  echo $value['title'];?>"><?php  echo $value['title'];?></a>
                </td>
                <td>
                    <a><?php  echo $value['marketprice'];?></a>
                </td>

                <td>
                    <a><?php  echo $value['end_price'];?></a>
                </td>
                <td>
                    <a><?php  if($value['total']<10) { ?><font style="color: red"><?php  } ?><?php  echo $value['total'];?></font></a>
                </td>
                <td><a><?php  echo $value['act_times'];?></a></td>
                <td><a title="<?php  $day = intval((strtotime($value['end_time'])-time())/3600/24);$hour = intval((strtotime($value['end_time'])-time()-$day*3600*24)/3600);?>距离活动结束剩余:<?php  if($day > 0) { ?><?php  echo $day;?>天<?php  } else { ?><?php  echo $hour;?>小时<?php  } ?>"><?php  if($day > 0) { ?><?php  echo $day;?>天<?php  } else { ?><font style="color: red"><?php  echo $hour;?>小时</font><?php  } ?></a></td>

                <td  style="overflow:visible;position:relative">
                    <?php if(cv('bargain.react')) { ?><a  class='btn btn-default btn-sm' href="<?php  echo webUrl('bargain/react',array('actid'=>$value['id']));?>" title="编辑"><i class='fa fa-edit'></i> 编辑</a><?php  } ?>
                    <?php if(cv('bargain.huishou')) { ?><a  class='btn btn-default btn-sm' data-toggle="ajaxRemove" href="<?php  echo webUrl('bargain/huishou',array('id'=>$value['id']));?>" data-confirm='确认删除此商品？'><i class='fa fa-trash'></i> 删除</a><?php  } ?>
                    <a href="javascript:;" class='btn btn-default btn-sm js-clip' data-url="<?php  echo mobileUrl('bargain/detail',array('id'=>$value['id']),true);?>"><i class='fa fa-link'></i> 链接</a>
                </td>
            </tr>
            <?php  } } ?>

            </tbody>
        </table>
    </div>
    <script language="javascript">myrequire(['web/init'],function(){
        if($('.form-validate').length<=0) {  $('#page-loading').remove(); }
    });</script>
    <div id="page-loading" style="position: fixed;width:100%;height:100%;background:rgba(255,255,255,0.8);left:0;top:0;z-index:9999">
        <div class="sk-spinner sk-spinner-double-bounce" style="position:fixed;top:50%;left:50%;width:40px;height:40px;margin-left:-20px;margin-top:-20px;">
            <div class="sk-double-bounce1"></div>
            <div class="sk-double-bounce2"></div>
        </div>
    </div>

<?php  echo $pager;?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>