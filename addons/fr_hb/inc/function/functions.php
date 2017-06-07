<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
function getNicknameByOpenid($openid) {
    load()->model("mc");
    $member = mc_fetch($openid, array('nickname'));
    return trim($member['nickname']) != '' ? $member['nickname'] : $openid;
}

/**
 * 
 * @param type $openid
 * @param type $credit
 * @param type $type
 * @param type $log_msg
 * @return type
 */
function addCredit($openid, $credit, $type = 'credit1', $log_msg = ''){
    load()->model('mc');
    $log = array();
    if ($log_msg) {
       $log = array(1, $log_msg); 
    }
    return mc_credit_update(mc_openid2uid($openid), $type, $credit, $log);
}
/**
 * 给用户增加积分
 * @param type $openid
 * @param type $credit
 * @param type $log_msg
 * @return type
 */
function addIntegral($openid, $credit, $log_msg = '') {
    return addCredit($openid, $credit, 'credit1', $log_msg);
}
/**
 * 给用户增加余额
 * @param type $openid
 * @param type $credit
 * @param type $log_msg
 * @return type
 */
function addBalance($openid, $credit, $log_msg = '') {
    return addCredit($openid, $credit, 'credit2', $log_msg);
}
/**
 * 发送微信企业付款
 * @param type $openid
 * @param type $money
 * @return boolean
 */
function sendWeixinPacket($openid, $money, $log_msg = '', $isreturn = false) {
    global $_W, $fr_hb_settings;
    if (intval($money) <= 0) {
        return false;
    }
    $accounts = uni_accounts($_W['uniacid']);
    $accounts = array_shift($accounts);
    $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
    $pars = array();
    $pars['mch_appid'] = $accounts['key'];//$fr_hb_settings['appid'];
    $pars['mchid'] = $fr_hb_settings['mchid'];
    $pars['nonce_str'] = random(32);
    $pars['partner_trade_no'] = random(10) . date('Ymd') . random(3);
    $pars['openid'] = $openid;
    $pars['check_name'] = 'NO_CHECK';
    $pars['amount'] = $money;
    $pars['desc'] = $log_msg;
    $pars['spbill_create_ip'] = getServerIp();
    
    ksort($pars, SORT_STRING);
    $string1 = '';
    foreach ($pars as $k => $v) {
        $string1 .= "{$k}={$v}&";
    }
    $string1 .= "key={$fr_hb_settings['password']}";
    $pars['sign'] = strtoupper(md5($string1));
    
    $xml = array2xml($pars);
    $extras = array();
    $extras['CURLOPT_CAINFO'] = MODULE_ROOT . '/cert/rootca.pem.' . $_W['uniacid'];
    $extras['CURLOPT_SSLCERT'] = MODULE_ROOT . '/cert/apiclient_cert.pem.' . $_W['uniacid'];
    $extras['CURLOPT_SSLKEY'] = MODULE_ROOT . '/cert/apiclient_key.pem.' . $_W['uniacid'];
    load()->func('communication');
    $procResult = null;
    $resp = ihttp_request($url, $xml, $extras);
    
    if (is_error($resp)) {
        $procResult = $resp;
    } else {
        $xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
        $dom = new DOMDocument();
        if ($dom->loadXML($xml)) {
            $xpath = new DOMXPath($dom);
            $code = $xpath->evaluate('string(//xml/return_code)');
            $ret = $xpath->evaluate('string(//xml/result_code)');
            if (strtolower($code) == 'success' && strtolower($ret) == 'success') {
                $procResult = true;
                return true;
            } else {
                $error = $xpath->evaluate('string(//xml/err_code_des)');
                $code = $xpath->evaluate('string(//xml/err_code)');
                if ($isreturn) {
                    $procResult = error(-2, array('code' => $code, 'error' => $error));
                }else{
                    $procResult = error(-2, $error);
                }
            }
        } else {
            $procResult = error(-1, 'error response');
        }
    }
    return $procResult;
}
/**
 * 
 * @global array $_W
 * @global array $fr_hb_settings
 * @param string $openid 接受红包的用户的openid
 * @param int $money 付款金额，单位分
 * @param string $wishing 红包祝福语
 * @param string $act_name 活动名称
 * @param string $remark 备注信息
 * @param string $send_name 红包发送者名称
 * @param boolean $isreturn 
 * @return boolean
 */
