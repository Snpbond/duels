<?php
require_once('config.php');
include_once('functions.php');
include_once('tf2duel.class.php');

if($_POST['id']){
	$id = $_POST['id'];
	$query = 'select * from duels where id='.$id;
	$res = mysql_query($query);

	$duel = mysql_fetch_assoc($res);

	$challenger = new SteamId($duel['challenger']);
	$victim = new SteamId($duel['victim']);
	$winner = new SteamId($duel['winner']);

	//echo $challenger->getSteamName() . ' vs ' . $victim->getSteamName();

	//var_dump($duel);

	?>
	<h3>Duel Info</h3>
	<div class="row">
		<div class="span2">
			<img src="img/maps/<?php echo $duel['map']; ?>.png" class="img-polaroid"/>
		</div>
		<div class="offset2">
			<h4><?php echo $duel['map']; ?></h4>
			<em><?php echo date("D M d, Y - h:i a", strtotime($duel['time'])); ?></em>
			<br/><strong>Winner:</strong> <?php echo $winner->getSteamName(); ?>
		</div>
	</div>
	<table class="table" style="margin-top: 5px;">
		<tr>
			<td>Challenger: </td>
			<td><?php echo $challenger->getSteamName(); ?></td>
			<td>Score: </td>
			<td><?php echo $duel['challenger_score']; ?></td>
		</tr>
		<tr>
			<td>Victim: </td>
			<td><?php echo $victim->getSteamName(); ?></td>
			<td>Score: </td>
			<td><?php echo $duel['victim_score']; ?></td>
		</tr>
	</table>
<?php 
}else{
	echo "No id provided";
}

