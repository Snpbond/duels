<?php
require_once('config.php');
include_once('functions.php');
include_once('tf2duel.class.php');

$query = 'select challenger,victim,id from duels where processed=1 order by id desc limit 5';
$res = mysql_query($query);

while($duel = mysql_fetch_assoc($res)){
	$challenger = new Player($duel['challenger']);
	$victim = new Player($duel['victim']);
?>
<ul>
	<li><a href="#" onclick="$('#popupModal').reveal();duelInfo('<?php echo $duel['id']; ?>','#popupModal','#spinnertop');return false;">
		<?php echo $challenger->getSteamName().' vs '.$victim->getSteamName() ?>
	</a></li>
</ul>
<?php
}

?>