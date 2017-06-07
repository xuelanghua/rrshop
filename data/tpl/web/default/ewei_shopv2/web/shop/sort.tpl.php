<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<style type='text/css' xmlns="http://www.w3.org/1999/html">
    .dd-handle { height: 40px; line-height: 30px}
    .dd-list { width:500px;}
    .dd-handle, 
    .dd-handle:hover {height: inherit; width: 100%; background: #f01; padding: 0; margin: 0; border: 0; background: none; font-weight: 100;}
    .dd-item {background: #fff url(<?php  echo EWEI_SHOPV2_STATIC?>images/index-sort.jpg) no-repeat; position: relative; border: 2px solid rgba(0,0,0,0);}
    .dd-item:hover {border: 2px dashed #f90;}
    .dd-item-search {height: 36px; background-position: 70px 0;}
    .dd-item-adv {height: 100px; background-position: 70px -34px;}
    .dd-item-notice {height: 34px; background-position: 70px -254px;}
    .dd-item-nav {height: 120px; background-position: 70px -134px;}
    .dd-item-cube {height: 140px; background-position: 70px -290px;}
    .dd-item-banner {height: 75px; background-position: 70px -435px;}
    .dd-item-goods {height: 360px; background-position: 70px -520px;}
    .dd-item-seckill {height: 145px; background-position: 70px -874px;}
    .dd-item .pull-left {font-size: 14px;}
</style>


<div class="page-heading"> 
    <h2>首页排版</h2>
</div>
<form action="" method="post" class="form-validate">

    <div class="dd" id="div_nestable">
        <ol class="dd-list">
	    <?php  if(is_array($sorts)) { foreach($sorts as $k => $v) { ?>
            <li class="dd-item full  dd-item-<?php  echo $k;?>" data-id="<?php  echo $k;?>">
            	<div class="pull-left"><?php  echo $v['text'];?></div>
                <div class="dd-handle" >
                	<span class="pull-right">是否显示
                		<input class="js-switch small" id="visible_<?php  echo $k;?>" name="visible[<?php  echo $k;?>]" type="checkbox" <?php  if($v['visible']) { ?>checked<?php  } ?> value="1" />
                	</span>
                </div>
            </li>
	    <?php  } } ?>

        </ol>
        <table class='table'>
            <tr>
                <td>
                    <input id="save_sort" type="submit" class="btn btn-primary " value="保存" style="margin-left:60px;">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    <input type="hidden" name="datas" value="" />
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</form>

<script language='javascript'>
	require(['../addons/ewei_shopv2/static/js/dist/jquery/nestable/jquery.nestable.js'], function () {
		$('#div_nestable').nestable({maxDepth: 1});
		$('.dd-item').addClass('full');
		$(".dd-handle a,.dd-handle span").mousedown(function (e) {
			e.stopPropagation();
		});
		$("#save_sort").click(function () {
            var data = [];
            $(":checkbox").each(function (index,item) {
                var temp = $(this).parents("li").data('id');
                data.push({id:temp});
            });
			var json = window.JSON.stringify(data);
			$(':input[name=datas]').val(json);
		});
	});
        </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>