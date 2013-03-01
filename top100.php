<?php
require_once('config.php');
include_once('functions.php');
include_once('tf2duel.class.php');

$query = 'select * from players order by wins desc,losses asc limit 100';
$res = mysql_query($query);
$position = 1;

?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Position</th>
			<th>Steam Name</th>
			<th>Wins</th>
			<th>Losses</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php

while($player = mysql_fetch_assoc($res)){
	echo '<tr>';
	echo '<td>'.$position.'</td>';
	echo '<td id="'.$player['steamid'].'">'.$player['steamname'].'</td>';
	echo '<td>'.$player['wins'].'</td>';
	echo '<td>'.$player['losses'].'</td>';
	echo '<td><a href="#" onclick="updatePlayer(\''.$player['steamid'].'\');return false;" class="btn btn-info" title="Refresh Name"><i class="icon-refresh icon-white"></i></a></td>';
	echo '</tr>';
	$position++;
}
?>
	</tbody>
</table>