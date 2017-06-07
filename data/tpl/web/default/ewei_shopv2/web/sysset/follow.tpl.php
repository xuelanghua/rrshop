<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>关注及分享设置</h2> </div>
 
    <form action="" method="post" class="form-horizontal  form-validate" enctype="multipart/form-data" >
      <div class='form-group-title'>关注设置</div>
            <div class="form-group">
                <label class="col-sm-2 control-label">关注引导页</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sysset.follow.edit')) { ?>
                    	<input type="text" name="data[followurl]" class="form-control" value="<?php  echo $data['followurl'];?>" />
                    	<span class='help-block'>
                    		<p>用户未关注的引导页面，建议使用短链接：<a target="_blank" href="http://www.dwz.cn">短网址</a></p>
                    		<p>如果设置关注二维码则<span class="text-danger">优先弹出二维码</span></p>
                    	</span>
                    <?php  } else { ?>
                    	<input type="hidden" name="data[followurl]" value="<?php  echo $data['followurl'];?>" />
                    	<div class='form-control-static'><?php  echo $data['followurl'];?></div>
                    <?php  } ?>
                </div>
            </div>
                
            <div class="form-group">
                <label class="col-sm-2 control-label">关注二维码</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sysset.follow.edit')) { ?> 
                	    <?php  echo tpl_form_field_image('data[followqrcode]', $data['followqrcode']);?>
                        <span class='help-block'></a>
                    <?php  } else { ?>
                        <input type="hidden" name="data[followqrcode]" value="<?php  echo $data['followqrcode'];?>" />
                         <div class='form-control-static'><?php  echo $data['followqrcode'];?></div>
                        <?php  } ?>
                    </div>
            </div>
                
 
            <div class='form-group-title'>分享设置</div>
      
                <div class="form-group">
                    <label class="col-sm-2 control-label">分享标题</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.follow.edit')) { ?>
                        <input type="text" name="data[title]" class="form-control" value="<?php  echo $data['title'];?>" />
                        <span class="help-block">不填写默认商城名称</span>
                        <?php  } else { ?>
                        <input type="hidden" name="data[title]" value="<?php  echo $data['title'];?>" />
                        <div class='form-control-static'><?php  echo $data['title'];?></div>
                        <?php  } ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">分享图标</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.follow.edit')) { ?>

                        <?php  echo tpl_form_field_image('data[icon]', $data['icon']);?>
                        <span class="help-block">不选择默认商城LOGO</span>
                        <?php  } else { ?>
                        <input type="hidden" name="data[icon]" value="<?php  echo $data['icon'];?>" />
                        <?php  if(!empty($data['icon'])) { ?>
                        <a href='<?php  echo tomedia($data['icon'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($data['icon'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">分享描述</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.follow.edit')) { ?>
                        <textarea style="height:100px;" name="data[desc]" class="form-control" cols="60"><?php  echo $data['desc'];?></textarea>
                        <?php  } else { ?>
                        <textarea style="height:100px;display: none" name="data[desc]" class="form-control" cols="60"><?php  echo $data['desc'];?></textarea>
                        <div class='form-control-static'><?php  echo $data['desc'];?></div>
                        <?php  } ?>
                    </div> 
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label">分享链接</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.follow.edit')) { ?>
                        
                        <div class="input-group form-group" style="margin: 0;"> 
                        	<input type="text" name="data[url]" class="form-control" value="<?php  echo $data['url'];?>" id="shareurl" />
                        	<span data-input="#shareurl" data-toggle="selectUrl" data-full="true" class="input-group-addon btn btn-default">选择链接</span>
                    	</div>
                    	
                        <span class='help-block'>用户分享出去的链接，默认为首页</span>
                        <?php  } else { ?>
                        <input type="hidden" name="data[url]" value="<?php  echo $data['url'];?>" />
                        <div class='form-control-static'><?php  echo $data['url'];?></div>
                        <?php  } ?>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品详情分享</label>
                    <div class="col-sm-9">
                        <?php if(cv('sysset.follows.edit')) { ?>
                        <label class="radio-inline"><input type="radio" name="data[goods_detail_close]" value="1" <?php  if($data['goods_detail_close']==1) { ?> checked="checked"<?php  } ?>/>关闭</label>
                        <label class="radio-inline"><input type="radio" name="data[goods_detail_close]" value="0" <?php  if(empty($data['goods_detail_close'])) { ?> checked="checked"<?php  } ?>/>开启</label>
                        <span class="help-block">商品详情页面按钮</span>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  if($data['goods_detail_close']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">商品详情分享文字</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.follow.edit')) { ?>
                        <textarea style="height:100px;" name="data[goods_detail_text]" class="form-control" cols="60"><?php  echo $data['goods_detail_text'];?></textarea>
                        <span class="help-block">商品详情页面按钮 按下 弹出文字 默认文字: <br/><span class="text-danger">请点击右上角<br/>通过【发送给朋友】<br/>邀请好友购买</span></span>
                        <?php  } else { ?>
                        <textarea style="height:100px;display: none" name="data[goods_detail_text]" class="form-control" cols="60"><?php  echo $data['goods_detail_text'];?></textarea>
                        <div class='form-control-static'><?php  echo $data['desc'];?></div>
                        <?php  } ?>
                    </div>
                </div>

        <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.follow.edit')) { ?>
                            <input type="submit"  value="提交" class="btn btn-primary"  />
                          <?php  } ?>
                     </div>
            </div>
 
    </form>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     