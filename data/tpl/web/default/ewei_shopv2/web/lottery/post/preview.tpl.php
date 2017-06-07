<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group ">
    <div class="col-lg-offset-2">
    </div>
    <div class="col-lg-10 ">
        <div class="phone center-block">
            <div class="phone-head"></div>
            <div class="phone-body" >
                <div id="lottery">
                    <?php  if($type==1) { ?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('lottery/post/zhuanpan', TEMPLATE_INCLUDEPATH)) : (include template('lottery/post/zhuanpan', TEMPLATE_INCLUDEPATH));?><?php  } ?>
                    <?php  if($type==2) { ?>
                    <script type="text/javascript">
                        function buildpan() {
                            return false;
                        }
                    </script>
                    <?php  } ?>
                    <?php  if($type==3) { ?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('lottery/post/jiugongge', TEMPLATE_INCLUDEPATH)) : (include template('lottery/post/jiugongge', TEMPLATE_INCLUDEPATH));?><?php  } ?>
                </div>
            </div>
            <div class="phone-foot"></div>
        </div>
    </div>
</div>
<script type="application/javascript">
    setInterval(function () {
        var banner_img = $('input[name="lottery_banner"]').val();
        $('.phone-body').css({'background': "url('"+banner_img+"')",'background-size':'100% 100%'});
    },100);
</script>