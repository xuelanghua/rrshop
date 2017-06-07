<?php
	global $_GPC, $_W;
	checklogin();
	load()->model('account');
	$acidarr = uni_accounts($_W['uniacid']);
	$pici = $_GPC['pici'];
	$acid = intval($_W['acid']);
	$wheresql = " WHERE uniacid = {$_W['uniacid']}";
	if($acid > 0) {
		$wheresql .= " AND acid = {$acid} ";
	}
	if($pici){
	$wheresql .= " AND pici = {$pici} ";
	}
	$wheresql .= " AND redcode = 1";
	$wheresql .= " AND qrcid > 10000000";
	$wheresql .= " AND model = 1";
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$list = pdo_fetchall("SELECT * FROM ".tablename('qrcode'). $wheresql . ' ORDER BY createtime DESC LIMIT '.($pindex - 1) * $psize.','. $psize);
	foreach ($list as $key=>$value) {
		$list[$key]['uniname'] =  $acidarr[$value['acid']]['name'];
	}
	if (!empty($list)) {
		foreach ($list as $index => &$qrcode) {
			$qrcode['showurl'] = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($qrcode['ticket']);
			$qrcode['endtime'] = $qrcode['createtime'] + $qrcode['expire'];
			if (TIMESTAMP > $qrcode['endtime']) {
				$qrcode['endtime'] = '<font color="red">已过期</font>';
			}else{
				$qrcode['endtime'] = date('Y-m-d H:i:s',$qrcode['endtime']);
			}
			if ($qrcode['model'] == 2) {
				$qrcode['modellabel']="永久";
				$qrcode['expire']="永不";
				$qrcode['endtime'] = '<font color="green">永不</font>';
			} else {
				$qrcode['modellabel']="临时";
			}
		}
	}
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('qrcode') . $wheresql);
	$pager = pagination($total, $pindex, $psize);
		pdo_query("UPDATE ".tablename('qrcode')." SET status = '0' WHERE uniacid = '{$_W['uniacid']}' AND model = '1' AND createtime < '{$_W['timestamp']}' - expire");
	include $this->template('qrshow');