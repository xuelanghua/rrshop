<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header_base', TEMPLATE_INCLUDEPATH)) : (include template('_header_base', TEMPLATE_INCLUDEPATH));?>
<hr>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-11">
            <div class="search-form">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="search" placeholder="请输入微信公众号名称" name="keyword" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit">
                                搜索
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <?php  if($list) { ?>
            <?php  if(is_array($list)) { foreach($list as $uni) { ?>
            <?php  $subaccount = count($uni['details']);?>
            <div class="file-box" style='width:150px;cursor: pointer' onclick="location.href='<?php  echo webUrl('sysset/account/choose',array('uniacid' => $uni['uniacid']))?>'" title="点击切换">
                <div class="file">

                        <?php  if(is_array($uni['details'])) { foreach($uni['details'] as $account) { ?>
                        <span class="corner"></span>
                        <div class="icon" style="height: 120px; margin-bottom:10px;">
                            <img src="<?php  echo tomedia('headimg_'.$account['acid'].'.jpg');?>?time=<?php  echo time()?>" class="image" width="100" height="100"  onerror="this.src='resource/images/gw-wx.gif'" />
                        </div>
                        <div class="file-name" style="white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                            <?php  echo $account['name'];?>
                        </div>
                        <?php  } } ?>

                </div>
            </div>
            <?php  } } ?>
            <?php  } else { ?>
            没有公众号，<a href="/web/index.php?c=account&a=display">新建公众号</a>
            <?php  } ?>
        </div>

    </div>
    <?php  echo $pager;?>
</div>
 

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>