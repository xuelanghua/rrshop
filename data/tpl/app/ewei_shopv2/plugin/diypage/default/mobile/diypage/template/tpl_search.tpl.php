<?php defined('IN_IA') or exit('Access Denied');?><div class="fui-searchbar bar" style="z-index: 0;">
    <div class="searchbar" style="background: <?php  echo $diyitem['style']['background'];?>; padding: <?php  echo $diyitem['style']['paddingtop'];?>px <?php  echo $diyitem['style']['paddingleft'];?>px;">
            <form action="<?php echo empty($diyitem['params']['goodstype']) ? mobileUrl('goods', array('merchid'=>$page['merch'])) : mobileUrl('creditshop/lists')?>" method="post" style="position: relative;left:0;top:0;">
                <input type="submit" class="searchbar-cancel searchbtn" value="搜索" style="top: 0; right: 0" />
                <div class="search-input <?php  echo $diyitem['style']['searchstyle'];?>" style="background: <?php  echo $diyitem['style']['inputbackground'];?>;">
                    <i class="icon icon-search" style="color: <?php  echo $diyitem['style']['iconcolor'];?>;"></i>
                    <input type="search" placeholder="<?php  echo $diyitem['params']['placeholder'];?>" class="search" name="keywords"
                           style="text-align: <?php  echo $diyitem['style']['textalign'];?>; color: <?php  echo $diyitem['style']['color'];?>; background: none;" />
                </div>
            </form>
    </div>
</div>