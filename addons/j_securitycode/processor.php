<?php
defined('IN_IA')or exit('Access Denied');
class J_securitycodeModuleProcessor extends WeModuleProcessor{
    public function respond(){
        global $_W;
        $openid = $this -> message['from'];
        $rid = $this -> rule;
        $rids = pdo_fetchcolumn("SELECT gid FROM " . tablename('j_securitycode_reply') . " WHERE rid=:rid ", array(':rid' => $rid));
        load() -> func('cache');
        $_scode = cache_load("scode");
        if(!$_scode){
            $_scode = pdo_fetchcolumn("SELECT value FROM " . tablename('core_cache') . " WHERE key=:key ", array(':key' => "scode"));
            if(!$_scode)return $this -> respText("解密文件加载错误！");
        }
        session_start();
        if($this -> inContext){
            $pcate = $_SESSION['j_securitycode_pcate'];
            $codeid = $_SESSION['j_securitycode_codeid'];
            $questionkey = $_SESSION['j_securitycode_key'];
            $QrCode = $_SESSION['j_securitycode_qrcode'];
            $reply = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id=:id ", array(':id' => $pcate));
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE id=:id", array(':id' => $codeid));
            $content = $this -> message['content'];
            $argument = json_decode($reply['argument'], true);
            $userargument = @json_decode($item['argument'], true);
            $argumentkey = @json_decode($item['argumentkey'], true);
            if($openid != $item['from_user']){
                $this -> endContext();
                unset($_SESSION['j_securitycode_pcate']);
                unset($_SESSION['j_securitycode_codeid']);
                unset($_SESSION['j_securitycode_key']);
                unset($_SESSION['j_securitycode_qrcode']);
                return $this -> respText("抱歉，回答超时！");
            }
            if(!$content){
                if(TIMESTAMP - $_SESSION['j_securitycode_time'] < 15){
                    return $this -> respText("");
                }else{
                    $_SESSION['j_securitycode_time'] = TIMESTAMP;
                }
            }
            $reStr = "";
            $anwserAry = array();
            if($reply['playtype'] == 2){
                $anwser = trim($argument[$questionkey]);
                $question = $questionkey;
                if(!$anwser){
                    $question = $argumentkey[$questionkey][0];
                    $anwser = $argumentkey[$questionkey][1];
                }
                if(strpos($anwser, "|")){
                    $temp_ary = explode("|", $anwser);
                    $anwser = array_filter($temp_ary);
                }
                $flag = false;
                if(is_array($anwser)){
                    if(in_array(trim($content), $anwser))$flag = true;
                }else{
                    if($anwser == trim($content))$flag = true;
                }
                if(!$flag){
                    if(!isset($_SESSION['j_securitycode_wrong'])){
                        $_SESSION['j_securitycode_wrong'] = 1;
                    }else{
                        $_SESSION['j_securitycode_wrong'] = $_SESSION['j_securitycode_wrong'] + 1;
                    }
                    $isLimit = 4 - $_SESSION['j_securitycode_wrong'];
                    if(!$isLimit){
                        $data = array('from_user' => '', 'scantime' => 0, 'nickname' => '', 'headimgurl' => '', 'argument' => '', 'endtime' => 0,);
                        $insert = array('from_user' => $openid, 'nickname' => $item['nickname'], 'codeid' => $item['id'], 'pcate' => $pcate, 'log' => "问题回答错误次数过多。", 'endtime' => TIMESTAMP,);
                        pdo_insert('j_securitycode_limit', $insert);
                        pdo_update('j_securitycode_code', $data, array('id' => $item['id']));
                        $this -> endContext();
                        unset($_SESSION['j_securitycode_pcate']);
                        unset($_SESSION['j_securitycode_codeid']);
                        unset($_SESSION['j_securitycode_key']);
                        unset($_SESSION['j_securitycode_qrcode']);
                        return $this -> respText("错误次数达到上限，请重新扫描二维码");
                    }
                    $reStr = "回答错误，请重新输入。还有" . $isLimit . "次机会。\n" . $question;
                    return $this -> respText($reStr);
                }else{
                    $_SESSION['j_securitycode_wrong'] = 0;
                }
            }
            $isComplete = 0;
            foreach($argument as $index => $row){
                if($index == $questionkey){
                    $anwserAry[urlencode($index)] = urlencode($content);
                    continue;
                }
                if($userargument[$index]){
                    $anwserAry[urlencode($index)] = urlencode($userargument[$index]);
                }else{
                    $reStr .= $row;
                    if($reply['playtype'] == 2){
                        if(!$row){
                            $reStr .= $argumentkey[$index][0] ? $argumentkey[$index][0] :"没有填写";
                        }else{
                            $reStr .= $index;
                        }
                    }
                    $_SESSION['j_securitycode_key'] = $index;
                    $isComplete = 1;
                    break;
                }
            }
            pdo_update('j_securitycode_code', array('argument' => urldecode(json_encode($anwserAry))), array('id' => $item['id']));
            if(!$isComplete){
                pdo_update('j_securitycode_code', array('questionuse' => 1), array('id' => $item['id']));
                $reStr = $reply['content'];
                $this -> endContext();
                if($reply['scantimevent']){
                    $userScanTime = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_securitycode_code') . " WHERE from_user=:from_user and pcate=:pcate and endtime>0 ", array(':from_user' => $openid, ':pcate' => $pcate));
                    if($userScanTime >= $reply['scantimevent']){
                        if($userScanTime % $reply['scantimevent'] == 0){
                            $reStr = $reply['content4'];
                        }
                    }
                }
                unset($_SESSION['j_securitycode_pcate']);
                unset($_SESSION['j_securitycode_codeid']);
                unset($_SESSION['j_securitycode_key']);
                unset($_SESSION['j_securitycode_qrcode']);
                goto end;
            }
            $_SESSION['j_securitycode_pcate'] = $reply['id'];
            $_SESSION['j_securitycode_codeid'] = $item['id'];
            $_SESSION['j_securitycode_time'] = TIMESTAMP;
            $this -> refreshContext(120);
            $reStr = str_replace("<br>", "\n", $reStr);
            return $this -> respText($reStr);
        }else{
            if(isset($_SESSION['j_securitycode_pcate']))unset($_SESSION['j_securitycode_pcate']);
            if(isset($_SESSION['j_securitycode_codeid']))unset($_SESSION['j_securitycode_codeid']);
            if(isset($_SESSION['j_securitycode_key']))unset($_SESSION['j_securitycode_key']);
            if(isset($_SESSION['j_securitycode_qrcode']))unset($_SESSION['j_securitycode_qrcode']);
            $event = $this -> message['event'];
            if($event == 'scancode_waitmsg'){
                $qrtype = $this -> message['scancodeinfo']['scantype'];
                $SecurityCode = $this -> message['scancodeinfo']['scanresult'];
                $strAry = explode("?", $SecurityCode);
                if(count($strAry) != 2 || empty($strAry[1]))return $this -> respText("格式错误哦");
                $jcode = $strAry[1];
                $QrCode = $this -> encrypt($strAry[1], 'D', $_scode);
                $tempAry = explode("|#|", $QrCode);
                if(count($tempAry) != 2)return $this -> respText("格式错误哦");
                $pcate = intval($tempAry[0]);
                $code = $tempAry[1];
            }elseif($event == 'SCAN' || $event == 'subscribe'){
                $pcate = pdo_fetchcolumn("SELECT gid FROM " . tablename('j_securitycode_reply') . " WHERE rid=:rid ", array(':rid' => $rid));
                $code = $this -> message['scene'];
                if(strpos($code, "|#|")){
                    $temp = explode('|#|', $code);
                    $pcate = $temp[0];
                    $code = $temp[1];
                    if(!is_numeric($code))$code = $pcate . "|#|" . $code;
                }
                if(substr_count($a, '|#|') < 2){
                    $QrCode = $pcate . "|#|" . $code;
                }
            }
            start: $reply = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_category') . " WHERE id=:id ", array(':id' => $pcate));
            if($reply['status'] == 0 || !$reply)return $this -> respText("活动已经结束了哦。");
            if(TIMESTAMP < $reply['starttime'])return $this -> respText("活动还没有开始哦~请【" . date("Y-m-d H:i", $reply['starttime']) . "】再来哦");
            if(TIMESTAMP > $reply['endtime'])return $this -> respText("活动已经结束了哦。");
            $item = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_code') . " WHERE code=:code and pcate=:pcate", array(':code' => $code, ':pcate' => $pcate));
            if(empty($item))return $this -> respText("防伪码不存在或者未启用");
            load() -> model('mc');
            $profile = mc_fansinfo($openid);
            $userInfo = array('nickname' => $profile['nickname'] ? $profile['nickname'] :$profile['tag']['nickname'], 'headimgurl' => $profile['tag']['avatar'],);
            if(!$userInfo['nickname']){
                $user = $this -> _getFansInfo($openid);
                $userInfo['nickname'] = $user['nickname'];
                $userInfo['headimgurl'] = $user['headimgurl'];
            }
            $uid = mc_openid2uid($openid);
            if(!$uid)$uid = mc_update($openid, array('nickname' => $userInfo['nickname']));
            if($reply['grouptype']){
                $temp_ary = array();
                $grouplist = pdo_fetchall("SELECT * FROM " . tablename("mc_groups") . " WHERE groupid in(" . $reply['grouptype'] . ") ''  ORDER BY `orderlist` asc");
                foreach($grouplist as $row){
                    array_push($temp_ary, $row['title']);
                }
                $u_groupid = mc_fetch($openid, "groupid");
                if(!in_array($u_groupid, $temp_ary))return $this -> respText("抱歉，本次活动仅开放给" . implode(",", $temp_ary) . "。您的等级不足");
            }
            if($reply['gametype']){
                $is_inlist = pdo_fetchcolumn("SELECT count(*) FROM " . tablename("j_securitycode_joiner") . " WHERE from_user='" . $openid . "' and pcate=:pcate ", array(':pcate' => $pcate));
                if(!$is_inlist)return $this -> respText("抱歉，本次活动仅对内部会员开放!");
            }
            $reStr = "";
            $userScanTime = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_securitycode_code') . " WHERE from_user=:from_user and pcate=:pcate and endtime>0 ", array(':from_user' => $openid, ':pcate' => $pcate));
            if($reply['jointime'] && $userScanTime >= $reply['jointime'] && $item['scantime'] < 1){
                $reStr = $reply['content5']?$reply['content5']:"抱歉，每人最多可使用" . $reply['jointime'] . "个码，您已超出使用数量。";
                goto end;
            }
            if($reply['playtype']){
                if(!$reply['argument'])return $this -> respText("内容没有设置");
                $argument = json_decode($reply['argument'], true);
                $userargument = @json_decode($item['argument'], true);
                $argumentkey = @json_decode($item['argumentkey'], true);
                if(!$item['from_user']){
                    $islimit = pdo_fetch("SELECT * FROM " . tablename('j_securitycode_limit') . " WHERE from_user=:from_user and codeid=:codeid order by id desc", array(':from_user' => $openid, ':codeid' => $item['id']));
                    if(TIMESTAMP - $islimit['endtime'] < 180){
                        $reStr = $islimit['log'] . "限制剩余时间" . (180 - (TIMESTAMP - $islimit['endtime'])) . "秒";
                        return $this -> respText($reStr);
                    }
                    $data = array('from_user' => $openid, 'scantime' => $item['scantime'] + 1, 'nickname' => $userInfo['nickname'], 'headimgurl' => $userInfo['headimgurl'], 'endtime' => TIMESTAMP,);
                    pdo_update('j_securitycode_code', $data, array('id' => $item['id']));
                    $this -> beginContext(120);
                    $reStr = $reply['welcome'] ? $reply['welcome'] . "\n" : "感谢您扫描本二维码，回答问题后将可获得相应奖励\n";
                }else{
                    if($item['questionuse']){
                        if($item['from_user'] != $openid){
                            $reStr = $reply['content3'];
                        }else{
                            $reStr = $reply['content2'];
                        }
                        goto end;
                    }else{
                        if($item['from_user'] != $openid){
                            if($reply['playtype'] == 2){
                                if(TIMESTAMP - $item['endtime'] >= $reply['replytime'] * 60 && $reply['replytime'] && !$item['questionuse']){
                                    $data = array('from_user' => '', 'scantime' => 0, 'nickname' => '', 'headimgurl' => '', 'argument' => '', 'endtime' => 0,);
                                    pdo_update('j_securitycode_code', $data, array('id' => $item['id']));
                                    goto start;
                                }
                            }
                            $reStr = $reply['content3'];
                            goto end;
                        }
                    }
                }
                $reStr = str_replace("|#昵称#|", $userInfo['nickname'], $reStr);
                $isComplete = 0;
                foreach($argument as $index => $row){
                    if($userargument[$index]){
                        continue;
                    }else{
                        if($reply['playtype'] == 2){
                            if(!$row){
                                $reStr .= $argumentkey[$index][0] ? $argumentkey[$index][0] :"没有填写";
                            }else{
                                $reStr .= $index;
                            }
                        }else{
                            $reStr .= $row;
                        }
                        $_SESSION['j_securitycode_key'] = $index;
                        $isComplete = 1;
                        break;
                    }
                }
                if(!$isComplete){
                    $reStr = $reply['content2'];
                    goto end;
                }
                $_SESSION['j_securitycode_time'] = TIMESTAMP;
                $_SESSION['j_securitycode_pcate'] = $reply['id'];
                $_SESSION['j_securitycode_codeid'] = $item['id'];
                $_SESSION['j_securitycode_qrcode'] = $QrCode;
                $reStr = str_replace("<br>", "\n", $reStr);
                $this -> beginContext(120);
                return $this -> respText($reStr);
            }
            $data = array('from_user' => $openid, 'scantime' => $item['scantime'] + 1, 'endtime' => TIMESTAMP,);
            if(!$item['from_user']){
                $data['nickname'] = $userInfo['nickname'];
                $data['headimgurl'] = $userInfo['headimgurl'];
                $reStr = $reply['content'];
                $userScanTime++;
                if($reply['collecttype'] && $item['qrtype']){
                    if($reply['collectorder']){
                        $hadcollect = pdo_fetchall("SELECT qrtype FROM " . tablename('j_securitycode_code') . " WHERE from_user=:from_user and pcate=:pcate and endtime>0 and collect=0 order by endtime asc", array(':from_user' => $openid, ':pcate' => $pcate));
                        $hasCollectlist = array();
                        $collectId = array();
                        if(empty($hadcollect)){
                            $hasCollectlist[] = $item['qrtype'];
                        }else{
                            foreach($hadcollect as $row){
                                $hasCollectlist[] = $row['qrtype'];
                            }
                            if(in_array($item['qrtype'], $hasCollectlist)){
                                return $this -> respText("您已经收集过【" . $item['qrtype'] . "】的二维码了哦，本次扫描无效哦");
                            }else{
                                $hasCollectlist[] = $item['qrtype'];
                            }
                        }
                        $needCollect = strpos($reply['collectorder'], ",")? explode(",", $reply['collectorder']): array($reply['collectorder']);
                        if($reply['collecttype'] == 1){
                            $leftCollect = array_diff($needCollect, $hasCollectlist);
                            if(count($leftCollect) == 0){
                                $reStr = $reply['content4'];
                                pdo_update('j_securitycode_code', array('collect' => 1), array('id' => $item['id']));
                                pdo_run('update ' . tablename('j_securitycode_code') . ' set collect=1 where from_user=\'' . $openid . "' and pcate='" . $pcate . "' and endtime>0");
                            }
                        }elseif($reply['collecttype'] == 2){
                            $hasCollectlist2 = array_diff($hasCollectlist, array($item['qrtype']));
                            $leftCollect = array_values(array_diff($needCollect, $hasCollectlist2));
                            if(count($leftCollect) == 0)return $this -> respText("每人只能集一次哦");
                            if($leftCollect[0] == $item['qrtype']){
                                if(count($leftCollect) == 1){
                                    $reStr = $reply['content4'];
                                    pdo_update('j_securitycode_code', array('collect' => 1), array('id' => $item['id']));
                                    pdo_run('update ' . tablename('j_securitycode_code') . ' set collect=1 where from_user=\'' . $openid . "' and pcate='" . $pcate . "' and endtime>0 ");
                                }
                            }else{
                                return $this -> respText("收集的码不正确哦，你需要收集的码是【" . $leftCollect[0] . "】，本码是【" . $item['qrtype'] . "】");
                            }
                        }
                    }
                }else{
                    if($reply['scantimevent'] && $userScanTime >= $reply['scantimevent']){
                        if($userScanTime > $reply['scantimevent']){
                            if($userScanTime % $reply['scantimevent'] == 0){
                                $reStr = $reply['content4'];
                            }
                        }else{
                            $reStr = $reply['content4'];
                        }
                    }
                }
            }else{
                unset($data['from_user']);
                if($item['from_user'] == $openid){
                    if(!$data['endtime']){
                        $reStr = $reply['content'];
                        $userScanTime++;
                        if($reply['scantimevent'] && $userScanTime >= $reply['scantimevent']){
                            if($userScanTime > $reply['scantimevent']){
                                if($userScanTime % $reply['scantimevent'] == 0){
                                    $reStr = $reply['content4'];
                                }
                            }else{
                                $reStr = $reply['content4'];
                            }
                        }
                    }else{
                        $reStr = $reply['content2'];
                    }
                }else{
                    unset($data['endtime']);
                    unset($data['nickname']);
                    unset($data['headimgurl']);
                    $reStr = $reply['content3'];
                }
            }
            pdo_update('j_securitycode_code', $data, array('id' => $item['id']));
        }
        end: $parama = explode("|#|", $reply['parama']);
        $para = explode("|#|", $item['parama']);
        for($i = 0;$i < count($parama);$i++){
            $reStr = str_replace("|#" . $parama[$i] . "#|", $para[$i], $reStr);
        }
        $linkwork = $reply['urlword']?$reply['urlword']:"点击这里";
        $sendcode = $this -> encrypt($QrCode . "|#|" . $openid, "E", $_scode);;
        $reStr = str_replace("|#跳转链接#|", '<a href="' . $reply['url'] . '&jcode=' . urlencode(base64_encode($sendcode)) . '">' . $linkwork . '</a>', $reStr);
        $reStr = str_replace("|#扫码数量#|", $userScanTime, $reStr);
        $reStr = str_replace("|#码类别#|", $item['qrtype'], $reStr);
        if($reply['collecttype'] && !$reply['playtype']){
            $reStr = str_replace("|#需要收集码#|", $reply['collectorder'], $reStr);
            $needCollect = strpos($reply['collectorder'], ",")? explode(",", $reply['collectorder']): array($reply['collectorder']);
            $hadcollect = pdo_fetchall("SELECT qrtype FROM " . tablename('j_securitycode_code') . " WHERE from_user=:from_user and pcate=:pcate and endtime>0 and collect=0 order by endtime asc", array(':from_user' => $openid, ':pcate' => $pcate));
            $hasCollectlist = array();
            foreach($hadcollect as $row){
                $hasCollectlist[] = $row['qrtype'];
            }
            $leftCollectlist = array_diff($needCollect, $hasCollectlist);
            $reStr = str_replace("|#未收集码#|", implode(',', $leftCollectlist), $reStr);
            $reStr = str_replace("|#已收集码#|", implode(',', $hasCollectlist), $reStr);
        }
        $lefttime = 0;
        if($userScanTime % $reply['scantimevent'] > 0){
            $lefttime = $reply['scantimevent'] - ($userScanTime % $reply['scantimevent']);
        }
        $reStr = str_replace("|#剩余码数#|", $lefttime, $reStr);
        $reStr = str_replace("|#昵称#|", $userInfo['nickname'], $reStr);
        $reStr = str_replace("|#持有人昵称#|", $item['nickname'], $reStr);
        $reStr = str_replace("|#查询次数#|", ($item['scantime'] + 1), $reStr);
        $reStr = str_replace("<br>", "\n", $reStr);
        $rule = "/\|#红包\d*#\|/";
        preg_match($rule, $reStr, $result);
        if($result[0]){
            $reStr = str_replace($result[0], "", $reStr);
            $packid = str_replace("#|", "", str_replace("|#红包", "", $result[0]));
            if(is_numeric($packid)){
                $resulut = $this -> _sendpack($openid, $pcate, $item['id'], $packid);
                $times = date("H", TIMESTAMP);
                if($times > 23 || $times < 8){
                    $reStr .= "\n红包只能在每天8点后，23点前领取哦。";
                }else{
                    if($resulut == 0)$reStr .= "\n红包已经抢光了哦";
                    if($resulut < 0)$reStr .= "\n红包领取有问题哦~请联系管理员重新领取哦";
                }
            }
        }
        if(!$item['completed'] && $item['fee']){
            $resulut = $this -> _sendpack($openid, $pcate, $item['id']);
            $times = date("H", TIMESTAMP);
            if($times > 23 || $times < 8){
                $reStr .= "\n红包只能在每天8点后，23点前领取哦。";
            }else{
                if($resulut == 0)$reStr .= "\n红包已经抢光了哦";
                if($resulut < 0)$reStr .= "\n红包领取有问题哦~请联系管理员重新领取哦";
            }
        }
        if(strpos($reStr, "|#发积分#|")){
            $reStr = str_replace("|#发积分#|", "", $reStr);
            if($reply['credits'])mc_credit_update($uid, "credit1", $reply['credits'], array(0, '【防伪抽奖码】积分奖励'));
        }
        if($reply['wxcard']){
            $_temp = explode("|##|", $reply['wxcard']);
            $_wxcardKey = explode("|#|", $_temp[0]);
            $_wxcardVal = explode("|#|", $_temp[1]);
            for($i = 0;$i < count($_wxcardKey);$i++){
                if(strpos($reStr, "|#" . $_wxcardKey[$i] . "#|")){
                    $reStr = str_replace("|#" . $_wxcardKey[$i] . "#|", "", $reStr);
                    $this -> sendCard($openid, $_wxcardVal[$i]);
                }
            }
        }
        return $this -> respText($reStr);
    }
    private function sendText($openid, $txt){
        global $_W;
        $acid = $_W['account']['acid'];
        if(!$acid){
            $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
        }
        $acc = WeAccount :: create($acid);
        $data = $acc -> sendCustomNotice(array('touser' => $openid, 'msgtype' => 'text', 'text' => array('content' => urlencode($txt))));
        return $data;
    }
    public function sendCard($openid, $cardid){
        global $_W;
        if(strlen($cardid) < 5)return;
        $acid = $_W['account']['acid'];
        if(!$acid){
            $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
        }
        $acc = WeAccount :: create($acid);
        $ticket = $this -> getCard();
        $pars['nonce_str'] = random(32);
        $pars['code'] = "";
        $pars['openid'] = $openid;
        $pars['timestamp'] = TIMESTAMP;
        $pars['signature'] = "";
        $string1 = $pars['timestamp'] . $pars['nonce_str'] . $pars['code'] . $ticket . $cardid;
        $pars['signature'] = sha1($string1);
        $sendata = array("card_id" => $cardid, "card_ext" => array("code" => $pars['code'], "openid" => $pars['openid'], "timestamp" => $pars['timestamp'], "signature" => $pars['signature'],));
        $data = $acc -> sendCustomNotice(array('touser' => $openid, 'msgtype' => 'wxcard', 'wxcard' => $sendata));
        return $data;
    }
    public function getCard(){
        global $_W;
        load() -> func('cache');
        $wxcard = cache_load("wxcard");
        if(!$wxcard || $wxcard['extime'] < TIMESTAMP){
            load() -> func('communication');
            $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
            $acc = WeAccount :: create($acid);
            $tokens = $acc -> fetch_token();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $tokens . "&type=wx_card";
            $content = ihttp_get($url);
            if(is_error($content))return false;
            $token = @json_decode($content['content'], true);
            if(empty($token) || !is_array($token)){
                $errorinfo = substr($content['meta'], strpos($content['meta'], '{'));
                $errorinfo = @json_decode($errorinfo, true);
                return false;
            }
            $record = array();
            $record['ticket'] = $token['ticket'];
            $record['expire'] = TIMESTAMP + $token['expires_in'];
            cache_write('wxcard', array('ticket' => $record['ticket'], "expire" => $record['expire']));
            return $record['ticket'];
        }
        return $wxcard['ticket'];
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
    private function _getFansInfo($_openid){
        global $_W;
        if(!$_openid)return false;
        load() -> func('communication');
        $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
        $acc = WeAccount :: create($acid);
        $tokens = $acc -> fetch_token();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $tokens . "&openid=" . $_openid;
        $content = ihttp_get($url);
        if(is_error($content))return false;
        $token = @json_decode($content['content'], true);
        if(empty($token) || !is_array($token)){
            $errorinfo = substr($content['meta'], strpos($content['meta'], '{'));
            $errorinfo = @json_decode($errorinfo, true);
            return false;
        }
        return $token;
    }
    public function _sendpack($_openid, $id = 0, $codeid = 0, $packid = 0){
        global $_W;
        $reply = pdo_fetch('select * from ' . tablename('j_securitycode_category') . ' where id=:id and weid=:weid ', array(':id' => $id, ':weid' => $_W['uniacid']));
        $redpack = pdo_fetch('select * from ' . tablename('j_securitycode_redpack') . ' where id=:id and weid=:weid ', array(':id' => $packid, ':weid' => $_W['uniacid']));
        if($redpack['remainfee'] < 100 || !$redpack['remainfee'])return 0;
        $item = pdo_fetch('select * from ' . tablename('j_securitycode_code') . ' where id=:id ', array(':id' => $codeid));
        if(empty($_openid) || empty($redpack) || !$packid)return false;
        $min = $redpack['firstmin'] >= 100 ? $redpack['firstmin'] : 100;
        $man = $redpack['firstmax'] >= 100 ? $redpack['firstmax'] : 100;
        if($man < $min)$man = $min;
        $feeRand = $man == $min ? $man : mt_rand($min, $man);
        $fee = $item['fee'] ? $item['fee'] : $feeRand;
        if($redpack['remainfee'] > 100 && $fee){
            if($fee > $redpack['remainfee'])$fee = $redpack['remainfee'];
            pdo_update('j_securitycode_redpack', array('remainfee' => $redpack['remainfee'] - $fee), array('id' => $packid));
            if($redpack['remainfee'] <= $redpack['alertfee']){
                $alertuser = @explode(",", $redpack['alertuser']);
                $remainfee = sprintf('%.2f', $redpack['remainfee'] / 100);
                foreach($alertuser as $row){
                    @$this -> sendText($alertuser, "《" . $redpack['title'] . "》的红包金额余额剩余" . $remainfee . "元，请注意处理。");
                }
            }
        }else{
            return 0;
        }
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
        $extras['CURLOPT_CAINFO'] = IA_ROOT . '/attachment/j_securitycode/cert_2/' . $packid . '/rootca.pem';
        $extras['CURLOPT_SSLCERT'] = IA_ROOT . '/attachment/j_securitycode/cert_2/' . $packid . '/apiclient_cert.pem';
        $extras['CURLOPT_SSLKEY'] = IA_ROOT . '/attachment/j_securitycode/cert_2/' . $packid . '/apiclient_key.pem';
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
        $rec['fee'] = $fee;
        $rec['completed'] = $procResult['errno'] != 0 ? $procResult['errno'] :1;
        pdo_update('j_securitycode_code', $rec, array('id' => $codeid));
        return $procResult;
    }
}
