<?php 
	include("includes/config.php");

	if (isset($_SESSION['userLoggedIn'])) {
		$userLoggedIn = $_SESSION['userLoggedIn'];
	} else {
		header("Location: register.php");
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Ausgabenmanager</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div id="mainContainer">
		<?php include("includes/topContainer.php") ?>
		
			Content auf der Rechnungsseite Seite




			</div>	
		</div>
	</div>
</body>
</html>