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
$table_name = 'fr_hb_draw';
$log_table_name = 'fr_hb_draw_log';

$token = $_GPC['token'];
$share_openid = $_GPC['share_openid'];
$packet = getPacketByToken($token);
$bg = __IMG__ . '/draw.jpg';
$tips_bg = __IMG__ . '/tips.jpg';
$share_bg = __IMG__ . '/share.png';
if (!empty($packet)) {
    if ($share_openid != $openid) {
        //增加分享链接点击次数
        addShareView($share_openid, $packet['id']);
    }
    $log = getDrawLog($openid, $packet['id']);
    $isDraw = check_draw($openid, $packet['id']);//是否未抽奖
    $project = getProjectById($packet['project_id']);
    $bg = $project['draw_bg'] ? toimage($project['draw_bg']) : toimage($bg);
    $tips_bg = $project['tips_bg'] ? toimage($project['tips_bg']) : toimage($tips_bg);
    $share_bg = $project['share_bg'] ? toimage($project['share_bg']) : toimage($share_bg);
    //项目未开始
    if (empty($project) || $project['start_time'] > TIMESTAMP || $project['end_time'] < TIMESTAMP) {
        $tips = '活动已结束';
        $template = 'tips';
    }else{
        $draws = getDraw($packet['project_id']);
        if (!empty($log) && $log['status'] == 0) {
            $qrcode = genDrawQrcode($log['id']);
        }
        if (!empty($draws)) {
            $total = 0;
            for($i=0; $i<count($draws); $i++) {
                if ($i % 2 == 0) {
                    $draws[$i]['colors'] = '#cc4d00';
                    $draws[$i]['font_colors'] = '#f9d414';
                }else {
                    $draws[$i]['colors'] = '#f9d414';
                    $draws[$i]['font_colors'] = '#cc4d00';
                }
                $draws[$i]['index'] = $i + 1;
                if ($draws[$i]['draw'] == 1) {
                    $total += $draws[$i]['surplus'];
                }
            }
            $act = trim($_GPC['act']);
            if ($act == 'draw' && $isDraw) {
                $index = getReward($draws, $total);//抽奖
                if ($index === false || empty($draws[$index-1])) {
                    $return = array(
                        'type' => 0,
                        'msg' => '您来晚了，奖品已被抽完。'
                    );
                                        
                    echo json_encode($return);exit;
                }
                $draw_id = $draws[$index-1]['id'];
                reduceDrawNumbers($draw_id);//减少奖品数量1
                if (sendDrawReward($openid, $draws[$index-1], $project, $isFollow)){
                    $money = $draws[$index-1]['prize'] / 100;
                    $msg = '';
                    //发信息通知用户
                    if ($draws[$index-1]['type'] == 1) {
                        $url = murl('mc/bond/credits', array('credittype' => 'credit1'), false, true);
                        $msg = "恭喜您,抽中奖品“{$draws[$index-1]['name']}”获得积分奖励：{$money}<a href='{$url}'>查看</a>";
                    }
                    elseif($draws[$index-1]['type'] == 2) {
                        $url = murl('mc/bond/credits', array('credittype' => 'credit2'), false, true);
                        $msg = "恭喜您,抽中奖品“{$draws[$index-1]['name']}”获得余额奖励：{$money}<a href='{$url}'>查看</a>";
                    }
                    elseif($draws[$index-1]['type'] == 3){
                        $msg = "恭喜您,抽中奖品“{$draws[$index-1]['name']}”获得现金红包：{$money}元，请到您的微信钱包查看。";
                    }
                    elseif($draws[$index-1]['type'] == 4){
                        $msg = "恭喜您,抽中奖品“{$draws[$index-1]['name']}”获得卡券，请到您的微信卡包查看。";
                    }
                    sendNotice($_W['account']['acid'], $openid, $msg);
                }
                
                if (!empty($openid) && $share_openid != '' && $openid != $share_openid && $project['share_money'] > 0) {//发送分享奖励
                    sendShareReward($share_openid, $project);
                    $money = $project['share_money'] / 100;
                    $msg = '';
                    //发信息通知用户
                    if ($project['share_type'] == 1) {
                        $url = murl('mc/bond/credits', array('credittype' => 'credit1'), false, true);
                        $msg = "恭喜您,分享{$project['title']}积分奖励：{$money}<a href='{$url}'>查看</a>";
                    }elseif($project['share_type'] == 2) {
                        $url = murl('mc/bond/credits', array('credittype' => 'credit2'), false, true);
                        $msg = "恭喜您,分享{$project['title']}余额奖励：{$money}<a href='{$url}'>查看</a>";
                    }elseif($project['share_type'] == 3){
                        $msg = "恭喜您,分享{$project['title']}现金红包奖励：{$money}元，请到您的微信钱包查看。";
                    }elseif($draws[$index-1]['type'] == 4){
                        $msg = "恭喜您,抽中奖品“{$draws[$index-1]['name']}”获得卡券，请到您的微信卡包查看。";
                    }
                    sendNotice($_W['account']['acid'], $share_openid, $msg);
                }
                //保存抽奖记录
                $log_datas = array(
                    'uniacid' => $uniacid,
                    'project_id' => $packet['project_id'],
                    'packet_id' => $packet['id'],
                    'draw_id' => $draw_id,
                    'openid' => $openid,
                    'createtime' => TIMESTAMP,
                    'status' => $isFollow ? 1 : 0
                );
                pdo_insert($log_table_name, $log_datas);//保存抽奖记录
                $log_id = pdo_insertid();
                $isz = true;
                if ($draws[$index-1]['prize'] > 0 && $draws[$index-1]['type'] != 4) {
                    $info = '恭喜您抽中了'.$draws[$index-1]['name'];
                }elseif ($draws[$index-1]['type'] == 4 && !empty($draws[$index-1]['card_id'])) {
                    $info = '恭喜您抽中了'.$draws[$index-1]['name'];
                }else {
                    $isz = false;
                    $info = '谢谢参于';
                }
                if ($isz && !$isFollow) {
                    $qrcode = genDrawQrcode($log_id);
                    $return = array(
                        'type' => 2,
                        'msg' => 'OK',
                        'info' => $info,
                        'index' => $index,
                        'qrcode' => $qrcode ? $qrcode : '',
                    );
                }else{
                    $return = array(
                        'type' => 1,
                        'msg' => 'OK',
                        'info' => $info,
                        'index' => $index
                    );
                }
                echo json_encode($return);exit;
            }
            $template = 'draw';
        }else{
            WeUtility::logging('waring', "fr_hb--{$project['title']}未设置抽奖礼品");
            $tips = '活动未设置抽奖礼品';
            $template = 'tips';
        }
    }
}else {
    $tips = '活动已结束';
    $template = 'tips';
}
$title = $project['title'];
$_share['title'] = replaceShareInfo($project['share_title']);
$_share['imgUrl'] = $project['share_thumb'] ? toimage($project['share_thumb']) : getMemberAvatar();
$_share['desc'] = replaceShareInfo($project['share_content']);
$_share['link'] = __MURL('draw', array('token' => $token, 'share_openid' => $openid), false, TRUE);
include $this->template($template);