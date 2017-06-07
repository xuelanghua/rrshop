<?php
	global $_GPC, $_W;
	checklogin();
	$pici = $_GPC['pici'];
	if (checksubmit()){
		if($_GPC['type'] == '1'){
			$data = array(
			'uniacid' => $_W['uniacid'],
			'prizeodds' => $_GPC['prize_odds'],
			'prizesum' => $_GPC['prize_sum'],
			'type' => $_GPC['type'],
			'name' => $_GPC['red_name'],
			'min_money' => $_GPC['min_money'],
			'max_money' => $_GPC['max_money'],
			'pici' => $_GPC['pici'],
			'time' => time()
			);
		}
		if($_GPC['type'] == '2'){
			$data = array(
			'uniacid' => $_W['uniacid'],
			'prizeodds' => $_GPC['cprize_odds'],
			'prizesum' => $_GPC['cprize_sum'],
			'type' => $_GPC['type'],
			'cardid' => $_GPC['cardid'],
			'name' => $_GPC['card_name'],
			'pici' => $_GPC['pici'],
			'time' => time()
			);
		}
		if($_GPC['type'] == '3'){
			$data = array(
			'uniacid' => $_W['uniacid'],
			'prizeodds' => $_GPC['uprize_odds'],
			'prizesum' => $_GPC['uprize_sum'],
			'type' => $_GPC['type'],
			'name' => $_GPC['url_name'],
			'url' => $_GPC['url'],
			'pici' => $_GPC['pici'],
			'time' => time()
			);
		}
		if($_GPC['type'] == '4'){
			$data = array(
			'uniacid' => $_W['uniacid'],
			'prizeodds' => $_GPC['jprize_odds'],
			'prizesum' => $_GPC['jprize_sum'],
			'type' => $_GPC['type'],
			'credit' => $_GPC['credit'],
			'name' => $_GPC['credit_name'],
			'pici' => $_GPC['pici'],
			'time' => time()
			);
		}
		if($_GPC['type'] == '5'){
			$data = array(
			'uniacid' => $_W['uniacid'],
			'prizeodds' => $_GPC['tprize_odds'],
			'prizesum' => $_GPC['tprize_sum'],
			'type' => $_GPC['type'],
			'txt' => $_GPC['txt'],
			'name' => $_GPC['txt_name'],
			'pici' => $_GPC['pici'],
			'time' => time()
			);
		}
		if($_GPC['type'] == '6'){
			$data = array(
			'uniacid' => $_W['uniacid'],
			'prizeodds' => $_GPC['more_odds'],
			'prizesum' => $_GPC['more_sum'],
			'type' => $_GPC['type'],
			'name' => $_GPC['more_name'],
			'min_money' => $_GPC['moremin_money'],
			'max_money' => $_GPC['moremax_money'],
			'cardid' => $_GPC['morecardid'],
			'txt' => $_GPC['moreurl'],
			'pici' => $_GPC['pici'],
			'time' => time()
			);
		}
		if($_GPC['type'] == '7'){
			$data = array(
			'uniacid' => $_W['uniacid'],
			'prizeodds' => $_GPC['groupprize_odds'],
			'prizesum' => $_GPC['groupprize_sum'],
			'type' => $_GPC['type'],
			'name' => $_GPC['groupred_name'],
			'min_money' => $_GPC['groupmin_money'],
			'max_money' => $_GPC['groupmax_money'],
			'total_num' => $_GPC['grouptotal_num'],
			'pici' => $_GPC['pici'],
			'time' => time()
			);
		}
		//message(var_dump($data));
		pdo_insert('n1ce_red_prize', $data );
		message('添加成功',$this->createWebUrl('prize',array('pici' => $pici)),'success');
	}
	include $this->template('prizeadd');