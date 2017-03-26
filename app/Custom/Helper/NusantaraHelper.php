<?php

if(!function_exists('ayana_str_slug'))
{
	function nusantara_str_slug($string, $glue = '-')
	{
	    $string = preg_replace('/[-\s]+/', $glue, $string);
	    return trim($string, $glue);
	}
}

if(!function_exists('mysqlDateTimeFormat'))
{
	function mysqlDateTimeFormat($date = '', $strtotime = false)
	{
		if (empty($date)) {
			return date('Y-m-d H:i:s');
		} else {
			if ($strtotime) {
				return date('Y-m-d H:i:s', $date);
			} else {
				return date('Y-m-d H:i:s', strtotime($date));
			}
		}
	}
}