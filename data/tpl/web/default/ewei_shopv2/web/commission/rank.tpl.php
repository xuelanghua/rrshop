<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='page-heading'><h2>排行榜设置  <?php if(cv('commission.rank')) { ?><?php  } ?></h2></div>
<form action="" method="post" class='form-horizontal form-validate'>

    <div class="form-group">
        <label class="col-sm-2 control-label">直接链接</label>
        <div class="col-sm-9 col-xs-12">
            <p class='form-control-static'>
                <a href='javascript:;' class="js-clip" title='点击复制链接' data-url="<?php  echo mobileUrl('commission/rank',array(),true)?>" >
                    <?php  echo mobileUrl('commission/rank',array(),true)?>
                </a>
                <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true"
                      data-content="<img src='<?php  echo $qrcode;?>' width='130' alt='链接二维码'>" data-placement="auto right">
                    <i class="glyphicon glyphicon-qrcode"></i>
                </span>
            </p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-12 col-sm-2 control-label">排行榜开关</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('commission.rank.edit')) { ?>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" <?php  if(empty($item['status'])) { ?>checked<?php  } ?> /> 关闭
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="1" <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 开启
            </label>
            <?php  } else { ?>
            <div class="form-control-static"><?php  if(empty($item['status'])) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-12 col-sm-2 control-label">排行榜类型</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('commission.rank.edit')) { ?>
            <label class="radio-inline">
                <input type="radio" name="type" value="0" <?php  if(empty($item['type'])) { ?>checked<?php  } ?> /> 按累计佣金
            </label>
            <label class="radio-inline">
                <input type="radio" name="type" value="1" <?php  if($item['type']==1) { ?>checked<?php  } ?> /> 按已提现佣金
            </label>
            <label class="radio-inline">
                <input type="radio" name="type" value="2" <?php  if($item['type']==2) { ?>checked<?php  } ?> /> 虚拟排行榜
            </label>
            <?php  } else { ?>
            <div class="form-control-static"><?php  if(empty($item['type'])) { ?>按累计佣金<?php  } else if($item['type']==1) { ?>按已提现佣金<?php  } else if($item['type']==2) { ?>虚拟排行榜<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label">排行榜显示数量</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('commission.rank.edit')) { ?>
            <input type="text" name="num" class="form-control" value="<?php  echo $item['num'];?>"/>
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['num'];?></div>
            <?php  } ?>
        </div>
    </div>
<?php if(cv('commission.rank.edit')) { ?>
    <div class="form-group refresh">
        <label class="col-sm-2 col-xs-12 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <a id="refresh" href="javascript:;" class="btn btn-primary">刷新排行榜</a>
            <!--<a href="javascript:;" class="btn btn-primary"></a>-->
        </div>
    </div>
<?php  } ?>
    <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <table class="table table-responsive">
        <thead class="navbar-inner">
        <tr>
            <th  style="width:300px;">昵称</th>
            <th  style="width:150px;"> 
            	<?php if(cv('commission.rank.edit')) { ?>
            	<input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" placeholder="例如 : "/>
            	<?php  } else { ?>
            		累计佣金 <?php  echo intval($item['title'])?>
            	<?php  } ?>
            </th>
            <th style="width:80px;">头像</th>
            <th style="width:80px;"></th>
            <th></th>
        </tr>
        </thead>
        <tbody id='tbody-items'>
        <?php  if(is_array($list)) { foreach($list as $key => $row) { ?>
        <tr>
            <td>
                <?php if(cv('commission.rank.edit')) { ?>
                <input type="hidden" name="id[]" value="" >
                <input type="text" class="form-control" name="nickname[]" value="<?php  echo $row['nickname'];?>" >
                <?php  } else { ?>
                <?php  echo $row['nickname'];?>
                <?php  } ?>
            </td>

            <td>
                <?php if(cv('commission.rank.edit')) { ?>
                <input type="text" class="form-control" name="commission_total[]" value="<?php  echo $row['commission_total'];?>" >
                <?php  } else { ?>
                <?php  echo $row['commission_total'];?>
                <?php  } ?>
            </td>

            <td>
                <input type='hidden'  name="avatar[]" value="<?php  echo $row['avatar'];?>" />
                <img onclick="selectImage(this)" onerror="this.src='<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg'"
                     src="<?php  if(empty($row['avatar'])) { ?><?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg<?php  } else { ?><?php  echo tomedia($row['avatar'])?><?php  } ?>"
                style="width:40px;height:40px">
            </td>
            <td>
                <?php if(cv('commission.rank.edit')) { ?>
                <a href="<?php  echo webUrl('commission.rank.delete', array('id' => $key))?>" data-toggle='ajaxRemove' class="btn btn-default btn-sm" data-confirm="确认删除此虚拟用户?"><i class="fa fa-trash"></i> 删除</a><?php  } ?>
            </td>

        </tr>
        <?php  } } ?>
        </tbody>
                <tr>
                    <td>
                        <?php if(cv('commission.rank.edit')) { ?>
                        <input name="button" type="button" class="btn btn-warning" value="添加虚拟用户" onclick='addlink()'>
                        <?php  } ?>
                    </td>
                </tr>
    </table>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('commission.rank.edit')) { ?>
            <input type="submit" class="btn btn-primary" value="保存">
            <?php  } ?>
        </div>
    </div>
