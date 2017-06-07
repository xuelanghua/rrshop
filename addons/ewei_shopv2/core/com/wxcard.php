<?php
if (!(defined('IN_IA'))) {
	exit('Access Denied');
}

class Wxcard_EweiShopV2ComModel extends ComModel
{
	protected function checkurl($url)
	{
		if (strexists($url, 'http://')) {
			$url = str_replace('http://', '', $url);
		}


		if (strexists($url, 'https://')) {
			$url = str_replace('https://', '', $url);
		}


		return $url;
	}

	protected function getUrl($do, $query = NULL)
	{
		$url = mobileUrl($do, $query, true);

		if (strexists($url, '/addons/ewei_shopv2/')) {
			$url = str_replace('/addons/ewei_shopv2/', '/', $url);
		}


		if (strexists($url, '/core/mobile/order/')) {
			$url = str_replace('/core/mobile/order/', '/', $url);
		}


		return $url;
	}

	/**
     * 微信卡券：上传LOGO
     */
	public function wxCardUpdateImg($url)
	{
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$data['buffer'] = '@' . $url;
		$url = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $data);
		return $jsoninfo;
	}

	/**
     * 微信卡券：获取颜色
     */
	public function wxCardColor()
	{
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/getcolors?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url);
		return $jsoninfo;
	}

	/**
     * 微信卡券：创建卡券,json拼写
     */
	public function createCard($params)
	{
		$card_type = $params['card_type'];
		$logo_url = $params['wxlogourl'];
		$brand_name = $params['brand_name'];
		$code_type = 'CODE_TYPE_NONE';
		$title = $params['title'];
		$color = $params['color'];
		$notice = $params['notice'];
		$service_phone = $params['service_phone'];
		$description = $params['description'];
		$type = $params['datetype'];

		if ($type == 'DATE_TYPE_FIX_TIME_RANGE') {
			$begin_timestamp = $params['begin_timestamp'];
			$end_timestamp = $params['end_timestamp'];
		}
		 else if ($type == 'DATE_TYPE_FIX_TERM') {
			$fixed_term = ((empty($params['fixed_term']) ? 0 : $params['fixed_term']));
			$fixed_begin_term = ((empty($params['fixed_begin_term']) ? 0 : $params['fixed_begin_term']));
		}


		$quantity = ((empty($params['quantity']) ? 100 : $params['quantity']));
		$use_limit = ((empty($params['use_limit']) ? 1 : $params['use_limit']));
		$get_limit = ((empty($params['get_limit']) ? 1 : $params['get_limit']));
		$use_custom_code = 'false';
		$bind_openid = 'false';
		$can_share = ((empty($params['can_share']) ? 'false' : 'true'));
		$can_give_friend = ((empty($params['can_give_friend']) ? 'false' : 'true'));
		$location_id_list = '';
		$center_title = $params['center_title'];
		$center_sub_title = $params['center_sub_title'];
		$center_url = $this->checkurl($params['center_url']);
		$setcustom = $params['setcustom'];

		if (!(empty($setcustom))) {
			$custom_url_name = $params['custom_url_name'];
			$custom_url_sub_title = $params['custom_url_sub_title'];
			$custom_url = $this->checkurl($params['custom_url']);
		}


		$setpromotion = $params['setpromotion'];

		if (!(empty($setpromotion))) {
			$promotion_url_name = $params['promotion_url_name'];
			$promotion_url_sub_title = $params['promotion_url_sub_title'];
			$promotion_url = $this->checkurl($params['promotion_url']);
		}


		$source = '';
		$can_use_with_other_discount = ((empty($params['can_use_with_other_discount']) ? 'false' : 'true'));
		$setabstract = $params['setabstract'];
		$abstract = $params['abstract'];
		$icon_url_list = $params['icon_url_list'];
		$text_image_list = $params['text_image_list'];
		$time_limit = '';

		if ($card_type == 'CASH') {
			$accept_category = $params['accept_category'];
			$reject_category = $params['reject_category'];
			$least_cost = ((empty($params['least_cost']) ? 0 : $params['least_cost']));
			$reduce_cost = ((empty($params['reduce_cost']) ? 0 : $params['reduce_cost']));
		}
		 else if ($card_type == 'DISCOUNT') {
			$discount = ((empty($params['discount']) ? 0 : $params['discount']));
		}
		 else {
			return false;
		}

		$jsonData = '{';
		$jsonData .= '"card":{';
		$jsonData .= '"card_type":"' . $card_type . '"';

		if ($card_type == 'CASH') {
			$jsonData .= ',"cash":{';
		}
		 else if ($card_type == 'DISCOUNT') {
			$jsonData .= ',"discount":{';
		}


		$jsonData .= '"base_info":{';
		$jsonData .= '"logo_url":"' . $logo_url . '"';
		$jsonData .= ',"brand_name":"' . $brand_name . '"';
		$jsonData .= ',"code_type":"' . $code_type . '"';
		$jsonData .= ',"title":"' . $title . '"';
		$jsonData .= ',"color":"' . $color . '"';
		$jsonData .= ',"notice":"' . $notice . '"';

		if (!(empty($service_phone))) {
			$jsonData .= ',"service_phone":"' . $service_phone . '"';
		}


		$jsonData .= ',"description":"' . $description . '"';
		$jsonData .= ',"date_info":{';

		if ($type == 'DATE_TYPE_FIX_TIME_RANGE') {
			$jsonData .= '"type":"DATE_TYPE_FIX_TIME_RANGE"';
			$jsonData .= ',"begin_timestamp":' . $begin_timestamp;
			$jsonData .= ',"end_timestamp":' . $end_timestamp;
		}
		 else if ($type == 'DATE_TYPE_FIX_TERM') {
			$jsonData .= '"type":"DATE_TYPE_FIX_TERM"';
			$jsonData .= ',"fixed_term":' . $fixed_term;
			$jsonData .= ',"fixed_begin_term":' . $fixed_begin_term;
		}


		$jsonData .= '}';
		$jsonData .= ',"sku":{"quantity":' . $quantity . '}';
		$jsonData .= ',"use_limit":' . $use_limit;
		$jsonData .= ',"get_limit":' . $get_limit;
		$jsonData .= ',"can_share":' . $can_share;
		$jsonData .= ',"can_give_friend":' . $can_give_friend;
		$jsonData .= ',"center_title":"' . $center_title . '"';
		$jsonData .= ',"center_sub_title":"' . $center_sub_title . '"';
		$jsonData .= ',"center_url":"' . $center_url . '"';

		if (!(empty($setcustom))) {
			$jsonData .= ',"custom_url_name":"' . $custom_url_name . '"';
			$jsonData .= ',"custom_url":"' . $custom_url . '"';
			$jsonData .= ',"custom_url_sub_title":"' . $custom_url_sub_title . '"';
		}


		if (!(empty($setpromotion))) {
			$jsonData .= ',"promotion_url_name":"' . $promotion_url_name . '"';
			$jsonData .= ',"promotion_url_sub_title":"' . $promotion_url_sub_title . '"';
			$jsonData .= ',"promotion_url":"' . $promotion_url . '"';
		}


		$jsonData .= '}';
		$jsonData .= ',"advanced_info":{';
		$jsonData .= '"use_condition":{';

		if (!(empty($accept_category))) {
			$jsonData .= '"accept_category":"' . $accept_category . '",';
		}


		if (!(empty($reject_category))) {
			$jsonData .= '"reject_category":"' . $reject_category . '",';
		}


		$jsonData .= '"can_use_with_other_discount":' . $can_use_with_other_discount;
		$jsonData .= '}';

		if (!(empty($setabstract))) {
			$jsonData .= ',"abstract":{';
			$jsonData .= '"abstract":"' . $abstract . '"';
			$jsonData .= ',"icon_url_list":["' . $icon_url_list . '"]';
			if (is_array($text_image_list) && !(empty($text_image_list))) {
				$jsonData .= ',"text_image_list":[';
				$listnum = 0;

				foreach ($text_image_list as $text_image ) {
					if (0 < $listnum) {
						$jsonData .= ',';
					}


					$jsonData .= '{';
					$jsonData .= '"image_url":"' . $text_image['image_url'] . '"';
					$jsonData .= ',"text":"' . $text_image['text'] . '"';
					$jsonData .= '}';
					++$listnum;
				}

				$jsonData .= ']';
			}


			$jsonData .= '}';
		}


		$jsonData .= '}';

		if ($card_type == 'CASH') {
			$jsonData .= ',"least_cost":"' . $least_cost . '"';
			$jsonData .= ',"reduce_cost":"' . $reduce_cost . '"';
		}
		 else if ($card_type == 'DISCOUNT') {
			$jsonData .= ',"discount":"' . $discount . '"';
		}


		$jsonData .= '}';
		$jsonData .= '}';
		$jsonData .= '}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/create?access_token=' . $token;
		$result = $this->wxHttpsRequest($url, $jsonData);
		return $result;
	}

	public function updateCard($params)
	{
		$card_id = $params['card_id'];
		$card_type = $params['card_type'];
		$logo_url = $params['wxlogourl'];
		$color = $params['color'];
		$notice = $params['notice'];
		$service_phone = $params['service_phone'];
		$description = $params['description'];
		$type = $params['datetype'];

		if ($type == 'DATE_TYPE_FIX_TIME_RANGE') {
			$begin_timestamp = $params['begin_timestamp'];
			$end_timestamp = $params['end_timestamp'];
		}


		$use_limit = ((empty($params['use_limit']) ? 1 : $params['use_limit']));
		$get_limit = ((empty($params['get_limit']) ? 1 : $params['get_limit']));
		$can_share = ((empty($params['can_share']) ? 'false' : 'true'));
		$can_give_friend = ((empty($params['can_give_friend']) ? 'false' : 'true'));
		$center_title = $params['center_title'];
		$center_sub_title = $params['center_sub_title'];
		$center_url = $params['center_url'];
		$setcustom = $params['setcustom'];

		if (!(empty($setcustom))) {
			$custom_url_name = $params['custom_url_name'];
			$custom_url_sub_title = $params['custom_url_sub_title'];
			$custom_url = $params['custom_url'];
		}


		$setpromotion = $params['setpromotion'];

		if (!(empty($setpromotion))) {
			$promotion_url_name = $params['promotion_url_name'];
			$promotion_url_sub_title = $params['promotion_url_sub_title'];
			$promotion_url = $params['promotion_url'];
		}


		$jsonData = '{';
		$jsonData .= '"card_id":"' . $card_id . '"';

		if ($card_type == 'CASH') {
			$jsonData .= ',"cash":{';
		}
		 else if ($card_type == 'DISCOUNT') {
			$jsonData .= ',"discount":{';
		}


		$jsonData .= '"base_info":{';

		if (!(empty($logo_url))) {
			$jsonData .= '"logo_url":"' . $logo_url . '",';
		}


		$jsonData .= '"color":"' . $color . '"';
		$jsonData .= ',"notice":"' . $notice . '"';

		if (!(empty($service_phone))) {
			$jsonData .= ',"service_phone":"' . $service_phone . '"';
		}


		$jsonData .= ',"description":"' . $description . '"';

		if ($type == 'DATE_TYPE_FIX_TIME_RANGE') {
			$jsonData .= ',"date_info":{';
			$jsonData .= '"type":"DATE_TYPE_FIX_TIME_RANGE"';
			$jsonData .= ',"begin_timestamp":' . $begin_timestamp;
			$jsonData .= ',"end_timestamp":' . $end_timestamp;
			$jsonData .= '}';
		}


		$jsonData .= ',"use_limit":' . $use_limit;
		$jsonData .= ',"get_limit":' . $get_limit;
		$jsonData .= ',"can_share":' . $can_share;
		$jsonData .= ',"can_give_friend":' . $can_give_friend;
		$jsonData .= ',"center_title":"' . $center_title . '"';
		$jsonData .= ',"center_sub_title":"' . $center_sub_title . '"';
		$jsonData .= ',"center_url":"' . $center_url . '"';

		if (!(empty($setcustom))) {
			$jsonData .= ',"custom_url_name":"' . $custom_url_name . '"';
			$jsonData .= ',"custom_url":"' . $custom_url . '"';
			$jsonData .= ',"custom_url_sub_title":"' . $custom_url_sub_title . '"';
		}


		if (!(empty($setpromotion))) {
			$jsonData .= ',"promotion_url_name":"' . $promotion_url_name . '"';
			$jsonData .= ',"promotion_url_sub_title":"' . $promotion_url_sub_title . '"';
			$jsonData .= ',"promotion_url":"' . $promotion_url . '"';
		}


		$jsonData .= '}';
		$jsonData .= '}';
		$jsonData .= '}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/update?access_token=' . $token;
		$result = $this->wxHttpsRequest($url, $jsonData);
		return $result;
	}

	/**
     * 微信卡券：批量查询平台已创建的卡券ID列表
     */
	public function wxCardGetCardidList($offset = 0, $count = 10, $status_list = NULL)
	{
		$jsonData = '{"offset":"' . $offset . '","count":"' . $count . '"';

		if (!(empty($status_list))) {
			$jsonData .= ',"' . $status_list . '":["' . $status_list . '"]';
		}


		$jsonData .= '}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/batchget?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $jsonData);
		return $jsoninfo;
	}

	/**
     * 微信卡券：更新卡券库存数量
     */
	public function wxCardUpdateQuantity($card_id)
	{
		global $_W;
		global $_GPC;
		$id = intval($card_id);

		if (!(empty($id))) {
			$sql = 'select id,uniacid, card_id from ' . tablename('ewei_shop_wxcard');
			$sql .= '  where uniacid=:uniacid and id=:id   limit 1';
			$wxcard = pdo_fetch($sql, array(':id' => $id, ':uniacid' => $_W['uniacid']));
			if (empty($wxcard) || empty($wxcard['card_id'])) {
				return false;
			}


			$card_id = $wxcard['card_id'];
		}
		 else {
			$sql = 'select id,uniacid, card_id from ' . tablename('ewei_shop_wxcard');
			$sql .= '  where uniacid=:uniacid and card_id=:card_id   limit 1';
			$wxcard = pdo_fetch($sql, array(':card_id' => $card_id, ':uniacid' => $_W['uniacid']));
			if (empty($wxcard) || empty($wxcard['card_id'])) {
				return false;
			}


			$card_id = $wxcard['card_id'];
			$id = $wxcard['id'];
		}

		$result = $this->wxCardGetQuantity($card_id);

		if (empty($result)) {
			return false;
		}


		$data = array('quantity' => intval($result['quantity']), 'total_quantity' => intval($result['total_quantity']));
		pdo_update('ewei_shop_wxcard', $data, array('id' => $id));
		return true;
	}

	/**
     * 微信卡券：查看库存数量
     */
	public function wxCardGetQuantity($cardid)
	{
		$result = $this->wxCardGetInfo($cardid);

		if (is_wxerror($result)) {
			return;
		}


		$card_type = $result['card']['card_type'];
		$quantitys = $result['card'][strtolower($card_type)]['base_info']['sku'];
		return $quantitys;
	}

	/**
     * 微信卡券：查询卡券详情
     */
	public function wxCardGetInfo($cardid)
	{
		$jsonData = '{"card_id":"' . $cardid . '"}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/get?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $jsonData);
		return $jsoninfo;
	}

	/**
     * 微信卡券：修改库存
     */
	public function wxCardModifyStock($card_id, $num, $type)
	{
		$jsonData = '{';
		$jsonData .= '"card_id":"' . $card_id . '"';

		if (empty($type)) {
			$jsonData .= ',"increase_stock_value":' . $num;
		}
		 else {
			$jsonData .= ',"reduce_stock_value":' . $num;
		}

		$jsonData .= '}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/modifystock?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $jsonData);
		return $jsoninfo;
	}

	/**
     * 微信卡券：消耗卡券
     */
	public function wxCardConsume($code, $card_id = '')
	{
		$jsonData = '{"code":"' . $code . '"';

		if (!(empty($card_id))) {
			$jsonData .= ',"card_id":"' . $card_id . '"';
		}


		$jsonData .= '}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/code/consume?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $jsonData);
		return $jsoninfo;
	}

	/**
     * 微信卡券：删除卡券
     */
	public function wxCardDelete($card_id)
	{
		$jsonData = '{"card_id":"' . $card_id . '"}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/delete?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $jsonData);
		return $jsoninfo;
	}

	/**
     * 微信卡券：获取用户已领取卡券接口
     */
	public function wxCardGetUserCardList($openid, $card_id = '')
	{
		$jsonData = '{"openid":"' . $openid . '"';

		if (!(empty($card_id))) {
			$jsonData .= ',"card_id":"' . $card_id . '"';
		}


		$jsonData .= '}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/user/getcardlist?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $jsonData);
		return $jsoninfo;
	}

	/**
     * 微信卡券：查询Code接口
     */
	public function wxCardGetCodeInfo($code, $card_id, $check_consume = true)
	{
		$jsonData = '{"card_id":"' . $card_id . '"';
		$jsonData .= ',"code":"' . $code . '"';

		if ($check_consume === true) {
			$jsonData .= ',"check_consume":true';
		}
		 else {
			$jsonData .= ',"check_consume":false';
		}

		$jsonData .= '}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/code/get?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $jsonData);
		return $jsoninfo;
	}

	public function consumeWxCardCount($openid, $merch_array, $goods_array)
	{
		global $_W;
		global $_GPC;
		$time = time();
		$param = array();
		$ref = $this->wxCardGetUserCardList($openid);

		if (is_wxerror($ref)) {
			return 0;
		}


		$wxcard_list = $ref['card_list'];
		$card_idlist = array();

		foreach ($wxcard_list as $card ) {
			$card_idlist[] = '\'' . $card['card_id'] . '\'';
		}

		$param[':uniacid'] = $_W['uniacid'];
		$card_id = implode(',', $card_idlist);

		if (empty($card_id)) {
			return 0;
		}


		$sql = 'select id,uniacid, card_id,least_cost,reduce_cost,merchid,limitgoodtype,limitgoodcatetype,limitgoodcateids,limitgoodids  from ' . tablename('ewei_shop_wxcard');
		$sql .= '  where uniacid=:uniacid and merchid=0 and card_id in (' . $card_id . ')  order by id desc';
		$cardlist = pdo_fetchall($sql, $param);

		if (empty($cardlist)) {
			return 0;
		}


		$result = array();

		foreach ($wxcard_list as $wxcard ) {
			foreach ($cardlist as $card ) {
				if ($wxcard['card_id'] == $card['card_id']) {
					$card['code'] = $wxcard['code'];
					$result[] = $card;
				}

			}
		}

		$goodlist = array();

		if (!(empty($goods_array))) {
			foreach ($goods_array as $key => $value ) {
				$goodparam[':uniacid'] = $_W['uniacid'];
				$goodparam[':id'] = $value['goodsid'];
				$sql = 'select id,cates,marketprice,merchid  from ' . tablename('ewei_shop_goods');
				$sql .= ' where uniacid=:uniacid and id =:id order by id desc LIMIT 1 ';
				$good = pdo_fetch($sql, $goodparam);
				$good['saletotal'] = $value['total'];
				$good['optionid'] = $value['optionid'];

				if (!(empty($good))) {
					$goodlist[] = $good;
				}

			}
		}


		$result = $this->checkwxcardlimit($result, $goodlist);
		return count($result);
	}

	public function getAvailableWxcards($type, $money = 0, $merch_array, $goods_array = array())
	{
		global $_W;
		global $_GPC;
		$time = time();
		$param = array();
		$ref = $this->wxCardGetUserCardList($_W['openid']);

		if (is_wxerror($ref)) {
			return array();
		}


		$wxcard_list = $ref['card_list'];
		$card_idlist = array();

		foreach ($wxcard_list as $card ) {
			$card_idlist[] = '\'' . $card['card_id'] . '\'';
		}

		$param[':uniacid'] = $_W['uniacid'];
		$card_id = implode(',', $card_idlist);

		if (empty($card_id)) {
			return array();
		}


		$sql = 'select id,uniacid,card_type,logo_url,title, card_id,least_cost,reduce_cost,discount,merchid,limitgoodtype,limitgoodcatetype,limitgoodcateids,limitgoodids,datetype,end_timestamp,fixed_term  from ' . tablename('ewei_shop_wxcard');
		$sql .= '  where uniacid=:uniacid and merchid=0 and card_id in (' . $card_id . ')  order by id desc';
		$cardlist = pdo_fetchall($sql, $param);

		if (empty($cardlist)) {
			return array();
		}


		$result = array();

		foreach ($wxcard_list as $wxcard ) {
			foreach ($cardlist as $card ) {
				if ($wxcard['card_id'] == $card['card_id']) {
					$card['code'] = $wxcard['code'];
					$result[] = $card;
				}

			}
		}

		$goodlist = array();

		if (!(empty($goods_array))) {
			foreach ($goods_array as $key => $value ) {
				$goodparam[':uniacid'] = $_W['uniacid'];
				$goodparam[':id'] = $value['goodsid'];
				$sql = 'select id,cates,marketprice,merchid  from ' . tablename('ewei_shop_goods');
				$sql .= ' where uniacid=:uniacid and id =:id order by id desc LIMIT 1 ';
				$good = pdo_fetch($sql, $goodparam);
				$good['saletotal'] = $value['total'];
				$good['optionid'] = $value['optionid'];

				if (!(empty($good))) {
					$goodlist[] = $good;
				}

			}
		}


		if ($type == 0) {
			$list = $this->checkwxcardlimit($result, $goodlist);
		}


		$list = set_medias($list, 'logo_url');

		if (!(empty($list))) {
			foreach ($list as &$row ) {
				$row['logo_url'] = tomedia($row['logo_url']);
				$row['timestr'] = '永久有效';

				if ($row['datetype'] == 'DATE_TYPE_FIX_TIME_RANGE') {
					$row['timestr'] = date('Y-m-d H:i', $row['end_timestamp']);
				}
				 else if ($row['datetype'] == 'DATE_TYPE_FIX_TERM') {
					$row['timestr'] = '自生效日后' . $row['fixed_term'] . '天有效';
				}


				if ($row['card_type'] == 'CASH') {
					$row['backstr'] = '立减';
					$row['css'] = 'deduct';
					$row['backmoney'] = (double) $row['reduce_cost'] / 100;
					$row['backpre'] = true;

					if ($row['reduce_cost'] == '0') {
						$row['color'] = 'org ';
					}
					 else {
						$row['color'] = 'blue';
					}
				}
				 else if ($row['card_type'] == 'DISCOUNT') {
					$row['backstr'] = '折';
					$row['css'] = 'discount';
					$discount = (double) 100 - (intval($row['discount']) / 10);
					$row['backmoney'] = $discount;
					$row['color'] = 'red ';
				}

			}

			unset($row);
		}


		return $list;
	}

	public function checkwxcardlimit($list, $goodlist)
	{
		global $_W;

		foreach ($list as $key => $row ) {
			$pass = 0;
			$least_cost = 0;
			if (($row['limitgoodcatetype'] == 0) && ($row['limitgoodtype'] == 0) && ($row['least_cost'] == 0)) {
				$pass = 1;
			}
			 else {
				foreach ($goodlist as $good ) {
					if ((0 < $row['merchid']) && (0 < $good['merchid']) && ($row['merchid'] != $good['merchid'])) {
						continue;
					}


					$p = 0;
					$cates = explode(',', $good['cates']);
					$limitcateids = explode(',', $row['limitgoodcateids']);
					$limitgoodids = explode(',', $row['limitgoodids']);
					if (($row['limitgoodcatetype'] == 0) && ($row['limitgoodtype'] == 0)) {
						$p = 1;
					}


					if ($row['limitgoodcatetype'] == 1) {
						$result = array_intersect($cates, $limitcateids);

						if (0 < count($result)) {
							$p = 1;
						}

					}


					if ($row['limitgoodtype'] == 1) {
						$isin = in_array($good['id'], $limitgoodids);

						if ($isin) {
							$p = 1;
						}

					}


					if ($p == 1) {
						$pass = 1;
					}


					if ((0 < $row['least_cost']) && ($p == 1)) {
						if (0 < $good['optionid']) {
							$optionparam[':uniacid'] = $_W['uniacid'];
							$optionparam[':id'] = $good['optionid'];
							$sql = 'select  marketprice  from ' . tablename('ewei_shop_goods_option');
							$sql .= ' where uniacid=:uniacid and id =:id order by id desc LIMIT 1 ';
							$option = pdo_fetch($sql, $optionparam);

							if (!(empty($option))) {
								$least_cost += (double) $option['marketprice'] * $good['saletotal'];
							}

						}
						 else {
							$least_cost += (double) $good['marketprice'] * $good['saletotal'];
						}
					}

				}

				if ((0 < $row['least_cost']) && (($least_cost * 100) < $row['least_cost'])) {
					$pass = 0;
				}

			}

			if ($pass == 0) {
				unset($list[$key]);
			}

		}

		return array_values($list);
	}

	/**
     * 微信卡券：获取卡券领取二维码链接
     */
	public function wxCardGetQrcodeUrl($cardid)
	{
		$jsonData = '{"action_name":"QR_CARD"';
		$jsonData .= ',"action_info":{';
		$jsonData .= '"card":{';
		$jsonData .= '"card_id":"' . $cardid . '"';
		$jsonData .= '}}}';
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/card/qrcode/create?access_token=' . $token;
		$jsoninfo = $this->wxHttpsRequest($url, $jsonData);
		return $jsoninfo;
	}

	/**
     *    微信获取AccessToken 返回指定微信公众号的at信息
     */
	public function wxJsApiTicket()
	{
		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=' . $token;
		$result = $this->wxHttpsRequest($url);
		$jsoninfo = @json_decode($result, true);
		$ticket = $jsoninfo['ticket'];
		return $ticket;
	}

	/**
     * 微信卡券：JSAPI 卡券Package
     */
	public function wxCardPackage($cardId, $openid = '')
	{
		$timestamp = time();
		$api_ticket = $this->wxJsApiTicket();
		$cardId = $cardId;
		$arrays = array($api_ticket, $timestamp, $cardId);
		sort($arrays);
		$string = sha1(implode('', $arrays));
		$resultArray['card_id'] = $cardId;
		$resultArray['card_ext'] = array();
		$resultArray['card_ext']['openid'] = $openid;
		$resultArray['card_ext']['timestamp'] = $timestamp;
		$resultArray['card_ext']['signature'] = $string;
		return $resultArray;
	}

	/**
     * 微信卡券：JSAPI 卡券全部卡券 Package
     */
	public function wxCardAllPackage($cardIdArray = array(), $openid = '')
	{
		$reArrays = array();
		if (!(empty($cardIdArray)) && (is_array($cardIdArray) || is_object($cardIdArray))) {
			foreach ($cardIdArray as $value ) {
				$reArrays[] = $this->wxCardPackage($value, $openid);
			}
		}
		 else {
			$reArrays[] = $this->wxCardPackage($cardIdArray, $openid);
		}

		return json_encode($reArrays);
	}

	/**
     *    微信提交API方法，返回微信指定JSON
     */
	public function wxHttpsRequest($url, $data = NULL)
	{
		$result = ihttp_request($url, $data);
		return @json_decode($result['content'], true);
	}

	/**
     * 微信格式化数组变成参数格式 - 支持url加密
     */
	public function wxSetParam($parameters)
	{
		if (is_array($parameters) && !(empty($parameters))) {
			$this->parameters = $parameters;
			return $this->parameters;
		}


		return array();
	}

	/**
     * 微信格式化数组变成参数格式 - 支持url加密
     */
	public function wxFormatArray($parameters = NULL, $urlencode = false)
	{
		if (is_null($parameters)) {
			$parameters = $this->parameters;
		}


		$restr = '';
		ksort($parameters);

		foreach ($parameters as $k => $v ) {
			if ((NULL != $v) && ('null' != $v) && ('sign' != $k)) {
				if ($urlencode) {
					$v = urlencode($v);
				}


				$restr .= $k . '=' . $v . '&';
			}

		}

		if (0 < strlen($restr)) {
			$restr = substr($restr, 0, strlen($restr) - 1);
		}


		return $restr;
	}

	/**
     * 微信Sha1签名生成器 - 需要将参数数组转化成为字符串[wxFormatArray方法]
     */
	public function wxSha1Sign($content)
	{
		try {
			if (is_null($content)) {
				throw new Exception('签名内容不能为空');
			}


			return sha1($content);
		}
		catch (Exception $e) {
			exit($e->getMessage());
		}
	}

	public function getWxTicket()
	{
		$cardTicket = m('cache')->getArray('wx_card_ticket');
		if (!(empty($cardTicket)) && !(empty($cardTicket['ticket'])) && (TIMESTAMP < $cardTicket['expire'])) {
			return $cardTicket['ticket'];
		}


		$account = m('common')->getAccount();
		$token = $account->fetch_token();
		$cardTicket = array();
		$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $token . '&type=wx_card';
		$content = ihttp_get($url);

		if (is_error($content)) {
			return error(-1, '调用接口获取微信公众号 jsapi_ticket 失败, 错误信息: ' . $content['message']);
		}


		$result = @json_decode($content['content'], true);
		if (empty($result) || (intval($result['errcode']) != 0) || ($result['errmsg'] != 'ok')) {
			return error(-1, '获取微信公众号 jsapi_ticket 结果错误, 错误信息: ' . $result['errmsg']);
		}


		$cardTicket['ticket'] = $result['ticket'];
		$cardTicket['expire'] = (TIMESTAMP + $result['expires_in']) - 200;
		m('cache')->set('wx_card_ticket', $cardTicket);
		return $cardTicket['ticket'];
	}

	public function getsignature($card_id, $timestamp, $nonce_str, $openid)
	{
		global $_W;
		$jsapiTicket = $this->getWxTicket();
		$code = '';
		$arr = array($jsapiTicket, $code, $timestamp, $nonce_str, $card_id, $openid);
		sort($arr, SORT_STRING);
		$signature = sha1(implode($arr));
		return $signature;
	}
}


?>