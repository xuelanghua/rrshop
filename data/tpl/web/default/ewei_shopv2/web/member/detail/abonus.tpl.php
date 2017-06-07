<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-sm-2 control-label">代理商等级</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('abonus.agent.edit')) { ?>
        <select name='aadata[aagentlevel]' class='form-control'>
            <option value='0'><?php echo empty($plugin_abonus_set['levelname'])?'默认等级':$plugin_abonus_set['levelname']?> </option>
            <?php  if(is_array($aagentlevels)) { foreach($aagentlevels as $level) { ?>
            <option value='<?php  echo $level['id'];?>' <?php  if($member['aagentlevel']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
            <?php  } } ?>
        </select>
        <?php  } else { ?>
        <input type="hidden" name="aadata[aagentlevel]" class="form-control" value="<?php  echo $member['aagentlevel'];?>"  />

        <?php  if(empty($member['aagentlevel'])) { ?>
        <?php echo empty($plugin_abonus_set['levelname'])?'默认等级':$plugin_abonus_set['levelname']?>
        <?php  } else { ?>
        <?php  echo pdo_fetchcolumn('select levelname from '.tablename('ewei_shop_abonus_level').' where id=:id limit 1',array(':id'=>$member['aagentlevel']))?>
        <?php  } ?>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">代理商级别</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('abonus.agent.edit')) { ?>
        <select name='aadata[aagenttype]' class='form-control' id="aagenttype">
            <option value='0'>无代理权</option>
            <option value='1' <?php  if($member['aagenttype']==1) { ?>selected<?php  } ?>>省级代理</option>
            <option value='2' <?php  if($member['aagenttype']==2) { ?>selected<?php  } ?>>市级代理</option>
            <option value='3' <?php  if($member['aagenttype']==3) { ?>selected<?php  } ?>>区级代理</option>

        </select>
        <?php  } else { ?>
             <?php  if($member['aagenttype']==1) { ?>
             省级代理
        <?php  } else if($member['aagenttype']==2) { ?>
        市级代理
        <?php  } else if($member['aagenttype']==3) { ?>
        区级代理
        <?php  } else { ?>
        无代理权
        <?php  } ?>
        <?php  } ?>
    </div>
</div>

<script type="text/javascript" src="../addons/ewei_shopv2/static/js/dist/area/cascade.js"></script>
<div class="form-group" >
    <label class="col-sm-2 control-label">代理省份</label>
    <div class="col-sm-9 col-xs-12" id="aagent-provinces">
    <?php  if(is_array($member['aagentprovinces'])) { foreach($member['aagentprovinces'] as $row) { ?>
        <div class='aagent-item aagent-province-item btn btn-default' data-province='<?php  echo $row;?>' style='margin-bottom:5px;margin-right:5px' onclick='removeAagentItem(this)'>
            <?php  echo $row;?> <i class='fa fa-remove'></i><input type='hidden' name='aagentprovinces[]' value='<?php  echo $row;?>' />
        </div>
    <?php  } } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">代理城市</label>
    <div class="col-sm-9 col-xs-12" id="aagent-citys">
        <?php  if(is_array($member['aagentcitys'])) { foreach($member['aagentcitys'] as $row) { ?>
        <div class='aagent-item aagent-city-item btn btn-default' data-city='<?php  echo $p;?>' style='margin-bottom:5px;margin-right:5px' onclick='removeAagentItem(this)'>
            <?php  echo $row;?> <i class='fa fa-remove'></i><input type='hidden' name='aagentcitys[]' value='<?php  echo $row;?>' />
        </div>
        <?php  } } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">代理地区</label>
    <div class="col-sm-9 col-xs-12" id="aagent-areas">
        <?php  if(is_array($member['aagentareas'])) { foreach($member['aagentareas'] as $row) { ?>
        <div class='aagent-item aagent-area-item btn btn-default' data-area='<?php  echo $p;?>' style='margin-bottom:5px;margin-right:5px' onclick='removeAagentItem(this)'>
            <?php  echo $row;?> <i class='fa fa-remove'></i><input type='hidden' name='aagentareas[]' value='<?php  echo $row;?>' />
        </div>
        <?php  } } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <button class="btn btn-default" type="button" onclick="selectAagentArea()"><i class="fa fa-plus"></i> 添加代理区域</button>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">累计分红</label>
    <div class="col-sm-9 col-xs-12">
        <div class='form-control-static'>

            <span class="label label-default">总额：<?php  echo $member['abonus_ok']?> 元</span>
            <span class="label label-primary">省级：<?php  echo $member['abonus_ok1'];?> 元</span>
            <span class="label label-success">市级：<?php  echo $member['abonus_ok2'];?> 元</span>
            <span class="label label-warning">区级：<?php  echo $member['abonus_ok3'];?> 元</span>

        </div>
    </div>
