<?php
/**
 * 验证码生成模块模块微站定义
 *
 * @author n1ce   QQ：541535641
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
define('JS', '../addons/n1ce_redcode/style/js/');
class N1ce_redcodeModuleSite extends WeModuleSite {
	
	
	//手机端页面管理
	public function doMobileIndex(){
		global $_W, $_GPC;
		//checklogin();
		$brrow = mc_oauth_userinfo();
		$surl = $this->module['config']['surl'];
		$picurl = pdo_fetch('select * from ' . tablename('n1ce_red_pic') . ' where uniacid = :uniacid order by id DESC', array(':uniacid' => $_W['uniacid']));
		$picurl = $picurl['bgimg'];
		if (checksubmit( 'submit' )) {
			$openid = $_W['openid'];
			$content = $_GPC['code'];
			if(empty($content)){
				message( '请输入验证码!', '', 'error' );
				
			}
			if(empty($_W['openid'])||$_W['fans']['follow']!=1){
				
				message( '请先关注公众号!', $surl, 'error' );
			}
			$picires = pdo_fetch('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and  code = :code', array(':code' => $content, ':uniacid' => $_W['uniacid']));
			//获取批次
			$pici = $picires['pici'];
			//获取昵称，坑爹的mc_fansinfo，用mc_fetch !不能实时获取到新关注的粉丝昵称
		$mc = mc_fetch($openid);
		if(empty($mc['nickname']) || empty($mc['avatar']) || empty($mc['resideprovince']) || empty($mc['residecity'])){
			load()->classs( 'account' );
			load()->func( 'communication' );
			$accToken = WeAccount::token();
			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$accToken}&openid={$openid}&lang=zh_CN";
			$json = ihttp_get($url);
			$userinfo = @json_decode($json['content'],true);
			if($userinfo['nickname']) $mc['nickname'] = $userinfo['nickname'];
			if($userinfo['avatar']) $mc['avatar'] = $userinfo['avatar'];
			if($userinfo['resideprovince']) $mc['resideprovince'] = $userinfo['resideprovince'];
			if($userinfo['residecity']) $mc['residecity'] = $userinfo['residecity'];
			mc_update($openid,array('nickname' => $mc['nickname'] , 'avatar' => $mc['avatar'] , 'resideprovince' => $mc['resideprovince'], 'residecity' => $mc['residecity']));
		}
		//状态判断
		$res = pdo_fetch('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and  code = :code and status = 1', array(':code' => $content, ':uniacid' => $_W['uniacid']));
		//概率计算排除数量为0的奖品
		 $prizes = pdo_fetchall('select * from' . tablename('n1ce_red_prize') . ' where prizesum > 0 and uniacid = :uniacid and pici = :pici order by id desc', array(':uniacid' => $_W['uniacid'], ':pici' => $pici));
		 if(!$prizes){
			message( '无效验证码!', '', 'error' ); 
		 }
		if($res){
			$exits = pdo_query('update ' . tablename('n1ce_red_code') . ' set status = 2 where uniacid = :uniacid and code = :code', array(':uniacid' => $_W['uniacid'],':code' => $content));
			foreach ($prizes as $key => $val) {
                        $arr[$val['id']] = $val['prizeodds'];
                    }
            $pid = $this->get_rand($arr);
			$sends = pdo_fetch('select * from ' . tablename('n1ce_red_prize') . ' where id = :id and uniacid = :uniacid and pici = :pici', array(':id' => $pid ,':uniacid' => $_W['uniacid'] ,':pici' => $pici));
			$money = rand($sends['min_money'], $sends['max_money']);
				$insert = array(
					'uniacid' => $_W['uniacid'],
					'openid' => $openid,
					'nickname' => $mc['nickname'],
					'money' => $money,
					'name' => $sends['name'],
					'code' => $content,
					'time' => TIMESTAMP,
					//'status' => '1',
				);
			if($sends['type'] == '1'){
				$settings = $this->module['config'];
				if($settings['brrow'] == '2'){
					
					$openid = $brrow['openid'];
				}
				//$action = $this->sendCommonRedpack($openid, $settings, $money);
				$action = $this->sendRedPacket($openid, $money);
				pdo_query('update ' . tablename('n1ce_red_prize') . ' set prizesum = prizesum - 1 where uniacid = :uniacid and type = :type and pici = :pici', array(':uniacid' => $_W['uniacid'],':type' => 1 ,'pici' => $pici));
				
				if($action === true){
					//替换粉丝标志换成昵称
					$userdata = array(
					'nickname' => $mc['nickname'],
					);
					pdo_insert('n1ce_red_user', $insert);
					//pdo_update('n1ce_reds_code',$userdata,array('uniacid' => $_W['uniacid'],'code' => $content),'AND');
					message('红包发送成功','','success');
				}else{
					$insert['status'] = '2';
					pdo_insert('n1ce_red_user', $insert);
					$actions = "亲爱的管理员，有粉丝红包领取失败！\n原因：".$action;
					$this->sendText($settings['mopenid'],$actions);
					message('红包发送失败!','','error');
				}
			}
			if($sends['type'] == '2'){
					$res = $this->sendWxCard($openid,$sends['cardid']);
					pdo_query('update ' . tablename('n1ce_red_prize') . ' set prizesum = prizesum - 1 where uniacid = :uniacid and type = :type and pici = :pici', array(':uniacid' => $_W['uniacid'],':type' => 2 ,'pici' => $pici));
					if($res){
						$insert['money'] = '微信卡券';
						pdo_insert('n1ce_red_user', $insert);
						$nick = $mc['nickname'];
						$tempstr=str_replace("|#昵称#|",$nick,$settings['sendcard']);
						message('微信卡券发放成功！','','success');
					}
				}
				if($sends['type'] == '3'){
					pdo_query('update ' . tablename('n1ce_red_prize') . ' set prizesum = prizesum - 1 where uniacid = :uniacid and type = :type and pici = :pici', array(':uniacid' => $_W['uniacid'],':type' => 3 ,'pici' => $pici));
					$insert['money'] = '第三方链接';
						pdo_insert('n1ce_red_user', $insert);
					//return $this->respText("@".$mc['nickname']."恭喜你获得神秘礼品"."\n\n<a href='{$sends['url']}'>点击领取>>></a>");
					message('正在跳转到领取页，请稍候！' , $sends['url'],'success');
					//return $this->respText($sends['url']);
				}
				if($sends['type'] == '4'){
					pdo_query('update ' . tablename('n1ce_red_prize') . ' set prizesum = prizesum - 1 where uniacid = :uniacid and type = :type and pici = :pici', array(':uniacid' => $_W['uniacid'],':type' => 4 ,'pici' => $pici));
					$insert['money'] = '微擎积分';
						pdo_insert('n1ce_red_user', $insert);
					//return $this->respText("@".$mc['nickname']."恭喜你获得神秘礼品"."\n\n<a //href='{$sends['url']}'>点击领取>>></a>");
					load()->model('mc');
					$uid = mc_openid2uid($openid);
					$res = mc_credit_update($uid, 'credit1', $sends['credit'], array(0, '系统积分'.$sends['credit'].'积分'));
					if($res){
						$nick = $mc['nickname'];
						$tempstr=str_replace("|#昵称#|",$nick,$settings['sendcredit']);
						$credit = $sends['credit'];
						$tempstrs = str_replace("|#积分#|",$credit,$tempstr);
						//return $this->respText($tempstrs);
						message('恭喜你获得积分！','','success');
					}
					//return $this->respText($sends['url']);
				}
			if($sends['type'] == '7'){
				$settings = $this->module['config'];
				if($settings['brrow'] == '2'){
					
					$openid = $brrow['openid'];
				}
				
				$action = $this->sendRedgroupPacket($openid, $money,$sends['total_num']);
				pdo_query('update ' . tablename('n1ce_red_prize') . ' set prizesum = prizesum - 1 where uniacid = :uniacid and type = :type and pici = :pici', array(':uniacid' => $_W['uniacid'],':type' => 7 ,'pici' => $pici));
				
				if($action === true){
					//替换粉丝标志换成昵称
					$userdata = array(
					'nickname' => $mc['nickname'],
					);
					pdo_insert('n1ce_red_user', $insert);
					//pdo_update('n1ce_reds_code',$userdata,array('uniacid' => $_W['uniacid'],'code' => $content),'AND');
					message('红包发送成功','','success');
				}else{
					$insert['status'] = '2';
					pdo_insert('n1ce_red_user', $insert);
					$actions = "亲爱的管理员，有粉丝红包领取失败！\n原因：".$action;
					$this->sendText($settings['mopenid'],$actions);
					message('红包发送失败!','','error');
				}
			}
			
		}else{
			message('验证码无效!','','error');
			//return $this->respText($content);
		}
		}

		include $this->template( 'index' );	
	}
	public function doMobileRedurl(){
		//借权获取openid并发红包
		global $_W, $_GPC;
		$settings = $this->module['config'];
		$brrow = mc_oauth_userinfo();
		$total_num = $_GPC['total_num'];
		$bropenid = $brrow['openid'];
		$openid = base64_decode($_GPC['openid']);
		$money = $_GPC['money'];
		$time = $_GPC['time'];
		if($_W['openid'] !== $openid){
			
			$data = "微信账号异常，请前往安全中心解封！";
		}
		$res = pdo_fetch('select * from' . tablename('n1ce_red_user') . ' where openid = :openid and uniacid = :uniacid and money = :money and time = :time and status = 3', array(':uniacid' => $_W['uniacid'], ':openid' => $openid, ':money' => $money, ':time' => $time));
		
		if(!$res){
			if(empty($openid) || empty($money) || empty($time)){
				$data = "温馨提示：非法入口！";
			}else{
				$data = "biu,发射了！";
			}
		}else{
			if(empty($total_num)){
				$action = $this->sendRedPacket($bropenid, $money);
			}else{
				$action = $this->sendRedgroupPacket($bropenid,$money,$total_num);
			}
			
			
			if($action === true){
				$data = "恭喜你获得红包！";
				$binsert = array(
					'bopenid' => $bropenid,
					'nickname' => $brrow['nickname'],
					'status' => '1',
				);
				pdo_update('n1ce_red_user',$binsert, array('uniacid' => $_W['uniacid'], 'openid' => $openid, 'money' => $money, 'time' => $time));
				$text = "亲爱的粉丝，请返回微信聊天主页面查看红包消息！";
				$this->sendText($openid,$text);
			}else{
				$data = "红包正在排队发放中！！";
				$binsert = array(
					'bopenid' => $bropenid,
					'nickname' => $brrow['nickname'],
					'status' => '2',
				);
				pdo_update('n1ce_red_user',$binsert, array('uniacid' => $_W['uniacid'], 'openid' => $openid, 'money' => $money, 'time' => $time));
				
				$actions = "亲爱的管理员，有粉丝红包领取失败！\n原因：".$action;
				$this->sendText($settings['mopenid'],$actions);
			}
		}
		
		include $this->template( 'redurl' );
	}
	//后台管理页面
	public function doWebIndex() {
		global $_W, $_GPC;
		checklogin();
		if (checksubmit( 'submit' )) {

				$data = array();
				$data['uniacid']              = intval( $_W['uniacid'] );
				$data['bgimg']       = $_GPC['bgimg'];
			$result = pdo_insert( 'n1ce_red_pic', $data );
			if (!$result) message( '添加失败!', '', 'error' );
			message( '创建成功!', 'refresh', 'success' );
		}
		$data = pdo_fetch('select * from ' . tablename('n1ce_red_pic') . ' where uniacid = :uniacid order by id DESC', array(':uniacid' => $_W['uniacid']));
		include $this->template( 'index' );
	}
	//import_request_variables
	public function doWebImport()
	{
		global $_W, $_GPC;
		load()->func('logging');
		$pici = $_GPC['pici'];
		
		if (!empty($_GPC['foo'])) {
			try {
				include_once "reader.php";
				$tmp = $_FILES['file']['tmp_name'];
				if (empty($tmp)) {
					echo '请选择要导入的Excel文件！';
					die;
				}
				$file_name = IA_ROOT . "/addons/n1ce_redcode/xls/code.xls";
				$uniacid = $_W['uniacid'];
				
				if (copy($tmp, $file_name)) {
					$xls = new Spreadsheet_Excel_Reader();
					$xls->setOutputEncoding('utf-8');
					$xls->read($file_name);
					$data_values = "";
					$count = $xls->sheets[0]['numRows'];
					for ($i = 1; $i <= $count; $i++) {
						$code = $xls->sheets[0]['cells'][$i][1];
						
						$data = array(
							'uniacid' => $_W['uniacid'],
							'code' => $code,
							'pici' => $pici,
							'time' => TIMESTAMP,
						);
						$res = pdo_insert('n1ce_red_code',$data);
					}
					if ($res) {
						pdo_query("update " . tablename("n1ce_red_pici") . " set codenum = codenum + {$count} where pici = :pici and uniacid =:uniacid", array(":pici" => $pici, ":uniacid" => $uniacid));
						$url = $this->createWebUrl('code');
						echo '<script>alert(\'导入成功！\')</script>';
						echo "<script>window.location.href= '{$url}'</script>";
					} else {
						$url = $this->createWebUrl('Import', array());
						echo '<script>alert(\'导入失败！\')</script>';
						echo "<script>window.location.href= '{$url}'</script>";
					}
				} else {
					echo '复制失败！';
					die;
				}
			} catch (Exception $e) {
				logging_run($e, '', 'upload_tiku');
			}
		} else {
			include $this->template('import');
		}
	}
	//卡密删除
	public function doWebMiss() {
		global $_GPC, $_W;
		checklogin();
		$res = pdo_fetch('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 2', array(':uniacid' => $_W['uniacid']));
		if($res){
		pdo_delete('n1ce_red_code', array('uniacid' => $_W['uniacid'] ,'status' =>'2'));
		message('删除成功',$this->createWebUrl("code"),'success');
		}else{
			message('暂无已使用卡密',$this->createWebUrl("code"),'error');
		}
	}
	//每批次卡密删除
	public function doWebCodedie() {
		global $_GPC, $_W;
		checklogin();
		$pici = $_GPC['pici'];
		$res = pdo_fetch('select * from ' . tablename('n1ce_red_pici') . ' where uniacid = :uniacid and pici = :pici', array(':uniacid' => $_W['uniacid'] ,':pici' => $pici));
		if($res){
		pdo_delete('n1ce_red_pici', array('uniacid' => $_W['uniacid'],'pici' => $pici));
		pdo_delete('n1ce_red_code', array('uniacid' => $_W['uniacid'],'pici' => $pici));
		pdo_delete('n1ce_red_prize', array('uniacid' => $_W['uniacid'],'pici' => $pici));
		pdo_query('update ' . tablename('qrcode') . ' set redcode = 2 where uniacid = :uniacid and qrcid > 10000000 and pici = :pici', array(':uniacid' => $_W['uniacid'],':pici' => $pici));
		message('删除成功',$this->createWebUrl("code"),'success');
		}else{
			message('暂无卡密',$this->createWebUrl("code"),'error');
		}
	}
	//二维码失效假装失效
	public function doWebQrbad() {
		global $_GPC, $_W;
		checklogin();
		$res = pdo_query('update ' . tablename('qrcode') . ' set redcode = 2 where uniacid = :uniacid and qrcid > 10000000 and model = 1', array(':uniacid' => $_W['uniacid']));
		if($res){
		message('二维码失效',$this->createWebUrl("qrshow"),'success');
		}else{
			message('暂无可用二维码',$this->createWebUrl("qrshow"),'error');
		}
	}
	public function doWebQrbad2() {
		global $_GPC, $_W;
		checklogin();
		$res = pdo_query('delete from ' . tablename('qrcode') . ' where uniacid = :uniacid and qrcid > 10000000 and model = 2', array(':uniacid' => $_W['uniacid']));
		if($res){
		message('二维码失效',$this->createWebUrl("qrlong"),'success');
		}else{
			message('暂无可用二维码',$this->createWebUrl("qrlong"),'error');
		}
	}
	public function doWebSendred(){
		global $_W ,$_GPC;
		checklogin();
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if($operation=="send"){
			$id = $_GPC['id'];
			$money = $_GPC['money'];
			$openid = $_GPC['openid'];
			$res = $this->sendRedPacket($openid,$money);
			if($res === true){
				pdo_query('update ' . tablename('n1ce_red_user') . ' set status = 1 where uniacid = :uniacid and id = :id', array(':uniacid' => $_W['uniacid'],':id' => $id));
				message('恭喜你，红包发送成功', $this->createWebUrl('usershow'), 'success');
			}else{
				message($res,'','error');
			}
			
		}	
	}
	private function sendRedPacket($openid,$money){
		global $_W,$_GPC;
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
		load()->func('communication');
		$pars = array();
		$cfg = $this->module['config'];
		$pars['nonce_str'] = random(32);
		$pars['mch_billno'] = $cfg['pay_mchid'] . date('YmdHis') . rand( 100, 999 );
		$pars['mch_id'] = $cfg['pay_mchid'];
		$pars['wxappid'] = $cfg['appid'];
		$pars['send_name'] = $cfg['send_name'];
		$pars['re_openid'] = $openid;
		$pars['total_amount'] = $money;
		$pars['total_num'] = 1;
		$pars['wishing'] = $cfg['wishing'];
		$pars['client_ip'] = $_W['clientip'];
		$pars['act_name'] = $cfg['act_name'];
		$pars['remark'] = $cfg['remark'];
		ksort($pars, SORT_STRING);
		$string1 = '';
		foreach($pars as $k => $v) {
			$string1 .= "{$k}={$v}&";
		}
		$string1 .= "key={$cfg['pay_signkey']}";
		$pars['sign'] = strtoupper(md5($string1));
		$xml = array2xml($pars);
		$extras = array();
		$extras['CURLOPT_CAINFO'] = IA_ROOT .'/attachment/n1ce_redcode/cert_2/' . $_W['uniacid'] . '/' . $cfg['rootca'];
		$extras['CURLOPT_SSLCERT'] = IA_ROOT .'/attachment/n1ce_redcode/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_cert'];
		$extras['CURLOPT_SSLKEY'] = IA_ROOT .'/attachment/n1ce_redcode/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_key'];
		$procResult = false;
		$resp = ihttp_request($url, $xml, $extras);
		if(is_error($resp)) {
			$setting = $this->module['config'];
			$setting['api']['error'] = $resp['message'];
			$this->saveSettings($setting);
			$procResult = $resp['message'];
		} else {
			$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
			$dom = new DOMDocument();
			if($dom->loadXML($xml)) {
				$xpath = new DOMXPath($dom);
				$code = $xpath->evaluate('string(//xml/return_code)');
				$ret = $xpath->evaluate('string(//xml/result_code)');
				if(strtolower($code) == 'success' && strtolower($ret) == 'success') {
					$procResult = true;
					$setting = $this->module['config'];
					$setting['api']['error'] = '';
					$this->saveSettings($setting);
				} else {
					$error = $xpath->evaluate('string(//xml/err_code_des)');
					$setting = $this->module['config'];
					$setting['api']['error'] = $error;
					$this->saveSettings($setting);
					$procResult = $error;
				}
			} else {
				$procResult = 'error response';
			}
		}
		return $procResult;
	}
	
	private function sendRedgroupPacket($openid,$money,$total_num){
		global $_W,$_GPC;
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendgroupredpack';
		load()->func('communication');
		$pars = array();
		$cfg = $this->module['config'];
		$pars['nonce_str'] = random(32);
		$pars['mch_billno'] = $cfg['pay_mchid'] . date('YmdHis') . rand( 100, 999 );
		$pars['mch_id'] = $cfg['pay_mchid'];
		$pars['wxappid'] = $cfg['appid'];
		//$pars['nick_name'] = $cfg['nick_name'];
		$pars['send_name'] = $cfg['send_name'];
		$pars['re_openid'] = $openid;
		$pars['total_amount'] = $money;
		$pars['total_num'] = $total_num;
		$pars['amt_type'] = 'ALL_RAND';
		$pars['wishing'] = $cfg['wishing'];
		$pars['act_name'] = $cfg['act_name'];
		$pars['remark'] = $cfg['remark'];
		ksort($pars, SORT_STRING);
		$string1 = '';
		foreach($pars as $k => $v) {
			$string1 .= "{$k}={$v}&";
		}
		$string1 .= "key={$cfg['pay_signkey']}";
		$pars['sign'] = strtoupper(md5($string1));
		$xml = array2xml($pars);
		$extras = array();
		$extras['CURLOPT_CAINFO'] = IA_ROOT .'/attachment/n1ce_redcode/cert_2/' . $_W['uniacid'] . '/' . $cfg['rootca'];
		$extras['CURLOPT_SSLCERT'] = IA_ROOT .'/attachment/n1ce_redcode/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_cert'];
		$extras['CURLOPT_SSLKEY'] = IA_ROOT .'/attachment/n1ce_redcode/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_key'];
		$procResult = false;
		$resp = ihttp_request($url, $xml, $extras);
		if(is_error($resp)) {
			$setting = $this->module['config'];
			$setting['api']['error'] = $resp['message'];
			$this->saveSettings($setting);
			$procResult = $resp['message'];
		} else {
			$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
			$dom = new DOMDocument();
			if($dom->loadXML($xml)) {
				$xpath = new DOMXPath($dom);
				$code = $xpath->evaluate('string(//xml/return_code)');
				$ret = $xpath->evaluate('string(//xml/result_code)');
				if(strtolower($code) == 'success' && strtolower($ret) == 'success') {
					$procResult = true;
					$setting = $this->module['config'];
					$setting['api']['error'] = '';
					$this->saveSettings($setting);
				} else {
					$error = $xpath->evaluate('string(//xml/err_code_des)');
					$setting = $this->module['config'];
					$setting['api']['error'] = $error;
					$this->saveSettings($setting);
					$procResult = $error;
				}
			} else {
				$procResult = 'error response';
			}
		}
		return $procResult;
	}
	
	//下载卡密
	public function  doWebUDownload2()
	{
		global $_GPC,$_W;
		checklogin();
		$list = pdo_fetchall('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 1 ORDER BY id ', array(':uniacid' => $_W['uniacid']));
		$tableheader = array('ID', $this->encode("卡密"),$this->encode("时间"));
		$html = "\xEF\xBB\xBF";
		foreach ($tableheader as $value) {  
			$html .= $value . "\t";
		}
		$html .= "\n";
		foreach ($list as $value) {
			$html .= $value['id'] . "\t";
			$html .= $this->encode( $value['code'] )  . "\t";
			$html .= ($value['time'] == 0 ? '' : date('Y-m-d H:i',$value['time'])) . "\n";

		}


		header("Content-type:text/csv");
		header("Content-Disposition:attachment; filename=卡密数据.xls");

		echo $html;
		exit();
	}
	
	function  encode($value)
	{
		return $value;
		return iconv("utf-8", "gb2312", $value);

	}
	
	public function  doWebUDownload()
	{
		global $_GPC,$_W;
		checklogin();
		$pici = $_GPC['pici'];
		$list = pdo_fetchall('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 1 and pici = :pici ORDER BY id ', array(':uniacid' => $_W['uniacid'], ':pici' => $pici));
		
		$str = "ID\t卡密\t生成时间\n";
		
		foreach ($list as $vo) {
			$str .= $vo['id'] . "\t" . $vo['code'] . "\t" . date('Y-m-d H:i',$vo['time']) . "\n";
		}
		$filename = '卡密数据' . date('YmdHis') . '.xls';
		$this->export_csv( $filename, $str );
		
	}
	public function  doWebUserpost()
	{
		global $_GPC,$_W;
		checklogin();
		
		$list = pdo_fetchall('select * from ' . tablename('n1ce_red_user') . ' where uniacid = :uniacid and status = 1 ORDER BY id ', array(':uniacid' => $_W['uniacid']));
		
		$str = "粉丝昵称\t卡密\t奖品\n";
		
		foreach ($list as $vo) {
			$str .= $vo['nickname'] . "\t" . $vo['code'] . "\t" . $vo['name'] . "\n";
		}
		$filename = '领取数据' . date('YmdHis') . '.xls';
		$this->export_csv( $filename, $str );
		
	}
	public function  doWebUrldownload()
	{
		global $_GPC,$_W;
		checklogin();
		$pici = $_GPC['pici'];
		$acid = intval($_W['acid']);
		$wheresql = " WHERE uniacid = {$_W['uniacid']}";
		if($acid > 0) {
		$wheresql .= " AND acid = {$acid} ";
		}
		$wheresql .= " AND pici = {$pici} ";
		$wheresql .= " AND model = 1";
		$wheresql .= " AND make = 1";
		$wheresql .= " AND redcode = 1";
		$wheresql .= " AND qrcid > 10000000";
		pdo_query('update ' . tablename('qrcode') . ' set make = 1 where uniacid = :uniacid and model = 1 and redcode = 1 and qrcid > 10000000', array(':uniacid' => $_W['uniacid']));
		$list = pdo_fetchall("SELECT * FROM ".tablename('qrcode'). $wheresql . ' ORDER BY createtime DESC ');
		//$list = pdo_fetchall('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 1 ORDER BY id ', array(':uniacid' => $_W['uniacid']));
		
		$str = "卡密\t网址\t生成时间\n";
		
		foreach ($list as $vo) {
			$str .= $vo['keyword'] . "\t" . $vo['url'] . "\t" . date('Y-m-d H:i',$vo['createtime']) . "\n";
		}
		$filename = '卡密二维码数据' . date('YmdHis') . '.xls';
		$this->export_csv( $filename, $str );
		
	}
	public function  doWebUrldownload2()
	{
		global $_GPC,$_W;
		checklogin();
		$pici = $_GPC['pici'];
		$acid = intval($_W['acid']);
		$wheresql = " WHERE uniacid = {$_W['uniacid']}";
		if($acid > 0) {
		$wheresql .= " AND acid = {$acid} ";
		}
		$wheresql .= " AND pici = {$pici} ";
		$wheresql .= " AND model = 2";
		$wheresql .= " AND make = 1";
		$wheresql .= " AND redcode = 1";
		$wheresql .= " AND qrcid > 10000000";
		pdo_query('update ' . tablename('qrcode') . ' set make = 1 where uniacid = :uniacid and model = 2 and redcode = 1 and qrcid > 10000000', array(':uniacid' => $_W['uniacid']));
		$list = pdo_fetchall("SELECT * FROM ".tablename('qrcode'). $wheresql . ' ORDER BY createtime DESC ');
		//$list = pdo_fetchall('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 1 ORDER BY id ', array(':uniacid' => $_W['uniacid']));
		
		$str = "卡密\t网址\t生成时间\n";
		
		foreach ($list as $vo) {
			$str .= $vo['keyword'] . "\t" . $vo['url'] . "\t" . date('Y-m-d H:i',$vo['createtime']) . "\n";
		}
		$filename = '永久卡密二维码数据' . date('YmdHis') . '.xls';
		$this->export_csv( $filename, $str );
		
	}
	/**
 * 导出CSV
 *
 * @param $filename
 * @param $data
 */
	function export_csv($filename, $data) {
		header( "Content-type:text/csv" );
		header( "Content-Disposition:attachment;filename=" . $filename );
		header( 'Cache-Control:must-revalidate,post-check=0,pre-check=0' );
		header( 'Expires:0' );
		header( 'Pragma:public' );
		echo $data;
	}
	//生成二维码并关联关键字
	public function doWebQrcode() {
		global $_GPC, $_W;
		checklogin();
		load()->model('account');
		load()->func('communication');
		$pici = $_GPC['pici'];
		$acidarr = uni_accounts($_W['uniacid']);
		$acid = intval($_W['acid']);
		$uniacccount = WeAccount::create($acid);
		$ishave = pdo_fetchall('select * from ' . tablename('qrcode') . ' where qrcid = :qrcid ', array(':qrcid' => '10000000'));
		if(empty($ishave)){
			$insert = array(
				'uniacid' => $_W['uniacid'],
				'acid' => $acid,
				'qrcid' => '10000000',
				'keyword' => 'redcode',
				'name' => 'redcode',
				'model' => '1',
				'createtime' => TIMESTAMP,
				'status' => '1',
				'pici' => '0',
			);
			pdo_insert('qrcode', $insert);
		}
		
		$res = pdo_fetchall('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 1 and pici = :pici and iscqr = 1 limit 50', array(':uniacid' => $_W['uniacid'], ':pici' => $pici));
		foreach($res as $key => $vol){
			$keyword = $vol['code'];
			$qrcid = pdo_fetchcolumn("SELECT qrcid FROM ".tablename('qrcode')." WHERE model = '1' ORDER BY qrcid DESC", array(':acid' => $acid));
			$barcode['action_info']['scene']['scene_id'] = !empty($qrcid) ? ($qrcid+1) : 10000001;
			$barcode['expire_seconds'] = '2592000';
			$barcode['action_name'] = 'QR_SCENE';
			$result = $uniacccount->barCodeCreateDisposable($barcode);
			if(!is_error($result)) {
			$insert = array(
				'uniacid' => $_W['uniacid'],
				'acid' => $acid,
				'qrcid' => $barcode['action_info']['scene']['scene_id'],
				'keyword' => $keyword,
				'name' => 'redcode',
				'model' => '1',
				'ticket' => $result['ticket'],
				'url' => $result['url'],
				'expire' => $result['expire_seconds'],
				'createtime' => TIMESTAMP,
				'status' => '1',
				'pici' => $pici,
			);
			$result = pdo_insert('qrcode', $insert);
			if($result){
				pdo_query('update ' . tablename('n1ce_red_code') . ' set iscqr = 2 where uniacid = :uniacid and code = :code and pici = :pici', array(':uniacid' => $_W['uniacid'],':code' => $keyword,':pici' => $pici));
			}
			}
			
		}
		$res2 = pdo_fetchall('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 1 and iscqr = 1 and pici = :pici', array(':uniacid' => $_W['uniacid'],':pici' => $pici));
		if($res2){
			message('请勿刷新，二维码继续生成中', $this->createWebUrl('Qrcode',array('pici' => $pici)), 'success');
		}else{
			message('恭喜，生成带参数二维码成功！', $this->createWebUrl('code'), 'success');
		}
		
		
	}
	public function doWebQrcode2() {
		global $_GPC, $_W;
		checklogin();
		load()->model('account');
		load()->func('communication');
		$acidarr = uni_accounts($_W['uniacid']);
		$acid = intval($_W['acid']);
		$pici = $_GPC['pici'];
		$uniacccount = WeAccount::create($acid);
		//$scene_str = trim($_GPC['scene_str']) ? trim($_GPC['scene_str'])  : message('场景值不能为空');
		$ishave = pdo_fetchall('select * from ' . tablename('qrcode') . ' where qrcid = :qrcid ', array(':qrcid' => '10000000'));
		if(empty($ishave)){
			$insert = array(
				'uniacid' => $_W['uniacid'],
				'acid' => $acid,
				'qrcid' => '10000000',
				'keyword' => 'redcode',
				'name' => 'redcode',
				'model' => '1',
				'createtime' => TIMESTAMP,
				'status' => '1',
				'make' => '2',
				'pici' => '0',
			);
			pdo_insert('qrcode', $insert);
		}
		$res = pdo_fetchall('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 1 and pici = :pici and iscqr = 1 limit 50', array(':uniacid' => $_W['uniacid'], ':pici' => $pici));
		foreach($res as $key => $vol){
			$keyword = $vol['code'];
			$qrcid = pdo_fetchcolumn("SELECT qrcid FROM ".tablename('qrcode')." WHERE model = '1' or model = '2' ORDER BY qrcid DESC", array(':acid' => $acid));
			//$barcode['action_info']['scene']['scene_id'] = !empty($qrcid) ? ($qrcid+1) : 10000001;
			$barcode['action_info']['scene']['scene_str'] = $this->createNonceStr(8);
			$barcode['action_name'] = 'QR_LIMIT_STR_SCENE';
			$result = $uniacccount->barCodeCreateFixed($barcode);
			if(!is_error($result)) {
			$insert = array(
				'uniacid' => $_W['uniacid'],
				'acid' => $acid,
				'qrcid' => !empty($qrcid) ? ($qrcid+1) : 10000001,
				'scene_str' => $barcode['action_info']['scene']['scene_str'],
				'keyword' => $keyword,
				'name' => 'redcode',
				'model' => '2',
				'ticket' => $result['ticket'],
				'url' => $result['url'],
				'expire' => $result['expire_seconds'],
				'createtime' => TIMESTAMP,
				'status' => '1',
				'make' => '2',
				'type' => 'scene',
				'pici' => $pici,
			);
			$result = pdo_insert('qrcode', $insert);
			if($result){
				pdo_query('update ' . tablename('n1ce_red_code') . ' set iscqr = 2 where uniacid = :uniacid and code = :code and pici = :pici', array(':uniacid' => $_W['uniacid'],':code' => $keyword,':pici' => $pici));
			}
			}
			
		}
		$res2 = pdo_fetchall('select * from ' . tablename('n1ce_red_code') . ' where uniacid = :uniacid and status = 1 and iscqr = 1 and pici = :pici', array(':uniacid' => $_W['uniacid'] , ':pici' => $pici));
		if($res2){
			message('请勿刷新，二维码继续生成中', $this->createWebUrl('Qrcode2',array('pici' => $pici)), 'success');
		}else{
			message('恭喜，生成带参数二维码成功！', '', 'success');
		}
		
		
	}
	//打包二维码图片
	private $qrcode = "../addons/n1ce_redcode/qrcode/redcode#sid#.png";
	public function doWebDown(){
		global $_W,$_GPC;
		include "phpqrcode.php";/*引入PHP QR库文件*/
		$rid = $_W['uniacid'];
		$acid = intval($_W['acid']);
		$wheresql = " WHERE uniacid = {$_W['uniacid']}";
		if($acid > 0) {
		$wheresql .= " AND acid = {$acid} ";
		}
		$wheresql .= " AND model = 1";
		$wheresql .= " AND make = 1";
		$wheresql .= " AND redcode = 1";
		$wheresql .= " AND qrcid > 10000000";
		pdo_query('update ' . tablename('qrcode') . ' set make = 1 where uniacid = :uniacid and model = 1 and redcode = 1 and qrcid > 10000000', array(':uniacid' => $_W['uniacid']));
		$scenes = pdo_fetchall("SELECT * FROM ".tablename('qrcode'). $wheresql . ' ORDER BY createtime DESC ');
			if (!empty($scenes)){//已生成过二维码的 直接取出
				foreach ($scenes as $value) {
					$this->createQrcode($value['url'],$value['qrcid']."_{$rid}");
				}
			}
			$qrs = '';
			foreach($scenes as $val){
				$qrs .= str_replace('#sid#',$val['qrcid']."_{$rid}",$this->qrcode).",";
			}
			//打包下载
			include 'pclzip.lib.php';
			$archive = new PclZip("qrcode{$rid}.zip");
			$v_list = $archive->create($qrs,PCLZIP_OPT_REMOVE_ALL_PATH);
			$fileres = file_get_contents("qrcode{$rid}.zip");
			header('Content-type: x-zip-compressed');
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="二维码_'.$rid.'.zip"');
			echo $fileres;
			@unlink($fileres);
		
	}
	public function doWebNewdown(){
		global $_W,$_GPC;
		include "phpqrcode.php";/*引入PHP QR库文件*/
		$rid = $_W['uniacid'];
		$pici = $_GPC['pici'];
		$acid = intval($_W['acid']);
		$wheresql = " WHERE uniacid = {$_W['uniacid']}";
		if($acid > 0) {
		$wheresql .= " AND acid = {$acid} ";
		}
		$wheresql .= " AND pici = {$pici} ";
		$wheresql .= " AND model = 2";
		$wheresql .= " AND make = 1";
		$wheresql .= " AND redcode = 1";
		$wheresql .= " AND qrcid > 10000000";
		$scenes = pdo_fetchall("SELECT * FROM ".tablename('qrcode'). $wheresql . ' ORDER BY createtime DESC ');
		pdo_query('update ' . tablename('qrcode') . ' set make = 1 where uniacid = :uniacid and model = 2 and redcode = 1 and qrcid > 10000000', array(':uniacid' => $_W['uniacid']));
		$scenes = pdo_fetchall("SELECT * FROM ".tablename('qrcode'). $wheresql . ' ORDER BY createtime DESC ');
			if (!empty($scenes)){//已生成过二维码的 直接取出
				foreach ($scenes as $value) {
					$this->createQrcode($value['url'],$value['qrcid']."_{$rid}");
				}
			}
			$qrs = '';
			foreach($scenes as $val){
				$qrs .= str_replace('#sid#',$val['qrcid']."_{$rid}",$this->qrcode).",";
			}
			//打包下载
			include 'pclzip.lib.php';
			$archive = new PclZip("qrcode{$rid}.zip");
			$v_list = $archive->create($qrs,PCLZIP_OPT_REMOVE_ALL_PATH);
			$fileres = file_get_contents("qrcode{$rid}.zip");
			header('Content-type: x-zip-compressed');
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="二维码_'.$rid.'.zip"');
			echo $fileres;
			@unlink($fileres);
		
	}
	public function doWebDown2(){
		global $_W,$_GPC;
		include "phpqrcode.php";/*引入PHP QR库文件*/
		$rid = $_W['uniacid'];
		$acid = intval($_W['acid']);
		$wheresql = " WHERE uniacid = {$_W['uniacid']}";
		if($acid > 0) {
		$wheresql .= " AND acid = {$acid} ";
		}
		$wheresql .= " AND redcode = 1";
		$wheresql .= " AND model = 2";
		$wheresql .= " AND qrcid > 10000000";
		$scenes = pdo_fetchall("SELECT * FROM ".tablename('qrcode'). $wheresql . ' ORDER BY createtime DESC ');
			if (!empty($scenes)){//已生成过二维码的 直接取出
				foreach ($scenes as $value) {
					$this->createQrcode($value['url'],$value['scene_str']."_{$rid}");
				}
			}
			$qrs = '';
			foreach($scenes as $val){
				$qrs .= str_replace('#sid#',$val['scene_str']."_{$rid}",$this->qrcode).",";
			}
			//打包下载
			include 'pclzip.lib.php';
			$archive = new PclZip("qrcode{$rid}.zip");
			$v_list = $archive->create($qrs,PCLZIP_OPT_REMOVE_ALL_PATH);
			$fileres = file_get_contents("qrcode{$rid}.zip");
			header('Content-type: x-zip-compressed');
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="二维码_'.$rid.'.zip"');
			echo $fileres;
			@unlink($fileres);
		
	}
	/*
	public function getMenus() {
        $menus = array(
				array(
					'title' => '验证码生成',
					'url'   => $this->createWebUrl('code'),
					'icon'  => 'fa fa-calendar',
				),
				array(
					'title' => '二维码查看',
					'url'   => $this->createWebUrl('qrshow'),
					'icon'  => 'fa fa-qrcode',
				),
				array(
					'title' => '领取流水',
					'url'   => $this->createWebUrl('usershow'),
					'icon'  => 'fa fa-users',
				),
				array(
					'title' => '页面设置',
					'url'   => $this->createWebUrl('index'),
					'icon'  => 'fa fa-files-o',
				),
			);
			return $menus;
	}*/
	private function createQrcode($url,$sceneid){
		$qrcode = str_replace('#sid#',$sceneid,$this->qrcode);
		if (!file_exists($qrcode)){
			//二维码图片不存在的 重新生成
			$errorCorrectionLevel = "L";
			$matrixPointSize = "8";
			QRcode::png($url, $qrcode, $errorCorrectionLevel, $matrixPointSize);
		}
	}
	private function get_rand($proArr)
    {
        $result = '';
        $proSum = array_sum($proArr);
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset($proArr);
        return $result;
    }
	private function sendText($openid,$txt){
		global $_W;
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$data = $acc->sendCustomNotice(array('touser'=>$openid,'msgtype'=>'text','text'=>array('content'=>urlencode($txt))));
		return $data;
	}
	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str.= substr($chars, mt_rand(0, strlen($chars) - 1) , 1);
		}
		return $str;
	}
	private function sendWxCard($from_user, $cardid,$code = '') {
		load()->classs('weixin.account');
		load()->func('communication');
		$access_token = WeAccount::token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
	
		$now = time();
		$nonce_str = $this->createNonceStr(8);
		$data = array(
				'api_ticket'=>$this->getApiTicket($access_token),
				'nonce_str'=>$nonce_str,
				'timestamp'=>$now,
				'code'=>$code,
				'card_id'=>$cardid,
				'openid'=>$from_user,
		);
		ksort($data);
		$buff = "";
		foreach ($data as $v) {
			$buff .= $v;
		}
		$sign = sha1($buff);
		$card_ext = array('code'=>$code,'openid'=>$from_user,'signature'=>$sign);
		$post = '{"touser":"' . $from_user . '","msgtype":"wxcard","wxcard":{"card_id":"' . $cardid . '","card_ext":"'.json_encode($card_ext).'"}}';
		load()->func('communication');
		$res = ihttp_post($url, $post);
		$res = json_decode($res['content'],true);
		if ($res['errcode'] == 0) return true;
		return $res['errmsg'];
	}
	private function getApiTicket($access_token){
		global $_W, $_GPC;
		$w = $_W['uniacid'];
		$cookiename = "wx{$w}a{$w}pi{$w}ti{$w}ck{$w}et";
		$apiticket = $_COOKIE[$cookiename];
		if (empty($apiticket)){
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=wx_card";
			load()->func('communication');
			$res = ihttp_get($url);
			$res = json_decode($res['content'],true);
			if (!empty($res['ticket'])){
				setcookie($cookiename,$res['ticket'],time()+$res['expires_in']);
				$apiticket = $res['ticket'];
			}else{
				message('获取api_ticket失败：'.$res['errmsg']);
			}
		}
		return $apiticket;
	}
}