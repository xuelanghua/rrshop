<?php

		global $_W  ,$_GPC;
		checklogin();
		if(!pdo_fieldexists('qrcode', 'redcode')) {
			pdo_query("ALTER TABLE ".tablename('qrcode')." ADD `redcode` tinyint(4) NOT NULL DEFAULT '1';");
		}
		if(!pdo_fieldexists('qrcode', 'pici')) {
			pdo_query("ALTER TABLE ".tablename('qrcode')." ADD `pici` int(10) NOT NULL DEFAULT '0';");
		}
		if(!pdo_fieldexists('qrcode', 'make')) {
			pdo_query("ALTER TABLE ".tablename('qrcode')." ADD `make` tinyint(4) NOT NULL DEFAULT '0';");
		}
		if(!pdo_fieldexists('n1ce_red_user', 'name')) {
			pdo_query("ALTER TABLE ".tablename('n1ce_red_user')." ADD `name` varchar(100) DEFAULT '';");
		}
		if(!pdo_fieldexists('n1ce_red_user', 'code')) {
			pdo_query("ALTER TABLE ".tablename('n1ce_red_user')." ADD `code` varchar(64) DEFAULT '';");
		}
		if(!pdo_fieldexists('n1ce_red_prize', 'name')) {
			pdo_query("ALTER TABLE ".tablename('n1ce_red_prize')." ADD `name` varchar(100) DEFAULT '';");
		}
		if(!pdo_fieldexists('n1ce_red_user', 'bopenid')) {
			pdo_query("ALTER TABLE ".tablename('n1ce_red_user')." ADD `bopenid` varchar(64) NOT NULL DEFAULT '1';");
		}
		if(!pdo_fieldexists('n1ce_red_prize', 'total_num')) {
			pdo_query("ALTER TABLE ".tablename('n1ce_red_prize')." ADD `total_num` int(10) unsigned NOT NULL DEFAULT '0';");
		}
		if (checksubmit()) {
			$count = $_GPC['num'];
			$codetype = $_GPC['codetype'];
			if(empty($count)||$count > 20000){
				message('数量设置错误', $this->createWebUrl("code"), 'error');
			}else{
				if($codetype == '1'){
					getcode($count);
					message('卡密生成成功', '', 'success');
				}
				if($codetype == '2'){
					getcharcode($count);
					message('卡密生成成功', '', 'success');
				}
			}
		}
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = 'select * from ' . tablename('n1ce_red_pici') . 'where uniacid = :uniacid LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
		$prarm = array(':uniacid' => $_W['uniacid']);
		$list = pdo_fetchall($sql, $prarm);
		$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_red_pici') . 'where uniacid = :uniacid', $prarm);
		$pager = pagination($count, $pindex, $psize);
		if (!empty($list)) {
			 foreach ($list as &$item) {
				 $surplus = pdo_fetchcolumn("SELECT count(1) FROM " . tablename('n1ce_red_code') . " WHERE uniacid = :uniacid and pici = :pici and status = 2 ", array(':uniacid' => $_W['uniacid'] ,':pici' => $item['pici']));
				 $item['codenum'] = '<span class="label label-warning">已使用'.$surplus.'枚</span><br/><span class="label label-success">总数量'.$item['codenum'].'枚</span>';
			 }
		}
		load()->func('tpl');
		include $this->template('code');
		
		
		
		
		function getcode($count){
		global $_W;
		$picid = pdo_fetch("SELECT max(pici) FROM ".tablename('n1ce_red_code')." WHERE uniacid = :uniacid", array(':uniacid' => $_W['uniacid']));
		$picid = $picid['max(pici)'];
		$pici = !empty($picid) ? ($picid+1) : 1;
		//print_r($picid);exit();
		$data = array('uniacid' => $_W['uniacid'], 'time' => time('Ymd'), 'codenum' => $count, 'pici' => $pici);
		pdo_insert('n1ce_red_pici', $data);
		for($i = 0; $i < $count; $i++){
			$randcode = genkeyword(8);
			while(isExist($randcode)){
				$randcode = genkeyword(8);
			}
			$code = array('uniacid' => $_W['uniacid'], 'code' => $randcode, 'time' => time('Ymd'), 'status' => '1', 'pici' => $pici);
			pdo_insert('n1ce_red_code', $code);
		}
		
	
		}
		function getcharcode($count){
		global $_W;
		$picid = pdo_fetch("SELECT max(pici) FROM ".tablename('n1ce_red_code')." WHERE uniacid = :uniacid", array(':uniacid' => $_W['uniacid']));
		$picid = $picid['max(pici)'];
		$pici = !empty($picid) ? ($picid+1) : 1;
		//print_r($picid);exit();
		$data = array('uniacid' => $_W['uniacid'], 'time' => time('Ymd'), 'codenum' => $count, 'pici' => $pici);
		pdo_insert('n1ce_red_pici', $data);
		for($i = 0; $i < $count; $i++){
			$randcode = genkeycharword(8);
			while(isExist($randcode)){
				$randcode = genkeycharword(8);
			}
			$code = array('uniacid' => $_W['uniacid'], 'code' => $randcode, 'time' => time('Ymd'), 'status' => '1', 'pici' => $pici);
			pdo_insert('n1ce_red_code', $code);
		}
		
	
		}
		function isExist($randcode){
			global $_W;
			$sql = 'select * from ' . tablename('n1ce_red_code') . 'where uniacid = :uniacid and code = :code';
			$prarm = array(':uniacid' => $_W['uniacid'], ':code' => $randcode);
			if(pdo_fetch($sql,$prarm)){
				return 1;
			}else{
				return 0;
			}
		
		}
		
		function genkeyword($length)
		{
			$chars = array('0','1', '2', '3', '4', '5', '6', '7', '8', '9');
			$password = rand(1, 9);
			for ($i = 0; $i < $length - 1; $i++) {
				$keys = array_rand($chars, 1);
				$password .= $chars[$keys];
			}
			return $password;
		}
		function genkeycharword($length)
		{
			$chars = array('0','1', '2', '3', '4', '5', '6', '7', '8', '9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
			$password = rand(1, 9);
			for ($i = 0; $i < $length - 1; $i++) {
				$keys = array_rand($chars, 1);
				$password .= $chars[$keys];
			}
			return $password;
		}