<?php 
	ob_start();
	session_start();
	require_once("data.php");
	require_once("functions.php");
	require_once("database.php");
	$db = new db($dbhost, $dbuser, $dbpass, $dbname);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo $pagename; ?></title>
	<link href='https://fonts.googleapis.com/css?family=Economica:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/sugomedia.css">

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.canvasjs.min.js"></script>
	<script type="text/javascript" src="js/myscripts.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3 leftside">
				<a class="brand" href="index.php">
					<img src="images/smlogo.png" width="120"> <br>
					<?php echo $pagename; ?>
				</a>
				<div class="slogen">
					<?php echo $slogen; ?>
				</div>
				
				<?php include_once("login.php"); ?>
				<?php include_once("kereses.php"); ?>
				<?php include_once("contacts.php"); ?>
			</div>
			<div class="col-md-9 rightside">
				<img src="images/header_img1.jpg">
				<?php include_once("fomenu.php"); ?>
				<?php include_once("contentloader.php"); ?>
			</div>			
			<div class="col-xs-12 footer">
				<?php include_once("footer.php"); ?>
			</div>				
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
</body>
</html>
<?php
	ob_end_flush();
?>