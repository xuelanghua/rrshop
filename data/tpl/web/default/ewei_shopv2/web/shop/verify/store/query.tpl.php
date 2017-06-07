<?php defined('IN_IA') or exit('Access Denied');?><div style='max-height:500px;overflow:auto;min-width:850px;'>
<table class="table table-hover" style="min-width:850px;">
    <tbody>   
        <?php  if(is_array($ds)) { foreach($ds as $row) { ?>
        <tr>
            <td><?php  echo $row['storename'];?></td>
            <td style="width:80px;"><a href="javascript:;" onclick='biz.selector.set(this, <?php  echo json_encode($row);?>)'>选择</a></td>
        </tr>
        <?php  } } ?>
        <?php  if(count($ds)<=0) { ?>
        <tr>
            <td colspan='2' align='center'>未找到门店, 点击<a href="<?php  echo webUrl('shop/verify/store/add')?>" target='_blank'>【创建门店】</a></td>
        </tr>
		<?php  } ?>
        
    </tbody>
</table>
</div>