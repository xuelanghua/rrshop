<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>网站设置</h2> </div>

<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >

    <div class="form-group">
        <label class="col-sm-2 control-label">网站状态</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('system.site' ,$data) ) { ?>
            <label class='radio-inline'>
                <input type='radio' name='data[status]' value='1' <?php  if($data['status']==1) { ?>checked<?php  } ?> /> 开启
            </label>
            <label class='radio-inline'>
                <input type='radio' name='data[status]' value='0' <?php  if($data['status']==0) { ?>checked<?php  } ?> /> 关闭
            </label>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if(empty($item['status'])) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">网站模板选择</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('sysset.template.edit')) { ?>
            <select class='form-control' name='data[template]'>
                <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
                <option value='<?php  echo $style;?>' <?php  if($style==$data['template']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
                <?php  } } ?>
            </select>
            <?php  } else { ?>
            <input type="hidden" name="data[template]" value="<?php  echo $data['template'];?>"/>
            <div class='form-control-static'>
                <?php  if(empty($data['template'])) { ?>default<?php  } else { ?><?php  echo $data['template'];?><?php  } ?>
            </div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">网站关闭后跳转的连接</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[closeurl]" class="form-control" value="<?php  echo $data['closeurl'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[closeurl]" value="<?php  echo $data['closeurl'];?>"/>
            <div class='form-control-static'><?php  echo $data['closeurl'];?></div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">网站名称</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[title]" class="form-control" value="<?php  echo $data['title'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[title]" value="<?php  echo $data['title'];?>"/>
            <div class='form-control-static'><?php  echo $data['title'];?></div>
            <?php  } ?>

        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">网站LOGO</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <?php  echo tpl_form_field_image('data[logo]', $data['logo'])?>
            <span class='help-block'>建议尺寸:300*100</span>
            <?php  } else { ?>
            <input type="hidden" name="data[logo]" value="<?php  echo $data['logo'];?>"/>
            <?php  if(!empty($data['logo'])) { ?>
            <a href='<?php  echo tomedia($data['logo'])?>' target='_blank'>
            <img src="<?php  echo tomedia($data['logo'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
            </a>
            <?php  } ?>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">微信二维码</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <?php  echo tpl_form_field_image('data[qrcode]', $data['qrcode'])?>
            <span class='help-block'>建议尺寸:140*140</span>
            <?php  } else { ?>
            <input type="hidden" name="data[qrcode]" value="<?php  echo $data['qrcode'];?>"/>
            <?php  if(!empty($data['qrcode'])) { ?>
            <a href="<?php  echo tomedia($data['qrcode'])?>" target='_blank'>
            <img src="<?php  echo tomedia($data['qrcode'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
            </a>
            <?php  } ?>
            <?php  } ?>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">网站关键词</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[keywords]" class="form-control" value="<?php  echo $data['keywords'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[keywords]" value="<?php  echo $data['keywords'];?>"/>
            <div class='form-control-static'><?php  echo $data['keywords'];?></div>
            <?php  } ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">网站简介</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <textarea name="data[description]" class="form-control richtext" cols="70"><?php  echo $data['description'];?></textarea>
            <?php  } else { ?>
            <textarea name="data[description]" class="form-control richtext" cols="70" style="display:none"><?php  echo $data['description'];?></textarea>
            <div class='form-control-static'><?php  echo $data['description'];?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">首页案例展示副标题</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <textarea name="data[casesubtitle]" class="form-control richtext" cols="70"><?php  echo $data['casesubtitle'];?></textarea>
            <?php  } else { ?>
            <textarea name="data[casesubtitle]" class="form-control richtext" cols="70" style="display:none"><?php  echo $data['casesubtitle'];?></textarea>
            <div class='form-control-static'><?php  echo $data['casesubtitle'];?></div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">首页新闻动态副标题</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <textarea name="data[newsubtitle]" class="form-control richtext" cols="70"><?php  echo $data['newsubtitle'];?></textarea>
            <?php  } else { ?>
            <textarea name="data[newsubtitle]" class="form-control richtext" cols="70" style="display:none"><?php  echo $data['newsubtitle'];?></textarea>
            <div class='form-control-static'><?php  echo $data['newsubtitle'];?></div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">首页最新文章副标题</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <textarea name="data[articlesubtitle]" class="form-control richtext" cols="70"><?php  echo $data['articlesubtitle'];?></textarea>
            <?php  } else { ?>
            <textarea name="data[articlesubtitle]" class="form-control richtext" cols="70" style="display:none"><?php  echo $data['articlesubtitle'];?></textarea>
            <div class='form-control-static'><?php  echo $data['articlesubtitle'];?></div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">首页友情链接副标题</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <textarea name="data[linksubtitle]" class="form-control richtext" cols="70"><?php  echo $data['linksubtitle'];?></textarea>
            <?php  } else { ?>
            <textarea name="data[linksubtitle]" class="form-control richtext" cols="70" style="display:none"><?php  echo $data['linksubtitle'];?></textarea>
            <div class='form-control-static'><?php  echo $data['linksubtitle'];?></div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">首页联系我们副标题</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <textarea name="data[contactsubtitle]" class="form-control richtext" cols="70"><?php  echo $data['contactsubtitle'];?></textarea>
            <?php  } else { ?>
            <textarea name="data[contactsubtitle]" class="form-control richtext" cols="70" style="display:none"><?php  echo $data['contactsubtitle'];?></textarea>
            <div class='form-control-static'><?php  echo $data['contactsubtitle'];?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">联系人</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[contacts]" class="form-control" value="<?php  echo $data['contacts'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[contacts]" value="<?php  echo $data['contacts'];?>"/>
            <div class='form-control-static'><?php  echo $data['contacts'];?></div>
            <?php  } ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">联系方式</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[mobile]" class="form-control" value="<?php  echo $data['mobile'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[mobile]" value="<?php  echo $data['mobile'];?>"/>
            <div class='form-control-static'><?php  echo $data['mobile'];?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">服务时间</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[servertime]" class="form-control" value="<?php  echo $data['servertime'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[servertime]" value="<?php  echo $data['servertime'];?>"/>
            <div class='form-control-static'><?php  echo $data['servertime'];?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">客服QQ</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[qq]" class="form-control" value="<?php  echo $data['qq'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[qq]" value="<?php  echo $data['qq'];?>"/>
            <div class='form-control-static'><?php  echo $data['qq'];?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">联系地址</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[address]" class="form-control" value="<?php  echo $data['address'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[address]" value="<?php  echo $data['address'];?>"/>
            <div class='form-control-static'><?php  echo $data['name'];?></div>
            <?php  } ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">邮编</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="text" name="data[zipcode]" class="form-control" value="<?php  echo $data['zipcode'];?>" />
            <?php  } else { ?>
            <input type="hidden" name="data[zipcode]" value="<?php  echo $data['zipcode'];?>"/>
            <div class='form-control-static'><?php  echo $data['zipcode'];?></div>
            <?php  } ?>

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">底部版权</label>
        <div class="col-sm-9">
            <?php  echo tpl_ueditor('data[copyright]',$data['copyright'])?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">全局统计代码</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <textarea name="data[diycode]" class="form-control richtext" cols="70" rows="5"><?php  echo $data['diycode'];?></textarea>
            <?php  } else { ?>
            <textarea name="data[diycode]" class="form-control richtext" cols="70" style="display:none"  rows="5"><?php  echo $data['diycode'];?></textarea>
            <div class='form-control-static'><?php  echo $data['diycode'];?></div>
            <?php  } ?>
        </div>
    </div>



    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php if(cv('system.site')) { ?>
            <input type="submit" value="提交" class="btn btn-primary"  />
            <?php  } ?>
        </div>
    </div>


</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

