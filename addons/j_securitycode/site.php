<?php
defined('IN_IA')or exit('Access Denied');
include('../addons/j_securitycode/jetsum_function.php');
include('../addons/j_securitycode/copyright.php');
class J_securitycodeModuleSite extends WeModuleSite{
    public function doWebManage(){
        global $_GPC, $_W;
        $this -> doWebCategory();
    }
    public function doWebBurning(){
        global $_GPC, $_W;
        $operation = !empty($_GPC['op'])? $_GPC['op'] : 'display';
        $pcate = intval($_GPC['pcate']);
        $reply = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
        $code_count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('j_securitycode_code') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate ");
        $code_used = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('j_securitycode_code') . " WHERE weid='{$_W['uniacid']}' and pcate=$pcate and scantime>0");
        $code_scran = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('j_securitycode_code') . " WHERE weid='{$_W['uniacid']}' and pcate=$pcate and ascantime>0");
        if($reply['parama'])$parama = @explode("|#|", $reply['parama']);
        include $this -> template('burning');
    }
    public function doWebCategory(){
        global $_GPC, $_W;
        $operation = !empty($_GPC['op'])? $_GPC['op'] : 'display';
        if ($operation == 'display'){
            $category = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE weid = '{$_W['uniacid']}' order by id desc");
        }elseif ($operation == 'post'){
            $id = intval($_GPC['id']);
            load() -> func('tpl');
            load() -> func('file');
            $grouplist = pdo_fetchall("SELECT * FROM " . tablename("mc_groups") . " WHERE uniacid = '" . $_W['uniacid'] . "' ORDER BY `orderlist` asc");
            $groupary = array();
            $groupary[0] = "不限制等级";
            foreach($grouplist as $row){
                $groupary[$row['groupid']] = $row['title'];
            }
            $redpacklist = pdo_fetchall("SELECT * FROM " . tablename("j_securitycode_redpack") . " WHERE weid = '" . $_W['uniacid'] . "' ORDER BY `id` desc");
            if(!empty($id)){
                $category = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id = '$id'");
                $groupary = @explode(',', $category['grouptype']);
            }
            if (checksubmit('submit')){
                if (empty($_GPC['title']))message('抱歉，请输入标题！');
                $url = $_GPC['url'];
                if(!strpos($url, "?") && strlen($url) > 2)$url = $url . "?";
                $collectorder = is_array($_GPC['collectorder'])? array_unique($_GPC['collectorder']):$_GPC['collectorder'];
                $data = array('weid' => $_W['uniacid'], 'title' => $_GPC['title'], 'scantype' => intval($_GPC['scantype']), 'gametype' => intval($_GPC['gametype']), 'codetype' => intval($_GPC['codetype']), 'scantimevent' => intval($_GPC['scantimevent']), 'status' => intval($_GPC['status']), 'content' => htmlspecialchars_decode($_GPC['content']), 'content2' => htmlspecialchars_decode($_GPC['content2']), 'content3' => htmlspecialchars_decode($_GPC['content3']), 'content4' => htmlspecialchars_decode($_GPC['content4']), 'content5' => htmlspecialchars_decode($_GPC['content5']), 'welcome' => htmlspecialchars_decode($_GPC['welcome']), 'link' => $_GPC['link'], 'url' => $url, 'urlword' => $_GPC['urlword'], 'starttime' => strtotime($_GPC['starttime']), 'endtime' => strtotime($_GPC['endtime']), 'redpackid' => intval($_GPC['redpackid']), 'grouptype' => implode(',', $_GPC['grouptype']), 'jointime' => intval($_GPC['jointime']), 'credits' => intval($_GPC['credits']), 'collecttype' => intval($_GPC['collecttype']), 'playtype' => intval($_GPC['playtype']), 'collectorder' => @implode(",", $collectorder), 'replytime' => intval($_GPC['replytime']),);
                $parama = array();
                if(isset($_GPC['parama-key'])){
                    foreach ($_GPC['parama-key'] as $index => $row){
                        if(empty($row))continue;
                        array_push($parama, $row);
                    }
                }
                if(isset($_GPC['parama-key-new'])){
                    foreach ($_GPC['parama-key-new'] as $index => $row){
                        if(empty($row))continue;
                        array_push($parama, $row);
                    }
                }
                $wxcardkey = array();
                $wxcardval = array();
                if(isset($_GPC['wxcard-key'])){
                    foreach ($_GPC['wxcard-key'] as $index => $row){
                        if(empty($row))continue;
                        array_push($wxcardkey, $row);
                        array_push($wxcardval, $_GPC['wxcard-val'][$index]);
                    }
                }
                if(isset($_GPC['wxcard-key-new'])){
                    foreach ($_GPC['wxcard-key-new'] as $index => $row){
                        if(empty($row))continue;
                        array_push($wxcardkey, $row);
                        array_push($wxcardval, $_GPC['wxcard-val-new'][$index]);
                    }
                }
                $argumentary = array();
                if(isset($_GPC['argument-key'])){
                    foreach ($_GPC['argument-key'] as $index => $row){
                        if(empty($row))continue;
                        $argumentary[$row] = $_GPC['argument-val'][$index];
                    }
                }
                if(isset($_GPC['argument-key-new'])){
                    foreach ($_GPC['argument-key-new'] as $index => $row){
                        if(empty($row))continue;
                        $argumentary[$row] = $_GPC['argument-val-new'][$index];
                    }
                }
                $data['wxcard'] = implode('|#|', $wxcardkey) . "|##|" . implode('|#|', $wxcardval);
                $data['argument'] = count($argumentary)? json_encode($argumentary): "";
                $data['parama'] = implode('|#|', $parama);
                if (!empty($id)){
                    pdo_update('j_securitycode_category', $data, array('id' => $id));
                    if ($_FILES["csvfile"]["name"]){
                        $dir_url = IA_ROOT . '/attachment/j_securitycode/temp/' . $id;
                        mkdirs($dir_url);
                        $extNameAry = explode(".", $_FILES["csvfile"]["name"]);
                        $extName = $extNameAry[count($extNameAry)-1];
                        if($extName != 'csv')message('只能是导入csv格式的文件！', '', 'error');
                        $filename = date("YmdHis") . "." . $extName;
                        move_uploaded_file($_FILES["csvfile"]["tmp_name"], $dir_url . "/" . $filename);
                        $file = fopen($dir_url . "/" . $filename, 'r');
                        while ($data = fgetcsv($file)){
                            $goods_list[] = $data;
                        }
                        if(iconv('GB2312', 'UTF-8', trim($goods_list[0][0])) != "openid")message('首行首格必须是openid', '', 'error');
                        $_tempAry = array();
                        foreach ($goods_list as $row){
                            if(trim($row[0]) == "openid" || strlen(trim($row[0])) < 10)continue;
                            array_push($_tempAry, "('" . $_W['uniacid'] . "','" . $id . "','" . iconv('GB2312', 'UTF-8', trim($row[0])) . "')");
                        }
                        fclose($file);
                        $rulsql = "INSERT INTO `ims_j_securitycode_joiner`(`weid`,`pcate`,`from_user`)VALUES" . implode(",", $_tempAry);
                        pdo_run($rulsql);
                    }
                }else{
                    pdo_insert('j_securitycode_category', $data);
                    $id = pdo_insertid();
                }
                message('更新成功！', $this -> createWebUrl('category', array('op' => 'display')), 'success');
            }
        }elseif ($operation == 'delete'){
            $id = intval($_GPC['id']);
            $category = pdo_fetch("SELECT id FROM " . tablename('j_securitycode_category') . " WHERE id = '$id'");
            if (empty($category)){
                message('抱歉，不存在或是已经被删除！', $this -> createWebUrl('category', array('op' => 'display')), 'error');
            }
            pdo_delete('j_securitycode_category', array('id' => $id));
            pdo_delete('j_securitycode_code', array('pcate' => $id));
            message('删除成功！', $this -> createWebUrl('category', array('op' => 'display',)), 'success');
        }
        include $this -> template('category');
    }
    public function doWebJoiner(){
        global $_GPC, $_W;
        $operation = !empty($_GPC['op'])? $_GPC['op'] : 'display';
        $pcate = intval($_GPC['pcate']);
        $reply = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
        if ($operation == 'display'){
            $pindex = max(1, intval($_GPC['page']));
            $psize = 30;
            $condition = "";
            $list = pdo_fetchall("SELECT *,min(endtime) as sendtime,max(nickname) as nname,max(headimgurl) as headimgurls,count(*) as qrcount,sum(fee) as allfee,max(ascantime) as attends,max(aendtime) as aendtimes,max(endtime) as endtimes FROM " . tablename('j_securitycode_code') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate and from_user<>'' group by from_user order by qrcount desc ,sendtime asc limit " . ($pindex - 1) * $psize . ',' . $psize);
            $total = pdo_fetchall('SELECT from_user FROM ' . tablename('j_securitycode_code') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate and from_user<>'' group by from_user ");
            $pager = pagination(count($total), $pindex, $psize);
        }elseif ($operation == 'sendmsg'){
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_msgsend') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate order by id desc");
            $alluser = count(pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE weid = '" . $_W['uniacid'] . "' and pcate=$pcate and scantime>0 group by from_user"));
            $allin = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_securitycode_code') . " WHERE weid = '" . $_W['uniacid'] . "' and pcate=$pcate and aendtime>0 group by from_user");
        }elseif ($operation == 'post'){
            $id = intval($_GPC['id']);
            $status = intval($_GPC['status']);
            pdo_update('j_securitycode_joiner', array('status' => $status), array('id' => $id));
            message('修改成功！', $this -> createWebUrl('joiner', array('pcate' => $pcate, 'op' => 'limit')), 'success');
        }elseif ($operation == 'delete'){
            $id = intval($_GPC['id']);
            pdo_delete('j_securitycode_joiner', array('id' => $id));
            message('删除成功！', $this -> createWebUrl('joiner', array('pcate' => $pcate, 'op' => 'limit')), 'success');
        }elseif ($operation == 'limit'){
            $pindex = max(1, intval($_GPC['page']));
            $psize = 30;
            $condition = "";
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_joiner') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate ORDER BY id desc limit " . ($pindex - 1) * $psize . ',' . $psize);
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('j_securitycode_joiner') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate ");
            $pager = pagination($total, $pindex, $psize);
        }
        include $this -> template('adv_user');
    }
    public function doWebRedpack(){
        global $_GPC, $_W;
        $operation = !empty($_GPC['op'])? $_GPC['op'] : 'display';
        if ($operation == 'display'){
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_redpack') . " WHERE weid = '{$_W['uniacid']}' order by id desc");
        }elseif ($operation == 'post'){
            load() -> func('tpl');
            $id = intval($_GPC['id']);
            $funlist = pdo_fetchall("SELECT id,title FROM " . tablename('j_securitycode_category') . " WHERE weid = '{$_W['uniacid']}' order by id desc");
            if(!empty($id)){
                $reply = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_redpack') . " WHERE id = '$id'");
            }
            if (checksubmit('submit')){
                $data = array('weid' => $_W['uniacid'], 'title' => $_GPC['title'], 'pcate' => intval($_GPC['pcate']), 'firstmin' => intval($_GPC['firstmin']), 'firstmax' => intval($_GPC['firstmax']), 'totalfee' => intval($_GPC['totalfee']), 'remainfee' => intval($_GPC['remainfee']), 'alertfee' => intval($_GPC['alertfee']), 'alertuser' => $_GPC['alertuser'], 'wishing' => $_GPC['wishing'], 'send_name' => $_GPC['send_name'], 'appid' => $_GPC['appid'], 'secret' => $_GPC['secret'], 'mchid' => $_GPC['mchid'], 'ip' => $_GPC['ip'], 'signkey' => $_GPC['signkey'],);
                if (empty($id)){
                    pdo_insert('j_securitycode_redpack', $data);
                    $id = pdo_insertid();
                }
                load() -> func('file');
                $dir_url = IA_ROOT . '/attachment/j_securitycode/cert_2/' . $id;
                mkdirs($dir_url);
                if ($_FILES["rootca"]["name"]){
                    if(file_exists($dir_url . "/rootca.pem"))@unlink ($dir_url . "/rootca.pem");
                    move_uploaded_file($_FILES["rootca"]["tmp_name"], $dir_url . "/rootca.pem");
                    $data['rootca'] = 1;
                }
                if ($_FILES["apiclient_cert"]["name"]){
                    if(file_exists($dir_url . "/apiclient_cert.pem"))@unlink ($dir_url . "/apiclient_cert.pem");
                    move_uploaded_file($_FILES["apiclient_cert"]["tmp_name"], $dir_url . "/apiclient_cert.pem");
                    $data['apiclient_cert'] = 1;
                }
                if ($_FILES["apiclient_key"]["name"]){
                    if(file_exists($dir_url . "/apiclient_key.pem"))@unlink ($dir_url . "/apiclient_key.pem");
                    move_uploaded_file($_FILES["apiclient_key"]["tmp_name"], $dir_url . "/apiclient_key.pem");
                    $data['apiclient_key'] = 1;
                }
                pdo_update('j_securitycode_redpack', $data, array('id' => $id));
                message('更新成功！', $this -> createWebUrl('redpack', array('op' => 'display')), 'success');
            }
        }elseif ($operation == 'delete'){
            $id = intval($_GPC['id']);
            pdo_delete('j_securitycode_redpack', array('id' => $id));
            $dir_url = IA_ROOT . '/attachment/j_securitycode/cert_2/' . $id;
            @unlink($dir_url . "/rootca.pem");
            @unlink($dir_url . "/apiclient_cert.pem");
            @unlink($dir_url . "/apiclient_key.pem");
            message('删除成功！', $this -> createWebUrl('redpack', array('op' => 'display',)), 'success');
        }
        include $this -> template('redpack');
    }
    public function doWebCode(){
        global $_GPC, $_W;
        $this -> sendsMessage();
        $__securitycode = setCopyRight();
        $pcate = intval($_GPC['pcate']);
        load() -> func('cache');
        if(!cache_load('scode'))cache_write('scode', $__securitycode['__securitycode']);
        $operation = !empty($_GPC['op'])? $_GPC['op'] : 'display';
        $reply = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
        if ($operation == 'post'){
            $id = intval($_GPC['id']);
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE id='" . $id . "'");
            if (checksubmit('submit')){
                if(!trim($_GPC['code']))message('抽奖码不能为空！', '', 'error');
                $data = array('status' => intval($_GPC['status']), 'code' => trim($_GPC['code']), 'pcate' => $rid, 'weid' => $_W['uniacid'],);
                if (!empty($id)){
                    unset($data['pcate']);
                    pdo_update('j_securitycode_code', $data, array('id' => $id));
                }else{
                    $ishad = pdo_fetchcolumn("SELECT code FROM " . tablename('j_securitycode_code') . " WHERE code='" . $data['code'] . "' and pcate='" . $pcate . "' limit 1");
                    if(empty($ishad) || $ishad != $data['code']){
                        pdo_insert('j_securitycode_code', $data);
                    }else{
                        message('抽奖码不能重复！', '', 'error');
                    }
                }
                message('修改成功！', $this -> createWebUrl('code', array('pcate' => $pcate)), 'success');
            }
        }elseif ($operation == 'delete'){
            $id = intval($_GPC['cid']);
            pdo_delete('j_securitycode_code', array('id' => $id));
            message('删除成功！', $this -> createWebUrl('code', array('pcate' => $pcate)), 'success');
        }elseif ($operation == 'add'){
            $rid = pdo_fetchcolumn("SELECT rid FROM " . tablename('j_securitycode_reply') . " WHERE weid=:weid and gid=:id order by id desc", array(":weid" => $_W['uniacid'], ":id" => $pcate));
            if(empty($rid) && $reply['codetype'])message("请先添加关键字", $_W['siteroot'] . "web/index.php?c=platform&a=reply&do=post&m=j_securitycode", "error");
            $keyword = pdo_fetchcolumn("SELECT content FROM " . tablename('rule_keyword') . " WHERE rid=:id order by id desc ", array(":id" => $rid));
            $codecount = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_securitycode_code') . " WHERE pcate =:pcate ", array(":pcate" => $pcate));
        }elseif ($operation == 'add2'){
            $rid = pdo_fetchcolumn("SELECT rid FROM " . tablename('j_securitycode_reply') . " WHERE weid=:weid and gid=:id order by id desc", array(":weid" => $_W['uniacid'], ":id" => $pcate));
            if(empty($rid) && $reply['codetype'])message("请先添加关键字", $_W['siteroot'] . "web/index.php?c=platform&a=reply&do=post&m=j_securitycode", "error");
            $keyword = pdo_fetchcolumn("SELECT content FROM " . tablename('rule_keyword') . " WHERE rid=:id order by id desc ", array(":id" => $rid));
            $codecount = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_securitycode_code') . " WHERE pcate =:pcate ", array(":pcate" => $pcate));
        }elseif ($operation == 'display'){
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
            if (checksubmit('submit')){
                load() -> func('file');
                $dir_url = IA_ROOT . '/attachment/images/' . $_W['uniacid'] . '/j_securitycode/';
                mkdirs($dir_url);
                if ($_FILES["csvfile"]["name"]){
                    $extNameAry = explode(".", $_FILES["csvfile"]["name"]);
                    $extName = $extNameAry[count($extNameAry)-1];
                    if($extName != 'csv')message('只能是导入csv格式的文件！', '', 'error');
                    $filename = date("YmdHis") . "." . $extName;
                    move_uploaded_file($_FILES["csvfile"]["tmp_name"], $dir_url . "/" . $filename);
                    $file = fopen($dir_url . "/" . $filename, 'r');
                    while ($data = fgetcsv($file)){
                        $goods_list[] = $data;
                    }
                    $parama = explode("|#|", $item['parama']);
                    $tableheader = array('id', 'code', 'qrcode', 'pcate', 'from_user', 'qrtype',);
                    foreach($parama as $row){
                        array_push($tableheader, $row);
                    }
                    if($item['playtype'] == 2){
                        $argument = json_decode($item['argument'], true);
                        foreach($argument as $index => $row){
                            array_push($tableheader, $index);
                            array_push($tableheader, $index . "-答案");
                        }
                    }
                    for($i = 0;$i < count($tableheader);$i++){
                        if(iconv('GB2312', 'UTF-8', trim($goods_list[0][$i])) != trim($tableheader[$i])){
                            echo trim($tableheader[$i]);
                            echo '<br>';
                            echo iconv('GB2312', 'UTF-8', trim($goods_list[0][$i]));
                            message('上传文件格式表格错误', '', 'error');
                        }
                    }
                    foreach ($goods_list as $row){
                        if(trim($row[0]) == "" || trim($row[0]) == "id")continue;
                        $temp = array();
                        for($i = 6;$i < (count($parama) + 6);$i++){
                            array_push($temp, iconv('GB2312', 'UTF-8', trim($row[$i])));
                        }
                        $temp_arg = array();
                        if($item['playtype'] == 2){
                            $temp_argkey = array();
                            $temp_argval = array();
                            $danshu = 0;
                            for($j = (count($parama) + 6);$j < count($tableheader);$j++){
                                if(!$danshu){
                                    $temp_argkey[] = urlencode(iconv('GB2312', 'UTF-8', trim($row[$j])));
                                }else{
                                    $temp_argval[] = urlencode(iconv('GB2312', 'UTF-8', trim($row[$j])));
                                }
                                $danshu++;
                                if($danshu > 1)$danshu = 0;
                            }
                            $k = 0;
                            foreach($argument as $index => $row2){
                                $temp_arg[urlencode($index)] = array($temp_argkey[$k], $temp_argval[$k]);
                                $k++;
                            }
                        }
                        $str_temp = urldecode(json_encode($temp_arg));
                        $tt = implode("|#|", $temp);
                        $insert = array('qrtype' => iconv('GB2312', 'UTF-8', trim($row[5])), 'parama' => $tt, 'argumentkey' => $str_temp,);
                        $result = pdo_update('j_securitycode_code', $insert, array('id' => $row[0]));
                    }
                    fclose($file);
                    message('修改成功！', $this -> createWebUrl('code', array('pcate' => $pcate)), 'success');
                }
            }
            $pindex = max(1, intval($_GPC['page']));
            $psize = 30;
            $condition = $_GPC['used'] ? " and scantime>0 ":" and scantime=0 ";
            if($_GPC['keyword'])$condition = " and (nickname like '%" . $_GPC['keyword'] . "%' or from_user like '%" . $_GPC['keyword'] . "%' or parama like '%" . $_GPC['keyword'] . "%')";
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate $condition ORDER BY endtime desc,id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('j_securitycode_code') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate $condition");
            $all = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('j_securitycode_code') . " WHERE weid = '{$_W['uniacid']}' and pcate=$pcate ");
            $haduse = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('j_securitycode_code') . " WHERE weid='{$_W['uniacid']}' and pcate=$pcate and endtime>0 ");
            $pager = pagination($total, $pindex, $psize);
        }elseif ($operation == 'export'){
            $used = isset($_GPC['used'])? $_GPC['used'] : 0;
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
            $where = $used ? " and scantime = 0 ":"";
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE pcate =:pcate $where order by id asc", array(":pcate" => $pcate));
            $parama = explode("|#|", $item['parama']);
            $tableheader = array('id', 'code', 'qrcode', 'pcate', 'from_user', 'qrtype',);
            foreach($parama as $row){
                array_push($tableheader, $row);
            }
            $html = "\xEF\xBB\xBF";
            foreach ($tableheader as $value){
                $html .= $value . "\t ,";
            }
            $html .= "\n";
            $__securitycode = setCopyRight();
            foreach($list as $row){
                $html .= $row['id'] . "\t ,";
                $html .= $row['code'] . "\t ,";
                if($item['codetype']){
                    $html .= $row['qrurl'] . "\t ,";
                }else{
                    $html .= $item['link'] . "?" . encrypt($item['id'] . "|#|" . $row['code'], 'E', $__securitycode['__securitycode']) . "\t ,";
                }
                $html .= $row['pcate'] . "\t ,";
                $html .= $row['from_user'] . "\t ,";
                $html .= $row['qrtype'] . "\t ,";
                $para = explode("|#|", $row['parama']);
                foreach($para as $val){
                    $html .= $val . "\t ,";
                }
                $html .= "\n";
            }
            header('Content-type:text/csv');
            header('Content-Disposition:attachment; filename=防伪码_' . $pcate . ".csv");
            echo $html;
            exit();
        }elseif ($operation == 'export2'){
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE pcate =:pcate order by id asc", array(":pcate" => $pcate));
            $parama = explode("|#|", $item['parama']);
            $tableheader = array('二维码编号', '所属活动', '使用人', '二维码分类', 'openid', '使用情况', '扫描时间', '扫描次数', '红包金额', '领取情况',);
            foreach($parama as $row){
                array_push($tableheader, $row);
            }
            if($reply['playtype'] == 1){
                $argument = json_decode($reply['argument'], true);
                foreach($argument as $index => $row){
                    array_push($tableheader, $index);
                }
            }
            $html = "\xEF\xBB\xBF";
            foreach ($tableheader as $value){
                $html .= $value . "\t ,";
            }
            $html .= "\n";
            foreach($list as $row){
                $html .= $row['id'] . "\t ,";
                $html .= str_replace(",", "，", $item['title']) . "\t ,";
                $html .= str_replace(",", "，", $row['nickname']) . "\t ,";
                $html .= $row['from_user'] . "\t ,";
                $html .= $row['qrtype'] . "\t ,";
                $temp = $row['status'] ? "已使用":"未使用";
                $html .= $temp . "\t ,";
                $temp = $row['endtime'] ? date('Y-m-d H:i', $row['endtime']): " ";
                $html .= $temp . "\t ,";
                $html .= $row['scantime'] . "\t ,";
                $html .= $row['fee'] . "\t ,";
                $temp = $row['completed'] == 1 ? "已领取":str_replace(",", "，", $row['log']);
                $html .= $temp . "\t ,";
                $para = explode("|#|", $row['parama']);
                foreach($para as $val){
                    $html .= str_replace(",", "，", $val) . "\t ,";
                }
                if($reply['playtype'] == 1){
                    $argument = json_decode($row['argument'], true);
                    foreach($argument as $index2 => $row2){
                        $html .= str_replace(",", "，", $row2) . "\t ,";
                    }
                }
                $html .= "\n";
            }
            header('Content-type:text/csv');
            header('Content-Disposition:attachment; filename=防伪码_使用情况' . $pcate . ".csv");
            echo $html;
            exit();
        }
        include $this -> template('code');
    }
    public function doWebLucky(){
        global $_GPC, $_W;
        $operation = $_GPC['op']?$_GPC['op']:'display';
        $pcate = intval($_GPC['pcate']);
        $reply = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " where id=:id ", array(':id' => $pcate));
        if(!$reply)message("活动不存在或者已经删除");
        load() -> func('tpl');
        if($operation == "show_lucky"){
            $id = intval($_GPC['id']);
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_luckygame') . " WHERE id = :id", array(":id" => $id));
            if(!$id)message("活动不存在");
            $prize_list = @explode("|#|", $item['option']);
            if($item['vid'])$votelist = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_voteitem') . " where pcate=:pcate order by votekey asc", array(':pcate' => $pcate));
            include $this -> template('show_lucky');
            exit();
        }elseif($operation == "display"){
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_luckygame') . " where pcate=:pcate order by id desc ", array(':pcate' => $pcate));
        }elseif($operation == 'post'){
            $id = intval($_GPC['id']);
            if(!empty($id)){
                $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_luckygame') . " WHERE id = :id", array(":id" => $id));
                $prize_list = @explode("|#|", $item['option']);
            }
            if (checksubmit('submit')){
                $option = @implode("|#|", $_GPC['option']);
                $data = array("pcate" => $pcate, "jointype" => $_GPC['jointype'], "bg" => $_GPC['bg'], "thumb" => $_GPC['thumb'], "weid" => $_W['uniacid'], "title" => $_GPC['title'], "msg" => $_GPC['msg'], "option" => $option);
                if($id){
                    unset($data['pcate']);
                    unset($data['weid']);
                    pdo_update('j_securitycode_luckygame', $data, array('id' => $id));
                }else{
                    pdo_insert('j_securitycode_luckygame', $data);
                }
                message('更新成功！', $this -> createWebUrl('lucky', array('op' => 'display', 'pcate' => $pcate)), 'success');
            }
        }elseif($operation == "joiner"){
            $id = intval($_GPC['id']);
            $keyword = $_GPC['keyword'];
            if($keyword)$where = " and ( nickname like '%" . $keyword . "%' or from_user like '%" . $keyword . "%' or prize like '%" . $keyword . "%' )";
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_luckywinner') . " where lid=:lid $where order by id desc,prize asc,status asc", array(':lid' => $id));
            $count_ary = array("all" => count($list), "noget" => 0, "get" => 0, "sendfail" => 0, "sendsuccess" => 0);
            foreach($list as $row){
                if(!$row['status']){
                    $count_ary['noget'] = $count_ary['noget'] + 1;
                }else{
                    $count_ary['get'] = $count_ary['get'] + 1;
                }
                if(!$row['sendstatus']){
                    $count_ary['sendfail'] = $count_ary['sendfail'] + 1;
                }else{
                    $count_ary['sendsuccess'] = $count_ary['sendsuccess'] + 1;
                }
            }
        }elseif($operation == 'delete'){
            $id = intval($_GPC['id']);
            pdo_delete('j_securitycode_luckygame', array('id' => $id));
            pdo_delete('j_securitycode_luckywinner', array('lid' => $id));
            message('删除成功！', $this -> createWebUrl('lucky', array('op' => 'display', 'pcate' => $pcate)), 'success');
        }elseif($operation == 'resendmessage'){
            $id = intval($_GPC['id']);
            $uid = intval($_GPC['uid']);
            $sendtype = intval($_GPC['sendtype']);
            $pindex = intval($_GPC['page']);
            if($uid){
                $fans = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_luckywinner') . " WHERE id = :id", array(":id" => $uid));
            }else{
                $sql = $sql = "SELECT * FROM " . tablename('j_securitycode_luckywinner') . " WHERE lid = :lid order by id asc  LIMIT " . $pindex . ",1";
                if($sendtype == 1)$sql = "SELECT * FROM " . tablename('j_securitycode_luckywinner') . " WHERE lid = :lid and status=0 order by id asc LIMIT " . $pindex . ",1";
                if($sendtype == 2)$sql = "SELECT * FROM " . tablename('j_securitycode_luckywinner') . " WHERE lid = :lid and sendstatus=0 order by id asc  LIMIT " . $pindex . ",1";
                $fans = pdo_fetch($sql, array(":lid" => $id));
            }
            $txt = $fans['prize'] ? "恭喜您，获得" . $fans['prize'] . "。请到后台领取奖品，凭此信息兑奖":"恭喜您中奖了，请到后台领取奖品，凭此信息兑奖";
            $result = _sendText($fans['from_user'], $txt);
            if(!$result['errno']){
                pdo_update("j_securitycode_luckywinner", array("sendstatus" => 1, "remark" => ""), array("id" => $fans['id']));
            }else{
                pdo_update('j_securitycode_luckywinner', array('sendstatus' => 0, 'remark' => implode('，', $result)), array("id" => $fans['id']));
            }
            die(json_encode(array('success' => true, 'errno' => $result['errno'], 'msg' => implode('，', $result))));
        }elseif($operation == 'joinerprize'){
            $id = intval($_GPC['id']);
            $uid = intval($_GPC['uid']);
            $status = intval($_GPC['status']);
            pdo_update('j_securitycode_luckywinner', array('status' => $status), array("id" => $uid));
            message('标记领奖成功！', $this -> createWebUrl('lucky', array('op' => 'joiner', 'pcate' => $pcate, 'id' => $id)), 'success');
        }elseif($operation == 'joinerdelete'){
            $id = intval($_GPC['id']);
            $uid = intval($_GPC['uid']);
            pdo_delete('j_securitycode_luckywinner', array('id' => $uid));
            message('删除成功！', $this -> createWebUrl('lucky', array('op' => 'joiner', 'pcate' => $pcate, 'id' => $id)), 'success');
        }elseif($operation == 'getuser'){
            $id = intval($_GPC['id']);
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_luckygame') . " WHERE id = :id", array(":id" => $id));
            $user = array();
            $list = pdo_fetchall("SELECT max(nickname) as nname,max(headimgurl) as head,from_user FROM " . tablename('j_securitycode_code') . " WHERE pcate = :pcate and from_user<>'' and from_user not in(select from_user from " . tablename('j_securitycode_luckywinner') . " where lid=:lid group by from_user) group by from_user ", array(":pcate" => $pcate, ":lid" => $id));
            if($item['jointype'])$list = pdo_fetchall("SELECT max(nickname) as nname,max(headimgurl) as head,from_user FROM " . tablename('j_securitycode_code') . " WHERE pcate = :pcate and from_user<>'' and ascantime>0 and from_user not in(select from_user from " . tablename('j_securitycode_luckywinner') . " where lid=:lid group by from_user) group by from_user ", array(":pcate" => $pcate, ":lid" => $id));
            shuffle($list);
            $i = 0;
            foreach($list as $row){
                if($i >= 20)break;
                $user[] = array('nickname' => $row['nname'], 'avatar' => $row['head'], 'from_user' => $row['from_user'],);
                $i++;
            }
            die(json_encode(array('success' => true, 'user' => $user)));
        }elseif($operation == 'submitwinner'){
            $id = intval($_GPC['id']);
            $prize = $_GPC['prize'];
            $userlist = $_GPC['userlist'];
            $list = array();
            if(strpos($userlist, "|^^|")){
                $list = explode("|^^|", $userlist);
            }else{
                $list[] = $userlist;
            }
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_luckygame') . " WHERE id = :id", array(":id" => $id));
            $listall = pdo_fetchall("select max(nickname) as nname,max(headimgurl) as head,from_user from " . tablename('j_securitycode_code') . " where pcate=:pcate and from_user in('" . implode("','", $list) . "') group by from_user", array(':pcate' => $pcate));
            $tempsql = "insert into " . tablename('j_securitycode_luckywinner') . "(pcate, weid,lid,from_user,nickname,avatar,prize,sendstatus,remark) VALUES";
            $sql_ary = array();
            $txt = $prize ? "恭喜您，获得" . $prize . "。请到后台领取奖品，凭此信息兑奖":"恭喜您中奖了，请到后台领取奖品，凭此信息兑奖";
            $txt = str_replace('|#奖品#|', $prize, $txt);
            foreach($listall as $row){
                $result = _sendText($row['from_user'], $txt);
                $temp = "";
                if(!$result['errno']){
                    $temp = "('" . $pcate . "','" . $_W['uniacid'] . "','" . $id . "','" . $row['from_user'] . "','" . $row['nname'] . "','" . $row['head'] . "','" . $prize . "','1','')";
                }else{
                    $temp = "('" . $pcate . "','" . $_W['uniacid'] . "','" . $id . "','" . $row['from_user'] . "','" . $row['nname'] . "','" . $row['head'] . "','" . $prize . "','0','" . implode('，', $result) . "')";
                }
                array_push($sql_ary, $temp);
            }
            $tempsql .= implode(",", $sql_ary);
            @pdo_run($tempsql);
            $prize_list = @explode("|#|", $item['option']);
            $prise_result = array();
            foreach($prize_list as $row){
                if($row)$prise_result[$row] = pdo_fetchcolumn("select count(*) from " . tablename('j_securitycode_luckywinner') . " where pcate=:pcate and lid=:lid and prize=:prize", array(':pcate' => $pcate, ':lid' => $id, ':prize' => $row));
            }
            die(json_encode(array('success' => true, 'prize' => $prise_result)));
        }
        include $this -> template('adv_lucky');
    }
    public function doWebAjax(){
        global $_GPC, $_W;
        if(!$_W['isajax'])die(json_encode(array('success' => false, 'msg' => '无法获取系统信息,请重新打开再尝试')));
        $operation = !empty($_GPC['op'])? $_GPC['op'] : 'display';
        if($operation == 'addcode'){
            $pcate = intval($_GPC['pcate']);
            $code[0] = '1234567890abcdefghijklmnpqrstuvwxyz';
            $data = array('weid' => $_W['uniacid'], 'pcate' => $pcate, 'createtime' => TIMESTAMP,);
            $len = 6;
            $hash = '';
            $max = strlen($code[0]) - 1;
            for($i = 0;$i < $len;$i++){
                $hash .= $code[0][mt_rand(0, $max)];
            }
            $data['code'] = $hash;
            $isIn = pdo_fetchcolumn("select code from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' and code='" . $hash . "'");
            if(empty($isIn) || $isIn != $hash){
                pdo_insert('j_securitycode_code', $data);
                die(json_encode(array('success' => true)));
            }else{
                die(json_encode(array('success' => false)));
            }
        }
        if($operation == 'addonecode'){
            $pcate = intval($_GPC['pcate']);
            $keyword = urldecode($_GPC['keyword']);
            $codetype = intval($_GPC['codetype']);
            if(!$keyword)message("关键字不能为空");
            $code[0] = '1234567890abcdefghijklmnpqrstuvwxyz';
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
            $data = array('weid' => $_W['uniacid'], 'pcate' => $pcate, 'codetype' => $codetype, 'createtime' => TIMESTAMP,);
            $data2 = array('uniacid' => $_W['uniacid'], 'acid' => $_W['account']['acid'], 'name' => $reply['title'], 'keyword' => $keyword, 'model' => $codetype, 'createtime' => TIMESTAMP, 'type' => 'scene', 'status' => 1);
            $uniacccount = WeAccount :: create($_W['account']['acid']);
            $isIn = pdo_fetchcolumn("select code from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' and code='" . $hash . "'");
            load() -> func('communication');
            if ($codetype == 1){
                $timer = intval($_GPC['timer']);
                if($timer < 1)$timer = 1;
                if($timer > 30)$timer = 30;
                $expire = 86400 * $timer;
                $hash = rand(100001, 1000000);
                $isIn = pdo_fetchcolumn("select count(*) from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' and validtime>" . TIMESTAMP . " and code='" . $hash . "'");
                if($isIn)die(json_encode(array('success' => false)));
                $barcode['expire_seconds'] = $expire;
                $barcode['action_info']['scene']['scene_id'] = $hash;
                $barcode['action_name'] = 'QR_SCENE';
                $result = $uniacccount -> barCodeCreateDisposable($barcode);
                $data['validtime'] = TIMESTAMP + $expire;
                $data2['expire'] = $expire;
                $data2['qrcid'] = $hash;
            }else{
                $len = 6;
                $hash = '';
                $max = strlen($code[0]) - 1;
                for($i = 0;$i < $len;$i++){
                    $hash .= $code[0][mt_rand(0, $max)];
                }
                $hash = $pcate . "|#|" . $hash;
                $isIn = pdo_fetchcolumn("select count(*) from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' and code='" . $hash . "'");
                if($isIn)die(json_encode(array('success' => false)));
                $barcode['action_info']['scene']['scene_str'] = $hash;
                $barcode['action_name'] = 'QR_LIMIT_STR_SCENE';
                $data2['scene_str'] = $hash;
                $result = $uniacccount -> barCodeCreateFixed($barcode);
            }
            if(!is_error($result)){
                $data['code'] = $hash;
                $data['qrurl'] = $result['url'];
                $data2['ticket'] = $result['ticket'];
                $data2['url'] = $result['url'];
                pdo_insert('j_securitycode_code', $data);
                $data2['name'] = $item['title'];
                pdo_insert('qrcode', $data2);
                die(json_encode(array('success' => true, 'url' => $result['url'])));
            }
            die(json_encode(array('success' => false)));
        }
        if($operation == 'addcode2'){
            $pcate = intval($_GPC['pcate']);
            $num = abs(intval($_GPC['num']));
            $pernum = $num > 100 ? 100: $num;
            $keyword = urldecode($_GPC['keyword']);
            $codetype = intval($_GPC['codetype']);
            if(!$keyword)message("关键字不能为空");
            $code[0] = '1234567890abcdefghijklmnpqrstuvwxyz';
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
            $data = array('weid' => $_W['uniacid'], 'pcate' => $pcate, 'codetype' => $codetype, 'createtime' => TIMESTAMP,);
            $data2 = array('uniacid' => $_W['uniacid'], 'acid' => $_W['account']['acid'], 'name' => $reply['title'], 'keyword' => $keyword, 'model' => $codetype, 'createtime' => TIMESTAMP, 'type' => 'scene', 'status' => 1);
            $uniacccount = WeAccount :: create($_W['account']['acid']);
            $isIn = pdo_fetchcolumn("select code from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' and code='" . $hash . "'");
            load() -> func('communication');
            $increatenum = 0;
            for($j = 1;$j < $pernum;$j++){
                if ($codetype == 1){
                    $timer = intval($_GPC['timer']);
                    if($timer < 1)$timer = 1;
                    if($timer > 30)$timer = 30;
                    $expire = 86400 * $timer;
                    $hash = rand(100001, 1000000);
                    $isIn = pdo_fetchcolumn("select count(*) from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' and validtime>" . TIMESTAMP . " and code='" . $hash . "'");
                    if($isIn)continue;
                    $barcode['expire_seconds'] = $expire;
                    $barcode['action_info']['scene']['scene_id'] = $hash;
                    $barcode['action_name'] = 'QR_SCENE';
                    $result = $uniacccount -> barCodeCreateDisposable($barcode);
                    $data['validtime'] = TIMESTAMP + $expire;
                    $data2['expire'] = $expire;
                    $data2['qrcid'] = $hash;
                }else{
                    $len = 6;
                    $hash = '';
                    $max = strlen($code[0]) - 1;
                    for($i = 0;$i < $len;$i++){
                        $hash .= $code[0][mt_rand(0, $max)];
                    }
                    $hash = $pcate . "|#|" . $hash;
                    $isIn = pdo_fetchcolumn("select count(*) from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' and code='" . $hash . "'");
                    if($isIn)continue;
                    $barcode['action_info']['scene']['scene_str'] = $hash;
                    $barcode['action_name'] = 'QR_LIMIT_STR_SCENE';
                    $data2['scene_str'] = $hash;
                    $result = $uniacccount -> barCodeCreateFixed($barcode);
                }
                if(is_error($result))continue;
                $data['code'] = $hash;
                $data['qrurl'] = $result['url'];
                $data2['ticket'] = $result['ticket'];
                $data2['url'] = $result['url'];
                pdo_insert('j_securitycode_code', $data);
                $data2['name'] = $item['title'];
                pdo_insert('qrcode', $data2);
                $increatenum++;
            }
            die(json_encode(array('success' => true, 'num' => $increatenum)));
        }
        if($operation == 'sendredpack'){
            $id = intval($_GPC['id']);
            $item = pdo_fetch("select * from " . tablename('j_securitycode_code') . " WHERE id = '$id'");
            if(!$item || $item['completed'] == 1)die(json_encode(array('success' => false)));
            $result = $this -> _sendpack($id);
            die(json_encode(array('success' => true, 'msg' => $result)));
        }
        if($operation == 'webscancode'){
            $code = urldecode($_GPC['code']);
            $pcate = intval($_GPC['pcate']);
            if(!$code || !$pcate)die(urldecode(json_encode(array('success' => false, 'msg' => urlencode('1#参数缺失')))));
            load() -> func('cache');
            $_scode = cache_load("scode");
            $strAry = array();
            $reply = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id=:id ", array(':id' => $pcate));
            if($reply['status'] == 0)die(json_encode(array('success' => false, 'msg' => '4#活动已经结束了哦')));
            if(strpos($code, '/q/')){
                $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE qrurl=:qrurl and pcate=:pcate", array(':qrurl' => $code, ':pcate' => $pcate));
            }else{
                $strAry = explode("?", $code);
                if(count($strAry) < 2)die(urldecode(json_encode(array('success' => false, 'msg' => urlencode('2#格式错误')))));
                $QrCode = $this -> encrypt($strAry[1], 'D', $_scode);
                $tempAry = explode("|#|", $QrCode);
                if(count($tempAry) != 2)die(urldecode(json_encode(array('success' => false, 'msg' => urlencode('3#格式错误')))));
                $code = $tempAry[1];
                $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE code=:code and pcate=:pcate", array(':code' => $code, ':pcate' => $pcate));
            }
            if(empty($item))die(json_encode(array('success' => false, 'msg' => '5#防伪码不存在或者未启用')));
            $data = array("from_user" => $item['from_user'], "nickname" => $item['nickname'], "headimgurl" => $item['headimgurl'], "aendtime" => $item['aendtime'], "ascantime" => $item['ascantime'] + 1, "fee" => sprintf('%.2f', $item['fee'] / 100),);
            if(!$item['ascantime']){
                $data['aendtime'] = date("m/d H:i", TIMESTAMP);
                pdo_update('j_securitycode_code', array('aendtime' => TIMESTAMP, 'ascantime' => $item['ascantime'] + 1), array("id" => $item['id']));
            }else{
                $data['aendtime'] = date("m/d H:i", $item['aendtime']);
                pdo_update('j_securitycode_code', array('ascantime' => $item['ascantime'] + 1), array("id" => $item['id']));
            }
            $data['parama'] = $item['parama'];
            if($item['from_user']){
                $user = pdo_fetch("SELECT count(*) as num,sum(fee) as fees FROM " . tablename('j_securitycode_code') . " WHERE from_user=:from_user and pcate=:pcate", array(':from_user' => $item['from_user'], ':pcate' => $pcate));
                $data['num'] = intval($user['num']);
                $data['allfee'] = sprintf('%.2f', $user['fees'] / 100);
                $prizeid = pdo_fetchcolumn("SELECT rid FROM " . tablename('j_shakecode_reply') . " WHERE fid=:fid  ", array(':fid' => $pcate));
                if($prizeid){
                    $prizelist = pdo_fetchall("SELECT * FROM " . tablename('j_shakecode_winner') . " WHERE from_user=:from_user and rid=:rid and isprize=1 order by status asc,id desc", array(':from_user' => $item['from_user'], ':rid' => $prizeid));
                    $prize_ = pdo_fetchall("SELECT * FROM " . tablename('j_shakecode_award') . " WHERE rid=:rid", array(':rid' => $prizeid));
                    $prize_ary = array();
                    foreach($prize_ as $row){
                        $prize_ary[$row['id']] = array("title" => $row['title'], "img" => $row['thumb'], "sponsor" => $row['sponsor'],);
                    }
                    $data['prizenum'] = count($prizelist);
                    $data['prize_ary'] = $prize_ary;
                    $data['prize'] = $prizelist;
                }
            }
            die(json_encode(array('success' => true, 'result' => $data)));
        }
        if($operation == "dealprize"){
            $id = intval($_GPC['id']);
            $data = array("status" => 1, "endtime" => TIMESTAMP,);
            pdo_update('j_shakecode_winner', $data, array('id' => $id));
            die(json_encode(array('success' => true, 'time' => date('m/d H:i', TIMESTAMP))));
        }
        if($operation == "sendmessage"){
            $pcate = intval($_GPC['pcate']);
            $uid = intval($_GPC['uid']);
            $sendTpye = intval($_GPC['sendtype']);
            $pindex = intval($_GPC['page']);
            $content = $_GPC['content'];
            if(!$content)die(json_encode(array('success' => false, 'msg' => "请输入内容")));
            if($uid){
                $fans = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_msgsend') . " WHERE id = :id", array(":id" => $uid));
            }else{
                $sql = "SELECT from_user,max(nickname) as nicknames FROM " . tablename('j_securitycode_code') . " WHERE weid = '{$_W['uniacid']}' and pcate=:pcate and from_user<>'' group by from_user order by id asc LIMIT " . $pindex . ",1";
                if($sendtype == 2)$sql = "SELECT from_user,max(nickname) as nicknames FROM " . tablename('j_securitycode_code') . " WHERE weid='{$_W['uniacid']}' and pcate=:pcate and ascantime>0 group by from_user order by id asc LIMIT " . $pindex . ",1";
                if($sendtype == 5)$sql = "SELECT from_user,max(nickname) as nicknames FROM " . tablename('j_securitycode_msgsend') . " WHERE weid='{$_W['uniacid']}' and pcate=:pcate group by from_user order by id asc LIMIT " . $pindex . ",1";
                $fans = pdo_fetch($sql, array(":pcate" => $pcate));
                if($sendtype == 5)$content = $fans['content'];
            }
            $nickname = $fans['nicknames'] ? $fans['nicknames'] :'客户';
            $content = str_replace("|#昵称#|", $nickname, $content);
            $result = _sendtext($fans['from_user'], $content);
            if(!$result['errno']){
                if($uid)pdo_delete("j_securitycode_msgsend", array("from_user" => $fans['from_user']));
            }else{
                if($uid){
                    pdo_update("j_securitycode_msgsend", array("status" => 0, "log" => implode('，', $result), "endtime" => TIMESTAMP), array("id" => $uid));
                }else{
                    pdo_delete('j_securitycode_msgsend', array('from_user' => $fans['from_user']));
                    pdo_insert('j_securitycode_msgsend', array('weid' => $_W['uniacid'], "from_user" => $fans['from_user'], "content" => $content, "nickname" => $fans['nicknames'], "pcate" => $pcate, "endtime" => TIMESTAMP, "log" => implode('，', $result)));
                }
            }
            die(json_encode(array('success' => true, 'errno' => $result['errno'], 'msg' => implode('，', $result))));
        }
        if($operation == "getnum"){
            $pcate = intval($_GPC['pcate']);
            $puttype = intval($_GPC['puttype']);
            $sql = "select count(*) from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' ";
            if(!$puttype)$sql = "select count(*) from " . tablename('j_securitycode_code') . " WHERE pcate = '$pcate' and scantime = 0 ";
            $all = pdo_fetchcolumn($sql);
            die(json_encode(array('success' => true, 'all' => $all)));
        }
        if($operation == "intoexcel"){
            $pcate = intval($_GPC['pcate']);
            $puttype = intval($_GPC['puttype']);
            $pindex = max(1, intval($_GPC['pindex']));
            $psize = 500;
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id =:id ", array(":id" => $pcate));
            $where = !$puttype ? " and endtime = 0 ":"";
            $list = pdo_fetchall("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE pcate =:pcate $where order by id asc limit " . ($pindex - 1) * $psize . ',' . $psize, array(":pcate" => $pcate));
            $total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_securitycode_code') . " WHERE pcate =:pcate $where  ", array(":pcate" => $pcate));
            $allpage = $total % $psize > 0 ? intval($total / $psize) + 1 : intval($total / $psize);
            if($total <= $psize)$allpage = 1;
            $parama = explode("|#|", $item['parama']);
            $argument = json_decode($item['argument'], true);
            $html = "";
            load() -> func('file');
            $dir_url = IA_ROOT . '/attachment/j_securitycode/csv/' . $_W['uniacid'] . "/";
            mkdirs($dir_url);
            $file_name = $pcate . "_code.csv";
            $fileurl = $dir_url . $file_name;
            if(count($list) == 0)die(json_encode(array('success' => false, 'fileurl' => $fileurl)));
            if($pindex == 1){
                $tableheader = array('id', 'code', 'qrcode', 'pcate', 'from_user', 'qrtype',);
                foreach($parama as $row){
                    array_push($tableheader, $row);
                }
                if($item['playtype'] == 2){
                    foreach($argument as $index => $row){
                        array_push($tableheader, $index);
                        array_push($tableheader, $index . "-答案");
                    }
                }
                $html = "\xEF\xBB\xBF";
                foreach ($tableheader as $value){
                    $html .= $value . "\t ,";
                }
                $html .= "\n";
                if(file_exists($fileurl))unlink($fileurl);
                $file = fopen($fileurl, 'w');
                fwrite($file, $html);
                fclose($file);
                $html = "";
            }
            $file = fopen($fileurl, 'a');
            $__securitycode = setCopyRight();
            foreach($list as $row){
                $html .= $row['id'] . "\t ,";
                $html .= $row['code'] . "\t ,";
                if($item['codetype']){
                    $html .= $row['qrurl'] . "\t ,";
                }else{
                    $html .= $item['link'] . "?" . encrypt($item['id'] . "|#|" . $row['code'], 'E', $__securitycode['__securitycode']) . "\t ,";
                }
                $html .= $row['pcate'] . "\t ,";
                $html .= $row['from_user'] . "\t ,";
                $html .= $row['qrtype'] . "\t ,";
                $para = explode("|#|", $row['parama']);
                foreach($para as $val){
                    $html .= $val . "\t ,";
                }
                if($item['playtype'] == 2){
                    $argumentkey = json_decode($row['argumentkey'], true);
                    foreach($argument as $index => $row2){
                        $html .= urldecode($argumentkey[$index][0]) . "\t ,";
                        $html .= urldecode($argumentkey[$index][1]) . "\t ,";
                    }
                }elseif($item['playtype'] == 1){
                    $arguments = json_decode($row['argument'], true);
                    foreach($arguments as $index => $row2){
                        $html .= urldecode($index) . "\t ,";
                        $html .= urldecode($row2) . "\t ,";
                    }
                }
                $html .= "\n";
            }
            fwrite($file, $html);
            fclose($file);
            die(json_encode(array('success' => true, 'allpage' => $allpage, 'd' => ($pindex / $allpage) * 100)));
        }
    }
    private function encrypt($string, $operation, $key = ''){
        $key = md5($key);
        $key_length = strlen($key);
        $string = $operation == 'D'?base64_decode($string):substr(md5($string . $key), 0, 8) . $string;
        $string_length = strlen($string);
        $rndkey = $box = array();
        $result = '';
        for($i = 0;$i <= 255;$i++){
            $rndkey[$i] = ord($key[$i % $key_length]);
            $box[$i] = $i;
        }
        for($j = $i = 0;$i < 256;$i++){
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for($a = $j = $i = 0;$i < $string_length;$i++){
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if($operation == 'D'){
            if(substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)){
                return substr($result, 8);
            }else{
                return'';
            }
        }else{
            return str_replace('=', '', base64_encode($result));
        }
    }
    private function sendsMessage(){
        global $_W;
        $__copy = setCopyRight();
        $code2 = urlencode($__copy['_UserIdCode']);
        if(!$code2)die("没有授权文件，请与管理者联系");
        $code = "aHR0cDovL2Ntcy55ZmpzLWRlc2lnbi5jb20vYXBwL2luZGV4LnBocD9pPTEmYz1lbnRyeSZkbz1pbmRleCZtPWpfY29weXJpZ2h0";
        load() -> func('communication');
        $url = urlencode($_W['siteroot']);
        $version = pdo_fetchcolumn("select version from " . tablename('modules') . " WHERE name= 'j_securitycode'");
        $result = ihttp_get(base64_decode($code) . "&url=" . $url . "user=" . $code2);
        if(!$result)die("授权失败");
    }
    public function doWebUpgrade(){
        global $_GPC, $_W;
        $__copy = setCopyRight();
        $code2 = urlencode($__copy['_UserIdCode']);
        if(!$code2)die("没有授权文件，请与管理者联系");
        $code = "aHR0cDovL2Ntcy55ZmpzLWRlc2lnbi5jb20vYXBwL2luZGV4LnBocD9pPTEmYz1lbnRyeSZkbz12ZXJzaW9uJm09al9jb3B5cmlnaHQ=";
        load() -> func('communication');
        $postUrl = base64_decode($code) . "&url=" . urlencode($_W['siteroot']) . "&user=" . $code2;
        $post = ihttp_get($postUrl);
        $result = @json_decode($post['content'], true);
        $_version = pdo_fetchcolumn("select version from " . tablename('modules') . " WHERE name= 'j_securitycode'");
        if($result){
            if($result > $_version){
                if(file_exists("../addons/j_securitycode/upgrade.php")){
                    require_once('../addons/j_securitycode/upgrade.php');
                    @unlink('../addons/j_securitycode/upgrade.php');
                    pdo_update('modules', array('version' => $result), array("name" => "j_securitycode"));
                    message('升级成功，请更新缓存！', $this -> createWebUrl('manage'), 'success');
                }
            }
        }
    }
    private function _sendpack($codeid = 0){
        global $_W;
        $item = pdo_fetch('select * from ' . tablename('j_securitycode_code') . ' where id=:id and weid=:weid ', array(':id' => $codeid, ':weid' => $_W['uniacid']));
        $reply = pdo_fetch('select * from ' . tablename('j_securitycode_category') . ' where id=:id ', array(':id' => $item['pcate']));
        $redpack = pdo_fetch('select * from ' . tablename('j_securitycode_redpack') . ' where id=:id ', array(':id' => $reply['redpackid']));
        $_openid = $item['from_user'];
        if(empty($item) || empty($_openid) || empty($redpack))return false;
        $fee = $item['fee'];
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
        $pars = array();
        $pars['nonce_str'] = random(32);
        $pars['mch_billno'] = $redpack['mchid'] . date('YmdHis') . rand(1000, 9999);
        $pars['mch_id'] = $redpack['mchid'];
        $pars['wxappid'] = $redpack['appid'];
        $pars['send_name'] = $redpack['send_name'];
        $pars['re_openid'] = $_openid;
        $pars['total_amount'] = $fee;
        $pars['total_num'] = 1;
        $pars['wishing'] = (empty($redpack['wishing'])?'没什么，就是想送你一个红包':$redpack['wishing']);
        $pars['client_ip'] = $redpack['ip'];
        $pars['act_name'] = $redpack['title'];
        $pars['remark'] = $redpack['title'];
        ksort($pars, SORT_STRING);
        $string1 = '';
        foreach ($pars as $k => $v){
            $string1 .= "{$k}={$v}&";
        }
        $string1 .= "key=" . $redpack['signkey'];
        $pars['sign'] = strtoupper(md5($string1));
        $xml = array2xml($pars);
        $extras = array();
        $extras['CURLOPT_CAINFO'] = IA_ROOT . '/attachment/j_securitycode/cert_2/' . $reply['redpackid'] . '/rootca.pem';
        $extras['CURLOPT_SSLCERT'] = IA_ROOT . '/attachment/j_securitycode/cert_2/' . $reply['redpackid'] . '/apiclient_cert.pem';
        $extras['CURLOPT_SSLKEY'] = IA_ROOT . '/attachment/j_securitycode/cert_2/' . $reply['redpackid'] . '/apiclient_key.pem';
        $procResult = null;
        load() -> func('communication');
        $resp = ihttp_request($url, $xml, $extras);
        if (is_error($resp)){
            $procResult = $resp;
        }else{
            $arr = json_decode(json_encode((array) simplexml_load_string($resp['content'])), true);
            $xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
            $dom = new \DOMDocument();
            if ($dom -> loadXML($xml)){
                $xpath = new \DOMXPath($dom);
                $code = $xpath -> evaluate('string(//xml/return_code)');
                $ret = $xpath -> evaluate('string(//xml/result_code)');
                if (strtolower($code) == 'success' && strtolower($ret) == 'success'){
                    $procResult = array('errno' => 0, 'error' => 'success');
                }else{
                    $error = $xpath -> evaluate('string(//xml/err_code_des)');
                    $procResult = array('errno' => -2, 'error' => $error);
                }
            }else{
                $procResult = array('errno' => -1, 'error' => '未知错误');
            }
        }
        $rec = array();
        $rec['log'] = $error;
        $rec['completed'] = $procResult['errno'] != 0 ? $procResult['errno'] :1;
        pdo_update('j_securitycode_code', $rec, array('id' => $codeid));
        return $rec['completed'];
    }
    private function getNonceStr($length = 64){
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0;$i < $length;$i++){
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }
}
