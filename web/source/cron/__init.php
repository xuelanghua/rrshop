<?php
/**
 * [WeiZan System] Copyright (c) 2014 WeiZan.Com
 
 */
if($action != 'entry') {
	define('FRAME', 'setting');
	$frames = buildframes(array(FRAME));
	$frames = $frames[FRAME];
}
