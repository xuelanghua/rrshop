<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page <?php  if(empty($order['refundstate'])) { ?>fui-page-current<?php  } ?>' id='page-refund-edit' >
<div class="fui-header">
    <div class="fui-header-left">
        <a class="back" onclick='history.back()'></a>
    </div>
    <div class="title"><?php  if($order['status']==1) { ?>退款<?php  } else { ?>售后<?php  } ?>申请</div>
    <div class="fui-header-right">&nbsp;</div>
</div>
<div class='fui-content margin navbar'>
    <div class="fui-cell-group">
        <div class="fui-cell">
            <div class="fui-cell-label">处理方式</div>
            <div class="fui-cell-info">

                <select id="rtype">
                    <?php  if($order['status']==2 || $order['status']==3) { ?>
                    <option value="1" <?php  if($refund['rtype']=='1') { ?>selected<?php  } ?>>退货退款</option>
                    <option value="2" <?php  if($refund['rtype']=='2') { ?>selected<?php  } ?>>换货</option>
                    <?php  } ?>
                    <option value="0" <?php  if($refund['rtype']=='0') { ?>selected<?php  } ?>>退款(仅退款不退货)</option>
                </select>
            </div>
            <div class="fui-cell-remark"></div>

        </div>
        <div class="fui-cell">
            <div class="fui-cell-label"><span class="re-g"><?php  if($refund['rtype']=='2') { ?>换货<?php  } else { ?>退款<?php  } ?></span>原因</div>
            <div class="fui-cell-info">

                <select id="reason">
                    <option value="不想要了" <?php  if($refund['reason']=='不想要了') { ?>selected<?php  } ?>>不想要了</option>
                    <option value="卖家缺货" <?php  if($refund['reason']=='卖家缺货') { ?>selected<?php  } ?>>卖家缺货</option>
                    <option value="拍错了/订单信息错误" <?php  if($refund['reason']=='拍错了/订单信息错误') { ?>selected<?php  } ?>>拍错了/订单信息错误</option>
                    <option value="其它" <?php  if($refund['reason']=='其它') { ?>selected<?php  } ?>>其它</option>
                </select>
            </div>
            <div class="fui-cell-remark"></div>
        </div>

        <div class="fui-cell">
            <div class="fui-cell-label"><span class="re-g"><?php  if($refund['rtype']=='2') { ?>换货<?php  } else { ?>退款<?php  } ?></span>说明</div>
            <div class="fui-cell-info">
                <input type="text" id="content" class='fui-input' placeholder="选填" value="<?php  echo $refund['content'];?>"/>
            </div>
        </div>

        <div class="fui-cell r-group" <?php  if($refund['rtype']=='2') { ?>style="display:none;"<?php  } ?>>
        <div class="fui-cell-label">退款金额</div>
        <div class="fui-cell-info">
            <input type="number" id="price" class='fui-input' value="<?php  echo $show_price?>" />
        </div>


    </div>
    <div class="fui-cell">
        <div class="fui-cell-label">上传凭证</div>
        <div class="fui-cell-info">

            <ul class="fui-images fui-images-sm" id="images">

                <?php  if(is_array($refund['imgs'])) { foreach($refund['imgs'] as $k => $v) { ?>
                <input type="hidden" name="images[]" value="<?php  echo $v;?>" />
                <li style="background-image:url(<?php  echo tomedia($v)?>)" class="image image-sm" data-filename="<?php  echo $v;?>"><span class="image-remove"><i class="icon icon-roundclose"></i></span></li>
                <?php  } } ?>


            </ul>
            <div class="fui-uploader fui-uploader-sm refund-container-uploader" <?php  if(count($refund['imgs'])==5) { ?>style='display:none'<?php  } ?>
            data-name="images[]"
            data-max="5"
            data-count="<?php  echo count($refund['imgs'])?>">
            <input type="file" name='imgFile0' id='imgFile0' multiple="" accept="image/*" >
        </div>

    </div>
</div>

<div class='fui-title r-group'  <?php  if($refund['rtype']=='2') { ?>style="display:none;"<?php  } ?>>
提示:您可退款的最大金额为 <span class='text-danger'>￥<?php  echo number_format($order['refundprice'],2)?></span>
</div>
</div>

</div>
<div class='fui-footer text-right'>
    <a class='btn btn-danger btn-submit'>提交申请</a>
    <a class="btn btn-default btn-default-o back">取消</a>
</div>
</div>

