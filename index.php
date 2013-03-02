<?php
require_once('config.php');
include('functions.php');
include('tf2duel.class.php');

$weekquery = 'select * from players_weekly order by wins desc,losses asc limit 1';
$weekres = mysql_query($weekquery);
$topWeek = mysql_fetch_assoc($weekres);
$topPlayer = new Player($topWeek['steamid']);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TF2 Duels</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/bootstrap-responsive.css"/>
		<link rel="stylesheet" href="css/jquery-ui-1.10.0.custom.min.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="css/reveal.css"/>
		<style>
		  body {
			padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		  }
		</style>
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="js/jquery-1.9.0.min.js"></script>
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="js/tf2duel.js"></script>
		<script src="js/jquery.foundation.reveal.js"></script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
			<div class="container">
			  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </a>
			  <a class="brand" href="#">TF2 Duels</a>
			  <div class="nav-collapse collapse">
				<ul class="nav">
				  <li class="active"><a href="#">Home</a></li>
				  <!--<li><a href="#about">About</a></li>
				  <li><a href="#contact">Contact</a></li>-->
				</ul>
			  </div><!--/.nav-collapse -->
			  <div class="searchPlayers">
				<input id="searchPlayers" type="text" placeholder="Search Players..."/>
			  </div>
			</div>
		  </div>
		</div>
			<div id="headerbg" style="background: url('img/rotate.php') no-repeat center top;">
				<div class="container">
					<div class="hero-unit infoblock">
						<h2>Dueler of the Week</h2>
						<div class="row">
						<?php if(mysql_num_rows($weekres) != 0){ ?>
							<div class="span1">
								<img src="<?php echo $topPlayer->getAvatarFull(); ?>" width="92" height="92"  class="img-polaroid"/>
							</div>
							<div class="offset1">
								<?php echo $topPlayer->getSteamName(); ?><br/>Wins: <?php echo $topWeek['wins']; ?> Losses: <?php echo $topWeek['losses']; ?>
							</div>
						<?php }else{ ?>
							<div class="span1">
								<img src="img/question.jpg" width="92" height="92"  class="img-polaroid"/>
							</div>
							<div class="offset1">
								Nobody yet, start dueling and it could be you!
							</div>
						  <?php } ?>
						</div>
					</div>
				</div>
			</div>
		<div class="container">
			<div class="row">
				<div class="span4 sidekick">
					<h5>Most Recent Duels</h5>
					<?php include('recentduels.php'); ?>
				</div>
				<div class="span4 sidekick">
					<h5>Top Duelers</h5>
					<?php include('topdueler.php'); ?>
				</div>
				<div class="span4 sidekick">
					<h5>Most Losses</h5>
					<?php include('toplosses.php'); ?>
				</div>
			</div>
		</div>
		<br/><br/>
		<div style="text-align: center; margin: auto;">
			<button id="load100" class="btn btn-large btn-block" type="button" style="width: 200px; margin: auto;" onclick="$(this).fadeOut('100', function(){
			$('#spinner').fadeIn();
			top100('#top100','#spinner100');
			});">Load Top 100</button>
			<div id="spinner100">
				<img src="img/loading.gif" alt="Loading..." />
			</div>
		</div>
		<div id="top100" class="container">
		</div>
			<!--<button id="load100" class="btn btn-large btn-block" type="button" style="width: 200px; margin: auto;" onclick="
			$('#popupModal').reveal();
			duelInfo('3','#popupModal','#spinnertop');
			">Reveal!</button>-->
		<div id="popupModal" class="reveal-modal">
			<div id="spinnertop" style="text-align: center;">
				<img src="img/loading.gif" alt="Loading..." />
			</div>
		</div>
	</body>
</html>