<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
    <span class='pull-right'><a href="<?php  echo webUrl('shop/comment')?>" class='btn btn-default'>返回列表</a></span>
    <h2>回复评价</h2>
</div>
 


<form id="dataform" action="" method="post" class="form-horizontal form-validate" >
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
    <input type="hidden" name="type" id="post_type" value="<?php  echo $type;?>" />
    <input type="hidden" name="has_reply" id="has_reply" value="<?php  if(!empty($item['append_reply_content'])) { ?>1<?php  } else { ?>0<?php  } ?>" />

            <div class="form-group">
                <label class="col-sm-2 control-label">订单号</label>
                <div class="col-sm-9 col-xs-12">
                    <div class='form-control-static'><?php  echo $order['ordersn'];?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">评价商品</label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="goods" value="<?php  if(!empty($goods)) { ?>[<?php  echo $goods['id'];?>]<?php  echo $goods['title'];?><?php  } ?>" id="goods" class="form-control" readonly />
                    <span id="goodsthumb" class='help-block' <?php  if(empty($goods)) { ?>style="display:none"<?php  } ?>><img  style="width:100px;height:100px;border:1px solid #ccc;padding:1px" src="<?php  echo tomedia($goods['thumb'])?>"/></span>
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">评价者</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="nickname" value="<?php  echo $item['nickname'];?>" id="nickname" class="form-control" readonly />
                    <span id="nicknamethumb" class='help-block' ><img  style="width:100px;height:100px;border:1px solid #ccc;padding:1px" src="<?php  echo tomedia($item['headimgurl'])?>"/></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">评分等级</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="form-control-static" style='color:#ff6600'>
                        <?php  if($item['level']>=1) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
                        <?php  if($item['level']>=2) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
                        <?php  if($item['level']>=3) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
                        <?php  if($item['level']>=4) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
                        <?php  if($item['level']>=5) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"><span style='color:red'>*</span> 首次评价</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="form-control-static"><?php  echo $item['content'];?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <div class="input-group multi-img-details">
                        <?php  $images = iunserializer($item['images'])?>
                        <?php  if(is_array($images)) { foreach($images as $img) { ?>
                        <div class="multi-item" style="min-height: 100px; height: auto; max-width: none; max-height: none;">
                            <a href='<?php  echo tomedia($img)?>' target='_blank'>
                                <img class="img-responsive img-thumbnail" src='<?php  echo tomedia($img)?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                            </a>
                        </div>
                        <?php  } } ?>
                    </div>
                </div>
            </div>

            <?php  if($type == 1) { ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">首次评价审核状态 </label>
                    <div class="col-sm-9 col-xs-12">
                        <label class='radio-inline'><input type='radio' name='checked' value='0' <?php  if(empty($item['checked'])) { ?>checked<?php  } ?>/> 通过</label>
                        <label class='radio-inline'><input type='radio' name='checked' value='2' <?php  if($item['checked']=='2') { ?>checked<?php  } ?> /> 不通过</label>
                        <label class='radio-inline'><input type='radio' name='checked' value='1' <?php  if($item['checked']=='1') { ?>checked<?php  } ?> /> 审核中</label>
                    </div>
                </div>
                <br>
            <?php  } ?>

            <?php  if($type == 0) { ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">首次回复</label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea name='reply_content' class="form-control"><?php  echo $item['reply_content'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <?php  echo tpl_form_field_multi_image('reply_images',iunserializer($item['reply_images']))?>
                    </div>
                </div>
            <?php  } ?>

                <?php  if(!empty($item['append_content'])) { ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">追加评价</label>
                    <div class="col-sm-9 col-xs-12">
                        <div class="form-control-static"><?php  echo $item['append_content'];?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <div class="input-group multi-img-details">
                            <?php  $append_images = iunserializer($item['append_images'])?>
                            <?php  if(is_array($append_images)) { foreach($append_images as $img) { ?>
                            <div class="multi-item" style="min-height: 100px; height: auto; max-width: none; max-height: none;">
                                <a href='<?php  echo tomedia($img)?>' target='_blank'>
                                    <img class="img-responsive img-thumbnail" src='<?php  echo tomedia($img)?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                                </a>
                            </div>
                            <?php  } } ?>
                        </div>
                    </div>
                </div>

            <?php  if($type == 0) { ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">追加回复</label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea name='append_reply_content' class="form-control"><?php  echo $item['append_reply_content'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <?php  echo tpl_form_field_multi_image('append_reply_images',iunserializer($item['append_reply_images']))?>
                    </div>
                </div>
                <?php  } ?>
            <?php  } ?>

            <?php  if($type == 1 && !empty($item['append_content'])) { ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">追加评价审核状态 </label>
                    <div class="col-sm-9 col-xs-12">
                        <label class='radio-inline'><input type='radio' name='replychecked' value='0' <?php  if(empty($item['replychecked'])) { ?>checked<?php  } ?>/> 通过</label>
                        <label class='radio-inline'><input type='radio' name='replychecked' value='2' <?php  if($item['replychecked']=='2') { ?>checked<?php  } ?> /> 不通过</label>
                        <label class='radio-inline'><input type='radio' name='replychecked' value='1' <?php  if($item['replychecked']=='1') { ?>checked<?php  } ?> /> 审核中</label>
                    </div>
                </div>
            <?php  } ?>

            <div class="form-group"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <input type="submit" value="提交" class="btn btn-primary"  />
                    <input type="button" name="back" onclick='history.back()' <?php if(cv('shop.adv.add|shop.adv.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                </div>
            </div>
 
</form>

<script language='javascript'>
    $('form').submit(function(){
        var post_type = $('#post_type').val();
        var has_reply = $('#has_reply').val();

        if (post_type == 0) {
            if ($.trim($('textarea[name=reply_content]').val()) == ''){
                $('form').attr('stop',1),tip.msgbox.err('请填写首次回复内容!');
                $('textarea[name=reply_content]').focus();
                return false;
            }

            if (has_reply > 0) {
                if ($.trim($('textarea[name=append_reply_content]').val()) == ''){
                    $('form').attr('stop',1),tip.msgbox.err('请填写追加回复内容!');
                    $('textarea[name=append_reply_content]').focus();
                    return false;
                }
            }
            $('form').removeAttr('stop');
        }
        return true;
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
