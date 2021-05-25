<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json ; charset=utf-8');
  header('Acces-Control-Allow-Methods: GET');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

  if($_SERVER['REQUEST_METHOD'] == 'GET'){

    require  '../services/Bdd.php';
    require  '../models/Saison.php';
    require  '../services/Saison.php';

    class saison {
      public $id;
      public $saison;

      function __construct($id,$saison) {
        $this->id = $id;
        $this->saison = $saison;
      }
    }
    
    $getSaison = (new ServiceSaison())->getSaison();

    for ($i=0; $i <count($getSaison) ; $i++) { 
      $objet = new saison($getSaison[$i]->getIdSaison(), $getSaison[$i]->getSaison());
      $data[] = $objet;
    }

    echo json_encode($data);


  }
?>