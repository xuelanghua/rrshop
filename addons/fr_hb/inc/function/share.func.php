<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');

function getShareByPacketId($packet_id) {
    global $_W;
    if (empty($packet_id)) {
        return array();
    }
    $id = intval($packet_id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename('fr_hb_share') . " WHERE packet_id = :packet_id AND uniacid = :uniacid ORDER BY id DESC LIMIT 1";
    $params = array(":packet_id" => $id, ":uniacid" => $uniacid);
    $item = pdo_fetch($sql, $params);
    return $item;
}

function checkShareOpenid($packet_id, $openid = '') {
    global $_W;
    if (empty($packet_id)) {
        return array();
    }
    if (empty($openid)) {
        $openid = $_W['openid'];
    }
    $id = intval($packet_id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename('fr_hb_share') . " WHERE packet_id = :packet_id AND uniacid = :uniacid AND share_openid = :openid ORDER BY id DESC LIMIT 1";
    $params = array(":packet_id" => $id, ":uniacid" => $uniacid, ":openid" => $openid);
    $item = pdo_fetch($sql, $params);
    return empty($item);
}

/**
 * 发放分享奖励
 * @param type $openid
 * @param type $project
 * @return type
 */
function sendShareReward($openid, $project) {
    $money = $project['share_money'] / 100;
    if ($project['share_type'] == 1) {
        return addIntegral($openid, $money, "恭喜您，您分享{$project['title']}获得积分奖励：{$money}");
    }else if($project['share_type'] == 2) {
        return addBalance($openid, $money,  "恭喜您，您分享{$project['title']}获得余额奖励：{$money}");
    }else if($project['share_type'] == 3) {
        $res = sendWeixinRedPacket($openid, $project['share_money'],  "恭喜您，您分享{$project['title']}获得现金红包：{$money}元", $project['title'], "记得分享给您的朋友哦");
        if (is_error($res)){
            return false;
        }else {
            return true;
        }
    }else if($project['type'] == 4) {
        $card = getCardId($project['share_card_id']);
        if (empty($card)) {
            return false;
        }
        $res = sendWeixinCard($openid, $card['card_id'],  "获得{$project['title']}卡券:{$card['title']}");
        if (is_error($res)){
            WeUtility::logging('waring', "fr_hb--{$res['message']}");
            return false;
        }else {
            return true;
        }
    }
}

function addShareView($share_openid, $packet_id) {
    if ($share_openid && $packet_id) {
        $sql = "UPDATE ".  tablename('fr_hb_share')." SET `view` = `view`+1 WHERE (`share_openid`='{$share_openid}' AND `packet_id`='{$packet_id}')";
        pdo_query($sql);
    }
}