</form>

<?php if(cv('commission.rank.edit')) { ?>
<script>

    function addlink(){
        var html ='<tr>';
        html+='<td>';
        html+='<input type="hidden" name="id[]" value="" ><input type="text" class="form-control" name="nickname[]" value="">';
        html+='</td>';
        html+='<td>';
        html+='<input type="text" class="form-control" name="commission_total[]" value="">';
        html+='</td>';
        html+='<td>';
        html+='<input type="hidden"  name="avatar[]" value="{$row[\'avatar\']}" />';
        html+='<img onclick="selectImage(this)" onerror="this.src=\'<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg\'" src="<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg>" style=\'width:40px;height:40px;\'';
        html+='</td>';

        html+='<td></td></tr>';;
        $('#tbody-items').append(html);
    }

    function selectImage(obj){
        util.image('',function(val){
            $(obj).attr('src',val.url);
            var group  =$(obj).parent();
            group.find(':hidden').val(val.url);
        });
    }

    function get(i,count,openids){
        var size = 50;
        var sizeArray = openids.slice(i*size,(i+1)*size);
        $.post("<?php  echo webUrl('commission/rank/ajaxgetcommission')?>",{openid:sizeArray},function(json){
                    if(json.status == '1')
                    {
                        $("#refresh").text("完成 "+(i+1)*size+"/"+count);
                        if(count <= (i+1)*size)
                        {
                            $("#refresh").removeClass("disabled");
                            $("#refresh").text("刷新排行榜");
                            tip.msgbox.suc("更新成功!");
                        }
                        i++;
                        get(i,count,openids);
                    }
                    if(json.status == "0")
                    {
                        ("#refresh").removeClass("disabled");
                        tip.msgbox.err("更新失败!");

                    }
                },'json');
    }

    $(function () {

        if($(":radio[name=type][checked]").val() != 2)
        {
            $("table").hide();
        }
        if($(":radio[name=type][checked]").val() != 0)
        {
            $(".refresh").hide();
        }
        $(":radio[name=type]").click(function () {
            var _this = this;
            $("table").show();
            $(".refresh").show();
            if($(_this).val() != '2')
            {
                $("table").hide();
            }
            if($(_this).val() != '0')
            {
                $(".refresh").hide();
            }
        });
    });

    $(".refresh div a").click(function (e) {
        tip.confirm('刷新排行榜 , 会造成服务器压力剧增 , 请在访问量小的时候进行',function () {
            $.getJSON("<?php  echo webUrl('commission/rank/ajaxgetcommissionopenid')?>",function (data) {

                var i = 0;
                if (data.status == 0)
                {
                    tip.msgbox.err('暂时没有任何分销商!');
                }
                else
                {
                    $("#refresh").addClass("disabled");
                    get(i,data.result.openid.length,data.result.openid);
                }

            })
        });
    });
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>