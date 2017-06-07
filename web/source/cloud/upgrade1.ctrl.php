<?php 
/**
 * [WEIZAN System] Copyright (c) 2014 WEIZANCMS.COM
 
 */
load()->model('cloud');
load()->func('communication');
$r = cloud_prepare();
if(is_error($r)) {
	message($r['message'], url('cloud/profile'), 'error');
}
$dos = array('upgrade','update','bak');
$do = in_array($do, $dos) ? $do : 'upgrade';
if ($do == 'bak') {
	$mdir=IA_ROOT .'/data/systembak/';
	if(!is_dir($mdir)){
		message('没有可回滚的系统版本，或者上次更新没有修改文件，无需回滚！');
	}
	$bak = 0;
	foreach(scandir($mdir) as $temp){
		if($temp=='.'||$temp=='..'){
			continue;
		} 
		if((int)$temp > $bak){
			$bak=$temp;
		}
	}
	if(!$bak){
		message('没有可回滚的系统版本，或者上次更新没有修改文件，无需回滚！');
	}
	$zip = new ZipArchive();
	$zip->open($mdir.'/'.$bak);
	$zip->extractTo(IA_ROOT);
	$zip->close();
	@unlink($mdir.'/'.$bak);
	message('成功将系统回滚至上一次更新前的版本！');
}
cache_load('dat');
if(!empty($_W['cache']['dat'])) {
	$dat = $_W['cache']['dat'];
}
if(empty($dat) ||  TIMESTAMP - $dat['lastupdate'] >= 3600 * 24 || 1) {
    $pars = array();
    $pars['host'] = $_SERVER['HTTP_HOST'];
    $pars['family'] = IMS_FAMILY;
    $pars['version'] = IMS_VERSION;
    $pars['release'] = IMS_RELEASE_DATE;
    $pars['key'] = $_W['setting']['site']['key'];
    $pars['password'] = md5($_W['setting']['site']['key'] . $_W['setting']['site']['token']);
    $pars['method'] = 'application1.build';
    $dat1 = cloud_request(ADDONS_URL.'/gateway.php', $pars);
    $dat = unserialize(base64_decode($dat1['content']));
    if($dat['state']){
	    message($dat['content']);
    }
	if(empty($dat) || empty($dat1['content'])){
		message('没有收到服务器传输的数据！');
	}
    if($dat['family'] == 'x' && IMS_FAMILY == 'v') {
	    load()->model('setting');
	    setting_upgrade_version('x', IMS_VERSION, IMS_RELEASE_DATE);
	    message('您已注册了服务会员, 系统将转换为会员版, 并重新运行自动更新程序.', 'refresh');
    }
    
    $dat['rfiles']=$schemas=$files=$sqls= array();
    if(!empty($dat['files'])) {
	    foreach($dat['files'] as $file) {
	    	$entry = IA_ROOT . $file['path'];
	    	if(!is_file($entry) || md5_file($entry) != $file['checksum']) {
	    		$files[] = $file['path'];
				$dat['rfiles'][]=$file;
	    	}
	    }
    }
    $dat['files']=$files;
    if(!empty($dat['schemas'])) {
	    load()->func('db');
	    foreach($dat['schemas'] as $remote) {
	        $name = substr($remote['tablename'], 4);
		    $local = db_table_schema(pdo(), $name);
	        unset($remote['increment']);
	        unset($local['increment']);
	        if(empty($local)) {
		        $schemas[] = $remote;
		        $sql = db_table_fix_sql($local, $remote);
		        $sqls=array_merge($sqls,$sql);
	        } 
	        else {
		        $sql = db_table_fix_sql($local, $remote);
		        if(!empty($sql)) {
			        $sqls=array_merge($sqls,$sql);
			        $schemas[] = $remote;
		        }
	        }
        }
    }
    $dat['schemas']=$schemas;
    $dat['sqls'] = $sqls;
	if(!empty($dat['files']) || !empty($dat['schemas'])) {
	    $dat['upgrade'] = true;
    }
    $dat['lastupdate']=TIMESTAMP;
    cache_write('dat',$dat);
}
if($do == 'update'){
	//更新文件
	if(!empty($dat['files'])){
		if(!is_dir(IA_ROOT .'/data/systembak')){
			load()->func('file');
			mkdirs(IA_ROOT .'/data/systembak');
		}
		$bak=IA_ROOT .'/data/systembak/'.time();
		$zip= new ZipArchive();
	    $zip->open($bak, ZipArchive::CREATE);
		foreach($dat['files'] as $file){
			if(is_file(IA_ROOT .$file)){
				$zip->addFile(IA_ROOT .$file,$file);
			}
		}
		$zip->close();
		$pars['files']=base64_encode(json_encode($dat['files']));
	    $pars['method'] = 'application1.get';
	    $data = cloud_request(ADDONS_URL.'/gateway.php', $pars);
	    if(empty($data)){
		    message('网络传输错误！');
	    }
	    $data=unserialize(base64_decode($data['content']));
	    if($data['state']){
		    message($data['content']);
	    }
		$files=$data['content'];
		$temp=IA_ROOT . '/data/temp.zip';
		file_put_contents($temp,$files);
		$zip = new ZipArchive();
		$zip->open($temp);
		$zip->extractTo(IA_ROOT);
		$zip->close();
		@unlink($temp);
	}
	//更新数据库
	if(!empty($dat['sqls'])){
	    foreach($dat['sqls'] as $sql){
			pdo_run($sql);
		}
	}
	//检查是否更新成功
	foreach($dat['rfiles'] as $file) {
		$entry = IA_ROOT . $file['path'];
		if(!is_file($entry) || md5_file($entry) != $file['checksum']) {
			$failedfiles[] = $file['path'];
		}
	}
	cache_write('dat','');
	if(empty($failedfiles)){
		message('更新成功！',url('system/welcome'));
	}
}
if($do == 'upgrade') {
    $_W['page']['title'] = '一键更新 - 云服务';
	if(!$dat['upgrade']){
		message('检查结果: 恭喜, 你的程序已经是最新版本！',url('system/welcome'));
	}
	if(checksubmit('submit')) {
		if($dat['upgrade']) {
			message("检测到新版本: <strong>{$dat['version']} (Release {$dat['release']})</strong>, 请立即更新.", 'refresh');
		}else {
			cache_delete('checkupgrade:system');
			message('检查结果: 恭喜, 你的程序已经是最新版本. ', 'refresh');
		}
	}
}
template('cloud/upgrade1');
