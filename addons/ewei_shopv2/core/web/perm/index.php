<?php
if (!(defined('IN_IA'))) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends WebPage
{
	public function main()
	{
		if (cv('perm.role')) {
			header('location: ' . webUrl('perm/role'));
			exit();
			return;
		}


		if (cv('perm.user')) {
			header('location: ' . webUrl('perm/user'));
			exit();
			return;
		}


		if (cv('perm.log')) {
			header('location: ' . webUrl('perm/log'));
			exit();
		}

	}
}


?>