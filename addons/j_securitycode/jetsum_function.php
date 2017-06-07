<?php
/*
获取公众号TOKEN
*/
function jetsum_fetch_token($appids="",$secrets="") {
	global $_W;
	load()->func('communication');
	$Jetsum_token="";
	$appid=$appids;
	$secret=$secrets;
	if(!$appid || !$secret){
		$account=pdo_fetch("SELECT * FROM ".tablename('account_wechats')." WHERE uniacid = :uniacid",array(':uniacid'=>$_W['uniacid']));
		$acccount_acc=iunserializer($account['access_token']);
		if(is_array($acccount_acc) && !empty($acccount_acc['token']) && !empty($acccount_acc['expire']) && $acccount_acc['expire'] > TIMESTAMP) {
			return $acccount_acc['token'];
		}
		$appid=$account['key'];
		$secret=$account['secret'];
		if(!$appid || !$secret)return false;
	}
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
	$content = ihttp_get($url);
	if(is_error($content))return false;
	$token = @json_decode($content['content'], true);
	if(empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['expires_in'])) {
		$errorinfo = substr($content['meta'], strpos($content['meta'], '{'));
		$errorinfo = @json_decode($errorinfo, true);
		return false;
	}
	$record = array();
	$record['token'] = $token['access_token'];
	$record['expire'] = TIMESTAMP + $token['expires_in'];
	$row = array();
	$row['access_token'] = iserializer($record);
	if(!$appids || !$secrets){
		pdo_update('account_wechats', $row, array('acid' => $_W['account']['acid']));
	}
	return $record['token'];
}
/***
加密函数
$str = 'abc'; 
$key = 'www.helloweba.com'; 
echo '加密:'.encrypt($str, 'E', $key); 
echo '解密：'.encrypt($str, 'D', $key);
 */
function encrypt($string,$operation,$key=''){ 
    $key=md5($key); 
    $key_length=strlen($key); 
      $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string; 
    $string_length=strlen($string); 
    $rndkey=$box=array(); 
    $result=''; 
    for($i=0;$i<=255;$i++){ 
           $rndkey[$i]=ord($key[$i%$key_length]); 
        $box[$i]=$i; 
    } 
    for($j=$i=0;$i<256;$i++){ 
        $j=($j+$box[$i]+$rndkey[$i])%256; 
        $tmp=$box[$i]; 
        $box[$i]=$box[$j]; 
        $box[$j]=$tmp; 
    } 
    for($a=$j=$i=0;$i<$string_length;$i++){ 
        $a=($a+1)%256; 
        $j=($j+$box[$a])%256; 
        $tmp=$box[$a]; 
        $box[$a]=$box[$j]; 
        $box[$j]=$tmp; 
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256])); 
    } 
    if($operation=='D'){ 
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){ 
            return substr($result,8); 
        }else{ 
            return''; 
        } 
    }else{ 
        return str_replace('=','',base64_encode($result)); 
    }
}
/*
获取用户信息
*/
function jetsum_member_fetch($openids=""){
	global $_W;
	$openid=$openids ? $openids : $_W['openid'];
	if($openid)return false;
	load()->model('mc');
	$uid=mc_openid2uid($openid);
	$profile=mc_fetch($uid);
	if($profile['avatar'])return $profile;
	//用户资料不存在，生成；
	$fans=mc_fansinfo($openid);
	$p=jetsum_oauth_info();
	$avatar=$p['headimgurl'];
	$nickname=$p['nickname'];
	$gender=$p['gender'];
	$unionid=$p['unionid'];
	$data=array(
		'uniacid'=>$_W['uniacid'],
		'createtime'=>TIMESTAMP,
		'nickname'=>$nickname,
		'avatar'=>$avatar,
		'gender'=>$gender,
		'salt'=>$profile['salt'],
		'lookingfor'=>$_W['openid'],
	);
	pdo_insert('mc_members',$data);
	$uid = pdo_insertid();
	$insert=array('uid'=>$uid);
	if($unionid && pdo_fieldexists('mc_mapping_fans', 'unionid') && !$fans['unionid']){
		$insert['unionid']=$unionid;
	}
	pdo_update('mc_mapping_fans',$insert,array('fanid'=>$fans['fanid']));
	return $data;
}
/*
获取粉丝信息
*/
function jetsum_oauth_info($openids=""){
	global $_W;
	$openid=$openids ? $openids : $_W['openid'];
	load()->func('communication');
	$token=jetsum_fetch_token();
	$oauth3_code = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$openid;
	$content = ihttp_get ( $oauth3_code );
	$info = @json_decode($content['content'], true);
	return $$info;
}
/*
获取联动OPENID
*/
function jetsum_getByUnionid($unionid=""){
	global $_W;
	if(!$unionid || !pdo_fieldexists('mc_mapping_fans', 'unionid'))return false;
	$openid=pdo_fetchcolumn("SELECT openid FROM ".tablename('mc_mapping_fans')." WHERE uniacid = '{$_W['uniacid']}' and unionid='".$unionid."'");
	if(!$openid){
		return false;
	}else{
		return $openid;
	}
}
/**
* 发送客服消息
* $access_token= account_weixin_token($_W['account']);
* 当用户接到到一条模板消息，会给公共平台api发送一个xml文件【待处理】
*/	
function _sendtext($openid,$txt){
	global $_W;
	$acid=$_W['account']['acid'];
	if(!$acid){
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	}
	$acc = WeAccount::create($acid);
	$data = $acc->sendCustomNotice(array('touser'=>$openid,'msgtype'=>'text','text'=>array('content'=>urlencode($txt))));
	return $data;
}
/**
* 处理key=>value形式的数据
* 返回A:B<br>形式的字符串
*/	
function _dealArray($ary=array()){
	if(!is_array($ary))return $ary;
	$temp=array();
	foreach($ary as $key=>$val){
		$temp[]=$key."：".$val[0]."：".$val[1];
	}
	return implode("<br>",$temp);
}
?>