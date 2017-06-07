<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
include MODULE_ROOT . '/inc/common.php';
global $_GPC, $_W;
$uniacid = $_W["uniacid"];
$table_name = 'fr_hb_project';
$act = trim($_GPC['act']);
$allow_acts = array(
    'lists', 'add', 'update', 'delete', 'test', 'ewm_preview'
);
$type_text = array(
    '1' => '积分',
    '2' => '余额',
    '3' => '微信零钱',
    '4' => '微信卡券',
);
load()->func('tpl');
load()->func('file');
$isWeixinPay = isWeixinPay();
if (!in_array($act, $allow_acts)) {
    $act = 'lists';
}
if ($act == 'test') {
    $money = 100 / 100;
    $project['type'] = 1;
    $openid = "oOsbOs73b-CdvQQ2Lc1GJE-r2kXI";
    $msg = '';
    //发信息通知用户
    if ($project['type'] == 1) {
        $url = murl('mc/bond/credits', array('credittype' => 'credit1'), false, true);
        $msg = "恭喜您获得积分红包：{$money}<a href='{$url}'>查看</a>";
    }elseif($project['type'] == 2) { 
        $url = murl('mc/bond/credits', array('credittype' => 'credit2'), false, true);
        $msg = "恭喜您获得{$project['title']}余额红包：{$money}<a href='{$url}'>查看</a>";
    }elseif($project['type'] == 3){
        $msg = "恭喜您获得{$_W['account']['name']}现金红包：{$money}元";
    }
    $msg = "恭喜您获得{$_W['account']['name']}现金红包：{$money}元";
    //$r = sendWeixinCard($openid, "pR5eWjlielwaYUhSTdCxMQu3Lzqk");
//    dump($isWeixinPay);die;
    //$r = sendWeixinRedPacket($openid, 100,  $msg,  "XXXX活动",  "赶快分享给您的好友一起领红包吧",  $_W['account']['name'], true);
    //$r = sendNotice($_W['account']['uniacid'], 'oOsbOs73b-CdvQQ2Lc1GJE-r2kXI', $msg);
    dump($r);
    exit;
}
/**
 * 列表
 */
if ($act == 'lists') {
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $where = '';
    $where .= $_GPC['title'] ? " AND title LIKE '%{$_GPC['title']}%'" : '';
    $status = intval($_GPC['status']);
    switch ($status) {
        case 1:
            $where .= " AND start_time < " . TIMESTAMP;
            break;
        case 2:
            $where .= " AND end_time < " . TIMESTAMP;
            break;
        case 3:
            $where .= " AND start_time > " . TIMESTAMP;
            break;
    }
    $sql = 'SELECT * FROM '.tablename($table_name).' WHERE uniacid = :uniacid '.$where.' ORDER BY id DESC  LIMIT '. ($pindex -1) * $psize . ',' .$psize;
    $list = pdo_fetchall( $sql , array(':uniacid' => $uniacid));
    //dump($list);die;
    $countSql = 'SELECT COUNT(*) FROM '.tablename($table_name).' WHERE uniacid = :uniacid '.$where;
    $total = pdo_fetchcolumn( $countSql, array(':uniacid' => $uniacid) );
    $pager = pagination($total, $pindex, $psize);
}
/**
 * 添加修改
 */
else if($act == 'add') {
    $id = intval($_GPC['id']);
    $item = array(
        'min_money' => $this->module['config']['min_money'],
        'max_money' => $this->module['config']['max_money'],
        'numbers' => $this->module['config']['numbers'],
        'type' => $this->module['config']['type'],
        'share_type' => $this->module['config']['type'],
        'datetime'=> array('start' => timeToStr(TIMESTAMP), 'end' => timeToStr(TIMESTAMP + 30 * 24 * 60 * 60)),
        'index_bg'=> __IMG__ . '/index_bg.jpg',
        'tips_bg'=> __IMG__ . '/tips.jpg',
        'draw_bg'=> __IMG__ . '/draw.jpg',
        'share_bg'=> __IMG__ . '/share.png',
        'is_follow'=> 1,
        'ewm_setting' => array(
            'size' => 6,
            'level' => 3,
            'margin' => 2,
        )
    );
    if (!empty($id)) {
        $sql = "SELECT * FROM ". tablename($table_name) . " WHERE id = :id AND uniacid = :uniacid";
        $params = array(":id" => $id, ":uniacid" => $uniacid);
        $item = pdo_fetch($sql, $params);
        $item['datetime'] = array('start' => timeToStr($item['start_time']), 'end' => timeToStr($item['end_time'])) ;
        if (empty($item['index_bg'])) {
            $item['index_bg'] =  __IMG__ . '/index_bg.jpg';
        }
        if (empty($item['tips_bg'])) {
            $item['tips_bg'] =  __IMG__ . '/tips.jpg';
        }
        if (empty($item['draw_bg'])) {
            $item['draw_bg'] =  __IMG__ . '/draw.jpg';
        }
        if (empty($item['share_bg'])) {
            $item['share_bg'] =  __IMG__ . '/share.png';
        }
        $item['ewm_setting'] = iunserializer($item['ewm_setting']);
        $item['card_ids'] = iunserializer($item['card_ids']);
        if (empty($item['ewm_setting'])) {
            $item['ewm_setting'] = array(
                'size' => 6,
                'level' => 3,
                'margin' => 2,
            );
        }
    }
}

/**
 * 保存数据
 */
