<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');
include MODULE_ROOT . '/inc/common.php';
global $_GPC, $_W;
$uniacid = $_W["uniacid"];
$table_name = 'fr_hb_packet';

$act = trim($_GPC['act']);
$allow_acts = array(
    'lists', 'add', 'view', 'update', 'delete', 'generation', 'downloadzip', 'gen_qrc', 'view_qrc', 'downloadtext'
);
$type_text = array(
    '1' => '积分',
    '2' => '余额',
    '3' => '微信零钱',
    '4' => '微信卡券',
);
load()->func('tpl');
load()->func('file');
if (!in_array($act, $allow_acts)) {
    $act = 'lists';
}
$project_id = intval($_GPC['id']);
$project = getProjectById($project_id);
if (empty($project)) {
    message('项目不存在！', '', "error");
}
$draws = getDraw($project_id);
if (empty($draws)) {
    message('请先设置项目抽奖奖品！', $this->createWebUrl('draw', array('act' => 'lists', 'id' => $project_id)), "error");
}

$ewm_setting = iunserializer($project['ewm_setting']);
$project['card_ids'] = iunserializer($project['card_ids']);
if (empty($ewm_setting)) {
    $ewm_setting = array(
        'size' => 6,
        'level' => 3,
        'margin' => 2,
    );
}

/**
 * 列表
 */
if ($act == 'lists') {
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $where = '';
    $status = trim($_GPC['status']);
    switch ($status) {
        case 1:
            $where .= " AND status = 1 ";
            break;
        case 2:
            $where .= " AND status = 0 ";
            break;
//        case 3:
//            $where .= " AND start_time > " . TIMESTAMP;
//            break;
//        case 4:
//            $where .= " AND end_time < " . TIMESTAMP;
//            break;
    }
    $order = trim($_GPC['order']) == 'desc' ? 'asc' : 'desc';
    $orderby = ' ORDER BY money ' . $order . ', id DESC ';
    
    $params = array(':uniacid' => $uniacid, ':project_id' => $project_id); 
    $sql = 'SELECT * FROM '.tablename($table_name).' WHERE uniacid = :uniacid AND project_id = :project_id '.$where . $orderby .'  LIMIT '. ($pindex -1) * $psize . ',' .$psize;
    $list = pdo_fetchall( $sql , $params);
    //dump($list);die;
    $countSql = 'SELECT COUNT(*) FROM '.tablename($table_name).' WHERE uniacid = :uniacid AND project_id = :project_id  '.$where;
    $total = pdo_fetchcolumn( $countSql, $params );
    $pager = pagination($total, $pindex, $psize);
    
    $noqrccount = getPacketNoqrcCount($project_id);
}
/**
 * 查看红包
 */
else if($act == 'view') {
    $id = intval($_GPC['packet_id']);
//    $count = getPacketCount($project_id);
    
    if (!empty($id)) {
        $sql = "SELECT * FROM ". tablename($table_name) . " WHERE id = :id AND uniacid = :uniacid";
        $params = array(":id" => $id, ":uniacid" => $uniacid);
        $item = pdo_fetch($sql, $params);
        if ($item['status'] == 1) {
            $receive = getPacketReceive($item['id']);
        }
        //$item['datetime'] = array('start' => timeToStr($item['start_time']), 'end' => timeToStr($item['end_time'])) ;
    }else {
        message('红包不存在！', '', 'error');
    }
}
/**
 * 添加修改
 */
else if($act == 'add') {
    $id = intval($_GPC['packet_id']);
    $count = getPacketCount($project_id);
    
    $item = array(
        'money' => xRandom($project['min_money'], $project['max_money']),
        //'datetime'=> array('start' => timeToStr($project['start_time']), 'end' => timeToStr($project['end_time']))
    );
    if (!empty($id)) {
        $sql = "SELECT * FROM ". tablename($table_name) . " WHERE id = :id AND uniacid = :uniacid";
        $params = array(":id" => $id, ":uniacid" => $uniacid);
        $item = pdo_fetch($sql, $params);
        //$item['datetime'] = array('start' => timeToStr($item['start_time']), 'end' => timeToStr($item['end_time'])) ;
    }else {
        if ($count >= $project['numbers']) {
            message('红包数额已满，无法再添加！', '', 'error');
        }
    }
    if ($item['status'] == 1) {
        message('该红包已被领取，无法修改!', '', 'error');
    }
}

/**
 * 保存数据
 */
