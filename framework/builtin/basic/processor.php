<?php
/**
 * [Weizan System] Copyright (c) 2014 WEIZANCMS.COM
 
 */
defined('IN_IA') or exit('Access Denied');

class BasicModuleProcessor extends WeModuleProcessor {
	
	public function respond() {
		//用户审核
		$content = $this->message['content'];
		$setting = uni_setting($_W['uniacid'], array('shenhe'));
		if(!empty($setting['shenhe']) && strpos($content,$setting['shenhe'])===0){
			$shenhe  = str_replace($setting['shenhe'],'',$content);
			if (pdo_fetch('SELECT * FROM ims_users WHERE username = :username', array(
				':username' => $shenhe
			)) === false) {
				$replys   = array();
				$replys[] = array(
					'title' => '账号：'. $shenhe . '，不存在该账号',
					'picurl' => 'shibai.jpg',
					'description' => $reply,
					'url'=> $_W['siteroot']
				);
				return $this->respNews($replys);
				$reply = '账号：'. $content . "不存在该账号: \n" . $reply;
				return $this->respText($reply);
			} else {
				$replys   = array();
				$replys[] = array(
					'title' => $shenhe . '，您的账号已开通',
					'picurl' => 'kaitong.jpg',
					'description' => $reply,
					'url'=> $_W['siteroot']
				);
				if ($shenhe == admin) {
				} else {
					pdo_query("UPDATE ims_users SET status=2 WHERE username=:username", array(
						':username' => $shenhe
					));
				}
				return $this->respNews($replys);
				$reply = $content . "您的账号已开通: \n" . $reply;
				return $this->respText($reply);
			}
		}
        
		//以上为用户审核
		$sql = "SELECT * FROM " . tablename('basic_reply') . " WHERE `rid` IN ({$this->rule})  ORDER BY RAND() LIMIT 1";
		$reply = pdo_fetch($sql);
		if (empty($reply)) {
			return false;
		}
		
		$reply['content'] = htmlspecialchars_decode($reply['content']);
				$reply['content'] = str_replace(array('<br>', '&nbsp;'), array("\n", ' '), $reply['content']);
		$reply['content'] = strip_tags($reply['content'], '<a>');
		return $this->respText($reply['content']);
	}
}
