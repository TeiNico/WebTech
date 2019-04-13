<?php
class Account
{

    private $con;
    private $errorArray;

    //Klassen Konstruktor - nutzt die config.php um mit der Datenbank zu kommunizieren
    public function __construct($con)
    {
        $this->con        = $con;
        $this->errorArray = array();
    }

    //Login Funktion
    public function login($un, $pw)
    {

        $pw = md5($pw);

        $query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un' AND password = '$pw'");

        if (mysqli_num_rows($query) == 1) {
            return true;
        } else {
            array_push($this->errorArray, Constants::$loginInvalid);
            return;
        }

    }
    //Registrierungsfunktion wird beim Klick vom RegisterButton (register.php) ausgeführt - prüft mit den unten stehenden Funktionen ob Eingaben korrekt sind
    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2)
    {
        $this->validateUsername($un);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        if (empty($this->errorArray) == true) {
            //Wenn keine Fehler im ErrorArray vorhanden sind, wird die Datenbank mit den Eingaben gefüllt
            return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
        } else {
            return false;
        }
    }
    //Prüft, welche Fehler aufgetreten sind und return den aufgetretenen Fehler, wenn er im errorArray zu finden ist.
    public function getError($error)
    {
        if (!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }
    //Funktion um die Eingaben in die Datenbank zu übergeben
    private function insertUserDetails($un, $fn, $ln, $em, $pw)
    {
        //md5t das Passwort, damit es nicht im Klartext eingespeichert wird
        $ePw = md5($pw);
        //Formatiert das Datum
        $date = date("Y-m-d H:i:s");
        //Query, welches die Daten in die Datenbank einfügt und
        $result = mysqli_query($this->con, "INSERT INTO users VALUES('', '$un', '$fn', '$ln', '$em', '$ePw', '$date')");
        //result returnt true oder false, welches dann weiter gegebn wird zur function register, wo das ergebniss dann weiter gegeben wird zum register-handler.php, wo dann entschieden ob, ob zur index.php weitergeleitet werden kann oder nicht
        return $result;

    }

    //validiert den Nutzernamen - prüft auf Länge und ob der Nutzername schon existiert
    private function validateUsername($un)
    {
        if (strlen($un) > 30 || strlen($un) < 2) {
            array_push($this->errorArray, Constants::$usernameLength);
            return;
        }
        //checkt die usernames in der Datenbank durch und vergleicht ob es einen Nutzernamen gibt, der gleich mit neuen Nutzernamen ist
        $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username = '$un'");
        if (mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$usernameExists);
            return;
        }

    }
    //validiert den Vornamen - prüft auf Länge
    private function validateFirstName($fn)
    {
        if (strlen($fn) > 30 || strlen($fn) < 1) {
            array_push($this->errorArray, Constants::$firstNameLength);
            return;
        }

    }
    //Validiert den Nachnamen - prüft auf Länge
    private function validateLastName($ln)
    {
        if (strlen($ln) > 30 || strlen($ln) < 1) {
            array_push($this->errorArray, Constants::$lastNameLength);
            return;
        }
    }

    //validiert Emails
    private function validateEmails($em, $em2)
    {
        //prüft die Gleichheit der Email Adressen
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDontMatch);
            return;
        }
        //Checkt ob eingebene Email wirklich eine Email ist - checkt ob .xx Part existiert
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }
        //Checkt ob die eingegeben Email schon mal verwendet wurde.
        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email = '$em'");
        if (mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailExists);
            return;
        }

    }
    //Validiert Passwörter
    private function validatePasswords($pw, $pw2)
    {
        //prüft die Gleichheit der Passwörter
        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        //Checkt ob Passwort nur aus Zahlen und Buchstaben besteht
        /*
        if (preg_match('/[^A-Za-z0-9]/', $pw)) {
        array_push($this->errorArray, "Dein Passwort darf nur aus Buchstaben und Zahlen bestehen.")
        return;
        }
         */
        //prüft ob die Länge der Passwörter zwischen 5 und 30 Zeichen lang ist
        if (strlen($pw) > 30 || strlen($pw) < 5) {
            array_push($this->errorArray, Constants::$passwordLength);
            return;
        }

    }

}
