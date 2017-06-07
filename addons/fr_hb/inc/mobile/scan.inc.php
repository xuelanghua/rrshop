<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
include MODULE_ROOT . '/inc/common.php';
include MODULE_ROOT . '/inc/mobile/init.php';
global $_GPC, $_W;
$uniacid = $_W["uniacid"];
$openid = $_W['openid'];
$uid = $_W['member']['uid'];

$token = $_GPC['token'];
$isReceive = 999;
$template = "tips";
$tips = '';
$packet = getPacketByToken($token);
$bg = __IMG__ . '/index_bg.jpg';
$tips_bg = __IMG__ . '/tips.jpg';
$share_bg = __IMG__ . '/share.png';
if (!empty($packet)) {
    $project = getProjectById($packet['project_id']);
    $bg = $project['index_bg'] ? toimage($project['index_bg']) : toimage($bg);
    $tips_bg = $project['tips_bg'] ? toimage($project['tips_bg']) : toimage($tips_bg);
    $share_bg = $project['share_bg'] ? toimage($project['share_bg']) : toimage($share_bg);
}else {
    $isReceive = 0;
    $tips = "红包不存在或已失效";
}
//项目未开始
if ($project['start_time'] > TIMESTAMP) {
    $isReceive = 1;
    $tips = "该活动还未开始，活动开始时间：" . timeToStr($project['start_time']);
}
//项目已结束
if ($project['end_time'] < TIMESTAMP) {
    $isReceive = 2;
    $tips = "该活动还已结束<br>活动结束时间：" . timeToStr($project['end_time']);
}

//红包已被领取
if ($packet['status'] == 1) {
    $isReceive = 3;
    $receive = getPacketReceive($packet['id']);
    if ($receive['openid'] == $openid) {
        if ($receive['status'] == 0) {
            $isReceive = 5;
            $qrcode = genReceiveQrcode($receive['id']);
            $tips = "长按二维码领取奖品";
        }else{
            $tips = "该红包已被您于".  getChineseDate($receive['createtime'])."领取";
        }
    }else {
        $tips = "红包已被他人领取";
    }
}
//红包已失效
if ($packet['status'] == -1) {
    $isReceive = 4;
    $tips = "红包已失效";
}
if ($isReceive == 999 && !empty($openid)) {// 
     if ($_W['ispost'] && $_W['isajax'] ) {
        $frs = $_GPC['frs'];
        if ($frs == $_SESSION['fr_open_packet_session']) {
           $return = array(
               'error' => 0,
               'url' => __MURL('scan', array('token' => $token, 'frs' => md5($_SESSION['fr_open_packet_session'] . $token)), true, true)
           );
        }else {
           $return = array(
               'error' => 0,
               'msg' => '无权限！'
           );
        }
        echo json_encode($return);
        exit;
    }
    $frs = $_GPC['frs'];
    if ($frs ==  md5($_SESSION['fr_open_packet_session'] . $token)) {
        $template = "index";
        if ($project['type'] != 4) {
            $prize = format_prize($packet['money'], $project['type']);
        }else{
            $prize = "卡券";
        }
        if (openPacket($openid, $packet, $project, $isFollow)) {
            $_SESSION['fr_open_packet_session'] = null;
            //更新红包状态
            pdo_update('fr_hb_packet', array('status' => 1), array('id' => $packet['id']));
            //保存红包领取记录
            $receive = array(
                'uniacid' => $uniacid,
                'project_id' => $project['id'],
                'packet_id' => $packet['id'],
                'openid' => $openid,
                'ip' => CLIENT_IP,
                'createtime' => TIMESTAMP,
                'status' => $isFollow ? 1 : 0
            );
            pdo_insert('fr_hb_receive', $receive);
            $receive_id = pdo_insertid();
            if ($isFollow) {
                $money = $packet['money'] / 100;
                $msg = '';
                //发信息通知用户
                if ($project['type'] == 1) {
                    $url = murl('mc/bond/credits', array('credittype' => 'credit1'), false, true);
                    $msg = "恭喜您获得{$project['title']}积分红包：{$money}<a href='{$url}'>查看</a>";
                }elseif($project['type'] == 2) {
                    $url = murl('mc/bond/credits', array('credittype' => 'credit2'), false, true);
                    $msg = "恭喜您获得{$project['title']}余额红包：{$money}<a href='{$url}'>查看</a>";
                }elseif($project['type'] == 3){
                    $msg = "恭喜您获得{$project['title']}现金红包：{$money}元，请到您的微信钱包查看。";
                }elseif($project['type'] == 4){
                    $msg = "恭喜您获得{$project['title']}卡券，请到您的微信卡券查看。";
                }
                sendNotice($_W['account']['acid'], $openid, $msg);
            }else{
                $isReceive = 5;
                $qrcode = genReceiveQrcode($receive_id);
                $template = "tips";
            }
        }else {
            $tips = "出错了，请联系管理员！";
            $template = "tips";
        }    
    }else{
        $fr_open_packet_session = $_SESSION['fr_open_packet_session'] = md5($token . $openid);
        $template = "open";
    }
}
$title = $project['title'];
$_share['title'] = replaceShareInfo($project['share_title']);
$_share['imgUrl'] = $project['share_thumb'] ? toimage($project['share_thumb']) : getMemberAvatar();
$_share['desc'] = replaceShareInfo($project['share_content']);
$_share['link'] = __MURL('draw', array('token' => $token, 'share_openid' => $openid), false, TRUE);
include $this->template($template);