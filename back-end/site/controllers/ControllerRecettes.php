<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json ; charset=utf-8');
  header('Acces-Control-Allow-Methods: GET');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

  if($_SERVER['REQUEST_METHOD'] == 'GET'){

    require  '../services/Bdd.php';
    require  '../models/Recettes.php';
    require  '../services/Recettes.php';

    if(isset($_GET['saison']) AND !empty($_GET['saison']) AND isset($_GET['category']) AND !empty($_GET['category'])){
      $season =  htmlspecialchars($_GET['saison']);
      $category =  htmlspecialchars($_GET['category']);

      $objet = new ModelRecettes();
      $objet->setSeason($season);
      $objet->setCategory($category);
      
      $data = (new ServiceRecettes())->getRecettes($objet);

      if($data){
        class Recette {
          public $id;
          public $title;
          public $image;
          public $file;
      
          function __construct($id, $title, $image, $file) { 
            $this->id = $id;
            $this->title = $title;
            $this->image = $image;
            $this->file = $file;
          }
        }
        for ($i=0; $i < count($data); $i++) { 
          $objet = new Recette($data[$i]->getID(),$data[$i]->getTitle(),$data[$i]->getImage(),$data[$i]->getFileName());
          $result[] = $objet;
        }
        
        echo json_encode($result);
      }

    }
  }
?>