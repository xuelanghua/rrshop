<?php defined('IN_IA') or exit('Access Denied');?>
<tr id="tp_item<?php  echo $kw?>" class='tp_item'>
    <td valign='top'>
        <?php  echo $data_type_config[$data_type]?>
    </td>
    <td valign='top'>

        <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
        <input type="hidden" value="<?php  echo $data_type?>" class="form-control" name="tp_type[<?php  echo $kw?>]" />

        <input type="text" value="<?php  if($flag=1 && $data_type==6) { ?>身份证<?php  } else { ?><?php  echo $v1['tp_name']?><?php  } ?>" class="form-control tp_name" name="tp_name[<?php  echo $kw?>]" maxlength="10" placeholder='字段名' />
        <?php  } else { ?>
        <?php  if($flag=1 && $data_type==6) { ?>身份证<?php  } else { ?><?php  echo $v1['tp_name']?><?php  } ?>
        <?php  } ?>
    </td>
    <td>
        <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
        <input type="checkbox" name="tp_must[<?php  echo $kw?>]" value="1" <?php  if($v1['tp_must']==1) { ?>checked<?php  } ?> >
        <?php  } else { ?>
        <?php  if($v1['tp_must']==1) { ?>是<?php  } else { ?>否<?php  } ?>
        <?php  } ?>
    </td>

    <td>
        <?php  if($data_type==0 ||  $data_type==1) { ?>
        <?php  if($data_type==0) { ?>
            设置默认值&nbsp;
            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <select id="tp_is_default<?php  echo $kw?>" name="tp_is_default[<?php  echo $kw?>]" onchange="tp_change_default('<?php  echo $kw?>')" class="form-control" style='width:100px;display: inline-block'>
                <?php  if(is_array($default_data_config)) { foreach($default_data_config as $key => $value) { ?>
                <option value="<?php  echo $key;?>" <?php  if($v1['tp_is_default']==$key) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                <?php  } } ?>
            </select>
            <?php  } else { ?>
            <?php  echo $default_data_config[$v1['tp_is_default']];?>
            <?php  } ?>

            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <input type="text" id="tp_default<?php  echo $kw?>" placeholder="请输入自定义默认值" value="<?php  echo $v1['tp_default']?>"
                   class="form-control tp_default" name="tp_default[<?php  echo $kw?>]"
                   style="width:150px;display:<?php  if($v1['tp_is_default']==1) { ?>inline<?php  } else { ?>none<?php  } ?>;">
            <?php  } else { ?>
            <p style="display:<?php  if($v1['tp_is_default']==1) { ?>inline<?php  } else { ?>none<?php  } ?>;"><?php  echo $v1['tp_default']?></p>
            <?php  } ?>
            <?php  } ?>

            提示语&nbsp;
            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <input type="text" id="placeholder<?php  echo $kw?>" placeholder="请输入提示语" value="<?php  echo $v1['placeholder']?>"
                   class="form-control" name="placeholder[<?php  echo $kw?>]"
                   style="width:150px;display:inline;">
            <?php  } else { ?>
            <?php  echo $v1['placeholder']?>
            <?php  } ?>

        <?php  } else if($data_type==5) { ?>

            最大数量&nbsp;
            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <select name="tp_max[<?php  echo $kw?>]" class="form-control" style='width:120px;display: inline-block'>
                <option value="1" <?php  if($v1['tp_max']==1 || !$v1['tp_max']) { ?>selected<?php  } ?>>1</option>
                <option value="2" <?php  if($v1['tp_max']==2) { ?>selected<?php  } ?>>2</option>
                <option value="3" <?php  if($v1['tp_max']==3) { ?>selected<?php  } ?>>3</option>
                <option value="4" <?php  if($v1['tp_max']==4) { ?>selected<?php  } ?>>4</option>
                <option value="5" <?php  if($v1['tp_max']==5) { ?>selected<?php  } ?>>5</option>
            </select>
            <?php  } else { ?>
            <?php  if(empty($v1['tp_max'])) { ?>1<?php  } else { ?><?php  echo $v1['tp_max'];?><?php  } ?>
            <?php  } ?>

        <?php  } else if($data_type==7) { ?>

            设置默认&nbsp;
            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <select id="default_time_type<?php  echo $kw?>" name="default_time_type[<?php  echo $kw?>]" onchange="tp_change_default_time(this,'default_time<?php  echo $kw?>')" class="form-control" style="width:167px;display:inline;">
                <?php  if(is_array($default_date_config)) { foreach($default_date_config as $key => $value) { ?>
                <option value="<?php  echo $key;?>" <?php  if($v1['default_time_type']==$key) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                <?php  } } ?>
            </select>
            <input type="text" id="default_time<?php  echo $kw?>" name="default_time[<?php  echo $kw?>]" placeholder="" value="<?php  if(!empty($v1['default_time'])) { ?><?php  echo $v1['default_time']?><?php  } ?>" class="datetimepicker1 form-control" style="width:120px;display: <?php  if($v1['default_time_type']==2) { ?>inline<?php  } else { ?>none<?php  } ?>;">
            <?php  } else { ?>
            <?php  echo $default_date_config[$v1['default_time_type']];?> &nbsp;<?php  if(!empty($v1['default_time'])) { ?><?php  echo $v1['default_time']?><?php  } ?>
            <?php  } ?>

        <?php  } else if(($data_type==2 || $data_type==3)) { ?>

            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <textarea class="form-control" name="tp_text[<?php  echo $kw?>]" placeholder="一行一个选项" style="height: 120px;"><?php  if(!empty($v1['tp_text'])) { ?><?php  if(is_array($v1['tp_text'])) { foreach($v1['tp_text'] as $k2 => $v2) { ?><?php  echo $v2."\n";?><?php  } } ?><?php  } ?></textarea>
            <?php  } else { ?>
            <?php  if(!empty($v1['tp_text'])) { ?><?php  if(is_array($v1['tp_text'])) { foreach($v1['tp_text'] as $k2 => $v2) { ?><?php  echo $v2."<br>";?><?php  } } ?><?php  } ?>
            <?php  } ?>

        <?php  } else if($data_type==8) { ?>

            设置默认起始日期&nbsp;
            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <select id="default_btime_type<?php  echo $kw?>" name="default_btime_type[<?php  echo $kw?>]" onchange="tp_change_default_time(this,'default_btime<?php  echo $kw?>')" class="form-control input-sm" style="width:120px;display:inline;">
                <?php  if(is_array($default_date_config)) { foreach($default_date_config as $key => $value) { ?>
                <option value="<?php  echo $key;?>" <?php  if($v1['default_btime_type']==$key) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                <?php  } } ?>
            </select>
            <input type="text" id="default_btime<?php  echo $kw?>" name="default_btime[<?php  echo $kw?>]" placeholder="" value="<?php  if(!empty($v1['default_etime'])) { ?><?php  echo $v1['default_btime']?><?php  } ?>" class="datetimepicker1 form-control  input-sm" style="width:120px;display:<?php  if($v1['default_btime_type']==2) { ?>inline<?php  } else { ?>none<?php  } ?>;margin-right: 25px;">
            <?php  } else { ?>
            <?php  echo $default_date_config[$v1['default_btime_type']];?> &nbsp; <?php  if(!empty($v1['default_etime'])) { ?><?php  echo $v1['default_btime']?><?php  } ?>
            <?php  } ?>
            <br/>

            设置默认结束日期&nbsp;
            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <select id="default_etime_type<?php  echo $kw?>" name="default_etime_type[<?php  echo $kw?>]" onchange="tp_change_default_time(this,'default_etime<?php  echo $kw?>')" class="form-control  input-sm" style="width:120px;display:inline;">
                <?php  if(is_array($default_date_config)) { foreach($default_date_config as $key => $value) { ?>
                <option value="<?php  echo $key;?>" <?php  if($v1['default_etime_type']==$key) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                <?php  } } ?>
            </select>
            <input type="text" id="default_etime<?php  echo $kw?>" name="default_etime[<?php  echo $kw?>]" placeholder="" value="<?php  if(!empty($v1['default_etime'])) { ?><?php  echo $v1['default_etime']?><?php  } ?>" class="datetimepicker1 form-control  input-sm" style="width:120px;display:<?php  if($v1['default_etime_type']==2) { ?>inline<?php  } else { ?>none<?php  } ?>;">
            <?php  } else { ?>
            <?php  echo $default_date_config[$v1['default_etime_type']];?> &nbsp; <?php  if(!empty($v1['default_etime'])) { ?><?php  echo $v1['default_etime']?><?php  } ?>
            <?php  } ?>

        <?php  } else if($data_type==9) { ?>

        级别&nbsp;
        <select name="tp_area[<?php  echo $kw?>]" class="form-control" style='width:120px;display: inline-block'>
            <option value="0" <?php  if(empty($v1['tp_area'])) { ?>selected<?php  } ?>>省市</option>
            <option value="1" <?php  if($v1['tp_area']==1) { ?>selected<?php  } ?>>省市区</option>
        </select>

        <?php  } else if($data_type==10) { ?>
            字段名2&nbsp;
            <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
            <input type="text" id="tp_name2<?php  echo $kw?>" placeholder="字段名2" value="<?php  echo $v1['tp_name2']?>"
                   class="form-control" name="tp_name2[<?php  echo $kw?>]"
                   style="width:150px;display:inline;">
            <?php  } else { ?>
            <?php  echo $v1['tp_name2']?>
            <?php  } ?>
        <?php  } ?>
    </td>


    <td>
        <?php if(cv('diyform.temp.edit|diyform.add')) { ?>
        <a onclick="$(this).closest('.tp_item').remove()" class="btn btn-danger btn-sm" href="javascript:void(0);"><i class="fa fa-remove"></i></a>
        <?php  } ?>
    </td>


</tr>
