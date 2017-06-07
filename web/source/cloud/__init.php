<?php
/**
 * [Weizan System] Copyright (c) 2014 WEIZANCMS.COM
 
 */

define('IN_GW', true);

if(in_array($action, array('profile', 'device', 'callback', 'appstore', 'sms'))) {
	$do = $action;
	$action = 'redirect';
}
if($action == 'touch') {
	exit('success');
}
