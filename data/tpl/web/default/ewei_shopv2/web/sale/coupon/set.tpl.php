<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
 <div class='page-heading'><h2>优惠券设置</h2></div>
 
<form id="setform"  action="" method="post" class="form-horizontal form-validate">
  
     <input type="hidden" name="tab" id='tab' value="<?php  echo $_GPC['tab'];?>" />
   
      
	 <ul class="nav nav-arrow-next nav-tabs" id="myTab">
                    <li <?php  if($_GPC['tab']=='basic' || empty($_GPC['tab'])) { ?>class="active"<?php  } ?> ><a href="#tab_basic">基本</a></li>
                    <li <?php  if($_GPC['tab']=='adv') { ?>class="active"<?php  } ?> ><a href="#tab_adv">幻灯片</a></li>
                    <li <?php  if($_GPC['tab']=='notice') { ?>class="active"<?php  } ?> ><a href="#tab_notice">通知</a></li>
	 
                 
                </ul> 
     
                <div class="tab-content">
                    <div class="tab-pane  <?php  if($_GPC['tab']=='basic' || empty($_GPC['tab'])) { ?>active<?php  } ?>" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/coupon/set/basic', TEMPLATE_INCLUDEPATH)) : (include template('sale/coupon/set/basic', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane  <?php  if($_GPC['tab']=='adv') { ?>active<?php  } ?>" id="tab_adv"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/coupon/set/adv', TEMPLATE_INCLUDEPATH)) : (include template('sale/coupon/set/adv', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane  <?php  if($_GPC['tab']=='notice') { ?>active<?php  } ?>" id="tab_notice"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sale/coupon/set/notice', TEMPLATE_INCLUDEPATH)) : (include template('sale/coupon/set/notice', TEMPLATE_INCLUDEPATH));?></div>
            </div>
     
     <div class="form-group"></div>
         <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <input type="submit"  value="提交" class="btn btn-primary" />
                
            </div> 
        </div>
  
 
</form>
<script language='javascript'>
         require(['bootstrap'],function(){
             $('#myTab a').click(function (e) {
                 e.preventDefault();
                $('#tab').val( $(this).attr('href'));
                 $(this).tab('show');
             })
     });
     
     
	$(function () {
bindEvents();
	})
	function removeAdv(obj){
		$(obj).closest('.adv-item').remove();
	}
	function addAdv(){
		var html='<tr class="adv-item">';
html+='<td><a href="javascript:;" class="btn btn-default btn-sm btn-move"><i class="fa fa-arrows"></i></a></td>';
html+='<td>';
html+='<div class="input-group img-item">';
html+='<div class="input-group-addon">';
html+='<img src="" style="height:20px;width:50px" />';
html+='</div>';
html+='<input type="text" class="form-control" name="adv_img[]" />';
html+='<div class="input-group-btn">';
html+='<button type="button" class="btn btn-default btn-select-pic">选择图片</button>';
html+='</div>';
html+='</div>';
html+='</td>';
html+='<td><input type="text" class="form-control" name="adv_url[]" /></td>';
html+='<td><button type="button" class="btn btn-danger  btn-sm" onclick="removeAdv(this)"><i class="fa fa-remove"></i></button>';

html+='</td>';
html+='</tr>';
$('#tbody').append(html);
bindEvents();
	}
	function bindEvents() {
		require(['jquery', 'util'], function ($, util) {
			$('.btn-select-pic').unbind('click').click(function () {
				var imgitem = $(this).closest('.img-item');
				util.image('', function (data) {
					imgitem.find('img').attr('src', data['url']);
					imgitem.find('input').val(data['attachment']);
				});
			});
		});
                require(['jquery.ui'] ,function(){
		$("#tbody").sortable({handle: '.btn-move'});
                })
		
	}
        
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>