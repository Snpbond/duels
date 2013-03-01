<?php
//TF2 Duel Config File

//MYSQL Config
$mysql_server = 'localhost';
$mysql_user = 'YOURUSER';
$mysql_pass = 'YOURPASS';
$mysql_database = 'YOURDB';
//Test Connection
$mysql_con = mysql_connect($mysql_server,$mysql_user,$mysql_pass);

if(!$mysql_con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db($mysql_database,$mysql_con);

//Other Config Vars
$steamAPIKey = 'YOURSTEAMAPIKEY';

?>