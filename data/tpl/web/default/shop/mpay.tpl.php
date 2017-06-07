<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active">支付设置</li>
</ol>
<ul class="nav nav-tabs">
    <?php  if($_W['isfounder']) { ?>
     
    <li <?php  if($do == 'payset') { ?>class="active"<?php  } ?>><a href="<?php  echo url('shop/mpayset/payset');?>">支付设置</a></li>
     <li <?php  if($do == 'mkset') { ?>class="active"<?php  } ?>><a href="<?php  echo url('shop/mkdel/mkset');?>">相关设置</a></li>
    <?php  } ?>
</ul>


<?php  if($_W['isfounder']) { ?>
<?php  if($do == 'payset') { ?>
<div style="width: 100%" >
        <aside>
            <section>
                <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-heading">支付配置</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="width: 25%">支付宝帐号</span>
                                        <input class="form-control" name="save[alipay_account]" type="text" placeholder="支付宝帐号" value="<?php  echo $save['alipay_account'];?>">
                                        <span class="input-group-addon"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="width: 25%">支付宝合作者身份</span>
                                        <input class="form-control" name="save[partner]" type="text" placeholder="支付宝合作者身份" value="<?php  echo $save['partner'];?>">
                                        <span class="input-group-addon"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="width: 25%">支付宝校验密钥</span>
                                        <input class="form-control" name="save[key]" type="text" placeholder="支付宝校验密钥" value="<?php  echo $save['key'];?>" />
                                        <span class="input-group-addon"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="panel panel-default">
                        <div class="panel-heading">短信配置</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="width: 30%">短信单价</span>
                                        <input class="form-control" name="save[dx_UnitPrice]" type="text" placeholder="短信单价" value="<?php  echo $save['dx_UnitPrice'];?>">
                                        <span class="input-group-addon">元/条</span>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">到期配置</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-1">到期后套餐</div>
                                <div class="col-sm-9">
                                    <?php  if(is_array($packages)) { foreach($packages as $item) { ?>
                                    <label class="radio-inline" style="padding-top:0px">
                                        <input type="radio" name="save[over_group]"  value="<?php  echo $item['id'];?>" <?php  if($item['id'] == $save['over_group']) { ?> checked <?php  } ?>> <?php  echo $item["name"];?>
                                    </label>
                                    <?php  } } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="width: 30%">到期提前</span>
                                        <input class="form-control" name="save[tx_date]" type="text" placeholder="提前几天提醒" value="<?php  echo $save['tx_date'];?>">
                                        <span class="input-group-addon">天提醒</span>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <textarea name="save[tx_email]" class="form-control richtext" rows="3"><?php  echo $save['tx_email'];?></textarea>
                                    <div class="help-block">提醒内容;<br/>变量名:<span style="color: red">#package#</span>  套餐名称 <span style="color: red">#day#</span> 时间<br/>例：您的#package#套餐将在#day#过期</div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">套餐配置</div>
                        <div class="panel-body">
                            <?php  if(is_array($packages)) { foreach($packages as $item) { ?>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="width: 30%"><?php  echo $item['name'];?></span>
                                        <input class="form-control" name="packages[<?php  echo $item['id'];?>][price]" type="text" placeholder="套餐价格" value="<?php  echo $item['price'];?>">
                                        <span class="input-group-addon">元 <input type="checkbox" name="packages[<?php  echo $item['id'];?>][hide]" value="1" <?php  if($item['hide']==1) { ?>checked<?php  } ?>>对客户隐藏</span>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <?php  } } ?>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="width: 30%">套餐周期</span>
                                        <input class="form-control" name="save[package_day]" type="text" placeholder="周期" value="<?php  echo $save['package_day'];?>">
                                        <span class="input-group-addon">天，<span style="color: red">未设置默认30天</span> </span>
                                    </div>
                                </div>
                            </div>
                            <?php  if(is_array($groups)) { foreach($groups as $item) { ?>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon" style="width: 30%"><?php  echo $item['name'];?></span>
                                        <input class="form-control" name="groups[<?php  echo $item['id'];?>][discount]" type="text" placeholder="用户组折扣" value="<?php  echo $item['discount'];?>">
                                        <span class="input-group-addon">折，支持小数 比如：9.5 | 8 <span style="color: red">不打折请输 0</span> </span>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <?php  } } ?>
                        </div>
                    </div>-->
                    <div class="panel panel-default">
                        <div class="panel-heading">服务公告</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <textarea name="save[service_gg]" class="form-control richtext" rows="3"><?php  echo $save['service_gg'];?></textarea>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center;margin: 20px">
                        <input type="submit" class="btn btn-info" name="submit" value=" 保 存 "/>
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </form>
            </section>
        </aside>
    </div>

<?php  } ?>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>