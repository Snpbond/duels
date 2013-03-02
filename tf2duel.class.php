<?php

class Player
{
	//Variables
	var $arg1;
	var $steamid;
	var $steamid64;
	var $communitydata;
	
	//Constructor - pulls in variables and exec's convert function
	function __construct($arg1){
		$this->steamid = $arg1;
		$this->convertSteamidtoCommunityid($arg1);
		//$this->getCommunityData();
	}
	//Converts steamid STEAM_X:X:XXXXXX to community ID
	function convertSteamidtoCommunityid($sid){
		$sid2 = explode(":", substr($sid, 8));
		$this->steamid64 = (($sid2[1]*2)+$sid2[0])+76561197960265728;
	}
	
	function printid64(){
		echo $this->steamid64;
	}

	function getCommunityData() {
		if(is_null($this->communitydata)){
			global $steamAPIKey;
			$url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$steamAPIKey.'&steamids='.$this->steamid64;
			$ch = curl_init();
			$timeout = 5;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$data = curl_exec($ch);
			curl_close($ch);
			$steamdata = json_decode($data, true);
			$this->communitydata = $steamdata['response']['players'][0];
		}
	}

	function printCommunityData(){
		$this->getCommunityData();
		print_r($this->communitydata);
	}

	function getAvatarMedium(){
		$this->getCommunityData();
		return $this->communitydata['avatarmedium'];
	}

	function getAvatarFull(){
		$this->getCommunityData();
		return $this->communitydata['avatarfull'];
	}

	function getSteamName(){
		$this->getCommunityData();
		return $this->communitydata['personaname'];
	}
	//Database functions
	function updatePlayer($field,$value){
		$query = 'update players set "'.$field.'" = "'.$value.'" where steamid = "'.$this->steamid.'"';
		if(mysql_query($query) or die(mysql_error())){
		return 1;
		}
	}

	function addWin(){
		$this->updatePlayer('wins','wins+1');
	}

	function addLoss(){
		$this->updatePlayer('losses','losses+1');
	}

	function updateName(){
		$steamname = $this->getSteamName();
		$this->updatePlayer('steamname',$steamname);
	}

	function createPlayer($table){
		$steamname = $this->getSteamName();
		$query = 'insert into '.$table.' (steamid,wins,losses,steamname) values("'.mysql_real_escape_string($this->steamid).'","0","0","'.mysql_real_escape_string($steamname).'")';
		if(mysql_query($query) or die(mysql_error())){
			return 1;
		}
	}


}

?>