function sendWeixinRedPacket($openid, $money, $wishing, $act_name, $remark, $send_name = '', $isreturn = false) {
    global $_W, $fr_hb_settings;
    if (intval($money) < 100 || empty($wishing) || empty($act_name) || empty($remark)) {
        return error(-1, "参数有误");
    }
    $accounts = uni_accounts($_W['uniacid']);
    $accounts = array_shift($accounts);
    $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
    $pars = array();
    $send_name = empty($send_name) ? $accounts['name'] : trim($send_name);
    $pars['send_name'] = mb_substr(trim($send_name), 0, 32);
    $pars['mch_billno'] = trim($fr_hb_settings['mchid']) . date("Ymd") . random(10, true);
    $pars['wxappid'] = trim($accounts['key']);
    $pars['mch_id'] = trim($fr_hb_settings['mchid']);
    $pars['nonce_str'] = random(32);
    $pars['re_openid'] = trim($openid);
    $pars['total_amount'] = intval($money);
    $pars['total_num'] = 1;
    $pars['wishing'] = mb_substr(trim($wishing), 0, 128);
    $pars['act_name'] = mb_substr(trim($act_name), 0, 32);
    $pars['remark'] = mb_substr(trim($act_name), 0, 256);
    $pars['client_ip'] = getServerIp();
    ksort($pars, SORT_STRING);
    $string1 = '';
    foreach ($pars as $k => $v) {
        $string1 .= "{$k}={$v}&";
    }
    $string1 .= "key={$fr_hb_settings['password']}";
    $pars['sign'] = strtoupper(md5($string1));
    $xml = array2xml($pars);
    $extras = array();
    $extras['CURLOPT_CAINFO'] = MODULE_ROOT . '/cert/rootca.pem.' . $_W['uniacid'];
    $extras['CURLOPT_SSLCERT'] = MODULE_ROOT . '/cert/apiclient_cert.pem.' . $_W['uniacid'];
    $extras['CURLOPT_SSLKEY'] = MODULE_ROOT . '/cert/apiclient_key.pem.' . $_W['uniacid'];
    load()->func('communication');
    $procResult = null;
    $resp = ihttp_request($url, $xml, $extras);
    if (is_error($resp)) {
        $procResult = $resp;
    } else {
        $xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
        $dom = new DOMDocument();
        if ($dom->loadXML($xml)) {
            $xpath = new DOMXPath($dom);
            $code = $xpath->evaluate('string(//xml/return_code)');
            $ret = $xpath->evaluate('string(//xml/result_code)');
            if (strtolower($code) == 'success' && strtolower($ret) == 'success') {
                $procResult = true;
                return true;
            } else {
                $error = $xpath->evaluate('string(//xml/err_code_des)');
                $code = $xpath->evaluate('string(//xml/err_code)');
                if ($isreturn) {
                    $procResult = error(-2, array('code' => $code, 'error' => $error));
                }else{
                    $procResult = error(-2, $error);
                }
            }
        } else {
            $procResult = error(-1, 'error response');
        }
    }
    if (is_error($procResult)) {
        fr_log($procResult['message']);
    }
    return $procResult;
}

function fr_log($log, $type = 'normal', $filename = 'fr_hb') {
    load()->func("logging");
    logging_run($log, $type, $filename);
}
function sendWeixinCard($openid, $card_id) {
    global $_W;
    $acid = $_W['account']['acid'];
    if (empty($acid) && $_W['uniacid']) {
	$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid = :uniacid", array(':uniacid' => $_W['uniacid']));
    }
    $acc = WeAccount::create($acid);
    if (empty($acc) || empty($openid)) {
        return error(-1, "参数有误");
    }
    $sql = "SELECT * FROM " . tablename("coupon") . " WHERE uniacid = :uniacid AND card_id = :card_id";
    $params = array(
        ':uniacid' => $_W['uniacid'],
        ':card_id' => $card_id
    );
    $card = pdo_fetch($sql, $params);
    if (empty($card)) {
        fr_log("卡券不存在", "error", "fr_hb");
        return error(-1, "卡券不存在");
    }
    load()->classs("coupon");
    $coupon = new coupon($acid);
    $time = TIMESTAMP;
    $data = array(
//        "code" => "",
//        "openid" => "",
        "card_id" => $card_id,
        "timestamp" => "$time",
        "nonce_str" => random(8),
    );
    $data['signature'] = $coupon->SignatureCard($data);
    $sendData = array(
        "touser" => $openid,
        "msgtype" => "wxcard",
        "wxcard" => array(
            "card_id" => $card_id,
            "card_ext" => json_encode($data)
        )
    );
    return $acc->sendCustomNotice($sendData);
    
}
/**
 * 根据ID获取某表数据
 * @global type $_W
 * @param type $table
 * @param type $id
 * @return type
 */
