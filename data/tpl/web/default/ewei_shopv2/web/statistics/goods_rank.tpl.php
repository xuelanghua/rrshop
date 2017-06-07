<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"> <h2>商品销售排行</h2> <span>查询商品销售量和销售额，默认排序为销售额从高到低 总数: <span style='color:red'><?php  echo $total;?></span></div>


        <form action="./index.php" method="get" class="form-horizontal">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="ewei_shopv2" />
            <input type="hidden" name="do" value="web" />
            <input type="hidden" name="r"  value="statistics.goods_rank" />
	<div class="page-toolbar row m-b-sm m-t-sm">
		<div class="col-sm-5">

			<div class="btn-group btn-group-sm" style='float:left'>
				<button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

			</div> 
 
<?php  echo tpl_daterange('datetime', array('sm'=>true,'placeholder'=>'下单时间'),true);?>

			 			
		</div>	


		<div class="col-sm-6 pull-right">

			<select name='orderby'  class='form-control  input-sm select-md'   style="width:110px;">

				<option value='' <?php  if($_GPC['orderby']=='') { ?>selected<?php  } ?>>排序</option>
				<option value='0' <?php  if($_GPC['orderby']=='0') { ?>selected<?php  } ?>>按销售额</option>
				<option value='1' <?php  if($_GPC['orderby']=='1') { ?>selected<?php  } ?>>按销售量</option>
			</select>
			<div class="input-group">				 
				<input type="text" class="form-control input-sm"  name="title" value="<?php  echo $_GPC['title'];?>" placeholder="商品名称"/> 
				<span class="input-group-btn">
							
					<button class="btn btn-sm btn-primary btn-sm" type="submit"> 搜索</button>
   <?php if(cv('statistics.goods_rank.export')) { ?>
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
                    <th style='width:80px;'>排行</th>
                    <th>商品名称</th>
                    <th>销售量</th>
                    <th>销售额</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $key => $row) { ?>
                <tr>
                    <td><?php  if(($pindex -1)* $psize + $key + 1<=3) { ?>
                             <labe class='label label-danger' style='padding:8px;'>&nbsp;<?php  echo ($pindex -1)* $psize + $key + 1?>&nbsp;</labe>
                            <?php  } else { ?>
                             <labe class='label label-default'  style='padding:8px;'>&nbsp;<?php  echo ($pindex -1)* $psize + $key + 1?>&nbsp;</labe>
                           <?php  } ?>
                        </td>
                    <td>
                        <img src="<?php  echo tomedia($row['thumb'])?>" style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
                        <?php  echo $row['title'];?></td>
                    <td><?php  echo $row['count'];?></td>
                    <td><?php  echo $row['money'];?></td>
                </tr>
                <?php  } } ?>
        </table>
        <?php  echo $pager;?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>