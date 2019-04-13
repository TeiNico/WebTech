<?php

//Wird ausgeführt wenn der LoginButton gedrückt wurde
if (isset($_POST['loginButton'])) {

    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    //return ein boolean, wenn username und passwort zusammen in db vorliegen
    $loginSuccesfull = $account->login($username, $password);

    //Wenn der Login erfolgreich war -> dann wird zur index.php weitergeleitet und Session wird mit username gestartet
    if ($loginSuccesfull) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }

}