else if($act == 'update') {
    if (!checksubmit('submit')) {
        message('Token错误!', '', 'error');
    }
    $id = intval($_GPC['packet_id']);
    $isqrc = intval($_GPC['isqrc']);
    $packet = $_GPC['packet'];
    $datetime = $_GPC['datetime'];
    $packet['start_time'] = $project['start_time'];//strtotime($datetime['start']);
    $packet['end_time'] = $project['end_time'];//strtotime($datetime['end']);
    
    if (intval($packet['money']) < $project['min_money'] || intval($packet['money']) > $project['max_money']) {
        message('红包金额错误', '', 'error');
    }
    if ($packet['start_time'] >= $packet['end_time']) {
        //message('红包有效期时间不正确', '', 'error');
    }
    
    $packet['project_id'] = $project_id;
    $packet['uniacid'] = $uniacid;
    $packet['status'] = 0;
    if (empty($id)) {
        $count = getPacketCount($project_id);
        if ($count >= $project['numbers']) {
            message('红包数额已满，无法再添加！', '', 'error');
        }
        $token = gen_token();
        $packet['createtime'] = TIMESTAMP;
        $packet['token'] = $token;
        if ($isqrc == 1) {
            /*生成二维码 start*/
            $outpath = ATTACHMENT_ROOT . "/images/{$uniacid}/{$this->modulename}/{$project_id}/";
            $logo = $this->module['config']['ewmlogo'] ? ATTACHMENT_ROOT . "/" . $this->module['config']['ewmlogo'] : '';
            mkdirs($outpath);
            $filename = "{$token}.png";
            $outfile = $outpath . $filename;
            $longurl = genPacketScanUrl($token);
            $qr = qrcode($longurl, $outfile, $logo, $ewm_setting['level'],$ewm_setting['size'], $ewm_setting['margin']);
            if ($qr !== false) {
                $packet['qrcurl'] = toimage("images/{$uniacid}/{$this->modulename}/{$project_id}/{$filename}");
            }else {
                message('二维码生成失败，请检查附件目录是否有可写权限！', '', 'error');
            }
            $packet['isqrc'] = 1;
            /*生成二维码 end*/
        }
        pdo_insert($table_name, $packet);
    }else{
        $sql = "SELECT * FROM ". tablename($table_name) . " WHERE id = :id AND uniacid = :uniacid";
        $params = array(":id" => $id, ":uniacid" => $uniacid);
        $item = pdo_fetch($sql, $params);
        if (empty($item)) {
            message('红包不存在或已删除！', '', 'error');
        }
        if ($isqrc == 1) {
            $token = $item['token'];
            /*生成二维码 start*/
            $outpath = ATTACHMENT_ROOT . "/images/{$uniacid}/{$this->modulename}/{$project_id}/";
            $logo = $this->module['config']['ewmlogo'] ? ATTACHMENT_ROOT . "/" . $this->module['config']['ewmlogo'] : '';
            mkdirs($outpath);
            $filename = "{$token}.png";
            $outfile = $outpath . $filename;
            $longurl = genPacketScanUrl($token);
            $qr = qrcode($longurl, $outfile, $logo, $ewm_setting['level'],$ewm_setting['size'], $ewm_setting['margin']);
            if ($qr !== false) {
                $packet['qrcurl'] = toimage("images/{$uniacid}/{$this->modulename}/{$project_id}/{$filename}");
            }else {
                message('二维码生成失败，请检查附件目录是否有可写权限！', '', 'error');
            }
            $packet['isqrc'] = 1;
            /*生成二维码 end*/
        }
        pdo_update($table_name, $packet, array('id' => $id, 'uniacid' => $uniacid));
    }
    message('红包保存成功!', $this->createWebUrl('packet', array('id' => $project_id, 'act' => 'lists')), 'success');
    exit();
}

/**
 * 删除数据
 */
else if($act == 'delete') {
    $id = intval($_GPC['packet_id']);
    pdo_delete($table_name, array('id' => $id, 'uniacid' => $uniacid));
    message('删除红包成功!', $this->createWebUrl('packet', array('id' => $project_id, 'act' => 'lists')), 'success');
    exit();
}
/**
 * 批量生成红包
 */
