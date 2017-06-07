<?php defined('IN_IA') or exit('Access Denied');?>
<div class="form-group">
    <label class="col-sm-2 control-label must">活动名称</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('lottery.edit')) { ?>
        <div class="input-group">
            <input type="text" name="lottery_title" class="form-control" value="<?php  echo $item['lottery_title'];?>" data-rule-required="true" />
            <input type="hidden" id="lottery_icon" name="lottery_icon" value="<?php  if(!empty($item['lottery_icon'])) { ?><?php  echo $item['lottery_icon'];?><?php  } else { ?><?php  } ?>">
            <span class="input-group-addon" style="padding: 0px;"><img src="<?php  if(!empty($item['lottery_icon'])) { ?><?php  echo $item['lottery_icon'];?><?php  } else { ?><?php  } ?>" id="showimg" width="34px" height="34px"></span>
            <span class="input-group-addon btn" data-toggle="selectImg" data-input="#lottery_icon" data-img="#showimg" data-full="1">选择图片</span>
        </div>
        <?php  } else { ?>
        <div class='form-control-static'><img src="<?php  if(!empty($item['lottery_icon'])) { ?><?php  echo $item['lottery_icon'];?><?php  } else { ?><?php  } ?>"  width="34px" height="34px"><?php  if(!empty($item['lottery_title'])) { ?><?php  echo $item['lottery_title'];?><?php  } else { ?>暂无标题<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label must">活动详情页背景图</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('lottery.edit')) { ?>
        <div class="input-group">
            <input type="text" id="lottery_banner" class="form-control" name="lottery_banner" value="<?php  if(!empty($item['lottery_banner'])) { ?><?php  echo $item['lottery_banner'];?><?php  } else { ?><?php  } ?>">
            <span class="input-group-addon" style="padding: 0px;"><img src="<?php  if(!empty($item['lottery_banner'])) { ?><?php  echo $item['lottery_banner'];?><?php  } else { ?><?php  } ?>" id="showbanner" width="34px" height="34px"></span>
            <span class="input-group-addon btn" data-toggle="selectImg" data-input="#lottery_banner" data-img="#showbanner" data-full="1">选择图片</span>
        </div>
        <?php  } else { ?>
        <div class='form-control-static'><img src="<?php  if(!empty($item['lottery_banner'])) { ?><?php  echo $item['lottery_banner'];?><?php  } else { ?><?php  } ?>"  width="34px" height="34px"></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label must">活动期限</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('lottery.edit')) { ?>
        <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
        <span class='help-block'>活动进行时间段</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo date('Y-m-d H:i', $starttime).'-'.date('Y-m-d H:i', $endtime);?></div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label must">活动奖励有效期限</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('lottery.edit')) { ?>
        <input type="number" name="lottery_days" class="form-control" value="<?php  echo $item['lottery_days']/24/3600;?>" data-rule-required="true"  />
        <span class='help-block'>活动完成后在此时间内领取奖励，无限期请设置0（单位：天）</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['lottery_days']/24/3600;?>天</div>
        <?php  } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">场景设置</label>
    <?php if(cv('lottery.edit')) { ?>
    <div class="col-sm-4 col-xs-12">
        <select class="input-sm form-control input-s-sm inline" name="task_type" id="task_select" onchange="task_change(this);">
            <option value="0">请选择场景</option>
            <option value="1" <?php  if($item['task_type']==1) { ?>selected<?php  } ?>>消费场景</option>
            <option value="2" <?php  if($item['task_type']==2) { ?>selected<?php  } ?>>签到场景</option>
            <option value="3" <?php  if(p('task') && $item['task_type']==3) { ?>selected<?php  } ?>>任务场景</option>
            <!--<option value="4" <?php  if($item['task_type']==4) { ?>selected<?php  } ?>>其他场景</option>-->
        </select>
    </div>
    <?php  } ?>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">场景条件</label>
    <?php if(cv('lottery.edit')) { ?>
    <?php  $item['task_data']=unserialize($item['task_data']);?>
    <div class="col-sm-9 col-xs-12" id="task_show">
        <?php  if($item['task_type']==1) { ?>
        <div class="row">
            <div class="col-sm-4 col-xs-4 ">
                <div class="input-group">
                    <span class="input-group-addon">满</span>
                    <input type="number" class="form-control" name="pay_money" value="<?php  echo $item['task_data']['pay_money'];?>" placeholder="0">
                    <span class="input-group-addon">元</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4 ">
                <div class="input-group">
                    <span class="input-group-addon">抽</span>
                    <input type="number" class="form-control" name="pay_num" value="<?php  echo $item['task_data']['pay_num'];?>" placeholder="0">
                    <span class="input-group-addon">次</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4 ">
                <div class="input-group">
                    <select class="input-sm form-control input-s-sm inline" name="pay_type" id="pay_select">
                        <option value="0" <?php  if($item['task_data']['pay_type']==0) { ?> selected<?php  } ?>>全部消费</option>
                        <option value="1" <?php  if($item['task_data']['pay_type']==1) { ?> selected<?php  } ?>>付款后</option>
                        <option value="2" <?php  if($item['task_data']['pay_type']==2) { ?> selected<?php  } ?>>完成订单后</option>
                    </select>
                </div>
            </div>
        </div>
        <?php  } ?>
        <?php  if($item['task_type']==2) { ?>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">满</span>
                    <input type="number" class="form-control" name="sign_day" value="<?php  echo $item['task_data']['sign_day'];?>" placeholder="0">
                    <span class="input-group-addon">天</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">抽</span>
                    <input type="number" class="form-control" name="sign_num" value="<?php  echo $item['task_data']['sign_num'];?>" placeholder="0">
                    <span class="input-group-addon">次</span>
                </div>
            </div>
        </div>
        <?php  } ?>
        <?php  if($item['task_type']==3) { ?>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">抽</span>
                    <input type="number" class="form-control" name="poster_num" value="<?php  echo $item['task_data']['poster_num'];?>" placeholder="0">
                    <span class="input-group-addon">次</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4">
                <select id="poster_select" class="input-sm form-control input-s-sm inline" name="poster_id">
                    <option value="0">所有任务</option>
                    <?php  if(is_array($tasklist)) { foreach($tasklist as $key => $task) { ?>
                    <option value="<?php  echo $task['id'];?>" <?php  if($item['task_data']['poster_id']==$task['id']) { ?> selected<?php  } ?>>
                    <?php  echo $task['title'];?>
                    </option>
                    <?php  } } ?>
                </select>
            </div>
        </div>
        <?php  } ?>
        <?php  if($item['task_type']==4) { ?>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">抽</span>
                    <input type="number" class="form-control" name="other_num" value="<?php  echo $item['task_data']['other_num'];?>"  placeholder="0">
                    <span class="input-group-addon">次</span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4">
                <input type="text" class="form-control" value="<?php  echo $item['task_data']['other_content'];?>"  name="other_content">
            </div>
        </div>
        <?php  } ?>
    </div>
    <?php  } ?>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">不能参加活动提示</label>

    <div class="col-sm-9 col-xs-12">
        <?php if(cv('lottery.edit')) { ?>
        <textarea name="lottery_cannot" class="form-control"  ><?php  if($item['lottery_cannot']) { ?><?php  echo $item['lottery_cannot'];?><?php  } else { ?>您没有参与抽奖的机会..<?php  } ?></textarea>
        <span class="help-block">默认：您没有参与抽奖的机会..</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['lottery_cannot'];?></div>
        <?php  } ?>
    </div>

</div>

<div class="form-group">
    <label class="col-sm-2 control-label">奖励商品参与分销</label>
    <div class="col-sm-9 col-xs-12">
        <?php if(cv('lottery.edit')) { ?>
        <label class="radio-inline">
            <input type="radio" name="is_goods" value="0" <?php  if($item['is_goods']==0) { ?>checked<?php  } ?> /> 禁用
        </label>

        <label class="radio-inline">
            <input type="radio" name="is_goods" value="1" <?php  if($item['is_goods']==1) { ?>checked<?php  } ?> /> 启用
        </label>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if($item['is_goods']==0) { ?>禁用<?php  } else { ?>启用<?php  } ?></div>
        <?php  } ?>
    </div>
</div>


<script type="application/javascript">
    function task_change(obj) {
        var task_type = $('#task_select').val();
        var task_div = '';
        var option_div = '';
        if(task_type==1){
            task_div = '<div class="row"><div class="col-sm-4 col-xs-4 "><div class="input-group"><span class="input-group-addon">满</span><input type="number" class="form-control" name="pay_money" placeholder="0"> <span class="input-group-addon">元</span></div>'
                    +'</div><div class="col-sm-4 col-xs-4 "><div class="input-group"><span class="input-group-addon">抽</span><input type="number" class="form-control" name="pay_num" placeholder="0"> <span class="input-group-addon">次</span></div></div>'
                    +'<div class="col-sm-4 col-xs-4 "><div class="input-group"><select class="input-sm form-control input-s-sm inline" name="pay_type" id="pay_select"><option value="0" >全部消费</option><option value="1">付款后</option><option value="2">完成订单后</option></select></div></div></div>';
        }
        if(task_type==2){
            task_div = '<div class="row"><div class="col-sm-4 col-xs-4"><div class="input-group"><span class="input-group-addon">满</span><input type="number" class="form-control" name="sign_day" placeholder="0"><span class="input-group-addon">天</span></div>'
                    +'</div><div class="col-sm-4 col-xs-4"><div class="input-group"><span class="input-group-addon">抽</span><input type="number" class="form-control" name="sign_num" placeholder="0"><span class="input-group-addon">次</span></div></div></div>';
        }
        if(task_type==3){
            option_div = '<option value="0">所有任务</option><?php  if(is_array($tasklist)) { foreach($tasklist as $key => $task) { ?><option value="<?php  echo $task['id'];?>"><?php  echo $task['title'];?></option><?php  } } ?>';
            task_div = '<div class="row"><div class="col-sm-4 col-xs-4"><div class="input-group"><span class="input-group-addon">抽</span><input type="number" class="form-control" name="poster_num" placeholder="0"><span class="input-group-addon">次</span></div></div><div class="col-sm-4 col-xs-4"><select id="poster_select" class="input-sm form-control input-s-sm inline" name="poster_id">'+option_div+'</select></div></div>';
        }
        if(task_type==4){
            task_div = '<div class="row"><div class="col-sm-4 col-xs-4"><div class="input-group"><span class="input-group-addon">抽</span><input type="number" class="form-control" name="other_num" placeholder="0"><span class="input-group-addon">次</span></div></div><div class="col-sm-4 col-xs-4"><input type="text" class="form-control" name="other_content"></div></div>';
        }
        $('#task_show').empty();
        $('#task_show').append(task_div);
        return;
    }
</script>