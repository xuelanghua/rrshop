<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="./resource/weidongli/css/app_shop.css">
<ul class="nav nav-tabs">
	<li <?php  if($do == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo url('members/morder/post');?>">应用详情</a></li>
</ul>
<?php  if($do =='post') { ?>
<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
<div class="app_detail clearfix">
				<div class="detail-left">
					<div class="detail_icon">
						<img src="<?php  echo $items['imgsrc'];?>" class="img-rounded" title="<?php  echo $items['title'];?>" onerror="this.src='../web/resource/images/nopic-small.jpg'">
						<ul style="padding-left:0px">
							<li >
							<?php  echo $items['price'];?>元/年
							</li>		
						</ul>
					</div>
					<div class="detail_description lt clearfix">
						<div class="detail_line">
							<h3><?php  echo $items['title'];?></h3>
							<span class="app_detail_version"><?php  echo $items['version'];?></span>
						</div>
						<div class="detail_line">
							<!-- <div id="stars_detail" class="stars center" style="background-position:0 -105px;"></div> -->
							<ul id="safe_icon">
								<li class="official_icon"><span></span></li>
								<li></li>												
							</ul>
						</div>
						<ul id="detail_line_ul" style="padding-left:0px">
							<li>分类：行业应用</li>
							<li><span class="spaceleft">已购买：186<?php  echo $items['isbuy'];?>人次</span></li>
							<!--<li class="star8"><span style="width:100.0%"></span></li>-->
							<li><span class="spaceleft">战绩：1280<?php  echo $items['isuse'];?>人在使用</span></li>
	                    </ul>
					</div>
					
				</div>
					
			</div>
				<div class="detail_other clearfix">
					<div class="i_code">
						<a>
						<img src="<?php  if(!empty($_W['setting']['copyright']['ewm'])) { ?><?php  echo tomedia($_W['setting']['copyright']['ewm']);?><?php  } else { ?>./resource/weidongli/images/ewm.jpg<?php  } ?>">
						</a>
						<span>扫描二维码</span>
					</div>
					<div class="detail_down">
						<a href="" target="_blank" title="">了解操作详情</a>
					</div>
				</div>
			<div class="app_detail_list">
				<div class="app_detail_title">购买时间：</div>
                <select class="col-xs-12 col-sm-3 col-md-2"  name="time" id="time" style="width:17%; padding-top: 2px;" >  
					<option value="1">一年 </option>
                    <option value="2">两年 </option>                                        
					<option value="3">三年 </option>
                    <option value="4">四年 </option>
                    <option value="5">五年 </option>
				 </select>
				</div>
			<div class="app_detail_list">
				<div class="app_detail_title">简介：</div>
				<div class="app_detail_infor" style="cursor: default;">
					<p><?php  echo $items['ability'];?></p>
				</div>
				<div class="morecontent" style="display: none;"><span></span></div>
			</div>
			<div class="app_detail_list">
                <div class="app_detail_title">应用详情介绍：</div>
                <div class="app_detail_infor">
                	<p><?php  echo $items['description'];?></p>                </div>
                <div class="morecontent"><span></span></div>
            </div>
			<div class="purchase-main">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
					<input name="submit" id="submit" type="submit" value="确认购买"  class="button purchase">
			</div>
	</form>
<script language="javascript" type="text/javascript"> 
$(document).ready(function(){ 
$('#time').change(function(){
var p1=$(this).children('option:selected').val();
var p2=<?php  echo $items['price'];?>*p1;
$('#price').html(p2);

}) 
}) 
</script> 
<?php  } else if($op='list') { ?>

 <div class="panel panel-info">
			<div class="panel-heading">筛选</div>
			<div class="panel-body">
				<form action="./index.php" method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site">
					<input type="hidden" name="a" value="entry">
					<input type="hidden" name="m" value="buymod">
					<input type="hidden" name="do" value="Module"/>
					<input type="hidden" name="op" value="list"/>
					<div class="form-group clearfix">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
						<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
							<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="输入 门店名称/客户姓名/电话 可快速查找">
						</div>
						<div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
							<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						</div>
					</div>
				</form>
			</div>
		</div>

<div class="clearfix">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
				<tr>
					<th class="row-first">模块名称</th>

					<th>价格</th>

                    <th>状态</th>
					<th>功能简介</th>
					<th>操作</th>
				</tr>

				</thead>

				<tbody>

				<?php  if(is_array($modules)) { foreach($modules as $module) { ?>

                <?php  if(!$module['issystem']) { ?>

				<tr>

					<td class="row-first"><?php  echo $module['title'];?><input class="modules" type="hidden" value="<?php  echo $module['name'];?>" name="modules[]" /></td>
                    
                    <?php  $items = pdo_fetch("SELECT * FROM " . tablename('buymod_modules')."where module=:module", array(':module' => $module['name']));?>

					<td><span style="color:#F00;"><?php  echo $items['price'];?></span>元/年</td>

                    <td ><span style="color:#F00;">未购买</span></td>


					<td><?php  echo $module['ability'];?></td>

					<td><?php  if($_W['isfounder']) { ?><span><a class="btn btn-default btn-sm" href="<?php  echo url('members/module/post', array('mid' => $module['mid']))?>"><i class="fa fa-edit">编辑</i></a></span><?php  } ?><span><a class="btn btn-default btn-sm" href="<?php  echo url('members/Module', array('id' => $item['id']))?>"><i class="fa fa-plus">购买</i></a></span><span><a class="btn btn-default btn-sm" href="<?php  echo url('members/Module', array('id' => $item['id']))?>"><i class="fa fa-eye">查看详情</i></a></span></td>

				</tr>

                <?php  } ?>

				<?php  } } ?>

				</tbody>

			</table>

		</div>

	</div>

</div>

</form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>