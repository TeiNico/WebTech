<?php

class Contracts
{

    private $con;
    private $errorArray;

    //Klassen Konstruktor - nutzt die config.php um mit der Datenbank zu kommunizieren
    public function __construct($con)
    {
        $this->con        = $con;
        $this->errorArray = array();
    }


    public function newContract($dB, $dE, $name, $description, $pB, $pE, $dR){

    }

}

?>