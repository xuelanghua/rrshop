<?php
// +----------------------------------------------------------------------
// | Author: 凡人 <fanren3150@qq.com>
// +----------------------------------------------------------------------
defined('IN_IA') or exit('Access Denied');

/**
 * 将unix时间戳转成字符
 * @param int $time unix时间戳，默认为当前时间
 * @param string $format 格式。默认为 Y-m-d H:i:s
 * @return string
 */
function timeToStr($time = NULL, $format = NULL) {
    if (!$time) {
        $time = time();
    }
    if (!$format) {
        $format = 'Y-m-d H:i:s';
    }
    return date($format, $time);
}

/**
 * 获取当前时间的字符串格式
 * @return string
 */
function now() {
    return timeToStr();
}

/**
 * 从unix时间戳获取时间部分
 * @param int $time unix时间戳，默认为当前时间
 * @return string
 */
function getTimeStr($time = NULL) {
    return timeToStr($time, 'H:i:s');
}

/**
 * 从unix时间戳获取日期部分
 * @param int $time unix时间戳，默认为当前时间
 * @return string
 */
function getDateStr($time = NULL) {
    return timeToStr($time, 'Y-m-d');
}

/**
 * 从普通时间转换为Linux时间截
 *
 * @param     string   $dtime  普通时间
 * @return    string
 */
if ( ! function_exists('GetMkTime'))
{
    function GetMkTime($dtime)
    {
        if(!preg_match("/[^0-9]/", $dtime))
        {
            return $dtime;
        }
        $dtime = trim($dtime);
        $dt = Array(1970, 1, 1, 0, 0, 0);
        $dtime = preg_replace("/[\r\n\t]|日|秒/", " ", $dtime);
        $dtime = str_replace("年", "-", $dtime);
        $dtime = str_replace("月", "-", $dtime);
        $dtime = str_replace("时", ":", $dtime);
        $dtime = str_replace("分", ":", $dtime);
        $dtime = trim(preg_replace("/[ ]{1,}/", " ", $dtime));
        $ds = explode(" ", $dtime);
        $ymd = explode("-", $ds[0]);
        if(!isset($ymd[1]))
        {
            $ymd = explode(".", $ds[0]);
        }
        if(isset($ymd[0]))
        {
            $dt[0] = $ymd[0];
        }
        if(isset($ymd[1])) $dt[1] = $ymd[1];
        if(isset($ymd[2])) $dt[2] = $ymd[2];
        if(strlen($dt[0])==2) $dt[0] = '20'.$dt[0];
        if(isset($ds[1]))
        {
            $hms = explode(":", $ds[1]);
            if(isset($hms[0])) $dt[3] = $hms[0];
            if(isset($hms[1])) $dt[4] = $hms[1];
            if(isset($hms[2])) $dt[5] = $hms[2];
        }
        foreach($dt as $k=>$v)
        {
            $v = preg_replace("/^0{1,}/", '', trim($v));
            if($v=='')
            {
                $dt[$k] = 0;
            }
        }
        $mt = mktime($dt[3], $dt[4], $dt[5], $dt[1], $dt[2], $dt[0]);
        if(!empty($mt))
        {
              return $mt;
        }
        else
        {
              return time();
        }
    }
}
/**
 * 从unix时间戳获取日期，并使用中文“年月日”表示
 * @param int $time unix时间戳，默认为当前时间
 * @return string
 */
function getChineseDate($time = NULL) {
    return timeToStr($time, 'Y年m月d日');
}
