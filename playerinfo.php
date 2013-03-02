<?php
require_once('config.php');
include_once('functions.php');
include_once('tf2duel.class.php');

//Query Player
$query = 'select * from players where steamid = "'.mysql_real_escape_string($_POST['id']).'"';
$res = mysql_query($query) or die(mysql_error());

$player = mysql_fetch_assoc($res);

//Query Duels
$queryd = 'select * from duels where challenger = "'.$player['steamid'].'" or victim = "'.$player['steamid'].'" order by id desc';
$resq = mysql_query($queryd) or die(mysql_error());
$duel = mysql_fetch_assoc($resq);

$steamPlayer = new Player($player['steamid']);

?>
<div class="row">
	<div class="span1">
		<img src="<?php echo $steamPlayer->getAvatarFull(); ?>" width="92" height="92"  class="img-polaroid"/>
	</div>
	<div class="offset1">
		<h3><?php echo $player['steamname']; ?></h3>
		<i>Last Duel: <?php echo date("D M d, Y - h:i a", strtotime($duel['time']));?></i>	
	</div>
	<div class="span5">
		<table class="table" style="margin-top: 20px;">
			<tr>
				<td>Wins: </td>
				<td><?php echo $player['wins']; ?></td>
			</tr>
			<tr>
				<td>Losses: </td>
				<td><?php echo $player['losses']; ?></td>
			</tr>
		</table>
		<h5>Duel History</h5>
		<table class="table" style="margin-top: 5px;">
			<thead style="display: block;">
				<tr>
					<th style="width: 115px;">Challenger</th>
					<th style="width: 155px;">Victim</th>
					<th style="width: 75px;">Map</th>
					<th style="width: 80px;">Outcome</th>
				</tr>
			</thead>
			<tbody style="display: block; height: 300px; overflow: auto; width: 550px;">
			<?php
			while($duels = mysql_fetch_assoc($resq)){
			?>
				<tr>
					<td>
					<?php 
						if($duels['challenger'] == $player['steamid']){
							echo $player['steamname'];
						}else{
							$challenger = new Player($duels['challenger']);
							echo $challenger->getSteamName();
						}
					?>
					</td>
					<td>
					<?php 
						if($duels['victim'] == $player['steamid']){
							echo $player['steamname'];
						}else{
							$challenger = new Player($duels['victim']);
							echo $challenger->getSteamName();
						}
					?>
					</td>
					<td><?php echo $duels['map']; ?></td>
					<td><?php if($duels['winner'] == $player['steamid']){echo "Win";}else{ echo "Loss";} ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>