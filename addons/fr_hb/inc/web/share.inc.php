<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
include MODULE_ROOT . '/inc/common.php';
global $_GPC, $_W;
$uniacid = $_W["uniacid"];
$table_name = 'fr_hb_share';

$act = trim($_GPC['act']);
$allow_acts = array(
    'lists'
);
$type_text = array(
    '1' => '积分',
    '2' => '余额',
    '3' => '微信零钱',
    '4' => '微信卡券',
);
if (!in_array($act, $allow_acts)) {
    $act = 'lists';
}

/**
 * 列表
 */
if ($act == 'lists') {
    $projects = getAllProject();
    $project_id = intval($_GPC['project_id']);
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $where = '';
    $where .= $_GPC['title'] ? " AND title LIKE '%{$_GPC['title']}%'" : '';
    $where .= $project_id > 0 ? " AND project_id = '{$project_id}'" : '';
    
    $sql = 'SELECT * FROM '.tablename($table_name).' WHERE uniacid = :uniacid AND share_openid != "" '.$where.' ORDER BY id DESC  LIMIT '. ($pindex -1) * $psize . ',' .$psize;
    $list = pdo_fetchall( $sql , array(':uniacid' => $uniacid));
    //dump($list);die;
    $countSql = 'SELECT COUNT(*) FROM '.tablename($table_name).' WHERE uniacid = :uniacid AND share_openid != "" '.$where;
    $total = pdo_fetchcolumn( $countSql, array(':uniacid' => $uniacid) );
    $pager = pagination($total, $pindex, $psize);
}
include $this->template('web/share_' . $act);