<?php
/**
 * 快消红包模块订阅器
 *
 * @author 凡人 QQ：644157559
 * @url #
 */
defined('IN_IA') or exit('Access Denied');

class Fr_red_envelopeModuleReceiver extends WeModuleReceiver {
	public function receive() {
		$type = $this->message['type'];
		//这里定义此模块进行消息订阅时的, 消息到达以后的具体处理过程, 请查看微擎文档来编写你的代码
	}
}