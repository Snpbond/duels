<?php
require('config.php');
require('tf2duel.class.php');
include('functions.php');

//Check if any input comes in
if($_GET['id']){

	//Create class and get current name
	$player = new Player($_GET['id']);
	$playername = $player->getSteamName();

	//Update in db and return
	if(updatePlayerName($_GET['id'],$playername)){
		echo $playername;
	}

}
?>