</div>


 
<?php  if(!empty($member['aagenttime'])) { ?>
<div class="form-group">
    <label class="col-sm-2 control-label">成为代理商时间</label>
    <div class="col-sm-9 col-xs-12">
        <div class='form-control-static'><?php  echo date('Y-m-d H:i:s',$member['aagenttime'])?></div>
    </div>
</div>
<?php  } ?>
<div class="form-group">
    <label class="col-sm-2 control-label">代理商权限</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('abonus.agent.check')) { ?>
        <label class="radio-inline"><input type="radio" name="aadata[isaagent]" value="1" <?php  if($member['isaagent']==1) { ?>checked<?php  } ?>>是</label>
        <label class="radio-inline" ><input type="radio" name="aadata[isaagent]" value="0" <?php  if($member['isaagent']==0) { ?>checked<?php  } ?>>否</label>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($member['isaagent']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
        <?php  } ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">审核通过</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('abonus.agent.check')) { ?>
        <label class="radio-inline"><input type="radio" name="aadata[aagentstatus]" value="1" <?php  if($member['aagentstatus']==1) { ?>checked<?php  } ?>>是</label>
        <label class="radio-inline" ><input type="radio" name="aadata[aagentstatus]" value="0" <?php  if($member['aagentstatus']==0) { ?>checked<?php  } ?>>否</label>
        <input type='hidden' name='oldaagentstatus' value="<?php  echo $member['aagentstatus'];?>" />
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($member['aagentstatus']==1) { ?>是<?php  } else { ?>否<?php  } ?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">强制不自动升级</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('abonus.agent.edit')) { ?>
        <label class="radio-inline" ><input type="radio" name="aadata[aagentnotupgrade]" value="0" <?php  if($member['aagentnotupgrade']==0) { ?>checked<?php  } ?>>允许自动升级</label>
        <label class="radio-inline"><input type="radio" name="aadata[aagentnotupgrade]" value="1" <?php  if($member['aagentnotupgrade']==1) { ?>checked<?php  } ?>>强制不自动升级</label>
        <span class="help-block">如果强制不自动升级，满足任何条件，此代理商的级别也不会改变</span>
        <?php  } else { ?>
        <input type="hidden" name="aadata[aagentnotupgrade]" class="form-control" value="<?php  echo $member['aagentnotupgrade'];?>"  />
        <div class='form-control-static'><?php  if($member['aagentnotupgrade']==1) { ?>强制不自动升级<?php  } else { ?>允许自动升级<?php  } ?></div>
        <?php  } ?>
    </div>
</div>


<?php  if($diyform_flag_abonus == 1) { ?>

    <div class='form-group-title'>自定义表单信息</div>

    <?php  $datas = iunserializer($member['diyaagentdata'])?>
    <?php  if(is_array($aafields)) { foreach($aafields as $key => $value) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label"><?php  echo $value['tp_name']?></label>
        <div class="col-sm-9 col-xs-12">
            <div class="form-control-static">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/diyform', TEMPLATE_INCLUDEPATH)) : (include template('diyform/diyform', TEMPLATE_INCLUDEPATH));?>
            </div>
        </div>
    </div>
    <?php  } } ?>
