<?php

$sql =<<<EOF
DROP TABLE IF EXISTS `ims_junsion_album_album`;
DROP TABLE IF EXISTS `ims_junsion_album_cate`;
DROP TABLE IF EXISTS `ims_junsion_album_comment`;
DROP TABLE IF EXISTS `ims_junsion_album_feedback`;
DROP TABLE IF EXISTS `ims_junsion_album_member`;
DROP TABLE IF EXISTS `ims_junsion_album_music`;
DROP TABLE IF EXISTS `ims_junsion_album_order`;
DROP TABLE IF EXISTS `ims_junsion_album_print_order`;
DROP TABLE IF EXISTS `ims_junsion_album_print_temp_order`;
DROP TABLE IF EXISTS `ims_junsion_album_reward`;
DROP TABLE IF EXISTS `ims_junsion_album_style`;
DROP TABLE IF EXISTS `ims_junsion_album_zan`;
EOF;
pdo_run($sql);