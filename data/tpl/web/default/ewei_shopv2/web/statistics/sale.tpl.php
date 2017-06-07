<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> <h2>销售统计</h2><span>按年、月、日统计商城交易额、交易量</span> </div>
     <form action="./index.php" method="get" class="form-horizontal">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="ewei_shopv2" />
            <input type="hidden" name="do" value="web" />
            <input type="hidden" name="r"  value="statistics.sale" />
<div class="page-toolbar row m-b-sm m-t-sm">
                        
	  
			 
                            <div class="col-sm-12">
                                <select name="year" class='form-control input-sm select-sm'>
                        <?php  if(is_array($years)) { foreach($years as $y) { ?>
                        <option value="<?php  echo $y['data'];?>"  <?php  if($y['selected']) { ?>selected="selected"<?php  } ?>><?php  echo $y['data'];?>年</option>
                        <?php  } } ?>
                    </select>
                    <select name="month" class='form-control input-sm select-sm'>
                        <option value=''>月份</option>
                        <?php  if(is_array($months)) { foreach($months as $m) { ?>
                        <option value="<?php  echo $m['data'];?>"  <?php  if($m['selected']) { ?>selected="selected"<?php  } ?>><?php  echo $m['data'];?>月</option>
                        <?php  } } ?>
                    </select>
                       <select name="day" class='form-control input-sm select-sm'>
                        <option value=''>日期</option>
                    </select>
                                
                         <select name="type" class='form-control input-sm select-sm'>
                        <option value='0' <?php  if($_GPC['type']==0) { ?>selected="selected"<?php  } ?>>交易额</option>
                        <option value='1' <?php  if($_GPC['type']==1) { ?>selected="selected"<?php  } ?>>交易量</option>
                    
                    </select>
                                
			  
                                <div class='btn-group btn-group-sm'>
						
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                                     
                                         <?php if(cv('statistics.sale.export')) { ?>
                    <button type="submit" name="export" value='1' class="btn btn-success btn-sm">导出 Excel</button>
                    <?php  } ?>
                    </div>
                                
								
                            </div>
</div>
 </form>
 
 
<div class="panel panel-default">
    <div class='panel-heading'>
     
        <?php  if(empty($type)) { ?>交易额<?php  } else { ?>交易量<?php  } ?>：<span style="color:red; "><?php  echo $totalcount;?></span>，
        最高<?php  if(empty($type)) { ?>交易额<?php  } else { ?>交易量<?php  } ?>：<span style="color:red; "><?php  echo $maxcount;?></span> <?php  if(!empty($maxcount_date)) { ?><span>(<?php  echo $maxcount_date;?></span>)<?php  } ?>
       
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style='width:100px;'>
                        <?php  if(empty($_GPC['month'])) { ?>月份<?php  } else { ?>日期<?php  } ?>
                    </th>
                    <th style='width:200px;'><?php  if(empty($type)) { ?>交易额<?php  } else { ?>交易量<?php  } ?></th>
                    <th>所占比例</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['data'];?></td>
                    <td><?php  echo $row['count'];?></td>
                    <td>
                       <div class="progress" style='max-width:500px;' >
                           <div style="width: <?php  echo $row['percent'];?>%;" class="progress-bar progress-bar-info" ><span style="color:#000"><?php echo empty($row['percent'])?'':$row['percent'].'%'?></span></div>
                       </div>
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>   
    </div>
</div>
<script language='javascript'>
    function get_days(){
          
        var year = $('select[name=year]').val();
        var month =$('select[name=month]').val();
        var day  = $('select[name=day]');
       day.get(0).options.length = 0 ;
        if(month==''){
	   day.append("<option value=''>日期</option");
            return;
        }
       
        day.get(0).options.length = 0 ;
        day.append("<option value=''>...</option").attr('disabled',true);
        $.post("<?php  echo webUrl('util/days')?>",{year:year,month:month},function(days){
             day.get(0).options.length = 0 ;
             day.removeAttr('disabled');
             days =parseInt(days);
             day.append("<option value=''>日期</option");
             for(var i=1;i<=days;i++){
                 day.append("<option value='" + i +"'>" + i + "日</option");
             }
          
             <?php  if(!empty($day)) { ?>
                day.val( <?php  echo $day;?>);
             <?php  } ?>
        })
    }
    $('select[name=month]').change(function(){
           get_days();
    })
    
    get_days();
 </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
