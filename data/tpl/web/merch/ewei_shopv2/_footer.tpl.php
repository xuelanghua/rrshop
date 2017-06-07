<?php defined('IN_IA') or exit('Access Denied');?></div>
<script language='javascript'>
    require(['bootstrap'], function ($) {
        $('[data-toggle="tooltip"]').tooltip({
            container: $(document.body)
        });
        $('[data-toggle="popover"]').popover({
            container: $(document.body)
        });
    });
    $(function () {
        $('.page-content').show();
        $('.img-thumbnail').each(function () {
            if ($(this).attr('src').indexOf('nopic.jpg') != -1) {
                $(this).attr('src', "<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic.jpg");
            }
        })
    });
</script>
<script language="javascript">myrequire(['web/init']);</script>
<script language="javascript">myrequire(['../../plugin/merch/static/js/manage/init']);</script>
<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
<?php  if(!empty($copyright) && !empty($copyright['copyright'])) { ?>
<div class="footer" style='width:100%;'>
    <div><?php  echo $copyright['copyright'];?></div>
</div>
<?php  } ?>
</body>
</html>
