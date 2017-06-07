<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
include_once 'function/functions.php';
include_once 'function/time.func.php';
include_once 'function/project.func.php';
include_once 'function/packet.func.php';
include_once 'function/share.func.php';
include_once 'function/draw.func.php';
define('__CSS__', MODULE_URL . 'resource/css');
define('__IMG__', MODULE_URL . 'resource/images');
define('__JS__', MODULE_URL . 'resource/js');
$footer_off = TRUE;
/*
 * 添加默认设置
 */
if (empty($this->module['config'])) {
    $dat = array(
        "min_money" => 100,
        "max_money" => 1000,
        "numbers" => 100,
        "type" => 2
    );
    $this->saveSettings($dat);
}
$GLOBALS['fr_hb_settings'] = $this->module['config'];