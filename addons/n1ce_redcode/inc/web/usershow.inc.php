<?php
		global $_GPC, $_W;
		checklogin();
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = 'select * from ' . tablename('n1ce_red_user') . 'where uniacid = :uniacid order by time DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize ;
		$prarm = array(':uniacid' => $_W['uniacid']);
		$list = pdo_fetchall($sql, $prarm);
		$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_red_user') . 'where uniacid = :uniacid', $prarm);
		$pager = pagination($count, $pindex, $psize);
		
		load()->func('tpl');
		include $this->template('user');