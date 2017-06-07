<?php
	checklogin();
	global $_W,$_GPC;
	$res = pdo_fetch('select * from ' . tablename('n1ce_red_user') . ' where uniacid = :uniacid', array(':uniacid' => $_W['uniacid']));
	if($res){
		pdo_delete('n1ce_red_user', array('uniacid' => $_W['uniacid']));
		message('清空用户记录成功！',$this->createWebUrl("usershow"),'success');
	}else{
		message('暂无用户领取记录',$this->createWebUrl("usershow"),'error');
	}