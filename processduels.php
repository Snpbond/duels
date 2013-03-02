<?php
require('config.php');
require('tf2duel.class.php');
include('functions.php');

//Retrieve duels that are not processed
$query = "select * from duels where processed = 0";
$res = mysql_query($query);

//For each duel pull winner and increment their count
while($duels = mysql_fetch_assoc($res)){
	//Check for ties this time
	if($duels['challenger_score'] != $duels['victim_score']){
		//No tie, figure out winner based on score
		if($duels['challenger_score'] > $duels['victim_score']){
			$winner = $duels['challenger'];
			$loser = $duels['victim'];
		}else{
			$winner = $duels['victim'];
			$loser = $duels['challenger'];
		}
		//Update Winner with a win
		$player = new Player($winner);
		$player->addWin();
		//Update Loser With A loss
		$player = new Player($loser);
		$player->addLoss();
	}
	//Then set that duel to processed
	$q = 'update duels set processed=1 where id='.$duels['id'];
	mysql_query($q);	
}
?>