function getDataById($table, $id, $field = NULL, $default = array()) {
    global $_W;
    if (empty($table) || empty($id)) {
        return $default;
    }
    $id = intval($id);
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". tablename($table) . " WHERE id = :id AND uniacid = :uniacid";
    $params = array(":id" => $id, ":uniacid" => $uniacid);
    $item = pdo_fetch($sql, $params);
    return empty($field) ? $item : (empty($item[$field]) ? $default : $item[$field]);
}

/**
 * 获取所有数据
 * @global type $_W
 * @param string $table
 * @param string $where
 * @param string $order
 * @param string $field
 * @return array
 */
function getAllData($table, $where = '', $order = 'id DESC', $field = "*") {
    global $_W;
    if (empty($table)) {
        return array();
    }
    $uniacid = $_W['uniacid'];
    $sql = "SELECT {$field} FROM ". tablename($table) . " WHERE uniacid = :uniacid {$where} ORDER BY {$order}";
    $params = array(":uniacid" => $uniacid);
    $item = pdo_fetchall($sql, $params);
    return $item;
}

/** 
 * 求一个数的平方 
 * @param $n 
 */  
function sqr($n){  
    return $n*$n;  
}  
  
/** 
* 生产min和max之间的随机数，但是概率不是平均的，从min到max方向概率逐渐加大。 
* 先平方，然后产生一个平方值范围内的随机数，再开方，这样就产生了一种“膨胀”再“收缩”的效果。 
*/    
function xRandom($bonus_min,$bonus_max){
    $rand_num = rand($bonus_max, $bonus_min);  
    return intval($rand_num);  
//    $sqr = intval(sqr($bonus_max-$bonus_min));  
//    $rand_num = rand(0, ($sqr-1));  
//    return intval(sqrt($rand_num));  
}

/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else{
        return $output;
    }
}


/**
 * URL重定向
 * @param string $url 重定向的URL地址
 * @param integer $time 重定向的等待时间（秒）
 * @param string $msg 重定向前的提示信息
 * @return void
 */
function redirect($url, $time=0, $msg='') {
    //多行URL地址支持
    $url        = str_replace(array("\n", "\r"), '', $url);
    if (empty($msg))
        $msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
    if (!headers_sent()) {
        // redirect
        if (0 === $time) {
            header('Location: ' . $url);
        } else {
            header("refresh:{$time};url={$url}");
            echo($msg);
        }
        exit();
    } else {
        $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if ($time != 0){
            $str .= $msg;
        }
        exit($str);
    }
}


/**
 * 生成Token
 * @return string
 */
function gen_token() {
    return md5(rand() . md5(md5(time()) + uniqid()));
}
/**
 * 生成web端URL
 * @param type $do
 * @param type $query
 * @return type
 */
function __WURL($do, $query = array(), $noredirect = true, $addhost = false){
    $query['do'] = $do;
    $query['m'] = 'fr_hb';
    return wurl('site/entry', $query, $noredirect, $addhost);
}
/**
 * 生成APP端URL
 * @param type $do
 * @param type $query
 * @param type $noredirect
 * @param type $addhost
 * @return type
 */
function __MURL($do, $query = array(), $noredirect = true, $addhost = false){
    $query['do'] = $do;
    $query['m'] = 'fr_hb';
    return murl('entry', $query, $noredirect, $addhost);
}
$_include_qrcode = false;
function include_qrcode() {
    global $_include_qrcode;
    if ($_include_qrcode) {
        return true;
    }
    $file = IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
    if (file_exists($file)) {
        include $file;
        $_include_qrcode = true;
        return true;
    } else {
        trigger_error('Invalid Class /framework/library/qrcode/phpqrcode.php', E_USER_ERROR);
        return false;
    }
}
/**
 * 
 * @param type $str
 * @param type $outfile
 * @param type $level
 * @param type $size
 * @param type $margin
 * @param type $saveandprint
 * @return boolean
 */
