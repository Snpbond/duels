<?php
require_once('config.php');
include_once('functions.php');
include_once('tf2duel.class.php');

$query = 'select * from players order by wins desc limit 5';
$res = mysql_query($query);

while($duel = mysql_fetch_assoc($res)){
	echo '<ul>';
	echo '<li>'.$duel['steamname'].' - '.$duel['wins'].' Wins</li>';
	echo '</ul>';
}

?>