<?php  } ?>
<div id="modal-areas"  class="modal fade" tabindex="-1">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择区域</h3></div>
            <div class="modal-body">



                <div class="form-group">

                    <label class="col-sm-3 control-label">省份</label>
                    <div class="col-sm-9 col-xs-12">
                        <select id="sel-provance" name='province' onchange="selectCity();" class="form-control" style='width:204px;display: inline-block' >
                            <option value="" selected="true">省/直辖市</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-sm-3 control-label">城市</label>
                    <div class="col-sm-9 col-xs-12">
                        <select id="sel-city" name='city'  onchange="selectcounty(0)" class="form-control" style='width:204px;display: inline-block' >
                            <option value="" selected="true">请选择</option>
                        </select>
                    </div>
                </div>
                <div class="form-group"  >
                    <label class="col-sm-3 control-label">地区</label>
                    <div class="col-sm-9 col-xs-12">
                        <select id="sel-area" name='area'  class="form-control" style='width:205px;display: inline-block;' >
                            <option value="" selected="true">请选择</option>
                        </select>
                    </div>
                </div>
                <script language='javascript'>
                        cascdeInit("<?php  echo $new_area?>","0","","","");
                </script>


                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        代理到
                    </label>
                    <div class="col-sm-9 col-xs-12">

                        <label class="radio-inline"><input type="radio"  name="aagent-selectareas" value="province" id="check-province" > 省份</label>
                        <label class="radio-inline" ><input type="radio" name="aagent-selectareas" value="city"  id="check-city">城市</label>
                        <label class="radio-inline" ><input type="radio" name="aagent-selectareas" value="area" id="check-area">地区</label>

                    </div>
                </div>


                <div class="form-group"  >
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <span class="help-block text-danger">省级代理可代理任何地区, 市级代理只能代理城市和地区，区级代理只能代理区</span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" id='btnSubmitArea' class="btn btn-success">确定</a>
                <a href="javascript:;" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
            </div>
        </div>
    </div>
</div>
<script >



    $(function(){
        $('#aagent-item').click(function(){
            $(this).remove();
        });
    })
    function addAagentItem(province,city,area,type) {

        var areas = province;
        if(type=='province'){
            if($(".aagent-item[data-province='" + areas+ "']").length>0){
                   tip.msgbox.err( areas + "已添加!");
                    return false;
            }
        }
        if(type=='city'){
            areas=province+city;

            if($(".aagent-item[data-city='" + areas+ "']").length>0){
                tip.msgbox.err( areas + "已添加!");
                return false;
            }


        }else if (type=='area'){
            areas=province + city + area;
            if($(".aagent-item[data-area='" + areas+ "']").length>0){
                tip.msgbox.err( areas + "已添加!");
                return false;
            }

        }

        var html="<div class='aagent-item aagent-" + type +"-item btn btn-default' data-" +type +"='" + areas+"' style='margin-bottom:5px;margin-right:5px' onclick='removeAagentItem(this)'>";
        html+=areas + " <i class='fa fa-remove'></i><input type='hidden' name='aagent" + type +"s[]' value='" + areas+"' /></div>";
        $('#aagent-' + type + 's').append(html);
        return true;
    }
    function removeAagentItem(obj){
         $(obj).remove();
    }

    function selectAagentArea(){

        if( $('#aagenttype').val()=='0'){
            tip.msgbox.err('请先选择代理商级别');return;
        }
        var val = $('#aagenttype').val();

        $('#check-province,#check-city,#check-area').prop('checked',false).attr('disabled',true).hide();


        if(val=='1'){
            $('#check-province,#check-city,#check-area').removeAttr('disabled').show();
            $('#check-province').prop('checked',true);
        }
        else if(val=='2'){

            $('#check-city,#check-area').removeAttr('disabled').show();
            $('#check-city').prop('checked',true);

        } else if(val=='3'){
            $('#check-area').prop('checked',true).show();
        }
        $('#btnSubmitArea').unbind('click').bind('click',function(){

            if( $('#sel-provance').val()=='请选择省份'){
                tip.msgbox.err('请选择省份');
                return;
            }
            var type = $(":radio[name=aagent-selectareas]:checked").val();
            var province = $('#sel-provance').val();
            var city = $('#sel-city').val();
            var area = $('#sel-area').val();
            var ret = addAagentItem(province,city,area,type);
            if(ret){
                $('#modal-areas .close').trigger('click');
            }

        });
        $('#modal-areas').modal();

    }

</script>