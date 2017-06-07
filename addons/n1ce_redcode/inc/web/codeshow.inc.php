<?php

	    global $_W  ,$_GPC;
		checklogin();
		$pici = $_GPC['pici'];
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = 'select * from ' . tablename('n1ce_red_code') . 'where uniacid = :uniacid and pici = :pici LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
		$prarm = array(':uniacid' => $_W['uniacid'] ,':pici' => $pici);
		$list = pdo_fetchall($sql, $prarm);
		$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_red_code') . 'where uniacid = :uniacid and pici = :pici', $prarm);
		$pager = pagination($count, $pindex, $psize);
		
		load()->func('tpl');
		include $this->template('codeshow');