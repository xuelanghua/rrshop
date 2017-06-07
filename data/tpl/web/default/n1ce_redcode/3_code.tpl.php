<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix">
    <form class="form-horizontal form" action="" method="post" >
        <div class="panel panel-default">
            <div class="panel-heading">卡密生成</div>
            <div class="panel-body">
                <div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">卡密类型</label>
					<div class="col-sm-8 col-xs-12">
                    <select name="codetype" class="form-control">
							<option value="1" checked="checked">纯数字组合</option>
							<option value="2">数字字母混合组合</option>
					</select>
					</div>
                </div>   
            </div>
			<div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">生成数量</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" name="num" placeholder="卡密数量：注：一批最多生产2000个">
                    </div>
                </div>   
            </div>
        </div>
        <div class="form-group margin-bottom">
            <div class="col-sm-12">
                <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
            </div>
        </div> 
    </form>
</div>

<a href="<?php  echo $this->createWebUrl('miss')?>" onclick="return confirm('确认删除吗，删除后，不可恢复？');return false;" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i> 删除失效卡密</a>
<a href="<?php  echo $this->createWebUrl('UDownload2')?>"  class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="导出"><i class="fa fa-times"></i> 导出全部卡密</a>
<div class="main">
	<div class="category">
	<div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="150">批次</th>
                            <th width="150">总数量</th>
                            <th width="150">查看卡密</th>
							
                            <th width="400">二维码管理</th>
							<th width="250">二维码导出</th>
							<th width="150">奖品设置</th>
							<th width="150">卡密导入</th>
                            <th width="150">删除</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <tr>
                            <td><?php  echo $row['pici'];?></td>
                            <td><?php  echo $row['codenum'];?></td>
                            <td>
                                <a href="<?php  echo $this->createWebUrl('codeshow', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 查看卡密</a>
								<a href="<?php  echo $this->createWebUrl('UDownload', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 卡密导出</a>
								
                            </td>
                            <td>
								<a href="<?php  echo $this->createWebUrl('Qrcode', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 生成临时码</a>
								<a href="<?php  echo $this->createWebUrl('Qrcode2', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 生成永久二维码</a>
								<a href="<?php  echo $this->createWebUrl('Qrshow', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 查看二维码</a>
								<a href="<?php  echo $this->createWebUrl('Qrlong', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 查看永久二维码</a>
								
							</td>
							<td>
                                <a href="<?php  echo $this->createWebUrl('Urldownload', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 导出临时二维码</a>
								<a href="<?php  echo $this->createWebUrl('Urldownload2', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 导出永久二维码</a>
                            </td>
							<td>
                                <a href="<?php  echo $this->createWebUrl('prize', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 奖品设置</a>
                            </td>
							<td>
								<a href="<?php  echo $this->createWebUrl('import', array('pici' => $row['pici']))?>" class="btn btn-info btn-sm"> 卡密导入</a>
							</td>
                            <td>
                                <a href="<?php  echo $this->createWebUrl('codedie', array('pici' => $row['pici']))?>" onclick="return confirm('确认删除吗，删除后，不可恢复？');return false;" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i> 删除</a>
                            </td>
                        </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
	</div>

</div>
<?php  echo $pager;?>
		
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>