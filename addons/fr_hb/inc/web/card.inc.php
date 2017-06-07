<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
include MODULE_ROOT . '/inc/common.php';
global $_GPC, $_W;
$where = " AND status = 3";
$res = getAllData("coupon", $where);
$result = array();
foreach($res AS $item) {
    $result[$item['type']][] = $item;
}
$card_type = array(
    "discount" => "折扣券",
    "cash" => "代金券",
    "gift" => "礼品券",
    "groupon" => "团购券",
    "general_coupon" => "优惠券",
);
//dump($result);
include $this->template('web/card');