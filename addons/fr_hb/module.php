<?php
/**
 * 快消红包模块定义
 *
 * @author 凡人 QQ：644157559
 * @url #
 */
defined('IN_IA') or exit('Access Denied');

class Fr_hbModule extends WeModule {

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
                include MODULE_ROOT . '/inc/common.php';
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
                load()->func('tpl');
		if(checksubmit()) {
                    $config = $_GPC['config'];
                    load()->func('file');
                    mkdirs(MODULE_ROOT . '/cert');
                    $r=true;
                    if(!empty($config['cert'])) {
                        $ret = file_put_contents(MODULE_ROOT . '/cert/apiclient_cert.pem.' . $_W['uniacid'], trim($config['cert']));
                        $r = $r && $ret;
                    }
                    if(!empty($config['key'])) {
                        $ret = file_put_contents(MODULE_ROOT . '/cert/apiclient_key.pem.' . $_W['uniacid'], trim($config['key']));
                        $r = $r && $ret;
                    }
                    if(!empty($config['ca'])) {
                        $ret = file_put_contents(MODULE_ROOT . '/cert/rootca.pem.' . $_W['uniacid'], trim($config['ca']));
                        $r = $r && $ret;
                    }
                    if(!$r) {
                        message("证书保存失败, 请保证 /addons/{$this->modulename}/cert/ 目录可写");
                    }
                    $allow_fields = array(
                        "numbers", "type", "min_money", "max_money", "mchid", "password",
                        "cert", "key", "ca", "ewmlogo", "subscribeurl", "copyright"
                    );
                    $dat = array_elements($allow_fields, $config);
                    //字段验证, 并获得正确的数据$dat
                    if ($this->saveSettings($dat)) {
                        message('保存配置成功', 'refresh');
                    }
		}
                $is_apiclient_cert = file_exists(MODULE_ROOT . '/cert/apiclient_cert.pem.' . $_W['uniacid']);
                $is_apiclient_key = file_exists(MODULE_ROOT . '/cert/apiclient_key.pem.' . $_W['uniacid']);
                $is_rootca = file_exists(MODULE_ROOT . '/cert/rootca.pem.' . $_W['uniacid']);
                $settings['numbers'] = $settings['numbers'] ? $settings['numbers'] : 100;
                $settings['type'] = $settings['type'] ? $settings['type'] : 2;
                $settings['min_money'] = $settings['min_money'] ? $settings['min_money'] : 1000;
                $settings['max_money'] = $settings['max_money'] ? $settings['max_money'] : 5000;
                $settings['ewmlogo'] = $settings['ewmlogo'] ? $settings['ewmlogo'] : "headimg_{$_W['uniacid']}.jpg";
		//这里来展示设置项表单
		include $this->template('setting');
	}

}