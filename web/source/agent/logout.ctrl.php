<?php
/**
 * [Weizan System] Copyright (c) 2014 WEIZANCMS.COM
 
 */
defined('IN_IA') or exit('Access Denied');
session_start();
session_destroy();

header('Location:' . url('account/welcome'));
