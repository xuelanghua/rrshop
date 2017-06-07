<?php
/**
 * 验证码生成模块模块定义
 *
 * @author n1ce   QQ：541535641
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class N1ce_redcodeModule extends WeModule {

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		if (checksubmit()) {
			$cfg = array(
				'appid' => trim($_GPC['appid']),
				'appsecret' => trim($_GPC['appsecret']),
				'pay_mchid' => $_GPC['pay_mchid'],
				'pay_signkey' => $_GPC['pay_signkey'],
				'act_name' => $_GPC['act_name'],
				'wishing' => $_GPC['wishing'],
				'remark' => $_GPC['remark'],
				'nick_name' => $_GPC['nick_name'],
				'send_name' => $_GPC['send_name'],
				'mopenid' => $_GPC['mopenid'],
				'commonmoney' => $_GPC['commonmoney'],
				'sendred' => $_GPC['sendred'],
				'surl' => $_GPC['surl'],
				'xianzhi' => $_GPC['xianzhi'],
				'brrow' => $_GPC['brrow'],
				'sendcard' => $_GPC['sendcard'],
				'sendurl' => $_GPC['sendurl'],
				'wrong' => $_GPC['wrong'],
				'islater' => $_GPC['islater'],
				'sendbad' => $_GPC['sendbad'],
				'sendcredit' => $_GPC['sendcredit'],
				'isget' => $_GPC['isget'],
            );
			load()->func('file');
			$dir_url='../attachment/n1ce_redcode/cert_2/'.$_W['uniacid']."/";
			mkdirs($dir_url);
			$cfg['rootca']=$_GPC['rootca2'];
			$cfg['apiclient_cert']=$_GPC['apiclient_cert2'];
			$cfg['apiclient_key']=$_GPC['apiclient_key2'];
			if ($_FILES["rootca"]["name"]){
				if(file_exists($dir_url.$settings["rootca"]))@unlink ($dir_url.$settings["rootca"]);
				$cfg['rootca']=TIMESTAMP.".pem";
				move_uploaded_file($_FILES["rootca"]["tmp_name"],$dir_url.$cfg['rootca']);
			}
			if ($_FILES["apiclient_cert"]["name"]){
				if(file_exists($dir_url.$settings["apiclient_cert"]))@unlink ($dir_url.$settings["apiclient_cert"]);
				$cfg['apiclient_cert']="cert".TIMESTAMP.".pem";
				move_uploaded_file($_FILES["apiclient_cert"]["tmp_name"],$dir_url.$cfg['apiclient_cert']);
			}
			if ($_FILES["apiclient_key"]["name"]){
				if(file_exists($dir_url.$settings["apiclient_key"]))@unlink ($dir_url.$settings["apiclient_key"]);
				$cfg['apiclient_key']="key".TIMESTAMP.".pem";
				move_uploaded_file($_FILES["apiclient_key"]["tmp_name"],$dir_url.$cfg['apiclient_key']);
			}
            if ($this->saveSettings($cfg))message('保存成功', 'refresh');
        }
		load()->func('tpl');
		//这里来展示设置项表单
		include $this->template('setting');
	}

}