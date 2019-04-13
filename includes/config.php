<?php
ob_start();
session_start();
//Zeitzonen Einstellung
$timezone = date_default_timezone_set("Europe/Berlin");
//Variable con stellt die Verbindung zur Database her (Server, Pfad, Passwort, Name der Databse)
$con = mysqli_connect("localhost", "root", "", "webtech");

//Sollte es Probleme beim verbinden geben, wird eine ErrorMesage ausgegeben
if (mysqli_connect_errno()) {
    echo "Konnte keine Verbindung herstellen: " . mysqli_connect_errno();
}
