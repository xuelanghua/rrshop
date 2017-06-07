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
$packet = getPacketByToken($token);
if (!empty($packet)) {
    $project = getProjectById($packet['project_id']);
    //项目未开始
    if (empty($project) || $project['start_time'] > TIMESTAMP || $project['end_time'] < TIMESTAMP) {
        die('error');
    }
    if (checkShareOpenid($packet['id'], $openid)) {//判断数据库是否已经该用户的分享记录
        $share_log = getShareByPacketId($packet['id']);
        $share = array(
                'uniacid' => $uniacid,
                'project_id' => $project['id'],
                'packet_id' => $packet['id'],
                'share_openid' => $openid,
                'level' => empty($share_log) ? 1 : ($share_log['level'] + 1),
                'createtime' => TIMESTAMP
        );
        pdo_insert('fr_hb_share', $share);//保存红包分享记录
        //die('ok');
    }
}else {
    die('error');
}
