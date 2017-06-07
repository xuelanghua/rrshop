<?php
/**
 * [WEIZAN System] Copyright (c) 2015 012WZ.COM
 
 */
defined('IN_IA') or exit('Access Denied');
$dos = array('check');
$do = in_array($do, $dos) ? $do : 'check';

if($do == 'check') {
	template('clerk/check');
}