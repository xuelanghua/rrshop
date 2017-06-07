<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$_W['container'] = "wechat";
//checkauth();
load()->model("mc");
$userinfo = mc_oauth_userinfo();
$fans = mc_fansinfo($userinfo['openid']);
$uni_setting = uni_setting($_W['uniacid'], array('passport'));
if(!empty($fans)) {
        $rec = array();
        $member = array();
        if(!empty($fans['uid'])){
            $member = mc_fetch($fans['uid']);
        }
        if (empty($member)) {
            if (!isset($uni_setting['passport']) || empty($uni_setting['passport']['focusreg'])) {
                $default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' .tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $_W['uniacid']));
                $data = array(
                        'uniacid' => $_W['uniacid'],
                        'email' => md5($userinfo['openid']).'@we7.cc',
                        'salt' => random(8),
                        'groupid' => $default_groupid,
                        'createtime' => TIMESTAMP,
                );
                $data['password'] = md5($userinfo['openid'] . $data['salt'] . $_W['config']['setting']['authkey']);
                pdo_insert('mc_members', $data);
                $rec['uid'] = pdo_insertid();
            }
        }

        if(!empty($rec)){
                pdo_update('mc_mapping_fans', $rec, array(
                        'acid' => $_W['acid'],
                        'openid' => $userinfo['openid'],
                        'uniacid' => $_W['uniacid']
                ));
        }
} else {
        $rec = array();
        $rec['acid'] = $_W['acid'];
        $rec['uniacid'] = $_W['uniacid'];
        $rec['uid'] = 0;
        $rec['openid'] = $userinfo['openid'];
        $rec['salt'] = random(8);
        if (!isset($uni_setting['passport']) || empty($uni_setting['passport']['focusreg'])) {
               $default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' .tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $_W['uniacid']));
               $data = array(
                        'uniacid' => $_W['uniacid'],
                        'email' => md5($userinfo['openid']).'@we7.cc',
                        'salt' => random(8),
                        'groupid' => $default_groupid,
                        'createtime' => TIMESTAMP,
                );
                $data['password'] = md5($userinfo['openid'] . $data['salt'] . $_W['config']['setting']['authkey']);
                pdo_insert('mc_members', $data);
                $rec['uid'] = pdo_insertid();
        }
        pdo_insert('mc_mapping_fans', $rec);
}


$token = $_GPC['token'];
$packet = getPacketByToken($token);
$project = getProjectById($packet['project_id']);
$bgs['index_bg'] = $project['index_bg'] ? toimage($project['index_bg']) : toimage($bg);
$bgs['tips_bg'] = $project['tips_bg'] ? toimage($project['tips_bg']) : toimage($tips_bg);
$bgs['share_bg'] = $project['share_bg'] ? toimage($project['share_bg']) : toimage($share_bg);
//没关注，跳到结果页
if (empty($fans['follow']) && $project['is_follow'] == 1) {
    //$_SESSION['userinfo'] = NULL;
//    $accounts = uni_accounts($_W['uniacid']);
//    $accounts = array_shift($accounts);
//    if ($GLOBALS['fr_hb_settings']['subscribeurl'] != '') {
//        $url = $GLOBALS['fr_hb_settings']['subscribeurl'];
//    }elseif($accounts['subscribeurl'] != '') {
//        $url = $accounts['subscribeurl'];
//    }else{
//        include $this->template('follow');exit;
//    }
//    header('location:' . $url);
//    die;
}


$isFollow = isFollow();