else if($act == 'update') {
    if (!checksubmit('submit')) {
        message('Token错误!', '', 'error');
    }
    $id = intval($_GPC['id']);
    $project = $_GPC['project'];
    $project_old = getProjectById($id);
    if (!empty($project_old) && $project_old['type'] == 4 && $project['type'] != 4) {
        message('选择卡券类型后，项目红包类型不可更改！', '', 'error');
    }
    if (!empty($project_old) && $project_old['type'] != 4 && $project['type'] == 4) {
        message('选择积分，余额，微信零钱类型后，项目红包类型不可更改为卡券类型！', '', 'error');
    }
    $datetime = $_GPC['datetime'];
    $card_id = array_unique(array_filter($_GPC['card_id']));
    $project['start_time'] = strtotime($datetime['start']);
    $project['end_time'] = strtotime($datetime['end']);
    $min_money = intval($project['min_money']);
    $max_money = intval($project['max_money']);
    $project['min_money'] = min($min_money, $max_money);
    $project['max_money'] = max($min_money, $max_money);
    if ($project['title'] == '') {
        message('项目名称不能为空', '', 'error');
    }
    if (intval($project['numbers'] < 1)) {
        message('项目红包数量不能小于1', '', 'error');
    }
    if ($project['start_time'] >= $project['end_time']) {
        message('项目开始或结束时间不正确', '', 'error');
    }
    if ($project['min_money'] < $this->module['config']['min_money']) {
        $project['min_money'] = $this->module['config']['min_money'];
    }
    if ($project['max_money'] > $this->module['config']['max_money']) {
        $project['max_money'] = $this->module['config']['max_money'];
    }
    if ($project['type'] == 3 && !$isWeixinPay) {
        message('请先设置微信商户信息', url('profile/module/setting', array('m' => 'fr_hb')), 'error');
    }
    if ($project['type'] == 3 && $project['min_money'] < 100) {
        message('微信红包最低额度是一元', '', 'error');
    }
    
    if ($project['type'] == 4 && empty($card_id)) {
        message('请最少选择一张卡券！', '', 'error');
    }
    if ($project['type'] == 4) {
        $numbers = 0;
        for($i = 0; $i < count($card_id); $i++) {
            $uniacid = $_W['uniacid'];
            $sql = "SELECT quantity FROM ". tablename("coupon") . " WHERE uniacid = :uniacid AND card_id = :card_id LIMIT 1";
            $params = array(":uniacid" => $uniacid, ":card_id" => $card_id[$i]);
            $quantity = pdo_fetchcolumn($sql, $params);
            $numbers += intval($quantity);
        }
        $project['numbers'] = $numbers > 0 ? $numbers : $project['numbers'];
        $project['card_ids'] = iserializer($card_id);
    }else{
        $project['card_ids'] = '';
    }
    if (empty($project['ewm_setting'])) {
        $project['ewm_setting'] = array(
                'size' => 6,
                'level' => 3,
                'margin' => 2,
        );
    }
    
    if ($project['ewm_setting']['size'] < 1 || $project['ewm_setting']['size'] > 25) {
        $project['ewm_setting']['size'] = 6;
    }
    if (!in_array($project['ewm_setting']['level'], array(0,1,2,3))) {
        $project['ewm_setting']['level'] = 3;
    }
    $project['ewm_setting']['margin'] = intval($project['ewm_setting']['margin']);
    $project['ewm_setting'] = iserializer($project['ewm_setting']);
    if (empty($project['index_bg'])) {
        $project['index_bg'] =  __IMG__ . '/index_bg.jpg';
    }
    if (empty($project['tips_bg'])) {
        $project['tips_bg'] =  __IMG__ . '/tips.jpg';
    }
    if (empty($project['draw_bg'])) {
        $project['draw_bg'] =  __IMG__ . '/draw.jpg';
    }
    if (empty($project['share_bg'])) {
        $project['share_bg'] =  __IMG__ . '/share.png';
    }
    $project['uniacid'] = $uniacid;
    $project['createtime'] = TIMESTAMP;
    if (empty($id)) {
        fr_insert("project", $project);
    }else{
       fr_update("project", $project, array('id' => $id));
    }
    message('项目保存成功!', $this->createWebUrl('project', array('act' => 'lists')), 'success');
    exit();
}
/**
 * 删除数据
 */
else if($act == 'delete') {
    $id = intval($_GPC['id']);
    pdo_delete($table_name, array('id' => $id, 'uniacid' => $uniacid));//删除项目
    pdo_delete('fr_hb_packet', array('project_id' => $id, 'uniacid' => $uniacid));//删除红包
    pdo_delete('fr_hb_receive', array('project_id' => $id, 'uniacid' => $uniacid));//删除红包领取记录
    pdo_delete('fr_hb_share', array('project_id' => $id, 'uniacid' => $uniacid));//删除分享记录
    pdo_delete('fr_hb_draw', array('project_id' => $id, 'uniacid' => $uniacid));//删除奖品
    pdo_delete('fr_hb_draw_log', array('project_id' => $id, 'uniacid' => $uniacid));//删除抽奖记录
    $outpath = ATTACHMENT_ROOT . "/images/{$uniacid}/{$this->modulename}/{$id}/";//存放项目二维码目录
    rmdirs($outpath);//删除项目相关二维码图片文件
    message('删除项目成功!', $this->createWebUrl('project', array('act' => 'lists')), 'success');
    exit();
}
/**
 * 预览二维码
 */
else if($act == 'ewm_preview') {
    $size = intval($_GPC['size']) > 25 ? 25 : (intval($_GPC['size']) < 1 ? 1 : intval($_GPC['size']));
    $level = $_GPC['level'];
    $margin = $_GPC['margin'];
    $longurl = __MURL('scan', array('token' => $token), true, true);
    $qr = qrcode($longurl, false, false, $level, $size, $margin);
    die();
}
include $this->template('web/project_' . $act);