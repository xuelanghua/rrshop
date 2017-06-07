<?php
/**
 * 魔法相册模块定义
 *
 * @author junsion
 * @url http://s.we7.cc/index.php?c=store&a=author&uid=74516
 */
defined('IN_IA') or exit('Access Denied');
define('RES','../addons/junsion_album/template/mobile/');
define('OD_ROOT', IA_ROOT . '/addons/junsion_album/cert/');
class Junsion_albumModule extends WeModule {

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			$printinfo = $_GPC['print_price'];
			$set_meal = array();
			foreach($printinfo as $k => $v){
				if(!empty($v)){
					$set_meal[$k] = array(
							'price' => $v,
							'num' => $_GPC['print_num'][$k],
					);
				}
			}
			
			$dat = array(
				'access_key'=>$_GPC['access_key'],
				'secret_key'=>$_GPC['secret_key'],
				'bucket'=>$_GPC['bucket'],
				'qiniuUrl'=>$_GPC['qiniuUrl'],
				'isqiniu'=>$_GPC['isqiniu'],
				'ydyy' => $_GPC['ydyy'],
				'help' => $_GPC['help'],
				'bgtheme' => $_GPC['bgtheme'],
				'fonttheme' => $_GPC['fonttheme'],
				'bgother' => $_GPC['bgother'],
				'fontother' => $_GPC['fontother'],
				'bgcate' => $_GPC['bgcate'],
				'fontcate' => $_GPC['fontcate'],
				'fontcateon' => $_GPC['fontcateon'],
				'bgbtns' => $_GPC['bgbtns'],
				'fontbtns' => $_GPC['fontbtns'],
				'bgself' => $_GPC['bgself'],
				'fontself' => $_GPC['fontself'],
				'icon_play' => $_GPC['icon_play'],
				'icon_pause' => $_GPC['icon_pause'],
				'icon_done' => $_GPC['icon_done'],
				'icon_del' => $_GPC['icon_del'],
				'icon_lock' => $_GPC['icon_lock'],
				'goodscore' => $_GPC['goodscore'],
				'icon_unlock' => $_GPC['icon_unlock'],
				'appid' => $_GPC['appid'],
				'apikey' => $_GPC['apikey'],
				'mchid' => $_GPC['mchid'],
				'appsecret' => $_GPC['appsecret'],
				'reward_money' => $_GPC['reward_money'],
				'auth' => $_GPC['auth'],
				'ip' => $_GPC['ip'],
				'credit' => $_GPC['credit'],
				'musicsearch' => $_GPC['musicsearch'],
				'pipeline' => $_GPC['pipeline'],
				'payrate' => $_GPC['payrate'],
				'paydesc' => $_GPC['paydesc'],
				'notify_title1' => $_GPC['notify_title1'],
				'notify_title2' => $_GPC['notify_title2'],
				'notify_url1' => $_GPC['notify_url1'],
				'notify_url2' => $_GPC['notify_url2'],
				'adv1' => $_GPC['adv1'],
				'adv_url1' => $_GPC['adv_url1'],
				'adv_switch1' => $_GPC['adv_switch1'],
				'adv2' => $_GPC['adv2'],
				'adv_url2' => $_GPC['adv_url2'],
				'adv_switch2' => $_GPC['adv_switch2'],
				'print_meal' => serialize($set_meal),
				'slide' => serialize($_GPC['slide']),
				'custom_url' => $_GPC['custom_url'],
				'close_order' => intval($_GPC['close_order']),
				'share_title' => $_GPC['share_title'],
				'share_desc' => $_GPC['share_desc'],
				'share_thumb' => $_GPC['share_thumb'],
				'ms_title' => $_GPC['ms_title'],
				'ms_desc' => $_GPC['ms_desc'],
				'ms_thumb' => $_GPC['ms_thumb'],
				'qs_title' => $_GPC['qs_title'],
				'qs_desc' => $_GPC['qs_desc'],
				'qs_thumb' => $_GPC['qs_thumb'],
				'ps_title' => $_GPC['ps_title'],
				'ps_desc' => $_GPC['ps_desc'],
				'ps_thumb' => $_GPC['ps_thumb'],
			);
			
			//微信支付商户功能参数设置
			load()->func('file');
			mkdirs(OD_ROOT);
			$r = true;
			if(!empty($_GPC['cert'])) {
				$ret = file_put_contents(OD_ROOT .md5("apiclient_{$_W['uniacid']}cert").".pem", trim($_GPC['cert']));
				$r = $r && $ret;
			}
			if(!empty($_GPC['key'])) {
				$ret = file_put_contents(OD_ROOT .md5("apiclient_{$_W['uniacid']}key").".pem", trim($_GPC['key']));
				$r = $r && $ret;
			}
			if(!empty($_GPC['ca'])) {
				$ret = file_put_contents(OD_ROOT .md5("root{$_W['uniacid']}ca").".pem", trim($_GPC['ca']));
				$r = $r && $ret;
			}
			if(!$r) {
				message('证书保存失败, 请保证 '.OD_ROOT.' 目录可写');
			}
			
			if ($this->saveSettings($dat)){
				message('保存成功！','refresh','success');
			}
		}
		$print_set = unserialize($settings['print_meal']);
		$setslide = unserialize($settings['slide']);
		//这里来展示设置项表单
		include $this->template('setting');
	}

}