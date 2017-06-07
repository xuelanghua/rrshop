<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li class=""><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active">一键更新</li>
</ol>
<script src="./resource/script/update.min.js" type="text/javascript"></script>
<ul class="nav nav-tabs">
	<li<?php  if($do == 'upgrade') { ?> class="active"<?php  } ?>><a href="<?php  echo url('cloud/up');?>">自动更新</a></li>
	<?php  if($do == 'shipping') { ?><li class="active"><a href="javscript:;">升级处理</a></li><?php  } ?>
</ul>
<div class="clearfix">
  <div id="tips" style="display:block; overflow:hidden;">
		<style>
		.refresh-log ul{margin:10px 0 0 0;}
		.refresh-log ul em{font-style:normal; float:right;}
		</style>
		<div class="row">
			<div class="col-lg-6">
				<div class="alert alert-info refresh-log">
					<h4><i class="fa fa-refresh"></i> 更新日志</h4>
					<ul class="list-unstyled">
					<script type="text/javascript" src="http://www.efwww.com/api.php?mod=js&bid=18"></script>
					</ul>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="alert alert-info refresh-log">
					<h4><i class="fa fa-bullhorn"></i> 易福源码Weizan版本信息</h4>

<div class="clearfix">
	<div style="padding:15px;">
		<?php  if($op == 'display') { ?>
<!--版本信息-->

<div class="box">

    <div style="line-height:28px;margin-top:8px;">

    <li>服务器环境：<?php  echo PHP_OS;?><?php  echo $_SERVER['SERVER_SOFTWARE'];?></li>
	<li>PHP版本:<?php  echo PHP_VERSION;?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Zend版本：<?php  $zend_version = zend_version();if(empty($zend_version)){echo '<font color=red>×</font>';}else{echo $zend_version;}?>&nbsp;&nbsp;&nbsp;MySql:<?php  echo mysql_get_server_info();?>|&nbsp;&nbsp;&nbsp;服务端口：<?php  echo $_SERVER['SERVER_PORT'];?></li>
     <li>服务器域名/IP：<?php  echo $_SERVER['SERVER_NAME'];?>/<?php  if('/'==DIRECTORY_SEPARATOR){echo $_SERVER['SERVER_ADDR'];}else{echo @gethostbyname($_SERVER['SERVER_NAME']);} ?></li>
    <li>当前网站语言：<?php  echo getenv("HTTP_ACCEPT_LANGUAGE");?></li>
    <li>官方网站：<a href="http://www.efwww.com" class="blue">易福源码网</a></li>
    <li><font color="red">【当前系统版本】：易福源码Weizan-<?php  echo $ver;?></font></li>
	<?php  if($lastver == $ver) { ?>
	<li><font color="red">【最新系统版本】：易福源码Weizan-<?php  echo $ver;?> （恭喜, 你的程序已经升级至<?php  echo $lastver;?>版本）</font></li>
	<?php  } ?>
	<?php  if($lastver != $ver) { ?>
	<li><font color="red">【下一系统版本】：易福源码Weizan-<?php  echo $lastver;?> </font>&nbsp;&nbsp;<button onclick="chanage();" class="btn btn-primary">查看版本</button></li><br>
	<script type="text/javascript">
		function chanage()
		  {
			location = "<?php  echo create_url('cloud/up',array('op'=>'chanage'));?>";
		}
		</script>
	<?php  } ?>

<div class="alert alert-danger">
 <?php  if($domain_time == '0') { ?><i class="fa fa-exclamation-triangle"></i> 授权版本：授权已过期，请联系QQ:<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=63779278&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:63779278:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a><!-- WPA Button Begin -->
<script charset="utf-8" type="text/javascript" src="http://wpa.qq.com/msgrd?v=3&uin=63779278&site=qq&menu=yes"></script>
<!-- WPA Button End -->
        <?php  } else { ?>
     <i class="fa fa-refresh"></i>【授权版本】：易福源码Weizan商业至尊版 &nbsp; 更新服务截止：(<?php  echo date("Y-m-d", $domain_time);?>)
		 <?php  } ?>
		</div>
<div class="alert alert-danger">
		<i class="fa fa-exclamation-triangle"></i>更新时请注意备份网站数据和相关数据库文件！<b>易福源码网</b>不强制要求用户跟随官方意愿进行更新尝试！
	</div>
    </div>
</div>
<!--论坛动态-->
<!--论坛动态end-->
<?php  } ?>
<?php  if($op == 'chanage') { ?>
<!--更新信息-->
<div class="box">
	<h3><i class="fa fa-refresh"></i>待更新的升级包</h3>
    <div style="line-height:20px;margin-top:8px;">
	<p class="red"><i class="fa fa-refresh"></i> [待更新的程序版本]：易福源码Weizan- <?php  echo $lastver;?> &nbsp;&nbsp;<button onclick="disp_confirm();" class="btn btn-primary" >在线升级</button></p>
    <script type="text/javascript">
		function disp_confirm()
		  {
		  var r=confirm("确定已备份好系统，并更新系统到最新版本吗？")
		  if (r==true)
			{
			location = "<?php  echo create_url('cloud/up',array('op'=>'update'));?>";
			}
		  }
		function alert(title) {
            $("#windowcenter").slideToggle("slow");
            $("#txt").html(title);
            setTimeout('$("#windowcenter").slideUp(500)', 4000);
        } 
		</script>
	<br/>
	<div class="alert alert-danger">
		<i class="fa fa-refresh"></i> [本次更新的内容]：<?php  echo $cinfo;?>
        </div>	
    </div>
</div>
<?php  } ?></div>
</div>	
				</div>
			</div>
		</div>
	</div>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>
