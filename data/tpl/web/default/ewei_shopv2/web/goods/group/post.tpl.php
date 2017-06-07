<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .multi-item {margin-bottom: 18px;}
</style>
<div class="page-heading">
    <span class="pull-right">
        <a class="btn btn-default btn-sm" href="<?php  echo webUrl('goods/group')?>"><i class="fa fa-reply"></i> 返回列表</a>
    </span>
    <h2><?php  if(!empty($item)) { ?>编辑<?php  } else { ?>新建<?php  } ?>商品组 <small><?php  if(!empty($item)) { ?>(名称: <?php  echo $item['name'];?>)<?php  } ?></small></h2>
</div>

<form <?php if( ce('goods.group' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-validate form-horizontal ">

    <div class="form-group">
        <label class="col-sm-2 control-label">商品组名称</label>
        <div class="col-sm-9">
            <?php if( ce('goods.group' ,$item) ) { ?>
                <input type="text" class="form-control valid" name="name" value="<?php  echo $item['name'];?>" data-rule-required="true" placeholder="请输入商品组名称" />
            <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['name'];?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">商品组状态</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('goods.group' ,$item) ) { ?>
                <label class="radio-inline">
                    <input type="radio" name="enabled" value="1" <?php  if($item['enabled']==1) { ?>checked="checked"<?php  } ?>> 启用
                </label>
                <label class="radio-inline">
                    <input type="radio" name="enabled" value="0" <?php  if($item['enabled']==0 || empty($item)) { ?>checked="checked"<?php  } ?>> 禁用
                </label>
            <?php  } else { ?>
                <div class='form-control-static'><?php  if($item['enabled']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">组内商品</label>
        <div class="col-sm-9">
            <div class="form-group" style="height: auto; display: block;">
                <div class="col-sm-12 col-xs-12">
                    <?php if( ce('goods.group' ,$item) ) { ?>
                        <?php  echo tpl_selector('goodsids',array('preview'=>true,'readonly'=>true, 'required'=>'true', 'multi'=>1,'url'=>webUrl('goods/query'),'items'=>$goods,'buttontext'=>'选择商品','placeholder'=>'请选择商品'))?>
                    <?php  } else { ?>
                        <div class="input-group multi-img-details container ui-sortable">
                            <?php  if(is_array($goods)) { foreach($goods as $item) { ?>
                            <div data-name="goodsid" data-id="426" class="multi-item">
                                <img src="<?php  echo tomedia($item['thumb'])?>" class="img-responsive img-thumbnail">
                                <div class="img-nickname"><?php  echo $item['title'];?></div>
                            </div>
                            <?php  } } ?>
                        </div>
                    <?php  } ?>
                </div>
            </div>

        </div>
    </div>

    <table class='table'>
        <tr>
            <td>
                <?php if( ce('goods.group' ,$item) ) { ?>
                    <input type="submit" class="btn btn-primary" value="保存">
                <?php  } ?>
            </td>
        </tr>
        </tbody>
    </table>

</form>

<?php if( ce('goods.group' ,$item) ) { ?>
    <script language="javascript">
        require(['jquery.ui'],function(){
            $('.multi-img-details').sortable();
        })
    </script>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>