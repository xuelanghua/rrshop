<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'><?php  echo $this->plugintitle?></div>

<?php if(cv('globonus.partner|globonus.level')) { ?>
<ul>
    <?php if(cv('globonus.partner')) { ?><li <?php  if($_W['routes']=='globonus.partner') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/partner')?>">股东管理</a></li><?php  } ?>
    <?php if(cv('globonus.level')) { ?><li <?php  if($_W['routes']=='globonus.level') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/level')?>">股东等级</a></li><?php  } ?>
</ul>
<?php  } ?>

<style type='text/css'>
    .globonus-list a {
        position: relative;
    }
    .globonus-list span  {

        float:right;margin-right:20px;
    }
</style>

<?php if(cv('globonus.bonus.status0|globonus.bonus.status1|globonus.bonus.status2|globonus.bonus.build')) { ?>

<?php  $totals = $this->model->getTotals()?>
<div class='menu-header'>结算单</div>
<ul class="globonus-list">

    <?php if(cv('globonus.bonus.status0')) { ?><li <?php  if(($_W['routes']=='globonus.bonus.status0') || ($_W['routes']=='globonus.bonus.detail' && $data['status']==0)) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/bonus/status0')?>">待确认 <span  class='text-cancel'  id="total0">-</span></a></li><?php  } ?>
    <?php if(cv('globonus.bonus.status1')) { ?><li <?php  if(($_W['routes']=='globonus.bonus.status1') || ($_W['routes']=='globonus.bonus.detail' && $data['status']==1)) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/bonus/status1')?>">待结算 <span  class='text-danger' id="total1">-</span></a></li><?php  } ?>
    <?php if(cv('globonus.bonus.status2')) { ?><li <?php  if(($_W['routes']=='globonus.bonus.status2') || ($_W['routes']=='globonus.bonus.detail' && $data['status']==2)) { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/bonus/status2')?>">已结算 <span  class='text-success' id="total2">-</span></a></li><?php  } ?>
    <?php if(cv('globonus.bonus.build')) { ?><li <?php  if($_W['routes']=='globonus.bonus.build') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/bonus/build')?>">创建结算单</a></li><?php  } ?>
</ul>
<?php  } ?>

<?php if(cv('globonus.cover|globonus.notice|globonus.set')) { ?>
<div class="menu-header">设置</div>
<ul>
    <?php if(cv('globonus.cover')) { ?><li <?php  if($_W['routes']=='globonus.cover') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/cover')?>">入口设置</a></li><?php  } ?>
    <?php if(cv('globonus.notice')) { ?><li <?php  if($_W['routes']=='globonus.notice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/notice')?>">通知设置</a></li><?php  } ?>
    <?php if(cv('globonus.set')) { ?><li <?php  if($_W['routes']=='globonus.set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('globonus/set')?>">基础设置</a></li><?php  } ?>
</ul>

<?php  } ?>

<script>
    $(function () {
        $.ajax({type: "GET",async: false,url: "<?php  echo webUrl('globonus/bonus/totals')?>",dataType:"json",success: function(data){
            var res = data.result;
            $("#total0").text(res.total0);
            $("#total1").text(res.total1);
            $("#total2").text(res.total2);
        }
        });
    });
</script>