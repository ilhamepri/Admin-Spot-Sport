<?php
$host	= "localhost";
$user	= "root";
$pass	= "luver";
$db		= "pbw_quiz2";
// Request database
// ilhamepri
mysql_connect($host, $user, $pass) or die( "server database tidak ditemukan!");
// Request database name
// ilhamepri
mysql_select_db($db) or die( "database tidak ditemukan di server!" );
?>
