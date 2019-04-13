<?php
include "includes/config.php";

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

$sidename = "Verträge";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ausgabenmanager</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<?php include("includes/topContainer.php") ?>

Das hier ist in der Mitte

<?php include("includes/lowerContainer.php") ?>




</body>
</html>