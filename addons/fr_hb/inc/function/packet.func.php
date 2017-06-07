<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');

/**
 * 打开红包
 * @param type $openid
 * @param type $packet
 * @param type $project
 */
function openPacket($openid, $packet, $project, $isFollow = true) {
    if ($isFollow == false && $project['is_follow'] == 1) {
        return true;
    }
    $money = $packet['money'] / 100;
    if ($project['type'] == 1) {
        return addIntegral($openid, $money, "获得{$project['title']}积分红包：{$money}");
    }else if($project['type'] == 2) {
        return addBalance($openid, $money,  "获得{$project['title']}余额红包：{$money}");
    }else if($project['type'] == 3) {
        $res = sendWeixinRedPacket($openid, $packet['money'],  "恭喜获得{$project['title']}红包：{$money}元", $project['title'], "记得分享给您的朋友哦");
        if (is_error($res)){
            WeUtility::logging('waring', "fr_hb--{$res['message']}");
            return false;
        }else {
            return true;
        }
    }else if($project['type'] == 4) {
        $card = getCardId($packet['card_id']);
        if (empty($card)) {
            return false;
        }
        $res = sendWeixinCard($openid, $packet['card_id'],  "获得{$project['title']}卡券:{$card['title']}");
        if (is_error($res)){
            WeUtility::logging('waring', "fr_hb--{$res['message']}");
            return false;
        }else {
            return true;
        }
    }
}

/**
 * 格式化奖品数据
 * @param type $money
 * @param type $type
 * @return string
 */
function format_prize($money, $type) {
    $money = $money / 100;
    switch ($type) {
        case 1:
            $text = $money . "积分红包";
            break;
        case 2:
            $text = $money . "元余额红包";
            break;
        case 3:
            $text = $money . "元现金红包";
            break;
    }
    return $text;
}


/**
 * 获取项目已生成红包总数
 * @global type $_W
 * @param type $project_id
 * @return int
 */
function getPacketCount($project_id) {
    global $_W;
    if (empty($project_id)) {
        return 0;
    }
    $id = intval($project_id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT count(*) FROM ". tablename('fr_hb_packet') . " WHERE project_id = :project_id AND uniacid = :uniacid";
    $params = array(":project_id" => $id, ":uniacid" => $uniacid);
    $item = pdo_fetchcolumn($sql, $params);
    return $item;
}
/**
 * 获取项目已生成红包总数
 * @global type $_W
 * @param type $project_id
 * @return int
 */
function getCardIdPacketCount($project_id, $card_id) {
    global $_W;
    if (empty($project_id) || empty($card_id)) {
        return 0;
    }
    $id = intval($project_id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT count(*) FROM ". tablename('fr_hb_packet') . " WHERE project_id = :project_id AND card_id = :card_id AND uniacid = :uniacid";
    $params = array(":project_id" => $id, ":uniacid" => $uniacid, ":card_id" => $card_id);
    $item = pdo_fetchcolumn($sql, $params);
    return $item;
}
/**
 * 获取所有红包
 * @global type $_W
 * @param type $project_id
 * @return type
 */
function getPacketAll($project_id, $offset = 0) {
    global $_W;
    if (empty($project_id)) {
        return array();
    }
    $id = intval($project_id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename('fr_hb_packet') . " WHERE project_id = :project_id AND uniacid = :uniacid LIMIT {$offset}, 10000";
    $params = array(":project_id" => $id, ":uniacid" => $uniacid);
    $result = pdo_fetchall($sql, $params);
    return $result;
}
/**
 * 获取红包状态
 * @param type $status
 * @param type $start
 * @param type $end
 * @return string
 */
function getPacketStatus($status, $start, $end) {
    if ($status == -1) {
        return '已失效';
    }
    if ($status == 1) {
        return '已领取';
    }
    return '未领取';
//    if ($start > TIMESTAMP) {
//        return '未领取';
//    }
//    if ($end < TIMESTAMP) {
//        return '已过期';
//    }
}


/**
 * 获取红包详情
 * @param type $id
 * @return type
 */
function getPacketById($id) {
    return getDataById('fr_hb_packet', $id);
}
/**
 * 获取红包详情
 * @global type $_W
 * @param type $token
 * @return boolean
 */
function getPacketByToken($token) {
    global $_W;
    if (empty($token)) {
        return FALSE;
    }
    $token = trim($token);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename('fr_hb_packet') . " WHERE token = :token AND uniacid = :uniacid";
    $params = array(":token" => $token, ":uniacid" => $uniacid);
    $item = pdo_fetch($sql, $params);
    return $item;
}

/**
 * 获取领取红包记录
 * @param type $id
 */
function getPacketReceive($id) {
    global $_W;
    if (empty($id)) {
        return FALSE;
    }
    $id = intval($id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename('fr_hb_receive') . " WHERE packet_id = :packet_id AND uniacid = :uniacid";
    $params = array(":packet_id" => $id, ":uniacid" => $uniacid);
    $item = pdo_fetch($sql, $params);
    return $item;
}

/**
 * 获取项目未生成二维码图片的红包总数
 * @global type $_W
 * @param type $project_id
 * @return int
 */
function getPacketNoqrcCount($project_id) {
    global $_W;
    if (empty($project_id)) {
        return 0;
    }
    $id = intval($project_id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT count(*) FROM ". tablename('fr_hb_packet') . " WHERE project_id = :project_id AND uniacid = :uniacid AND isqrc = :isqrc";
    $params = array(":project_id" => $id, ":uniacid" => $uniacid, ":isqrc" => 0);
    $item = pdo_fetchcolumn($sql, $params);
    return $item;
}