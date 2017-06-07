<?php
/**
 * [WeiZan System] Copyright (c) 2014 WEIZANCMS.COM
 
 */
defined('IN_IA') or exit('Access Denied');
checkauth();
load()->model('activity');
load()->model('mc');
load()->classs('coupon');
$coupon_api = new coupon();
$creditnames = array();
$unisettings = uni_setting($uniacid, array('creditnames', 'coupon_type', 'exchange_enable'));
if (!empty($unisettings) && !empty($unisettings['creditnames'])) {
	foreach ($unisettings['creditnames'] as $key=>$credit) {
		$creditnames[$key] = $credit['title'];
	}
}

$cardstatus = pdo_get('mc_card', array('uniacid' => $_W['uniacid']), array('status'));
$type_names = activity_coupon_type_label();
