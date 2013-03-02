<?php
//TF2 Duel Functions

function get_data($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function playerExists($steamid,$table){
	if(!$table){$table='players';}
	$query = 'select id,steamid from '.mysql_real_escape_string($table).' where steamid = "'.mysql_real_escape_string($steamid).'"';
	if(mysql_num_rows(mysql_query($query)) == 1){
		return 1;
	}
}

function createPlayer($steamid,$wins,$losses,$table){
	$player = new Player($steamid);
	$playerName = $player->getSteamName();
	if(!$table){$table='players';}
	$query = 'insert into '.$table.' (steamid,wins,losses,steamname) values("'.mysql_real_escape_string($steamid).'","'.mysql_real_escape_string($wins).'","'.mysql_real_escape_string($losses).'","'.mysql_real_escape_string($playerName).'")';
	if(mysql_query($query) or die(mysql_error())){
		return 1;
	}
}

function updatePlayer($steamid,$win,$table){
	$player = new Player($steamid);
	$playerName = $player->getSteamName();
	if(!$table){$table='players';}
	if($win){
		$query = 'update '.mysql_real_escape_string($table).' set wins=wins+1,steamname="'.mysql_real_escape_string($playerName).'" where steamid="'.mysql_real_escape_string($steamid).'"';
		if(mysql_query($query)){return 1;}
	}else{
		$query = 'update '.mysql_real_escape_string($table).' set losses=losses+1,steamname="'.mysql_real_escape_string($playerName).'" where steamid="'.mysql_real_escape_string($steamid).'"';
		if(mysql_query($query)){return 1;}
	}
}

function updatePlayerName($steamid,$steamname){
	$query = 'update players set steamname="'.mysql_real_escape_string($steamname).'" where steamid="'.mysql_real_escape_string($steamid).'"';
	$queryweek = 'update players_weekly set steamname="'.mysql_real_escape_string($steamname).'" where steamid="'.mysql_real_escape_string($steamid).'"';
	if(mysql_query($query) && mysql_query($queryweek)){
		return 1;	
	}
}

?>