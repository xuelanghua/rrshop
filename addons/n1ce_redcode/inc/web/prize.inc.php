<?php
	global $_GPC, $_W;
	checklogin();
	$pici = $_GPC['pici'];
	$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
	if($operation=="delete"){
			$id = $_GPC['id'];
			$pici =$_GPC['pici'];
			if(!$id)message('参数错误！','', 'error');
			pdo_delete("n1ce_red_prize",array("id"=>$id,"uniacid"=>$_W['uniacid'],"pici"=>$pici));
			message("删除成功",$this->createWebUrl("prize" , array('pici' => $pici)), 'success');
	}
	$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = 'select * from ' . tablename('n1ce_red_prize') . 'where uniacid = :uniacid and pici = :pici LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
		$prarm = array(':uniacid' => $_W['uniacid'],':pici' => $pici);
		$list = pdo_fetchall($sql, $prarm);
		$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_red_prize') . 'where uniacid = :uniacid', $prarm);
		$pager = pagination($count, $pindex, $psize);
	include $this->template('prize');