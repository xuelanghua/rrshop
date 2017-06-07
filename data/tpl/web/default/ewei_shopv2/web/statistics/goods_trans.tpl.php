<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>商品销售转化率</h2> <span>查询商品浏览量及购买转化率，默认排序为转化率从高到低 总数: <span style='color:red'><?php  echo $total;?></span></div>



        <form action="./index.php" method="get" class="form-horizontal">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="ewei_shopv2" />
            <input type="hidden" name="do" value="web" />
            <input type="hidden" name="r"  value="statistics.goods_trans" />
	<div class="page-toolbar row m-b-sm m-t-sm">
		<div class="col-sm-5">

			<div class="btn-group btn-group-sm" style='float:left'>
				<button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

			</div> 
  
			 			
		</div>	


		<div class="col-sm-6 pull-right">

			<select name='orderby'  class='form-control  input-sm select-md'   style="width:100px;"  >

				<option value='' <?php  if($_GPC['orderby']=='') { ?>selected<?php  } ?>>排序</option>
				<option value='0' <?php  if($_GPC['orderby']=='0') { ?>selected<?php  } ?>>降序</option>
				<option value='1' <?php  if($_GPC['orderby']=='1') { ?>selected<?php  } ?>>升序</option>
			</select>
			<div class="input-group">				 
				<input type="text" class="form-control input-sm"  name="title" value="<?php  echo $_GPC['title'];?>" placeholder="商品名称"/> 
				<span class="input-group-btn">
							
					<button class="btn btn-sm btn-primary btn-sm" type="submit"> 搜索</button>
   <?php if(cv('statistics.goods_trans.export')) { ?>
                    <button type="submit" name="export" value="1" class="btn btn-success  btn-sm">导出 Excel</button>
                    <?php  } ?>
				</span>
			</div>

		</div>
	</div>

</form>
 
     <table class="table table-hover">
            <thead>
                <tr>
                
                    <th>商品名称</th>
                    <th style='width:100px;'>访问次数</th>
                    <th style='width:100px;'>购买件数</th>
                    <th>转化率</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td>
                        <img src="<?php  echo tomedia($row['thumb'])?>" style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
                        <?php  echo $row['title'];?></td>
                    <td><?php  echo $row['viewcount'];?></td>
                    <td><?php  echo intval($row['buycount'])?></td> 
                    <td>   <div class="progress" style='max-width:500px;'>
                            <div style="width: <?php  echo $row['percent'];?>%;" class="progress-bar progress-bar-info"><span style="color:#000"><?php echo empty($row['percent'])?'':$row['percent'].'%'?></span></div>
                       </div></td>
                </tr>
                <?php  } } ?>
        </table>
        <?php  echo $pager;?>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>