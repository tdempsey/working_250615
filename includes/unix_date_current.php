<?php
function currentUnixDate() 
{
	global $debug;

	$today = mktime (0,0,0,date("m"),date("d"),date("Y"));

	return $today;
}
?>