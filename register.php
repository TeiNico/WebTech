<?php
include "includes/config.php";
include "includes/classes/Account.php";
include "includes/classes/Constants.php";

//erstellt den neuen Account, welcher noch leer ist... übergibt die $con um Verbindung zu Datenbank aufzubauen
$account = new Account($con);

include "includes/handlers/register-handler.php";
include "includes/handlers/login-handler.php";

//Merkt sich den eingegeben Wert und fügt bei nicht erfolgreicher registrierung die Werte wieder in dei Input Felder ein.
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ausgabenmanager</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php
if (isset($_POST['registerButton'])) {
    echo '<script>
				$(document).ready(function(){
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			 </script>';
} else {
    echo '<script>
				$(document).ready(function(){
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			 </script>';
}

?>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">

				<!–– LoginForm mit allen wichtigen Daten / Paragraphs genutzt, um alle Eingabe Felder auf eigene Zeile zu bringen -->

				<form id="loginForm" action="register.php" method="POST">
					<h2>Logge dich hier ein!</h2>
					<p>
						<?php echo $account->getError(Constants::$loginInvalid); ?>
						<label for="loginUsername">Nutzername: </label>
						<input id="loginUsername" type="text" name="loginUsername" placeholder="R2D2" value="<?php getInputValue("loginUsername");?>" required>
					</p>

					<p>
						<label for="loginPassword">Passwort: </label>
						<input id="loginPassword" type="password" 	name="loginPassword" placeholder="dein Passwort" required>
					</p>
					<p id="pbutton"><button type="submit" name="loginButton">Rein da!</button></p>

					<div class="hasAccount">
						<span id="hideLogin">Wenn du noch keinen Account hast, registriere dich hier!</span>
					</div>


				</form>

				<!–– RegistrierungsForm mit allen wichtigen Daten / Paragraphs genutzt, um alle Eingabe Felder auf eigene Zeile zu bringen -->

				<!–– getError überprüft ob der bestimmt Fehler im Errorarray steht und gibt diese Information an der passenden Stelle aus -->

				<!–– getError holt sich die Texte aus Constants (mögliche Implementierung von mehreren Sprachen möglich) -->

				<form id="registerForm" action="register.php" hidden="true" method="POST">
					<h2>Registriere dich hier!</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameLength); ?>
						<?php echo $account->getError(Constants::$usernameExists); ?>
						<label for="username">Nutzername: </label>
						<input id="username" type="text" name="username" placeholder="User1" value="<?php getInputValue("username");?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameLength); ?>
						<label for="firstName">Vorname: </label>
						<input id="firstName" type="text" name="firstName" placeholder="Max" value="<?php getInputValue("firstName");?>"required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameLength); ?>
						<label for="lastName">Nachname: </label>
						<input id="lastName" type="text" name="lastName" placeholder="Müller" value="<?php getInputValue("lastName");?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDontMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailExists); ?>
						<label for="email">E-Mail: </label>
						<input id="email" type="email" name="email" placeholder="email@internet.com" value="<?php getInputValue("email");?>"  required>
					</p>

					<p>
						<label for="email2">E-Mail bestätigen: </label>
						<input id="email2" type="text" name="email2" placeholder="E-Mail wiederholen" value="<?php getInputValue("email2");?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDontMatch); ?>
						<?php echo $account->getError(Constants::$passwordLength); ?>
						<label for="password">Passwort: </label>
						<input id="password" type="password" 	name="password" placeholder="dein Passwort" required>
					</p>

					<p>
						<label for="password2">Passwort bestätigen: </label>
						<input id="password2" type="password" 	name="password2" required>
					</p>
					<p id="pbutton"><button type="submit" name="registerButton">Registriere Dich!</button></p>

					<div class="hasAccount">
						<span id="hideRegister">Wenn du bereits einen Account besitzt, melde dich hier an!</span>
					</div>

				</form>
			</div>

			<div id="informationContainer">
				<h1>Verwalte Verträge und Rechnungen!</h1>
				<h2>- einfach und kostenlos</h2>
					<div>
						<p>Lade Rechnungen und Verträge hoch</p>
						<p>Lass dir Erinnerungsemails schicken</p>
						<p>Berechne deine monatlichen Ausgaben</p>
					</div>

			</div>
		</div>
	</div>
</body>
</html>