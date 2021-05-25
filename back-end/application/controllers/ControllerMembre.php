<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: GET');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
  require '../services/Bdd.php';
  require '../models/Membre.php';
  require '../services/Membre.php';

  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
    if(isset($_GET['id']) && !empty($_GET['id'])){

      $id = (int)$_GET['id'];

      $objet = new ModelMembre();
      $objet->setID($id);

      $result = (new ServiceMembres())->getMembre($objet);
      
      if($result){

        class Membre {
          public $id;
          public $name;
          public $surname;
      
          function __construct($id, $name, $surname) { 
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
          }
        }

        for ($i=0; $i < count($result); $i++) {
          $objet = new Membre($result[$i]->getID(), $result[$i]->getName(),$result[$i]->getSurname());
          $data[] = $objet;
        }
        
        echo json_encode($data);
      }
    }
  }
  

?>