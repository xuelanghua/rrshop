<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
	<span class="pull-right">
	     <?php if(cv('article.add')) { ?>
                 <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('article/add')?>"><i class="fa fa-plus"></i> 添加文章</a>
	     <?php  } ?>
	</span>
	<h2>文章管理 <small><?php  if($articlenum) { ?>总数: <span class="text-danger"><?php  echo $articlenum;?></span><?php  } ?>  排序数字越大越靠前</small></h2>
</div>

<form action="./index.php" method="get" class="form-horizontal" role="form">
	<input type="hidden" name="c" value="site">
	<input type="hidden" name="a" value="entry">
	<input type="hidden" name="m" value="ewei_shopv2">
	<input type="hidden" name="do" value="web">
	<input type="hidden" name="r" value="article">
	<div class="page-toolbar row m-b-sm m-t-sm">
		<div class="col-sm-4">

			<div class="input-group-btn">
				<button class="btn btn-default btn-sm" type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button> 
				<?php if(cv('article.edit')) { ?>
					<button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('article/state',array('state'=>1))?>"><i class='fa fa-circle'></i> 开启</button>
					<button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('article/state',array('state'=>0))?>"><i class='fa fa-circle-o'></i> 关闭</button> 
				<?php  } ?> 
				<?php if(cv('article.delete')) { ?>
					<button class="btn btn-default btn-sm" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('article/delete')?>"><i class='fa fa-trash'></i> 删除</button> 
				<?php  } ?>

			</div>
		</div>

		<div class="col-sm-6 pull-right">

			<select name="category" class='form-control input-sm select-sm select2' style="width:150px;">
				 <option value="" <?php  if($_GPC['category'] == '') { ?> selected<?php  } ?>>分类</option>
					    <?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					    	<option value="<?php  echo $category['id'];?>" <?php  if($_GPC['category']==$category['id']) { ?>selected="selected"<?php  } ?>><?php  echo $category['category_name'];?></option>
					    <?php  } } ?>
				</select>
			<div class="input-group">
				<input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
			</div>

		</div>
	</div>
</form>

<!-- 文章列表 -->
<?php  if(count($articles)>0) { ?>
	<table class="table table-hover table-responsive">
		<thead>
			<tr>
				<th style="width:25px;"><input type='checkbox' /></th>
				<th style="width:44px;">排序</th>
				<th style="width:150px;">文章标题</th>
	
				<th style="width:60px;">关键字</th>
				<th style="width:100px;">创建时间</th>
				<th style="width:60px;">阅读量</th>
				<th style="width:60px;">点赞量</th>
	
				<th style="width:60px;">状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
	
			<?php  if(is_array($articles)) { foreach($articles as $article) { ?>
			<tr>
				<td>
					<input type='checkbox' value="<?php  echo $article['id'];?>" />
				</td>
				<td>
					<?php if(cv('article.edit')) { ?>
						<a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('article/displayorder',array('id'=>$article['id']))?>"><?php  echo $article['displayorder'];?></a> 
					<?php  } else { ?> 
						<?php  echo $article['displayorder'];?> 
					<?php  } ?>
				</td>
				<td>
					<?php  if(!empty($article['category_name'])) { ?>
						<label class="label label-primary"><?php  echo $article['category_name'];?></label><br/>
					<?php  } ?>
					<a href="<?php  echo mobileUrl('article',array('aid'=>$article['id'], 'preview'=>1), true)?>" target="_blank" data-toggle="tooltip" title="点击预览"><?php  echo $article['article_title'];?></a>
				</td>
				<td><?php  echo $article['article_keyword2'];?></td>
				<td><?php  echo date('Y-m-d', strtotime($article['article_date']))?><br/><?php  echo date('H:i', strtotime($article['article_date']))?></td>
				<td data-toggle='tooltip' title='<?php  echo $article['article_readnum'];?>'><?php  echo $article['article_readnum'];?></td>
				<td data-toggle='tooltip' title='<?php  echo $article['article_likenum'];?>'><?php  echo $article['article_likenum'];?></td>
	
				<td>
					<span class='label 
						<?php  if($article['article_state']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>' 
						<?php if(cv('article.page.edit')) { ?> 
							data-toggle="ajaxSwitch" 
							data-confirm = "确认<?php  if($article['article_state']==1) { ?>关闭<?php  } else { ?>开启<?php  } ?>吗？"
							data-switch-value="{$article[" article_state "]}" 
							data-switch-value0="0|关闭|label label-default|<?php  echo webUrl('article/state',array('state'=>1,'id'=>$article['id']))?>" 
							data-switch-value1="1|开启|label label-success|<?php  echo webUrl('article/state',array('state'=>0,'id'=>$article['id']))?>" 
						<?php  } ?>>
						
						<?php  if($article['article_state']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?>
					</span>
	
				</td>
				<td>
	
					<?php if(cv('article.record')) { ?>
						<a class="btn btn-default btn-sm" href="<?php  echo webUrl('article/record', array('aid'=>$article['id']))?>"><i class="fa fa-database"></i> 统计</a> 
					<?php  } ?>
					<a href="javascript:;" data-url="<?php  echo mobileUrl('article',array('aid'=>$article['id']), true)?>" class="js-clip btn btn-default btn-sm">
						<i class='fa fa-link'></i> 复制链接
					</a>
					<a href="javascript:void(0);" class="btn btn-default btn-sm" data-toggle="popover" data-trigger="hover" data-html="true"
						  data-content="<img src='<?php  echo $article['qrcode'];?>' width='130' alt='链接二维码'>" data-placement="auto right">
						<i class="glyphicon glyphicon-qrcode"></i>
					</a>
					<?php if(cv('article.edit')) { ?>
						<a class='btn btn-default btn-sm' href="<?php  echo webUrl('article/edit',array('aid'=>$article['id']))?>"><i class="fa fa-edit"></i></a> 
					<?php  } ?> 
					<?php if(cv('article.delete')) { ?>
						<a data-toggle="ajaxRemove" class='btn btn-default btn-sm' href="<?php  echo webUrl('article/delete',array('id'=>$article['id']))?>" data-confirm="确认要删除此文章?"><i class="fa fa-trash"></i></a> 
					<?php  } ?>
				</td>
			</tr>
			<?php  } } ?>
		</tbody>
	</table>
	<?php  echo $pager;?> 
<?php  } else { ?>
	<div class='panel panel-default'>
		<div class='panel-body' style='text-align: center;padding:30px;'>
			暂时没有任何文章!
		</div>
	</div>
<?php  } ?>
</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>