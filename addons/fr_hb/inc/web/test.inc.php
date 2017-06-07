<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
include MODULE_ROOT . '/inc/common.php';
global $_GPC, $_W;
$uniacid = $_W["uniacid"];

$act = trim($_GPC['act']);
if ($_W['ispost'] && $act) {
    if ($act == 'card') {
        $openid = trim($_GPC['openid']);
        $card_id = trim($_GPC['card_id']);
        $res = sendWeixinCard($openid, $card_id);
        if (is_error($res)) {
            message($res['message']);
        }else{
            message('发送成功');
        }
    }elseif($act == 'packet') {
        $openid = trim($_GPC['openid']);
        $res = sendWeixinRedPacket($openid, 100, "测试祝福语", "测试活动名称", "测试备注", '', true);
        if (is_error($res)) {
            message($res['message']);
        }else{
            message('发送成功');
        }
    }
}
include $this->template('web/test');