<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($operation== 'edit') { ?>class="active"<?php  } ?>><a
		href="<?php  echo $this->createWebUrl('brand',array('op'=>'edit'));?>">添加</a></li>
	<li <?php  if($operation== 'display') { ?>class="active"<?php  } ?>><a
		href="<?php  echo $this->createWebUrl('brand', array( 'op' => 'display'));?>">管理</a></li>

</ul>
<?php  if($operation == 'edit') { ?>
<div class="main">
	<form action="" method="post" class="form-horizontal form"
		enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />


		<div class="panel panel-default">
			<div class="panel-heading">
				品牌设置
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">品牌名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="bname" class="form-control"
							   value="<?php  echo $item['bname'];?>" />
					</div>
				</div>



				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否收集用户留言</label>
					<div class="col-sm-9 col-xs-12">
						<input type="radio" name="showMsg" value="1" <?php  if($item['showMsg'] == 1) { ?>checked="checked"<?php  } ?>> 是&nbsp;&nbsp;&nbsp; <input type="radio" name="showMsg" value="0" <?php  if($item['showMsg'] == 0) { ?>checked="checked"<?php  } ?>>否
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义按钮一名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="btnName" class="form-control"
							   value="<?php  echo $item['btnName'];?>" />
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义按钮一链接URL</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="btnUrl" class="form-control"
							   value="<?php  echo $item['btnUrl'];?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义按钮二名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="btnName2" class="form-control"
							   value="<?php  echo $item['btnName2'];?>" />
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义按钮二链接URL</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="btnUrl2" class="form-control"
							   value="<?php  echo $item['btnUrl2'];?>" />
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义按钮三名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="btnName3" class="form-control"
							   value="<?php  echo $item['btnName3'];?>" />
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义按钮三 链接URL</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="btnUrl3" class="form-control"
							   value="<?php  echo $item['btnUrl3'];?>" />
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">宣传背景</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('pic', $item['pic']);?>
						建议(宽*高=640*960)
					</div>
				</div>



				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片标题</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="pptname" class="form-control"
							   value="<?php  echo $item['pptname'];?>" />
					</div>
				</div>



				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">第一张幻灯片</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('ppt1', $item['ppt1']);?>
						建议(宽*高=640*350)
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">第一张幻灯片</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('ppt2', $item['ppt2']);?>
						建议(宽*高=640*350)
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">第二张幻灯片</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('ppt3', $item['ppt3']);?>
						建议(宽*高=640*350)
					</div>
				</div>

				<!--<div class="form-group">-->
					<!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">联系电话</label>-->
					<!--<div class="col-sm-9 col-xs-12">-->
						<!--<input type="text" name="tel" class="form-control"-->
							   <!--value="<?php  echo $item['tel'];?>" />-->
					<!--</div>-->
				<!--</div>-->


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">品牌介绍</label>
					<div class="col-sm-9 col-xs-12">
					<textarea style="height: 400px; width: 100%;"
							  class="span7 richtext-clone" name="intro" id="intro" cols="70"><?php  echo $item['intro'];?></textarea>
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">品牌介绍</label>
					<div class="col-sm-9 col-xs-12">
					<textarea style="height: 400px; width: 100%;"
							  class="span7 richtext-clone" name="intro2" id="intro2" cols="70"><?php  echo $item['intro2'];?></textarea>
					</div>
				</div>


				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<input name="submit" type="submit" value="提交"
							   class="btn btn-primary span3"> <input type="hidden"
																	 name="token" value="<?php  echo $_W['token'];?>" />
					</div>
				</div>

			</div>
			</div>
	</form>
</div>
<script type="text/javascript">

	require(['jquery', 'util'], function($, u){
		$(function(){
			u.editor($('#intro')[0]);

		});

		$(function(){

			u.editor($('#intro2')[0]);
		});
	});

</script>




<?php  } else if($operation == 'display') { ?>
<div class="main">



	<div class="panel panel-default">
		<div class="table-responsive panel-body">



		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width: 100px;">品牌名称</th>
					<th style="width: 120px;">链接地址</th>
				
					<th style="width: 80px;">浏览次数</th>

					<th style="text-align: center; min-width: 400px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['bname'];?></a></td>
					<td><input type="text"  class="form-control"  value="<?php  echo $this->str_murl($this->createMobileUrl('brand',array("bid"=>$item['id']),true))?>"></td>
					
					<td><?php  echo $item['visitsCount'];?></td>

					<td style="text-align: center;">
					
					<a
						href="<?php  echo $this->createWebUrl('userMsg', array( 'bid' => $item['id']))?>"
						title="说明项" class="btn btn-small">留言<i class="glyphicon glyphicon-heart"></i></a>
				
					<a
						href="<?php  echo $this->createWebUrl('note', array( 'bid' => $item['id']))?>"
						title="说明项" class="btn btn-small"><i class="glyphicon glyphicon-book"></i>说明</a>
						<a
						href="<?php  echo $this->createWebUrl('image', array('bid' => $item['id']))?>"
						title="图片" class="btn btn-small"><i class="glyphicon glyphicon-picture"></i>图片</a>
						<a
						href="<?php  echo $this->createWebUrl('product', array( 'bid' => $item['id']))?>"
						title="产品" class="btn btn-small"><i class="glyphicon glyphicon-folder-close"></i>产品</a>
						
						<a
						href="<?php  echo $this->createWebUrl('brand', array( 'id' => $item['id'], 'op' => 'edit'))?>"
						title="编辑" class="btn btn-small"><i class="glyphicon glyphicon-edit"></i>编辑</a> <a
						href="<?php  echo $this->createWebUrl('brand', array( 'id' => $item['id'], 'op' => 'delete'))?>"
						onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"
						class="btn btn-small"><i class="glyphicon glyphicon-remove"></i>删除</a></td>
				</tr>
				<?php  } } ?>
			</tbody>

		</table>
		<?php  echo $pager;?>
</div>
<?php  } ?> <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
