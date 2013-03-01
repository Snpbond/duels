<?php
require('config.php');
require('tf2duel.class.php');
include('functions.php');

//Retrieve duels that are not processed
$query = "select * from duels where processed = 0";
$res = mysql_query($query);

//For each duel pull winner and increment their count
while($duels = mysql_fetch_assoc($res)){
	if($duels['challenger_score'] >= $duels['victim_score']){
		$winner = $duels['challenger'];
		$loser = $duels['victim'];
	}else{
		$winner = $duels['victim'];
		$loser = $duels['challenger'];
	}
	//We know winner, so see if they exist
	if(playerExists($winner)){
		//they do, so update them with a win
		if(updatePlayer($winner,1)){echo "Success";}else{echo "Error";}
	}else{
		//create them with a win
		if(createPlayer($winner,1,0)){echo "Success";}else{echo "Error";}
	}
	if(playerExists($winner,'players_weekly')){
		//they do, so update them with a win
		if(updatePlayer($winner,1,'players_weekly')){}else{echo "Error";}
	}else{
		//create them with a win
		if(createPlayer($winner,1,0,'players_weekly')){}else{echo "Error";}
	}
	//Same for loser, so see if they exist
	if(playerExists($loser)){
		if(updatePlayer($loser,0)){echo "Success";}else{echo "Error";}
	}else{
		if(createPlayer($loser,0,1)){echo "Success";}else{echo "Error";}
	}
	if(playerExists($loser,'players_weekly')){
		if(updatePlayer($loser,0,'players_weekly')){}else{echo "Error";}
	}else{
		if(createPlayer($loser,0,1,'players_weekly')){}else{echo "Error";}
	}
	//Then set that duel to processed
	$q = 'update duels set processed=1 where id='.$duels['id'];
	mysql_query($q);	
}
?>