function qrcode($str, $outfile = false, $logo = false, $level = 'L', $size = 5, $margin = 4, $saveandprint = false) {
    if (include_qrcode()){
        $qr = QRcode::png($str, $outfile, $level, $size, $margin, $saveandprint);
        if ($logo && file_exists($logo) && is_file($logo) && $size > 4) {
            $QR = imagecreatefromstring(file_get_contents($outfile));
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);
            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
            imagepng($QR, $outfile);
        }
    }else {
        return false;
    }
}

function list_dir($dir){
    $result = array();
    if (is_dir($dir)){
            $file_dir = scandir($dir);
            foreach($file_dir as $file){
                    if ($file == '.' || $file == '..'){
                            continue;
                    }
                    elseif (is_dir($dir.$file)){
                            $result = array_merge($result, list_dir($dir.$file.'/'));
                    }
                    else{
                            array_push($result, $dir.$file);
                    }
            }
    }
    return $result;
}

/**
 * 把文件打包成为zip
 * @param  array $files       需要打包在同一个zip中的文件的路径
 * @param  string $out_dir    zip的文件的输出目录
 * @param  [type] $des_name   zip文件的名称m
 * @return boolean            打包是否成功
 */
function zip($files, $file_path, $out_dir, $des_name) {
    $zip = new ZipArchive;
    if (file_exists($out_dir . '/' . $des_name)) {
        @unlink($out_dir . '/' . $des_name);
    }
    // 打包操作
    $result = $zip->open($out_dir . '/' . $des_name, ZipArchive::CREATE);
    if (true !== $result) {
        return false;
    }

    foreach ($files as $file) {
        // 添加文件到zip包中
        $zip->addFile($file_path . '/' . $file, basename($file));
    }
    $zip->close();

    return true;
}

function getServerIp(){   
    return gethostbyname($_SERVER["SERVER_NAME"]);
 } 
/**
 * 发送文本消息给用户
 * @global array $_W
 * @param int $acid
 * @param string $openid
 * @param string $msg
 * @return boolean
 */
function sendNotice($acid, $openid, $msg = ''){
    global $_W;
    if (empty($acid)) {
        $acid = $_W['account']['acid'];
    }
    if (empty($acid) && $_W['uniacid']) {
	$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid = :uniacid", array(':uniacid' => $_W['uniacid']));
    }
    $acc = WeAccount::create($acid);
    if (empty($acc) || empty($openid) || empty($msg)) {
        return false;
    }
    $sendData = array(
        "touser" => $openid,
        "msgtype" => "text",
        "text" => array(
            "content" => urlencode($msg)
        )
    );
    $data = $acc->sendCustomNotice($sendData);
    return $data;
}
/**
 * 发送模板消息给用户
 * @global array $_W
 * @param int $acid
 * @param string $openid
 * @param array $postdata
 * @param string $template_id
 * @param string $url
 * @param string $topcolor
 * @return boolean
 */
function sendTplNotice($acid, $openid, $postdata, $template_id, $url = '', $topcolor = '#FF683F') {
    global $_W;
    if (empty($acid)) {
        $acid = $_W['account']['acid'];
    }
    if (empty($acid) && $_W['uniacid']) {
	$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid = :uniacid", array(':uniacid' => $_W['uniacid']));
    }
    $acc = WeAccount::create($acid);
    if (empty($acc) || empty($openid) || empty($postdata) || empty($template_id)) {
        return false;
    }
    $res = $acc->sendTplNotice($openid , $template_id, $postdata, $url, $topcolor);//模板消息
    return $res;
}

function replaceShareInfo($content) {
    global $_W;
    return str_replace('{NICKNAME}', $_W['fans']['nickname'] , $content);
}

function getMemberAvatar() {
    global $_W;
    load()->model('mc');
    $avatar = '';

    if (!empty($_W['member']['uid'])) {
            $member = mc_fetch(intval($_W['member']['uid']), array('avatar'));
            if (!empty($member)) {
                    $avatar = $member['avatar'];
            }
    }
    if (empty($avatar)) {
            $fan = mc_fansinfo($_W['openid']);
            if (!empty($fan)) {
                    $avatar = $fan['avatar'];
            }
    }
    if (empty($avatar)) {
            $userinfo = mc_oauth_userinfo();
            if (!is_error($userinfo) && !empty($userinfo) && is_array($userinfo) && !empty($userinfo['avatar'])) {
                    $avatar = $userinfo['avatar'];
            }
    }
    if (empty($avatar)) {
        return '';
    } else {
        return $avatar;
    }
}

