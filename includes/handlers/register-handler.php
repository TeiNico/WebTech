<?php 


//Funktionen um die Eingaben zu modellieren - Cleant die Eingaben

function sanitizeUsername($inputText){
	//strip_tags entfernt html und php Zeichenketten aus der Eingabe
	$inputText = strip_tags($inputText);
	//Alle Leerzeichen werden aus der Eingabe entfernt
	$inputText = str_replace(" ", "", $inputText);
	//Gibt den nun formatierten String zurück
	return $inputText;
}

function sanitizeString($inputText){
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}

function sanitizePassword($inputText){
	$inputText = strip_tags($inputText);
	return $inputText;
}

//Wird ausgeführt wenn der RegisterButton gedrückt wurde (register.php) und führt danach die Account-Registrierung durch
if (isset($_POST['registerButton'])) {

	//Eingaben werden auf HTML und PHP-Code überprüft und zurecht formatiert
	$username = sanitizeUsername($_POST['username']);
	$firstName = sanitizeString($_POST['firstName']);
	$lastName = sanitizeString($_POST['lastName']);
	$email = sanitizeUsername($_POST['email']);
	$email2 = sanitizeUsername($_POST['email2']);
	$password = sanitizePassword($_POST['password']);
	$password2 = sanitizePassword($_POST['password2']);

	//Für die register-Funktion in der Klasse Account aus(registriert den neuen Account) - gibt boolean zurück ob Registrierung erfolgreich war
	$wasSuccesfull = $account->register($username, $firstName, $lastName, $email, $email2, $password, $password2);

	//Wenn die Registrierung erfolgreich war -> dann wird zur index.php weitergeleitet und Session wird mit username gestartet
	if($wasSuccesfull) {
		$_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");
	}

}
 ?>