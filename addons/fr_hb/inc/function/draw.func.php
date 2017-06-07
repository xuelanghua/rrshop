<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
/**
 * 抽奖
 * @param int $total
 */
function getReward($draws, $total = 10000) {
    $wins = array();
    $total = $total > 10000 ? 10000 : $total;
    $win_total = 0;
    foreach($draws as $item) {
        if ($item['surplus'] <= 0 || $item['draw'] == 0) {
            continue;
        }
        if (($item['prize'] > 0 && $item['type'] != 4) || ($item['card_id'] != '' && $item['type'] == 4)) {
            $item['chance'] = $item['chance'] > 100 ? 100 : $item['chance'];
            $item['chance'] = $item['chance'] < 0 ? 0 : $item['chance'];
            $wins[$item['index']] = floor(($item['chance']*$total)/100);
            $win_total += $wins[$item['index']];
        }else {
            $others[] = $item['index'];
        }
    }
    if (empty($wins)) {
       return false; 
    }
    $other = $total-$win_total;
    $return = array();
    foreach ($wins as $index => $win) {
        for ($i = 0; $i < $win; $i++) {
            $return[] = $index;
        }
    }
    if (!empty($others)) {
        for ($n=0; $n<$other; $n++) {
            $return[] = $others[array_rand($others)];
        } 
    }
    shuffle($return);
    return $return[array_rand($return)];
}

/**
 * 获取项目奖品列表
 * @param type $project_id
 */
function getDraw($project_id) {
    global $_W;
    if (empty($project_id)) {
        return array();
    }
    $id = intval($project_id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename('fr_hb_draw') . " WHERE project_id = :project_id AND uniacid = :uniacid AND status = 1 ORDER BY sort ASC";
    $params = array(":project_id" => $id, ":uniacid" => $uniacid);
    $item = pdo_fetchall($sql, $params);
    return $item;
}
/**
 * 奖品数量减一
 * @param type $draw_id
 */
function reduceDrawNumbers($draw_id){
    if ($draw_id) {
        $sql = "UPDATE ".  tablename('fr_hb_draw')." SET `surplus` = `surplus`-1 WHERE (`id`='{$draw_id}')";
        pdo_query($sql);
    }
}

function check_draw($openid, $packet_id) {
    global $_W;
    $item = getDrawLog($openid, $packet_id);
    $receive = getPacketReceive($packet_id);
    return empty($item) && $receive['openid'] != $openid;
}
function getDrawLog($openid, $packet_id) {
    global $_W;
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename('fr_hb_draw_log') . " WHERE packet_id = :packet_id AND openid = :openid AND uniacid = :uniacid";
    $params = array(":packet_id" => $packet_id, ":openid" => $openid, ":uniacid" => $uniacid);
    $item = pdo_fetch($sql, $params);
    return $item;
}

/**
 * 发放分享奖励
 * @param type $openid
 * @param type $project
 * @return type
 */
function sendDrawReward($openid, $draw, $project, $isFollow) {
    if ($isFollow == false && $project['is_follow'] == 1) {
        return true;
    }
    if (empty($draw['id'])) {
        return false;
    }
    $money = $draw['prize'] / 100;
    if ($draw['type'] == 1) {
        return addIntegral($openid, $money, "抽中奖品“{$draw['name']}”获得积分奖励：{$money}");
    }else if($draw['type'] == 2) {
        return addBalance($openid, $money,  "抽中奖品“{$draw['name']}”获得余额奖励：{$money}");
    }else if($draw['type'] == 3) {
        $res = sendWeixinRedPacket($openid, $draw['prize'], "恭喜抽中奖品“{$draw['name']}”获得现金红包：{$money}元", $project['title'], "记得分享给您的朋友哦");
        if (is_error($res)){
            return false;
        }else {
            return true;
        }
    }else if($draw['type'] == 4) {
        $card = getCardId($draw['card_id']);
        if (empty($card)) {
            return false;
        }
        $res = sendWeixinCard($openid, $draw['card_id'],  "恭喜抽中奖品“{$draw['name']}”获得卡券:{$card['title']}");
        if (is_error($res)){
            WeUtility::logging('waring', "fr_hb--{$res['message']}");
            return false;
        }else {
            return true;
        }
    }
}