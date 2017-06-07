<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
/**
 * 获取项目详情
 * @param type $id
 * @return type
 */
function getProjectById($id) {
    return getDataById('fr_hb_project', $id);
}
/**
 * 获取所有项目
 * @global type $_W
 * @return type
 */
function getAllProject() {
    global $_W;
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename('fr_hb_project') . " WHERE uniacid = :uniacid";
    $params = array(":uniacid" => $uniacid);
    $result = pdo_fetchall($sql, $params);
    return $result;
}

function getProjectTitle($id) {
    $project = getProjectById($id);
    return $project['title'];
}