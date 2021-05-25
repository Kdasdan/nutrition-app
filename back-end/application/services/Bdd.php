<?php
 
  class Bdd {
    private $bdd = '';

    public function __construct($connec_host = 'localhost', $connec_dbname = 'vr_nutrition', $connec_pseudo = 'root', $connec_mdp = ''){
        try {
            $this->bdd = new PDO('mysql:host='.$connec_host.';dbname='.$connec_dbname, $connec_pseudo, $connec_mdp);
            $this->bdd->exec("SET CHARACTER SET utf8");
            $this->bdd->exec("SET NAMES utf8");
        }
        catch(PDOException $e) {
            die('<h3>Erreur !</h3>');
        }
    }

    public function connexion(){
        return $this->bdd;
    }
  }

?>