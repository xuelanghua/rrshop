<?php
/**
 * 快消红包模块处理程序
 *
 * @author 凡人 QQ：644157559
 * @url #
 */
defined('IN_IA') or exit('Access Denied');

class Fr_hbModuleProcessor extends WeModuleProcessor {
	public function respond() {
            global $_W;
            if (preg_match('/^fr_hb_receive_/', $this->message['content'])) {//领取二维码奖品
                $receive_id = intval(str_replace("fr_hb_receive_", "", $this->message['content']));
                if ($receive_id > 0) {
                    include MODULE_ROOT . '/inc/common.php';
                    $receive = getDataById(fr_table('receive', false), $receive_id);
                    if (empty($receive) || $receive['status'] != 0 || $receive['openid'] != $this->message['from']) {
                        return NULL;
                    }
                    pdo_update(fr_table('receive', false), array("status" => 1, "createtime" => TIMESTAMP), array('id' => $receive_id));
                    $project = getProjectById($receive['project_id']);
                    $packet = getPacketById($receive['packet_id']);
                    openPacket($this->message['from'], $packet, $project, true);
                    
                    $qrcode = pdo_fetch("SELECT * FROM ".tablename('qrcode')." WHERE uniacid = :uniacid AND keyword = :keyword LIMIT 1", array(':uniacid' => $_W['uniacid'], ':keyword' => "fr_hb_receive_{$receive_id}"));
                    pdo_delete('qrcode', array('id' => $qrcode['id'], 'uniacid' => $_W['uniacid']));
                    pdo_delete('qrcode_stat',array('qid' => $qrcode['id'], 'uniacid' => $_W['uniacid']));
                    
                    $money = $packet['money'] / 100;
                    $msg = '';
                    //发信息通知用户
                    if ($project['type'] == 1) {
                        $url = murl('mc/bond/credits', array('credittype' => 'credit1'), false, true);
                        $msg = "恭喜您获得{$project['title']}积分红包：{$money}<a href='{$url}'>查看</a>";
                    }elseif($project['type'] == 2) {
                        $url = murl('mc/bond/credits', array('credittype' => 'credit2'), false, true);
                        $msg = "恭喜您获得{$project['title']}余额红包：{$money}<a href='{$url}'>查看</a>";
                    }elseif($project['type'] == 3){
                        $msg = "恭喜您获得{$project['title']}现金红包：{$money}元，请到您的微信钱包查看。";
                    }elseif($project['type'] == 4){
                        $msg = "恭喜您获得{$project['title']}卡券，请到您的微信卡券查看。";
                    }
                    return $this->respText($msg);
                }else{
                    return NULL;
                }
            }
            elseif (preg_match('/^fr_hb_draw_/', $this->message['content'])) {//领取抽奖奖品
                $log_id = intval(str_replace("fr_hb_draw_", "", $this->message['content']));
                if ($log_id > 0) {
                    include MODULE_ROOT . '/inc/common.php';
                    $log = getDataById(fr_table('draw_log', false), $log_id);
                    if (empty($log) || $log['status'] != 0 || $log['openid'] != $this->message['from']) {
                        return NULL;
                    }
                    pdo_update(fr_table('draw_log', false), array("status" => 1, "createtime" => TIMESTAMP), array('id' => $log_id));
                    $project = getProjectById($log['project_id']);
                    $draws = getDataById(fr_table('draw', false), $log['draw_id']);
                    sendDrawReward($this->message['from'], $draws, $project, true);
                    
                    $qrcode = pdo_fetch("SELECT * FROM ".tablename('qrcode')." WHERE uniacid = :uniacid AND keyword = :keyword LIMIT 1", array(':uniacid' => $_W['uniacid'], ':keyword' => "fr_hb_draw_{$log_id}"));
                    pdo_delete('qrcode', array('id' => $qrcode['id'], 'uniacid' => $_W['uniacid']));
                    pdo_delete('qrcode_stat',array('qid' => $qrcode['id'], 'uniacid' => $_W['uniacid']));
                    
                    $money = $draws['prize'] / 100;
                    $msg = '';
                    //发信息通知用户
                    if ($draws['type'] == 1) {
                        $url = murl('mc/bond/credits', array('credittype' => 'credit1'), false, true);
                        $msg = "恭喜您,抽中奖品“{$draws['name']}”获得积分奖励：{$money}<a href='{$url}'>查看</a>";
                    }elseif($draws['type'] == 2) {
                        $url = murl('mc/bond/credits', array('credittype' => 'credit2'), false, true);
                        $msg = "恭喜您,抽中奖品“{$draws['name']}”获得余额奖励：{$money}<a href='{$url}'>查看</a>";
                    }elseif($draws['type'] == 3){
                        $msg = "恭喜您,抽中奖品“{$draws['name']}”获得现金红包：{$money}元，请到您的微信钱包查看。";
                    }elseif($draws['type'] == 4){
                        $msg = "恭喜您,抽中奖品“{$draws['name']}”获得卡券，请到您的微信卡包查看。";
                    }
                    return $this->respText($msg);
                }else{
                    return NULL;
                }
            }
            return NULL;
	}
}