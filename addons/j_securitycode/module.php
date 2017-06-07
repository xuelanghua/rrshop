<?php
/**
 * 捷讯防伪码模块定义
 *
 * @author 捷讯设计
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
include('../addons/j_securitycode/copyright.php');
class J_securitycodeModule extends WeModule {
	public function fieldsFormDisplay($rid = 0) {
		//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
		global $_W, $_GPC;
		$reply = pdo_fetch("SELECT * FROM ".tablename('j_securitycode_reply')." WHERE rid = :rid", array(':rid' => $rid));
		load()->func('tpl');
		$list = pdo_fetchall("SELECT id,title FROM ".tablename('j_securitycode_category')." WHERE weid = :weid order by id desc", array(':weid' => $_W['uniacid']));
		include $this->template('form');
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
		return '';
	}

	public function fieldsFormSubmit($rid) {
		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
		global $_W, $_GPC;
		$id = intval($_GPC['reply_id']);
		if(!intval($_GPC['gid']))message("编号不能为空");
		$insert = array(
			'rid' => $rid,
			'gid' => $_GPC['gid'],
			'weid'=> $_W['uniacid'],
			'cover' => $_GPC['cover'],
			'title' => $_GPC['title'],
			'description' => $_GPC['description'],
		);
		if (empty($id)) {
			$insert['status']=1;
			pdo_insert('j_securitycode_reply', $insert);
		} else {
			pdo_update('j_securitycode_reply', $insert, array('id' => $id));
		}
	}

	public function ruleDeleted($rid) {
		//删除规则时调用，这里 $rid 为对应的规则编号
		load()->func('file');
		pdo_delete('j_securitycode_reply', array('id'=>$rid));
		return true;
	}

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			$this->saveSettings($dat);
		}
		//
		$__copy=setCopyRight();
		$code2=urlencode($__copy['_UserIdCode']);
		if(!$code2)die("没有授权文件，请与管理者联系");
		$code="aHR0cDovL2Ntcy55ZmpzLWRlc2lnbi5jb20vYXBwL2luZGV4LnBocD9pPTEmYz1lbnRyeSZkbz12ZXJzaW9uJm09al9jb3B5cmlnaHQ=";
		load()->func('communication');
		$postUrl=base64_decode($code)."&url=".urlencode($_W['siteroot'])."&user=".$code2;
		$post=ihttp_get($postUrl);
		$result = @json_decode($post['content'], true);
		$_version=pdo_fetchcolumn("select version from ".tablename('modules')." WHERE name= 'j_securitycode'");
		$showResult=0;
		if($result){
			if($result>$_version){
				$showResult=1;
			}
		}
		//$version=
		//这里来展示设置项表单
		include $this->template('setting');
	}

}