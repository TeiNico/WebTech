<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<div id="mainContainer">
			
			<div id="menuContainer">
				<div class="menuItem"><a href="index.php">Übersicht</a></div>
				<div class="menuItem"><a href="contracts.php">Verträge</a></div>
				<div class="menuItem"><a href="bills.php">Rechnungen</a></div>
				<div class="menuItem"><a href="profil.php"><?php echo $userLoggedIn ?></a></div>
			</div>

			<div id="contentContainer">
				<div id="topContent"> <?php echo $sidename ?></div>
				<div id="mainContent">

</body>
</html>