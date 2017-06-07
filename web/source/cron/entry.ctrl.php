<?php
/**
 * [WeiZan System] Copyright (c) 2014 WeiZan.Com
 
 */
defined('IN_IA') or exit('Access Denied');
if($do=='mass'){
	$id=intval($_GPC['id']);
	$send=pdo_get('mc_mass_record',array('id'=>$id));
	$media = pdo_get('wechat_attachment', array('uniacid' => $_W['uniacid'], 'id' => $send['attach_id']));
	if(empty($media)) {
		exit('素材不存在或已经删除');
	}
	$media_id = trim($media['media_id']);
	$acc = WeAccount::create();
	$data = $acc->fansSendAll($send['group'], $send['msgtype'], $media_id);
	if(is_error($data)){
		exit($data['message']);
	}
	pdo_update('mc_mass_record',array('status'=>0),array('id'=>$id));
	exit('mass success');
}
exit('end');