else if ($act == 'generation') {
    if ($_W['isajax']) {
        $post = $_GPC['__input'];
        if($post['method'] == 'generation') {
            $count = getPacketCount($project_id);
            if ($count < $project['numbers']) {
                $buffSize = ceil(($project['numbers'] - $count) / 500);
                $count = getPacketCount($project_id);
                $size = $project['numbers'] - $count > 500 ? 500 : $project['numbers'] - $count;
                $card_id = '';
                if ($project['type'] == 4) {
                    for($i = 0; $i < count($project['card_ids']); $i++) {
                        $uniacid = $_W['uniacid'];
                        $sql = "SELECT quantity FROM ". tablename("coupon") . " WHERE uniacid = :uniacid AND card_id = :card_id LIMIT 1";
                        $params = array(":uniacid" => $uniacid, ":card_id" => $project['card_ids'][$i]);
                        $quantity = pdo_fetchcolumn($sql, $params);
                        $cardIdCount = getCardIdPacketCount($project_id, $project['card_ids'][$i]);
                        if ($cardIdCount < $quantity) {
                            $size = $quantity - $cardIdCount > 500 ? 500 : $quantity - $cardIdCount;
                            $card_id = $project['card_ids'][$i];
                            break;
                        }
                    }
                    
                }
                $sql = '';
                for ($j = 0; $j < $size; $j++) {
                    if ($project['type'] == 4) {
                        $money = 0;
                    }else{
                        $money = xRandom($project['min_money'], $project['max_money']);
                    }
                    $token = gen_token();
                    $qrcid = 0;
                    $time = TIMESTAMP;
                    $qrcurl = '';
                    $sql .= "('{$uniacid}', '{$project_id}', '{$qrcid}', '{$qrcurl}', '{$money}', 0, '{$project['start_time']}', '{$project['end_time']}', '{$time}', '{$token}', 0, '{$card_id}'),";
                }
                if(!empty($sql)) {
                    $sql = rtrim($sql, ',');
                    $sql = 'INSERT INTO ' . tablename($table_name) . ' (`uniacid`, `project_id`, `qrcid`, `qrcurl`, `money`, `status`, `start_time`, `end_time`, `createtime`, `token`, `isqrc`, `card_id`) VALUES ' . $sql;
                    pdo_query($sql);
                }
                if ($buffSize > 1) {
                    exit('go');
                }else{
                    exit('success');
                }
            }
            message("已经生成了所有红包！", 'success');
        }
    }else{
        exit(json_encode(error(-1, "非法访问！")));
    }
    die();
}
/**
 * 下载二维码图片
 */
else if ($act == 'downloadzip') {
    $count = getPacketCount($project_id);
    if ($count <= 0) {
        message('请先添加红包!', $this->createWebUrl('packet', array('id' => $project_id, 'act' => 'lists')), 'error');
    }
    if ($count > 10000) {
        message("该项目红包数量过多，建议下载文本数据！");
    }
    $outpath = ATTACHMENT_ROOT . "/images/{$uniacid}/{$this->modulename}/{$project_id}/";
    mkdirs($outpath);
    $lists = file_lists($outpath, 0, 'png');
    $filename = $project_id . ".zip";
    if (!file_exists($outpath . $filename) || $count != $project['numbers']) {
        zip($lists, IA_ROOT . '/', $outpath, $filename);
    }
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer"); 
    header('Content-disposition: attachment; filename='.basename($filename)); //文件名   
    header("Content-Type: application/zip"); //zip格式的   
    header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件    
    header('Content-Length: '. filesize($outpath . $filename)); //告诉浏览器，文件大小   
    @readfile($outpath . $filename);
}
/**
 * 下载二维码链接文本
 */
else if($act == 'downloadtext') {
    $count = getPacketCount($project_id);
    if ($count <= 0) {
        message('请先添加红包!', $this->createWebUrl('packet', array('id' => $project_id, 'act' => 'lists')), 'error');
    }
    $outpath = ATTACHMENT_ROOT . "/images/{$uniacid}/{$this->modulename}/{$project_id}/";
    mkdirs($outpath);
    $filename = $project_id . ".txt";
    file_delete("/images/{$uniacid}/{$this->modulename}/{$project_id}/" . $filename);
    if (!file_exists($outpath . $filename) || $count != $project['numbers']) {
        $content = '';
        if ($count > 10000) {
            $size = ceil($count/10000);
            for($i=0; $i <= $size; $i++) {
                $offset = $i * 10000;
                $result = getPacketAll($project_id, $offset);
                foreach ($result as $item) {
                    $url = genPacketScanUrl($item['token']);
                    $content .= $url . "\n";
                }
            }
        }else {
            $result = getPacketAll($project_id);
            foreach ($result as $item) {
                $url = genPacketScanUrl($item['token']);
                $content .= $url . "\n";
            }
        }
        if (empty($content)) {
            message('未知错误，请联系管理员!', $this->createWebUrl('packet', array('id' => $project_id, 'act' => 'lists')), 'error');
        }
        file_put_contents($outpath . $filename, $content);
    }
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer"); 
    header('Content-disposition: attachment; filename='.basename($filename)); //文件名   
    header("Content-Type: application/force-download"); //zip格式的   
    header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件    
    header('Content-Length: '. filesize($outpath . $filename)); //告诉浏览器，文件大小   
    @readfile($outpath . $filename);
    die();
}
/**
 * 批量生成二维码图片
 */
