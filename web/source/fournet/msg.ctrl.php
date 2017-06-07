<?php
/**
 * [WEIZAN System] Copyright (c) 2014 WEIZANCMS.COM
 
 */
defined('IN_IA') or exit('Access Denied');
uni_user_permission_check('fournet_msg');
$row = pdo_fetchcolumn("SELECT `msg` FROM ".tablename('uni_settings') . " WHERE uniacid = :uniacid", array(':uniacid' => $_W['uniacid']));
$msg = iunserializer($row);
if(checksubmit('submit')) {
	$msg = array(
			'appkey' => $_GPC['appkey'],
			'pingtai' => $_GPC['pingtai'],
			'password' => $_GPC['password'],
			'secret' => $_GPC['secret'],
			'qianming' => $_GPC['qianming'],
		);
		$row = array();
		$row['msg'] = iserializer($msg);
		pdo_update('uni_settings', $row, array('uniacid' => $_W['uniacid']));
		message('更新设置成功！', url('fournet/msg'));
	}
template('fournet/msg');
