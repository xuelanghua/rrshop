<?php
	global $_GPC, $_W;
	checklogin();
	$pici = $_GPC['pici'];
	$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
	if($operation=="edits"){
		$id = $_GPC['id'];
		$pici = $_GPC['pici'];
		$sql = 'select * from ' . tablename('n1ce_red_prize') . 'where uniacid = :uniacid and pici = :pici and id = :id';
		$prarm = array(':uniacid' => $_W['uniacid'],':pici' => $pici,':id' => $id);
		$sum = pdo_fetch($sql, $prarm);
	}
	if (checksubmit()){
		pdo_update('n1ce_red_prize', array('prizeodds' => $_GPC['prize_odds'], 'prizesum' => $_GPC['prize_sum']), array('pici' => $_GPC['pici'],'uniacid' => $_W['uniacid'],'id' => $_GPC['id']));
		message('更新奖品成功',$this->createWebUrl('prize',array('pici' => $pici)),'success');
	}
	include $this->template('prizeedits');