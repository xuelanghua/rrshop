<?php
/**
 * [Weizan System] Copyright (c) 2014 WEIZANCMS.COM
 
 */
defined('IN_IA') or exit('Access Denied');
$do = in_array($do, array('display', 'post', 'delete')) ? $do : 'display';

if($do == 'display') {
} elseif($do == 'post') {
} elseif($do == 'delete') {
}
template('fournet/pcdiy');