/**
 * 生成二维码链接
 * @param type $token
 */
function genPacketScanUrl($token) {
    //TODO: 长链接待生成短链接
    return __MURL('scan', array('token' => $token), true, true);
}

/**
 * 判断是否设置微信商户信息
 * @global type $_W
 * @global type $fr_hb_settings
 * @return type
 */
function isWeixinPay() {
    global $_W, $fr_hb_settings;
    return file_exists(MODULE_ROOT . '/cert/apiclient_cert.pem.' . $_W['uniacid']) && 
           file_exists(MODULE_ROOT . '/cert/apiclient_key.pem.' . $_W['uniacid']) &&
           file_exists(MODULE_ROOT . '/cert/rootca.pem.' . $_W['uniacid']) && !empty($fr_hb_settings['mchid']) && !empty($fr_hb_settings['password']);
}

/**
 * 凡人
 * @param type $table
 * @param type $istablepre
 * @return type
 */
function fr_table($table, $istablepre = true) {
    $tablename = "fr_hb_" . $table;
    if ($istablepre) {
        $tablename = tablename($tablename);
    }
    return $tablename;
}
function getRow($table_name, $where = '') {
    global $_W;
    if (empty($table_name)) {
        return array();
    }
    $uniacid = $_W['uniacid'];
    $sql = "SELECT * FROM ". fr_table($table_name) . " WHERE uniacid = :uniacid {$where} LIMIT 1";
    $params = array(":uniacid" => $uniacid);
    return pdo_fetch($sql, $params);
}

function getCol($table_name, $where = '', $field = "*") {
    global $_W;
    if (empty($table_name)) {
        return array();
    }
    $uniacid = $_W['uniacid'];
    $sql = "SELECT {$field} FROM ". fr_table($table_name) . " WHERE uniacid = :uniacid {$where} LIMIT 1";
    $params = array(":uniacid" => $uniacid);
    return pdo_fetchcolumn($sql, $params);
}
function fr_update($table, $data = array(), $params = array(), $glue = "AND") {
    global $_W;
    $field_names = pdo_fetchallfields(fr_table($table));
    $update_data = array();
    foreach ($field_names AS $value)
    {
        if (array_key_exists($value, $data) == true)
        {
            $update_data[$value] = $data[$value];
        }
    }
    if(empty($update_data)) {
        return false;
    }
    $params['uniacid'] = $_W['uniacid'];
    return pdo_update(fr_table($table, FALSE), $update_data, $params, $glue);
}
function fr_insert($table, $data = array(), $replace = FALSE) {
    $field_names = pdo_fetchallfields(fr_table($table));
    $insert_data = array();
    foreach ($field_names AS $value)
    {
        if (array_key_exists($value, $data) == true)
        {
            $insert_data[$value] = $data[$value];
        }
    }
    if(empty($insert_data)) {
        return false;
    }
    return pdo_insert(fr_table($table, FALSE), $insert_data, $replace);
}
function fr_delete($table, $params = array(), $glue = "AND") {
    return pdo_delete(fr_table($table, FALSE), $params, $glue);
}

function isFollow() {
    global $_W;
    load()->model("mc");
    $fans = mc_fansinfo($_W['openid']);
    return !empty($fans['follow']);
}

function getCardId($card_id) {
    global $_W;
    $sql = "SELECT * FROM " . tablename("coupon") . " WHERE uniacid = :uniacid AND card_id = :card_id";
    $params = array(
        ':uniacid' => $_W['uniacid'],
        ':card_id' => $card_id
    );
    return pdo_fetch($sql, $params);
}