else if($act == 'gen_qrc') {
    if ($_W['isajax']) {
        $post = $_GPC['__input'];
        if($post['method'] == 'generation_qrc') {
            $noqrccount = getPacketNoqrcCount($project_id);
            if ($noqrccount > 10000) {
                message("该项目红包数量过多，建议下载文本数据！");
            }
            $uniacid = $_W['uniacid'];
            $sql = "SELECT * FROM ". tablename('fr_hb_packet') . " WHERE project_id = :project_id AND uniacid = :uniacid AND isqrc = :isqrc LIMIT 100";
            $params = array(":project_id" => $project_id, ":uniacid" => $uniacid, ":isqrc" => 0);
            $packet_lists = pdo_fetchall($sql, $params);
            if (!empty($packet_lists)) {
                $buffSize = ceil(($project['numbers'] - $count) / 100);
                $outpath = ATTACHMENT_ROOT . "/images/{$uniacid}/{$this->modulename}/{$project_id}/";
                $logo = $this->module['config']['ewmlogo'] ? ATTACHMENT_ROOT . "/" . $this->module['config']['ewmlogo'] : '';
                mkdirs($outpath);
                $size = count($packet_lists);
                for ($j = 0; $j < $size; $j++) {
                    $packet = array();
                    $token = $packet_lists[$j]['token'];

                    /*生成二维码 start*/
                    $filename = "{$token}.png";
                    $outfile = $outpath . $filename;
                    $longurl = genPacketScanUrl($token);
                    $qr = qrcode($longurl, $outfile, $logo, $ewm_setting['level'],$ewm_setting['size'], $ewm_setting['margin']);
                    if ($qr !== false) {
                        $packet['qrcurl'] = toimage("images/{$uniacid}/{$this->modulename}/{$project_id}/{$filename}");
                    }else {
                        exit('二维码生成失败，请检查附件目录是否有可写权限！');
                    }

                    $packet['isqrc'] = 1;
                    pdo_update($table_name, $packet, array('id' => $packet_lists[$j]['id'], 'uniacid' => $uniacid));
                    /*生成二维码 end*/
                }
                
                $noqrccount = getPacketNoqrcCount($project_id);
                if ($noqrccount > 0) {
                    exit('go');
                }else{
                    exit('success');
                }
            }
            message("已经生成了所有红包二维码！");
        }
    }else{
        message("非法访问");
    }
    die();
}
/**
 * 查看二维码
 */
else if($act == 'view_qrc') {
    $id = intval($_GPC['packet_id']);
    
    if (!empty($id)) {
        $sql = "SELECT * FROM ". tablename($table_name) . " WHERE id = :id AND uniacid = :uniacid";
        $params = array(":id" => $id, ":uniacid" => $uniacid);
        $item = pdo_fetch($sql, $params);
        if (empty($item)) {
            message('红包不存在或已删除！', '', 'error');
        }
        $file_path = ATTACHMENT_ROOT . "/images/{$uniacid}/{$this->modulename}/{$project_id}/{$item['token']}.png";
        if ($item['isqrc'] == 1 && file_exists($file_path) && !empty($item['qrcurl'])) {
            redirect($item['qrcurl']);
        }else{
            $packet = array();
            $token = $item['token'];
            /*生成二维码 start*/
            $outpath = ATTACHMENT_ROOT . "/images/{$uniacid}/{$this->modulename}/{$project_id}/";
            $logo = $this->module['config']['ewmlogo'] ? ATTACHMENT_ROOT . "/" . $this->module['config']['ewmlogo'] : '';
            mkdirs($outpath);
            $filename = "{$token}.png";
            $outfile = $outpath . $filename;
            $longurl = genPacketScanUrl($token);
            $qr = qrcode($longurl, $outfile, $logo, $ewm_setting['level'],$ewm_setting['size'], $ewm_setting['margin']);
            if ($qr !== false) {
                $packet['qrcurl'] = toimage("images/{$uniacid}/{$this->modulename}/{$project_id}/{$filename}");
            }else {
                message('二维码生成失败，请检查附件目录是否有可写权限！', '', 'error');
            }
            $packet['isqrc'] = 1;
            pdo_update($table_name, $packet, array('id' => $id, 'uniacid' => $uniacid));
            redirect($packet['qrcurl']);
        }
        
    }else {
        message('红包不存在！', '', 'error');
    }
    die();
}
include $this->template('web/packet_' . $act);