<div class='fui-page  <?php  if(!empty($order['refundstate'])) { ?>fui-page-current<?php  } ?>' id='page-refund-info'>
<div class="fui-header">
    <div class="fui-header-left">
        <a class="back" onclick='history.back()'></a>
    </div>
    <div class="title"><?php  if($order['status']==1) { ?>退款<?php  } else { ?>售后<?php  } ?>申请</div>
    <div class="fui-header-right">&nbsp;</div>
</div>
<div class='fui-content margin navbar'>
    <div class='fui-according-group'>
        <div class='fui-according expanded'>
            <div class='fui-according-header'>
                <i class='icon icon-info'></i>
					<span class="text"><?php  if($refund['status']==0) { ?>等待商家处理<?php  if($order['status']==1) { ?>退款<?php  } else { ?>售后<?php  } ?>申请<?php  } ?>
						<?php  if($refund['status']>=3) { ?>商家已经通过<?php  if($order['status']==1) { ?>退款<?php  } else { ?>售后<?php  } ?>申请<?php  } ?>
					</span>

                <div class='remark'></div>
            </div>
            <div class='fui-according-content'>
                <div class='content-block' style='font-size:.7rem;padding:.5rem .8rem'>
                    <?php  if($refund['rtype']==0) { ?>
                    <?php  if($refund['status']==0) { ?>
                    退款申请流程： <br>1、发起退款申请<br>2、商家确认后退款到您的账户
                    如果商家未处理：请及时与商家联系
                    <?php  } ?>
                    <?php  } else if($refund['rtype']==1) { ?>
                    退款退货申请流程：<br>1、发起退款退货申请<br>2、退货需将退货商品邮寄至商家指定地址，并在系统内输入快递单号<br>3、商家后货后确认无误<br>4、退款到您的账户
                    <?php  } else if($refund['rtype']==2) { ?>
                    换货申请流程：<br>1、发起换货申请，并把快递单号录入系统<br>2、将需要换货的商品邮寄至商家指定地址，并在系统内输入快递单号<br>3、商家确认后货后重新发出商品<br>4、签收确认商品
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>
    <?php  if($refund['status']>=3) { ?>

    <?php  if(!empty($refund['refundaddress'])) { ?>
    <div class="fui-list-group" style='margin-top:5px;'>
        <div class="fui-list-group-title"><i class='icon icon-location'></i> 退货地址</div>
        <div class="fui-list">
            <div class="fui-list-media"></div>
            <div class="fui-list-inner">
                <div class='text'><?php  echo $refund['refundaddress']['province'];?><?php  echo $refund['refundaddress']['city'];?><?php  echo $refund['refundaddress']['area'];?> <?php  echo $refund['refundaddress']['address'];?></div>
                <div class='subtitle'><?php  echo $refund['refundaddress']['name'];?> <?php  echo $refund['refundaddress']['mobile'];?> <?php  echo $refund['refundaddress']['tel'];?></div>
            </div>
        </div>
        <?php  if(!empty($refund['message'])) { ?>
        <div class="fui-list-group-title"><i class='icon icon-message'></i> 卖家留言</div>
        <div class="fui-list">
            <div class="fui-list-media"></div>
            <div class="fui-list-inner">
                <div class='text'><span class='text-danger'><?php  echo $refund['message'];?></span></div>

            </div>
        </div>
        <?php  } ?>



    </div>
    <?php  } ?>

    <?php  if($refund['rtype']==1 || $refund['rtype']==2) { ?>

    <div class="fui-cell-group">

        <a class="fui-cell <?php  if($refund['status']==3) { ?>fui-cell-click<?php  } ?>" <?php  if($refund['status']==3) { ?>href='#page-refund-express'<?php  } ?>>
        <div class="fui-cell-label"><?php  if($refund['rtype']==1) { ?>退货<?php  } else { ?>换货<?php  } ?>状态</div>
        <div class='fui-cell-info'></div>
        <div class='fui-cell-remark  <?php  if($refund['status']!=3) { ?>noremark<?php  } ?>'>
        <?php  if($refund['status']==3) { ?>
        需填写快递单号
        <?php  } else if($refund['status']==4) { ?>
        等待商家确认
        <?php  } else if($refund['status']==5) { ?>
        商家已经发货
        <?php  } ?></div>
    </a>

    <?php  if(!empty($refund['rexpresssn'])) { ?>
    <div class="fui-cell">
        <div class="fui-cell-label"><?php  if($refund['rtype']==1) { ?>退货<?php  } else { ?>换货<?php  } ?>快递公司</div>
        <div class='fui-cell-info'><?php  echo $refund['rexpresscom'];?></div>
    </div>
    <div class="fui-cell">
        <div class="fui-cell-label"><?php  if($refund['rtype']==1) { ?>退货<?php  } else { ?>换货<?php  } ?>快递单号</div>
        <div class='fui-cell-info'><?php  echo $refund['rexpresssn'];?></div>
    </div>
    <?php  } ?>
</div>
<?php  } ?>

<?php  } ?>

<div class="fui-cell-group">
    <div class='fui-cell-title'>协商详情</div>
    <div class="fui-cell">
        <div class="fui-cell-label">处理方式</div>
        <div class="fui-cell-info">
            <?php  if($refund['rtype']==0) { ?>
            退款
            <?php  } else if($refund['rtype']==1) { ?>
            退货退款
            <?php  } else { ?>
            换货<?php  } ?>
        </div>
    </div>
    <div class="fui-cell">
        <div class="fui-cell-label"><?php  if($refund['rtype']=='2') { ?>换货<?php  } else { ?>退款<?php  } ?>原因</div>
        <div class="fui-cell-info"><?php  echo $refund['reason'];?></div>
    </div>
    <div class="fui-cell">
        <div class="fui-cell-label"><?php  if($refund['rtype']=='2') { ?>换货<?php  } else { ?>退款<?php  } ?>说明</div>
        <div class="fui-cell-info"><?php  if(empty($refund['content'])) { ?>无<?php  } else { ?><?php  echo $refund['content'];?> <?php  } ?></div>
    </div>
    <?php  if($refund['applyprice']>0) { ?>
    <div class="fui-cell">
        <div class="fui-cell-label">退款金额</div>
        <div class="fui-cell-info"><?php  echo number_format($refund['applyprice'],2)?> 元</div>
    </div>
    <?php  } ?>

    <div class="fui-cell">
        <div class="fui-cell-label">申请时间</div>
        <div class="fui-cell-info"><?php  echo date('Y-m-d H:i',$refund['createtime'])?></div>
    </div>

</div>


</div>
<div class='fui-footer text-right'>
    <?php  if($refund['rtype']==2 && $refund['status']==5) { ?>
    <div class="btn btn-danger btn-receive">确认收到换货物品</div>
    <a external data-nocache="true" href="<?php  echo mobileUrl('order/refund/refundexpress',array('id'=>$order['id'], 'express'=>$refund['rexpress'], 'expresscom'=>$refund['expresscom'],'expresssn'=>$refund['rexpresssn']))?>"><div class="btn btn-primary">查看换货物流</div></a>
    <?php  } ?>

    <?php  if($refund['status']==3 || $refund['status']==4) { ?>
    <a data-nocache="true" class="btn btn-primary" href='#page-refund-express'><?php  if(empty($refund['express'])) { ?>填写<?php  } else { ?>修改<?php  } ?>快递单号</a>
    <?php  } ?>

    <?php  if($refund['status']==0) { ?>
    <a data-nocache="true" class='btn btn-danger btn-edit' href='#page-refund-edit'>修改申请</a>
    <?php  } ?>

    <?php  if($refund['status']!=5) { ?>
    <a class='btn btn-default-o btn-cancel'>取消申请</a>
    <?php  } ?>
</div>
</div>

<div class='fui-page' id='page-refund-express'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back" onclick='history.back()'></a>
        </div>
        <div class="title"><?php  if($order['status']==1) { ?>退款<?php  } else { ?>售后<?php  } ?>申请</div>
        <div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content margin'>
        <input type='hidden' id='express_old' value="<?php  echo $refund['express'];?>"/>
        <input type="hidden" name="expresscom" id="expresscom" value="<?php  echo $refund['expresscom'];?>">
        <div class="fui-cell-group">
            <div class='fui-cell-title'>填写快递单号</div>
            <div class="fui-cell">
                <div class="fui-cell-label">快递公司</div>
                <div class="fui-cell-info"><select id="express" name="express">
                    <option value="" data-name="其他快递">其他快递</option>

                    <?php  if(is_array($express_list)) { foreach($express_list as $value) { ?>
                    <option value="<?php  echo $value['express'];?>" data-name="<?php  echo $value['name'];?>"><?php  echo $value['name'];?></option>
                    <?php  } } ?>
                </select></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">快递单号</div>
                <div class="fui-cell-info"><input type="text" id="expresssn" class='fui-input' value="<?php  echo $refund['expresssn'];?>" max="50"/></div>
            </div>
        </div>

    </div>
    <div class='fui-footer text-right'>
        <div class="btn btn-danger" id='express_submit'>提交快递单号</div>
        <a class="btn btn-default btn-default-o back">返回</a>
    </div>




    <script language='javascript'>
        require(['biz/order/refund'], function (modal) {
            modal.init({orderid: "<?php  echo $orderid;?>",refundid:"<?php  echo $refundid;?>"});
        });

    </script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>