function genReceiveRule() {
    genRule("用户领奖二维码", "^fr_hb_receive_");
}
function genDrawRule() {
    genRule("用户领奖二维码2", "^fr_hb_draw_");
}
function genRule($name, $content) {
    global $_W;
    $rule_sql = "SELECT * FROM ".tablename('rule')." WHERE uniacid = :uniacid AND module = :module AND name = :name LIMIT 1";
    $rule_params = array(
        ':uniacid' => $_W['uniacid'],
        ':name' => $name,
        ':module' => "fr_hb",
    );
    $rule = pdo_fetch($rule_sql, $rule_params);
    if (empty($rule)) {
        $rule = array(
                'uniacid' => $_W['uniacid'],
                'name' => $name,
                'module' => "fr_hb",
                'status' => 1,
                'displayorder' => 255,
        );
        
        $result = pdo_insert('rule', $rule);
        $rid = pdo_insertid();
        $krow = array(
                'rid' => $rid,
                'uniacid' => $_W['uniacid'],
                'module' => $rule['module'],
                'status' => $rule['status'],
                'displayorder' => $rule['displayorder'],
                'type' => 3,
                'content' => $content,
        );
        pdo_insert('rule_keyword', $krow);
    }
}
function genReceiveQrcode($receive_id) {
    global $_W;
    genReceiveRule();
    $receive = getDataById(fr_table('receive', false), $receive_id);
    if (empty($receive) || $receive['status'] != 0) {
        return false;
    }
    return genQrcode("fr_hb_receive_{$receive_id}", "用户领奖二维码");
}
function genDrawQrcode($log_id) {
    global $_W;
    genDrawRule();
    $log = getDataById(fr_table('draw_log', false), $log_id);
    if (empty($log) || $log['status'] != 0) {
        return false;
    }
    return genQrcode("fr_hb_draw_{$log_id}", "用户领奖二维码2");
}

function genQrcode($keyword = '', $title = 'fr_hb') {
    global $_W;
    if (empty($keyword)) {
        return FALSE;
    }
    $sql = "SELECT * FROM ".tablename('qrcode')." WHERE uniacid = :uniacid AND keyword = :keyword LIMIT 1";
    $params = array(':uniacid' => $_W['uniacid'], ':keyword' => "{$keyword}");
    $qrcode = pdo_fetch($sql, $params);
    if (!empty($qrcode)) {
        $qrcode_img_url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($qrcode['ticket']);
        $qrcode['endtime'] = $qrcode['createtime'] + $qrcode['expire'];
        if (TIMESTAMP > $qrcode['endtime']) {
            if (!empty($qrcode)) {
                pdo_delete('qrcode', array('id' => $qrcode['id'], 'uniacid' => $_W['uniacid']));
                pdo_delete('qrcode_stat',array('qid' => $qrcode['id'], 'uniacid' => $_W['uniacid']));
                $not_qrcode = true;
            }
        }
    }else{
        $not_qrcode = true;
    }
    if ($not_qrcode) {
        $acid = $_W['account']['acid'];
        if (empty($acid) && $_W['uniacid']) {
            $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid = :uniacid", array(':uniacid' => $_W['uniacid']));
        }
        $uniacccount = WeAccount::create($acid);
        if (empty($uniacccount)) {
            return false;
        }
        $qrcid = pdo_fetchcolumn("SELECT qrcid FROM ".tablename('qrcode')." WHERE acid = :acid AND model = '1' ORDER BY qrcid DESC LIMIT 1", array(':acid' => $acid));
        $barcode = array(
            'expire_seconds' => 15 * 60,
            'action_name' => 'QR_SCENE',
            'action_info' => array(
                'scene' => array(
                    'scene_id' => !empty($qrcid) ? ($qrcid+1) : 100001
                ),
            ),
        );
        $result = $uniacccount->barCodeCreateDisposable($barcode);
        if(!is_error($result)) {
            $insert = array(
                    'uniacid' => $_W['uniacid'],
                    'acid' => $acid,
                    'qrcid' => $barcode['action_info']['scene']['scene_id'],
                    'scene_str' => $barcode['action_info']['scene']['scene_str'],
                    'keyword' => $keyword,
                    'name' => $title,
                    'model' => 1,
                    'ticket' => $result['ticket'],
                    'url' => $result['url'],
                    'expire' => $result['expire_seconds'],
                    'createtime' => TIMESTAMP,
                    'status' => '1',
                    'type' => 'scene',
            );
            pdo_insert('qrcode', $insert);
            $qrcode_img_url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($result['ticket']);
        } else {
            fr_log($result['message']);
            return false;
        }
    }
    
    return $qrcode_img_url;
}