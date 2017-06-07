<?php defined('IN_IA') or exit('Access Denied');?>            <div class="form-group">
                <label class="col-sm-2 control-label">满额立减活动时间</label>
                <div class="col-sm-4 col-xs-6">
                    <?php echo tpl_form_field_daterange('enoughtime', array('starttime'=>date('Y-m-d H:i', !empty($item['enoughtime']['start'])?$item['enoughtime']['start']:time()),'endtime'=>date('Y-m-d H:i', !empty($item['enoughtime']['end'])?$item['enoughtime']['end']:time())),true);?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">满额立减时间段</label>
                <div class="col-sm-8 col-xs-12" id="addenoughtime">
                    <?php  if(is_array($item['enoughtime']['start1'])) { foreach($item['enoughtime']['start1'] as $key => $value) { ?>
                    <div class="input-group" style="margin-top: 10px;margin-bottom: 10px">
                        <input type="number" name="data[enoughtime][start1][]" class="form-control" value="<?php  echo $item['enoughtime']['start1'][$key];?>">
                        <span class="input-group-addon">:</span>
                        <input type="number" name="data[enoughtime][start2][]" class="form-control valid" value="<?php  echo $item['enoughtime']['start2'][$key];?>">
                        <span class="input-group-addon">至</span>
                        <input type="number" name="data[enoughtime][end1][]" class="form-control" value="<?php  echo $item['enoughtime']['end1'][$key];?>">
                        <span class="input-group-addon">:</span>
                        <input type="number" name="data[enoughtime][end2][]" class="form-control" value="<?php  echo $item['enoughtime']['end2'][$key];?>">
                        <span class="input-group-btn"><button type="button" class="btn btn-danger" onclick="$(this).parents('.input-group').remove()">删除</button></span>
                    </div>
                    <?php  } } ?>
                    <div></div>
                    <div style="margin-top:5px">
                        <button type='button' class="btn btn-default" onclick='addrandtime(this,"enoughtime")' style="margin-bottom:5px"><i class='fa fa-plus'></i> 添加区间</button>
                    </div>
                    <div class="help-block">如果满额立减时间段为空 则满额立减时间为全天~</div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">满额立减</label>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <span class="input-group-addon">支付满</span>
                        <input type="text" name="data[enoughmoney]" value="<?php  echo $item['enoughmoney'];?>" class="form-control"/>
                        <span class='input-group-addon'>元 立减</span>
                        <input type="text" name="data[enoughdeduct]" value="<?php  echo $item['enoughdeduct'];?>" class="form-control"/>
                        <span class='input-group-addon'>元</span>
                        <div class="input-group-btn">
                            <button type='button' class="btn btn-default"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-8">
                    <div class='recharge-items'>
                        <?php  if(is_array($item['enoughs'])) { foreach($item['enoughs'] as $it) { ?>
                        <div class="input-group recharge-item" style="margin-top:5px">
                            <span class="input-group-addon">支付满</span>
                            <input type="text" class="form-control" name='enough[]' value='<?php  echo $it['enough'];?>' />
                            <span class="input-group-addon">元 立减</span>
                            <input type="text" class="form-control"  name='give[]' value='<?php  echo $it['give'];?>' />
                            <span class="input-group-addon">元</span>
                            <div class='input-group-btn'>
                                <button class='btn btn-danger' type='button' onclick="$(this).parents('.recharge-item').remove()"><i class='fa fa-remove'></i></button>
                            </div>
                        </div>
                        <?php  } } ?>
                    </div>
                    <div style="margin-top:5px">
                        <button type='button' class="btn btn-default" onclick='addConsumeItem()' style="margin-bottom:5px"><i class='fa fa-plus'></i> 增加优惠项</button>
                    </div>
                    <span class="help-block">两项都填写才能生效</span>
                </div>
            </div>