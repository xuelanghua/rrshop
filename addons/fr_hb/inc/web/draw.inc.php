<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
include MODULE_ROOT . '/inc/common.php';
global $_GPC, $_W;
$uniacid = $_W["uniacid"];
$table_name = 'draw';

$act = trim($_GPC['act']);
$allow_acts = array(
    'lists', 'add', 'update', 'delete', 'setStatus', 'setDraw'
);
$type_text = array(
    '1' => '积分',
    '2' => '余额',
    '3' => '微信零钱',
    '4' => '微信卡券',
);
load()->func('tpl');
load()->func('file');
if (!in_array($act, $allow_acts)) {
    $act = 'lists';
}
$project_id = intval($_GPC['id']);
$project = getProjectById($project_id);
if (empty($project)) {
    message('项目不存在！', '', "error");
}
$isWeixinPay = isWeixinPay();
/**
 * 列表
 */
if ($act == 'lists') {
    if(checksubmit('submit')) {
        foreach($_GPC['orderlist'] as $key => $value) {
            $key = intval($key);
            $data['sort'] = intval($value);
            $data['name'] = $_GPC['title'][$key];
            $data['prize'] = intval($_GPC['prize'][$key]);
            $data['numbers'] = intval($_GPC['numbers'][$key]);
            $data['surplus'] = intval($_GPC['surplus'][$key]);
            $data['chance'] = ($_GPC['chance'][$key] > 100 ? 100 : ($_GPC['chance'][$key] < 0) ? 0 : floatval($_GPC['chance'][$key]));
            pdo_update(fr_table($table_name, false), $data, array('id' => ($key),'uniacid' => $uniacid));
            unset($data);
        }
        message('奖品信息更新成功！', referer(), 'success');
    }
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $where = '';
    $where .= $_GPC['title'] ? " AND name LIKE '%{$_GPC['title']}%'" : '';
    
    $params = array(':uniacid' => $uniacid, ':project_id' => $project_id); 
    $sql = 'SELECT * FROM '.fr_table($table_name).' WHERE uniacid = :uniacid AND project_id = :project_id '.$where  .' ORDER BY sort ASC LIMIT '. ($pindex -1) * $psize . ',' .$psize;
    $list = pdo_fetchall( $sql , $params);
    //dump($list);die;
    $countSql = 'SELECT COUNT(*) FROM '.fr_table($table_name).' WHERE uniacid = :uniacid AND project_id = :project_id  '.$where;
    $total = pdo_fetchcolumn( $countSql, $params );
    $pager = pagination($total, $pindex, $psize);
}
/**
 * 添加修改
 */
else if($act == 'add') {
    $id = intval($_GPC['draw_id']);
    $item = array('type' => 2);
    if (!empty($id)) {
        $sql = "SELECT * FROM ". fr_table($table_name) . " WHERE id = :id AND uniacid = :uniacid";
        $params = array(":id" => $id, ":uniacid" => $uniacid);
        $item = pdo_fetch($sql, $params);
    }
}

/**
 * 保存数据
 */
else if($act == 'update') {
    if (!checksubmit('submit')) {
        message('Token错误!', '', 'error');
    }
    $id = intval($_GPC['draw_id']);
    $draw = $_GPC['draw'];
    if ($draw['type'] == 3 && !$isWeixinPay) {
        message('请先设置微信商户信息', url('profile/module/setting', array('m' => 'fr_hb')), 'error');
    }
    if ($draw['type'] == 3 && $draw['prize'] < 100 && $draw['prize'] != 0) {
        message(' 微信零钱最低额度是一元', '', 'error');
    }
    if ($draw['type'] == 4 && empty($draw['card_id'])) {
        message(' 请选择卡券', '', 'error');
    }
    if ($draw['type'] != 4) {
        $draw['card_id'] = "";
    }
    
    if ($draw['prize'] < 0) {
        $draw['prize'] = 0;
    }
    if ($draw['chance'] > 100) {
        $draw['chance'] = 100;
    }elseif($draw['chance'] < 0){
        $draw['chance'] = 0;
    }
    $draw['project_id'] = $project_id;
    $draw['uniacid'] = $uniacid;
    if ($draw['surplus'] > $draw['numbers'] || $draw['surplus'] < 0) {
        $draw['surplus'] = $draw['numbers'];
    }
    if (empty($id)) {
        fr_insert("draw", $draw);
    }else{
        fr_update("draw", $draw, array('id' => $id, 'uniacid' => $uniacid));
    }
    message('奖品保存成功!', $this->createWebUrl('draw', array('id' => $project_id, 'act' => 'lists')), 'success');
    exit();
}

/**
 * 删除数据
 */
else if($act == 'delete') {
    $id = intval($_GPC['draw_id']);
    fr_delete($table_name, array('id' => $id, 'uniacid' => $uniacid));
    message('删除奖品成功!', $this->createWebUrl('draw', array('id' => $project_id, 'act' => 'lists')), 'success');
    exit();
}

/**
 * 改变状态
 */
elseif ($act == "setStatus") {
    $id = intval($_GPC['draw_id']);
    $info = getDataById(fr_table($table_name, FALSE), $id);
    if (!empty($info)) {
        $status = intval($info['status']) > 0 ? 0 : 1;
        $rs = fr_update("draw", array('status' => $status), array('id' => $id));
        if ($rs !== false) {
            message($status, '', 'success');
        }else{
            message("操作失败！", '', 'error');
        }
    }else{
        message("奖品信息不存在或已删除！", '', 'error');
    }
    exit;
}
elseif ($act == "setDraw") {
    $id = intval($_GPC['draw_id']);
    $info = getDataById(fr_table($table_name, FALSE), $id);
    if (!empty($info)) {
        $status = intval($info['draw']) > 0 ? 0 : 1;
        $rs = fr_update("draw", array('draw' => $status), array('id' => $id));
        if ($rs !== false) { 
            message($status, '', 'success');
        }else{
            message("操作失败！", '', 'error');
        }
    }else{
        message("奖品信息不存在或已删除！", '', 'error');
    }
    exit;
}
include $this->template('web/draw_' . $act);